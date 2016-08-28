<?php
/**
* Plugin Name: Rating System
* Plugin URI: http://github.com/AlexAlexandru/rating-system
* Description: The simple way to add like or dislike buttons.
* Version: 2.7.5
* Author: AlexAlexandru
* Author URI: https://github.com/AlexAlexandru
* License: GPL2
* Text Domain: vortex_system_ld
* Domain Path: /languages
*/
if ( ! defined( 'ABSPATH' ) ) exit;//exit if accessed directly

function vortex_ra_read_cookie($name,$postid){
	if(isset($_COOKIE[$name])){
		$decode = json_decode($_COOKIE[$name]);
		$found = array_search($postid, $decode);

		if ($found !== false) {
			return 'found';
		} else {
			return 'notfound';
		}
	}else{
		return 'notfound';
	}
}

function vortex_ra_cookie($name,$postid,$name2){
	if(vortex_ra_read_cookie($name2,$postid) == 'found' && vortex_ra_read_cookie($name,$postid) == 'notfound'){

		$decode2 = json_decode($_COOKIE[$name2]);
		$decode2 = array_diff($decode2, array($postid));
		$encode2 = json_encode(array_values($decode2));
		setcookie($name2,$encode2,time()+ 2419200,'/',COOKIE_DOMAIN,is_ssl(),true);
		
		if(!isset($_COOKIE[$name])){
			$decode = array();
		}else{
			$decode = json_decode($_COOKIE[$name]);
		}

		array_push($decode,$postid);
		$encode = json_encode($decode);
		setcookie($name,$encode,time()+ 2419200,'/',COOKIE_DOMAIN,is_ssl(),true);
		
	}elseif(!isset($_COOKIE[$name])){
		$array = json_encode(array($postid));
		setcookie($name,$array,time()+ 2419200,'/',COOKIE_DOMAIN,is_ssl(),true);
	}else{
		$decode = json_decode($_COOKIE[$name]);
		if(!in_array($postid,$decode)){
			array_push($decode,$postid);
			$encode = json_encode($decode);
			setcookie($name,$encode,time()+ 2419200,'/',COOKIE_DOMAIN,is_ssl(),true);
		}else{
			$decode = json_decode($_COOKIE[$name]);
			$decode = array_diff($decode, array($postid));
			$encode = json_encode(array_values($decode));
			setcookie($name,$encode,time()+ 2419200,'/',COOKIE_DOMAIN,is_ssl(),true);
		}
	}
}

function vortex_rating_require_tgmpa(){
	//tgmpa
include(plugin_dir_path( __FILE__).'tgmpa/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'vortex_register_plugin' );

function vortex_register_plugin() {

	$plugins = array(
		array(
			'name'      => 'Redux Framework',
			'slug'      => 'redux-framework',
			'required'  => true,
		),
	);

	$config = array(
		'id'           => 'vortex-tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'vortex-install-plugins', // Menu slug.
		'parent_slug'  => 'plugins.php',            // Parent menu slug.
		'capability'   => 'edit_plugins',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => __('Rating System','vortex_system_ld'), // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		
		
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
			'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
			'installing'                      => __( 'Installing Plugin: %s', 'theme-slug' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'theme-slug' ),
			'notice_can_install_required'     => _n_noop(
				'This plugin requires the following plugin: %1$s.',
				'This plugin requires the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This plugin recommends the following plugin: %1$s.',
				'This plugin recommends the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this plugin: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this plugin: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'theme-slug'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'theme-slug'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'theme-slug'
			),
		),
		
	);

	tgmpa( $plugins, $config );
}
}
add_action('plugins_loaded','vortex_rating_require_tgmpa');

