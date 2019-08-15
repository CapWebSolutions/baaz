jQuery(document).ready(function(){
    // jQuery(function($){
	jQuery('#testimonials .slide');
	setInterval(function(){
		jQuery('#testimonials .slide').filter(':visible').fadeOut(1000,function(){
			if(jQuery(this).next('.slide').size()){
				jQuery(this).next().fadeIn(1000);
			}
			else{
				jQuery('#testimonials .slide').eq(0).fadeIn(1000);
			}
		});
	},4000);	
});	