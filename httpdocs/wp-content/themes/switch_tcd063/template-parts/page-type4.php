<div class="p-desc l-inner"><?php echo wpautop( $post->page_type4_a ); ?></div>
<div class="l-inner">
  <?php if ( $post->page_type4_b ) : ?>
  <div class="p-block01">
    <img class="p-block01__upper" src="<?php echo esc_attr( wp_get_attachment_url( $post->page_type4_b ) ); ?>" alt="">
  </div><!-- /.p-block01 -->
  <?php endif; ?>
  <div class="p-block02 p-block02--sm-margin">
    <div class="p-block02__item p-block02__item--content">
    <h2 class="p-block02__item-title"><?php echo nl2br( esc_html( $post->page_type4_c_1 ) ); ?></h2>
      <p class="p-block02__item-desc"><?php echo nl2br( $post->page_type4_c_2 ); ?></p>
    </div>
    <div class="p-block02__item p-block02__item--content">
      <h2 class="p-block02__item-title"><?php echo nl2br( esc_html( $post->page_type4_c_3 ) ); ?></h2>
      <p class="p-block02__item-desc"><?php echo nl2br( $post->page_type4_c_4 ); ?></p>
    </div>
  </div><!-- /.p-block02 -->
</div><!-- /.l-inner -->
<div class="p-plan">
  <div class="l-inner">
  <?php if($post->page_type4_d_1!=''): ?>
    <div class="p-plan__header">
      <h2 class="p-plan__title p-plan__header-item"><?php echo esc_html( $post->page_type4_d_1 ); ?></h2>
      <p class="p-plan__sub p-plan__header-item"><?php echo nl2br( esc_html( $post->page_type4_d_2 ) ); ?></p>
    </div>
  <?php endif; ?>
    <p class="p-plan__catch"><?php echo nl2br( esc_html( $post->page_type4_d_3 ) ); ?></p>
    <p class="p-plan__desc"><?php echo nl2br( $post->page_type4_d_4 ); ?></p>

    <div class="p-plan__table p-plan-list">

      <?php for ( $i = 5; $i <= 7; $i++ ) : ?>

      <?php
      $values = get_post_meta( $post->ID, "page_type4_d_{$i}", true );
      if($values['name']!=''):
      ?>

      <?php if ( isset( $values['strong'] ) ) : ?>
      <dl class="p-plan-list__item p-plan-table01 p-plan-table01--strong" style="border-color: <?php echo esc_attr( $values['name_bg'] ); ?>">
      <?php else : ?>
      <dl class="p-plan-list__item p-plan-table01">
      <?php endif; ?>

        <dt class="p-plan-table01__title" style="background: <?php echo esc_attr( $values['name_bg'] ); ?>;"><?php echo esc_html( $values['name'] ); ?></dt>
        <dd class="p-plan-table01__data p-plan-table01__data--price" style="background: <?php echo esc_attr( $values['price_bg'] ); ?>;">
          <p class="p-plan-table01__price" style="color: <?php echo esc_attr( $values['price_color'] ); ?>"><span class="p-plan-table01__unit"><?php echo esc_html( $values['unit'] ); ?></span><?php echo esc_html( $values['price'] ); ?></p>
          <p class="p-plan-table01__per"><?php echo esc_html( $values['per'] ); ?></p>
        </dd>
        <?php
        if ( isset( $values['data'][0] ) ) :
          foreach ( $values['data'] as $data ) :
        ?>
        <dd class="p-plan-table01__data"><?php echo esc_html( $data ); ?></dd>
        <?php
          endforeach;
        endif;
        ?>
      </dl>
      <?php endif; endfor; ?>

      <?php /*
      <dl class="p-plan-list__item p-plan-table01 p-plan-table01--strong">
        <dt class="p-plan-table01__title">デイタイムプラン</dt>
        <dd class="p-plan-table01__data p-plan-table01__data--price">
          <p class="p-plan-table01__price"><span class="p-plan-table01__unit">¥</span>5,000</p>
          <p class="p-plan-table01__per">月額</p>
        </dd>
        <dd class="p-plan-table01__data">入会金0円</dd>
        <dd class="p-plan-table01__data">平日：10時〜18時</dd>
        <dd class="p-plan-table01__data">土日祝：利用ナシ</dd>
        <dd class="p-plan-table01__data">コアタイムでの利用に最適なプラン</dd>
      </dl>
      */ ?>

    </div>

    <?php for ( $i = 8; $i <= 10; $i++ ) : ?>

      <?php
      $headline = get_post_meta( $post->ID, "page_type4_d_{$i}_headline", true );
      $headline_bg = get_post_meta( $post->ID, "page_type4_d_{$i}_headline_bg", true );
      $table = get_post_meta( $post->ID, "page_type4_d_{$i}_table", true );
      ?>

      <?php if ( $headline && $table['name'][0] ) : ?>
      <table class="p-plan__table p-plan-table02">
        <caption class="p-plan-table02__caption" style="background: <?php echo esc_attr( $headline_bg ); ?>;"><?php echo esc_html( $headline ); ?></caption>
        <?php foreach ( array_keys( $table['name'] ) as $index ) : ?>

          <?php if ( is_mobile() ) : ?>
          <tr>
            <td class="p-plan-table02__data p-plan-table02__data--name" rowspan="2"><?php echo esc_html( $table['name'][$index] ); ?></td>
            <td class="p-plan-table02__data p-plan-table02__data--desc"><?php echo esc_html( $table['content'][$index] ); ?></td>
          </tr>
          <tr>
            <td class="p-plan-table02__data p-plan-table02__data--price"><?php echo esc_html( $table['price'][$index] ); ?></td>
          </tr>
          <?php else : ?>
          <tr>
            <td class="p-plan-table02__data p-plan-table02__data--name"><?php echo esc_html( $table['name'][$index] ); ?></td>
            <td class="p-plan-table02__data p-plan-table02__data--desc"><?php echo esc_html( $table['content'][$index] ); ?></td>
            <td class="p-plan-table02__data p-plan-table02__data--price"><?php echo esc_html( $table['price'][$index] ); ?></td>
          </tr>
          <?php endif; ?>

        <?php endforeach; ?>
      </table>
      <?php endif; ?>

    <?php endfor; ?>

    <h3 class="p-plan__notice-title"><?php echo esc_html( $post->page_type4_d_11_headline ); ?></h3>
    <p class="p-plan__notice-desc"><?php echo nl2br( $post->page_type4_d_11_desc ); ?></p>
  </div><!-- /.l-inner -->
