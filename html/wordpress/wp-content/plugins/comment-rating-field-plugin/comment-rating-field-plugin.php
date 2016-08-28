<?php
/**
* Plugin Name: Comment Rating Field Plugin
* Plugin URI: http://www.wpcube.co.uk/plugins/comment-rating-field-pro-plugin
* Version: 2.0.9
* Author: WP Cube
* Author URI: http://www.wpcube.co.uk
* Description: Adds a 5 star rating field to the comments form in WordPress.
* License: GPL2
*/

/*  Copyright 2013 WP Cube (email : support@wpcube.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
* Comment Rating Field Plugin Class
* 
* @package WP Cube
* @subpackage Comment Rating Field Plugin
* @author Tim Carr
* @version 2.0.9
* @copyright WP Cube
*/
class CommentRatingFieldPlugin {

    /**
    * Constructor.
    */
    function __construct() {

        // Plugin Details
        $this->plugin               = new stdClass;
        $this->plugin->name         = 'comment-rating-field-plugin'; // Plugin Folder
        $this->plugin->displayName  = 'Comment Rating Field Plugin'; // Plugin Name
        $this->plugin->version      = '2.0.9';
        $this->plugin->folder       = plugin_dir_path( __FILE__ );
        $this->plugin->url          = plugin_dir_url( __FILE__ );

        // Only include these if the free plugin has a pro / premium version:
        $this->plugin->upgradeReasons = array(
        	array(__('Custom Post Types'), __('Support for rating display and functionality on ANY Custom Post Types and their Taxonomies.')),
        	array(__('Multiple Rating Fields and Groups'), __('Create, edit and delete an unlimited number of rating field groups. Each group can have unlimted rating fields, and be targeted to display on a comment form for a specific Custom Post Type and/or Taxonomy.')),
        	array(__('Widgets'), __('List the Highest Average Rating Posts within your sidebars.')),
        	array(__('Shortcodes'), __('Use a shortcode to display the Average Rating anywhere within your content.')),
        	array(__('Display'), __('Enhanced display options, including to display the average rating on excerpts, content, comments; position the average rating and display a rating breakdown.')),
			array(__('Colors'), __('Define the colours for stars per rating group')),
			array(__('Amazon Bar Chart Rating Breakdown'), __('Choose to output a breakdown of ratings in the same style as Amazon')),
			array(__('Limit Ratings'), __('Prevent reviewers leaving more than one comment rating per Post')),
			array(__('Rich Snippets'), __('Choose a schema (e.g. Review, Product, Place, Person) for your Ratings')),
            array(__('WooCommerce Support'), __('Replace WooCommerce\'s built in reviewing system with a multi field, enhanced one')),
		);             	
        $this->plugin->upgradeURL = 'http://www.wpcube.co.uk/plugins/comment-rating-field-pro-plugin';
        
        // Dashboard Submodule
        if (!class_exists('WPCubeDashboardWidget')) {
			require_once($this->plugin->folder.'/_modules/dashboard/dashboard.php');
		}
		$dashboard = new WPCubeDashboardWidget($this->plugin); 
		
		// Hooks
        add_action('comment_post', array(&$this, 'saveRating')); // Save Rating Field on Comment Post
	    add_action('comment_text', array(&$this, 'displayRating')); // Displays Rating on Comments 
	    add_filter('the_content', array(&$this, 'displayAverageRating')); // Displays Average Rating below Content
		
        if (is_admin()) {
        	add_action('admin_menu', array(&$this, 'adminPanelsAndMetaBoxes'));
        	add_action('wp_set_comment_status', array(&$this, 'updatePostRatingByCommentID')); // Recalculate average rating on comment approval / hold / spam
	        add_action('deleted_comment', array(&$this, 'updatePostRatingByCommentID')); // Recalculate average rating on comment delete
        } else {
        	$this->settings = get_option($this->plugin->name);
        	add_action('wp_enqueue_scripts', array(&$this, 'frontendScriptsAndCSS'));
        	add_action('comment_form_logged_in_after', array(&$this, 'displayRatingField')); // Logged in
	        add_action('comment_form_after_fields', array(&$this, 'displayRatingField')); // Guest
        }
        
        add_action('plugins_loaded', array(&$this, 'loadLanguageFiles'));

    }
    
