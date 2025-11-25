<?php
/*
 * Manage news tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );

//  Add label of news tab
add_action( 'tcd_tab_labels', 'add_news_tab_label' );

// Add HTML of news tab
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );

global $news_ph_desc_writing_mode_options;
$news_ph_desc_writing_mode_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Horizontal writing', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Vertical writing', 'tcd-w' ) )
);

global $news_ph_img_animation_type_options;
$news_ph_img_animation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Zoom in', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Zoom out', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'None', 'tcd-w' ) )
);

function add_news_dp_default_options( $dp_default_options ) {

  // News page
  $dp_default_options['news_breadcrumb'] = __( 'News', 'tcd-w' );
  $dp_default_options['news_slug'] = 'news';

  // Page header
  $dp_default_options['news_ph_title'] = 'NEWS';
  $dp_default_options['news_ph_desc'] = __( 'Enter description here.' . "\n" . 'Enter description here.', 'tcd-w' );
  $dp_default_options['news_ph_desc_font_size'] = 40;
  $dp_default_options['news_ph_desc_font_size_sp'] = 18;
  $dp_default_options['news_ph_desc_color'] = '#ffffff';
  $dp_default_options['news_ph_desc_writing_mode'] = 'type1';
  $dp_default_options['news_ph_img'] = '';
  $dp_default_options['news_ph_img_animation_type'] = 'type3';
  $dp_default_options['news_ph_overlay'] = '#000000';
  $dp_default_options['news_ph_overlay_opacity'] = 0.3;

  // Archive page
	$dp_default_options['news_post_num'] = 7;

  // Single page
	$dp_default_options['news_title_font_size'] = 32;
	$dp_default_options['news_title_font_size_sp'] = 20;
	$dp_default_options['news_content_font_size'] = 16;
	$dp_default_options['news_content_font_size_sp'] = 14;

	// Display
	$dp_default_options['news_show_date'] = 1;
	$dp_default_options['news_show_thumbnail'] = 1;
	//$dp_default_options['news_show_sns_top'] = 1;
	$dp_default_options['news_show_sns_btm'] = 1;
	$dp_default_options['news_show_next_post'] = 1;
	$dp_default_options['news_show_latest_post'] = 1;

  // Single page banner
  //for ( $i = 1; $i <= 6; $i++ ) {
  for ( $i = 3; $i <= 6; $i++ ) {
	  $dp_default_options['news_ad_code' . $i] = '';
	  $dp_default_options['news_ad_image' . $i] = false;
	  $dp_default_options['news_ad_url' . $i] = '';
  }

  // Single page banner (mobile)
	$dp_default_options['news_mobile_ad_code1'] = '';
	$dp_default_options['news_mobile_ad_image1'] = false;
	$dp_default_options['news_mobile_ad_url1'] = '';

	return $dp_default_options;
}

function add_news_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['news_breadcrumb'] ? esc_html( $options['news_breadcrumb'] ) : __( 'News', 'tcd-w' );
  $tab_labels['news'] = $tab_label;
	return $tab_labels;
}

function add_news_tab_panel( $options ) {

	global $dp_default_options, $news_ph_desc_writing_mode_options, $news_ph_img_animation_type_options;

  $news_label = $options['news_breadcrumb'] ? esc_html( $options['news_breadcrumb'] ) : __( 'News', 'tcd-w' );

?>
<div id="tab-content-news" class="tab-content">

  <?php // News page ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic settings', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Breadcrumb', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "News" is displayed instead.', 'tcd-w' ); ?></p>
     </div>
     <p><input type="text" name="dp_options[news_breadcrumb]" value="<?php echo esc_attr( $options['news_breadcrumb'] ); ?>"></p>

     <h4 class="theme_option_headline2"><?php _e( 'Slug', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "news" is used instead.', 'tcd-w' ); ?></p>
      <p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
      <p><?php _e( 'Note: after changing the slug, you need to go to "<a href="./options-permalink.php">Permalink Settings</a>" and click "Save Changes".', 'tcd-w' ); ?></p>
     </div>
     <p><input type="text" name="dp_options[news_slug]" value="<?php echo esc_attr( $options['news_slug'] ); ?>"></p>

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
     <input type="text" class="full_width" name="dp_options[news_ph_title]" value="<?php echo esc_attr( $options['news_ph_title'] ); ?>">

     <h4 class="theme_option_headline2"><?php _e( 'Description of #2', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please set the description displayed in the center of the page header. Set the description, font color, font size, writing direction.', 'tcd-w' ); ?></p>
     </div>
     <textarea class="full_width" name="dp_options[news_ph_desc]"><?php echo esc_textarea( $options['news_ph_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[news_ph_desc_color]" value="<?php echo esc_attr( $options['news_ph_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ph_desc_color'] ); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'news_ph_desc_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><?php echo tcd_basic_radio_button($options, 'news_ph_desc_writing_mode', $news_ph_desc_writing_mode_options); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Background image', 'tcd-w'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '600'); ?></span>
       </span>
  	<div class="image_box cf">
  		<div class="cf cf_media_field hide-if-no-js news_ph_img">
  			<input type="hidden" value="<?php echo esc_attr( $options['news_ph_img'] ); ?>" id="news_ph_img" name="dp_options[news_ph_img]" class="cf_media_id">
  			<div class="preview_field"><?php if ( $options['news_ph_img'] ) { echo wp_get_attachment_image( $options['news_ph_img'], 'medium' ); } ?></div>
  			<div class="button_area">
  				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ph_img'] ) { echo 'hidden'; } ?>">
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
        <?php foreach ( $news_ph_img_animation_type_options as $option ) : ?>
        <li><label><input type="radio" name="dp_options[news_ph_img_animation_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['news_ph_img_animation_type'] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></li>
        <?php endforeach; ?>
       </ul>
      </li>
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[news_ph_overlay]" data-default-color="<?php echo esc_attr( $dp_default_options['news_ph_overlay'] ); ?>" value="<?php echo esc_attr( $options['news_ph_overlay'] ); ?>"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input style="width:70px;" type="number" min="0" max="1.0" step="0.1" name="dp_options[news_ph_overlay_opacity]" value="<?php echo esc_attr( $options['news_ph_overlay_opacity'] ); ?>">
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
     <input style="width:80px;" type="number" min="1" step="1" name="dp_options[news_post_num]" value="<?php echo esc_attr( $options['news_post_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // Single page ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-w'), $news_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Font size', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Post title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'news_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Post content', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'news_content_font_size'); ?></li>
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

     <h4 class="theme_option_headline2"><?php printf(__('Archive page and %s page', 'tcd-w'), $news_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[news_show_date]" type="checkbox" value="1" <?php checked( '1', $options['news_show_date'] ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display thumbnail', 'tcd-w'); ?></span><input name="dp_options[news_show_thumbnail]" type="checkbox" value="1" <?php checked( '1', $options['news_show_thumbnail'] ); ?>></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s page', 'tcd-w'), $news_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display share buttons after the article', 'tcd-w'); ?></span><input name="dp_options[news_show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['news_show_sns_btm'] ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display next previous post link', 'tcd-w'); ?></span><input name="dp_options[news_show_next_post]" type="checkbox" value="1" <?php checked( '1', $options['news_show_next_post'] ); ?>></li>
      <li class="cf"><span class="label"><?php printf(__('Display latest %s', 'tcd-w'), $news_label); ?></span><input name="dp_options[news_show_latest_post]" type="checkbox" value="1" <?php checked( '1', $options['news_show_latest_post'] ); ?>></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

  <?php // 広告の登録1 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page banner', 'tcd-w'), $news_label); ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e( 'This banner will be displayed after contents.', 'tcd-w' ); ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Left banner', 'tcd-w'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Right banner', 'tcd-w'); ?></div>
     </div>

     <?php // 左 -------------------------------- ?>
     <div class="sub_box_tab_content active" data-tab-content="tab1">

      <h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
      </div>
      <textarea class="full_width" rows="10" name="dp_options[news_ad_code3]"><?php echo esc_textarea( $options['news_ad_code3'] ); ?></textarea>

      <div class="theme_option_message">
       <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e( 'Banner image', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
      </div>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image3">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image3'] ); ?>" id="news_ad_image3" name="dp_options[news_ad_image3]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image3'] ) { echo wp_get_attachment_image( $options['news_ad_image3'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ad_image3'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>

      <h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
      <input class="full_width" type="text" name="dp_options[news_ad_url3]" value="<?php echo esc_attr( $options['news_ad_url3'] ); ?>">

     </div><!-- END .sub_box_tab_content -->

     <?php // 右 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
      </div>
      <textarea class="full_width" rows="10" name="dp_options[news_ad_code4]"><?php echo esc_textarea( $options['news_ad_code4'] ); ?></textarea>

      <div class="theme_option_message">
       <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e( 'Banner image', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
      </div>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image4">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image4'] ); ?>" id="news_ad_image4" name="dp_options[news_ad_image4]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image4'] ) { echo wp_get_attachment_image($options['news_ad_image4'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ad_image4'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>

      <h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' );  ?></h4>
      <input class="full_width" type="text" name="dp_options[news_ad_url4]" value="<?php echo esc_attr( $options['news_ad_url4'] ); ?>">

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


  <?php // 広告の登録2 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page banner', 'tcd-w'), $news_label); ?>2</h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e( 'Please copy and paste the short code inside the content to show this banner.', 'tcd-w' ); ?></p>
      <p><?php _e( 'Short code', 'tcd-w' );  ?> : <input type="text" readonly="readonly" value="[n_ad]"></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Left banner', 'tcd-w'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Right banner', 'tcd-w'); ?></div>
     </div>

     <?php // 左 -------------------------------- ?>
     <div class="sub_box_tab_content active" data-tab-content="tab1">

      <h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
      </div>
      <textarea class="full_width" rows="10" name="dp_options[news_ad_code5]"><?php echo esc_textarea( $options['news_ad_code5'] ); ?></textarea>

      <div class="theme_option_message">
       <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e( 'Banner image', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
      </div>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image5">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image5'] ); ?>" id="news_ad_image5" name="dp_options[news_ad_image5]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image5'] ) { echo wp_get_attachment_image( $options['news_ad_image5'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ad_image5'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>


      <h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
      <input class="full_width" type="text" name="dp_options[news_ad_url5]" value="<?php echo esc_attr( $options['news_ad_url5'] ); ?>">

     </div><!-- END .sub_box_tab_content -->

     <?php // 右 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
      </div>
      <textarea class="full_width" rows="10" name="dp_options[news_ad_code6]"><?php echo esc_textarea( $options['news_ad_code6'] ); ?></textarea>

      <div class="theme_option_message">
       <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e( 'Banner image', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
      </div>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image6">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image6'] ); ?>" id="news_ad_image6" name="dp_options[news_ad_image6]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image6'] ) { echo wp_get_attachment_image( $options['news_ad_image6'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if( ! $options['news_ad_image6'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>

      <h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
      <input class="full_width" type="text" name="dp_options[news_ad_url6]" value="<?php echo esc_attr( $options['news_ad_url6'] ); ?>">

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


 	<?php // Single page banner ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page banner (mobile)', 'tcd-w'), $news_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'This banner will be displayed on mobile device.', 'tcd-w' ); ?></p>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
     </div>
     <textarea class="full_width" rows="10" name="dp_options[news_mobile_ad_code1]"><?php echo esc_textarea( $options['news_mobile_ad_code1'] ); ?></textarea>

     <div class="theme_option_message">
      <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Banner image', 'tcd-w' ); ?></h4>
 	  	<div class="image_box cf">
 	    	<div class="cf cf_media_field hide-if-no-js news_mobile_ad_image1">
 	      	<input type="hidden" value="<?php echo esc_attr( $options['news_mobile_ad_image1'] ); ?>" id="news_mobile_ad_image" name="dp_options[news_mobile_ad_image1]" class="cf_media_id">
 	      	<div class="preview_field"><?php if($options['news_mobile_ad_image1']){ echo wp_get_attachment_image($options['news_mobile_ad_image1'], 'medium' ); }; ?></div>
 	      	<div class="buttton_area">
 	       		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
 	       		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if(!$options['news_mobile_ad_image1']){ echo 'hidden'; }; ?>">
 	     		</div>
 	    	</div>
			</div>

     <h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
     <input class="full_width" type="text" name="dp_options[news_mobile_ad_url1]" value="<?php echo esc_attr( $options['news_mobile_ad_url1'] ); ?>">

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END #tab-content4 -->
<?php
}

function add_news_theme_options_validate( $input ) {

  global $news_ph_desc_writing_mode_options, $news_ph_img_animation_type_options;

  // News page
 	$input['news_breadcrumb'] = sanitize_text_field( $input['news_breadcrumb'] );
 	$input['news_slug'] = sanitize_text_field( $input['news_slug'] );

  // Page header
 	$input['news_ph_title'] = sanitize_text_field( $input['news_ph_title'] );
 	$input['news_ph_desc'] = sanitize_textarea_field( $input['news_ph_desc'] );
 	$input['news_ph_desc_font_size'] = absint( $input['news_ph_desc_font_size'] );
 	$input['news_ph_desc_font_size_sp'] = absint( $input['news_ph_desc_font_size_sp'] );
 	$input['news_ph_desc_color'] = sanitize_hex_color( $input['news_ph_desc_color'] );
  if ( ! isset( $input['news_ph_desc_writing_mode'] ) ) $input['news_ph_desc_writing_mode'] = null;
  if ( ! array_key_exists( $input['news_ph_desc_writing_mode'], $news_ph_desc_writing_mode_options ) ) $input['news_ph_desc_writing_mode'] = null;
 	$input['news_ph_img'] = absint( $input['news_ph_img'] );
  if ( ! isset( $input['news_ph_img_animation_type'] ) ) $input['news_ph_img_animation_type'] = null;
  if ( ! array_key_exists( $input['news_ph_img_animation_type'], $news_ph_img_animation_type_options ) ) $input['news_ph_img_animation_type'] = null;
 	$input['news_ph_overlay'] = sanitize_hex_color( $input['news_ph_overlay'] );
 	$input['news_ph_overlay_opacity'] = sanitize_text_field( $input['news_ph_overlay_opacity'] );

  // Archive page
  $input['news_post_num'] = absint( $input['news_post_num'] );

  // Single page
 	$input['news_title_font_size'] = absint( $input['news_title_font_size'] );
 	$input['news_title_font_size_sp'] = absint( $input['news_title_font_size_sp'] );
 	$input['news_content_font_size'] = absint( $input['news_content_font_size'] );
 	$input['news_content_font_size_sp'] = absint( $input['news_content_font_size_sp'] );

 	// Display
 	if ( ! isset( $input['news_show_date'] ) ) $input['news_show_date'] = null;
  $input['news_show_date'] = ( $input['news_show_date'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_thumbnail'] ) ) $input['news_show_thumbnail'] = null;
  $input['news_show_thumbnail'] = ( $input['news_show_thumbnail'] == 1 ? 1 : 0 );
 	//if ( ! isset( $input['news_show_sns_top'] ) ) $input['news_show_sns_top'] = null;
  //$input['news_show_sns_top'] = ( $input['news_show_sns_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_sns_btm'] ) ) $input['news_show_sns_btm'] = null;
  $input['news_show_sns_btm'] = ( $input['news_show_sns_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_next_post'] ) ) $input['news_show_next_post'] = null;
  $input['news_show_next_post'] = ( $input['news_show_next_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_latest_post'] ) ) $input['news_show_latest_post'] = null;
  $input['news_show_latest_post'] = ( $input['news_show_latest_post'] == 1 ? 1 : 0 );

  // Single page banner
	//for ( $i = 1; $i <= 6; $i++ ) {
	for ( $i = 3; $i <= 6; $i++ ) {
 		$input['news_ad_code' . $i] = $input['news_ad_code' . $i];
 		$input['news_ad_image' . $i] = absint( $input['news_ad_image' . $i] );
 		$input['news_ad_url' . $i] = esc_url_raw( $input['news_ad_url' . $i] );
	}

  // Single page banner (mobile)
	$input['news_mobile_ad_code1'] = $input['news_mobile_ad_code1'];
 	$input['news_mobile_ad_image1'] = absint( $input['news_mobile_ad_image1'] );
 	$input['news_mobile_ad_url1'] = esc_url_raw( $input['news_mobile_ad_url1'] );

	return $input;
}
