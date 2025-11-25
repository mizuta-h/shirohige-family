'use strict';

(function ($) {

  // Header
  var header = document.getElementById('js-header');

  if (header.classList.contains('l-header--fixed')) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 100) {
        header.classList.add('is-active');
      } else {
        header.classList.remove('is-active');
      }
    });
  }

  var globalNav = document.getElementById('js-global-nav');

  document.getElementById('js-menu-btn').addEventListener('click', function () {
    $(globalNav).slideToggle();
  });

  globalNav.addEventListener('click', function (e) {
    if (e.target.classList.contains('p-global-nav__toggle')) {
      e.preventDefault();
      e.target.classList.toggle('is-active');
      $(e.target.parentNode.nextElementSibling).slideToggle();
    }
  });

  // Pagetop
  var pagetop = document.getElementById('js-pagetop');

  window.addEventListener('scroll', function () {
    if (window.scrollY > 100) {
      pagetop.classList.add('is-active');
    } else {
      pagetop.classList.remove('is-active');
    }
  });

  pagetop.addEventListener('click', function () {

    // Use jQuery for Safari
    $('body, html').animate({
      scrollTop: 0
    }, 1000);
  });

  /**
   * WP検索ウィジェット
   */
  $('.p-widget .searchform #searchsubmit').val($('<div>').html('&#xe915;').text());

  //search widget
  $('.widget_search #searchsubmit').wrap('<div class="submit_button"></div>');
  $('.google_search #searchsubmit').wrap('<div class="submit_button"></div>');


  //calendar widget
  $('.wp-calendar-table td').each(function () {
    if ( $(this).children().length == 0 ) {
      $(this).addClass('no_link');
      $(this).wrapInner('<span></span>');
    } else {
      $(this).addClass('has_link');
    }
  });

  // Widget: Archive list
  var dropdownTitles = document.getElementsByClassName('p-dropdown__title');

  for (var i = 0, len = dropdownTitles.length; i < len; i++) {
    dropdownTitles[i].addEventListener('click', function (e) {
      e.target.classList.toggle('is-active');
      $('+ .p-dropdown__list:not(:animated)', this).slideToggle();
    });
  }

  // Widget: Tab panel
  var tabPanels = document.getElementsByClassName('p-tab-panel');

  var _loop = function _loop(_i, _len) {

    tabPanels[_i].querySelector('.p-tab-panel__tab-item').classList.add('is-active');
    tabPanels[_i].querySelector('.p-tab-panel__panel').classList.add('is-active');

    tabPanels[_i].addEventListener('click', function (e) {

      if (e.target.getAttribute('href') && e.target.getAttribute('href').match(/#panel\d/)) {

        e.preventDefault();

        if (!e.target.parentNode.classList.contains('is-active')) {

          // Toggle tab
          tabPanels[_i].querySelector('.is-active').classList.remove('is-active');
          e.target.parentNode.classList.add('is-active');

          // Toggle panel
          tabPanels[_i].querySelectorAll('.p-tab-panel__panel').forEach(function (element) {
            element.style.display = 'none';
          });
          document.querySelector(e.target.getAttribute('href')).style.display = 'block';
        }
      }
    });
  };

  for (var _i = 0, _len = tabPanels.length; _i < _len; _i++) {
    _loop(_i, _len);
  }

  // FAQ
  var faqLists = document.querySelectorAll('.p-faq__list');

  for (var _i2 = 0, _len2 = faqLists.length; _i2 < _len2; _i2++) {

    faqLists[_i2].addEventListener('click', function (e) {

      if (e.target.nodeName === 'DT') {
        $(e.target.nextElementSibling).slideToggle();
      }
    });
  }

  $(document).on('js-initialized', function () {

    // Page header
    var pageHeader = document.getElementById('js-page-header');

    if (pageHeader) {
      pageHeader.classList.add('is-active');
    }

    // Typing animation
    $('#js-page-header__desc span').t({
      speed: 150,
      speed_vary: false,
      delay: 2,
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
    });
  });
})(jQuery);