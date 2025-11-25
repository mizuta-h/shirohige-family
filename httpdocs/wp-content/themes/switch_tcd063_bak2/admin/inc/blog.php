<?php

/*
 * Manage blog tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );

//  Add label of blog tab
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );

// Add HTML of blog tab
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );

global $ph_desc_writing_mode_options;
$ph_desc_writing_mode_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Horizontal writing', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Vertical writing', 'tcd-w' ) )
);

global $ph_img_animation_type_options;
$ph_img_animation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Zoom in', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Zoom out', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'None', 'tcd-w' ) )
);

global $pagenation_type_options;
$pagenation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Page numbers', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Read more button', 'tcd-w' ) )
);

global $month_type_options;
$month_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'English', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Japanese', 'tcd-w' ) )
);

function add_blog_dp_default_options( $dp_default_options ) {

  // Page header
  $dp_default_options['ph_title'] = 'BLOG';
  $dp_default_options['ph_desc'] = __( 'Enter description here.' . "\n" . 'Enter description here.', 'tcd-w' );
  $dp_default_options['ph_desc_font_size'] = 40;
  $dp_default_options['ph_desc_font_size_sp'] = 18;
  $dp_default_options['ph_desc_color'] = '#ffffff';
  $dp_default_options['ph_desc_writing_mode'] = 'type1';
  $dp_default_options['ph_img'] = '';
  $dp_default_options['ph_img_animation_type'] = 'type3';
  $dp_default_options['ph_overlay'] = '#000000';
  $dp_default_options['ph_overlay_opacity'] = 0.3;

  // Archive page
	$dp_default_options['archive_catch'] = '';

  // Single page
	$dp_default_options['title_font_size'] = 32;
	$dp_default_options['title_font_size_sp'] = 20;
	$dp_default_options['content_font_size'] = 16;
	$dp_default_options['content_font_size_sp'] = 14;
	$dp_default_options['pagenation_type'] = 'type1';

	// Display
	$dp_default_options['show_date'] = 1;
	$dp_default_options['show_category'] = 1;
	$dp_default_options['show_author'] = 1;
	$dp_default_options['show_sns_btm'] = 1;
  $dp_default_options['single_blog_show_copy_btm'] = '';
	$dp_default_options['show_next_post'] = 1;
	$dp_default_options['show_related_post'] = 1;
	$dp_default_options['show_comment'] = 1;
	$dp_default_options['show_trackback'] = 1;
	$dp_default_options['month_type'] = 'type1';

  // Single page banner
  for ( $i = 3; $i <= 6; $i++ ) {
	  $dp_default_options['single_ad_code' . $i] = '';
	  $dp_default_options['single_ad_image' . $i] = false;
	  $dp_default_options['single_ad_url' . $i] = '';
  }

  // Single page banner (mobile)
	$dp_default_options['single_mobile_ad_code1'] = '';
	$dp_default_options['single_mobile_ad_image1'] = false;
	$dp_default_options['single_mobile_ad_url1'] = '';

	return $dp_default_options;

}

function add_blog_tab_label( $tab_labels ) {
	$tab_labels['blog'] = __( 'Blog', 'tcd-w' );
	return $tab_labels;
}

function add_blog_tab_panel( $options ) {

	global $dp_default_options, $ph_desc_writing_mode_options, $ph_img_animation_type_options, $month_type_options, $pagenation_type_options;
?>
<div id="tab-content-blog" class="tab-content">

	<?php // Page header ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Page header', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

    <p style="text-align:center;"><img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/page_header.png" alt=""></p>

    <h4 class="theme_option_headline2"><?php _e( 'Title of #1', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
     <p><?php _e( 'Set the title to bottom of page header.', 'tcd-w' ); ?></p>
    </div>
    <input type="text" class="full_width" name="dp_options[ph_title]" value="<?php echo esc_attr( $options['ph_title'] ); ?>">

    <h4 class="theme_option_headline2"><?php _e( 'Description of #2', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
     <p><?php _e( 'Please set the description displayed in the center of the page header. Set the description, font color, font size, writing direction.', 'tcd-w' ); ?></p>
    </div>
    <textarea class="full_width" name="dp_options[ph_desc]"><?php echo esc_textarea( $options['ph_desc'] ); ?></textarea>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[ph_desc_color]" value="<?php echo esc_attr( $options['ph_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['ph_desc_color'] ); ?>"></li>
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'ph_desc_font_size'); ?></li>
     <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><?php echo tcd_basic_radio_button($options, 'ph_desc_writing_mode', $ph_desc_writing_mode_options); ?></li>
    </ul>

    <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
    <ul class="option_list">
     <li class="cf">
      <span class="label">
       <?php _e('Background image', 'tcd-w'); ?>
       <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '600'); ?></span>
      </span>
  	<div class="image_box cf">
  		<div class="cf cf_media_field hide-if-no-js ph_img">
  			<input type="hidden" value="<?php echo esc_attr( $options['ph_img'] ); ?>" id="ph_img" name="dp_options[ph_img]" class="cf_media_id">
  			<div class="preview_field"><?php if ( $options['ph_img'] ) { echo wp_get_attachment_image( $options['ph_img'], 'medium' ); } ?></div>
  			<div class="button_area">
  				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['ph_img'] ) { echo 'hidden'; } ?>">
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
       <?php foreach ( $ph_img_animation_type_options as $option ) : ?>
       <li><label><input type="radio" name="dp_options[ph_img_animation_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['ph_img_animation_type'] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></li>
       <?php endforeach; ?>
      </ul>
     </li>
     <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[ph_overlay]" data-default-color="<?php echo esc_attr( $dp_default_options['ph_overlay'] ); ?>" value="<?php echo esc_attr( $options['ph_overlay'] ); ?>"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input style="width:70px;" type="number" min="0" max="1.0" step="0.1" name="dp_options[ph_overlay_opacity]" value="<?php echo esc_attr( $options['ph_overlay_opacity'] ); ?>">
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

  	<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
     <p><?php _e( 'The catchphrase is displayed after the page header.', 'tcd-w' ); ?></p>
    </div>
    <input class="full_width" type="text" name="dp_options[archive_catch]" value="<?php echo esc_attr( $options['archive_catch'] ); ?>">

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


  <?php // Single page ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Blog page', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Font size', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Post title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Post content', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'content_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Pagenation', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'By inserting the tag <! - nextpage -> in the article body, you can split an article into multiple pages. You can select pagenation, \"Pager\" or \"Read more button\".', 'tcd-w' ); ?></p>
     </div>
    <fieldset class="cf radio_images">
      <?php foreach ( $pagenation_type_options as $option ) : ?>
      <label>
        <input type="radio" name="dp_options[pagenation_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['pagenation_type'] ); ?>>
        <?php echo esc_html_e( $option['label'] ); ?>
        <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/page_link_<?php echo esc_attr( $option['value'] ); ?>.jpg" alt="">
      </label>
      <?php endforeach; ?>
    </fieldset>

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

     <div class="theme_option_message2">
      <p><?php _e( 'Please check items to display.', 'tcd-w' ); ?></p>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Archive page and blog page', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[show_date]" type="checkbox" value="1" <?php checked( '1', $options['show_date'] ); ?>></li>
     </ul>
     
     <h4 class="theme_option_headline2"><?php _e( 'Archive page', 'tcd-w' ); ?></h4>
     <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[show_category]" type="checkbox" value="1" <?php checked( '1', $options['show_category'] ); ?>></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Blog page', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[show_author]" type="checkbox" value="1" <?php checked( '1', $options['show_author'] ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display share buttons after the article', 'tcd-w'); ?></span><input name="dp_options[show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_btm'] ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under post content', 'tcd-w'); ?></span><input name="dp_options[single_blog_show_copy_btm]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_copy_btm'] ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display next previous post link', 'tcd-w'); ?></span><input name="dp_options[show_next_post]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post'] ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display related post', 'tcd-w'); ?></span><input name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( '1', $options['show_related_post'] ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display comment', 'tcd-w'); ?></span><input name="dp_options[show_comment]" type="checkbox" value="1" <?php checked( '1', $options['show_comment'] ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display trackbacks', 'tcd-w'); ?></span><input name="dp_options[show_trackback]" type="checkbox" value="1" <?php checked( '1', $options['show_trackback'] ); ?>></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'How to display months', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please select which language to use to display months.', 'tcd-w' ); ?></p>
     </div>
     <ul class="cf horizontal">
      <?php foreach ( $month_type_options as $option ) : ?>
      <li><label><input type="radio" name="dp_options[month_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['month_type'] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></li>
      <?php endforeach; ?>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


  <?php // 広告の登録1 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Blog page banner', 'tcd-w');  ?></h3>
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
      <textarea class="full_width" rows="10" name="dp_options[single_ad_code3]"><?php echo esc_textarea( $options['single_ad_code3'] ); ?></textarea>

      <div class="theme_option_message">
       <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
      </div>

  				<h4 class="theme_option_headline2"><?php _e( 'Banner image', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
          </div>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image3">
  						<input type="hidden" value="<?php echo esc_attr( $options['single_ad_image3'] ); ?>" id="single_ad_image3" name="dp_options[single_ad_image3]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['single_ad_image3'] ) { echo wp_get_attachment_image( $options['single_ad_image3'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['single_ad_image3'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>

  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="full_width" type="text" name="dp_options[single_ad_url3]" value="<?php echo esc_attr( $options['single_ad_url3'] ); ?>">

     </div><!-- END .sub_box_tab_content -->

     <?php // 右 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
      </div>
      <textarea class="full_width" rows="10" name="dp_options[single_ad_code4]"><?php echo esc_textarea( $options['single_ad_code4'] ); ?></textarea>

      <div class="theme_option_message">
       <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
      </div>

  				<h4 class="theme_option_headline2"><?php _e( 'Banner image', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
          </div>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image4">
  						<input type="hidden" value="<?php echo esc_attr( $options['single_ad_image4'] ); ?>" id="single_ad_image4" name="dp_options[single_ad_image4]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['single_ad_image4'] ) { echo wp_get_attachment_image($options['single_ad_image4'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['single_ad_image4'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>

  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' );  ?></h4>
  				<input class="full_width" type="text" name="dp_options[single_ad_url4]" value="<?php echo esc_attr( $options['single_ad_url4'] ); ?>">

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


  <?php // 広告の登録2 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Blog page banner', 'tcd-w');  ?>2</h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e( 'Please copy and paste the short code inside the content to show this banner.', 'tcd-w' ); ?></p>
      <p><?php _e( 'Short code', 'tcd-w' );  ?> : <input type="text" readonly="readonly" value="[s_ad]"></p>
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
      <textarea class="full_width" rows="10" name="dp_options[single_ad_code5]"><?php echo esc_textarea( $options['single_ad_code5'] ); ?></textarea>

      <div class="theme_option_message">
       <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
      </div>

  				<h4 class="theme_option_headline2"><?php _e( 'Banner image', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
          </div>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image5">
  						<input type="hidden" value="<?php echo esc_attr( $options['single_ad_image5'] ); ?>" id="single_ad_image5" name="dp_options[single_ad_image5]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['single_ad_image5'] ) { echo wp_get_attachment_image( $options['single_ad_image5'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['single_ad_image5'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>

  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="full_width" type="text" name="dp_options[single_ad_url5]" value="<?php echo esc_attr( $options['single_ad_url5'] ); ?>">

     </div><!-- END .sub_box_tab_content -->

     <?php // 右 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
      </div>
      <textarea class="full_width" rows="10" name="dp_options[single_ad_code6]"><?php echo esc_textarea( $options['single_ad_code6'] ); ?></textarea>

      <div class="theme_option_message">
       <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
      </div>

  				<h4 class="theme_option_headline2"><?php _e( 'Banner image', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
          </div>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image6">
  						<input type="hidden" value="<?php echo esc_attr( $options['single_ad_image6'] ); ?>" id="single_ad_image6" name="dp_options[single_ad_image6]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['single_ad_image6'] ) { echo wp_get_attachment_image( $options['single_ad_image6'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if( ! $options['single_ad_image6'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>

  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="full_width" type="text" name="dp_options[single_ad_url6]" value="<?php echo esc_attr( $options['single_ad_url6'] ); ?>">

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


 	<?php // Single page banner ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Blog page banner (mobile)', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'This banner will be displayed on mobile device.', 'tcd-w' ); ?></p>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
     </div>
     <textarea class="full_width" rows="10" name="dp_options[single_mobile_ad_code1]"><?php echo esc_textarea( $options['single_mobile_ad_code1'] ); ?></textarea>

     <div class="theme_option_message">
      <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
     </div>

 	  	<h4 class="theme_option_headline2"><?php _e( 'Banner image', 'tcd-w' ); ?></h4>
 	  	<div class="image_box cf">
 	    	<div class="cf cf_media_field hide-if-no-js single_mobile_ad_image1">
 	      	<input type="hidden" value="<?php echo esc_attr( $options['single_mobile_ad_image1'] ); ?>" id="single_mobile_ad_image" name="dp_options[single_mobile_ad_image1]" class="cf_media_id">
 	      	<div class="preview_field"><?php if($options['single_mobile_ad_image1']){ echo wp_get_attachment_image($options['single_mobile_ad_image1'], 'medium' ); }; ?></div>
 	      	<div class="buttton_area">
 	       		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
 	       		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if(!$options['single_mobile_ad_image1']){ echo 'hidden'; }; ?>">
 	     		</div>
 	    	</div>
			</div>

 	    <h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
 	    <input class="full_width" type="text" name="dp_options[single_mobile_ad_url1]" value="<?php echo esc_attr( $options['single_mobile_ad_url1'] ); ?>">

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END #tab-content4 -->
<?php
}

function add_blog_theme_options_validate( $input ) {

  global $ph_desc_writing_mode_options, $ph_img_animation_type_options, $pagenation_type_options, $month_type_options;

  // Page header
 	$input['ph_title'] = sanitize_text_field( $input['ph_title'] );
 	$input['ph_desc'] = sanitize_textarea_field( $input['ph_desc'] );
 	$input['ph_desc_font_size'] = absint( $input['ph_desc_font_size'] );
 	$input['ph_desc_font_size_sp'] = absint( $input['ph_desc_font_size_sp'] );
 	$input['ph_desc_color'] = sanitize_hex_color( $input['ph_desc_color'] );
  if ( ! isset( $input['ph_desc_writing_mode'] ) ) $input['ph_desc_writing_mode'] = null;
  if ( ! array_key_exists( $input['ph_desc_writing_mode'], $ph_desc_writing_mode_options ) ) $input['ph_desc_writing_mode'] = null;
 	$input['ph_img'] = absint( $input['ph_img'] );
  if ( ! isset( $input['ph_img_animation_type'] ) ) $input['ph_img_animation_type'] = null;
  if ( ! array_key_exists( $input['ph_img_animation_type'], $ph_img_animation_type_options ) ) $input['ph_img_animation_type'] = null;
 	$input['ph_overlay'] = sanitize_hex_color( $input['ph_overlay'] );
 	$input['ph_overlay_opacity'] = sanitize_text_field( $input['ph_overlay_opacity'] );

  // Archive page
  $input['archive_catch'] = sanitize_text_field( $input['archive_catch'] );

  // Single page
 	$input['title_font_size'] = absint( $input['title_font_size'] );
 	$input['title_font_size_sp'] = absint( $input['title_font_size_sp'] );
 	$input['content_font_size'] = absint( $input['content_font_size'] );
 	$input['content_font_size_sp'] = absint( $input['content_font_size_sp'] );
  if ( ! isset( $input['pagenation_type'] ) ) $input['pagenation_type'] = null;
  if ( ! array_key_exists( $input['pagenation_type'], $pagenation_type_options ) ) $input['pagenation_type'] = null;

 	// Display
 	if ( ! isset( $input['show_date'] ) ) $input['show_date'] = null;
  $input['show_date'] = ( $input['show_date'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_category'] ) ) $input['show_category'] = null;
  $input['show_category'] = ( $input['show_category'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_author'] ) ) $input['show_author'] = null;
  $input['show_author'] = ( $input['show_author'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_sns_btm'] ) ) $input['show_sns_btm'] = null;
  $input['show_sns_btm'] = ( $input['show_sns_btm'] == 1 ? 1 : 0 );
  if ( ! isset( $input['single_blog_show_copy_btm'] ) ) $input['single_blog_show_copy_btm'] = null;
  $input['single_blog_show_copy_btm'] = ( $input['single_blog_show_copy_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_next_post'] ) ) $input['show_next_post'] = null;
  $input['show_next_post'] = ( $input['show_next_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_related_post'] ) ) $input['show_related_post'] = null;
  $input['show_related_post'] = ( $input['show_related_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_comment'] ) ) $input['show_comment'] = null;
  $input['show_comment'] = ( $input['show_comment'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_trackback'] ) ) $input['show_trackback'] = null;
  $input['show_trackback'] = ( $input['show_trackback'] == 1 ? 1 : 0 );
  if ( ! isset( $input['month_type'] ) ) $input['month_type'] = null;
  if ( ! array_key_exists( $input['month_type'], $month_type_options ) ) $input['month_type'] = null;

  // Single page banner
	//for ( $i = 1; $i <= 6; $i++ ) {
	for ( $i = 3; $i <= 6; $i++ ) {
 		$input['single_ad_code' . $i] = $input['single_ad_code' . $i];
 		$input['single_ad_image' . $i] = absint( $input['single_ad_image' . $i] );
 		$input['single_ad_url' . $i] = esc_url_raw( $input['single_ad_url' . $i] );
	}

  // Single page banner (mobile)
	$input['single_mobile_ad_code1'] = $input['single_mobile_ad_code1'];
 	$input['single_mobile_ad_image1'] = absint( $input['single_mobile_ad_image1'] );
 	$input['single_mobile_ad_url1'] = esc_url_raw( $input['single_mobile_ad_url1'] );

	return $input;
}
