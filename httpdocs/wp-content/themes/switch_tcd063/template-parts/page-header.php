<?php
$dp_options = get_design_plus_options();

if ( is_post_type_archive( 'news' ) || is_singular( 'news' ) ) {

  $ph_title = $dp_options['news_ph_title'];
  $ph_desc = $dp_options['news_ph_desc'];
  $ph_desc_writing_mode = $dp_options['news_ph_desc_writing_mode'];
  $ph_img_animation_type = $dp_options['news_ph_img_animation_type'];
  $ph_img = wp_get_attachment_url( $dp_options['news_ph_img'] );

} elseif ( is_post_type_archive( 'event' ) || is_singular( 'event' ) ) {

  $ph_title = $dp_options['event_ph_title'];
  $ph_desc = $dp_options['event_ph_desc'];
  $ph_desc_writing_mode = $dp_options['event_ph_desc_writing_mode'];
  $ph_img_animation_type = $dp_options['event_ph_img_animation_type'];
  $ph_img = wp_get_attachment_url( $dp_options['event_ph_img'] );

} elseif ( is_post_type_archive( 'interview' ) || is_singular( 'interview' ) || is_tax( 'interview_category' ) ) {

  $ph_title = $dp_options['interview_ph_title'];
  $ph_desc = $dp_options['interview_ph_desc'];
  $ph_desc_writing_mode = $dp_options['interview_ph_desc_writing_mode'];
  $ph_img_animation_type = $dp_options['interview_ph_img_animation_type'];
  $ph_img = wp_get_attachment_url( $dp_options['interview_ph_img'] );

} elseif ( is_post_type_archive( 'faq' ) ) {

  $ph_title = $dp_options['faq_ph_title'];
  $ph_desc = $dp_options['faq_ph_desc'];
  $ph_desc_writing_mode = $dp_options['faq_ph_desc_writing_mode'];
  $ph_img_animation_type = $dp_options['faq_ph_img_animation_type'];
  $ph_img = wp_get_attachment_url( $dp_options['faq_ph_img'] );

} elseif ( is_page() ) {

  $ph_title = $post->ph_title;
  $ph_desc = $post->ph_desc;
  $ph_desc_writing_mode = $post->ph_desc_writing_mode;
  $ph_img_animation_type = $post->ph_img_animation_type;
  $ph_img = wp_get_attachment_url( $post->ph_img );

} elseif ( is_404() ) {

  $ph_title = $dp_options['404_ph_title'];
  $ph_desc = $dp_options['404_ph_desc'];
  $ph_desc_writing_mode = $dp_options['404_ph_desc_writing_mode'];
  $ph_img_animation_type = $dp_options['404_ph_img_animation_type'];
  $ph_img = wp_get_attachment_url( $dp_options['404_ph_img'] );

} elseif ( is_category() ){

  $ph_title = $dp_options['ph_title'];
  $queried_object = get_queried_object();
  $catchphrase = esc_html( $queried_object->name );
  $ph_desc = $queried_object->description;
  $ph_desc = $ph_desc? $ph_desc : $dp_options['ph_desc'];
  $ph_desc_writing_mode = $dp_options['ph_desc_writing_mode'];
  $ph_img_animation_type = $dp_options['ph_img_animation_type'];
  $ph_img = wp_get_attachment_url( $dp_options['ph_img'] );

} else {

  $ph_title = $dp_options['ph_title'];
  $ph_desc = $dp_options['ph_desc'];
  $ph_desc_writing_mode = $dp_options['ph_desc_writing_mode'];
  $ph_img_animation_type = $dp_options['ph_img_animation_type'];
  $ph_img = wp_get_attachment_url( $dp_options['ph_img'] );
}
?>
  <header id="js-page-header" class="p-page-header">
    <?php if ( is_home() || is_post_type_archive() || is_page() || is_404() ) : ?>
    <h1 class="p-page-header__title"><?php echo esc_html( $ph_title ); ?></h1>
    <?php else : ?>
    <div class="p-page-header__title"><?php echo esc_html( $ph_title ); ?></div>
    <?php endif; ?>
    <div class="p-page-header__inner l-inner">
      <p id="js-page-header__desc" class="p-page-header__desc<?php if ( 'type2' === $ph_desc_writing_mode ) { echo ' p-page-header__desc--vertical'; } ?>"><span><?php echo nl2br( esc_html( $ph_desc ) ); ?></span></p>
    </div>
    <div id="js-page-header__img" class="p-page-header__img p-page-header__img--<?php echo esc_attr( $ph_img_animation_type ); ?>">
      <img src="<?php echo esc_attr( $ph_img ); ?>" alt="">
    </div>
  </header>
