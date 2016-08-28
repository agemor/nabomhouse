<div class="wrap">
    <div id="crfp-title" class="icon32"></div> 
    <h2><?php echo $this->plugin->displayName; ?> &raquo; <?php _e('Settings'); ?></h2>
           
    <?php    
    if ($this->message != '') {
        ?>
        <div class="updated"><p><?php echo $this->message; ?></p></div>  
        <?php
    }
    if ($this->errorMessage != '') {
        ?>
        <div class="error"><p><?php echo $this->errorMessage; ?></p></div>  
        <?php
    }
    ?>        
        
    <form id="post" name="post" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <div id="poststuff" class="metabox-holder">
            <!-- Content -->
            <div id="post-body">
                <div id="post-body-content">
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable" style="position: relative;">                        
                        <!-- Settings -->
                        <div class="postbox">
                            <h3 class="hndle"><?php _e('Display Settings'); ?></h3>
                            
                                <p>
                                    <strong><?php _e('Enable on Pages'); ?></strong>
                                    <input type="checkbox" name="<?php echo $this->plugin->name; ?>[enabled][page]" value="1"<?php echo ($this->settings['enabled']['page'] == 1 ? ' checked' : ''); ?> />   
                                </p>
                                <p class="description"><?php _e('Displays ratings and the rating field on Pages with comments enabled.'); ?></p>

                                <p><strong><?php _e('Enable on Post Categories'); ?></strong></p>
                                <p>
                                    <label class="screen-reader-text" for="label"><?php _e('Enable on Post Categories'); ?></label>
                                    <?php    
                                    $categories = get_categories('hide_empty=0&taxonomy=category');
                                    foreach ($categories as $key=>$category) {
                                        if ($category->slug == 'uncategorized') continue; // Skip Uncategorized
                                        ?>
                                        <input type="checkbox" name="<?php echo $this->plugin->name; ?>[taxonomies][category][<?php echo $category->term_id; ?>]" value="1"<?php echo ($this->settings['taxonomies']['category'][$category->term_id] == 1 ? ' checked' : ''); ?> /> <?php echo $category->name; ?><br />       
                                        <?php
                                    }
                                    ?>
                                </p>
                                <p class="description"><?php _e('Displays ratings and the rating field on Posts with comments enabled that are assigned to the selected categories.'); ?></p>
                                
                                <p>
                                    <strong><?php _e('Display Average Rating'); ?></strong>
                                    <input type="checkbox" name="<?php echo $this->plugin->name; ?>[enabled][average]" value="1"<?php echo ($this->settings['enabled']['average'] == 1 ? ' checked' : ''); ?> />   
                                </p>
                                <p class="description"><?php _e('Displays the average rating based on the average of all ratings for the given Page or Post.'); ?></p>
                                
                                <p>
                                    <strong><?php _e('Average Rating Text'); ?></strong>
                                    <input type="text" name="<?php echo $this->plugin->name; ?>[averageRatingText]" value="<?php echo ($this->settings['averageRatingText']); ?>" class="widefat" />   
                                </p>
                                <p class="description"><?php _e('If Display Average Rating above is selected, optionally define text to appear before the average rating stars are displayed.'); ?></p>
                                
                                <p>
                                    <strong><?php _e('Rating Field Label'); ?></strong>
                                    <input type="text" name="<?php echo $this->plugin->name; ?>[ratingFieldLabel]" value="<?php echo ($this->settings['ratingFieldLabel']); ?>" class="widefat" />   
                                </p>
                                <p class="description"><?php _e('The text to display for the rating form field label. If blank, no label is displayed.'); ?></p>
                            </div>
                        </div>
                        
                        <!-- Go Pro -->
                        <div class="postbox">
                            <h3 class="hndle"><?php _e('Pro Settings and Support'); ?></h3>
                            <div class="inside">
                            	<p><?php echo __('Upgrade to '.$this->plugin->displayName.' Pro to configure additional options, including:'); ?></p>
                            	<ul>
                            		<li><strong><?php _e('Support'); ?>: </strong><?php _e('Access to support ticket system and knowledgebase.'); ?></li>
                            		<li><strong><?php _e('Custom Post Types'); ?>: </strong><?php _e('Support for rating display and functionality on ANY Custom Post Types and their Taxonomies.'); ?></li>
                            		<li><strong><?php _e('Widgets'); ?>: </strong><?php _e('List the Highest Average Rating Posts within your sidebars.'); ?></li>
                            		<li><strong><?php _e('Shortcodes'); ?>: </strong><?php _e('Use a shortcode to display the Average Rating anywhere within your content.'); ?></li>
                            		<li><strong><?php _e('Rating Field'); ?>: </strong><?php _e('Make rating field a required field, and choose to display it above or below the other fields on the comments form.'); ?></li>
                            		<li><strong><?php _e('Display Average Rating'); ?>: </strong><?php _e('Choose to display average rating above or below the content and/or excerpts.'); ?></li>
                            		<li><strong><?php _e('Seamless Upgrade'); ?>: </strong><?php _e('Retain all current settings and ratings when upgrading to Pro.'); ?></li>
                            	</ul>
                            	<p><a href="http://www.wpcube.co.uk/plugins/comment-rating-field-pro-plugin/" target="_blank" class="button button-primary">Upgrade Now</a></p>
                            </div>
                        </div>

                        <!-- Save -->
                        <div class="submit">
                            <input type="submit" name="submit" class="button button-primary" value="<?php _e('Save'); ?>" /> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>