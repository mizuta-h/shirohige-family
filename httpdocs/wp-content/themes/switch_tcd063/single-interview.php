<?php
$dp_options = get_design_plus_options();

get_header();
?>
  <?php get_template_part( 'template-parts/breadcrumb' ); ?>
  <div class="l-contents l-inner">
    <div class="l-primary">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();

          $categories = get_the_terms( $post, 'interview_category' );
          $previous_post = get_previous_post();
          $next_post = get_next_post();

          $args = array(
            'post_type' => 'interview',
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'post__not_in' => array( $post->ID ),
            'orderby' => 'rand',
          );

          if ( $categories ) {
            $args['tax_query'] = array(
              array(
                'taxonomy' => 'interview_category',
                'field' => 'slug',
                'terms' => $categories[0]->slug
              )
            );
          }

          $the_query = new WP_Query( $args );

          if ( post_password_required() ) :
            echo get_the_password_form( $post->ID );
          else :
      ?>
      <article class="p-interview">
        <header class="p-interview__header">
          <p class="p-triangle p-triangle--no-padding p-triangle--grey">
          <span class="p-triangle__inner"><?php if ( $categories && $dp_options['interview_show_category'] ) { echo esc_html( $categories[0]->name ) . '<br>'; } ?><?php echo esc_html( $post->interviewee_name ); ?><br><?php echo esc_html( $post->interviewee_age ); ?></span>
          </p>
          <?php if ( 'type1' === $post->interviewee_media_type ) : ?>
          <figure class="p-interview__img">
            <?php
            if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'full' );
            } else {
              echo '<img src="' . get_template_directory_uri() . '/assets/images/1000x512.gif" alt="">' . "\n";
            }
            ?>
          </figure>
          <?php elseif ( 'type2' === $post->interviewee_media_type ) : ?>
          <video class="p-interview__video" src="<?php echo wp_get_attachment_url( $post->interviewee_video ); ?>" controls></video>
          <?php else : ?>
          <div class="p-interview__youtube">
            <iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $post->interviewee_youtube ); ?>?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>
          <?php endif; ?>
        </header>
        <h1 class="p-interview__title"><?php the_title(); ?></h1>
        <?php
        $faq = $post->interviewee_faq;
        if ( $faq && is_array( $faq ) && isset( $faq['header'][0] ) ) :
        ?>
        <dl class="p-interview__faq">
          <?php foreach( array_keys( $faq['header'] ) as $repeater_index ) : ?>
          <dt><?php echo nl2br( esc_html( $faq['header'][$repeater_index] ) ); ?></dt>
          <dd><?php echo nl2br( esc_html( $faq['desc'][$repeater_index] ) ); ?></dd>
          <?php endforeach; ?>
        </dl>
        <?php endif; ?>
        <?php if ( $dp_options['interview_show_next_post'] && ( $previous_post || $next_post ) ) : ?>
        <ul class="p-nav02">
          <?php if ( $previous_post ) : ?>
          <li class="p-nav02__item p-nav02__item--prev">
            <a class="p-nav02__item-upper" href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>"><?php echo esc_html( $previous_post->interviewee_name ); ?></a>
            <a class="p-nav02__item-lower p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>">
              <div class="p-nav02__item-img">
                <?php
                if ( has_post_thumbnail( $previous_post->ID ) ) {
                  echo get_the_post_thumbnail( $previous_post->ID, 'size2' );
                } else {
                  echo '<img src="' . get_template_directory_uri() . '/assets/images/240x240.gif" alt="">' . "\n";
                }
                ?>
              </div>
              <span class="p-nav02__item-title"><?php echo is_mobile() ? esc_html( wp_trim_words( $previous_post->post_title, 20, '...' ) ) : esc_html( wp_trim_words( $previous_post->post_title, 45, '...' ) ); ?></span>
            </a>
          </li>
          <?php endif; ?>
          <?php if ( $next_post ) : ?>
          <li class="p-nav02__item p-nav02__item--next">
            <a class="p-nav02__item-upper" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php echo esc_html( $next_post->interviewee_name ); ?></a>
            <a class="p-nav02__item-lower p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
              <div class="p-nav02__item-img">
                <?php
                if ( has_post_thumbnail( $next_post->ID ) ) {
                  echo get_the_post_thumbnail( $next_post->ID, 'size2' );
                } else {
                  echo '<img src="' . get_template_directory_uri() . '/assets/images/240x240.gif" alt="">' . "\n";
                }
                ?>
              </div>
                <span class="p-nav02__item-title"><?php echo is_mobile() ? esc_html( wp_trim_words( $next_post->post_title, 20, '...' ) ) : esc_html( wp_trim_words( $next_post->post_title, 45, '...' ) ); ?></span>
            </a>
          </li>
          <?php endif; ?>
        </ul>
        <?php endif; ?>
      </article>
      <?php
         endif;
        endwhile;
      endif;
      ?>
      <?php if ( $dp_options['show_related_interview'] ) : ?>
      <div class="p-interview-list">
        <?php
        if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) :
            $the_query->the_post();
            $categories = get_the_terms( $post, 'interview_category' );
        ?>
        <article class="p-interview-list__item p-article06<?php if ( 'type1' !== $post->interviewee_media_type ) { echo ' p-article06--video'; } ?>">
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
          <div class="p-article06__title">
            <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 55, '...' ); ?></a>
          </div>
        </article>
        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>
      </div>
      <?php endif; ?>
    </div><!-- /.l-primary -->
  </div><!-- /.l-contents -->
<?php get_footer(); ?>
