<?php
$dp_options = get_design_plus_options();

get_header();
?>
  <?php get_template_part( 'template-parts/header-contents' ); ?>

  <?php if ( $dp_options['display_index_content01'] ) : ?>
  <div class="p-index-content01">
    <div class="l-inner">
      <h2 class="p-index-content01__title"><?php echo nl2br( $dp_options['index_content01_catch'] ); ?></h2>
      <p class="p-index-content01__desc"><?php echo nl2br( $dp_options['index_content01_desc']); ?></p>
    </div>
    <button id="js-index-content01__link" class="p-index-content01__link"></button>
  </div>
  <?php endif; ?>

  <div id="js-cb" class="p-cb">

    <?php foreach ( $dp_options['index_contents_order'] as $index => $order ) : ?>
      
      <?php if ( '4_images_and_text' === $order ) : ?>

        <?php if ( ! $dp_options['display_index_4_images_and_text'] ) continue; ?>

        <div id="cb_content<?php echo $index + 1 ?>" class="p-index-content02 p-cb__item l-inner<?php if ( 'type2' === $dp_options['index_4_images_and_text_layout'] ) { echo ' p-index-content02--rev'; } ?>">
          <div class="p-index-content02__img">
            <?php
            for ( $i = 1; $i <= 4; $i++ ) {
              if ( ! $dp_options['index_4_images_and_text_img' . $i] ) continue;
              echo wp_get_attachment_image( $dp_options['index_4_images_and_text_img' . $i], 'size5' );
            }
            ?>
          </div>
          <div class="p-index-content02__content">
            <h2 class="p-index-content02__title"><?php echo $dp_options['index_4_images_and_text_catch'] ; ?></h2>
            <p class="p-index-content02__desc"><?php echo nl2br( $dp_options['index_4_images_and_text_desc'] ); ?></p>
          </div>
        </div><!-- /.p-cb__item -->

      <?php elseif ( 'three_column' === $order ) : ?>

        <?php if ( ! $dp_options['display_index_three_column'] ) continue; ?>

        <div id="cb_content<?php echo $index + 1 ?>" class="p-index-content03 p-cb__item l-inner">

          <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
          <div class="p-index-content03__item p-article08">

            <?php if ( $dp_options['index_three_column_title' . $i] ) : ?>
            <p class="p-article08__title p-triangle p-triangle--no-padding"><?php echo $dp_options['index_three_column_title' . $i]; ?></p>
            <?php endif; ?>

            <?php if ( $dp_options['index_three_column_img' . $i] ) : ?>
            <a class="p-article08__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $dp_options['index_three_column_btn_url' . $i] ); ?>"<?php if ( $dp_options['index_three_column_btn_target' . $i] ) { echo ' target="_blank"'; } ?>>
              <?php echo wp_get_attachment_image( $dp_options['index_three_column_img' . $i], 'size4' ); ?>
            </a>
            <?php endif; ?>

            <div class="p-index-content03__content p-article08__content">
              <p class="p-article08__desc"><?php echo nl2br( $dp_options['index_three_column_desc' . $i] ); ?></p>

              <?php if ( $dp_options['index_three_column_btn_label' . $i] ) : ?>
              <p class="p-article08__btn">
                <a class="p-btn" href="<?php echo esc_attr( $dp_options['index_three_column_btn_url' . $i] ); ?>"<?php if ( $dp_options['index_three_column_btn_target' . $i] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $dp_options['index_three_column_btn_label' . $i] ); ?></a>
              </p>
              <?php endif; ?>

            </div>
          </div>
          <?php endfor; ?>

        </div><!-- /.p-cb__item -->

      <?php elseif ( 'news_and_event' === $order ) : ?>

        <?php
        if ( ! $dp_options['display_index_news_and_event'] ) continue;

        $news_args = array(
          'post_type' => 'news',
          'post_status' => 'publish',
          'posts_per_page' => $dp_options['index_news_num']
        );
        $news_query = new WP_Query( $news_args );

        $event_args = array(
          'post_type' => 'event',
          'post_status' => 'publish',
          'posts_per_page' => $dp_options['index_event_num']
        );
        $event_query = new WP_Query( $event_args );
        ?>
        <div id="cb_content<?php echo $index + 1 ?>" class="p-index-content04 p-cb__item">
          <div class="p-index-content04__inner l-inner<?php if ( 'type2' === $dp_options['index_news_and_event_layout'] ) { echo ' p-index-content04__inner--rev'; } ?>">
            <div class="p-index-content04__col p-index-content04__col--news">
              <div class="p-headline02">
                <h2 class="p-headline02__title"><?php echo $dp_options['index_news_title']; ?></h2>
                <span class="p-headline02__sub"><?php echo $dp_options['index_news_sub'] ; ?></span>
              </div>
              <?php if ( $news_query->have_posts() ) : ?>
              <div class="p-index-content04__col-list">

                <?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                <article class="p-index-content04__col-list-item p-article09">
                  <a href="<?php the_permalink(); ?>">

                    <?php if ( $dp_options['news_show_date'] ) : ?>
                    <time class="p-article09__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
                    <?php endif; ?>

                    <h3 class="p-article09__title"><?php echo wp_trim_words( get_the_title(), 35, '...' ); ?></h3>
                  </a>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>

              </div>
              <?php endif; ?>

              <p class="p-index-content04__col-link">
                <a href="<?php echo esc_attr( get_post_type_archive_link( 'news' ) ); ?>"><?php echo esc_html( $dp_options['index_news_link_text'] ); ?></a>
              </p>
            </div><!-- /.p-index-content04__col -->
            <div class="p-index-content04__col p-index-content04__col--event">
              <div class="p-headline02">
                <h2 class="p-headline02__title"><?php echo $dp_options['index_event_title']; ?></h2>
                <span class="p-headline02__sub"><?php echo $dp_options['index_event_sub']; ?></span>
              </div>

              <?php if ( $event_query->have_posts() ) : ?>
              <div class="p-index-content04__col-list">

                <?php while ( $event_query->have_posts() ) : $event_query->the_post(); ?>
                <article class="p-index-content04__col-list-item p-article10">
                  <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
                    <div class="p-article10__img">
                      <?php
                      if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'size6' );
                      } else {
                        echo '<img src="' . get_template_directory_uri() . '/assets/images/414x264.gif" alt="">';
                      }
                      ?>
                    </div>
                    <div class="p-article10__content">
                      <h3 class="p-article10__title"><?php echo wp_trim_words( get_the_title(), 35, '...' ); ?></h3>

                      <?php if ( $dp_options['event_show_date'] ) : ?>
                      <time class="p-article10__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
                      <?php endif; ?>

                    </div>
                  </a>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>

              </div>
              <?php endif; ?>

              <p class="p-index-content04__col-link">
                <a href="<?php echo esc_attr( get_post_type_archive_link( 'event' ) ); ?>"><?php echo esc_html( $dp_options['index_event_link_text'] ); ?></a>
              </p>
            </div><!-- /.p-index-content04__col -->
          </div>
        </div><!-- /.p-cb__item -->

      <?php elseif ( 'interview' === $order ) : ?>

        <?php
        if ( ! $dp_options['display_index_interview'] ) continue;

        $interview_args = array(
          'post_type' => 'interview',
          'post_status' => 'publish',
          'posts_per_page' => $dp_options['index_interview_num']
        );
        $interview_query = new WP_Query( $interview_args );
        ?>
        <div id="cb_content<?php echo $index + 1 ?>" class="p-index-content05 p-cb__item l-inner">
          <div class="p-headline02">
            <h2 class="p-headline02__title"><?php echo $dp_options['index_interview_title']; ?></h2>
            <span class="p-headline02__sub"><?php echo $dp_options['index_interview_sub']; ?></span>
          </div>

          <?php if ( $interview_query->have_posts() ) : ?>
          <div class="p-index-content05__list p-interview-list">

            <?php
            while( $interview_query->have_posts() ) :
              $interview_query->the_post();
              $categories = get_the_terms( $post->ID, 'interview_category' );
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
                  echo '<img src="' . get_template_directory_uri() . '/assets/images/740x520.gif" alt="">';
                  }
                  ?>
                </a>

                <?php if ( $dp_options['interview_show_category'] && isset( $categories[0] ) ) : ?>
                <a class="p-article06__cat" href="<?php echo esc_attr( get_term_link( $categories[0], 'interview_category' ) ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
                <?php endif; ?>

              </header>
              <h3 class="p-article06__title">
                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 55, '...' ); ?></a>
              </h3>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>

          </div>
          <?php endif; ?>

          <?php if($dp_options['index_interview_link_text'] != ''): ?>
          <p class="p-index-content05__btn">
            <a class="p-btn" href="<?php echo get_post_type_archive_link( 'interview' ); ?>"><?php echo esc_html( $dp_options['index_interview_link_text'] ); ?></a>
          </p>
          <?php endif; ?>
        </div><!-- /.p-cb__item -->

      <?php elseif ( 'plan_content' === $order ) : ?>

        <?php if ( ! $dp_options['display_index_plan_content'] ) continue; ?>
        <div id="cb_content<?php echo $index + 1 ?>" class="p-index-content06 p-cb__item l-inner">
          <h2 class="p-index-content06__title"><?php echo $dp_options['index_plan_content_catch']; ?></h2>
          <p class="p-index-content06__desc"><?php echo nl2br( $dp_options['index_plan_content_desc'] ); ?></p>

          <?php if ( $post_id = $dp_options['index_plan_content_post_id'] ) : ?>
          <div class="p-index-content06__plan p-plan-list">

            <?php for ( $i = 5; $i <= 7; $i++ ) : $values = get_post_meta( $post_id, "page_type4_d_{$i}", true ); ?>

              <?php if ( is_array( $values ) ) : ?>
              <?php if ( isset( $values['strong'] ) ) : ?>
              <dl class="p-plan-list__item p-plan-table01 p-plan-table01--strong" style="border-color: <?php echo esc_attr( $values['name_bg'] ); ?>;">
              <?php else : ?>
              <dl class="p-plan-list__item p-plan-table01">
              <?php endif; ?>

                <dt class="p-plan-table01__title" style="background: <?php echo esc_attr( $values['name_bg'] ); ?>;"><?php echo esc_html( $values['name'] ); ?></dt>
                  <dd class="p-plan-table01__data p-plan-table01__data--price" style="background: <?php echo esc_attr( $values['price_bg'] ); ?>;">
                    <p class="p-plan-table01__price" style="color: <?php echo esc_attr( $values['price_color'] ); ?>;"><span class="p-plan-table01__unit"><?php echo esc_html( $values['unit'] ); ?></span><?php echo esc_html( $values['price'] ); ?></p>
                    <p class="p-plan-table01__per"><?php echo esc_html( $values['per'] ); ?></p>
                  </dd>

                  <?php if ( isset( $values['data'][0] ) ) : ?>

                    <?php foreach ( array_keys( $values['data'] ) as $index ) : ?>
                    <dd class="p-plan-table01__data"><?php echo esc_html( $values['data'][$index] ); ?></dd>
                    <?php endforeach; ?>

                  <?php endif; ?>
              </dl>
              <?php endif; ?>
              <?php endfor; ?>

          </div>
          <?php if(!empty($dp_options['index_plan_content_link_text'])): ?>
          <p class="p-index-content06__btn">
            <a class="p-btn" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( $dp_options['index_plan_content_link_text'] ); ?></a>
          </p>
          <?php endif; ?>
          <?php endif; ?>

        </div><!-- /.p-cb__item -->

      <?php elseif ( 'image' === $order ) : ?>

        <?php if ( ! $dp_options['display_index_image'] ) continue; ?>
        <div id="cb_content<?php echo $index + 1 ?>" class="p-index-content07 p-cb__item">
          <div class="p-index-content07__inner l-inner">
            <h2 class="p-index-content07__title"><?php echo $dp_options['index_image_catch']; ?></h2>
            <p class="p-index-content07__desc"><?php echo  nl2br( $dp_options['index_image_desc']); ?></p>

            <?php if ( $dp_options['index_image_btn_label'] ) : ?>
            <p class="p-index-content07__btn">
              <a class="p-btn" href="<?php echo esc_attr( $dp_options['index_image_btn_url'] ); ?>"<?php if ( $dp_options['index_image_btn_target'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $dp_options['index_image_btn_label'] ); ?></a>
            </p>
            <?php endif; ?>

          </div>
        </div><!-- /.p-cb__item -->

      <?php elseif ( 'blog' === $order ) : ?>

        <?php
        $blog_args = array(
          'post_type' => 'post',
          'post_status' => 'publish',
          'posts_per_page' => $dp_options['index_blog_num']
        );
        $blog_query = new WP_Query( $blog_args );
        ?>

        <?php if ( ! $dp_options['display_index_blog'] ) continue; ?>
        <div id="cb_content<?php echo $index + 1 ?>" class="p-index-content08 p-cb__item l-inner">
          <div class="p-headline02">
            <h2 class="p-headline02__title"><?php echo $dp_options['index_blog_title']; ?></h2>
            <span class="p-headline02__sub"><?php echo $dp_options['index_blog_sub']; ?></span>
          </div>

          <?php if ( $blog_query->have_posts() ) : ?>
          <div class="p-blog-list">

            <?php
            while ( $blog_query->have_posts() ) :
              $blog_query->the_post();
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

              <a class="p-article01__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
                <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'size1' );
                } else {
                  echo '<img src="' . get_template_directory_uri() . '/assets/images/590x380.gif" alt="">';
                }
                ?>
              </a>
              <div class="p-article01__content">
                <h3 class="p-article01__title">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 26, '...' ) : wp_trim_words( get_the_title(), 44, '...' ); ?></a>
                </h3>
                <?php if ( $dp_options['show_category'] ) : ?>
                <p class="p-article01__cat"><?php the_category( ', ' ); ?></p>
                <?php endif; ?>
              </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>

          </div><!-- / .p-blog-list -->
          <?php endif; ?>

          <?php if($dp_options['index_blog_link_text'] != ''): ?>
          <p class="p-index-content08__btn">
            <a class="p-btn" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"><?php echo esc_html( $dp_options['index_blog_link_text'] ); ?></a>
          </p>
          <?php endif; ?>
        </div><!-- /.p-cb__item -->

      <?php elseif ( 'catch_and_desc' === $order ) : ?>

        <?php if ( ! $dp_options['display_index_catch_and_desc'] ) continue; ?>
        <div id="cb_content<?php echo $index + 1 ?>" class="p-index-content09 p-cb__item l-inner">
          <h2 class="p-index-content09__title"><?php echo $dp_options['index_catch_and_desc_catch']; ?></h2>
          <p class="p-index-content09__desc"><?php echo nl2br( $dp_options['index_catch_and_desc_desc'] ); ?></p>
        </div>

      <?php elseif ( 'wysiwyg1' === $order || 'wysiwyg2' === $order || 'wysiwyg3' === $order ) : ?>

        <?php
        $key = mb_substr( $order, -1 );
        if ( ! $dp_options['display_index_wysiwyg' . $key] ) continue;
        ?>
        <div id="cb_content<?php echo $index + 1 ?>" class="p-entry__body p-index-content08 p-cb__item<?php if ( $dp_options['display_full_index_wysiwyg' . $key] ){ echo '"'; } else { echo ' l-inner"'; } ?>>
          <?php echo apply_filters( 'the_content', $dp_options['index_wysiwyg_editor' . $key] ); ?>
        </div><!-- /.p-cb__item -->
      <?php endif; ?>

    <?php endforeach; ?>
  </div><!-- /.p-cb -->
<?php get_footer(); ?>
