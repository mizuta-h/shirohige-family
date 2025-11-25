(function($) {

  //テキストエリアの文字数をカウント
  $('.word_count').each( function(i){
    var count = $(this).val().length;
    $(this).next('.word_count_result').children().text(count);
  });
  $('.word_count').keyup(function(){
    var count = $(this).val().length;
    $(this).next('.word_count_result').children().text(count);
  });

  // テーマオプションの入力エリアの開閉
  $('.theme_option_field_ac:not(.theme_option_field_ac.open)').on('click', '.theme_option_headline', function(){
    $(this).parents('.theme_option_field_ac').toggleClass('active');
    return false;
  });
  $('.theme_option_field_ac:not(.theme_option_field_ac.open)').on('click', '.close_ac_content', function(){
    $(this).parents('.theme_option_field_ac').toggleClass('active');
    return false;
  });

  // サブボックス内のタブ
  $(document).on('click', '.sub_box_tab .tab', function(event){
    var tab_name = $(this).attr('data-tab');
    $(this).addClass('active');
    $(this).siblings().removeClass('active');
    $(this).closest('.tab_parent').find('[data-tab-content="'+tab_name+'"]').addClass('active').siblings().removeClass('active');
  });
  $(document).on('change keyup', '.sub_box_tab_content .tab_label', function(){
    var tab_content_name = $(this).closest('.sub_box_tab_content').attr('data-tab-content');
    $(this).closest('.tab_parent').find('[data-tab="'+tab_content_name+'"]').text($(this).val());
  });

	// Initialize wordpress color picker API
	$('.c-color-picker').wpColorPicker();
  $('.cf-color-picker').wpColorPicker();

  // Sortable
	$('.sortable').sortable({
    handle: '.theme_option_subbox_headline',
  	placeholder: 'sortable-placeholder',
  	//helper: 'clone',
    start: function(e, ui){
      ui.item.find('textarea').each(function () {
        if (window.tinymce) {
          tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
        }
      });
    },
    stop: function (e, ui) {
      ui.item.toggleClass("active");
      ui.item.find('textarea').each(function () {
        if (window.tinymce) {
          tinymce.execCommand('mceAddEditor', true, $(this).attr('id'));
        }
     });
    },
  	forceHelperSize: true,
  	forcePlaceholderSize: true
	});

  // Page template
  var templateMetaBox = document.getElementById('template_meta_box');

  if (templateMetaBox) {

    templateMetaBox.addEventListener('click', function(e) {

      if (e.target.classList.contains('theme_option_subbox_headline')) {
        e.target.parentNode.classList.toggle('active');
      }

    });
  }

  // Repeater fields

    // Add and delete repeater fields in the footer bar
    $('.repeater-wrapper')

      .each(function() {

        var nextIndex = $(this).find('.repeater-item').last().index();
        $(this).find('.button-add-row').click(function(e) {
          e.preventDefault();
          var clone = $(this).attr('data-clone');
          var $parent = $(this).closest('.repeater-wrapper');
          if (clone && $parent.length) {
            nextIndex++;
            $parent.find('.repeater').append(clone.replace(/addindex/g, nextIndex));
          }
          $('.cf-color-picker').wpColorPicker();
        });
      })

      .on('click', '.button-delete-row', function(e) {
        e.preventDefault();
        var del = true;
        var confirmMessage = $(this).closest('.repeater-wrapper').attr('data-delete-confirm');
        if (confirmMessage.length) {
          del = confirm(confirmMessage);
        }
        if (del) {
          $(this).closest('.repeater-item').remove();
        }
  	  });

	// Theme options
  if (document.getElementById('my_theme_option')) {

		// CookieTab
  	$('#my_theme_option').cookieTab({
  		tabMenuElm: '#theme_tab',
   		tabPanelElm: '#tab-panel'
  	});

    // Get .theme_option_field
    var themeOptionField = document.getElementsByClassName('theme_option_field');

    for (var i = 0, len = themeOptionField.length; i < len; i++) {

      themeOptionField[i].addEventListener('click', function(e) {

        if (!e.target) return;

        if (e.target.classList.contains('theme_option_subbox_headline')) {
          e.target.parentNode.classList.toggle('active');

        // Toggle HTML to display on clicking radio button
        } else if ('INPUT' === e.target.nodeName && 'radio' === e.target.type) {

          // Get name attribute value inside bracket
          var name = e.target.name.match(/dp_options\[(\w+)\]/)[1];

          // Get value of the radio button
          var value = e.target.value;

          // Get target element
          var target = document.querySelectorAll('[id^="' + name + '"]');

          if ('contents_builder' !== name && target.length) {

            // Hide all HTML related to the radio buttons
            target.forEach(function(element) {
              element.style.display = 'none';
            });

            // Display HTML related to checked radio button
            document.getElementById(name + '_' + value).style.display = 'block';
          }
        }
      });
    }

    // Change .sub_box headline
	  $('.theme_option_field').on('change keyup', '.change_subbox_headline', function(e) {
      $(this).closest('.sub_box').find('.theme_option_subbox_headline').text($(this).val());
    });

    // Footer bar
    $('.repeater-wrapper').on('change', '.footer-bar-type select', function(e) {
			var subBox = $(this).parents('.sub_box');
			var target = subBox.find('.footer-bar-target');
			var url = subBox.find('.footer-bar-url');
			var number = subBox.find('.footer-bar-number');
			switch (e.target.value) {
			  case 'type1' :
				  target.show();
				  url.show();
				  number.hide();
				  break;
			  case 'type2' :
				  target.hide();
				  url.hide();
				  number.hide();
				  break;
			  case 'type3' :
				  target.hide();
				  url.hide();
				  number.show();
				  break;
			}
		});

	  // Submit by AJAX
    $('#tab-panel').on( 'click', '.ajax_button', function() {

      var $button = $('.button-ml');
      $('#saving_data').show();
      tinyMCE.triggerSave(); // tinymceを利用しているフィールドのデータを保存
      $('#myOptionsForm').ajaxSubmit({
        beforeSend: function() {
          $button.attr('disabled', true); // ボタンを無効化し、二重送信を防止
        },
        complete: function() {
          $button.attr('disabled', false); // ボタンを有効化し、送信を許可
        },
        success: function(){
          $('#saving_data').hide();
          $('#saved_data').html('<div id="saveMessage" class="successModal"></div>');
          $('#saveMessage').append('<p>' + error_messages.success + '</p>').show();
        },
        error: function() {
          $('#saving_data').hide();
          alert(error_messages.error);
        },
        timeout: 10000
      });
      setTimeout(function() {
	  		$('#saveMessage').hide();
	  	}, 3000);

      return false;
    });
	}

  $('[name="page_tcd_template_type"]').click(function() {

    var $label = $(this).parent();

    if (!$label.hasClass('active')) {

      $label.parents('ul').find('.active').removeClass('active');
      $label.addClass('active');

      $('[id^="page_tcd_template_type_type"]').hide();
      $('[id="page_tcd_template_type_' + $(this).val() + '"]').show();

    }
  });

  // Interview
  $('[name="interviewee_media_type"]').click(function() {

    $type2 = $('#interviewee_media_type_type2');
    $type3 = $('#interviewee_media_type_type3');

    switch ($('[name="interviewee_media_type"]:checked').val()) {
      case 'type1' :
        $type2.hide();
        $type3.hide();
        break;
      case 'type2' :
        $type2.show();
        $type3.hide();
        break;
      case 'type3' :
        $type2.hide();
        $type3.show();
    }
  });

  $('[name="interviewee_media_type"]:checked').click();

})(jQuery);
