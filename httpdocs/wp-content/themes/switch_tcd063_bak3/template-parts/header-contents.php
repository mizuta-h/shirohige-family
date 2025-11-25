<?php $dp_options = get_design_plus_options(); ?>

<?php if ( 'type1' === $dp_options['header_content_type'] ) : // Image ?>
<div id="js-header-slider" class="p-header-slider" data-speed="<?php echo esc_attr( $dp_options['header_slider_animation_time'] * 1000 ); ?>">

  <?php
  for ( $i = 1; $i <= 5; $i++ ) :
    if ( ! $dp_options['header_slider_img' . $i] ) continue;
  ?>
  <div class="p-header-slider__item p-header-slider__item--<?php echo esc_attr( $i ); ?> p-header-content">
    <div class="p-header-content__inner">
      <div class="p-header-content__title<?php if ( 'type1' === $dp_options['header_slider_catch_writing_mode' . $i] ) { echo ' p-header-content__title--vertical'; } ?>">
      <span><?php echo nl2br( esc_html( $dp_options['header_slider_catch' . $i] ) ); ?></span>
      </div>
    </div>
    <div class="p-header-slider__item-img p-header-slider__item-img--<?php echo esc_attr( $dp_options['header_slider_img_animation_type' . $i] ); ?>" data-animation="<?php if ( 'type3' !== $dp_options['header_slider_img_animation_type' . $i] ) { echo '1'; } ?>"></div>
  </div>
  <?php endfor; ?>

</div>

<?php elseif ( 'type2' === $dp_options['header_content_type'] ) : // Video ?>
<div id="js-header-video" class="p-header-video p-header-content is-active">
<?php $image = isset($dp_options['header_video_img']) ? wp_get_attachment_image_src( $dp_options['header_video_img'], 'full' ) : '';?>
  <?php  if(wp_is_mobile() && $dp_options['header_mobile_hide_setting_video'] && $image){ ?>
    <div class="bg_image class">
       <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
    </div>
  <?php } else if( $dp_options['header_video'] && auto_play_movie()) { ?>
  <video autoplay loop muted playsinline>
  <source src="<?php echo esc_attr( wp_get_attachment_url( $dp_options['header_video'] ) ); ?>">
  </video>
  <?php }else{ ?>
  <div class="bg_image">
       <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
    </div>
    <?php }?>
  <div class="p-header-content__inner">
    <div class="p-header-content__title<?php if ( 'type1' === $dp_options['header_video_catch_writing_mode'] ) { echo ' p-header-content__title--vertical'; } ?>">
      <span><?php echo nl2br( esc_html( $dp_options['header_video_catch'] ) ); ?></span>
    </div>
  </div>
</div>

<?php elseif ( 'type3' === $dp_options['header_content_type'] ) : // YouTube ?>
<div id="js-header-youtube" class="p-header-youtube p-header-content is-active">
<?php  $image = isset($dp_options['header_youtube_img']) ? wp_get_attachment_image_src( $dp_options['header_youtube_img'], 'full' ) : '';?>
<?php  if(wp_is_mobile() && $dp_options['header_mobile_hide_setting_yutu'] && $image){ ?>
  <div class="bg_image">
   <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
  </div>
  <?php }else if( $dp_options['header_youtube_id'] && auto_play_movie() ) { ?>
  <div>
    <div id="js-header-youtube__player" class="p-header-youtube__player" data-video-id="<?php echo esc_attr( $dp_options['header_youtube_id'] ); ?>"></div>
  </div>
  <?php }else{ ?>
      <div class="bg_image">
   <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
  </div>
  <?php }?>
  <div class="p-header-content__inner">
    <div class="p-header-content__title<?php if ( 'type1' === $dp_options['header_youtube_catch_writing_mode'] ) { echo ' p-header-content__title--vertical'; } ?>">
      <span><?php echo nl2br( esc_html( $dp_options['header_youtube_catch'] ) ); ?></span>
    </div>
  </div>
</div>
<?php endif; ?>
