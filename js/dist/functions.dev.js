"use strict";

jQuery(document).ready(function ($) {
  // Side Menu http://www.hongkiat.com/blog/jquery-sliding-navigation/ --------------------------------------------
  function openMenu() {
    $(".hamburger").toggleClass("is-active");
    $('#fullscreenmenu').animate({
      right: '0px'
    }, 200);
  }

  function closeMenu() {
    $(".hamburger").toggleClass("is-active");
    $('#fullscreenmenu').animate({
      right: '-300px'
    }, 200);
  }

  $(".hamburger").on("click", function (e) {
    e.preventDefault();
    var distance = $('#fullscreenmenu').css('right');

    if (distance == "auto" || distance == "-300px") {
      openMenu();
    } else {
      closeMenu();
    }
  });
}); // jQuery