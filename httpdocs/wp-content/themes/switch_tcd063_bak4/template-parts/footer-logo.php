<?php
$dp_options = get_design_plus_options();

$use_logo_image = is_mobile() ? $dp_options['sp_footer_use_logo_image'] : $dp_options['footer_use_logo_image'];
$logo_image = is_mobile() ? $dp_options['sp_footer_logo_image'] : $dp_options['footer_logo_image'];
$is_retina = is_mobile() ? $dp_options['sp_footer_logo_image_retina'] : $dp_options['footer_logo_image_retina'];

$max_image_height = is_mobile() ? 60 : 80;
$logo_image_data = wp_get_attachment_image_src( $logo_image, 'full' );
if($logo_image_data) {
  $image_width = $logo_image_data[1];
  $image_height = $logo_image_data[2];
  if($is_retina) {
    $image_width = round($image_width / 2);
    $image_height = round($image_height / 2);
  };
};

?>
<div class="p-info__logo c-logo<?php if ( $is_retina ) { echo ' c-logo--retina'; } ?>">
  <?php if ( 'type1' === $use_logo_image ) : ?>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
  <?php else : ?>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
  <?php if( ('type2' === $use_logo_image) ){ ?>
      <?php if( ($image_height <= $max_image_height) ){ ?>
      <img src="<?php echo wp_get_attachment_url( $logo_image ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>">
    <?php } else { ?>
      <img src="<?php echo wp_get_attachment_url( $logo_image ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="auto" height="<?php echo esc_attr($max_image_height); ?>">
      <?php }; ?>
    <?php }; ?>
  </a>
  <?php endif; ?>
</div>
