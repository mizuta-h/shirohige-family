'use strict';

(function ($) {

  var siteLoaderOverlay = document.getElementById('site_loader_overlay');

  if (siteLoaderOverlay) {

    var siteLoaderAnimation = document.getElementById('site_loader_animation');

    // After the document loading process
    //window.onload = function() {
    $(window).load(function () {

      // Refresh positioning of slick
      if ($('.slick-slider').length) {
        $('.slick-slider').slick('setPosition');
      }

      // Hide the loading screen
      $(siteLoaderAnimation).delay(600).fadeOut(400);
      $(siteLoaderOverlay).delay(900).fadeOut(800, afterLoad);
    });

    // Display #site_wrap even if the document loading process is not over
    setTimeout(function () {
      $(siteLoaderAnimation).delay(600).fadeOut(400);
      $(siteLoaderOverlay).delay(900).fadeOut(800);
    }, 5000);
  } else {}
})(jQuery);