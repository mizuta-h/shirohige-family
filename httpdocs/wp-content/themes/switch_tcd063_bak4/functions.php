<?php

// Set theme languages directory
load_theme_textdomain( 'tcd-w', get_template_directory() . '/languages' );

// style.cssのDescriptionをPoedit等に認識させる
__( 'WordPress theme "Switch" is an LP type website. It has a structure that is good for physical store business promotion, and implements fee structure options, interviews, and FAQ pages. If you put a video on the top page, you can excite the viewer.', 'tcd-switch' );

function switch_setup() {

	// Enable post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Enable a title tag
	add_theme_support( 'title-tag' );

	// Enable automatic feed links
	add_theme_support( 'automatic-feed-links' );

	// Add image sizes
  add_image_size( 'size1', 590, 380, true ); // 2x for index.php
  add_image_size( 'size2', 240, 240, true ); // 2x for sidebar.php
  add_image_size( 'size3', 740, 476, true ); // 2x for archive-event.php
  add_image_size( 'size4', 740, 520, true ); // 2x for archive-interview.php
  add_image_size( 'size5', 570, 570, true ); // 2x for page-type2.php
  add_image_size( 'size6', 414, 264, true ); // 2x for front-page.php
	add_image_size( 'size-card', 130, 130, true ); // For card link

	// Register menus
	register_nav_menus( array(
		'global' => __( 'Global navigation', 'tcd-w' ),
		'footer' => __( 'Footer navigation', 'tcd-w' )
	) );

}
add_action( 'after_setup_theme', 'switch_setup' );

