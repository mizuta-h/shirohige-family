<?php
function custom_script_meta_box() {
  $post_types = array ( 'post', 'page', 'news', 'event', 'special');
  add_meta_box(
    'custom_script',//ID of meta box
    __('Custom CSS and script for this page', 'tcd-w'),//label
    'show_custom_script_meta_box',//callback function
    $post_types,// post type
    'normal',// context
    'low'// priority
  );
}
add_action('add_meta_boxes', 'custom_script_meta_box', 999);

function show_custom_script_meta_box() {
  global $post;

  $custom_script = get_post_meta($post->ID, 'custom_script', true);
  $custom_css = get_post_meta($post->ID, 'custom_css', true);

  echo '<input type="hidden" name="custom_script_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_fields">

 <div class="tcd_cf_content">
  <h4 class="theme_option_headline2"><?php _e('Custom CSS', 'tcd-w'); ?></h4>
  <div class="theme_option_message2" style="margin-top:10px;">
   <p><?php _e( 'This css will be displayed inside &lt;head&gt; tag.<br />You don\'t need to enter &lt;style&gt; tag in this field.', 'tcd-w' ); ?></p>
   <p><?php _e('Example:<br><strong>.custom_css { font-size:12px; }</strong>', 'tcd-w');  ?></p>
  </div>
  <textarea class="full_width" cols="50" rows="5" name="custom_css"><?php if(!empty($custom_css)){ echo esc_textarea($custom_css); }; ?></textarea>
 </div><!-- END .content -->

 <div class="tcd_cf_content">
  <h4 class="theme_option_headline2"><?php _e('Custom script', 'tcd-w'); ?></h4>
  <div class="theme_option_message2" style="margin-top:10px;">
   <p><?php _e( 'Custom Script will output the end of the head tag. Please insert scripts (i.e. Google Analytics script), including script tag.', 'tcd-w' ); ?></p>
  </div>
  <textarea class="full_width" cols="50" rows="5" name="custom_script"><?php if(!empty($custom_script)){ echo esc_textarea($custom_script); }; ?></textarea>
 </div><!-- END .content -->

</div><!-- END #tcd_custom_fields -->

<?php
}

function save_custom_script_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['custom_script_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_script_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  $cf_keys = array('custom_script','custom_css');
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

}
add_action('save_post', 'save_custom_script_meta_box');



?>