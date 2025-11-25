<?php
$dp_options = get_design_plus_options();

$event_label = $dp_options['event_breadcrumb'] ? $dp_options['event_breadcrumb'] : __( 'Event', 'tcd-w' );

get_header();
?>
  <?php get_template_part( 'template-parts/breadcrumb' ); ?>
  <div class="l-contents l-inner<?php if ( 'type1' === $dp_options['sidebar'] ) { echo ' l-contents--rev'; } ?>">

    <div class="l-primary">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();
					$previous_post = get_previous_post();
          $next_post = get_next_post();
					$args = array(
            'post_type' => 'event',
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'post__not_in' => array( $post->ID ),
            'orderby' => 'rand',
          );
          $the_query = new WP_Query( $args );
      ?>
			<article class="p-entry">
        <div class="p-entry__inner">
          <?php if ( $dp_options['event_show_thumbnail'] && has_post_thumbnail() ) : ?>
				  <figure class="p-entry__img">
            <?php the_post_thumbnail( 'full' ); ?>
          </figure>
          <?php endif; ?>
			    <header class="p-entry__header">
            <?php if ( $dp_options['event_show_date'] ) : ?>
            <time class="p-entry__meta" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
            <?php endif; ?>
            <h1 class="p-entry__title"><?php the_title(); ?></h1>
				  </header>
          <div class="p-entry__body">
          <?php
          the_content();
          if ( ! post_password_required() ) {
            wp_link_pages( array(
              'before' => '<div class="p-page-links">',
              'after' => '</div>',
              'link_before' => '<span>',
              'link_after' => '</span>'
            ) );
          }
          ?>
          </div>
          <?php if ( $dp_options['event_show_sns'] ) { get_template_part( 'template-parts/sns-btn-btm' ); } ?>
          <?php if ( $dp_options['event_show_next_post'] && ( $previous_post || $next_post ) ) : ?>
			    <ul class="p-nav01 c-nav01 u-clearfix">
			    	<li class="p-nav01__item--prev p-nav01__item c-nav01__item c-nav01__item--prev"><?php if ( $previous_post ) : ?><a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" data-prev="<?php _e( 'Previous post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $previous_post->post_title, 17, '...' ) ); ?></span></a><?php endif; ?></li>
			    	<li class="p-nav01__item--next p-nav01__item c-nav01__item c-nav01__item--next"><?php if ( $next_post ) : ?><a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" data-next="<?php _e( 'Next post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $next_post->post_title, 17, '...' ) ); ?></span></a><?php endif; ?></li>
			    </ul>
          <?php endif; ?>
        </div>
      </article>
      <?php
        endwhile;
      endif;
      ?>
      <?php if ( $dp_options['show_related_event'] ) : ?>
			<section>
      <h2 class="p-headline"><?php printf( __( ' Related %s', 'tcd-w' ), esc_html( $event_label ) ); ?></h2>
			 	<div class="p-entry__related">
          <?php
          if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) :
              $the_query->the_post();
          ?>
          <article class="p-entry__related-item p-article01">
            <a class="p-article01__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'size1' );
              } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/590x380.gif" alt="">' . "\n";
              }
              ?>
            </a>
            <div class="p-article01__content">
              <h3 class="p-article01__title">
                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 23, '...' ); ?></a>
              </h3>
            </div>
          </article>
          <?php
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
			 </section>
       <?php endif; ?>
    </div><!-- /.l-primary -->
    <?php get_sidebar(); ?>
  </div><!-- /.l-contents -->
<?php get_footer(); ?>
