<?php if ( $post->page_type2_a ) : ?>
<div class="p-desc l-inner"><?php echo wpautop( $post->page_type2_a ); ?></div>
<?php endif; ?>
<?php if ( isset( $post->page_type2_b['headline'][0] ) ) : ?>
<div class="l-inner">
  <?php foreach ( array_keys( $post->page_type2_b['headline'] ) as $index ) : ?>
  <div class="p-block04<?php if ( 'type2' === $post->page_type2_b['layout'][$index] ) { echo ' p-block04--rev'; } ?>">
    <div class="p-block04__item p-block04__item--img">
      <?php
      for ( $i = 1; $i <= 4; $i++ ) {
        if ( isset( $post->page_type2_b['img' . $i][$index] ) ) {
          echo wp_get_attachment_image( $post->page_type2_b['img' . $i][$index], 'size5' );
        }
      }
      ?>
    </div>
    <div class="p-block04__item p-block04__item--content">
      <h2 class="p-block04__title"><?php echo esc_html( $post->page_type2_b['headline'][$index] ); ?></h2>
      <p class="p-block04__desc"><?php echo nl2br( $post->page_type2_b['desc'][$index] ); ?></p>
    </div>
  </div><!-- /.p-block04 -->
  <?php endforeach; ?>
</div><!-- /.l-inner -->
<?php endif; ?>
<?php if ( isset( $post->page_type2_c ) ) : ?>
<div class="p-cover">
  <img src="<?php echo esc_attr( wp_get_attachment_url( $post->page_type2_c ) ); ?>" alt="">
</div>
<?php endif; ?>
<div class="l-inner">
  <div class="p-block01">
    <h2 class="p-block01__title p-block01__title--sm"><?php echo esc_html( $post->page_type2_d ); ?></h2>
    <?php if ( isset( $post->page_type2_e ) ) : ?>
    <img class="p-block01__upper" src="<?php echo esc_attr( wp_get_attachment_url( $post->page_type2_e ) ); ?>" alt="">
    <?php endif; ?>
  </div><!-- /.p-block01 -->

  <?php if ( isset( $post->page_type2_f['headline'][0] ) ) : ?>
    <?php foreach ( array_keys( $post->page_type2_f['headline'] ) as $index ) : ?>
    <div class="p-block02<?php if ( 'type2' === $post->page_type2_f['layout'][$index] ) { echo ' p-block02--rev'; } ?>">
      <div class="p-block02__item p-block02__item--content">
        <h3 class="p-block02__item-title"><?php echo nl2br( esc_html( $post->page_type2_f['headline'][$index] ) ); ?></h3>
        <p class="p-block02__item-desc"><?php echo nl2br( $post->page_type2_f['desc'][$index] ); ?></p>
      </div>
      <?php if ( isset( $post->page_type2_f['img'][$index] ) ) : ?>
      <div class="p-block02__item p-block02__item--img">
        <img src="<?php echo esc_attr( wp_get_attachment_url( $post->page_type2_f['img'][$index] ) ); ?>" alt="">
      </div>
      <?php endif; ?>
    </div><!-- /.p-block02 -->
    <?php endforeach; ?>
  <?php endif; ?>

</div><!-- /.l-inner -->