function switch_init() {

  $dp_options = get_design_plus_options();

	// Disable emoji
  disable_emoji();

  // Register custom post type "News"
  $news_label = $dp_options['news_breadcrumb'] ? esc_html( $dp_options['news_breadcrumb'] ) : __( 'News', 'tcd-w' );
  $news_slug = $dp_options['news_slug'] ? esc_html( $dp_options['news_slug'] ) : 'news';
	$news_labels = array(
		'name' => $news_label,
		'add_new' => __( 'Add New', 'tcd-w' ),
		'add_new_item' => __( 'Add New Item', 'tcd-w' ),
		'edit_item' => __( 'Edit', 'tcd-w' ),
		'new_item' => __( 'New item', 'tcd-w' ),
		'view_item' => __( 'View Item', 'tcd-w' ),
		'search_items' => __( 'Search Items', 'tcd-w' ),
		'not_found' => __( 'Not Found', 'tcd-w' ),
		'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
		'parent_item_colon' => ''
	);
	register_post_type( 'news', array(
  	'label' => $news_label,
  	'labels' => $news_labels,
  	'public' => true,
  	'publicly_queryable' => true,
  	'menu_position' => 5,
  	'show_ui' => true,
  	'query_var' => true,
  	'rewrite' => array( 'slug' => $news_slug ),
  	'capability_type' => 'post',
  	'has_archive' => true,
  	'hierarchical' => false,
  	'supports' => array( 'title', 'editor', 'thumbnail' )
 	) );

  // Register custom post type "Event"
  $event_label = $dp_options['event_breadcrumb'] ? esc_html( $dp_options['event_breadcrumb'] ) : __( 'Event', 'tcd-w' );
  $event_slug = $dp_options['event_slug'] ? esc_html( $dp_options['event_slug'] ) : 'event';
	$event_labels = array(
		'name' => $event_label,
		'add_new' => __( 'Add New', 'tcd-w' ),
		'add_new_item' => __( 'Add New Item', 'tcd-w' ),
		'edit_item' => __( 'Edit', 'tcd-w' ),
		'new_item' => __( 'New item', 'tcd-w' ),
		'view_item' => __( 'View Item', 'tcd-w' ),
		'search_items' => __( 'Search Items', 'tcd-w' ),
		'not_found' => __( 'Not Found', 'tcd-w' ),
		'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
		'parent_item_colon' => ''
	);
	register_post_type( 'event', array(
  	'label' => $event_label,
  	'labels' => $event_labels,
  	'public' => true,
  	'publicly_queryable' => true,
  	'menu_position' => 5,
  	'show_ui' => true,
  	'query_var' => true,
  	'rewrite' => array( 'slug' => $event_slug ),
  	'capability_type' => 'post',
  	'has_archive' => true,
  	'hierarchical' => false,
  	'supports' => array( 'title', 'editor', 'thumbnail' )
 	) );

  // Register custom post type "Interview"
  $interview_label = $dp_options['interview_breadcrumb'] ? esc_html( $dp_options['interview_breadcrumb'] ) : __( 'Interview', 'tcd-w' );
  $interview_slug = $dp_options['interview_slug'] ? esc_html( $dp_options['interview_slug'] ) : 'interview';
	$interview_labels = array(
		'name' => $interview_label,
		'add_new' => __( 'Add New', 'tcd-w' ),
		'add_new_item' => __( 'Add New Item', 'tcd-w' ),
		'edit_item' => __( 'Edit', 'tcd-w' ),
		'new_item' => __( 'New item', 'tcd-w' ),
		'view_item' => __( 'View Item', 'tcd-w' ),
		'search_items' => __( 'Search Items', 'tcd-w' ),
		'not_found' => __( 'Not Found', 'tcd-w' ),
		'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
		'parent_item_colon' => ''
	);
	register_post_type( 'interview', array(
  	'label' => $interview_label,
  	'labels' => $interview_labels,
  	'public' => true,
  	'publicly_queryable' => true,
  	'menu_position' => 5,
  	'show_ui' => true,
  	'query_var' => true,
  	'rewrite' => array( 'slug' => $interview_slug ),
  	'capability_type' => 'post',
  	'has_archive' => true,
  	'hierarchical' => false,
  	'supports' => array( 'title', 'thumbnail' )
 	) );

  // Register custom taxonomy "Interview category"
  $interview_category_slug = $dp_options['interview_category_slug'] ? esc_html( $dp_options['interview_category_slug'] ) : 'interview_category';
  $interview_category_labels = array(
    'name' => __( 'Interview categories', 'tcd-w' ),
    'singular_name' => __( 'Interview category', 'tcd-w' )
  );
  register_taxonomy( 'interview_category', 'interview', array(
    'labels' => $interview_category_labels,
  	'hierarchical' => true,
  	'rewrite' => array( 'slug' => $interview_category_slug )
  ) );

  // Register custom post type "FAQ"
  $faq_label = 'FAQ';
  $faq_slug = $dp_options['faq_slug'] ? esc_html( $dp_options['faq_slug'] ) : 'faq';
	$faq_labels = array(
		'name' => $faq_label,
		'add_new' => __( 'Add New', 'tcd-w' ),
		'add_new_item' => __( 'Add New Item', 'tcd-w' ),
		'edit_item' => __( 'Edit', 'tcd-w' ),
		'new_item' => __( 'New item', 'tcd-w' ),
		'view_item' => __( 'View Item', 'tcd-w' ),
		'search_items' => __( 'Search Items', 'tcd-w' ),
		'not_found' => __( 'Not Found', 'tcd-w' ),
		'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
		'parent_item_colon' => ''
	);
	register_post_type( 'faq', array(
  	'label' => $faq_label,
  	'labels' => $faq_labels,
  	'public' => false,
  	'publicly_queryable' => true,
  	'menu_position' => 5,
  	'show_ui' => true,
  	'query_var' => true,
  	'rewrite' => array( 'slug' => $faq_slug ),
  	'capability_type' => 'post',
  	'has_archive' => true,
  	'hierarchical' => false,
    'supports' => array( 'title', 'editor' )
 	) );

  // Register custom taxonomy "FAQ category"
  $faq_category_labels = array(
    'name' => __( 'FAQ categories', 'tcd-w' ),
    'singular_name' => __( 'FAQ category', 'tcd-w' )
  );
  register_taxonomy( 'faq_category', 'faq', array(
    'labels' => $faq_category_labels,
  	'hierarchical' => true,
  ) );

}
add_action( 'init', 'switch_init' );

