<?php
/*
 * Manage faq tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_faq_dp_default_options' );

//  Add label of faq tab
add_action( 'tcd_tab_labels', 'add_faq_tab_label' );

// Add HTML of faq tab
add_action( 'tcd_tab_panel', 'add_faq_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_faq_theme_options_validate' );

global $faq_ph_desc_writing_mode_options;
$faq_ph_desc_writing_mode_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Horizontal writing', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Vertical writing', 'tcd-w' ) )
);

global $faq_ph_img_animation_type_options;
$faq_ph_img_animation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Zoom in', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Zoom out', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'None', 'tcd-w' ) )
);

function add_faq_dp_default_options( $dp_default_options ) {

  // FAQ page
  $dp_default_options['faq_slug'] = 'faq';
  $dp_default_options['faq_q_bg'] = '#000000';

  // Page header
  $dp_default_options['faq_ph_title'] = '';
  $dp_default_options['faq_ph_desc'] = '';
  $dp_default_options['faq_ph_desc_font_size'] = 40;
  $dp_default_options['faq_ph_desc_font_size_sp'] = 18;
  $dp_default_options['faq_ph_desc_color'] = '#ffffff';
  $dp_default_options['faq_ph_desc_writing_mode'] = 'type1';
  $dp_default_options['faq_ph_img'] = '';
  $dp_default_options['faq_ph_img_animation_type'] = 'type3';
  $dp_default_options['faq_ph_overlay'] = '#000000';
  $dp_default_options['faq_ph_overlay_opacity'] = 0.3;

	return $dp_default_options;
}

function add_faq_tab_label( $tab_labels ) {
	$tab_labels['faq'] = __( 'FAQ', 'tcd-w' );
	return $tab_labels;
}

function add_faq_tab_panel( $options ) {

	global $dp_default_options, $faq_ph_desc_writing_mode_options, $faq_ph_img_animation_type_options;
?>
<div id="tab-content-faq" class="tab-content">

	<?php // FAQ page ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic settings', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Slug', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "faq" is used instead.', 'tcd-w' ); ?></p>
      <p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
      <p><?php _e( 'Note: after changing the slug, you need to go to "<a href="./options-permalink.php">Permalink Settings</a>" and click "Save Changes".', 'tcd-w' ); ?></p>
     </div>
     <p><input type="text" name="dp_options[faq_slug]" value="<?php echo esc_attr( $options['faq_slug'] ); ?>"></p>

     <h4 class="theme_option_headline2"><?php _e( 'Background color of "Q"', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Set the background color of the "Q" icon displayed at the beginning of the question.', 'tcd-w' ); ?></p>
     </div>
     <input class="c-color-picker" type="text" name="dp_options[faq_q_bg]" data-default-color="<?php echo esc_attr( $dp_default_options['faq_q_bg'] ); ?>" value="<?php echo esc_attr( $options['faq_q_bg'] ); ?>">

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
     <input type="text" class="full_width" name="dp_options[faq_ph_title]" value="<?php echo esc_attr( $options['faq_ph_title'] ); ?>">

     <h4 class="theme_option_headline2"><?php _e( 'Description of #2', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please set the description displayed in the center of the page header. Set the description, font color, font size, writing direction.', 'tcd-w' ); ?></p>
     </div>
     <textarea class="full_width" name="dp_options[faq_ph_desc]"><?php echo esc_textarea( $options['faq_ph_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[faq_ph_desc_color]" value="<?php echo esc_attr( $options['faq_ph_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['faq_ph_desc_color'] ); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'faq_ph_desc_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><?php echo tcd_basic_radio_button($options, 'faq_ph_desc_writing_mode', $faq_ph_desc_writing_mode_options); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Background image', 'tcd-w'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '600'); ?></span>
       </span>
  	<div class="image_box cf">
  		<div class="cf cf_media_field hide-if-no-js faq_ph_img">
  			<input type="hidden" value="<?php echo esc_attr( $options['faq_ph_img'] ); ?>" id="faq_ph_img" name="dp_options[faq_ph_img]" class="cf_media_id">
  			<div class="preview_field"><?php if ( $options['faq_ph_img'] ) { echo wp_get_attachment_image( $options['faq_ph_img'], 'medium' ); } ?></div>
  			<div class="button_area">
  				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['faq_ph_img'] ) { echo 'hidden'; } ?>">
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
        <?php foreach ( $faq_ph_img_animation_type_options as $option ) : ?>
        <li><label><input type="radio" name="dp_options[faq_ph_img_animation_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['faq_ph_img_animation_type'] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></li>
        <?php endforeach; ?>
       </ul>
      </li>
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[faq_ph_overlay]" data-default-color="<?php echo esc_attr( $dp_default_options['faq_ph_overlay'] ); ?>" value="<?php echo esc_attr( $options['faq_ph_overlay'] ); ?>"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input style="width:70px;" type="number" min="0" max="1.0" step="0.1" name="dp_options[faq_ph_overlay_opacity]" value="<?php echo esc_attr( $options['faq_ph_overlay_opacity'] ); ?>">
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


</div><!-- END #tab-content-faq -->
<?php
}

function add_faq_theme_options_validate( $input ) {

  global $faq_ph_desc_writing_mode_options, $faq_ph_img_animation_type_options;

  // FAQ page
 	$input['faq_slug'] = sanitize_text_field( $input['faq_slug'] );
 	$input['faq_q_bg'] = sanitize_hex_color( $input['faq_q_bg'] );

  // Page header
 	$input['faq_ph_title'] = sanitize_text_field( $input['faq_ph_title'] );
 	$input['faq_ph_desc'] = sanitize_textarea_field( $input['faq_ph_desc'] );
 	$input['faq_ph_desc_font_size'] = absint( $input['faq_ph_desc_font_size'] );
 	$input['faq_ph_desc_font_size_sp'] = absint( $input['faq_ph_desc_font_size_sp'] );
 	$input['faq_ph_desc_color'] = sanitize_hex_color( $input['faq_ph_desc_color'] );
  if ( ! isset( $input['faq_ph_desc_writing_mode'] ) ) $input['faq_ph_desc_writing_mode'] = null;
  if ( ! array_key_exists( $input['faq_ph_desc_writing_mode'], $faq_ph_desc_writing_mode_options ) ) $input['faq_ph_desc_writing_mode'] = null;
 	$input['faq_ph_img'] = absint( $input['faq_ph_img'] );
  if ( ! isset( $input['faq_ph_img_animation_type'] ) ) $input['faq_ph_img_animation_type'] = null;
  if ( ! array_key_exists( $input['faq_ph_img_animation_type'], $faq_ph_img_animation_type_options ) ) $input['faq_ph_img_animation_type'] = null;
 	$input['faq_ph_overlay'] = sanitize_hex_color( $input['faq_ph_overlay'] );
 	$input['faq_ph_overlay_opacity'] = sanitize_text_field( $input['faq_ph_overlay_opacity'] );

	return $input;
}
