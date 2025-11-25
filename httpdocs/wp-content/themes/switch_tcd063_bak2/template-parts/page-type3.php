<div class="p-desc l-inner"><?php echo wpautop( $post->page_type3_a ); ?></div>

<?php if ( isset( $post->page_type3_b['headline'][0] ) ) : ?>
<div class="l-inner">

  <?php foreach ( array_keys( $post->page_type3_b['headline'] ) as $index ) : ?>
  <div class="p-block01">
    <h2 class="p-block01__title"><?php echo esc_html( $post->page_type3_b['headline'][$index] ); ?></h2>
    <?php if ( isset( $post->page_type3_b['img'][$index] ) ) : ?>
    <img class="p-block01__upper" src="<?php echo esc_attr( wp_get_attachment_url( $post->page_type3_b['img'][$index] ) ); ?>" alt="">
    <?php endif; ?>
    <div class="p-block01__lower<?php if ( 'type2' === $post->page_type3_b['b1_layout'][$index] ) { echo ' p-block01__lower--rev'; } ?>">
      <div class="p-block01__lower-item p-block01__lower-item--img">
        <?php if ( isset( $post->page_type3_b['b1_img'][$index] ) ) : ?>
        <img src="<?php echo esc_attr( wp_get_attachment_url( $post->page_type3_b['b1_img'][$index] ) ); ?>" alt="">
        <?php endif; ?>
      </div>
      <div class="p-block01__lower-item p-block01__lower-item--content">
        <h3 class="p-block01__lower-title"><?php echo esc_html( $post->page_type3_b['b1_headline'][$index] ); ?></h3>
        <p class="p-block01__lower-desc"><?php echo nl2br( $post->page_type3_b['b1_desc'][$index] ); ?></p>
      </div>
    </div>
  </div><!-- /.p-block01 -->
  <div class="p-block02<?php if ( 'type2' === $post->page_type3_b['b2_layout'][$index] ) { echo ' p-block02--rev'; } ?>">
    <div class="p-block02__item p-block02__item--content">
      <h3 class="p-block02__item-title"><?php echo esc_html( $post->page_type3_b['b2_headline'][$index] ); ?></h3>
      <p class="p-block02__item-desc"><?php echo nl2br( $post->page_type3_b['b2_desc'][$index] ); ?></p>
    </div>
    <?php if ( isset( $post->page_type3_b['b2_img'][$index] ) ) : ?>
    <div class="p-block02__item p-block02__item--img">
      <img src="<?php echo esc_html( wp_get_attachment_url( $post->page_type3_b['b2_img'][$index] ) ); ?>" alt="">
    </div>
    <?php endif; ?>
  </div><!-- /.p-block02 -->

  <?php if ( $post->page_type3_b['b3_headline_1'][$index] ) : ?>
  <div class="p-block03">
    <div class="p-block03__item">
      <h4 class="p-block03__item-title"><?php echo esc_html( $post->page_type3_b['b3_headline_1'][$index] ); ?></h4>
      <p class="p-block03__item-desc"><?php echo nl2br( $post->page_type3_b['b3_desc_1'][$index] ); ?></p>
    </div>
    <div class="p-block03__item">
      <h4 class="p-block03__item-title"><?php echo esc_html( $post->page_type3_b['b3_headline_2'][$index] ); ?></h4>
      <p class="p-block03__item-desc"><?php echo nl2br( $post->page_type3_b['b3_desc_2'][$index] ); ?></p>
    </div>
    <div class="p-block03__item">
      <h4 class="p-block03__item-title"><?php echo esc_html( $post->page_type3_b['b3_headline_3'][$index] ); ?></h4>
      <p class="p-block03__item-desc"><?php echo nl2br( $post->page_type3_b['b3_desc_3'][$index] ); ?></p>
    </div>
  </div><!-- /.p-block03 -->
  <?php endif; ?>

  <?php endforeach; ?>
</div><!-- /.l-inner -->
<?php endif; ?>

