jQuery(function(){var e;if($(".hamburger").on("click",function(e){e.preventDefault(),$(".hamburger").toggleClass("is-active"),$("#fullscreenmenu").toggleClass("is-active")}),$("body").keydown(function(e){27==e.which&&($(".hamburger").toggleClass("is-active"),$("#fullscreenmenu").toggleClass("is-active"))}),location.hash){const e=location.href.split("#");$('.nav a[href="#'+e[1]+'"]').tab("show")}$('a[data-bs-toggle="pill"]').on("click",function(){let o;const a=$(this).attr("href");"#noLocalSelected"==a?o=location.href.split("#")[0]:(e=$(window).scrollTop(),o=location.href.split("#")[0]+a,$("html, body").animate({scrollTop:0},"fast")),history.replaceState(null,null,o)}),$(window).resize(function(){if($(window).width()<768){var e=$("body").height();$(".tab-pane").height(e)}else $(".tab-pane").height("auto")}).resize(),$(".closeLocal").on("click",function(){$("html, body").animate({scrollTop:e},0),$(".tab-pane").removeClass("active"),$('a[data-bs-toggle="pill"]').removeClass("active")}),$(".misha_loadmore").click(function(){var e=$(this),o={action:"loadmore",query:misha_loadmore_params.posts,page:misha_loadmore_params.current_page};$.ajax({url:misha_loadmore_params.ajaxurl,data:o,type:"POST",beforeSend:function(o){e.text("Loading...")},success:function(o){o?($("#all_my_posts").append(o),misha_loadmore_params.current_page++,misha_loadmore_params.current_page==misha_loadmore_params.max_page&&e.remove()):e.remove()}})}),0!==$(".lwp-video-autoplay .et_pb_video_box").length&&($(".lwp-video-autoplay .et_pb_video_box").find("video").prop("muted",!0),$(".lwp-video-autoplay .et_pb_video_box").find("video").attr("loop","loop"),$(".lwp-video-autoplay .et_pb_video_box").find("video").attr("playsInline",""),$(".lwp-video-autoplay .et_pb_video_box").each(function(){$(this).find("video").get(0).play()}),$(".lwp-video-autoplay .et_pb_video_box").find("video").removeAttr("controls"))});