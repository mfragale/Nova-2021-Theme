jQuery(function () {


	// Fullscreen Menu http://www.hongkiat.com/blog/jquery-sliding-navigation/
	$(".hamburger").on("click", function (e) {
		e.preventDefault();
		$(".hamburger").toggleClass("is-active");
		$('#fullscreenmenu').toggleClass("is-active");
	});

	// Open and Close Fullscreen Menu by pressing esc
	$('body').keydown(function (e) {
		if (e.which == 27) {
			$(".hamburger").toggleClass("is-active");
			$('#fullscreenmenu').toggleClass("is-active");
		}
	});




	// Locais tabs
	var initialWindowScrollValue;

	// Show tab that if it is in the URL
	if (location.hash) {
		const hash = location.href.split("#");
		$('.nav a[href="#' + hash[1] + '"]').tab("show");
	}

	var initialWindowScrollValue;
	// Change the URL when the tab is selected
	$('a[data-bs-toggle="pill"]').on("click", function () {
		let newUrl;
		const hash = $(this).attr("href");
		if (hash == "#noLocalSelected") {
			newUrl = location.href.split("#")[0];
		} else {
			initialWindowScrollValue = $(window).scrollTop();
			newUrl = location.href.split("#")[0] + hash;

			$("html, body").animate({
				scrollTop: 0
			}, "fast");
		}

		history.replaceState(null, null, newUrl);
	});

	// Set the tab-pane height to the same as the body on mobile screens
	$(window).resize(function () {
		if ($(window).width() < 768) {
			var bodyheight = $('body').height();
			$(".tab-pane").height(bodyheight);
		} else {
			$(".tab-pane").height('auto')
		}
	}).resize();

	// Close local tab
	$('.closeLocal').on("click", function () {
		$("html, body").animate({
			scrollTop: initialWindowScrollValue
		}, 0);
		$('.tab-pane').removeClass('active');
		$('a[data-bs-toggle="pill"]').removeClass('active');
	});







}); // jQuery
