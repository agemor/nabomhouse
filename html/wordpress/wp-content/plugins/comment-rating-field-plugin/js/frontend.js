jQuery(document).ready(function($) {
    // Invoke Rating Plugin
	$('p.crfp-field').each(function() {
		$('input.star', $(this)).rating({
			cancel: 'Cancel',
			cancelValue: 0,
			callback: function(rating) {
				var parentElement = $(this).closest('.crfp-field');
				$('input[type=hidden]', $(parentElement)).val(rating);
			}
		});
	});
    
    // Reset to zero if cancel clicked
    $('div.rating-cancel a').bind('click', function(e) { 
        var parentElement = $(this).closest('.crfp-field');
        $('input[type=hidden]', $(parentElement)).val('0');     
    });
});