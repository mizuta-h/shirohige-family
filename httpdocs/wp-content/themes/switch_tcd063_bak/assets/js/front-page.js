'use strict';

(function ($) {

  var settings = {
    speed: 150,
    speed_vary: false,
    delay: 1,
    mistype: false,
    caret: false,
    blink: true,
    tag: 'span',
    repeat: false,
    typing: function typing(elm, chr_or_elm) {
      if ('<br/>' === chr_or_elm || '<br>' === chr_or_elm) {
        elm.t('pause', true);
        setTimeout(function () {
          elm.t('pause', false);
        }, 500);
      }
    }
  };

  var settings2 = {
    speed: 150,
    speed_vary: false,
    delay: 1,
    mistype: false,
    caret: false,
    blink: true,
    tag: 'span',
    repeat: false,
    typing: function typing(elm, chr_or_elm) {
      if ('<br/>' === chr_or_elm || '<br>' === chr_or_elm) {
        elm.t('pause', true);
        setTimeout(function () {
          elm.t('pause', false);
        }, 500);
      }
    }
  };

  // Header slider
  if ($('#js-header-slider').length) {

    var $headerSlider = $('#js-header-slider');
    var speed = $headerSlider.data('speed');

    $headerSlider.find('.p-header-content__title span').hide();

    $(window).on('js-initialized', function () {
      $headerSlider.on('init', function (event, slick) {
        var $currentSlide = slick.$slides.filter('.slick-current').addClass('is-active');
        var $currentSlideTyping = $currentSlide.find('.p-header-content__title span');
        if ($currentSlideTyping.text()) {
          $currentSlideTyping.t(settings).show();
        }
      }).slick({
        autoplay: true,
        speed: 1000,
        autoplaySpeed: speed,
        pauseOnHover: false
      }).on('afterChange', function (event, slick, currentSlide) {
        var $prevSlide = slick.$slides.filter('.is-active');
        var $currentSlide = slick.$slides.eq(currentSlide);

        if ($prevSlide.data('slick-index') !== $currentSlide.data('slick-index')) {
          $prevSlide.removeClass('is-active').find('.p-header-content__title span').hide();
          $currentSlide.addClass('is-active');

          var $currentSlideTyping = $currentSlide.find('.p-header-content__title span');
          if ($currentSlideTyping.text()) {
            $currentSlideTyping.t(settings2).show();
          }
        }
      });
    });
  } else {
    // Video, YouTube

    $(window).on('js-initialized', function () {

      // Typing animation
      $('.p-header-content__title span').t(settings);
    });
  }

  // Contents builder
  var indexContent01Link = document.getElementById('js-index-content01__link');
  var cb = document.getElementById('js-cb');

  indexContent01Link.addEventListener('click', function () {

    // Use jQuery for Safari
    $('body, html').animate({
      scrollTop: cb.offsetTop
    });
  });
})(jQuery);