function disable_emoji() {
  $dp_options = get_design_plus_options();
  if ( $dp_options['use_emoji'] == 0 ) {

    // remove inline script
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    // remove inline style
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    // remove inline style  6.4 later
    if ( function_exists( 'wp_enqueue_emoji_styles' ) ) {
      remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );
      remove_action( 'admin_enqueue_scripts', 'wp_enqueue_emoji_styles' );
    }

    // initだと早いため、admin_initで実行
    add_action( 'admin_init', function(){
      // remove inline script
      remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
      // remove inline style
      remove_action( 'admin_print_styles', 'print_emoji_styles' );
      // remove inline style 6.4 later
      if ( function_exists( 'wp_enqueue_emoji_styles' ) ) {
        remove_action( 'admin_enqueue_scripts', 'wp_enqueue_emoji_styles' );
      }
    } );

  }
}


function switch_template_redirect() {
  if ( ! is_singular( 'faq' ) ) return;

  wp_redirect( get_post_type_archive_link( 'faq' ), 301 );
  exit;
}
add_action( 'template_redirect', 'switch_template_redirect' );

/**
 * Modify the number of posts to display
 */
function switch_pre_get_posts( $query ) {

  $dp_options = get_design_plus_options();

  if ( is_admin() || ! $query->is_main_query() ) {
    return;
  }

  if ( $query->is_post_type_archive( 'news' ) ) {
    $query->set( 'posts_per_page', $dp_options['news_post_num'] );
  } elseif ( $query->is_post_type_archive( 'event' ) ) {
    $query->set( 'posts_per_page', $dp_options['event_post_num'] );
  } elseif ( $query->is_post_type_archive( 'interview' ) || $query->is_tax( 'interview_category' ) ) {
    $query->set( 'posts_per_page', $dp_options['interview_post_num'] );
  }

}
add_action( 'pre_get_posts', 'switch_pre_get_posts' );

/**
 * ビジュアルエディタに表(テーブル)の機能を追加
 */
function mce_external_plugins_table( $plugins ) {
  $plugins['table'] = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/plugins/table/plugin.min.js';
  return $plugins;
}
add_filter( 'mce_external_plugins', 'mce_external_plugins_table' );

/**
 * tinymceのtableボタンにclass属性プルダウンメニューを追加
 */
function mce_buttons_table( $buttons ) {
  $buttons[] = 'table';
  return $buttons;
}
add_filter( 'mce_buttons', 'mce_buttons_table' );

function table_classes_tinymce( $settings ) {
  $styles = array(
    array( 'title' => __( 'Default style', 'tcd-w' ), 'value' => '' ),
    array( 'title' => __( 'No border', 'tcd-w' ), 'value' => 'table_no_border' ),
    array( 'title' => __( 'Display only horizontal border', 'tcd-w' ), 'value' => 'table_border_horizontal' )
  );
  $settings['table_class_list'] = json_encode( $styles );
  return $settings;
}
add_filter( 'tiny_mce_before_init', 'table_classes_tinymce' );

/**
 * Creates sidebars.
 */
function switch_widgets_init() {

  // Base
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Common widget', 'tcd-w' ),
		'id' => 'common_widget'
	) );

  // Posts
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Blog', 'tcd-w' ),
		'id' => 'blog_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Blog (mobile)', 'tcd-w' ),
		'id' => 'blog_widget_sp'
	) );

  // News
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'News', 'tcd-w' ),
		'id' => 'news_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'News (mobile)', 'tcd-w' ),
		'id' => 'news_widget_sp'
	) );

  // Event
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Event', 'tcd-w' ),
		'id' => 'event_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Event (mobile)', 'tcd-w' ),
		'id' => 'event_widget_sp'
	) );

}
add_action( 'widgets_init', 'switch_widgets_init' );

/**
 * Enqueue scripts
 */

