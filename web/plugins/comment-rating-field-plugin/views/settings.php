<div class="wrap">
    <div id="<?php echo $this->plugin->name; ?>-title" class="icon32"></div> 
    <h2 class="wpcube"><?php echo $this->plugin->displayName; ?> &raquo; <?php _e('Settings'); ?></h2>
           
    <?php    
    if (isset($this->message)) {
        ?>
        <div class="updated fade"><p><?php echo $this->message; ?></p></div>  
        <?php
    }
    if (isset($this->errorMessage)) {
        ?>
        <div class="error fade"><p><?php echo $this->errorMessage; ?></p></div>  
        <?php
    }
    ?> 
    
    <div id="poststuff">
    	<div id="post-body" class="metabox-holder columns-2">
    		<!-- Content -->
    		<div id="post-body-content">
    		
    			<!-- Form Start -->
		        <form id="post" name="post" method="post" action="admin.php?page=<?php echo $this->plugin->name; ?>">
		            <div id="normal-sortables" class="meta-box-sortables ui-sortable">                        
		                <div class="postbox">
		                    <h3 class="hndle"><?php _e('Display Settings', $this->plugin->name); ?></h3>
		                    
		                    <div class="option">
		                    	<p>
		                    		<strong><?php _e('Enable on Pages', $this->plugin->name); ?></strong>
		                    	    <input type="checkbox" name="<?php echo $this->plugin->name; ?>[enabled][page]" value="1"<?php echo (isset($this->settings['enabled']['page']) ? ' checked' : ''); ?> />   
		                    	</p>
		                    </div>
		                    
		                    <div class="option">
		                    	<p>
		                    		<strong><?php _e('Enable on Posts', $this->plugin->name); ?></strong>
		                    	    <input type="checkbox" name="<?php echo $this->plugin->name; ?>[enabled][post]" value="1"<?php echo (isset($this->settings['enabled']['post']) ? ' checked' : ''); ?> />   
		                    	</p>
		                    </div>
		                    
		                    <div class="option">
		                    	<p>
		                    		<strong><?php _e('Enable on Categories', $this->plugin->name); ?></strong>
		                    		<?php    
                                    $categories = get_categories('hide_empty=0&taxonomy=category');
                                    foreach ($categories as $key=>$category) {
                                        if ($category->slug == 'uncategorized') continue; // Skip Uncategorized
                                        ?>
                                        <label for="cat-<?php echo $category->slug; ?>">
			                    			<input type="checkbox" name="<?php echo $this->plugin->name; ?>[taxonomies][category][<?php echo $category->term_id; ?>]" id="cat-<?php echo $category->slug; ?>" value="1"<?php echo (isset($this->settings['taxonomies']['category'][$category->term_id]) ? ' checked' : ''); ?> />      
                                        	<?php echo $category->name; ?>
			                    		</label><br /><strong>&nbsp;</strong>
		                    		    <?php
                                    }
                                    ?>
		                    	</p>
		                    	<p class="description">
		                    		<?php _e('Displays ratings and the rating field on Posts with comments enabled that are assigned to the selected categories.'); ?>
                                </p>
		                    </div>
		                    
		                    <div class="option">
		                    	<p>
		                    		<strong><?php _e('Display Average', $this->plugin->name); ?></strong>
		                    	    <input type="checkbox" name="<?php echo $this->plugin->name; ?>[enabled][average]" value="1"<?php echo (isset($this->settings['enabled']['average']) ? ' checked' : ''); ?> />   
		                    	</p>
                                <p class="description">
                                	<?php _e('Displays the average rating based on the average of all ratings for the given Page or Post.'); ?>
                                </p>
                            </div>
                            
                            <div class="option">
		                    	<p>
		                    		<strong><?php _e('Average Rating Text', $this->plugin->name); ?></strong>
		                    		<input type="text" name="<?php echo $this->plugin->name; ?>[averageRatingText]" value="<?php echo (isset($this->settings['averageRatingText']) ? $this->settings['averageRatingText'] : ''); ?>" />
		                    	</p>
		                        <p class="description">
		                        	<?php _e('If Display Average Rating above is selected, optionally define text to appear before the average rating stars are displayed.'); ?>
		                        </p>
                            </div>
                            
                            <div class="option">
		                    	<p>
		                    		<strong><?php _e('Rating Field Label', $this->plugin->name); ?></strong>
		                    		<input type="text" name="<?php echo $this->plugin->name; ?>[ratingFieldLabel]" value="<?php echo (isset($this->settings['ratingFieldLabel']) ? $this->settings['ratingFieldLabel'] : ''); ?>" />
		                    	</p>
		                        <p class="description">
		                        	<?php _e('The text to display for the rating form field label. If blank, no label is displayed.'); ?>
		                        </p>
                            </div>
                            
                            <div class="option">
                            	<p>
									<input type="submit" name="submit" value="<?php _e('Save', $this->plugin->name); ?>" class="button button-primary" /> 
		                		</p>
                            </div>
		                </div>
		                <!-- /postbox -->
					</div>
					<!-- /normal-sortables -->
			    </form>
			    <!-- /form end -->
    			
    		</div>
    		<!-- /post-body-content -->
    		
    		<!-- Sidebar -->
    		<div id="postbox-container-1" class="postbox-container">
    			<?php require_once($this->plugin->folder.'/_modules/dashboard/views/sidebar-upgrade.php'); ?>		
    		</div>
    		<!-- /postbox-container -->
    	</div>
	</div> 
	
	<!-- If this plugin has a pro/premium version, include this + change sidebar-donate = sidebar-upgrade -->
	<div id="poststuff">
    	<div id="post-body" class="metabox-holder columns-1">
    		<div id="post-body-content">
    			<?php require_once($this->plugin->folder.'/_modules/dashboard/views/footer-upgrade.php'); ?>
    		</div>
    	</div>
    </div>        
</div>