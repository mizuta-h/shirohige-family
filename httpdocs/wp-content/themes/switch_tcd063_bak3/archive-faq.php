<?php
$dp_options = get_design_plus_options();

$faq_categories = get_terms( 'faq_category' );

get_header();
?>
  <div class="l-contents l-inner">
    <div class="l-primary">
      <?php foreach ( $faq_categories as $faq_category ) : ?>
      <section class="p-faq">
        <h2 class="p-faq__cat"><?php echo esc_html( $faq_category->name ); ?></h2>
        <?php
        $args = array(
          'post_type' => 'faq',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'tax_query' => array(
            array(
              'taxonomy' => 'faq_category',
              'field' => 'slug',
              'terms' => $faq_category->slug
            )
          )
        );
        $the_query = new WP_Query( $args );
        ?>
        <dl class="p-faq__list">
          <?php
          if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) :
              $the_query->the_post();
          ?>
          <dt><?php the_title(); ?></dt>
          <dd class="p-entry__body mb0"><?php the_content(); ?></dd>
          <?php
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </dl>
      </section>
      <?php endforeach; ?>
    </div><!-- /.l-primary -->
  </div><!-- /.l-contents -->
<?php get_footer(); ?>
