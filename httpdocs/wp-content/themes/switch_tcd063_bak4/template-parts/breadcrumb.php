<?php
$dp_options = get_design_plus_options();

$news_label = $dp_options['news_breadcrumb'] ? $dp_options['news_breadcrumb'] : __( 'News', 'tcd-w' );
$event_label = $dp_options['event_breadcrumb'] ? $dp_options['event_breadcrumb'] : __( 'Event', 'tcd-w' );
$interview_label = $dp_options['interview_breadcrumb'] ? $dp_options['interview_breadcrumb'] : __( 'Interview', 'tcd-w' );

$breadcrumb_items = array(
  array(
    'name' => 'HOME',
    'url' => get_home_url( null, '/' )
  )
);

if ( is_singular( 'post' ) ) {

  $categories = get_the_category( $post->ID );

  $breadcrumb_items[] = array(
    'name' => __( 'Blog', 'tcd-w' ),
    'url' => get_post_type_archive_link( 'post' )
  );

  $breadcrumb_items[] = array(
    'name' => $categories[0]->name,
    'url' => get_category_link( $categories[0]->term_id )
  );

} elseif ( is_singular( 'news' ) ) {

  $breadcrumb_items[] = array(
    'name' => $news_label,
    'url' => get_post_type_archive_link( 'news' )
  );

} elseif ( is_singular( 'event' ) ) {

  $breadcrumb_items[] = array(
    'name' => $event_label,
    'url' => get_post_type_archive_link( 'event' )
  );

} elseif ( is_singular( 'interview' ) ) {

  $breadcrumb_items[] = array(
    'name' => $interview_label,
    'url' => get_post_type_archive_link( 'interview' )
  );

}

$breadcrumb_items[] = array( 'name' => strip_tags( get_the_title() ) );

// Render
echo '<ol class="p-breadcrumb c-breadcrumb l-inner" itemscope="" itemtype="http://schema.org/BreadcrumbList">' . "\n";

for ( $i = 0, $len = count( $breadcrumb_items ); $i < $len; $i++ ) {

  // Add tags
  if ( $len - 1 !== $i ) {

    if ( 0 === $i ) {
      echo '<li class="p-breadcrumb__item c-breadcrumb__item c-breadcrumb__item--home" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">' . "\n";
    } else {
      echo '<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">' . "\n";
    }
    echo '<a href="' . esc_url( $breadcrumb_items[$i]['url'] ) . '" itemtype="http://schema.org/Thing" itemprop="item">' . "\n";
    echo '<span itemprop="name">' . esc_html( $breadcrumb_items[$i]['name'] ) . '</span>' . "\n";
    echo '</a>' . "\n";
    echo '<meta itemprop="position" content="' . ( $i + 1 ) .  '">' . "\n";
    echo '</li>' . "\n";

  } else {
    echo '<li class="p-breadcrumb__item c-breadcrumb__item">' . esc_html( $breadcrumb_items[$i]['name'] ) . '</li>' . "\n";
  }
}
echo '</ol>' . "\n";