<?php if ( isset( $post->page_type3_c ) ) : ?>
<div class="p-cover">
  <img src="<?php echo esc_attr( wp_get_attachment_url( $post->page_type3_c ) ); ?>" alt="">
</div>
<?php endif; ?>

<?php if ( isset( $post->page_type3_d['headline'][0] ) ) : ?>
<div class="l-inner">

  <?php foreach ( array_keys( $post->page_type3_d['headline'] ) as $index ) : ?>
  <div class="p-block01">
    <h2 class="p-block01__title"><?php echo esc_html( $post->page_type3_d['headline'][$index] ); ?></h2>
    <?php if ( isset( $post->page_type3_d['img'][$index] ) ) : ?>
    <img class="p-block01__upper" src="<?php echo esc_attr( wp_get_attachment_url( $post->page_type3_d['img'][$index] ) ); ?>" alt="">
    <?php endif; ?>
    <div class="p-block01__lower<?php if ( 'type2' === $post->page_type3_d['b1_layout'][$index] ) { echo ' p-block01__lower--rev'; } ?>">
      <div class="p-block01__lower-item p-block01__lower-item--img">
        <?php if ( isset( $post->page_type3_d['b1_img'][$index] ) ) : ?>
        <img src="<?php echo esc_attr( wp_get_attachment_url( $post->page_type3_d['b1_img'][$index] ) ); ?>" alt="">
        <?php endif; ?>
      </div>
      <div class="p-block01__lower-item p-block01__lower-item--content">
        <h3 class="p-block01__lower-title"><?php echo esc_html( $post->page_type3_d['b1_headline'][$index] ); ?></h3>
        <p class="p-block01__lower-desc"><?php echo nl2br( $post->page_type3_d['b1_desc'][$index] ); ?></p>
      </div>
    </div>
  </div><!-- /.p-block01 -->
  <div class="p-block02<?php if ( 'type2' === $post->page_type3_d['b2_layout'][$index] ) { echo ' p-block02--rev'; } ?>">
    <div class="p-block02__item p-block02__item--content">
      <h3 class="p-block02__item-title"><?php echo esc_html( $post->page_type3_d['b2_headline'][$index] ); ?></h3>
      <p class="p-block02__item-desc"><?php echo nl2br( $post->page_type3_d['b2_desc'][$index] ); ?></p>
    </div>
    <?php if ( isset( $post->page_type3_d['b2_img'][$index] ) ) : ?>
    <div class="p-block02__item p-block02__item--img">
      <img src="<?php echo esc_html( wp_get_attachment_url( $post->page_type3_d['b2_img'][$index] ) ); ?>" alt="">
    </div>
    <?php endif; ?>
  </div><!-- /.p-block02 -->

  <?php if ( $post->page_type3_d['b3_headline_1'][$index] ) : ?>
  <div class="p-block03 p-block03--more-margin">
    <div class="p-block03__item">
      <h4 class="p-block03__item-title"><?php echo esc_html( $post->page_type3_d['b3_headline_1'][$index] ); ?></h4>
      <p class="p-block03__item-desc"><?php echo nl2br( esc_html( $post->page_type3_d['b3_desc_1'][$index] ) ); ?></p>
    </div>
    <div class="p-block03__item">
      <h4 class="p-block03__item-title"><?php echo esc_html( $post->page_type3_d['b3_headline_2'][$index] ); ?></h4>
      <p class="p-block03__item-desc"><?php echo nl2br( esc_html( $post->page_type3_d['b3_desc_2'][$index] ) ); ?></p>
    </div>
    <div class="p-block03__item">
      <h4 class="p-block03__item-title"><?php echo esc_html( $post->page_type3_d['b3_headline_3'][$index] ); ?></h4>
      <p class="p-block03__item-desc"><?php echo nl2br( esc_html( $post->page_type3_d['b3_desc_3'][$index] ) ); ?></p>
    </div>
  </div><!-- /.p-block03 -->
  <?php endif; ?>

  <?php endforeach; ?>
</div><!-- /.l-inner -->
<?php endif; ?>
