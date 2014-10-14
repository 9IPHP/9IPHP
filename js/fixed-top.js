if(jQuery(window).width() > 768){

	//alert(111);
	// Shrink menu on scroll
	var didScroll = false;
	jQuery(window).scroll(function() {
		didScroll = true;
	});
	var y;
	setInterval(function() {
		if ( didScroll ) {
			didScroll = false;
			y = jQuery(window).scrollTop();
			//alert(y);
			if(y > 75){
				jQuery('#nav').addClass('fixed');
			}else{
				jQuery('#nav').removeClass('fixed');
			}
		}
	}, 50);
};