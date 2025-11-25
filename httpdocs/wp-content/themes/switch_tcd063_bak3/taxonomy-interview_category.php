<?php
$dp_options = get_design_plus_options();

$args = array(
  'prev_next' => false,
  'type' => 'array'
);

$term_id = get_queried_object_id();

get_header();
?>
  <div class="l-contents l-inner">
    <div class="l-primary">
      <div class="p-archive-header">
        <h2 class="p-archive-header__title"><?php echo esc_html( get_term_meta( $term_id, 'catch', true ) ); ?></h2>
        <p class="p-archive-header__desc"><?php echo nl2br( esc_html( get_term_meta( $term_id, 'desc', true ) ) ); ?></p>
      </div>
      <div class="p-interview-list">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
            $categories = get_the_terms( $post, 'interview_category' );
        ?>
        <article class="p-interview-list__item p-article06">
          <header class="p-article06__header">
            <p class="p-triangle p-triangle--no-padding">
              <span class="p-triangle__inner"><?php echo esc_html( $post->interviewee_name ); ?><br><?php echo esc_html( $post->interviewee_age ); ?></span>
            </p>
            <a class="p-article06__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'size4' );
              } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/740x520.gif" alt="">' . "\n";
              }
              ?>
            </a>
            <?php if ( $dp_options['interview_show_category'] && $categories ) : ?>
            <a class="p-article06__cat" href="<?php echo get_term_link( $categories[0]->term_id, 'interview_category' ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
            <?php endif; ?>
          </header>
          <h3 class="p-article06__title">
          <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 55, '...' ); ?></a>
          </h3>
        </article>
        <?php
          endwhile;
        endif;
        ?>
      </div>
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