    /**
    * Register the plugin settings panel
    */
    function adminPanelsAndMetaBoxes() {
        add_menu_page($this->plugin->displayName, $this->plugin->displayName, 'manage_options', $this->plugin->name, array(&$this, 'adminPanel'), 'dashicons-testimonial');
    }
    
	/**
    * Output the Administration Panel
    * Save POSTed data from the Administration Panel into a WordPress option
    */
    function adminPanel() {
        // Save Settings
        if (isset($_POST['submit'])) {
        	delete_option($this->plugin->name);
        	if (isset($_POST[$this->plugin->name])) {
        		update_option($this->plugin->name, $_POST[$this->plugin->name]);
			}
			$this->message = __('Settings Updated.', $this->plugin->name);
        }
        
        // Get latest settings
        $this->settings = get_option($this->plugin->name);
        
		// Load Settings Form
        include_once(WP_PLUGIN_DIR.'/'.$this->plugin->name.'/views/settings.php');  
    }
    
    /**
    * Register and enqueue any JS and CSS for the frontend site
    */
    function frontendScriptsAndCSS() {
    	// JS
    	wp_enqueue_script($this->plugin->name.'-rating', $this->plugin->url.'js/jquery.rating.pack.js', array('jquery'), $this->plugin->version, true);
    	wp_enqueue_script($this->plugin->name.'-frontend', $this->plugin->url.'js/frontend.js', array('jquery'), $this->plugin->version, true);
    	        
    	// CSS
        wp_enqueue_style($this->plugin->name.'-rating', $this->plugin->url.'css/rating.css', array(), $this->plugin->version); 
    }
    
	/**
    * Saves the POSTed rating for the given comment ID to the comment meta table,
    * as well as storing the total ratings and average on the post itself.
    * 
    * @param int $commentID
    */
    function saveRating($commentID) {
    	// Save rating against comment
        add_comment_meta($commentID, 'crfp-rating', $_POST['crfp-rating'], true);
        
        // Get post ID from comment and store total and average ratings against post
        // Run here in case comments are set to always be approved
        $this->updatePostRatingByCommentID($commentID); 
    }
    
    /**
    * Calculates the average rating and total number of ratings
    * for the given post ID, storing it in the post meta.
    *
    * @param int @postID Post ID
    * @return bool Rating Updated
    */
    function updatePostRatingByPostID($postID) {
    	global $wpdb;	
    	
    	// Get all approved comments and total the number of ratings and rating values for fields
		$comments = get_comments(array(
			'post_id' 	=> $postID,
			'status' 	=> 'approve',
		));
		
		// Calculate
		$totalRating = 0;
		$totalRatings = 0;
        $averageRating = 0;
        if (is_array($comments) AND count($comments) > 0) {
			// Iterate through comments
			foreach ($comments as $comment) { 
				$rating = get_comment_meta($comment->comment_ID, 'crfp-rating', true);
				if ($rating > 0) {
					$totalRatings++;
					$totalRating += $rating;
				}
	        }
	        
	        // Calculate average rating
	        $averageRating = (($totalRatings == 0 OR $totalRating == 0) ? 0 : round(($totalRating / $totalRatings), 0));
        }

        update_post_meta($postID, 'crfp-total-ratings', $totalRatings);
        update_post_meta($postID, 'crfp-average-rating', $averageRating);
		
		return true;
    }

    /**
    * Called by WP action, passes function call to UpdatePostRatingByPostID
    *
    * @param int $commentID Comment ID
    * @return int Comment ID
    */
    function updatePostRatingByCommentID($commentID) {
    	$comment = get_comment($commentID);
    	$this->updatePostRatingByPostID($comment->comment_post_ID);
    	return true;
    }
    
