/*function specs_change_logo_mode(mode){
	switch (mode) {
		case true:
			jQuery('#section-site_logo').removeClass('hidden');
			jQuery('#section-site_logo_mini').removeClass('hidden');
			break;
		case false:
			jQuery('#section-site_logo').addClass('hidden');
			jQuery('#section-site_logo_mini').addClass('hidden');
			break;
	}
}
jQuery(document).ready(function() {
	jQuery('input[id="show_logo"]').click(function() {
		//alert(jQuery(this).is(":checked"));
		specs_change_logo_mode(jQuery(this).is(":checked"));
	});
	specs_change_logo_mode(jQuery('input[id="show_logo"]').is(":checked"));
})*/
function specs_change_background_mode(mode){
	switch(mode){
		case 'image':
			jQuery('.background_image').removeClass('hidden');
			jQuery('.background_pattern, .background_color').addClass('hidden');
		break;
		case 'pattern':
			jQuery('.background_pattern').removeClass('hidden');
			jQuery('.background_color, .background_image').addClass('hidden');
		break;
		case 'color':
			jQuery('.background_color').removeClass('hidden');
			jQuery('.background_pattern, .background_image').addClass('hidden');
		break;
	}
}
jQuery(document).ready(function() {
	jQuery('input[name="9iphp[background_mode]"]').click(function() {
		specs_change_background_mode(jQuery(this).val());
	});
	specs_change_background_mode(jQuery('input[name="9iphp[background_mode]"]:checked').val());
})