function switch_scripts() {

  $dp_options = get_design_plus_options();

  wp_enqueue_style( 'switch-style', get_stylesheet_uri(), false, version_num() );
  wp_enqueue_script( 'switch-t', get_template_directory_uri() . '/assets/js/t.min.js', array( 'jquery' ), version_num(), true );
  wp_enqueue_script( 'switch-script', get_template_directory_uri() . '/assets/js/functions.min.js', array( 'jquery' ), version_num(), true );
  wp_enqueue_script( 'switch-youtube', get_template_directory_uri() . '/assets/js/youtube.min.js', array( 'jquery' ), version_num(), true );

  if ( is_front_page() ) {

    if ( 'type1' === $dp_options['header_content_type'] ) {
      wp_enqueue_style( 'switch-slick', get_template_directory_uri() . '/assets/css/slick.min.css' );
      wp_enqueue_style( 'switch-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.min.css' );
      wp_enqueue_script( 'switch-slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), version_num(), false );
    }

    wp_enqueue_script( 'switch-front-script', get_template_directory_uri() . '/assets/js/front-page.min.js', array( 'jquery' ), version_num(), true );

  }

}

// Priority 12 should be bigger than that of pagebuilder (11)
add_action( 'wp_enqueue_scripts', 'switch_scripts', 12 );

/**
 * Enqueue admin scripts
 */
function switch_admin_scripts( $hook_suffix ) {

  // Media uploader API
  wp_enqueue_media();
  wp_enqueue_script( 'cf-media-field', get_template_directory_uri() . '/admin/assets/js/cf-media-field.min.js', '', version_num() );
  wp_localize_script( 'cf-media-field', 'cfmf_text', array( 'title' => __( 'Please Select Image', 'tcd-w' ), 'button' => __( 'Use this Image', 'tcd-w' ) ) );

	// WordPress Color Picker API
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker');

  // For widgets.php
  if ( 'widgets.php' === $hook_suffix ) {
    wp_enqueue_style( 'switch-widgets', get_template_directory_uri() . '/admin/assets/css/widgets.min.css', '', version_num() );
	  wp_enqueue_script( 'switch-widgets', get_template_directory_uri() . '/admin/assets/js/widget.min.js', array( 'jquery' ), '', version_num() );
  }

  // For theme options
  if ( 'toplevel_page_theme_options' === $hook_suffix ) {
    wp_enqueue_style( 'a-footer-bar', get_template_directory_uri() . '/admin/assets/css/footer-bar.min.css', '', version_num() );
    wp_enqueue_style( 'cb', get_template_directory_uri() . '/admin/assets/css/cb.min.css', '', version_num() );
	  wp_enqueue_script( 'cb', get_template_directory_uri() . '/admin/assets/js/cb.min.js', '', version_num() );
		wp_enqueue_style( 'editor-buttons' ); // editor-buttons.css を常時出力
	  wp_enqueue_script( 'jquery.cookieTab', get_template_directory_uri() . '/admin/assets/js/jquery.cookieTab.js', '', version_num() );
	  wp_enqueue_script( 'jquery-form' ); // For submitting with AJAX
  }

  wp_enqueue_style( 'my-admin', get_template_directory_uri() . '/admin/assets/css/my_admin.css', '', version_num() );
	wp_enqueue_style( 'new_ui_css', get_template_directory_uri() . '/admin/assets/css/new_ui.css', '', version_num() );
	wp_enqueue_script( 'my-script', get_template_directory_uri() . '/admin/assets/js/my_script.js', array( 'jquery' ), version_num(), true );
  wp_localize_script( 'my-script', 'error_messages', array( 'success' => __( 'Settings Saved Successfully', 'tcd-w' ), 'error' => __( 'Can not save data. Please try again.', 'tcd-w' ) ) );
}
add_action( 'admin_enqueue_scripts', 'switch_admin_scripts' );

/**
 * Registers an editor stylesheet for the theme
 */
function switch_add_editor_styles() {
	add_theme_support('editor-styles');
  add_editor_style( get_template_directory_uri()."/admin/assets/css/editor-style.css?d=".date('YmdGis', filemtime(get_template_directory().'/admin/assets/css/editor-style.css')) );
}
add_action( 'admin_init', 'switch_add_editor_styles' );

// 埋め込みコンテンツのレスポンシブ化
add_theme_support( 'responsive-embeds' );

/**
 * Add favicon
 */
function switch_add_favicon() {

  $dp_options = get_design_plus_options();

  if ( $dp_options['favicon'] ) {
    echo '<link rel="shortcut icon" href="' . esc_html( wp_get_attachment_url( $dp_options['favicon'] ) ) . '">' . "\n";
  }

}
add_action( 'wp_head', 'switch_add_favicon' );

/**
 * Manage get_the_archive_title() function
 */
function switch_archive_title( $title ) {

  global $author, $post;

  if ( is_author() ) {
    $title = get_the_author_meta( 'display_name', $author );
  } elseif ( is_category() || is_tag() ) {
    $title = single_term_title( '', false );
  } elseif ( is_day() ) {
    $title = get_the_time( __( 'F jS, Y', 'tcd-w' ), $post );
  } elseif ( is_month() ) {
    $title = get_the_time( __( 'F, Y', 'tcd-w' ), $post );
  } elseif ( is_year() ) {
    $title = get_the_time( __( 'Y', 'tcd-w' ), $post );
  } elseif ( is_search() ) {
    $title = __( 'Search result', 'tcd-w' );
  }

  return $title;

}
add_filter( 'get_the_archive_title', 'switch_archive_title' );

/**
 * Modify the length of excerpts
 */
function switch_excerpt_length( $length ) {
  return 100;
}
add_filter( 'excerpt_length', 'switch_excerpt_length' );

/**
 * Disable self pingback
 */
function no_self_ping( &$links ) {
  $home = home_url();
  foreach ( $links as $l => $link ) {
  	if ( 0 === strpos( $link, $home ) ) {
			unset( $links[$l] );
		}
	}
}
add_action( 'pre_ping', 'no_self_ping' );

/**
 * Remove unnecessary codes from wp_head
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

/**
 * Remove inline styles
 */
add_action( 'widgets_init', 'remove_recent_comments_style' );
add_action( 'get_header', 'remove_adminbar_inline_style' );

function remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}

