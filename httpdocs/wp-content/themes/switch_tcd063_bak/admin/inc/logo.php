<?php
/*
 * Manage logo tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_logo_dp_default_options' );

// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_logo_tab_label' );

// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_logo_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_logo_theme_options_validate' );

// ロゴに画像を使うか否か
global $logo_type_options;
$logo_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Use text for logo', 'tcd-w' ),
    'image' => get_template_directory_uri() . '/admin/assets/images/header_logo_type1.gif'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Use image for logo', 'tcd-w' ),
    'image' => get_template_directory_uri() . '/admin/assets/images/header_logo_type2.gif'
  )
);


function add_logo_dp_default_options( $dp_default_options ) {

  // Header logo
	$dp_default_options['header_use_logo_image'] = 'type1';
	$dp_default_options['header_logo_color'] = '#ffffff';
	$dp_default_options['header_logo_font_size'] = 25;
	$dp_default_options['header_logo_image'] = '';
	$dp_default_options['header_logo_image_retina'] = '';

  // Header logo for mobile
	$dp_default_options['sp_header_use_logo_image'] = 'type1';
	$dp_default_options['sp_header_logo_color'] = '#000000';
	$dp_default_options['sp_header_logo_font_size'] = 25;
	$dp_default_options['sp_header_logo_image'] = '';
	$dp_default_options['sp_header_logo_image_retina'] = '';

	return $dp_default_options;
}

function add_logo_tab_label( $tab_labels ) {
	$tab_labels['logo'] = __( 'Logo', 'tcd-w' );
	return $tab_labels;
}

function add_logo_tab_panel( $options ) {
	global $dp_default_options, $logo_type_options;
?>
<div id="tab-content-logo" class="tab-content">

	<?php // Header logo ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header logo', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Type of logo', 'tcd-w');  ?></h4>
     <?php echo tcd_admin_image_radio_button($options, 'header_use_logo_image', $logo_type_options) ?>

     <div id="header_logo_type1_area">
      <h4 class="theme_option_headline2"><?php _e('Font size', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[header_logo_color]" value="<?php echo esc_attr( $options['header_logo_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_logo_color'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="hankaku" style="width:80px;" type="number" min="1" name="dp_options[header_logo_font_size]" value="<?php esc_attr_e( $options['header_logo_font_size'] ); ?>"> <span>px</span></li>
      </ul>
     </div>

     <div id="header_logo_type2_area">
      <h4 class="theme_option_headline2"><?php _e('Logo image', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
        <p><?php printf( __( 'TCD demo site use [Width: %dpx, Height: %dpx] sizes of the logo image for Retina Display.', 'tcd-w' ), 286, 49 ); ?></p>
        <p><?php _e('Please select "Yes" for the radio button below if you upload logo image for the retina display.','tcd-w'); ?><br><?php  _e( 'In order to avoid blurring images on retina displays, it is necessary to register an image that is at least twice the size that is actually displayed. Read <a href="https://tcd-theme.com/2019/04/retina-display.html" target="_blank">TCD article</a> for more details.', 'tcd-w' ); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Image', 'tcd-w'); ?></span>
    	<div class="image_box cf">
    		<div class="cf cf_media_field hide-if-no-js header_logo_image">
    			<input type="hidden" value="<?php echo esc_attr( $options['header_logo_image'] ); ?>" id="header_logo_image" name="dp_options[header_logo_image]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $options['header_logo_image'] ) { echo wp_get_attachment_image( $options['header_logo_image'], 'full' ); } ?></div>
      		<div class="button_area">
      	 		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      	 		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['header_logo_image'] ) { echo 'hidden'; } ?>">
      		</div>
				</div>
    	</div>
       </li>
       <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-w'); ?></span><label><input name="dp_options[header_logo_image_retina]" type="checkbox" value="1" <?php checked( 1, $options['header_logo_image_retina'] ); ?>> <?php _e('Yes', 'tcd-w'); ?></label></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // Header logo for mobile ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header logo (mobile)', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Type of logo', 'tcd-w');  ?></h4>
     <?php echo tcd_admin_image_radio_button($options, 'sp_header_use_logo_image', $logo_type_options) ?>

     <div id="mobile_header_logo_type1_area">
      <h4 class="theme_option_headline2"><?php _e('Font size', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[sp_header_logo_color]" value="<?php echo esc_attr( $options['sp_header_logo_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['sp_header_logo_color'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="hankaku" style="width:80px;" type="number" min="1" name="dp_options[sp_header_logo_font_size]" value="<?php esc_attr_e( $options['sp_header_logo_font_size'] ); ?>"> <span>px</span></li>
      </ul>
     </div>

     <div id="mobile_header_logo_type2_area">
      <h4 class="theme_option_headline2"><?php _e('Logo image', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
        <p><?php printf( __( 'TCD demo site use [Width: %dpx, Height: %dpx] sizes of the logo image for Retina Display.', 'tcd-w' ),286, 49 ); ?></p>
        <p><?php _e('Please select "Yes" for the radio button below if you upload logo image for the retina display.','tcd-w'); ?><br><?php  _e( 'In order to avoid blurring images on retina displays, it is necessary to register an image that is at least twice the size that is actually displayed. Read <a href="https://tcd-theme.com/2019/04/retina-display.html" target="_blank">TCD article</a> for more details.', 'tcd-w' ); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Image', 'tcd-w'); ?></span>
    	<div class="image_box cf">
    		<div class="cf cf_media_field hide-if-no-js sp_header_logo_image">
    			<input type="hidden" value="<?php echo esc_attr( $options['sp_header_logo_image'] ); ?>" id="sp_header_logo_image" name="dp_options[sp_header_logo_image]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $options['sp_header_logo_image'] ) { echo wp_get_attachment_image( $options['sp_header_logo_image'], 'full' ); } ?></div>
      		<div class="button_area">
      	 		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      	 		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['sp_header_logo_image'] ) { echo 'hidden'; } ?>">
      		</div>
				</div>
    	</div>
       </li>
       <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-w'); ?></span><label><input name="dp_options[sp_header_logo_image_retina]" type="checkbox" value="1" <?php checked( 1, $options['sp_header_logo_image_retina'] ); ?>>  <?php _e('Yes', 'tcd-w'); ?></label></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END #tab-content2 -->
<?php
}

function add_logo_theme_options_validate( $input ) {

	global $logo_type_options;

  // Header logo
 	if ( ! isset( $input['header_use_logo_image'] ) ) $input['header_use_logo_image'] = null;
 	if ( ! array_key_exists( $input['header_use_logo_image'], $logo_type_options ) ) $input['header_use_logo_image'] = null;
 	$input['header_logo_color'] = sanitize_hex_color( $input['header_logo_color'] );
 	$input['header_logo_font_size'] = absint( $input['header_logo_font_size'] );
 	$input['header_logo_image'] = absint( $input['header_logo_image'] );
 	if ( ! isset( $input['header_logo_image_retina'] ) ) $input['header_logo_image_retina'] = null;
  $input['header_logo_image_retina'] = ( $input['header_logo_image_retina'] == 1 ? 1 : 0 );

  // Header logo for mobile
 	if ( ! isset( $input['sp_header_use_logo_image'] ) ) $input['sp_header_use_logo_image'] = null;
 	if ( ! array_key_exists( $input['sp_header_use_logo_image'], $logo_type_options ) ) $input['sp_header_use_logo_image'] = null;
 	$input['sp_header_logo_color'] = sanitize_hex_color( $input['sp_header_logo_color'] );
 	$input['sp_header_logo_font_size'] = absint( $input['sp_header_logo_font_size'] );
 	$input['sp_header_logo_image'] = absint( $input['sp_header_logo_image'] );
 	if ( ! isset( $input['sp_header_logo_image_retina'] ) ) $input['sp_header_logo_image_retina'] = null;
  $input['sp_header_logo_image_retina'] = ( $input['sp_header_logo_image_retina'] == 1 ? 1 : 0 );

	return $input;
}
