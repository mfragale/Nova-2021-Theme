jQuery(document).ready(function ($) {



	// Side Menu http://www.hongkiat.com/blog/jquery-sliding-navigation/ --------------------------------------------

	$(".hamburger").on("click", function (e) {
		e.preventDefault();
		$(".hamburger").toggleClass("is-active");
		$('#fullscreenmenu').toggleClass("is-active");
	});




}); // jQuery