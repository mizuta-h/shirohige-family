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
      <div class="p-news-list">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
        ?>
        <article class="p-news-list__item p-article04">
          <header class="p-article04__header">
            <?php if ( $dp_options['news_show_date'] ) : ?>
            <time class="p-article04__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
            <?php endif; ?>
            <h2 class="p-article04__title">
              <a href="<?php the_permalink(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 28, '...' ) : wp_trim_words( get_the_title(), 32, '...' ); ?></a>
            </h2>
          </header>
          <p class="p-article04__excerpt"><?php echo is_mobile() ? wp_trim_words( get_the_excerpt(), 53, '...' ) : wp_trim_words( get_the_excerpt(), 100, '...' ); ?></p>
        </article>
        <?php
          endwhile;
        endif;
        ?>
      </div><!-- /.p-news-list -->
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
