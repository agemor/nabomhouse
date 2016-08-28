
	function like(event){
		event.preventDefault();
		var has_id = jQuery(this).prev();
		var id = has_id.val();
		like_ajax(id);
	}
	
	function like_ajax(id){

			var like = jQuery('.vortex-p-like-counter.'+id);
			like.text(vortex_login.text);
	}
	
	
	function dislike(event){
		event.preventDefault();
		var has_id = jQuery(this).prev();
		var id = has_id.val();
		dislike_ajax(id);
	}
	
	function dislike_ajax(id){
			var dislike = jQuery('.vortex-p-dislike-counter.'+id);
			dislike.text(vortex_login.text);
	}

jQuery(document).ready(function() {
	jQuery(document.body).off('click.vortexlike','.vortex-p-like').one('click.vortexlike','.vortex-p-like',like);
	jQuery(document.body).off('click.vortexdislike','.vortex-p-dislike').one('click.vortexdislike','.vortex-p-dislike',dislike);
});