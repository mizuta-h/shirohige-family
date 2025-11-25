<?php
$dp_options = get_design_plus_options();

$args = array(
  'prev_next' => false,
  'type' => 'array'
);

get_header();
?>
  <div class="l-contents l-inner<?php if ( 'type1' === $dp_options['sidebar'] ) { echo ' l-contents--rev'; } ?>">
    <div class="l-primary">
      <div class="p-event-list">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
        ?>
        <article class="p-event-list__item p-article05">
          <a href="<?php the_permalink(); ?>" class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>">
            <div class="p-article05__img">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'size3' );
              } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/740x476.gif" alt="">' . "\n";
              }
              ?>
            </div>
            <div class="p-article05__content">
              <h2 class="p-article05__title"><?php echo wp_trim_words( get_the_title(), 28, '...' ); ?></h2>
              <?php if ( $dp_options['event_show_date'] ) : ?>
              <time class="p-article05__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
              <?php endif; ?>
            </div>
          </a>
        </article>
        <?php
          endwhile;
        endif;
        ?>
      </div><!-- /.p-event-list -->
      <?php if ( paginate_links( $args ) ) : ?>
      <ul class="p-pager">
        <?php foreach ( paginate_links( $args ) as $link ) : ?>
        <li class="p-pager__item"><?php echo $link; ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div><!-- /.l-primary -->
    <?php get_sidebar(); ?>
  </div><!-- /.l-contents -->
<?php get_footer(); ?>
