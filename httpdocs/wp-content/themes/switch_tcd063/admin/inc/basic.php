<?php
/*
 * Manage basic tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_basic_dp_default_options' );

// Add label of basic tab
add_action( 'tcd_tab_labels', 'add_basic_tab_label' );

// Add HTML of basic tab
add_action( 'tcd_tab_panel', 'add_basic_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_basic_theme_options_validate' );

// Font type
global $font_type_options;
$font_type_options = array(
 	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Meiryo', 'tcd-w' )
	),
 	'type2' => array( 
		'value' => 'type2',
		'label' => __( 'YuGothic', 'tcd-w' ) 
	),
 	'type3' => array( 
		'value' => 'type3',
		'label' => __( 'YuMincho', 'tcd-w' ) 
	)
);

// Headline font type
global $headline_font_type_options;
$headline_font_type_options = $font_type_options;

// Load icon
global $load_icon_options;
$load_icon_options = array();
for ( $i = 1; $i <= 3; $i++ ) {
	$load_icon_options['type' . $i] = array(
		'value' => 'type' . $i,
		'label' => 1 === $i ? __( 'Circle', 'tcd-w' ) : ( 2 === $i ? __( 'Square', 'tcd-w' ) : __( 'Dot', 'tcd-w' ) )
	);
}

// Load time
global $load_time_options;
for ( $i = 3; $i <= 10; $i++) {
	$load_time_options[$i] = array( 'value' => $i, 'label' => $i );
}

$dp_default_options['load_first'] = 0;

// Hover type
global $hover_type_options, $hover2_direct_options;
$hover_type_options = array();
for ( $i = 1; $i <= 3; $i++ ) {
	$hover_type_options['type' . $i] = array(
		'value' => 'type' . $i,
		'label' => 1 === $i ? __( 'Zoom', 'tcd-w' ) : ( 2 === $i ? __( 'Slide', 'tcd-w' ) : __( 'Fade', 'tcd-w' ) )
	);
}
$hover2_direct_options = array();
for ( $i = 1; $i <= 2; $i++ ) {
	$hover2_direct_options['type' . $i] = array(
		'value' => 'type' . $i,
		'label' => 1 === $i ? __( 'Left to Right', 'tcd-w' ) : __( 'Right to Left', 'tcd-w' )
	);
}

// SNS type
global $sns_type_top_options, $sns_type_btm_options;
$sns_type_top_options = array(
	'type1' => array( 'value' => 'type1', 'label' => __( 'style1', 'tcd-w' ) ),
	'type2' => array( 'value' => 'type2', 'label' => __( 'style2', 'tcd-w' ) ),
	'type3' => array( 'value' => 'type3', 'label' => __( 'style3', 'tcd-w' ) ),
	'type4' => array( 'value' => 'type4', 'label' => __( 'style4', 'tcd-w' ) ),
	'type5' => array( 'value' => 'type5', 'label' => __( 'style5', 'tcd-w' ) )
);
$sns_type_btm_options = $sns_type_top_options;

// Google Maps
global $gmap_marker_type_options;
$gmap_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Use default marker', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Use custom marker', 'tcd-w' ) )
);

global $gmap_custom_marker_type_options;
$gmap_custom_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Text', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Image', 'tcd-w' ) )
);

global $sidebar_options;
$sidebar_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Display on the left', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Display on the right', 'tcd-w' ) )
);

function add_basic_dp_default_options( $dp_default_options ) {

	// Color
	$dp_default_options['primary_color'] = '#000000';
	$dp_default_options['secondary_color'] = '#442602';
	$dp_default_options['content_link_color'] = '#442602';

	// Favicon
	$dp_default_options['favicon'] = '';

	// Font type
	$dp_default_options['font_type'] = 'type2';

	// Headline font type
	$dp_default_options['headline_font_type'] = 'type2';

	// Quicktags
	$dp_default_options['use_quicktags'] = 1;

	// Sidebar
	$dp_default_options['sidebar'] = 'type2';

	// Loading screen
	$dp_default_options['use_load_icon'] = 1;
	$dp_default_options['load_icon'] = 'type1';

	// Hover effect
	$dp_default_options['hover_type'] = 'type1';
	$dp_default_options['hover1_zoom'] = 1.2;
	$dp_default_options['hover2_direct'] = 'type1';
	$dp_default_options['hover2_opacity'] = 0.5;
	$dp_default_options['hover3_opacity'] = 0.5;
	$dp_default_options['hover3_bgcolor'] = '#ffffff';


	// Share button
	$dp_default_options['sns_type_btm'] = 'type1';
	$dp_default_options['show_twitter_btm'] = 1;
	$dp_default_options['show_fblike_btm'] = 1;
	$dp_default_options['show_fbshare_btm'] = 1;
	$dp_default_options['show_hatena_btm'] = 1;
	$dp_default_options['show_pocket_btm'] = 1;
	$dp_default_options['show_feedly_btm'] = 1;
	$dp_default_options['show_rss_btm'] = 1;
	$dp_default_options['show_pinterest_btm'] = 1;
	$dp_default_options['twitter_info'] = '';

  // Google Map
	$dp_default_options['gmap_api_key'] = '';
	$dp_default_options['gmap_marker_type'] = 'type1';
	$dp_default_options['gmap_custom_marker_type'] = 'type1';
	$dp_default_options['gmap_marker_text'] = '';
	$dp_default_options['gmap_marker_color'] = '#ffffff';
	$dp_default_options['gmap_marker_img'] = '';
	$dp_default_options['gmap_marker_bg'] = '#000000';

	// Custom CSS
	$dp_default_options['css_code'] = '';

	// Custom head/script
  $dp_default_options['custom_head'] = '';

	return $dp_default_options;
}

function add_basic_tab_label( $tab_labels ) {
	$tab_labels['basic'] = __( 'Basic', 'tcd-w' );
	return $tab_labels;
}

function add_basic_tab_panel( $options ) {

	global $dp_default_options, $font_type_options, $headline_font_type_options, $load_icon_options, $load_time_options, $hover_type_options, $hover2_direct_options, $sns_type_top_options, $sns_type_btm_options, $gmap_marker_type_options, $gmap_custom_marker_type_options, $sidebar_options;
?>
<div id="tab-content-basic" class="tab-content">

	<?php // 色の設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Color', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'You can set the colors used in your site in common. You can also set other colors for buttons and navigations with each theme option.', 'tcd-w' ); ?></p>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Primary color', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'This color is used as the button color of the archive page pager, the category icon, the background color of the heading element, and the background color of the widget title.', 'tcd-w' ); ?></p>
     </div>
     <input type="text" name="dp_options[primary_color]" value="<?php echo esc_attr( $options['primary_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['primary_color'] ); ?>" class="c-color-picker">

     <h4 class="theme_option_headline2"><?php _e( 'Secondary color', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'This color is used for hover of link exept for individual settings.', 'tcd-w' ); ?></p>
     </div>
     <input type="text" name="dp_options[secondary_color]" value="<?php echo esc_attr( $options['secondary_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['secondary_color'] ); ?>" class="c-color-picker">

     <h4 class="theme_option_headline2"><?php _e( 'Link color of post contents', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'This color is used for link texts in single pages.', 'tcd-w' ); ?></p>
     </div>
     <input type="text" name="dp_options[content_link_color]" value="<?php echo esc_attr( $options['content_link_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['content_link_color'] ); ?>" class="c-color-picker">

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // ファビコンの設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Favicon', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'If you have set the site icon in "<a href="./customize.php" target="_blank">Customize</a>" screen in the appearance menu, you do not need to set this option.', 'tcd-w' ); ?></p>
      <p><?php _e( 'Instruction for registering site icon in customize screen, see the official <a href="https://tcd-theme.com/2021/02/wp-favicon-setting.html" target="_blank">TCD blog article</a>.', 'tcd-w' ); ?></p>
     </div>

    <div class="image_box cf">
    	<div class="cf cf_media_field hide-if-no-js favicon">
    		<input type="hidden" value="<?php echo esc_attr( $options['favicon'] ); ?>" id="favicon" name="dp_options[favicon]" class="cf_media_id">
    		<div class="preview_field"><?php if ( $options['favicon'] ) { echo wp_get_attachment_image($options['favicon'], 'medium' ); } ?></div>
    		<div class="button_area">
    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
    			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['favicon'] ) { echo 'hidden'; } ?>">
    		</div>
    	</div>
    </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // フォントタイプ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Font', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Headline', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please set the font type of headline.', 'tcd-w' ); ?></p>
     </div>
     <?php echo tcd_basic_radio_button($options, 'headline_font_type', $font_type_options); ?>
     <br style="clear:both;">

     <h4 class="theme_option_headline2"><?php _e( 'Post content', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please set the font type of all text except for headline.', 'tcd-w' ); ?></p>
     </div>
     <?php echo tcd_basic_radio_button($options, 'font_type', $font_type_options); ?>
     <br style="clear:both;">

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // Quicktags ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Quicktags', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'If you don\'t want to use quicktags included in the theme, please uncheck the box below.', 'tcd-w' ); ?></p>
     </div>

     <p><label><input name="dp_options[use_quicktags]" type="checkbox" value="1" <?php checked( 1, $options['use_quicktags'] ); ?>><?php _e( 'Use quicktags', 'tcd-w' ); ?></label></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // Sidebar ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Sidebar', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'You can set the position of sidebar.', 'tcd-w' );  ?></p>
     </div>

    <fieldset class="radio_images">
      <?php foreach ( $sidebar_options as $option ) : ?>
  	  <label>
        <input name="dp_options[sidebar]" type="radio" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['sidebar'] ); ?>>
        <?php esc_html_e( $option['label'] ); ?>
        <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/sidebar_<?php echo esc_attr( $option['value'] ); ?>.png" alt="">
      </label>
      <?php endforeach; ?>
    </fieldset>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // Loading screen ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Loading screen', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'You can set the load screen displayed during page transition.', 'tcd-w' );  ?></p>
     </div>

      <p><label><input id="dp_options[use_load_icon]" name="dp_options[use_load_icon]" type="checkbox" value="1" <?php checked( 1, $options['use_load_icon'] ); ?>><?php _e( 'Use load icon.', 'tcd-w' ); ?></label></p>
    
		<h4 class="theme_option_headline2"><?php _e( 'Type of loader', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please select load icon from 3 types.', 'tcd-w' );  ?></p>
     </div>
    <select id="load_icon_type" name="dp_options[load_icon]">
    	<?php foreach ( $load_icon_options as $option ) : ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['load_icon'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
      <?php endforeach; ?>
    </select>
    <h4 class="theme_option_headline2"><?php _e( 'Load screen display settings', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
      <p><?php _e( 'f you want the loading screen to appear only once, check the box.', 'tcd-w' );  ?></p>
     </div>
     <p><label><input name="dp_options[load_first]" type="checkbox" value="1" <?php checked( 1, $options['load_first'] ); ?>><?php _e( 'Display once at first time access', 'tcd-w' ); ?></label></p>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // Hover effect ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Hover effect', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

  	<h4 class="theme_option_headline2"><?php _e( 'Hover effect type', 'tcd-w' ); ?></h4>

    <div class="theme_option_message2">
     <p><?php _e( 'Please set the hover effect for thumbnail images.', 'tcd-w' ); ?></p>
     <?php echo __( '<p>Zoom:The thumbnail image is enlarged with the specified enlargement ratio.</p><p>FSlide:The thumbnail image moves horizontally in the direction specified to the left and right, and the set background color can be seen through.</p><p>Fade:The image is transmitted with the specified transmittance, and the set background color can be seen through.</p>', 'tcd-w' ); ?>
    </div>

  	<fieldset class="cf">

     <ul class="cf horizontal">
			<?php foreach ( $hover_type_options as $option ) : ?>
			<li><label for="tab-<?php echo $option['value']; ?>" style="display:block;"><input type="radio" id="tab-<?php echo $option['value']; ?>" name="dp_options[hover_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['hover_type'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></li>
			<?php endforeach; ?>
     </ul>

				<div id="hover_type_type1" <?php if ( 'type1' !== $options['hover_type'] ) { echo 'style="display: none;"'; } ?>>
		  		<h4 class="theme_option_headline2"><?php _e( 'Settings for Zoom effect', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
		  		<p><?php _e( 'Please set the rate of magnification.', 'tcd-w' ); ?></p>
    </div>
		  		<input style="width:80px;" type="number" min="1" step="0.1" name="dp_options[hover1_zoom]" value="<?php echo esc_attr( $options['hover1_zoom'] ); ?>">
	    	</div>

    		<div id="hover_type_type2" <?php if ( 'type2' !== $options['hover_type'] ) { echo 'style="display: none;"'; } ?>>
		  		<h4 class="theme_option_headline2"><?php _e( 'Settings for Slide effect', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
		  		<p><?php _e( 'Please set the direction of slide.', 'tcd-w' ); ?></p>
    </div>
		  		<ul class="cf" style="margin-bottom:20px;">
						<?php foreach ( $hover2_direct_options as $option ) : ?>
		    	 	<label style="float:left; margin-right:15px;"><input type="radio" name="dp_options[hover2_direct]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['hover2_direct'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label>
						<?php endforeach; ?>
		    	</ul>

    <div class="theme_option_message2">
					<p><?php _e( 'Please set the opacity. (0 - 1.0, e.g. 0.7)', 'tcd-w' ); ?></p>
    </div>
		    	<input style="width:80px;" type="number" min="0" max="1" step="0.1" name="dp_options[hover2_opacity]" value="<?php echo esc_attr( $options['hover2_opacity'] ); ?>">
	    	</div>

    		<div id="hover_type_type3" <?php if ( 'type3' !== $options['hover_type'] ) { echo 'style="display: none;"'; } ?>>
		    	<h4 class="theme_option_headline2"><?php _e( 'Settings for Fade effect', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
		    	<p><?php _e( 'Please set the opacity. (0 - 1.0, e.g. 0.7)', 'tcd-w' ); ?></p>
    </div>
		    	<input id="dp_options[hover3_opacity]" class="hankaku" style="width:80px;" type="number" min="0" max="1" step="0.1" name="dp_options[hover3_opacity]" value="<?php echo esc_attr( $options['hover3_opacity'] ); ?>">
    <div class="theme_option_message2" style="margin-top:20px;">
		    	<p><?php _e( 'Please set the background color.', 'tcd-w' ); ?></p>
    </div>
					<input type="text" name="dp_options[hover3_bgcolor]" value="<?php echo esc_attr( $options['hover3_bgcolor'] ); ?>" data-default-color="#ffffff" class="c-color-picker">
	    	</div>

    </fieldset>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

	<?php // Share button ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Share button', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'You can set share buttons at bottom of single page.', 'tcd-w' ); ?></p>
      <p><?php _e( 'You can select whether to show or hide buttons with the theme options of each post type.', 'tcd-w' ); ?></p>
      <?php echo __( '<p>Facebook like button is displayed only when you select Button type 5 (Default button).</p><p>RSS button is not displayed if you select Button type 5 (Default button).</p>', 'tcd-w' ); ?>
     </div>

    	<h4 class="theme_option_headline2"><?php _e( 'Type of button on article bottom', 'tcd-w' ); ?></h4>
      <p><?php _e( 'Please select the button type to be displayed at the bottom of the article.', 'tcd-w' ); ?></p>
      <fieldset class="cf radio_images_2col">
      	<?php foreach ( $sns_type_btm_options as $option ) : ?>
        <label>
          <input type="radio" name="dp_options[sns_type_btm]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['sns_type_btm'] ); ?>>
          <?php esc_html_e( $option['label'], 'tcd-w' ); ?>
          <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/share_<?php echo esc_attr( $option['value'] ); ?>.jpg" alt="">
        </label>
      	<?php endforeach; ?>
      </fieldset>

     <h4 class="theme_option_headline2"><?php _e( 'Select the social button to show on article bottom', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please check the button to display at the bottom of the article.', 'tcd-w' ); ?></p>
     </div>
      <ul>
      	<li><label><input id="dp_options[show_twitter_btm]" name="dp_options[show_twitter_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_twitter_btm'] ); ?>><?php _e( 'Display X button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_fblike_btm]" name="dp_options[show_fblike_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_fblike_btm'] ); ?>><?php _e( 'Display facebook like button-Button type 5 (Default button) only', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_fbshare_btm]" name="dp_options[show_fbshare_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_fbshare_btm'] ); ?>><?php _e( 'Display facebook share button', 'tcd-w' ); ?></label></li>
				<li><label><input id="dp_options[show_hatena_btm]" name="dp_options[show_hatena_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_hatena_btm'] ); ?>><?php _e( 'Display hatena button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_pocket_btm]" name="dp_options[show_pocket_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_pocket_btm'] ); ?>><?php _e( 'Display pocket button', 'tcd-w' ); ?></label></li>
        <li><label><input id="dp_options[show_rss_btm]" name="dp_options[show_rss_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_rss_btm'] ); ?>><?php _e( 'Display rss button', 'tcd-w' ); ?></label></li>
        <li><label><input id="dp_options[show_feedly_btm]" name="dp_options[show_feedly_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_feedly_btm'] ); ?>><?php _e( 'Display feedly button', 'tcd-w' ); ?></label></li>
        <li><label><input id="dp_options[show_pinterest_btm]" name="dp_options[show_pinterest_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_pinterest_btm'] ); ?>><?php _e( 'Display pinterest button', 'tcd-w' ); ?></label></li>
      </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Setting for the X button', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please input your X account. (ex.designplus)', 'tcd-w' ); ?></p>
     </div>
     <input style="display:block; margin:.6em 0 1em;" id="dp_options[twitter_info]" class="regular-text" type="text" name="dp_options[twitter_info]" value="<?php esc_attr_e( $options['twitter_info'] ); ?>">

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // Google Maps ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Google Maps', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'You can set styles of marker in Google maps, and select default marker or custom marker.', 'tcd-w' ); ?></p>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'API key', 'tcd-w' ); ?></h4>
     <input type="text" class="full_width" name="dp_options[gmap_api_key]" value="<?php echo esc_attr( $options['gmap_api_key'] ); ?>">

     <h4 class="theme_option_headline2"><?php _e( 'Marker type', 'tcd-w' ); ?></h4>
     <fieldset class="cf radio_images">
      <?php foreach ( $gmap_marker_type_options as $option ) : ?>
      <label>
        <input type="radio" name="dp_options[gmap_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['gmap_marker_type'] ); ?>>
        <?php echo esc_html_e( $option['label'] ); ?>
        <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/gmap_marker_<?php echo esc_attr( $option['value'] ); ?>.jpg" alt="">
      </label>
      <?php endforeach; ?>
     </fieldset>

     <div id="gmap_marker_type_type2" style="<?php if ( 'type2' !== $options['gmap_marker_type'] ) { echo 'display: none;'; } ?>">

      <h4 class="theme_option_headline2"><?php _e( 'Custom marker type', 'tcd-w' ); ?></h4>
      <ul class="cf horizontal">
       <?php foreach ( $gmap_custom_marker_type_options as $option ) : ?>
       <li><label><input type="radio" name="dp_options[gmap_custom_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['gmap_custom_marker_type'] ); ?>> <?php echo esc_html_e( $option['label'] ); ?></label></li>
       <?php endforeach; ?>
      </ul>

      <div id="gmap_custom_marker_type_type1" style="<?php if ( 'type1' !== $options['gmap_custom_marker_type'] ) { echo 'display: none;'; } ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Custom marker text', 'tcd-w' ); ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Text', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[gmap_marker_text]" value="<?php echo esc_attr( $options['gmap_marker_text'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" id="gmap_marker_color" name="dp_options[gmap_marker_color]" value="<?php echo esc_attr( $options['gmap_marker_color'] ); ?>" class="c-color-picker" data-default-color="<?php echo esc_attr( $options['gmap_marker_color'] ); ?>" /></li>
       </ul>
      </div>

      <div id="gmap_custom_marker_type_type2" style="<?php if ( 'type2' !== $options['gmap_custom_marker_type'] ) { echo 'display: none;'; } ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Custom marker image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e( 'Recommended size: width:60px, height:20px', 'tcd-w' ); ?></p>
       </div>
       <div class="image_box cf">
        	<div class="cf cf_media_field hide-if-no-js gmap_marker_img">
        		<input type="hidden" value="<?php echo esc_attr( $options['gmap_marker_img'] ); ?>" id="gmap_marker_img" name="dp_options[gmap_marker_img]" class="cf_media_id">
        		<div class="preview_field"><?php if ( $options['gmap_marker_img'] ) { echo wp_get_attachment_image($options['gmap_marker_img'], 'medium' ); } ?></div>
        		<div class="button_area">
        			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['gmap_marker_img'] ) { echo 'hidden'; } ?>">
        		</div>
        	</div>
       </div>
      </div>

      <h4 class="theme_option_headline2"><?php _e( 'Marker style', 'tcd-w' ); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" id="gmap_marker_color" name="dp_options[gmap_marker_bg]" value="<?php echo esc_attr( $options['gmap_marker_bg'] ); ?>" class="c-color-picker" data-default-color="<?php echo esc_attr( $options['gmap_marker_bg'] ); ?>" /></li>
      </ul>

     </div>
 
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // カスタムCSS ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Custom CSS and script', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Custom CSS', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
  	<p><?php _e( 'Code example:<br /><strong>.example { font-size:12px; }</strong>', 'tcd-w' );  ?></p>
     </div>
  	<textarea id="dp_options[css_code]" class="large-text" cols="50" rows="10" name="dp_options[css_code]"><?php echo esc_textarea( $options['css_code'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e( 'Custom script', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
  	<p><?php _e( 'Custom Script will output the end of the head tag. Please insert scripts (i.e. Google Analytics script), including script tag.', 'tcd-w' ); ?></p>
     </div>
		<textarea class="large-text" cols="50" rows="10" name="dp_options[custom_head]"><?php echo esc_textarea( $options['custom_head'] ); ?></textarea>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END #tab-content1 -->
<?php
}

function add_basic_theme_options_validate( $input ) {

	global $font_type_options,$headline_font_type_options, $load_icon_options, $load_time_options, $hover_type_options, $hover2_direct_options, $sns_type_top_options, $sns_type_btm_options, $gmap_custom_marker_type_options, $gmap_marker_type_options, $sidebar_options;

	// Color
 	$input['primary_color'] = sanitize_hex_color( $input['primary_color'] );
 	$input['secondary_color'] = sanitize_hex_color( $input['secondary_color'] );
 	$input['content_link_color'] = sanitize_hex_color( $input['content_link_color'] );

	// Favicon
 	$input['favicon'] = absint( $input['favicon'] );

	// Font type
 	if ( ! isset( $input['font_type'] ) ) $input['font_type'] = null;
 	if ( ! array_key_exists( $input['font_type'], $font_type_options ) ) $input['font_type'] = null;

	// Headline font type
 	if ( ! isset( $input['headline_font_type'] ) ) $input['headline_font_type'] = null;
 	if ( ! array_key_exists( $input['headline_font_type'], $headline_font_type_options ) ) $input['headline_font_type'] = null;

	// Quicktags
	if ( ! isset( $input['use_quicktags'] ) ) $input['use_quicktags'] = null;
  $input['use_quicktags'] = ( $input['use_quicktags'] == 1 ? 1 : 0 );

	// Sidebar
 	if ( ! isset( $input['sidebar'] ) ) $input['sidebar'] = null;
 	if ( ! array_key_exists( $input['sidebar'], $sidebar_options ) ) $input['sidebar'] = null;

	// Loading screen
 	if ( ! isset( $input['use_load_icon'] ) ) $input['use_load_icon'] = null;
  $input['use_load_icon'] = ( $input['use_load_icon'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['load_icon'] ) ) $input['load_icon'] = null;
 	if ( ! array_key_exists( $input['load_icon'], $load_icon_options ) ) $input['load_icon'] = null;
	if ( ! isset( $input['load_first'] ) ) $input['load_first'] = null;
	 $input['load_first'] = ( $input['load_first'] == 1 ? 1 : 0 );


	// Hover effect
	$hover_type_flag = false;
 	if ( ! isset( $input['hover_type'] ) ) $input['hover_type'] = null;
	foreach ( $hover_type_options as $hover_type_option ) {
		if ( $input['hover_type'] === $hover_type_option['value'] ) {
			$hover_type_flag = true;
		}
	}
	if ( ! $hover_type_flag ) $input['hover_type'] = false;
 	$input['hover1_zoom'] = sanitize_text_field( $input['hover1_zoom'] );
 	if ( ! isset( $input['hover2_direct'] ) ) $input['hover2_direct'] = null;
 	if ( ! array_key_exists( $input['hover2_direct'], $hover2_direct_options ) ) $input['hover2_direct'] = null;
 	$input['hover2_opacity'] = sanitize_text_field( $input['hover2_opacity'] );
 	$input['hover3_opacity'] = sanitize_text_field( $input['hover3_opacity'] );
 	$input['hover3_bgcolor'] = sanitize_hex_color( $input['hover3_bgcolor'] );

	// Share buttons
	//foreach ( array( 'top', 'btm' ) as $pos ) {
 	//	if ( ! isset( $input['sns_type_' . $pos] ) ) $input['sns_type_' . $pos] = null;
 	//	if ( ! array_key_exists( $input['sns_type_' . $pos], $sns_type_top_options ) ) $input['sns_type_' . $pos] = null;
 	//	if ( ! isset( $input['show_twitter_' . $pos] ) ) $input['show_twitter_' . $pos] = null;
  //	$input['show_twitter_' . $pos] = ( $input['show_twitter_' . $pos] == 1 ? 1 : 0 );
 	//	if ( ! isset( $input['show_fblike_' . $pos] ) ) $input['show_fblike_' . $pos] = null;
  //	$input['show_fblike_' . $pos] = ( $input['show_fblike_' . $pos] == 1 ? 1 : 0 );
 	//	if ( ! isset( $input['show_fbshare_' . $pos] ) ) $input['show_fbshare_' . $pos] = null;
  //	$input['show_fbshare_' . $pos] = ( $input['show_fbshare_' . $pos] == 1 ? 1 : 0 );
 	//	if ( ! isset( $input['show_google_' . $pos] ) ) $input['show_google_' . $pos] = null;
  //	$input['show_google_' . $pos] = ( $input['show_google_' . $pos] == 1 ? 1 : 0 );
 	//	if ( ! isset( $input['show_hatena_' . $pos] ) ) $input['show_hatena_' . $pos] = null;
  //	$input['show_hatena_' . $pos] = ( $input['show_hatena_' . $pos] == 1 ? 1 : 0 );
 	//	if ( ! isset( $input['show_pocket_' . $pos] ) ) $input['show_pocket_' . $pos] = null;
  //	$input['show_pocket_' . $pos] = ( $input['show_pocket_' . $pos] == 1 ? 1 : 0 );
	//	if ( ! isset( $input['show_feedly_' . $pos] ) ) $input['show_feedly_' . $pos] = null;
  //	$input['show_feedly_' . $pos] = ( $input['show_feedly_' . $pos] == 1 ? 1 : 0 );
 	//	if ( ! isset( $input['show_rss_' . $pos] ) ) $input['show_rss_' . $pos] = null;
  //	$input['show_rss_' . $pos] = ( $input['show_rss_' . $pos] == 1 ? 1 : 0 );
 	//	if ( ! isset( $input['show_pinterest_' . $pos] ) ) $input['show_pinterest_' . $pos] = null;
  //	$input['show_pinterest_' . $pos] = ( $input['show_pinterest_' . $pos] == 1 ? 1 : 0 );
	//}
 	if ( ! isset( $input['sns_type_btm'] ) ) $input['sns_type_btm'] = null;
 	if ( ! array_key_exists( $input['sns_type_btm'], $sns_type_top_options ) ) $input['sns_type_btm'] = null;
 	if ( ! isset( $input['show_twitter_btm'] ) ) $input['show_twitter_btm'] = null;
  $input['show_twitter_btm'] = ( $input['show_twitter_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_fblike_btm'] ) ) $input['show_fblike_btm'] = null;
  $input['show_fblike_btm'] = ( $input['show_fblike_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_fbshare_btm'] ) ) $input['show_fbshare_btm'] = null;
  $input['show_fbshare_btm'] = ( $input['show_fbshare_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_hatena_btm'] ) ) $input['show_hatena_btm'] = null;
  $input['show_hatena_btm'] = ( $input['show_hatena_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_pocket_btm'] ) ) $input['show_pocket_btm'] = null;
  $input['show_pocket_btm'] = ( $input['show_pocket_btm'] == 1 ? 1 : 0 );
	if ( ! isset( $input['show_feedly_btm'] ) ) $input['show_feedly_btm'] = null;
  $input['show_feedly_btm'] = ( $input['show_feedly_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_rss_btm'] ) ) $input['show_rss_btm'] = null;
  $input['show_rss_btm'] = ( $input['show_rss_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_pinterest_btm'] ) ) $input['show_pinterest_btm'] = null;
  $input['show_pinterest_btm'] = ( $input['show_pinterest_btm'] == 1 ? 1 : 0 );
 	$input['twitter_info'] = sanitize_text_field( $input['twitter_info'] );

  // Google Maps
 	$input['gmap_api_key'] = sanitize_text_field( $input['gmap_api_key'] );
 	if ( ! isset( $input['gmap_marker_type'] ) ) $input['gmap_marker_type'] = null;
 	if ( ! array_key_exists( $input['gmap_marker_type'], $gmap_marker_type_options ) ) $input['gmap_marker_type'] = null;
 	if ( ! isset( $input['gmap_custom_marker_type'] ) ) $input['gmap_custom_marker_type'] = null;
 	if ( ! array_key_exists( $input['gmap_custom_marker_type'], $gmap_custom_marker_type_options ) ) $input['gmap_custom_marker_type'] = null;
 	$input['gmap_marker_text'] = sanitize_text_field( $input['gmap_marker_text'] );
 	$input['gmap_marker_color'] = sanitize_hex_color( $input['gmap_marker_color'] );
 	$input['gmap_marker_img'] = absint( $input['gmap_marker_img'] );

	// Custom CSS
 	$input['css_code'] = $input['css_code'];

	// Custom head/script
  $input['custom_head'] = $input['custom_head'];

	return $input;
}
