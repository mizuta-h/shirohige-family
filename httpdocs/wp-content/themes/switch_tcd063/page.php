<?php
$dp_options = get_design_plus_options();

get_header();
?>
  <div class="l-contents<?php if ( 'type1' === $post->page_tcd_template_type || post_password_required() ) { echo ' l-inner'; } ?>">
    <div class="l-primary">
      <?php
      if ( have_posts() ) {
        while ( have_posts() ) {
          the_post();
          $pagenation_type = $options['pagenation_type'];

          if ( 'type1' === $post->page_tcd_template_type ) {

            echo '<div class="p-entry__body p-entry__body--page">' . "\n";
            the_content();
            if ( ! post_password_required() ) {
              if ( 'type2' === $pagenation_type ) {
                if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ) :
              ?>
              <div class="p-readmore">
                <a class="p-readmore__btn p-btn" href="<?php echo esc_url( $matches[1] ); ?>"><?php _e( 'Read more', 'tcd-w' ); ?></a>
                <p class="p-readmore__num"><?php echo $page . ' / ' . $numpages; ?></p>
              </div>
              <?php
                endif;
              } else {
                wp_link_pages( array(
                  'before' => '<div class="p-page-links">',
                  'after' => '</div>',
                  'link_before' => '<span>',
                  'link_after' => '</span>'
                ) );
              }
            }
            echo '</div>' . "\n";

          } else {

            if ( post_password_required() ) {
              echo get_the_password_form( $post->ID );
            } else {
              get_template_part( 'template-parts/page-' . $post->page_tcd_template_type );
            }

          }
        }
      }
      ?>
    </div><!-- /.l-primary -->
  </div><!-- /.l-contents -->
<?php get_footer(); ?>
