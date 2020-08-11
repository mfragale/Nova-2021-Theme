jQuery(document).ready(function ($) {



	// Fullscreen Menu http://www.hongkiat.com/blog/jquery-sliding-navigation/ --------------------------------------------

	$(".hamburger").on("click", function (e) {
		e.preventDefault();
		$(".hamburger").toggleClass("is-active");
		$('#fullscreenmenu').toggleClass("is-active");
	});

	// Close Fullscreen Menu by pressing esc
	$('body').keydown(function(e){
		if (e.which==27){
			$(".hamburger").toggleClass("is-active");
			$('#fullscreenmenu').toggleClass("is-active");
		}
	});



	
}); // jQuery