function remove_adminbar_inline_style() {
  remove_action( 'wp_head', '_admin_bar_bump_cb' );
  remove_action( 'wp_head', 'wp_admin_bar_header' );
  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_admin_bar_bump_styles' );
  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_admin_bar_header_styles' );
}

/**
 * Remove wpautop() function from the_excerpt
 */
remove_filter( 'the_excerpt', 'wpautop' );

/**
 * Theme options
 */
require get_template_directory() . '/admin/theme-options.php';

/**
 * Manage custom columns
 */
require get_template_directory() . '/inc/admin_column.php';

/**
 * Add quicktags to the visual editor
 */
require get_template_directory() . '/inc/custom_editor.php';

/**
 * Add footer bar
 */
require get_template_directory() . '/inc/footer-bar.php';

/*
 * Add load icon
 */
require get_template_directory() . '/inc/load-icon.php';

/**
 * Add inline styles and scripts
 */
require get_template_directory() . '/inc/head.php';
require get_template_directory() . '/inc/footer.php';

/**
 * Add page builder
 */
require get_template_directory() . '/pagebuilder/pagebuilder.php';

/**
 * Manage quick edit
 */
require get_template_directory() . '/inc/quick_edit.php';

/**
 * Add shortcodes
 */
require get_template_directory() . '/inc/short_code.php';

/**
 * Update notifier
 */
require get_template_directory() . '/inc/update_notifier.php';

/**
 * Add manual
 */
require get_template_directory() . '/inc/manual.php';

/**
 * カスタマイザー設定( 外観 > ウィジェットから設定を取り除く)
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom fields
 */
require get_template_directory() . '/inc/class-tcd-meta-box.php';
require get_template_directory() . '/inc/blog_cf.php';
require get_template_directory() . '/inc/recommend.php';
require get_template_directory() . '/inc/interview-cf.php';
require get_template_directory() . '/inc/ph-cf.php';
require get_template_directory() . '/inc/custom_css.php';
require get_template_directory() . '/inc/seo.php';

/**
 * Manage OGP and Twitter Cards
 */
require get_template_directory() . '/inc/ogp.php';

/**
 * Add password protected pages
 */
require get_template_directory() . '/inc/password_form.php';

/**
 * Register widgets
 */
require get_template_directory() . '/inc/widgets/ad.php';
require get_template_directory() . '/inc/widgets/archive_list.php';
require get_template_directory() . '/inc/widgets/category_list.php';
require get_template_directory() . '/inc/widgets/google_search.php';
require get_template_directory() . '/inc/widgets/styled-post-list.php';

/**
 * Add page templates
 */
