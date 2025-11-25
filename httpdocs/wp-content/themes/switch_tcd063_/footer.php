<?php
$dp_options = get_design_plus_options();

$args = array(
  'container' => 'false',
  'menu_class' => 'p-footer-nav',
  'depth' => 1,
  'theme_location' => 'footer'
);
?>
</main>
<footer class="l-footer">

  <?php if ( $dp_options['display_footer_links'] ) : ?>

    <?php if ( 'type1' === $dp_options['footer_links_type'] ) : ?>
    <section id="js-footer-link" class="p-footer-link p-footer-link--<?php echo esc_attr( $dp_options['footer_links_bg_type'] ); ?>">

      <?php if ( ! wp_is_mobile() ) : ?>

        <?php if ( 'video' === $dp_options['footer_links_bg_type'] ) : ?>
        <video src="<?php echo esc_attr( wp_get_attachment_url( $dp_options['footer_links_bg_video'] ) ); ?>" autoplay loop muted></video>
        <?php elseif ( 'youtube' === $dp_options['footer_links_bg_type'] ) : ?>
        <div id="js-footer-link__youtube" class="p-footer-link__youtube" data-video-id="<?php echo esc_attr( $dp_options['footer_links_bg_youtube'] ); ?>"></div>
        <?php endif; ?>

      <?php endif; ?>

      <div class="p-footer-link__inner l-inner">
        <h2 class="p-footer-link__title"><?php echo esc_html( $dp_options['footer_links_catch'] ); ?></h2>
        <p class="p-footer-link__desc"><?php echo nl2br( esc_html( $dp_options['footer_links_desc'] ) ); ?></p>
        <ul class="p-footer-link__list">
          <?php for ( $i = 1; $i <= 2; $i++ ) : ?>
          <?php if ( ! $dp_options['footer_links_banner_img' . $i] ) continue; ?>
          <li class="p-footer-link__list-item p-article07">
            <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_url( $dp_options['footer_links_banner_url' . $i] ); ?>"<?php if ( $dp_options['footer_links_banner_target' . $i] ) { echo ' target="_blank"'; } ?>>
              <span class="p-article07__title"><?php echo esc_html( $dp_options['footer_links_banner_title' . $i] ); ?></span>
              <img src="<?php echo esc_attr( wp_get_attachment_url( $dp_options['footer_links_banner_img' . $i] ) ); ?>" alt="">
            </a>
          </li>
          <?php endfor; ?>
        </ul>
      </div>
    </section>
    <?php else : ?>
    <div id="js-footer-link" class="p-footer-link p-footer-link--img">
      <div class="l-inner"><?php echo $dp_options['footer_links_wyswyg']; ?></div>
    </div>
    <?php endif; ?>

  <?php endif; ?>

  <div class="p-info">
    <div class="p-info__inner l-inner">
      <?php get_template_part( 'template-parts/footer-logo' ); ?>
      <p class="p-info__address"><?php echo nl2br( esc_html( $dp_options['footer_address'] ) ); ?></p>
	    <ul class="p-social-nav">
        <?php if ( $dp_options['facebook_url'] ) : ?>
        <li class="p-social-nav__item p-social-nav__item--facebook"><a href="<?php echo esc_url( $dp_options['facebook_url'] ); ?>"></a></li>
        <?php endif; ?>
        <?php if ( $dp_options['twitter_url'] ) : ?>
        <li class="p-social-nav__item p-social-nav__item--twitter"><a href="<?php echo esc_url( $dp_options['twitter_url'] ); ?>"></a></li>
        <?php endif; ?>
        <?php if ( $dp_options['insta_url'] ) : ?>
        <li class="p-social-nav__item p-social-nav__item--instagram"><a href="<?php echo esc_url( $dp_options['insta_url'] ); ?>"></a></li>
        <?php endif; ?>
        <?php if ( $dp_options['tiktok_url'] ) : ?>
        <li class="p-social-nav__item p-social-nav__item--tiktok"><a href="<?php echo esc_url( $dp_options['tiktok_url'] ); ?>"></a></li>
        <?php endif; ?>
        <?php if ( $dp_options['pinterest_url'] ) : ?>
        <li class="p-social-nav__item p-social-nav__item--pinterest"><a href="<?php echo esc_url( $dp_options['pinterest_url'] ); ?>"></a></li>
        <?php endif; ?>
        <?php if ( $dp_options['mail_url'] ) : ?>
        <li class="p-social-nav__item p-social-nav__item--mail"><a href="<?php echo 'mailto:'.esc_attr( $dp_options['mail_url'] ); ?>"></a></li>
        <?php endif; ?>
        <?php if ( $dp_options['show_rss'] ) : ?>
          <li class="p-social-nav__item p-social-nav__item--rss"><a href="<?php bloginfo( 'rss2_url' ); ?>"></a></li>
        <?php endif; ?>
	    </ul>
    </div>
  </div>
  <?php wp_nav_menu( $args ); ?>
  <p class="p-copyright">
  <small>Copyright &copy; <?php bloginfo( 'name' ); ?> All Rights Reserved.</small>
  </p>
  <button id="js-pagetop" class="p-pagetop"></button>
</footer>
<?php wp_footer(); ?>
</body>
</html>
