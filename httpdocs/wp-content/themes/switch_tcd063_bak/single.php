<?php
$dp_options = get_design_plus_options();

get_header();
?>
  <?php get_template_part( 'template-parts/breadcrumb' ); ?>
  <div class="l-contents l-inner<?php if ( 'type1' === $dp_options['sidebar'] ) { echo ' l-contents--rev'; } ?>">
    <div class="l-primary">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();
          $timestamp = get_the_time( 'U' );
          $categories = get_the_category();
          $pagenation_type = 'type3' === $post->pagenation_type ? $options['pagenation_type'] : $post->pagenation_type;
					$previous_post = get_previous_post();
          $next_post = get_next_post();
          if($categories){
					$args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'post__not_in' => array( $post->ID ),
            'category_name' => $categories[0]->slug,
            'orderby' => 'rand',
          );
          }else{
          $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'post__not_in' => array( $post->ID ),
            'orderby' => 'rand',
          );
          }
          $the_query = new WP_Query( $args );
      ?>
			<article class="p-entry">
        <div class="p-entry__inner">
          <?php if(!is_attachment()): ?>
          <?php if ( $dp_options['show_date'] ) : ?>
          <div class="p-triangle p-triangle--no-padding p-triangle--grey">
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
				  <figure class="p-entry__img">
            <?php
            if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'full' );
            } else {
              echo '<img src="' . get_template_directory_uri() . '/assets/images/725x465.gif" alt="">' . "\n";
            }
            ?>
          </figure>
          <?php endif; ?>
			    <header class="p-entry__header">
            <?php if ( has_category() && $categories ) : ?>
            <p class="p-entry__meta">
              <a href="<?php echo get_category_link( $categories[0]->term_id ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
            </p>
            <?php endif; ?>
            <h1 class="p-entry__title"><?php the_title(); ?></h1>
				  </header>
          <div class="p-entry__body">
          <?php
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
          ?>
          </div>
          <?php if ( $dp_options['show_sns_btm'] ) { get_template_part( 'template-parts/sns-btn-btm' ); } ?>
          <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($dp_options['single_blog_show_copy_btm']) {
        ?>
        <div class="single_copy_title_url" id="single_copy_title_url_bottom">
        <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
        </div>
        <?php }; ?>
          <?php if ( $options['show_author'] || has_category() || has_tag() || $options['show_comment'] ) : ?>
				  <ul class="p-entry__meta-box c-meta-box u-clearfix">
				  	<?php if ( $dp_options['show_author'] ) : ?><li class="c-meta-box__item c-meta-box__item--author"><?php _e( 'Author', 'tcd-w' ); ?>: <?php the_author_posts_link(); ?></li><?php endif; if ( has_category() ) : ?><li class="c-meta-box__item c-meta-box__item--category"><?php the_category( ', ' ); ?></li><?php endif; if ( has_tag() && get_the_tags() ) : ?><li class="c-meta-box__item c-meta-box__item--tag"><?php echo get_the_tag_list( '', ', ', '' ); ?></li><?php endif; if ( $dp_options['show_comment'] ) : ?><li class="c-meta-box__item c-meta-box__item--comment"><?php _e( 'Comments', 'tcd-w' ); ?>: <a href="#comment_headline"><?php echo get_comments_number( '0', '1', '%' ); ?></a></li><?php endif; ?>
				  </ul>
				  <?php endif; ?>
          <?php if ( $options['show_next_post'] && ( $previous_post || $next_post ) ) : ?>
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
      <?php
			get_template_part( 'template-parts/ad-btm' );
      if ( $options['show_comment'] ) { comments_template( '', true ); }
      ?>
      <?php if ( $options['show_related_post'] ) : ?>
			<section>
			 	<h2 class="p-headline"><?php _e( 'Related posts', 'tcd-w' ); ?></h2>
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
