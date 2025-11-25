<?php
$dp_options = get_design_plus_options();

$header_fix = is_mobile() ? $dp_options['sp_header_fix'] : $dp_options['header_fix'];

$args = array(
  'container' => 'nav',
  'container_class' => 'p-global-nav',
  'container_id' => 'js-global-nav',
  'link_after' => '<span class="p-global-nav__toggle"></span>',
  'theme_location' => 'global'
);
?>
<!doctype html>
<html <?php language_attributes(); ?> prefix="og: https://ogp.me/ns#">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php seo_description(); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'tcd_before_header', $dp_options ); ?>
<?php
     // メッセージ --------------------------------------------------------------------
     if(!is_404()){
       if( $dp_options['show_header_message'] ) {
         $message = $dp_options['header_message'];
         $url = $dp_options['header_message_url'];
         $font_color = $dp_options['header_message_font_color'];
         $bg_color = $dp_options['header_message_bg_color'];
         if($message){
?>
<div id="header_message" style="color:<?php esc_attr_e($font_color); ?>;background-color:<?php esc_attr_e($bg_color); ?>;">
  <?php if($url){ ?>
  <a href="<?php echo esc_url($url); ?>" class="label"><?php echo wp_kses_post(nl2br($message)); ?></a>
  <?php }else{ ?>
  <p class="label"><?php echo wp_kses_post(nl2br($message)); ?></p>
  <?php } ?>
</div>
<?php if(wp_is_mobile() && $header_fix == 'type1'){ } else { ?>
<script>
(function($) {
  $(window).on('load resize', function(){
    var header_message_height = $("#header_message").innerHeight();
    $('#js-header').css('top',header_message_height);
  });
})(jQuery);
</script>
<?php }; ?>
<?php
         };
       };
     };
?>
<header id="js-header" class="l-header<?php if ( 'type2' === $header_fix ) { echo ' l-header--fixed'; } ?>">
  <div class="l-header__inner l-inner">
    <?php get_template_part( 'template-parts/logo' ); ?>
    <button id="js-menu-btn" class="p-menu-btn c-menu-btn"></button>
    <?php wp_nav_menu( $args ); ?>
  </div>
</header>
<main class="l-main">
  <?php
  if ( ! is_front_page() ) {
    get_template_part( 'template-parts/page-header' );
  }
  ?>