require get_template_directory() . '/inc/page-template.php';


/**
 * Test if the current browser runs on a mobile device
 */
function is_mobile() {

	// If you want to include tablets, use wp_is_mobile() function.
 	$match = 0;
	$ua = array(
  	'iPhone', // iPhone
   	'iPod', // iPod touch
		'Android.*Mobile', // 1.5+ Android *** Only mobile
		'Windows.*Phone', // *** Windows Phone
		'dream', // Pre 1.5 Android
		'CUPCAKE', // 1.5+ Android
		'BlackBerry', // BlackBerry
		'BB10', // BlackBerry10
		'webOS', // Palm Pre Experimental
		'incognito', // Other iPhone browser
		'webmate' // Other iPhone browser
	);

 	$pattern = '/' . implode( '|', $ua ) . '/i';
 	$match   = preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );

	return 1 === $match ? TRUE : FALSE;
}

/**
 * Translate rgb to hex
 */
function hex2rgb( $hex ) {

   $hex = str_replace( '#', '', $hex );

   if( strlen( $hex ) == 3 ) {
      $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
      $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
      $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
   } else {
      $r = hexdec( substr( $hex, 0, 2 ) );
      $g = hexdec( substr( $hex, 2, 2 ) );
      $b = hexdec( substr( $hex, 4, 2 ) );
   }
   $rgb = array( $r, $g, $b );

   return $rgb;
}

/**
 * Get the version number of this theme
 */
function version_num() {
	if ( function_exists( 'wp_get_theme' ) ) {
		$theme_data = wp_get_theme();
 	} else {
   		$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );
 	}
	$current_version = $theme_data['Version'];
 	return $current_version;
}

/**
 * カードリンクパーツ
 */
function get_the_custom_excerpt( $content, $length ) {
	$length = ( $length ? $length : 70 ); // デフォルトの長さを指定する
  $content =  preg_replace( '/<!--more-->.+/is', '', $content ); // moreタグ以降削除
 	$content =  strip_shortcodes( $content ); // ショートコード削除
  $content =  strip_tags( $content ); // タグの除去
  $content =  str_replace( '&nbsp;', '', $content ); // 特殊文字の削除（今回はスペースのみ）
  $content =  mb_substr( $content, 0, $length ); // 文字列を指定した長さで切り取る
  return $content.'...';
}

/**
 * カードリンクショートコード
 *
 * @param array $atts ユーザーがショートコードタグに指定した属性
 * @return string カードリンクの HTML
 */
function clink_scode( $atts ) {

  // ユーザーがショートコードに指定した属性を、あらかじめ定義した属性と結合
  $atts = shortcode_atts(
    array(
      'url' => '',
      'title' => '',
      'excerpt' => ''
    ),
    $atts
  );

  if ( ! $atts['url'] ) return;

  // URL から投稿 ID を取得
  $id = url_to_postid( $atts['url'] );

  if ( $id ) {
    return get_internal_clink_html( $id, $atts );
  } else {
    return get_external_clink_html( $atts );
  }
}

/**
 * 内部リンクのカードリンクの HTML を作成
 *
 * @param int $id 投稿 ID
 * @param array $atts ユーザーがショートコードタグに指定した属性
 * @return string カードリンクの HTML
 */