</div><!-- /.p-plan -->
<div class="p-spec l-inner">
  <?php if ( $post->page_type4_e ) : ?>
  <div class="p-spec__img">
    <img src="<?php echo esc_attr( wp_get_attachment_url( $post->page_type4_e ) ); ?>" alt="">
  </div>
  <?php endif; ?>
  <h2 class="p-spec__title"><?php echo nl2br( esc_html( $post->page_type4_f_1 ) ); ?></h2>
  <p class="p-spec__desc"><?php echo nl2br( $post->page_type4_f_2 ); ?></p>

  <?php if ( isset( $post->page_type4_g['desc'][0] ) ) : ?>
  <div class="p-block05" style="background: <?php echo esc_attr( $post->page_type4_g_bg ); ?>">
    <?php
    foreach ( array_keys( $post->page_type4_g['desc'] ) as $index ) :
      $icon_type = isset( $post->page_type4_g['icon_type'][$index] ) ? $post->page_type4_g['icon_type'][$index] : 'type1';
      $icon_font = isset( $post->page_type4_g['icon_font'][$index] ) ? $post->page_type4_g['icon_font'][$index] : 'type1';
      $icon_img = isset( $post->page_type4_g['icon_img'][$index] ) ? $post->page_type4_g['icon_img'][$index] : '';
      $desc = $post->page_type4_g['desc'][$index];
    ?>
    <div class="p-block05__item">
      <?php if ( 'type1' === $icon_type ) : ?>
      <p class="p-block05__item-icon p-block05__item-icon--<?php echo esc_attr( $icon_font ); ?>"></p>
      <?php else : ?>
      <p class="p-block05__item-icon">
        <img src="<?php echo wp_get_attachment_url( $icon_img ); ?>" alt="">
      </p>
      <?php endif; ?>
      <p class="p-block05__item-desc"><?php echo nl2br( $desc ); ?></p>
    </div>
    <?php endforeach; ?>
  </div><!-- / .p-block05 -->
  <?php endif; ?>
  <div class="p-block03 p-block03--no-border">
    <div class="p-block03__item">
      <h3 class="p-block03__item-title"><?php echo esc_html( $post->page_type4_h_1_headline ); ?></h3>
      <div class="p-block03__item-desc"><?php echo wpautop( $post->page_type4_h_1_desc ); ?></div>
    </div>
    <div class="p-block03__item">
      <h3 class="p-block03__item-title"><?php echo esc_html( $post->page_type4_h_2_headline ); ?></h3>
      <div class="p-block03__item-desc"><?php echo wpautop( $post->page_type4_h_2_desc ); ?></div>
    </div>
    <div class="p-block03__item">
      <h3 class="p-block03__item-title"><?php echo esc_html( $post->page_type4_h_3_headline ); ?></h3>
      <div class="p-block03__item-desc"><?php echo wpautop( $post->page_type4_h_3_desc ); ?></div>
    </div>
    <div class="p-block03__item">
      <h3 class="p-block03__item-title"><?php echo esc_html( $post->page_type4_h_4_headline ); ?></h3>
      <div class="p-block03__item-desc"><?php echo wpautop( $post->page_type4_h_4_desc ); ?></div>
    </div>
  </div><!-- /.p-block03 -->
</div><!-- /.l-inner -->
