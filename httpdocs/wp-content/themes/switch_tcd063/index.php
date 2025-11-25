<?php
$dp_options = get_design_plus_options();

$args = array(
  'prev_next' => false,
  'type' => 'array'
);

get_header();
?>
  <div class="l-contents l-inner">
    <div class="l-primary">
      <div class="p-archive-header">
        <?php if ( is_home() ) : ?>
          <p class="p-archive-header__title"><?php echo esc_html( $dp_options['archive_catch'] ); ?></p>
        <?php else : ?>
          <h1 class="p-archive-header__title"><?php the_archive_title(); ?></h1>
        <?php endif; ?>
      </div>
      <div class="p-blog-list">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
            $timestamp = get_the_time( 'U' );
        ?>
        <article class="p-blog-list__item p-article01">
          <?php if ( $dp_options['show_date'] ) : ?>
          <div class="p-article01__date p-triangle">
            <time class="p-date" datetime="<?php the_time( 'Y-m-d' ); ?>">
              <?php if ( 'type1' === $dp_options['month_type'] ) : ?>
              <span class="p-date__month"><?php echo strtoupper( date( 'M', $timestamp ) ); ?></span>
              <?php else : ?>
              <span class="p-date__month p-date__month--ja"><?php the_time( 'n' ); ?>月</span>
              <?php endif; ?>
              <span class="p-date__day"><?php the_time( 'd' ); ?></span>
              <?php the_time( 'Y' ); ?>
            </time>
          </div>
          <?php endif; ?>
          <a class="p-article01__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php
            if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'size1' );
            } else {
              echo '<img src="' . get_template_directory_uri() . '/assets/images/590x380.gif" alt="">';
            }
            ?>
          </a>
          <div class="p-article01__content">
            <h2 class="p-article01__title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 26, '...' ) : wp_trim_words( get_the_title(), 44, '...' ); ?></a>
            </h2>
            <?php if ( $dp_options['show_category'] ) : ?>
            <p class="p-article01__cat"><?php the_category( ', ' ); ?></p>
            <?php endif; ?>
          </div>
        </article>
        <?php
          endwhile;
        endif;
        ?>
      </div><!-- /.p-blog-list -->
      <?php if ( paginate_links( $args ) ) : ?>
      <ul class="p-pager">
        <?php foreach ( paginate_links( $args ) as $link ) : ?>
        <li class="p-pager__item"><?php echo $link; ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div><!-- /.l-primary -->
  </div><!-- /.l-contents -->
<?php get_footer(); ?>