function get_internal_clink_html( $id, $atts ) {

  // ID から投稿情報を取得
  $post = get_post( $id );

if(!empty($post)){

  // 投稿日を取得
  $date = mysql2date( 'Y.m.d', $post->post_date );

  $post_date = get_the_time('Ymd',$post);
  $modified_date = get_the_modified_date('Ymd',$post);

  // タイトルを取得
  $title = $atts['title'] ? $atts['title'] : get_the_title( $id );
  $title = is_mobile() ? wp_trim_words( $title, 42, '...' ) : $title;

  // 抜粋を取得
  $excerpt = $atts['excerpt'];

  if ( ! $excerpt ) {
    if ( $post->post_excerpt ) {
      $excerpt = get_the_custom_excerpt( $post->post_excerpt, 150 );
    } else {
      $excerpt = get_the_custom_excerpt( $post->post_content, 150 );
    }
  }

  $excerpt = is_mobile() ? wp_trim_words( $excerpt, 50, '...' ) : $excerpt;

  // アイキャッチ画像を取得
  if ( has_post_thumbnail( $id ) ) {
    $img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'size-card' );
    $img = $img[0];
  } else {
    $img = get_template_directory_uri() . '/assets/images/240x240.gif';
  }

  if($post_date < $modified_date){

  $modified_date = get_the_modified_date('Y.m.d');

  $clink  = '<div class="cardlink">
    <a class="image" href="' . esc_url( $atts['url'] ) . '">
     <img src="' . esc_attr( $img ) . '">
    </a>
    <div class="content">
     <div class="title_area">
      <div class="meta">
       <p class="date">' . esc_html( $date ) . '</p>
       <p class="modified_date">' . esc_html( $modified_date ) . '</p>
      </div>
      <h4 class="title">
       <a href="' . esc_url( $atts['url'] ) . '">' . esc_html( $title ) . '</a>
      </h4>
     </div>
     <p class="desc"><span>' . esc_html( $excerpt ) . '</span></p>
    </div>
   </div>' . "\n";

  } else {

  $clink  = '<div class="cardlink">
    <a class="image" href="' . esc_url( $atts['url'] ) . '">
     <img src="' . esc_attr( $img ) . '">
    </a>
    <div class="content">
     <div class="title_area">
      <div class="meta">
       <p class="date">' . esc_html( $date ) . '</p>
      </div>
      <h4 class="title">
       <a href="' . esc_url( $atts['url'] ) . '">' . esc_html( $title ) . '</a>
      </h4>
     </div>
     <p class="desc"><span>' . esc_html( $excerpt ) . '</span></p>
    </div>
   </div>' . "\n";

  }

  return $clink;

} else {

  return;

}

}

require_once( 'inc/OpenGraph.php' );

/**
 * 外部リンクのカードリンクの HTML を作成
 *
 * @see OpenGraph::fetch()
 *
 * @param array $atts ユーザーがショートコードタグに指定した属性
 * @return string カードリンクの HTML
 */
function get_external_clink_html( $atts ) {

  $graph = OpenGraph::fetch( $atts['url'] );

if(!empty($graph)):
  // タイトルを取得
  $title = $atts['title'] ? $atts['title'] : $graph->title;

  // 抜粋を取得
  $excerpt = $atts['excerpt'] ? $atts['excerpt'] : $graph->description;

  // 画像を取得
  $img = $graph->image ? $graph->image : get_template_directory_uri() . '/assets/images/240x240.gif';

  $clink  = '<div class="cardlink">
    <a class="image" href="' . esc_url( $atts['url'] ) . '">
     <img src="' . esc_attr( $img ) . '">
    </a>
    <div class="content">
     <div class="title_area">
      <h4 class="title">
       <a href="' . esc_url( $atts['url'] ) . '">' . esc_html( $title ) . '</a>
      </h4>
     </div>
     <p class="desc"><span>' . esc_html( $excerpt ) . '</span></p>
    </div>
   </div>' . "\n";

  return $clink;
else:
	return;
endif;
}
add_shortcode( 'clink', 'clink_scode' );

/**
 * Comment
 */
function custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if ( ! $commentcount ) {
		$commentcount = 0;
	}
?>
<li id="comment-<?php comment_ID(); ?>" class="c-comment__list-item comment">
	<div class="c-comment__item-header u-clearfix">
		<div class="c-comment__item-meta u-clearfix">
<?php
	if ( function_exists( 'get_avatar' ) && get_option( 'show_avatars' ) ) {
		echo get_avatar( $comment, 35, '', false, array( 'class' => 'c-comment__item-avatar' ) );
	}
	if ( get_comment_author_url() ) {
		echo '<a id="commentauthor-' . get_comment_ID() . '" class="c-comment__item-author" rel="nofollow">' . get_comment_author() . '</a>' . "\n";
	} else {
		echo '<span id="commentauthor-' . get_comment_ID() . '" class="c-comment__item-author">' . get_comment_author() . '</span>' . "\n";
	}
?>
			<time class="c-comment__item-date" datetime="<?php comment_time( 'Y-m-d' ); ?>"><?php comment_time( __( 'F jS, Y', 'tcd-w' ) ); ?></time>
		</div>
		<ul class="c-comment__item-act">
