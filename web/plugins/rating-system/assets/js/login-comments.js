	function like_comment(event){
		event.preventDefault();
		var has_id = jQuery(this).parent().children('input');
		var id = has_id.val();
		like_ajax_comment(id);
	}
	
	function like_ajax_comment(id){
		
				
			var like = jQuery('.vortex-p-like-counter-comment.'+id);
			like.text(vortex_login_comment.text);
	}
	
	
	function dislike_comment(event){
		event.preventDefault();
		var has_id = jQuery(this).parent().children('input');
		var id = has_id.val();
		dislike_ajax_comment(id);
	}
	
	function dislike_ajax_comment(id){
		
			var dislike = jQuery('.vortex-p-dislike-counter-comment.'+id);
			dislike.text(vortex_login_comment.text);
	}

jQuery(document).ready(function() {
	jQuery(document.body).off('click.vortexlikecomment','.vortex-p-like-comment').one('click.vortexlikecomment','.vortex-p-like-comment',like_comment);
	jQuery(document.body).off('click.vortexdislikecomment','.vortex-p-dislike-comment').one('click.vortexdislikecomment','.vortex-p-dislike-comment',dislike_comment);
});