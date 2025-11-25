<?php
function switch_inline_styles() {

	global $post;

	$dp_options = get_design_plus_options();

	$primary_color = $dp_options['primary_color'];
	$secondary_color = $dp_options['secondary_color'];

  $font_families = array(
    'type1' => 'Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif',
    'type2' => 'Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif',
    'type3' => '"Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight: 500'
  );

  if ( is_mobile() ) {
    $font_families['type3'] = '"Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight: 700';
  }

  if ( is_mobile() ) {
    $header_logo_type = $dp_options['sp_header_use_logo_image'];
    $header_logo_color = $dp_options['sp_header_logo_color'];
    $header_logo_font_size = $dp_options['sp_header_logo_font_size'];
  } else {
    $header_logo_type = $dp_options['header_use_logo_image'];
    $header_logo_color = $dp_options['header_logo_color'];
    $header_logo_font_size = $dp_options['header_logo_font_size'];
  }

  $inline_styles = array();
  $responsive_styles = array();

  // Primary color
  $inline_styles[] = array(
    'selectors' => array(
      '.c-comment__form-submit:hover',
      '.p-cb__item-btn a',
      '.c-pw__btn',
      '.p-readmore__btn',
      '.p-pager span',
      '.p-page-links a',
      '.p-pagetop',
      '.p-widget__title',
      '.p-entry__meta',
      '.p-headline',
      '.p-article06__cat',
      '.p-nav02__item-upper',
      '.p-page-header__title',
      '.p-plan__title',
      '.p-btn'
    ),
    'properties' => sprintf( 'background: %s', esc_html( $primary_color ) )
  );

  // Secondary color
  $inline_styles[] = array(
    'selectors' => array(
      '.c-pw__btn:hover',
      '.p-cb__item-btn a:hover',
      '.p-pagetop:focus',
      '.p-pagetop:hover',
      '.p-readmore__btn:hover',
      '.p-page-links > span',
      '.p-page-links a:hover',
      '.p-pager a:hover',
      '.p-entry__meta a:hover',
      '.p-article06__cat:hover',
      '.p-interview__cat:hover',
      '.p-nav02__item-upper:hover',
      '.p-btn:hover'
    ),
    'properties' => sprintf( 'background: %s', esc_html( $secondary_color ) )
  );
  $inline_styles[] = array(
    'selectors' => array(
      '.p-archive-header__title',
      '.p-article01__title a:hover',
      '.p-article01__cat a:hover',
      '.p-article04__title a:hover',
      '.p-faq__cat',
      '.p-faq__list dt:hover',
      '.p-triangle',
      '.p-article06__title a:hover',
      '.p-interview__faq dt',
      '.p-nav02__item-lower:hover .p-nav02__item-title',
      '.p-article07 a:hover',
      '.p-article07__title',
      '.p-block01__title',
      '.p-block01__lower-title',
      '.p-block02__item-title',
      '.p-block03__item-title',
      '.p-block04__title',
      '.p-index-content02__title',
      '.p-article09 a:hover .p-article09__title',
      '.p-index-content06__title',
      '.p-plan-table01__price',
      '.p-plan__catch',
      '.p-plan__notice-title',
      '.p-spec__title',
      '.p-widget a:hover',
      '.cardlink .title a'
    ),
    'properties' => sprintf( 'color: %s', esc_html( $secondary_color ) )
  );

  // Content link color
  $inline_styles[] = array(
    'selectors' => array('.p-entry__body a','.custom-html-widget a'),
    'properties' => sprintf( 'color: %s', esc_html( $dp_options['content_link_color'] ) )
  );

  // Font type
  $inline_styles[] = array(
    'selectors' => array( 'body' ),
    'properties' => sprintf( 'font-family: %s', $font_families[$dp_options['font_type']] )
  );

  // Headline font type
  $inline_styles[] = array(
    'selectors' => array(
      '.c-logo',
      '.p-page-header__title',
      '.p-page-header__desc',
      '.p-archive-header__title',
      '.p-faq__cat',
      '.p-interview__title',
      '.p-footer-link__title',
      '.p-block01__title',
      '.p-block04__title',
      '.p-index-content02__title',
      '.p-headline02__title',
      '.p-index-content01__title',
      '.p-index-content06__title',
      '.p-index-content07__title',
      '.p-index-content09__title',
      '.p-plan__title',
      '.p-plan__catch',
      '.p-header-content__title',
      '.p-spec__title'
    ),
    'properties' => sprintf( 'font-family: %s', $font_families[$dp_options['headline_font_type']] )
  );

  // Load icon

  // Hover effect
  if ( 'type1' === $dp_options['hover_type'] ) {

    $inline_styles[] = array(
      'selectors' => '.p-hover-effect--type1:hover img',
      'properties' => array(
        sprintf( '-webkit-transform: scale(%s)', esc_html( $dp_options['hover1_zoom'] ) ),
        sprintf( 'transform: scale(%s)', esc_html( $dp_options['hover1_zoom'] ) )
      )
    );

  } elseif ( 'type2' === $dp_options['hover_type'] ) {

    $inline_styles[] = array(
      'selectors' => '.p-hover-effect--type2:hover img',
      'properties' => sprintf( 'opacity:%s', esc_html( $dp_options['hover2_opacity'] ) )
    );

    if ( 'type1' === $dp_options['hover2_direct'] ) {

      $inline_styles[] = array(
        'selectors' => '.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: 15px',
          '-webkit-transform: scale(1.3) translate3d(-15px, 0, 0)',
          'transform: scale(1.3) translate3d(-15px, 0, 0)'
        )
      );
      $inline_styles[] = array(
        'selectors' => '.p-author__img.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: 5px',
          '-webkit-transform: scale(1.3) translate3d(-5px, 0, 0)',
          'transform: scale(1.3) translate3d(-5px, 0, 0)'
        )
      );

    } else {

      $inline_styles[] = array(
        'selectors' => '.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: -15px',
          '-webkit-transform: scale(1.3) translate3d(15px, 0, 0)',
          'transform: scale(1.3) translate3d(15px, 0, 0)'
        )
      );
      $inline_styles[] = array(
        'selectors' => '.p-author__img.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: -5px',
          '-webkit-transform: scale(1.3) translate3d(5px, 0, 0)',
          'transform: scale(1.3) translate3d(5px, 0, 0)'
        )
      );

    }

  } else { // Hover type3

    $inline_styles[] = array(
      'selectors' => array(
        '.p-hover-effect--type3'
      ),
      'properties' => sprintf( 'background: %s', esc_html( $dp_options['hover3_bgcolor'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-hover-effect--type3:hover img',
      'properties' => sprintf( 'opacity: %s', esc_html( $dp_options['hover3_opacity'] ) )
    );

  }

  // Logo
  if ( 'type1' === $header_logo_type ) {
    $inline_styles[] = array(
      'selectors' => '.l-header__logo a',
      'properties' => array(
        sprintf( 'color: %s', esc_html( $header_logo_color ) ),
        sprintf( 'font-size: %dpx', esc_html( $header_logo_font_size ) )
      )
    );
  }

  // Header
  $inline_styles[] = array(
    'selectors' => '.l-header',
    'properties' => sprintf( 'background: rgba(%s, %f)', implode( ', ', hex2rgb( $dp_options['header_bg'] ) ), esc_html( $dp_options['header_bg_opacity'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.l-header--fixed.is-active',
    'properties' => sprintf( 'background: rgba(%s, %f)', implode( ', ', hex2rgb( $dp_options['header_bg_fixed'] ) ), esc_html( $dp_options['header_bg_opacity_fixed'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-menu-btn',
    'properties' => sprintf( 'color: %s', esc_html( $dp_options['gnav_color'] ) )
  );
  $responsive_styles['max-width: 1199px'][] = array(
    'selectors' => '.l-header',
    'properties' => sprintf( 'background: rgba(%s, %f)', implode( ', ', hex2rgb( $dp_options['header_bg_fixed'] ) ), esc_html( $dp_options['header_bg_opacity_fixed'] )  )
  );
  $responsive_styles['max-width: 1199px'][] = array(
    'selectors' => '.l-header--fixed.is-active',
    'properties' => sprintf( 'background: rgba(%s, %f)', implode( ', ', hex2rgb( $dp_options['header_bg_fixed'] ) ), esc_html( $dp_options['header_bg_opacity_fixed'] ) )
  );

  // Global navigation
  $inline_styles[] = array(
    'selectors' => '.p-global-nav > ul > li > a',
    'properties' => sprintf( 'color: %s', esc_html( $dp_options['gnav_color'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-global-nav > ul > li > a:hover',
    'properties' => sprintf( 'color: %s', esc_html( $dp_options['gnav_color_hover'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-global-nav .sub-menu a',
    'properties' => array(
      sprintf( 'background: %s', esc_html( $dp_options['gnav_sub_bg'] ) ),
      sprintf( 'color: %s', esc_html( $dp_options['gnav_sub_color'] ) )
    )
  );
  $inline_styles[] = array(
    'selectors' => '.p-global-nav .sub-menu a:hover',
    'properties' => array(
      sprintf( 'background: %s', esc_html( $dp_options['gnav_sub_bg_hover'] ) ),
      sprintf( 'color: %s', esc_html( $dp_options['gnav_sub_color_hover'] ) )
    )
  );
  $inline_styles[] = array(
    'selectors' => '.p-global-nav .menu-item-has-children > a > .p-global-nav__toggle::before',
    'properties' => sprintf( 'border-color: %s', esc_html( $dp_options['gnav_color'] ) )
  );

  // Footer
  if ( 'type1' === $dp_options['footer_links_type'] ) {

    $inline_styles[] = array(
      'selectors' => '.p-footer-link',
      'properties' => sprintf( 'background-image: url(%s)', esc_html( wp_get_attachment_url( $dp_options['footer_links_bg_img'] ) ) ),
    );
    $inline_styles[] = array(
      'selectors' => '.p-footer-link::before',
      'properties' => sprintf( 'background: rgba(%s, %f)', implode( ',', hex2rgb( $dp_options['footer_links_bg_overlay'] ) ), esc_html( $dp_options['footer_links_bg_overlay_opacity'] ) )
    );

    if ( 'img' !== $dp_options['footer_links_bg_type'] ) { // Video, YouTube

      if ( wp_is_mobile() ) {

        $inline_styles[] = array(
          'selectors' => '.p-footer-link',
          'properties' => sprintf( 'background-image: url(%s)', esc_html( wp_get_attachment_url( $dp_options['footer_links_bg_' . $dp_options['footer_links_bg_type'] . '_img'] ) ) ),
        );
      }
    }
  }

  $inline_styles[] = array(
    'selectors' => '.p-info',
    'properties' => array(
      sprintf( 'background: %s', esc_html( $dp_options['company_info_bg'] ) ),
      sprintf( 'color: %s', esc_html( $dp_options['company_info_color'] ) )
    )
  );
  $footer_logo_font_size = is_mobile() ? $dp_options['sp_footer_logo_font_size'] : $dp_options['footer_logo_font_size'];
  $inline_styles[] = array(
    'selectors' => '.p-info__logo',
    'properties' => sprintf( 'font-size: %dpx', esc_html( $footer_logo_font_size ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-footer-nav',
    'properties' => array(
      sprintf( 'background: %s', esc_html( $dp_options['footer_menu_bg'] ) ),
      sprintf( 'color: %s', esc_html( $dp_options['footer_menu_color'] ) )
    )
  );
  $inline_styles[] = array(
    'selectors' => '.p-footer-nav a',
    'properties' => sprintf( 'color: %s', esc_html( $dp_options['footer_menu_color'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-footer-nav a:hover',
    'properties' => sprintf( 'color: %s', esc_html( $dp_options['footer_menu_color_hover'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-copyright',
    'properties' => sprintf( 'background: %s', esc_html( $dp_options['copyright_bg'] ) )
  );

  // Page header
  if ( is_post_type_archive( 'news' ) || is_singular( 'news' ) ) {

    $ph_overlay = $dp_options['news_ph_overlay'];
    $ph_overlay_opacity = $dp_options['news_ph_overlay_opacity'];
    $ph_desc_color = $dp_options['news_ph_desc_color'];
    $ph_desc_font_size = $dp_options['news_ph_desc_font_size'];
    $ph_desc_font_size_sp = $dp_options['news_ph_desc_font_size_sp'];

  } elseif ( is_post_type_archive( 'event' ) || is_singular( 'event' ) ) {

    $ph_overlay = $dp_options['event_ph_overlay'];
    $ph_overlay_opacity = $dp_options['event_ph_overlay_opacity'];
    $ph_desc_color = $dp_options['event_ph_desc_color'];
    $ph_desc_font_size = $dp_options['event_ph_desc_font_size'];
    $ph_desc_font_size_sp = $dp_options['event_ph_desc_font_size_sp'];

  } elseif ( is_post_type_archive( 'interview' ) || is_singular( 'interview' ) || is_tax( 'interview_category' ) ) {

    $ph_overlay = $dp_options['interview_ph_overlay'];
    $ph_overlay_opacity = $dp_options['interview_ph_overlay_opacity'];
    $ph_desc_color = $dp_options['interview_ph_desc_color'];
    $ph_desc_font_size = $dp_options['interview_ph_desc_font_size'];
    $ph_desc_font_size_sp = $dp_options['interview_ph_desc_font_size_sp'];

  } elseif ( is_post_type_archive( 'faq' ) ) {

    $ph_overlay = $dp_options['faq_ph_overlay'];
    $ph_overlay_opacity = $dp_options['faq_ph_overlay_opacity'];
    $ph_desc_color = $dp_options['faq_ph_desc_color'];
    $ph_desc_font_size = $dp_options['faq_ph_desc_font_size'];
    $ph_desc_font_size_sp = $dp_options['faq_ph_desc_font_size_sp'];

  } elseif ( is_page() ) {

    $ph_overlay = $post->ph_overlay;
    $ph_overlay_opacity = $post->ph_overlay_opacity;
    $ph_desc_color = $post->ph_desc_color;
    $ph_desc_font_size = $post->ph_desc_font_size;
    $ph_desc_font_size_sp = $post->ph_desc_font_size_sp;

  } elseif ( is_404() ) {

    $ph_overlay = $dp_options['404_ph_overlay'];
    $ph_overlay_opacity = $dp_options['404_ph_overlay_opacity'];
    $ph_desc_color = $dp_options['404_ph_desc_color'];
    $ph_desc_font_size = $dp_options['404_ph_desc_font_size'];
    $ph_desc_font_size_sp = $dp_options['404_ph_desc_font_size_sp'];

  } else {

    $ph_overlay = $dp_options['ph_overlay'];
    $ph_overlay_opacity = $dp_options['ph_overlay_opacity'];
    $ph_desc_color = $dp_options['ph_desc_color'];
    $ph_desc_font_size = $dp_options['ph_desc_font_size'];
    $ph_desc_font_size_sp = $dp_options['ph_desc_font_size_sp'];

  }

  $inline_styles[] = array(
    'selectors' => '.p-page-header::before',
    'properties' => sprintf( 'background: rgba(%s, %s)', implode( ', ', hex2rgb( $ph_overlay ) ), esc_html( $ph_overlay_opacity ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-page-header__desc',
    'properties' => array(
      sprintf( 'color: %s', esc_html( $ph_desc_color ) ),
      sprintf( 'font-size: %dpx', esc_html( $ph_desc_font_size ) )
    )
  );
  $responsive_styles['max-width: 767px'][] = array(
    'selectors' => '.p-page-header__desc',
    'properties' => sprintf( 'font-size: %dpx', esc_html( $ph_desc_font_size_sp ) )
  );

  if ( is_front_page() ) {

    if ( 'type1' === $dp_options['header_content_type'] ) { // Image

      for ( $i = 1; $i <= 5; $i++ ) {

        if ( ! $dp_options['header_slider_img' . $i] ) continue;

        if ( wp_is_mobile() && $dp_options['header_slider_img_sp' . $i] ) {
          $header_slider_img = $dp_options['header_slider_img_sp' . $i];
        } else {
          $header_slider_img = $dp_options['header_slider_img' . $i];
        }

        $inline_styles[] = array(
          'selectors' => ".p-header-slider__item--{$i} .p-header-slider__item-img",
          'properties' => array(
            sprintf( 'background-image: url(%s)', esc_html( wp_get_attachment_url( $header_slider_img ) ) ),
            sprintf( 'animation-duration: %ds', esc_html( $dp_options['header_slider_animation_time'] + 1 ) )
          )
        );
        $inline_styles[] = array(
          'selectors' => ".p-header-slider__item--{$i} .p-header-slider__item-img::before",
          'properties' => sprintf( 'background: rgba(%s, %f)', implode( ',', hex2rgb( $dp_options['header_slider_overlay' . $i] ) ), esc_html( $dp_options['header_slider_overlay_opacity' . $i] ) )
        );
        $inline_styles[] = array(
          'selectors' => ".p-header-slider__item--{$i} .p-header-content__title",
          'properties' => array(
            sprintf( 'color: %s', esc_html( $dp_options['header_slider_catch_color' . $i] ) ),
            sprintf( 'font-size: %dpx', esc_html( $dp_options['header_slider_catch_font_size' . $i] ) )
          )
        );
        $responsive_styles['max-width: 767px'][] = array(
          'selectors' => ".p-header-slider__item--{$i} .p-header-content__title",
          'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['header_slider_catch_font_size_sp' . $i] ) )
        );

      }

    } elseif ( 'type2' === $dp_options['header_content_type'] ) { // Video

      $inline_styles[] = array(
        'selectors' => '.p-header-content::before',
        'properties' => sprintf( 'background: rgba(%s, %s)', esc_html( implode( ',', hex2rgb( $dp_options['header_video_overlay'] ) ) ), esc_html( $dp_options['header_video_overlay_opacity'] ) )
      );
      $inline_styles[] = array(
        'selectors' => '.p-header-content__title',
        'properties' => array(
          sprintf( 'color: %s', esc_html( $dp_options['header_video_catch_color'] ) ),
          sprintf( 'font-size: %dpx', esc_html( $dp_options['header_video_catch_font_size'] ) )
        )
      );
      $responsive_styles['max-width: 767px'][] = array(
        'selectors' => '.p-header-content__title',
        'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['header_video_catch_font_size_sp'] ) )
      );

      if ( !auto_play_movie() ) {

        $inline_styles[] = array(
          'selectors' => '.p-header-video',
          'properties' => sprintf( 'background-image: url(%s)', esc_html( wp_get_attachment_url( $dp_options['header_video_img'] ) ) )
        );
      }

    } else {

      $inline_styles[] = array(
        'selectors' => '.p-header-content::before',
        'properties' => sprintf( 'background: rgba(%s, %s)', esc_html( implode( ',', hex2rgb( $dp_options['header_youtube_overlay'] ) ) ), esc_html( $dp_options['header_youtube_overlay_opacity'] ) )
      );
      $inline_styles[] = array(
        'selectors' => '.p-header-content__title',
        'properties' => array(
          sprintf( 'color: %s', esc_html( $dp_options['header_youtube_catch_color'] ) ),
          sprintf( 'font-size: %dpx', esc_html( $dp_options['header_youtube_catch_font_size'] ) )
        )
      );
      $responsive_styles['max-width: 767px'][] = array(
        'selectors' => '.p-header-content__title',
        'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['header_youtube_catch_font_size_sp'] ) )
      );

      if ( !auto_play_movie() ) {

        $inline_styles[] = array(
          'selectors' => '.p-header-youtube',
          'properties' => sprintf( 'background-image: url(%s)', esc_html( wp_get_attachment_url( $dp_options['header_youtube_img'] ) ) )
        );

      }
    }

    // Contents after the header content
    $inline_styles[] = array(
      'selectors' => '.p-index-content01',
      'properties' => array(
        sprintf( 'background: %s', esc_html( $dp_options['index_content01_bg'] ) ),
        sprintf( 'color: %s', esc_html( $dp_options['index_content01_color'] ) )
      )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content01__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['index_content01_catch_font_size'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-index-content01__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['index_content01_catch_font_size_sp'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content01__link',
      'properties' => array(
        sprintf( 'background: %s', esc_html( $dp_options['index_content01_btn_bg'] ) ),
        sprintf( 'color: %s', esc_html( $dp_options['index_content01_btn_color'] ) )
      )
    );
    $inline_styles[] = array(
      'selectors' => array(
        '.p-index-content01__link:focus',
        '.p-index-content01__link:hover'
      ),
      'properties' => array(
        sprintf( 'background: %s', esc_html( $dp_options['index_content01_btn_bg_hover'] ) ),
        sprintf( 'color: %s', esc_html( $dp_options['index_content01_btn_color_hover'] ) )
      )
    );

    // Contents builder
    $inline_styles[] = array(
      'selectors' => '.p-article08__content',
      'properties' => sprintf( 'background: %s', esc_html( $dp_options['index_three_column_bg'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content02__content',
      'properties' => sprintf( 'background: %s', esc_html( $dp_options['index_4_images_and_text_bg'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content02__title',
      'properties' => array(
        sprintf( 'color: %s', esc_html( $dp_options['index_4_images_and_text_catch_color'] ) ),
        sprintf( 'font-size: %dpx', esc_html( $dp_options['index_4_images_and_text_catch_font_size'] ) )
      )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-index-content02__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['index_4_images_and_text_catch_font_size_sp'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content04',
      'properties' => sprintf( 'background: %s', esc_html( $dp_options['index_news_and_event_bg'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content04__col--news .p-headline02__title',
      'properties' => array(
        sprintf( 'color: %s', esc_html( $dp_options['index_news_title_color'] ) ),
        sprintf( 'font-size: %dpx', esc_html( $dp_options['index_news_title_font_size'] ) )
      )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-index-content04__col--news .p-headline02__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['index_news_title_font_size_sp'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content04__col--news .p-index-content04__col-link a',
      'properties' => sprintf( 'color: %s', esc_html( $dp_options['index_news_link_color'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content04__col--news .p-index-content04__col-link a:hover',
      'properties' => sprintf( 'color: %s', esc_html( $dp_options['index_news_link_color_hover'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content04__col--event .p-headline02__title',
      'properties' => array(
        sprintf( 'color: %s', esc_html( $dp_options['index_event_title_color'] ) ),
        sprintf( 'font-size: %dpx', esc_html( $dp_options['index_event_title_font_size'] ) )
      )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-index-content04__col--event .p-headline02__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['index_event_title_font_size_sp'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content04__col--event .p-index-content04__col-link a',
      'properties' => sprintf( 'color: %s', esc_html( $dp_options['index_event_link_color'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content04__col--event .p-index-content04__col-link a:hover',
      'properties' => sprintf( 'color: %s', esc_html( $dp_options['index_event_link_color_hover'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content05 .p-headline02__title',
      'properties' => array(
        sprintf( 'color: %s', esc_html( $dp_options['index_interview_title_color'] ) ),
        sprintf( 'font-size: %dpx', esc_html( $dp_options['index_interview_title_font_size'] ) )
      )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-index-content05 .p-headline02__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['index_interview_title_font_size_sp'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content06__title',
      'properties' => array(
        sprintf( 'color: %s', esc_html( $dp_options['index_plan_content_catch_color'] ) ),
        sprintf( 'font-size: %dpx', esc_html( $dp_options['index_plan_content_catch_font_size'] ) )
      )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-index-content06__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['index_plan_content_catch_font_size_sp'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content07',
      'properties' => sprintf( 'background-image: url(%s)', wp_get_attachment_url( $dp_options['index_image_image'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content07__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['index_image_catch_font_size'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-index-content07__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['index_image_catch_font_size_sp'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content08 .p-headline02__title',
      'properties' => array(
        sprintf( 'color: %s', esc_html( $dp_options['index_blog_title_color'] ) ),
        sprintf( 'font-size: %dpx', esc_html( $dp_options['index_blog_title_font_size'] ) )
      )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-index-content08 .p-headline02__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['index_blog_title_font_size_sp'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-index-content09__title',
      'properties' => array(
        sprintf( 'color: %s', esc_html( $dp_options['index_catch_and_desc_catch_color'] ) ),
        sprintf( 'font-size: %dpx', esc_html( $dp_options['index_catch_and_desc_catch_font_size'] ) )
      )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-index-content09__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['index_catch_and_desc_catch_font_size_sp'] ) )
    );

  } elseif ( is_post_type_archive( 'faq' ) ) {

    $inline_styles[] = array(
      'selectors' => '.p-faq__list dt::before',
      'properties' => sprintf( 'background: %s', esc_html( $dp_options['faq_q_bg'] ) )
    );

  } elseif ( is_singular( 'post' ) ) {

    $inline_styles[] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['title_font_size'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['content_font_size'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['title_font_size_sp'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['content_font_size_sp'] ) )
    );

  } elseif ( is_singular( 'news' ) ) {

    $inline_styles[] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['news_title_font_size'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['news_content_font_size'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['news_title_font_size_sp'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['news_content_font_size_sp'] ) )
    );

  } elseif ( is_singular( 'event' ) ) {

    $inline_styles[] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['event_title_font_size'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['event_content_font_size'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['event_title_font_size_sp'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['event_content_font_size_sp'] ) )
    );

  } elseif ( is_singular( 'interview' ) ) {

    $inline_styles[] = array(
      'selectors' => '.p-interview__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['interview_title_font_size'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-interview__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['interview_title_font_size_sp'] ) )
    );

  }

  // You can add styles with 'tcd_inline_styles' filter
  $inline_styles = apply_filters( 'tcd_inline_styles', $inline_styles, $dp_options );

  // Global navigation (max-width: 1199px)
  $responsive_styles['max-width: 1199px'][] = array(
    'selectors' => '.p-global-nav',
    'properties' => sprintf( 'background: rgba(%s, %s)', esc_html( implode( ',', hex2rgb( $dp_options['gnav_bg_sp'] ) ) ), esc_html( $dp_options['gnav_bg_opacity_sp'] ) )
  );
  $responsive_styles['max-width: 1199px'][] = array(
    'selectors' => array(
      '.p-global-nav > ul > li > a',
      '.p-global-nav > ul > li > a:hover',
      '.p-global-nav a',
      '.p-global-nav a:hover',
      '.p-global-nav .sub-menu a',
      '.p-global-nav .sub-menu a:hover',
    ),
    'properties' => sprintf( 'color: %s!important', esc_html( $dp_options['gnav_color_sp'] ) )
  );
  $responsive_styles['max-width: 1199px'][] = array(
    'selectors' => '.p-global-nav .menu-item-has-children > a > .sub-menu-toggle::before',
    'properties' => sprintf( 'border-color: %s', esc_html( $dp_options['gnav_color_sp'] ) )
  );

  // You can add responsive styles with 'tcd_responsive_styles' filter
  $responsive_styles = apply_filters( 'tcd_responsive_styles', $responsive_styles, $dp_options );

  echo '<style>' . "\n";

  $output = '';

  // Add $inline_styles to $output
  foreach ( $inline_styles as $style ) {
    $selectors = is_array( $style['selectors'] ) ? implode( ',', $style['selectors'] ) : $style['selectors'];
    $properties = is_array( $style['properties'] ) ? implode( ';', $style['properties'] ) : $style['properties'];
    $output .= sprintf( '%s{%s}', $selectors, $properties );
  }

  // Add $responsive_styles to $output
  foreach ( $responsive_styles as $media_query => $styles ) {

    $output .= sprintf( '@media screen and (%s) {', $media_query );

    foreach ( $styles as $style ) {
      $selectors = is_array( $style['selectors'] ) ? implode( ',', $style['selectors'] ) : $style['selectors'];
      $properties = is_array( $style['properties'] ) ? implode( ';', $style['properties'] ) : $style['properties'];
      $output .= sprintf( '%s{%s}', $selectors, $properties );
    }

    $output .= '}';
  }

  if ( $output ) { echo $output; }

  do_action( 'tcd_head', $dp_options );

  // Custom CSS
  if ( $dp_options['css_code'] ) {
    echo $dp_options['css_code']  . "\n";
  }
  if(is_single() || is_page()) {
    $custom_css = get_post_meta($post->ID, 'custom_css', true);
    if($custom_css) {
      echo $custom_css . "\n";
    };
  }

  echo '</style>' . "\n";

}
add_action( 'wp_head', 'switch_inline_styles' );

// Custom head/script
function tcd_custom_head() {
  global $dp_options, $post;

  if ( $dp_options['custom_head'] ) {
    echo $dp_options['custom_head'] . "\n";
  }
  if(is_single() || is_page()) {
    $custom_script = get_post_meta($post->ID, 'custom_script', true);
    if($custom_script) {
      echo $custom_script  . "\n";
    };
  };

}
add_action( 'wp_head', 'tcd_custom_head', 9999 );
?>