//require all usefull stuffs
function vortex_systen_main_function(){

	if(!function_exists('is_plugin_active')){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}
	if(class_exists('myCRED_Hook')){
		include(plugin_dir_path( __FILE__ ).'mycredcomments.php');
		include(plugin_dir_path( __FILE__ ).'mycredposts.php');
		function vortex_mycred_references_filter($references){
			$references['vortex_like_posts_mycred_author_content'] = __( 'Receive like for posts(content author)', 'vortex_system_ld' );
			$references['vortex_like_posts_mycred_author'] = __( 'Receive like for posts(like author)', 'vortex_system_ld' );
			$references['vortex_like_coms_mycred_author_content'] = __( 'Receive like for comments(content author)', 'vortex_system_ld' );
			$references['vortex_like_coms_mycred_author'] = __( 'Receive like for comments(like author)', 'vortex_system_ld' );
			return $references;
		}
		add_filter('mycred_all_references','vortex_mycred_references_filter');
	}
	
	if(function_exists('is_plugin_active')){
		if(is_plugin_active('redux-framework/redux-framework.php')){
			load_plugin_textdomain( 'vortex_system_ld', FALSE, basename(plugin_dir_path( __FILE__ )). '/languages' );
			$reduxoption = plugin_dir_path( __FILE__).'admin/vortexlikedislike.php';
			$reduxframework = plugin_dir_path(plugin_dir_path( __FILE__ )).'redux-framework/ReduxCore/framework.php';
		
				if ( !class_exists( 'ReduxFramework' ) && file_exists($reduxframework) ) {
					include($reduxframework);
				};
				if ( !isset( $vortex_like_dislike ) && file_exists($reduxoption) ) {
					include($reduxoption);
				};
	
				//donation button
				function vortex_system_donation_button(){
					echo '<form style="width:260px;margin:0 auto;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="VVGFFVJSFVZ7S">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</form>
						';
				}
				add_action('redux/vortex_like_dislike/panel/before','vortex_system_donation_button');
				add_action('redux/vortex_like_dislike/panel/after','vortex_system_donation_button');
				
				Redux::init('vortex_like_dislike');
				
				global $vortex_like_dislike;
				
				if($vortex_like_dislike['v-switch-posts'] && isset($vortex_like_dislike['v-switch-posts'])){
					include(plugin_dir_path( __FILE__ ).'posts-pages.php');
					//load metabox
					include(plugin_dir_path( __FILE__).'metabox.php');
				}
				
				if($vortex_like_dislike['v-switch-comments'] && isset($vortex_like_dislike['v-switch-comments'])){
					include(plugin_dir_path( __FILE__ ).'comments.php');
				}
				
				//add custom fields when comment is submited
				add_action('comment_post', 'vortex_system_add_likes_dislikes_comments');
				function vortex_system_add_likes_dislikes_comments($comment_ID) {
					global $vortex_like_dislike;
					$likes = 0;
					$dislikes = 0;
					
					if(isset($vortex_like_dislike['v_start_comment_like'])){
						$likes = $vortex_like_dislike['v_start_comment_like'];
					}
					
					if(isset($vortex_like_dislike['v_start_comment_dislike'])){
						$dislikes = $vortex_like_dislike['v_start_comment_dislike'];
					}
					add_comment_meta($comment_ID, 'vortex_system_likes', $likes, true);
					add_comment_meta($comment_ID, 'vortex_system_dislikes', $dislikes, true);
				}

				//add custom fields when post is published
				add_action( 'publish_post', 'post_published_notification' );
				function post_published_notification( $ID ) {
					global $vortex_like_dislike;
					$likes = 0;
					$dislikes = 0;
					
					if(isset($vortex_like_dislike['v_start_post_like'])){
						$likes = $vortex_like_dislike['v_start_post_like'];
					}
					
					if(isset($vortex_like_dislike['v_start_post_dislike'])){
						$dislikes = $vortex_like_dislike['v_start_post_dislike'];
					}
					add_post_meta($ID, 'vortex_system_likes', $likes, true);
					add_post_meta($ID, 'vortex_system_dislikes', $dislikes, true);
				}
			}		
	}	
}

add_action('plugins_loaded','vortex_systen_main_function');

function rating_system_load_widgets(){
	$widget = plugin_dir_path( __FILE__ ).'widget/widget.php';
	if(file_exists($widget)){
		include( $widget );
	}
}
add_action('plugins_loaded','rating_system_load_widgets');
//add shortcode
function vortex_rating_system_register_shortcodes(){

		function vortex_shortcode_render_posts($atts){
				extract( shortcode_atts(  array(
					'counter' => "yes",
				), $atts ) );
				
				if($counter == "yes"){
					return vortex_render_for_posts(true,true);
				}else{
					return vortex_render_for_posts(true,false);
				}
		}
		
		function vortex_shortcode_render_posts_disable_dislike($atts){
				extract( shortcode_atts(  array(
					'counter' => true,
				), $atts ) );
				
				
				if($counter == "yes"){
					return vortex_render_for_posts(false,true);
				}else{
					return vortex_render_for_posts(false,false);
				}
		}
		
		function vortex_shortcode_render_comments(){
				return vortex_render_for_comments();
		}
		
		function vortex_shortcode_render_comments_disable_dislike(){
				return vortex_render_for_comments(false);
		}
		
		function vortex_shortcode_render_top_posts($atts){
			
			extract( shortcode_atts(  array(
				'number' => '5',
				'display_counter' => 'yes',
				'display_content' => 'no',
				'link_to_post'	  => 'yes',
				'category_slugs'	=> '',
			), $atts ) );
			
			$args = array(
					'orderby'			=> 'meta_value_num',
					'meta_key'			=> 'vortex_system_likes',
					'post_type' 		=> 'post',
					'post_status'		=> 'publish',
					'posts_per_page'	=> $number,
					'category_name'		=> $category_slugs

			);	
			// The Query
			$query = new WP_Query( $args );
			// The Loop
			if ( $query->have_posts() ) {
				
				echo '<ul>';
				while ( $query->have_posts() ) {
					$query->the_post();
						$current_likes = get_post_meta(get_the_ID(),'vortex_system_likes',true);
						echo '<li class="top-posts '.get_the_ID().' ">';
						echo '<div class="top-posts-title '.get_the_ID().'">';
						if($link_to_post == "yes"){
								echo '<a class="top-posts-link '.get_the_ID().'" href="'.get_the_permalink().'">'.get_the_title().'</a>';
						} else {
								the_title();
						}
							
						if($display_counter == 'yes'){
							echo ' '.$current_likes.' likes';
						}
						echo '</div>';
						
						if($display_content == 'yes'){
							echo '<div class="top-posts-content '.get_the_ID().'">';
								echo get_the_content();
							echo '</div>';
						}
						
						echo '</li>';
				}
				echo '</ul>';
			} else {
				echo 'No posts found.';
			}
			// Restore original Post Data
			wp_reset_postdata();
			
		}
		
		add_shortcode('rating-system-top-posts', 'vortex_shortcode_render_top_posts');
		
		add_shortcode('rating-system-posts', 'vortex_shortcode_render_posts');
		add_shortcode('rating-system-posts-disable-dislike', 'vortex_shortcode_render_posts_disable_dislike');
		
		add_shortcode('rating-system-comments', 'vortex_shortcode_render_comments');
		add_shortcode('rating-system-comments-disable-dislike', 'vortex_shortcode_render_comments_disable_dislike');
}
add_action( 'init', 'vortex_rating_system_register_shortcodes');

