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




	$('.misha_loadmore').click(function () {

		var button = $(this),
			data = {
				'action': 'loadmore',
				'query': misha_loadmore_params.posts, // that's how we get params from wp_localize_script() function
				'page': misha_loadmore_params.current_page
			};

		$.ajax({ // you can also use $.post here
			url: misha_loadmore_params.ajaxurl, // AJAX handler
			data: data,
			type: 'POST',
			beforeSend: function (xhr) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success: function (data) {
				if (data) {
					//button.text('More posts').prev().before(data); // insert new posts
					$("#all_my_posts").append(data);
					misha_loadmore_params.current_page++;

					if (misha_loadmore_params.current_page == misha_loadmore_params.max_page)
						button.remove(); // if last page, remove the button

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});





	// Autoplays any video with the css class .lwp-video-autoplay
	if ($('.lwp-video-autoplay .et_pb_video_box').length !== 0) {
		$('.lwp-video-autoplay .et_pb_video_box').find('video').prop('muted', true);
		$(".lwp-video-autoplay .et_pb_video_box").find('video').attr('loop', 'loop');
		$(".lwp-video-autoplay .et_pb_video_box").find('video').attr('playsInline', '');

		$(".lwp-video-autoplay .et_pb_video_box").each(function () {
			$(this).find('video').get(0).play();
		});
		$('.lwp-video-autoplay .et_pb_video_box').find('video').removeAttr('controls');
	}









}); // jQuery
