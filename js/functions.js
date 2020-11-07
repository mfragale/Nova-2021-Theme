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

	// Show tab that if it is in the URL
	if (location.hash) {
		const hash = location.href.split("#");
		$('.nav a[href="#' + hash[1] + '"]').tab("show");
	}
	// Close local tab
	$('.closeLocal').on("click", function () {
		$('.tab-pane').removeClass('active');
		$('a[data-toggle="tab"]').removeClass('active');
	});

	// Change the URL when the tab is selected
	$('a[data-toggle="tab"]').on("click", function () {
		let newUrl;
		const hash = $(this).attr("href");
		if (hash == "#noLocalSelected") {
			newUrl = location.href.split("#")[0];
		} else {
			newUrl = location.href.split("#")[0] + hash;
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







}); // jQuery
