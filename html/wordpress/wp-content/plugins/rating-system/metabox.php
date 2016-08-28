<?php
add_action( 'load-post.php', 'vortex_rating_system_metabox' );
add_action( 'load-post-new.php', 'vortex_rating_system_metabox' );

function vortex_rating_system_metabox() {

  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'vortex_rating_system_add_post_meta_boxes' );
  
   /* Save post meta on the 'save_post' hook. */
  add_action( 'save_post', 'vortex_meta_box_saving', 10, 2 );
  
}

function vortex_rating_system_add_post_meta_boxes() {
	
		$args = array(
		   '_builtin' => false,
		   'public'		=> true
		);
		
		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'

		$post_types = get_post_types( $args, $output, $operator );
	
		$post_types['post'] = 'post';
		$post_types['page'] = 'page';
		
		global $vortex_like_dislike;
		
		$array = array();
	
		if(!(empty($vortex_like_dislike['v_exclude_post_types-p']))){
			$array = $vortex_like_dislike['v_exclude_post_types-p'];
		}
	
			foreach ( $post_types  as $post_type ) {
				
					if(!in_array($post_type,$array)){
						
					add_meta_box(
							'vortex-ra-custom-meta-box',      // Unique ID
							esc_html__( 'Rating System', 'vortex_system_ld' ),    // Title
							'rating_system_post_class_meta_box',   // Callback function
							$post_type,         // Admin page (or post type)
							'side',         // Context
							'default'         // Priority
						);
					}	
			}
	
}

function rating_system_post_class_meta_box($object, $box){
	
	$likes   = get_post_meta($object->ID, 'vortex_system_likes', true);
	if(empty($likes)){
		$likes = 0;
	}

	$dislikes   = get_post_meta($object->ID, 'vortex_system_dislikes', true);
	if(empty($dislikes)){
		$dislikes = 0;
	}
	
	wp_nonce_field( basename( __FILE__ ), 'vortex_system_metabox_nonce' );
	
	?><div style="line-height:22px">
		<table width="100%">
			<tr>
				<td width="50%" align="center">
					<span style="margin-top:6px;" class="dashicons dashicons-thumbs-up"></span>
					<b>&nbsp;<input min="0" name="vortex_meta_likes" type="number" style="width:55px;" value="<?php echo esc_attr($likes); ?>"></input></b>
				</td>
				<td width="50%" align="center">
					<span style="margin-top:6px;" class="dashicons dashicons-thumbs-down"></span>
					<b>&nbsp;<input min="0" name="vortex_meta_dislikes" type="number" style="width:55px;" value="<?php echo esc_attr($dislikes); ?>"></input></b>
				</td>
			</tr>
		</table>
	</div>
<?php	
}

function vortex_meta_box_saving($post_id, $post){
	
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['vortex_system_metabox_nonce'] ) || !wp_verify_nonce( $_POST['vortex_system_metabox_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
	
	if(isset($_POST['vortex_meta_likes']) && isset($_POST['vortex_meta_dislikes'])){
		
		$likes = absint($_POST['vortex_meta_likes']);
		$dislikes = absint($_POST['vortex_meta_dislikes']);
		$ml = 'vortex_system_likes';
		$md = 'vortex_system_dislikes';
		
		update_post_meta($post_id,$ml,$likes);
		update_post_meta($post_id,$md,$dislikes);
	}
	
	
}