    /**
    * Checks if the post can have a rating
    *
    * @return bool Post can have rating
    */
    function postCanHaveRating() {
		global $post;

    	$displayRatingField = false; // Don't display rating field by default
    	wp_reset_query(); // Reset to default loop query so we can test if a single Page or Post

    	if (!is_array($this->settings)) return; // No settings defined
    	if ($post->comment_status != 'open') return; // Comments are no longer open
    	if (!is_singular()) return; // Not a single Post
		
    	// Check if post type is enabled
    	$type = get_post_type($post->ID);
    	if (is_array($this->settings['enabled']) AND isset($this->settings['enabled'][$type])) {
    		// Post type enabled, regardless of taxonomies
    		$displayRatingField = true;	
    	} elseif (is_array($this->settings['taxonomies'])) {    	
	    	// Get all terms assigned to this Post
	    	// Check if we need to display ratings here
			$taxonomies = get_taxonomies();
			$ignoreTaxonomies = array('post_tag', 'nav_menu', 'link_category', 'post_format');
			foreach ($taxonomies as $key=>$taxonomyProgName) {
				if (in_array($taxonomyProgName, $ignoreTaxonomies)) continue; // Skip ignored taxonomies
				if (!is_array($this->settings['taxonomies'][$taxonomyProgName])) continue; // Skip this taxonomy
				
				// Get terms and build array of term IDs
				unset($terms, $termIDs);
				$terms = wp_get_post_terms($post->ID, $taxonomyProgName);
				foreach ($terms as $key=>$term) $termIDs[] = $term->term_id;

				// Check if any of the post term IDs have been selected within the plugin
				if ($termIDs) {
					foreach ($this->settings['taxonomies'][$taxonomyProgName] as $termID=>$intVal) {
						if (in_array($termID, $termIDs)) {
		    				$displayRatingField = true;
		    				break;
		    			}	
					}
				}
	    	}
    	}

    	return $displayRatingField;
    }

    /**
    * Displays the Average Rating below the Content, if required
    *
    * @param string $content Post Content
    * @return string Post Content w/ Ratings HTML
    */
    function displayAverageRating($content) {
        global $post;
        
        if (!isset($this->settings['enabled']['average'])) return $content; // Don't display average
        $averageRating = get_post_meta($post->ID, 'crfp-average-rating', true); // Get average rating

        // Check if the meta key exists; if not go and run the calculation
        if ($averageRating == '') {
        	$this->updatePostRatingByPostID($post->ID);
        	$averageRating = get_post_meta($post->ID, 'crfp-average-rating', true); // Get average rating
        }

        // If still no rating, a rating has never been left, so don't display one
        if ($averageRating == '' OR $averageRating == 0) return $content;
        
        // Build rating HTML
        $ratingHTML = '<div class="crfp-average-rating">'.$this->settings['averageRatingText'].'<div class="crfp-rating crfp-rating-'.$averageRating.'"></div></div>';
        
        // Return rating widget with content
        return $content.$ratingHTML;   
    }
    
    /**
    * Appends the rating to the end of the comment text for the given comment ID
    * 
    * @param text $comment
    */
    function displayRating($comment) {
        global $post;

        $commentID = get_comment_ID();
        
        // Check whether we need to display ratings
        if (!isset($this->display) OR !$this->display) { // Prevents checking for every comment in a single Post
        	$this->display = $this->postCanHaveRating();
    	}

        // Display rating?
        if ($this->display) {
            $rating = get_comment_meta($commentID, 'crfp-rating', true);
            if ($rating == '') $rating = 0;
            return $comment.'<div class="rating"><div class="crfp-rating crfp-rating-'.$rating.'">'.$rating.'</div></div>';
        }
        
        // Just return comment without rating
        return $comment;  
    }  
    
    /**
    * Appends the rating field to the end of the comment form, if required
    */
    function displayRatingField() {
    	if (!$this->postCanHaveRating()) return;
    	?>
		<!-- CRFP Fields: Start -->
		<p class="crfp-field">
	        <?php
	        if (isset($this->settings['ratingFieldLabel']) AND !empty($this->settings['ratingFieldLabel'])) {
	        	?>
	        	<label for="rating-star"><?php echo $this->settings['ratingFieldLabel']; ?></label>
	        	<?php	
	        }
	        ?>
	        <input name="rating-star" type="radio" class="star" value="1" />
	        <input name="rating-star" type="radio" class="star" value="2" />
	        <input name="rating-star" type="radio" class="star" value="3" />
	        <input name="rating-star" type="radio" class="star" value="4" />
	        <input name="rating-star" type="radio" class="star" value="5" />
	        <input type="hidden" name="crfp-rating" value="0" />
	    </p>
	    <!-- CRFP Fields: End -->
		<?php		
    }  
    
    /**
	* Loads plugin textdomain
	*/
	function loadLanguageFiles() {
		load_plugin_textdomain($this->plugin->name, false, $this->plugin->name.'/languages/');
	}
}
$crfp = new CommentRatingFieldPlugin();
?>