<?php
	if ( 1 == get_option( 'thread_comments' ) ) :
?>
			<li><?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __( 'REPLY', 'tcd-w' ) . '' ) ) ); ?></li>
<?php
	else :
?>
    	<li><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'js-comment__textarea');"><?php _e( 'REPLY', 'tcd-w' ); ?></a></li>
<?php
	endif;
?>
    	<li><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'js-comment__textarea');"><?php _e( 'QUOTE', 'tcd-w' ); ?></a></li>
    	<?php edit_comment_link( __( 'EDIT', 'tcd-w' ), '<li>', '</li>'); ?>
		</ul>
	</div>
	<div id="comment-content-<?php comment_ID() ?>" class="c-comment__item-body">
<?php
	if ( 0 == $comment->comment_approved ) {
		echo '<span class="c-comment__item-note">' . __( 'Your comment is awaiting moderation.', 'tcd-w' ) . '</span>' . "\n";
	} else {
		comment_text();
	}
?>
	</div>
<?php
}

if ( ! function_exists( 'wp_get_nav_menu_name' ) ) {

	function wp_get_nav_menu_name( $location ) {
		$menu_name = '';

		$locations = get_nav_menu_locations();

		if ( isset( $locations[ $location ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $location ] );

	   	if ( $menu && $menu->name ) {
	    	$menu_name = $menu->name;
	    }
		}

	  /**
	   * Filters the navigation menu name being returned.
	   *
	   * @since 4.9.0
	   *
	   * @param string $menu_name Menu name.
	   * @param string $location  Menu location identifier.
	   */
		return apply_filters( 'wp_get_nav_menu_name', $menu_name, $location );
	}

}


// ウィジェットブロックエディターを無効化 --------------------------------------------------------------------------------
function exclude_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'exclude_theme_support' );


// タイトルとurlをコピーのスクリプト --------------------------------------------------------------------------------
function copy_title_url_script() {
  $dp_options = get_design_plus_options();
  if (is_singular('post') && $dp_options['single_blog_show_copy_btm']) {
    wp_enqueue_script( 'copy_title_url', get_template_directory_uri().'/assets/js/copy_title_url.js', array(), false, true );
  }
}

add_action( 'wp_enqueue_scripts', 'copy_title_url_script' );


// テーブルタグをdivで囲む（the_contentフィルターで実行）ブロックが使われていないエディターのみで動作 ---------------------
add_filter('the_content', function( $content ){
  if( !has_blocks() ){
    $content = str_replace( '<table', '<div class="s_table"><table', $content );
    $content = str_replace( '</table>', '</table></div>', $content );
  }
  return $content;
} );


// videoタグやyoutubeの自動再生に対応しているか判定 ----------------------------------------------
// Android 標準ブラウザは不可、Android版 Chrome ver53以下は不可、iOS ver10以下は不可、それ以外は再生を許可
function auto_play_movie() {
  $ua = mb_strtolower($_SERVER['HTTP_USER_AGENT']);
  // Android -----------------------------------
  if( preg_match('/android/ui', $ua) ) {
    //echo 'Android<br />';
    // 標準ブラウザ
    if (strpos($ua, 'android') !== false && strpos($ua, 'linux; u;') !== false && strpos($ua, 'chrome') === false) {
      return FALSE;
    // Chrome
    } elseif ( preg_match('/(chrome)\/([0-9\.]+)/', $ua , $matches) ){
      $version = floor((int)$matches[2]);
      if($version < 53){
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return TRUE;
    }
  // iOS ---------------------------------------
  } elseif(preg_match('/iphone|ipod|ipad/ui', $ua)) {
    //echo 'iOS<br />';
    if ( preg_match('/(iphone|ipod|ipad) os ([0-9_]+)/', $ua, $matches) ) {
      $matches[2] = str_replace('_', '.', $matches[2]);
      $version = floor((int)$matches[2]);
      if($version < 10){
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return TRUE;
    }
  // PC等、その他のOS ---------------------------------------
  } else {
    //echo 'OTHER OS<br />';
    return TRUE;
  }
}

