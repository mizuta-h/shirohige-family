<?php
$sidebar = '';

if ( is_post_type_archive( 'news' ) || is_singular( 'news' ) ) {
  $sidebar = 'news_widget';
} elseif ( is_post_type_archive( 'event' ) || is_singular( 'event' ) ) {
  $sidebar = 'event_widget';
} elseif ( is_page() ) {
  $sidebar = 'page_widget';
} else {
  $sidebar = 'blog_widget';
}

if ( is_mobile() ) {
  $sidebar .= '_sp';
}
?>
<div class="l-secondary">
<?php
if ( is_active_sidebar( $sidebar ) ) {
  dynamic_sidebar( $sidebar );
} elseif ( is_active_sidebar( 'common_widget' ) ) {
  dynamic_sidebar( 'common_widget' );
}
?>
</div><!-- /.l-secondary -->
