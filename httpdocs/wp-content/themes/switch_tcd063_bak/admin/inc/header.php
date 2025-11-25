<?php
/*
 * Manage header tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );

// Add label of header tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );

// Add HTML of header tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );

global $header_fix_options;
$header_fix_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Normal header', 'tcd-w' )
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Fix at top after page scroll', 'tcd-w' )
	),
);

function add_header_dp_default_options( $dp_default_options ) {

  // Header
	$dp_default_options['header_fix'] = 'type1';
	$dp_default_options['sp_header_fix'] = 'type1';
	$dp_default_options['header_bg'] = '#000000';
	$dp_default_options['header_bg_opacity'] = 1.0;
	$dp_default_options['header_bg_fixed'] = '#000000';
	$dp_default_options['header_bg_opacity_fixed'] = 1.0;

  // Global navigation
	$dp_default_options['gnav_color'] = '#ffffff';
	$dp_default_options['gnav_color_hover'] = '#999999';
	$dp_default_options['gnav_sub_color'] = '#ffffff';
	$dp_default_options['gnav_sub_bg'] = '#000000';
	$dp_default_options['gnav_sub_color_hover'] = '#ffffff';
	$dp_default_options['gnav_sub_bg_hover'] = '#442606';
	$dp_default_options['gnav_color_sp'] = '#ffffff';
	$dp_default_options['gnav_bg_sp'] = '#000000';
	$dp_default_options['gnav_bg_opacity_sp'] = 1;

	$dp_default_options['show_header_message'] = '';
	$dp_default_options['header_message'] = __('Header message', 'tcd-w');
	$dp_default_options['header_message_url'] = '';
	$dp_default_options['header_message_font_color'] = '#ffffff';
	$dp_default_options['header_message_bg_color'] = '#442602';

	return $dp_default_options;
}

function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-w' );
	return $tab_labels;
}

function add_header_tab_panel( $options ) {
  global $dp_default_options, $header_fix_options;
?>
<div id="tab-content-header" class="tab-content">

  <?php // Header ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Header position', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please set the display position of the header bar.', 'tcd-w' ); ?></p>
      <?php echo __( '<p>Normal display position - When scrolling through the page, the header bar disappears.</p><p>Fixed display at the top - Following the page scroll, the header bar is fixedly displayed at the top of the page.</p>', 'tcd-w' ); ?>
     </div>
     <ul class="cf horizontal">
      <?php foreach ( $header_fix_options as $option ) : ?>
      <li><label class="description"><input type="radio" name="dp_options[header_fix]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $option['value'], $options['header_fix'] ); ?>><?php _e( $option['label'], 'tcd-w' ); ?></label></li>
      <?php endforeach; ?>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Header position (mobile)', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please set the display position of the header bar for mobile.', 'tcd-w' ); ?></p>
     </div>
     <ul class="cf horizontal">
      <?php foreach ( $header_fix_options as $option ) : ?>
      <li><label class="description"><input type="radio" name="dp_options[sp_header_fix]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['sp_header_fix'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></li>
      <?php endforeach; ?>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please set the background color of header bar.', 'tcd-w' ); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[header_bg]" value="<?php echo esc_attr( $options['header_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_bg'] ); ?>"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span><input style="width:70px;" type="number" min="0" max="1.0" step="0.1" name="dp_options[header_bg_opacity]" value="<?php echo esc_attr( $options['header_bg_opacity'] ); ?>">
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?><br>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Background color on fixed', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Sets the background color of the header bar for fixed display.', 'tcd-w' ); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[header_bg_fixed]" value="<?php echo esc_attr( $options['header_bg_fixed'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_bg_fixed'] ); ?>"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span><input style="width:70px;" type="number" min="0" max="1.0" step="0.1" name="dp_options[header_bg_opacity_fixed]" value="<?php echo esc_attr( $options['header_bg_opacity_fixed'] ); ?>">
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


 	<?php // Global navigation ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Global navigation', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Parent menu', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Set the color scheme of the the menu.', 'tcd-w' ); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[gnav_color]" value="<?php echo esc_attr( $options['gnav_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_color'] ); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Font color on hover', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[gnav_color_hover]" value="<?php echo esc_attr( $options['gnav_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_color_hover'] ); ?>"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Sub menu', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Set the color scheme of the submenu.', 'tcd-w' ); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[gnav_sub_color]" value="<?php echo esc_attr( $options['gnav_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_color'] ); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[gnav_sub_bg]" value="<?php echo esc_attr( $options['gnav_sub_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_bg'] ); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Font color on hover', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[gnav_sub_color_hover]" value="<?php echo esc_attr( $options['gnav_sub_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_color_hover'] ); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Background color on hover', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[gnav_sub_bg_hover]" value="<?php echo esc_attr( $options['gnav_sub_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_bg_hover'] ); ?>"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Menu setting for mobile', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Sets the color scheme of the menu for mobile.', 'tcd-w' ); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[gnav_color_sp]" value="<?php echo esc_attr( $options['gnav_color_sp'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_color_sp'] ); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[gnav_bg_sp]" value="<?php echo esc_attr( $options['gnav_bg_sp'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_bg_sp'] ); ?>"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span><input style="width:70px;" type="number" min="0" max="1.0" step="0.1" name="dp_options[gnav_bg_opacity_sp]" value="<?php echo esc_attr( $options['gnav_bg_opacity_sp'] ); ?>">
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


   <?php // メッセージ ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header message', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
       <p><?php _e('The "header message" is displayed at the top of the site (above the header bar).', 'tcd-w'); ?></br>
      </div>

      <p><label><input class="display_option" data-option-name="show_header_message" name="dp_options[show_header_message]" type="checkbox" value="1" <?php checked( 1, $options['show_header_message'] ); ?>><?php _e( 'Display header message', 'tcd-w' ); ?></label></p>

      <ul class="option_list show_header_message">
       <li class="cf" style="border-top:1px dotted #ddd;"><span class="label"><?php _e('Message', 'tcd-w');  ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[header_message]"><?php echo esc_textarea( $options['header_message'] ); ?></textarea></li>
       <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input id="dp_options[header_message_url]" class="full_width" type="text" name="dp_options[header_message_url]" value="<?php echo esc_attr( $options['header_message_url'] ); ?>" /></li>
       <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-w');  ?></span><input type="text" name="dp_options[header_message_font_color]" value="<?php echo esc_attr( $options['header_message_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w');  ?></span><input type="text" name="dp_options[header_message_bg_color]" value="<?php echo esc_attr( $options['header_message_bg_color'] ); ?>" data-default-color="#442602" class="c-color-picker"></li>
      </ul>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>

    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


</div><!-- END #tab-content7 -->
<?php
}

function add_header_theme_options_validate( $input ) {

  global $header_fix_options;

  // Header
 	if ( ! isset( $input['header_fix'] ) ) $input['header_fix'] = null;
 	if ( ! array_key_exists( $input['header_fix'], $header_fix_options ) ) $input['header_fix'] = null;
 	if ( ! isset( $input['sp_header_fix'] ) ) $input['sp_header_fix'] = null;
 	if ( ! array_key_exists( $input['sp_header_fix'], $header_fix_options ) ) $input['sp_header_fix'] = null;
	$input['header_bg'] = sanitize_hex_color( $input['header_bg'] );
  $input['header_bg_opacity'] = sanitize_text_field( $input['header_bg_opacity'] );
	$input['header_bg_fixed'] = sanitize_hex_color( $input['header_bg_fixed'] );
  $input['header_bg_opacity_fixed'] = sanitize_text_field( $input['header_bg_opacity_fixed'] );

  // Global navigation
	$input['gnav_color'] = sanitize_hex_color( $input['gnav_color'] );
	$input['gnav_color_hover'] = sanitize_hex_color( $input['gnav_color_hover'] );
	$input['gnav_sub_color'] = sanitize_hex_color( $input['gnav_sub_color'] );
	$input['gnav_sub_bg'] = sanitize_hex_color( $input['gnav_sub_bg'] );
	$input['gnav_sub_color_hover'] = sanitize_hex_color( $input['gnav_sub_color_hover'] );
	$input['gnav_sub_bg_hover'] = sanitize_hex_color( $input['gnav_sub_bg_hover'] );
	$input['gnav_color_sp'] = sanitize_hex_color( $input['gnav_color_sp'] );
	$input['gnav_bg_sp'] = sanitize_hex_color( $input['gnav_bg_sp'] );
	$input['gnav_bg_opacity_sp'] = sanitize_text_field( $input['gnav_bg_opacity_sp'] );

  // メッセージ
  $input['show_header_message'] = wp_filter_nohtml_kses( $input['show_header_message'] );
  $input['header_message'] = wp_filter_nohtml_kses( $input['header_message'] );
  $input['header_message_url'] = wp_filter_nohtml_kses( $input['header_message_url'] );
  $input['header_message_font_color'] = sanitize_hex_color( $input['header_message_font_color'] );
  $input['header_message_bg_color'] = sanitize_hex_color( $input['header_message_bg_color'] );

	return $input;
}
