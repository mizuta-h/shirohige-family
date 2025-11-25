<?php
/*
 * Manage event tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_event_dp_default_options' );

//  Add label of event tab
add_action( 'tcd_tab_labels', 'add_event_tab_label' );

// Add HTML of event tab
add_action( 'tcd_tab_panel', 'add_event_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_event_theme_options_validate' );

global $event_ph_desc_writing_mode_options;
$event_ph_desc_writing_mode_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Horizontal writing', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Vertical writing', 'tcd-w' ) )
);

global $event_ph_img_animation_type_options;
$event_ph_img_animation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Zoom in', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Zoom out', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'None', 'tcd-w' ) )
);

function add_event_dp_default_options( $dp_default_options ) {

  // Event page
  $dp_default_options['event_breadcrumb'] = __( 'Event', 'tcd-w' );
  $dp_default_options['event_slug'] = 'event';

  // Page header
  $dp_default_options['event_ph_title'] = 'EVENT';
  $dp_default_options['event_ph_desc'] = __( 'Enter description here.' . "\n" . 'Enter description here.', 'tcd-w' );
  $dp_default_options['event_ph_desc_font_size'] = 40;
  $dp_default_options['event_ph_desc_font_size_sp'] = 18;
  $dp_default_options['event_ph_desc_color'] = '#ffffff';
  $dp_default_options['event_ph_desc_writing_mode'] = 'type1';
  $dp_default_options['event_ph_img'] = '';
  $dp_default_options['event_ph_img_animation_type'] = 'type3';
  $dp_default_options['event_ph_overlay'] = '#000000';
  $dp_default_options['event_ph_overlay_opacity'] = 0.3;

  // Archive page
	$dp_default_options['event_post_num'] = 10;

  // Single page
	$dp_default_options['event_title_font_size'] = 32;
	$dp_default_options['event_title_font_size_sp'] = 22;
	$dp_default_options['event_content_font_size'] = 14;
	$dp_default_options['event_content_font_size_sp'] = 14;

	// Display
	$dp_default_options['event_show_date'] = 1;
	$dp_default_options['event_show_thumbnail'] = 1;
	$dp_default_options['event_show_sns'] = 1;
	$dp_default_options['event_show_next_post'] = 1;
	$dp_default_options['show_related_event'] = 1;

	return $dp_default_options;
}

function add_event_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['event_breadcrumb'] ? esc_html( $options['event_breadcrumb'] ) : __( 'Event', 'tcd-w' );
  $tab_labels['event'] = $tab_label;
	return $tab_labels;
}

function add_event_tab_panel( $options ) {

	global $dp_default_options, $event_ph_desc_writing_mode_options, $event_ph_img_animation_type_options;

  $event_label = $options['event_breadcrumb'] ? esc_html( $options['event_breadcrumb'] ) : __( 'Event', 'tcd-w' );

?>
<div id="tab-content-event" class="tab-content">

	<?php // Event page ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic settings', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Breadcrumb', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "Event" is displayed instead.', 'tcd-w' ); ?></p>
     </div>
     <p><input type="text" name="dp_options[event_breadcrumb]" value="<?php echo esc_attr( $options['event_breadcrumb'] ); ?>"></p>

     <h4 class="theme_option_headline2"><?php _e( 'Slug', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "event" is used instead.', 'tcd-w' ); ?></p>
      <p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
      <p><?php _e( 'Note: after changing the slug, you need to go to "<a href="./options-permalink.php">Permalink Settings</a>" and click "Save Changes".', 'tcd-w' ); ?></p>
     </div>
     <p><input type="text" name="dp_options[event_slug]" value="<?php echo esc_attr( $options['event_slug'] ); ?>"></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // Page header ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Page header', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <p style="text-align:center;"><img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/page_header.png" alt=""></p>

     <h4 class="theme_option_headline2"><?php _e( 'Title of #1', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Set the title to bottom of page header.', 'tcd-w' ); ?></p>
     </div>
     <input type="text" class="full_width" name="dp_options[event_ph_title]" value="<?php echo esc_attr( $options['event_ph_title'] ); ?>">

     <h4 class="theme_option_headline2"><?php _e( 'Description of #2', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please set the description displayed in the center of the page header. Set the description, font color, font size, writing direction.', 'tcd-w' ); ?></p>
     </div>
     <textarea class="full_width" name="dp_options[event_ph_desc]"><?php echo esc_textarea( $options['event_ph_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[event_ph_desc_color]" value="<?php echo esc_attr( $options['event_ph_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['event_ph_desc_color'] ); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'event_ph_desc_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><?php echo tcd_basic_radio_button($options, 'event_ph_desc_writing_mode', $event_ph_desc_writing_mode_options); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Background image', 'tcd-w'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '600'); ?></span>
       </span>
  	<div class="image_box cf">
  		<div class="cf cf_media_field hide-if-no-js event_ph_img">
  			<input type="hidden" value="<?php echo esc_attr( $options['event_ph_img'] ); ?>" id="event_ph_img" name="dp_options[event_ph_img]" class="cf_media_id">
  			<div class="preview_field"><?php if ( $options['event_ph_img'] ) { echo wp_get_attachment_image( $options['event_ph_img'], 'medium' ); } ?></div>
  			<div class="button_area">
  				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['event_ph_img'] ) { echo 'hidden'; } ?>">
  			</div>
  		</div>
  	</div>
      </li>
      <li class="cf">
       <span class="label">
        <?php _e('Animation', 'tcd-w'); ?>
        <span class="recommend_desc"><?php _e( 'Please select animation of background image.', 'tcd-w' ); ?></span>
       </span>
       <ul>
        <?php foreach ( $event_ph_img_animation_type_options as $option ) : ?>
        <li><label><input type="radio" name="dp_options[event_ph_img_animation_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['event_ph_img_animation_type'] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></li>
        <?php endforeach; ?>
       </ul>
      </li>
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[event_ph_overlay]" data-default-color="<?php echo esc_attr( $dp_default_options['event_ph_overlay'] ); ?>" value="<?php echo esc_attr( $options['event_ph_overlay'] ); ?>"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input style="width:70px;" type="number" min="0" max="1.0" step="0.1" name="dp_options[event_ph_overlay_opacity]" value="<?php echo esc_attr( $options['event_ph_overlay_opacity'] ); ?>">
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?><br>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // Archive page ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Number of posts to display', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'You can set the number of posts to be displayed in archive page.', 'tcd-w' ); ?></p>
     </div>
     <input style="width:80px;" type="number" min="1" step="1" name="dp_options[event_post_num]" value="<?php echo esc_attr( $options['event_post_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // Single page ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-w'), $event_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Font size', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Post title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'event_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Post content', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'event_content_font_size'); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // Display ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Display settings', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php printf(__('Archive page and %s page', 'tcd-w'), $event_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[event_show_date]" type="checkbox" value="1" <?php checked( '1', $options['event_show_date'] ); ?>></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s page', 'tcd-w'), $event_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display thumbnail', 'tcd-w'); ?></span><input name="dp_options[event_show_thumbnail]" type="checkbox" value="1" <?php checked( '1', $options['event_show_thumbnail'] ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display share buttons after the article', 'tcd-w'); ?></span><input name="dp_options[event_show_sns]" type="checkbox" value="1" <?php checked( '1', $options['event_show_sns'] ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display next previous post link', 'tcd-w'); ?></span><input name="dp_options[event_show_next_post]" type="checkbox" value="1" <?php checked( '1', $options['event_show_next_post'] ); ?>></li>
      <li class="cf"><span class="label"><?php printf(__('Display related %s', 'tcd-w'), $event_label); ?></span><input name="dp_options[show_related_event]" type="checkbox" value="1" <?php checked( '1', $options['show_related_event'] ); ?>></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END #tab-content4 -->
<?php
}

function add_event_theme_options_validate( $input ) {

  global $event_ph_desc_writing_mode_options, $event_ph_img_animation_type_options;

  // Event page
 	$input['event_breadcrumb'] = sanitize_text_field( $input['event_breadcrumb'] );
 	$input['event_slug'] = sanitize_text_field( $input['event_slug'] );

  // Page header
 	$input['event_ph_title'] = sanitize_text_field( $input['event_ph_title'] );
 	$input['event_ph_desc'] = sanitize_textarea_field( $input['event_ph_desc'] );
 	$input['event_ph_desc_font_size'] = absint( $input['event_ph_desc_font_size'] );
 	$input['event_ph_desc_font_size_sp'] = absint( $input['event_ph_desc_font_size_sp'] );
 	$input['event_ph_desc_color'] = sanitize_hex_color( $input['event_ph_desc_color'] );
  if ( ! isset( $input['event_ph_desc_writing_mode'] ) ) $input['event_ph_desc_writing_mode'] = null;
  if ( ! array_key_exists( $input['event_ph_desc_writing_mode'], $event_ph_desc_writing_mode_options ) ) $input['event_ph_desc_writing_mode'] = null;
 	$input['event_ph_img'] = absint( $input['event_ph_img'] );
  if ( ! isset( $input['event_ph_img_animation_type'] ) ) $input['event_ph_img_animation_type'] = null;
  if ( ! array_key_exists( $input['event_ph_img_animation_type'], $event_ph_img_animation_type_options ) ) $input['event_ph_img_animation_type'] = null;
 	$input['event_ph_overlay'] = sanitize_hex_color( $input['event_ph_overlay'] );
 	$input['event_ph_overlay_opacity'] = sanitize_text_field( $input['event_ph_overlay_opacity'] );

  // Archive page
  $input['event_post_num'] = absint( $input['event_post_num'] );

  // Single page
 	$input['event_title_font_size'] = absint( $input['event_title_font_size'] );
 	$input['event_title_font_size_sp'] = absint( $input['event_title_font_size_sp'] );
 	$input['event_content_font_size'] = absint( $input['event_content_font_size'] );
 	$input['event_content_font_size_sp'] = absint( $input['event_content_font_size_sp'] );

 	// Display
 	if ( ! isset( $input['event_show_date'] ) ) $input['event_show_date'] = null;
  $input['event_show_date'] = ( $input['event_show_date'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['event_show_thumbnail'] ) ) $input['event_show_thumbnail'] = null;
  $input['event_show_thumbnail'] = ( $input['event_show_thumbnail'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['event_show_sns'] ) ) $input['event_show_sns'] = null;
  $input['event_show_sns'] = ( $input['event_show_sns'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['event_show_next_post'] ) ) $input['event_show_next_post'] = null;
  $input['event_show_next_post'] = ( $input['event_show_next_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_related_event'] ) ) $input['show_related_event'] = null;
  $input['show_related_event'] = ( $input['show_related_event'] == 1 ? 1 : 0 );

	return $input;
}
