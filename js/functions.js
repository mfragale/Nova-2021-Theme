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
	let url = location.href.replace(/\/$/, "");

	// Show tab that if it is in the URL
	if (location.hash) {
		const hash = url.split("#");
		$('.nav a[href="#' + hash[1] + '"]').tab("show");
		url = location.href.replace(/\/#/, "#");
		history.replaceState(null, null, url);
	}
	// Close local tab
	$('.closeLocal').on("click", function () {
		$('.tab-pane').removeClass('active');
		$('a[data-toggle="tab"]').removeClass('active');
		newUrl = url.split("#")[0];
	});

	// Change the URL when the tab is selected
	$('a[data-toggle="tab"]').on("click", function () {
		let newUrl;
		const hash = $(this).attr("href");
		if (hash == "#noLocalSelected") {
			newUrl = url.split("#")[0];
		} else {
			newUrl = url.split("#")[0] + "/" + hash;
		}
		newUrl += "/";
		history.replaceState(null, null, newUrl);
	});

	



}); // jQuery
