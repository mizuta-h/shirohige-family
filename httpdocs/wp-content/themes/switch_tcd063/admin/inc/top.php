<?php
/*
 * Manage front page tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_top_dp_default_options' );

// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_top_tab_label' );

// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_top_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_top_theme_options_validate' );

global $header_content_type_options;
$header_content_type_options = array(
  'type2' => array( 'value' => 'type1', 'label' => __( 'Image slider', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type2', 'label' => __( 'Video', 'tcd-w' ) ),
  'type4' => array( 'value' => 'type3', 'label' => __( 'YouTube', 'tcd-w' ) )
);

global $header_slider_img_animation_type_options;
$header_slider_img_animation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Zoom in', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Zoom out', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'None', 'tcd-w' ) )
);

global $header_slider_animation_time_options;
$header_slider_animation_time_options = array();
for ( $i = 5; $i <= 10; $i++ ) {
  $header_slider_animation_time_options[$i] = array(
    'value' => $i,
    'label' => sprintf( __( '%d seconds', 'tcd-w' ), $i )
  );
}

global $writing_mode_options;
$writing_mode_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Vertical writing', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Horizontal writing', 'tcd-w' ) )
);

global $index_4_images_and_text_layout_options;
$index_4_images_and_text_layout_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Top: images, Bottom: text', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Top: text, Bottom: images', 'tcd-w' ) )
);

global $index_news_and_event_layout_options;
$index_news_and_event_layout_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Left: News, Right: Event', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Left: Event, Right: News', 'tcd-w' ) )
);

function add_top_dp_default_options( $dp_default_options ) {

  // Header contents
  $dp_default_options['header_content_type'] = 'type1';
  

  // Image slider
  for ( $i = 1; $i <= 5; $i++ ) {
    $dp_default_options['header_slider_img' . $i] = '';
    $dp_default_options['header_slider_img_sp' . $i] = '';
    $dp_default_options['header_slider_img_animation_type' . $i] = 'type3';
    $dp_default_options['header_slider_overlay' . $i] = '#000000';
    $dp_default_options['header_slider_overlay_opacity' . $i] = 0.3;
    $dp_default_options['header_slider_catch' . $i] = sprintf( __( 'Enter slider%d' . "\n" . 'catchphrase', 'tcd-w' ), $i );
    $dp_default_options['header_slider_catch_font_size' . $i] = 40;
    $dp_default_options['header_slider_catch_font_size_sp' . $i] = 20;
    $dp_default_options['header_slider_catch_color' . $i] = '#ffffff';
    $dp_default_options['header_slider_catch_writing_mode' . $i] = 'type2';
  }
  $dp_default_options['header_slider_animation_time'] = 7;

  // Video
  $dp_default_options['header_video'] = '';
  $dp_default_options['header_video_img'] = '';
  $dp_default_options['header_mobile_hide_setting_video'] = 0;
  $dp_default_options['header_video_catch'] = '';
  $dp_default_options['header_video_catch_font_size'] = 40;
  $dp_default_options['header_video_catch_font_size_sp'] = 20;
  $dp_default_options['header_video_catch_color'] = '#ffffff';
  $dp_default_options['header_video_catch_writing_mode'] = 'type1';
  $dp_default_options['header_video_overlay'] = '#000000';
  $dp_default_options['header_video_overlay_opacity'] = '0.3';

  // YouTube
  $dp_default_options['header_youtube_id'] = '';
  $dp_default_options['header_youtube_img'] = '';
  $dp_default_options['header_mobile_hide_setting_yutu'] = 0;
  $dp_default_options['header_youtube_catch'] = '';
  $dp_default_options['header_youtube_catch_font_size'] = 40;
  $dp_default_options['header_youtube_catch_font_size_sp'] = 20;
  $dp_default_options['header_youtube_catch_color'] = '#ffffff';
  $dp_default_options['header_youtube_catch_writing_mode'] = 'type1';
  $dp_default_options['header_youtube_overlay'] = '#000000';
  $dp_default_options['header_youtube_overlay_opacity'] = '0.3';

  // Contents after the header content
  $dp_default_options['display_index_content01'] = 1;
  $dp_default_options['index_content01_catch'] = __( 'Enter catchphrase here.', 'tcd-w' );
  $dp_default_options['index_content01_catch_font_size'] = 36;
  $dp_default_options['index_content01_catch_font_size_sp'] = 20;
  $dp_default_options['index_content01_desc'] = __( 'Enter description here. Enter description here. Enter description here.' . "\n" . 'Enter description here. Enter description here. Enter description here. Enter description here. Enter description here. ', 'tcd-w' );
  $dp_default_options['index_content01_color'] = '#ffffff';
  $dp_default_options['index_content01_bg'] = '#000000';
  $dp_default_options['index_content01_btn_bg'] = '#000000';
  $dp_default_options['index_content01_btn_bg_hover'] = '#442506';
  $dp_default_options['index_content01_btn_color'] = '#ffffff';
  $dp_default_options['index_content01_btn_color_hover'] = '#ffffff';

  // Contents builder
  $dp_default_options['index_contents_order'] = array(
    '4_images_and_text',
    'three_column',
    'news_and_event',
    'interview',
    'plan_content',
    'image',
    'blog',
    'catch_and_desc',
    'wysiwyg1',
    'wysiwyg2',
    'wysiwyg3'
  );

  // 4 images and text
  $dp_default_options['display_index_4_images_and_text'] = 1;
  $dp_default_options['index_4_images_and_text_layout'] = 'type1';
  $dp_default_options['index_4_images_and_text_bg'] = '#f5f5f5';
  for ( $i = 1; $i <= 4; $i++ ) {
    $dp_default_options['index_4_images_and_text_img' . $i] = '';
  }
  $dp_default_options['index_4_images_and_text_catch'] = __( 'Enter catchphrase here.', 'tcd-w' );
  $dp_default_options['index_4_images_and_text_catch_font_size'] = 36;
  $dp_default_options['index_4_images_and_text_catch_font_size_sp'] = 20;
  $dp_default_options['index_4_images_and_text_catch_color'] = '#442606';
  $dp_default_options['index_4_images_and_text_desc'] = __( 'Enter description here. Enter description here. Enter description here.' . "\n" . 'Enter description here. Enter description here. Enter description here. Enter description here. Enter description here.', 'tcd-w' );

  // Three column
  $dp_default_options['display_index_three_column'] = 1;
  $dp_default_options['index_three_column_bg'] = '#f5f5f5';

  for ( $i = 1; $i <= 3; $i++ ) {
    $dp_default_options['index_three_column_title' . $i] = sprintf( __( 'Column%d', 'tcd-w' ), $i );
    $dp_default_options['index_three_column_img' . $i] = '';
    $dp_default_options['index_three_column_desc' . $i] = __( 'Enter description here. Enter description here. Enter description here. ' . "\n" . 'Enter description here. Enter description here. Enter description here. Enter description here. Enter description here. ', 'tcd-w' );
    $dp_default_options['index_three_column_btn_label' . $i] = __( 'Sample button', 'tcd-w' );
    $dp_default_options['index_three_column_btn_url' . $i] = '#';
    $dp_default_options['index_three_column_btn_target' . $i] = 0;
  }

  // News and event
  $dp_default_options['display_index_news_and_event'] = 1;
  $dp_default_options['index_news_and_event_layout'] = 'type1';
  $dp_default_options['index_news_and_event_bg'] = '#f3f3f3';
  $dp_default_options['index_news_title'] = 'NEWS';
  $dp_default_options['index_news_title_font_size'] = 40;
  $dp_default_options['index_news_title_font_size_sp'] = 28;
  $dp_default_options['index_news_title_color'] = '#000000';
  $dp_default_options['index_news_sub'] = __( 'News', 'tcd-w' );
  $dp_default_options['index_news_num'] = 5;
  $dp_default_options['index_news_link_text'] = __( 'News archive', 'tcd-w' );
  $dp_default_options['index_news_link_color'] = '#000000';
  $dp_default_options['index_news_link_color_hover'] = '#442602';
  $dp_default_options['index_event_title'] = 'EVENT';
  $dp_default_options['index_event_title_font_size'] = 40;
  $dp_default_options['index_event_title_font_size_sp'] = 28;
  $dp_default_options['index_event_title_color'] = '#000000';
  $dp_default_options['index_event_sub'] = __( 'Event', 'tcd-w' );
  $dp_default_options['index_event_num'] = 3;
  $dp_default_options['index_event_link_text'] = __( 'Event archive', 'tcd-w' );
  $dp_default_options['index_event_link_color'] = '#000000';
  $dp_default_options['index_event_link_color_hover'] = '#442602';

  // Interview
  $dp_default_options['display_index_interview'] = 1;
  $dp_default_options['index_interview_title'] = 'Interview';
  $dp_default_options['index_interview_title_font_size'] = 40;
  $dp_default_options['index_interview_title_font_size_sp'] = 28;
  $dp_default_options['index_interview_title_color'] = '#000000';
  $dp_default_options['index_interview_sub'] = __( 'Interview', 'tcd-w' );
  $dp_default_options['index_interview_num'] = 8;
  $dp_default_options['index_interview_link_text'] = __( 'Interview archive', 'tcd-w' );

  // Plan contents
  $dp_default_options['display_index_plan_content'] = 1;
  $dp_default_options['index_plan_content_catch'] = __( 'Enter catchphrase here.', 'tcd-w' );
  $dp_default_options['index_plan_content_catch_font_size'] = 36;
  $dp_default_options['index_plan_content_catch_font_size_sp'] = 20;
  $dp_default_options['index_plan_content_catch_color'] = '#442506';
  $dp_default_options['index_plan_content_desc'] = __( 'Enter description here. Enter description here. Enter description here.' . "\n" . 'Enter description here. Enter description here. Enter description here. Enter description here. Enter description here.', 'tcd-w' );
  $dp_default_options['index_plan_content_post_id'] = 2;
  $dp_default_options['index_plan_content_link_text'] = __( 'Plans and Pricing', 'tcd-w' );

  // Full width image
  $dp_default_options['display_index_image'] = 1;
  $dp_default_options['index_image_image'] = '';
  $dp_default_options['index_image_catch'] = __( 'Enter catchphrase here.', 'tcd-w' );
  $dp_default_options['index_image_catch_font_size'] = 36;
  $dp_default_options['index_image_catch_font_size_sp'] = 20;
  $dp_default_options['index_image_desc'] = __( 'Enter description here. Enter description here. Enter description here.' . "\n" . 'Enter description here. Enter description here. Enter description here. Enter description here. Enter description here.', 'tcd-w' );
  $dp_default_options['index_image_btn_label'] = __( 'Sample button', 'tcd-w' );
  $dp_default_options['index_image_btn_url'] = '#';
  $dp_default_options['index_image_btn_target'] = 0;

  // Blog
  $dp_default_options['display_index_blog'] = 1;
  $dp_default_options['index_blog_title'] = 'BLOG';
  $dp_default_options['index_blog_title_font_size'] = 40;
  $dp_default_options['index_blog_title_font_size_sp'] = 28;
  $dp_default_options['index_blog_title_color'] = '#000000';
  $dp_default_options['index_blog_sub'] = __( 'Blog', 'tcd-w' );
  $dp_default_options['index_blog_num'] = 4;
  $dp_default_options['index_blog_link_text'] = __( 'Blog archive', 'tcd-w' );

  // Catchphrase & description
  $dp_default_options['display_index_catch_and_desc'] = 0;
  $dp_default_options['index_catch_and_desc_catch'] = '';
  $dp_default_options['index_catch_and_desc_catch_font_size'] = 36;
  $dp_default_options['index_catch_and_desc_catch_font_size_sp'] = 20;
  $dp_default_options['index_catch_and_desc_catch_color'] = '#442506';
  $dp_default_options['index_catch_and_desc_desc'] = '';

  // Wysiwyg
  for( $i = 1; $i <= 3; $i++ ) {
    $dp_default_options['display_index_wysiwyg' . $i] = 0;
    $dp_default_options['display_full_index_wysiwyg' . $i] = 0;
    $dp_default_options['index_wysiwyg_editor' . $i] = '';
  }

	return $dp_default_options;
}

function add_top_tab_label( $tab_labels ) {
	$tab_labels['top'] = __( 'Front page', 'tcd-w' );
	return $tab_labels;
}

function add_top_tab_panel( $options ) {
  global $dp_default_options, $header_content_type_options, $header_slider_img_animation_type_options, $header_slider_animation_time_options, $writing_mode_options, $index_4_images_and_text_layout_options, $index_news_and_event_layout_options;
?>
<div id="tab-content-top" class="tab-content">

	<?php // Header content ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header content', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'You can set header content as the first view of your site. ', 'tcd-w' ); ?></p>
      <?php echo __( '<p>Image slider:You can set 5 slides or 1 image as fixed header.</p><p>Video:You can display MP4 format videos.</p><p>Youtube:You can display Youtube videos.</p>', 'tcd-w' ); ?>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Header content type', 'tcd-w' ); ?></h4>
     <ul class="cf horizontal">
      <?php foreach ( $header_content_type_options as $option ) : ?>
      <li><label><input type="radio" name="dp_options[header_content_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['header_content_type'] ); ?>><?php echo esc_html_e( $option['label'] ); ?></label></l>
      <?php endforeach; ?>
     </ul>

     <?php // Image slider ?>
     <div id="header_content_type_type1"<?php if ( 'type1' !== $options['header_content_type'] ) { echo ' style="display: none;"'; } ?>>

      <h4 class="theme_option_headline2"><?php _e( 'Image slider', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'Please set slider item.', 'tcd-w' ); ?></p>
      </div>

		  <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-w' ); ?><?php echo $i; ?></h3>
      	<div class="sub_box_content">

      		<h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
          <ul class="option_list">
           <li class="cf">
            <span class="label">
             <?php _e('Background image', 'tcd-w'); ?>
             <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '815'); ?></span>
            </span>
      			<div class="image_box cf">
      				<div class="cf cf_media_field hide-if-no-js">
      					<input type="hidden" value="<?php echo esc_attr( $options['header_slider_img' . $i] ); ?>" id="header_slider_img<?php echo $i; ?>" name="dp_options[header_slider_img<?php echo $i; ?>]" class="cf_media_id">
      					<div class="preview_field"><?php if ( $options['header_slider_img' . $i] ) { echo wp_get_attachment_image( $options['header_slider_img' . $i], 'medium' ); } ?></div>
      					<div class="button_area">
      						<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      						<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['header_slider_img' . $i] ) { echo 'hidden'; } ?>">
      					</div>
      				</div>
      			</div>
           </li>
           <li class="cf">
            <span class="label">
             <?php _e('Background image (mobile)', 'tcd-w'); ?>
             <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '820', '787'); ?></span>
            </span>
      			<div class="image_box cf">
      				<div class="cf cf_media_field hide-if-no-js">
      					<input type="hidden" value="<?php echo esc_attr( $options['header_slider_img_sp' . $i] ); ?>" id="header_slider_img_sp<?php echo $i; ?>" name="dp_options[header_slider_img_sp<?php echo $i; ?>]" class="cf_media_id">
      					<div class="preview_field"><?php if ( $options['header_slider_img_sp' . $i] ) { echo wp_get_attachment_image( $options['header_slider_img_sp' . $i], 'medium' ); } ?></div>
      					<div class="button_area">
      						<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      						<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['header_slider_img_sp' . $i] ) { echo 'hidden'; } ?>">
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
             <?php foreach ( $header_slider_img_animation_type_options as $option ) : ?>
             <li><label><input type="radio" name="dp_options[header_slider_img_animation_type<?php echo $i; ?>]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['header_slider_img_animation_type' . $i] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></li>
             <?php endforeach; ?>
            </ul>
           </li>
           <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[header_slider_overlay<?php echo $i; ?>]" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_overlay' . $i] ); ?>" value="<?php echo esc_attr( $options['header_slider_overlay' . $i] ); ?>"></li>
           <li class="cf">
            <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input style="width:70px;" type="number" min="0" max="1.0" step="0.1" name="dp_options[header_slider_overlay_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_slider_overlay_opacity' . $i] ); ?>">
            <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
             <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?><br>
             <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-w');  ?></p>
            </div>
           </li>
          </ul>

      		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Please set the catchphrase displayed in the center of the header. Set the catchphrase, font color, font size, writing direction.', 'tcd-w' ); ?></p>
          </div>
          <textarea class="full_width" name="dp_options[header_slider_catch<?php echo $i; ?>]"><?php echo esc_textarea( $options['header_slider_catch' . $i] ); ?></textarea>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[header_slider_catch_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_slider_catch_color'.$i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_catch_color'.$i] ); ?>"></li>
           <li class="cf">
            <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
            <div class="font_size_option">
             <label class="font_size_label number_option">
              <input class="hankaku input_font_size" type="number" name="dp_options[header_slider_catch_font_size<?php echo $i; ?>]" min="9" max="100" value="<?php esc_attr_e( $options['header_slider_catch_font_size'.$i] ); ?>"><span class="icon icon_pc"></span>
             </label>
             <label class="font_size_label number_option">
              <input class="hankaku input_font_size_sp" type="number" name="dp_options[header_slider_catch_font_size_sp<?php echo $i; ?>]" min="9" max="100" value="<?php esc_attr_e( $options['header_slider_catch_font_size_sp'.$i] ); ?>"><span class="icon icon_sp"></span>
             </label>
            </div>
           </li>
           <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><?php echo tcd_basic_radio_button($options, 'header_slider_catch_writing_mode'.$i, $writing_mode_options); ?></li>
          </ul>

		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
		  <?php endfor; ?>

      <h4 class="theme_option_headline2"><?php _e( 'Image slider animation time', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'Please set transition speed. (5 to 10 seconds)', 'tcd-w' ); ?></p>
      </div>
      <select name="dp_options[header_slider_animation_time]">
       <?php foreach ( $header_slider_animation_time_options as $option ) : ?>
       <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['header_slider_animation_time'] ); ?>><?php echo esc_attr_e( $option['label'] ); ?></option>
       <?php endforeach; ?>
      </select>

     </div>

     <?php // Video ?>
     <div id="header_content_type_type2"<?php if ( 'type2' !== $options['header_content_type'] ) { echo ' style="display: none;"'; } ?>>

      <h3 class="theme_option_headline2"><?php _e( 'Video', 'tcd-w' ); ?></h3>
      <div class="theme_option_message2">
       <p><?php _e( 'Please upload MP4 format file.', 'tcd-w' ); ?></p>
       <p><?php _e( 'Register within 10 MB.', 'tcd-w' ); ?><br><?php _e( 'The screen ratio for video is assumed to be 16:9.', 'tcd-w' ); ?></p>
      </div>

      <div class="image_box cf">
		    <div class="cf cf_media_field hide-if-no-js header_video">
		    	<input type="hidden" value="<?php echo esc_attr( $options['header_video'] ); ?>" id="header_video" name="dp_options[header_video]" class="cf_media_id">
		    	<div class="preview_field preview_field_video">
		    		<?php if ( $options['header_video'] ) : ?>
		    		<h5><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h5>
        		<p><?php echo esc_html( wp_get_attachment_url( $options['header_video'] ) ); ?></p>
		    		<?php endif; ?>
        	</div>
        	<div class="button_area">
        		<input type="button" value="<?php _e( 'Select MP4 file', 'tcd-w' ); ?>" class="cfmf-select-video button">
        		<input type="button" value="<?php _e( 'Remove MP4 file', 'tcd-w' ); ?>" class="cfmf-delete-video button <?php if ( ! $options['header_video'] ) { echo 'hidden'; }; ?>">
        	</div>
        </div>
      </div>

      <h4 class="theme_option_headline2"><?php _e( 'Substitute image', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('If the mobile device is unable to play the video, or if "Show alternative image on smartphones" is checked, the following image will be displayed instead.', 'tcd-w');  ?></p>
       <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '815'); ?></p>
      </div>
      <div class="image_box cf">
      	<div class="cf cf_media_field hide-if-no-js">
      		<input type="hidden" value="<?php echo esc_attr( $options['header_video_img'] ); ?>" id="header_video_img" name="dp_options[header_video_img]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $options['header_video_img'] ) { echo wp_get_attachment_image( $options['header_video_img'], 'medium' ); } ?></div>
      		<div class="button_area">
      			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['header_video_img'] ) { echo 'hidden'; } ?>">
      		</div>
      	</div>
      </div>
      <div class="theme_option_message2">
      <p><?php _e( 'If you would like to display an alternate image without showing the video on a smartphone, check the "Show alternate image on smartphones" checkbox below.', 'tcd-w' ); ?></p>
     </div>
     <p><label><input type="checkbox" name="dp_options[header_mobile_hide_setting_video]" value="1"<?php checked( 1, $options['header_mobile_hide_setting_video'] ); ?>> <?php _e( 'Display alternate images on smartphones', 'tcd-w' ); ?></label></p>

      <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'Please set the catchphrase displayed in the center of the header. Set the catchphrase, font color, font size, writing direction.', 'tcd-w' ); ?></p>
      </div>
      <textarea class="full_width" name="dp_options[header_video_catch]"><?php echo esc_textarea( $options['header_video_catch'] ); ?></textarea>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[header_video_catch_color]" value="<?php echo esc_attr( $options['header_video_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_catch_color'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'header_video_catch_font_size'); ?></li>
       <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><?php echo tcd_basic_radio_button($options, 'header_video_catch_writing_mode', $writing_mode_options); ?></li>
      </ul>

  	  <h4 class="theme_option_headline2"><?php _e( 'Color overlay on the background', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'Use overlay, to become easy to read the catchphrase on the background. Please set color of overlay.', 'tcd-w' ); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[header_video_overlay]" value="<?php echo esc_attr( $options['header_video_overlay'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_overlay'] ); ?>"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[header_video_overlay_opacity]" value="<?php echo esc_attr( $options['header_video_overlay_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?><br>
         <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>

     </div>

     <?php // YouTube ?>
     <div id="header_content_type_type3"<?php if ( 'type3' !== $options['header_content_type'] ) { echo ' style="display: none;"'; } ?>>

  	  <h3 class="theme_option_headline2"><?php _e( 'YouTube', 'tcd-w' ); ?></h3>
      <div class="theme_option_message2">
       <p><?php _e( 'Please input a video ID of YouTube', 'tcd-w' ); ?></p>
      </div>
      <input class="full_width" type="text" name="dp_options[header_youtube_id]" value="<?php echo esc_attr( $options['header_youtube_id'] ); ?>">

      <h4 class="theme_option_headline2"><?php _e( 'Substitute image', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('If the mobile device is unable to play the video, or if "Do not display video in smartphone angle of view" is checked, the following image will be displayed instead.', 'tcd-w');  ?></p>
       <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '815'); ?></p>
      </div>
      <div class="image_box cf">
      	<div class="cf cf_media_field hide-if-no-js">
      		<input type="hidden" value="<?php echo esc_attr( $options['header_youtube_img'] ); ?>" id="header_youtube_img" name="dp_options[header_youtube_img]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $options['header_youtube_img'] ) { echo wp_get_attachment_image( $options['header_youtube_img'], 'medium' ); } ?></div>
      		<div class="button_area">
      			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['header_youtube_img'] ) { echo 'hidden'; } ?>">
      		</div>
      	</div>
      </div>
      <div class="theme_option_message2">
      <p><?php _e( 'If you would like to display an alternate image without showing the video on a smartphone, check the "Show alternate image on smartphones" checkbox below.', 'tcd-w' ); ?></p>
     </div>
     <p><label><input type="checkbox" name="dp_options[header_mobile_hide_setting_yutu]" value="1"<?php checked( 1, $options['header_mobile_hide_setting_yutu'] ); ?>> <?php _e( 'Display alternate images on smartphones', 'tcd-w' ); ?></label></p>

      <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'Please set the catchphrase displayed in the center of the header. Set the catchphrase, font color, font size, writing direction.', 'tcd-w' ); ?></p>
      </div>
      <textarea class="full_width" name="dp_options[header_youtube_catch]"><?php echo esc_textarea( $options['header_youtube_catch'] ); ?></textarea>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[header_youtube_catch_color]" value="<?php echo esc_attr( $options['header_youtube_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_catch_color'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'header_youtube_catch_font_size'); ?></li>
       <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><?php echo tcd_basic_radio_button($options, 'header_youtube_catch_writing_mode', $writing_mode_options); ?></li>
      </ul>

  	  <h4 class="theme_option_headline2"><?php _e( 'Color overlay on the background', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'Use overlay, to become easy to read the catchphrase on the background. Please set color of overlay.', 'tcd-w' ); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[header_youtube_overlay]" value="<?php echo esc_attr( $options['header_youtube_overlay'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_overlay'] ); ?>"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[header_youtube_overlay_opacity]" value="<?php echo esc_attr( $options['header_youtube_overlay_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?><br>
         <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>

     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // ヘッダーコンテンツ下の設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Contents after the header content', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
       <p><?php _e( 'You can set the catchphrase and description to be displayed below the header content.', 'tcd-w' ); ?></p>
      </div>

      <p><label><input type="checkbox" name="dp_options[display_index_content01]" value="1" <?php checked( 1, $options['display_index_content01'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>

      <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
      <textarea class="full_width" name="dp_options[index_content01_catch]"><?php echo esc_textarea( $options['index_content01_catch'] ); ?></textarea>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_content01_catch_font_size'); ?></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
      <textarea class="full_width" name="dp_options[index_content01_desc]"><?php echo esc_textarea( $options['index_content01_desc'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e( 'Color', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'Set font color and background color of catchphrase and description.', 'tcd-w' ); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_content01_color]" value="<?php echo esc_attr( $options['index_content01_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_color'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_content01_bg]" value="<?php echo esc_attr( $options['index_content01_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_bg'] ); ?>"></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'Set the color of the scroll down button to be displayed under the description.', 'tcd-w' ); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_content01_btn_color]" value="<?php echo esc_attr( $options['index_content01_btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_btn_color'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_content01_btn_bg]" value="<?php echo esc_attr( $options['index_content01_btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_btn_bg'] ); ?>"></li>
       <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color on hover', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_content01_btn_color_hover]" value="<?php echo esc_attr( $options['index_content01_btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_btn_color_hover'] ); ?>"></li>
       <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color on hover', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_content01_btn_bg_hover]" value="<?php echo esc_attr( $options['index_content01_btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_btn_bg_hover'] ); ?>"></li>
      </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


	<?php // メインコンテンツ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Main content', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
       <p><?php _e( 'You can change order by dragging each headline of option field.', 'tcd-w' ); ?></p>
      </div>

    <div class="sortable">
      <?php
      foreach ( $options['index_contents_order'] as $order ) :
      ?>
      <?php
           // 4 image and text --------------------------------------------------------------------------
        if ( '4_images_and_text' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( '4 images and text', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">

          <div class="theme_option_message2" style="margin-top:20px;">
           <p><?php _e( 'Displays the contents of 4 square images + text.', 'tcd-w' ); ?></p>
          </div>

          <input type="hidden" name="dp_options[index_contents_order][]" value="4_images_and_text">

          <p><label><input type="checkbox" name="dp_options[display_index_4_images_and_text]" value="1" <?php checked( 1, $options['display_index_4_images_and_text'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>

          <h4 class="theme_option_headline2"><?php _e( 'Layout', 'tcd-w' ); ?></h4>
          <fieldset class="cf radio_images_2col">
            <?php foreach ( $index_4_images_and_text_layout_options as $option ) : ?>
            <label>
              <input type="radio" name="dp_options[index_4_images_and_text_layout]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['index_4_images_and_text_layout'] ); ?>>
              <?php echo esc_html( $option['label'] ); ?>
              <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/top_4image_text_<?php echo esc_attr( $option['value'] ); ?>.png" alt="">
            </label>
            <?php endforeach; ?>
          </fieldset>

      		<h4 class="theme_option_headline2"><?php _e( 'Background', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
            <p><?php _e( 'Set the background color of the text area.', 'tcd-w' ); ?></p>
          </div>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_4_images_and_text_bg]" value="<?php echo esc_attr( $options['index_4_images_and_text_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_4_images_and_text_bg'] ); ?>"></li>
          </ul>

      		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
            <p><?php _e( 'Set the catchphrase, font size, font color.', 'tcd-w' ); ?></p>
          </div>
          <input type="text" name="dp_options[index_4_images_and_text_catch]" value="<?php echo esc_attr( $options['index_4_images_and_text_catch'] ); ?>" class="full_width">
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_4_images_and_text_catch_font_size'); ?></li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_4_images_and_text_catch_color]" value="<?php echo esc_attr( $options['index_4_images_and_text_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_4_images_and_text_catch_color'] ); ?>"></li>
          </ul>

      		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set descriptive text to be displayed under the catchphrase.', 'tcd-w' ); ?></p>
          </div>
          <textarea name="dp_options[index_4_images_and_text_desc]" class="full_width"><?php echo esc_textarea( $options['index_4_images_and_text_desc'] ); ?></textarea>

      		<h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
          <ul class="option_list">
           <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
           <li class="cf">
            <span class="label">
             <?php _e( 'Image', 'tcd-w' ); ?><?php echo $i; ?>
             <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '570', '570'); ?></span>
            </span>
        	<div class="image_box cf">
            <div class="cf cf_media_field hide-if-no-js index_4_images_and_text_img<?php echo $i ?>">
        			<input type="hidden" value="<?php echo esc_attr( $options['index_4_images_and_text_img' . $i] ); ?>" id="index_4_images_and_text_img<?php echo $i ?>" name="dp_options[index_4_images_and_text_img<?php echo $i ?>]" class="cf_media_id">
        			<div class="preview_field"><?php if ( $options['index_4_images_and_text_img' . $i] ) { echo wp_get_attachment_image( $options['index_4_images_and_text_img' . $i], 'medium' ); } ?></div>
        			<div class="button_area">
        				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['index_4_images_and_text_img' . $i] ) { echo 'hidden'; } ?>">
        			</div>
        		</div>
        	</div>
           </li>
           <?php endfor; ?>
          </ul>

		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
           // 3 column -------------------------------------------------------------------------
        elseif ( 'three_column' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( '3-column contents', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">

          <div class="theme_option_message2" style="margin-top:20px;">
           <p><?php _e( 'Display three content boxes horizontally.', 'tcd-w' ); ?></p>
          </div>
          <input type="hidden" name="dp_options[index_contents_order][]" value="three_column">
          <p><label><input type="checkbox" name="dp_options[display_index_three_column]" value="1" <?php checked( 1, $options['display_index_three_column'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>

      		<h4 class="theme_option_headline2"><?php _e( 'Background', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the background color of the text area.', 'tcd-w' ); ?></p>
          </div>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_three_column_bg]" value="<?php echo esc_attr( $options['index_three_column_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_three_column_bg'] ); ?>"></li>
          </ul>

          <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
		      <div class="sub_box cf">
            <h3 class="theme_option_subbox_headline"><?php _e( 'Column', 'tcd-w' ); ?><?php echo $i; ?></h3>
            <div class="sub_box_content">

      		    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
               <p><?php _e( 'Settings for heading at left top of image.', 'tcd-w' ); ?></p>
              </div>
              <input type="text" name="dp_options[index_three_column_title<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_three_column_title' . $i] ); ?>" class="full_width">

      		    <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
                <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '740', '520'); ?></p>
              </div>
        	    <div class="image_box cf">
                <div class="cf cf_media_field hide-if-no-js index_three_column_img<?php echo $i ?>">
        	    		<input type="hidden" value="<?php echo esc_attr( $options['index_three_column_img' . $i] ); ?>" id="index_three_column_img<?php echo $i ?>" name="dp_options[index_three_column_img<?php echo $i ?>]" class="cf_media_id">
        	    		<div class="preview_field"><?php if ( $options['index_three_column_img' . $i] ) { echo wp_get_attachment_image( $options['index_three_column_img' . $i], 'medium' ); } ?></div>
        	    		<div class="button_area">
        	    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        	    			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['index_three_column_img' . $i] ) { echo 'hidden'; } ?>">
        	    		</div>
        	    	</div>
        	    </div>

      		    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
                <p><?php _e( 'Set the description to be displayed below the image.', 'tcd-w' ); ?></p>
              </div>
              <textarea name="dp_options[index_three_column_desc<?php echo $i; ?>]" class="full_width"><?php echo esc_textarea( $options['index_three_column_desc' . $i] ); ?></textarea>

      		    <h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
                <p><?php _e( 'Set the button to be displayed at the bottom.', 'tcd-w' ); ?></p>
              </div>
              <ul class="option_list">
               <li class="cf"><span class="label"><?php _e('Label', 'tcd-w'); ?></span><input type="text" class="full_width" name="dp_options[index_three_column_btn_label<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_three_column_btn_label' . $i] ); ?>"></li>
               <li class="cf button_option">
                <span class="label"><?php _e('URL', 'tcd-serum'); ?></span>
                <div class="admin_link_option">
                 <input type="text" name="dp_options[index_three_column_btn_url<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_three_column_btn_url' . $i] ); ?>" placeholder="https://example.com/">
                 <input id="index_three_column_btn_target<?php echo $i; ?>" class="admin_link_option_target" type="checkbox" name="dp_options[index_three_column_btn_target<?php echo $i; ?>]" value="1" <?php checked( 1, $options['index_three_column_btn_target' . $i] ); ?>>
                 <label for="index_three_column_btn_target<?php echo $i; ?>">&#xe92a;</label>
                </div>
               </li>
              </ul>

		  		    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
            </div>
          </div>
          <?php endfor; ?>

		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
           //  news and event ---------------------------------------------------------
        elseif ( 'news_and_event' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'News and event', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">

          <div class="theme_option_message2" style="margin-top:20px;">
           <p><?php _e( 'Displays the post list of post type "news" and post type "event".', 'tcd-w' ); ?></p>
          </div>
          <input type="hidden" name="dp_options[index_contents_order][]" value="news_and_event">

          <p><label><input type="checkbox" name="dp_options[display_index_news_and_event]" value="1" <?php checked( 1, $options['display_index_news_and_event'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>

      		<h4 class="theme_option_headline2"><?php _e( 'Background', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
            <p><?php _e( 'Set the background color of the contents.', 'tcd-w' ); ?></p>
          </div>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_news_and_event_bg]" value="<?php echo esc_attr( $options['index_news_and_event_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_and_event_bg'] ); ?>"></li>
          </ul>

      		<h4 class="theme_option_headline2"><?php _e( 'Layout', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
            <p><?php _e( 'Set the display position of the news post list and the event post list.', 'tcd-w' ); ?></p>
          </div>
          <?php foreach ( $index_news_and_event_layout_options as $option ) : ?>
          <p><label><input type="radio" name="dp_options[index_news_and_event_layout]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['index_news_and_event_layout'] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></p>
          <?php endforeach; ?>

		      <div class="sub_box cf" style="margin-top:30px;">
          	<h3 class="theme_option_subbox_headline"><?php _e( 'News', 'tcd-w' ); ?></h3>
            <div class="sub_box_content">

      		    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
               <p><?php _e( 'Set the heading.', 'tcd-w' ); ?></p>
              </div>
              <input type="text" name="dp_options[index_news_title]" value="<?php echo esc_attr( $options['index_news_title'] ); ?>" class="full_width">
              <ul class="option_list">
               <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_news_title_font_size'); ?></li>
               <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_news_title_color]" value="<?php echo esc_attr( $options['index_news_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_title_color'] ); ?>"></li>
              </ul>

      		    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
               <p><?php _e( 'Set the subtitle.', 'tcd-w' ); ?></p>
              </div>
              <input type="text" name="dp_options[index_news_sub]" value="<?php echo esc_attr( $options['index_news_sub'] ); ?>" class="full_width">

      		    <h4 class="theme_option_headline2"><?php _e( 'Display number', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
               <p><?php _e( 'Set the number of displayed posts.', 'tcd-w' ); ?></p>
              </div>
              <input style="width:80px;" type="number" min="1" step="1" name="dp_options[index_news_num]" value="<?php echo esc_attr( $options['index_news_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>

      		    <h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
               <p><?php _e( 'You can set the button to archive page displayed at bottom of the post list. If you set blank, link is not displayed.', 'tcd-w' ); ?></p>
              </div>
              <ul class="option_list">
               <li class="cf"><span class="label"><?php _e('Link text', 'tcd-w'); ?></span><input type="text" class="full_width" name="dp_options[index_news_link_text]" value="<?php echo esc_attr( $options['index_news_link_text'] ); ?>"></li>
               <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[index_news_link_color]" value="<?php echo esc_attr( $options['index_news_link_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_link_color'] ); ?>"></li>
               <li class="cf"><span class="label"><?php _e('Font color on hover', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[index_news_link_color_hover]" value="<?php echo esc_attr( $options['index_news_link_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_link_color_hover'] ); ?>"></li>
              </ul>

		  		    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
            </div>
          </div>

		      <div class="sub_box cf">
          	<h3 class="theme_option_subbox_headline"><?php _e( 'Event', 'tcd-w' ); ?></h3>
            <div class="sub_box_content">

      		    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
               <p><?php _e( 'Set the heading.', 'tcd-w' ); ?></p>
              </div>
              <input type="text" name="dp_options[index_event_title]" value="<?php echo esc_attr( $options['index_event_title'] ); ?>" class="full_width">
              <ul class="option_list">
               <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_event_title_font_size'); ?></li>
               <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_event_title_color]" value="<?php echo esc_attr( $options['index_event_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_event_title_color'] ); ?>"></li>
              </ul>

      		    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
               <p><?php _e( 'Set the subtitle.', 'tcd-w' ); ?></p>
              </div>
              <input type="text" name="dp_options[index_event_sub]" value="<?php echo esc_attr( $options['index_event_sub'] ); ?>" class="full_width">

      		    <h4 class="theme_option_headline2"><?php _e( 'Display number', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
               <p><?php _e( 'Set the number of displayed posts.', 'tcd-w' ); ?></p>
              </div>
              <input style="width:80px;" type="number" min="1" step="1" name="dp_options[index_event_num]" value="<?php echo esc_attr( $options['index_event_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>

      		    <h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
              <div class="theme_option_message2">
               <p><?php _e( 'You can set the button to archive page displayed at bottom of the post list. If you set blank, link is not displayed.', 'tcd-w' ); ?></p>
              </div>
              <ul class="option_list">
               <li class="cf"><span class="label"><?php _e('Link text', 'tcd-w'); ?></span><input type="text" class="full_width" name="dp_options[index_event_link_text]" value="<?php echo esc_attr( $options['index_event_link_text'] ); ?>"></li>
               <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[index_event_link_color]" value="<?php echo esc_attr( $options['index_event_link_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_event_link_color'] ); ?>"></li>
               <li class="cf"><span class="label"><?php _e('Font color on hover', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[index_event_link_color_hover]" value="<?php echo esc_attr( $options['index_event_link_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_event_link_color_hover'] ); ?>"></li>
              </ul>

		  		    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
            </div>
          </div>

		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
           // interview ---------------------------------------------------------------------------
        elseif ( 'interview' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Interview', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">

          <div class="theme_option_message2" style="margin-top:20px;">
           <p><?php _e( 'Displays the post list of post type "interview".', 'tcd-w' ); ?></p>
          </div>
          <input type="hidden" name="dp_options[index_contents_order][]" value="interview">
          <p><label><input type="checkbox" name="dp_options[display_index_interview]" value="1" <?php checked( 1, $options['display_index_interview'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>

      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the heading.', 'tcd-w' ); ?></p>
          </div>
          <input type="text" name="dp_options[index_interview_title]" value="<?php echo esc_attr( $options['index_interview_title'] ); ?>" class="full_width">
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_interview_title_font_size'); ?></li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_interview_title_color]" value="<?php echo esc_attr( $options['index_interview_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_interview_title_color'] ); ?>"></li>
          </ul>

      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the subtitle.', 'tcd-w' ); ?></p>
          </div>
          <input type="text" name="dp_options[index_interview_sub]" value="<?php echo esc_attr( $options['index_interview_sub'] ); ?>" class="full_width">

      		<h4 class="theme_option_headline2"><?php _e( 'Display number', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the number of displayed posts.', 'tcd-w' ); ?></p>
          </div>
          <input style="width:80px;" type="number" min="1" step="1" name="dp_options[index_interview_num]" value="<?php echo esc_attr( $options['index_interview_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>

      		<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'You can set the button to archive page displayed at right end of the heading. If you set blank, button is not displayed.', 'tcd-w' ); ?></p>
          </div>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Link text', 'tcd-w'); ?></span><input type="text" class="full_width" name="dp_options[index_interview_link_text]" value="<?php echo esc_attr( $options['index_interview_link_text'] ); ?>"></li>
          </ul>

		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
           // plan conten -------------------------------------------------------------------
        elseif ( 'plan_content' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Plan contents', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">

          <div class="theme_option_message2" style="margin-top:20px;">
           <p><?php _e( 'Display the plan table created with page template 3. Create a new fixed page before selecting the following settings, select template 3 and set "D plan table"', 'tcd-w' ); ?></p>
          </div>
          <input type="hidden" name="dp_options[index_contents_order][]" value="plan_content">
          <p><label><input type="checkbox" name="dp_options[display_index_plan_content]" value="1" <?php checked( 1, $options['display_index_plan_content'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>

      		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the catchphrase, font size, font color.', 'tcd-w' ); ?></p>
          </div>
          <input type="text" name="dp_options[index_plan_content_catch]" value="<?php echo esc_attr( $options['index_plan_content_catch'] ); ?>" class="full_width">
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_plan_content_catch_font_size'); ?></li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_plan_content_catch_color]" value="<?php echo esc_attr( $options['index_plan_content_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_plan_content_catch_color'] ); ?>"></li>
          </ul>

      		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the description to be displayed below the catchphrase.', 'tcd-w' ); ?></p>
          </div>
          <textarea name="dp_options[index_plan_content_desc]" class="full_width"><?php echo esc_textarea( $options['index_plan_content_desc'] ); ?></textarea>

      		<h4 class="theme_option_headline2"><?php _e( 'Post ID', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Please input a post ID of a page. The plan table for the page is displayed.', 'tcd-w' ); ?></p>
          </div>
          <input style="width:80px;" type="number" min="1" step="1" name="dp_options[index_plan_content_post_id]" value="<?php echo esc_attr( $options['index_plan_content_post_id'] ); ?>">

          <h4 class="theme_option_headline2"><?php _e( 'Link to selected page', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the link button to the fixed page specified in "Post ID" setting. The button is displayed at the bottom of the content. If you set blank, button is not displayed.', 'tcd-w' ); ?></p>
          </div>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Link text', 'tcd-w'); ?></span><input type="text" class="full_width" name="dp_options[index_plan_content_link_text]" value="<?php echo esc_attr( $options['index_plan_content_link_text'] ); ?>"></li>
          </ul>

		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
           // image -------------------------------------------------------
        elseif ( 'image' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Full width image', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">

          <div class="theme_option_message2" style="margin-top:20px;">
           <p><?php _e( 'Display text + button on the full width image.', 'tcd-w' ); ?></p>
          </div>
          <input type="hidden" name="dp_options[index_contents_order][]" value="image">
          <p><label><input type="checkbox" name="dp_options[display_index_image]" value="1" <?php checked( 1, $options['display_index_image'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>

      		<h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Recommended image size. Width: 1450px, Height: 500px', 'tcd-w' ); ?></p>
          </div>
        	<div class="image_box cf">
        		<div class="cf cf_media_field hide-if-no-js index_image_image">
        			<input type="hidden" value="<?php echo esc_attr( $options['index_image_image'] ); ?>" id="index_image_image" name="dp_options[index_image_image]" class="cf_media_id">
        			<div class="preview_field"><?php if ( $options['index_image_image'] ) { echo wp_get_attachment_image( $options['index_image_image'], 'medium' ); } ?></div>
        			<div class="button_area">
        				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['index_image_image'] ) { echo 'hidden'; } ?>">
        			</div>
        		</div>
        	</div>

      		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the catchphrase, font size, font color.', 'tcd-w' ); ?></p>
          </div>
          <input type="text" name="dp_options[index_image_catch]" value="<?php echo esc_attr( $options['index_image_catch'] ); ?>" class="full_width">
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_image_catch_font_size'); ?></li>
          </ul>

      		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the description to be displayed below the catchphrase.', 'tcd-w' ); ?></p>
          </div>
          <textarea class="full_width" name="dp_options[index_image_desc]"><?php echo esc_textarea( $options['index_image_desc'] ); ?></textarea>

      		<h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the button to be displayed at the bottom.', 'tcd-w' ); ?></p>
          </div>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Label', 'tcd-w'); ?></span><input type="text" class="full_width" name="dp_options[index_image_btn_label]" value="<?php echo esc_attr( $options['index_image_btn_label'] ); ?>"></li>
           <li class="cf button_option">
            <span class="label"><?php _e('URL', 'tcd-serum'); ?></span>
            <div class="admin_link_option">
             <input type="text" name="dp_options[index_image_btn_url]" value="<?php echo esc_attr( $options['index_image_btn_url'] ); ?>" placeholder="https://example.com/">
             <input id="index_image_btn_target" class="admin_link_option_target" type="checkbox" name="dp_options[index_image_btn_target]" value="1" <?php checked( 1, $options['index_image_btn_target'] ); ?>>
             <label for="index_image_btn_target">&#xe92a;</label>
            </div>
           </li>
          </ul>

		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
           // blog -----------------------------------------------------------------
        elseif ( 'blog' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Blog', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">

          <div class="theme_option_message2" style="margin-top:20px;">
           <p><?php _e( 'Displays the blog post.', 'tcd-w' ); ?></p>
          </div>
          <input type="hidden" name="dp_options[index_contents_order][]" value="blog">
          <p><label><input type="checkbox" name="dp_options[display_index_blog]" value="1" <?php checked( 1, $options['display_index_blog'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>

      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the heading.', 'tcd-w' ); ?></p>
          </div>
          <input type="text" name="dp_options[index_blog_title]" value="<?php echo esc_attr( $options['index_blog_title'] ); ?>" class="full_width">
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_blog_title_font_size'); ?></li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[index_blog_title_color]" value="<?php echo esc_attr( $options['index_blog_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $options['index_blog_title_color'] ); ?>"></li>
          </ul>

      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the subtitle.', 'tcd-w' ); ?></p>
          </div>
          <input type="text" name="dp_options[index_blog_sub]" value="<?php echo esc_attr( $options['index_blog_sub'] ); ?>" class="full_width">

      		<h4 class="theme_option_headline2"><?php _e( 'Display number', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the number of displayed posts.', 'tcd-w' ); ?></p>
          </div>
          <input style="width:80px;" type="number" min="1" step="1" name="dp_options[index_blog_num]" value="<?php echo esc_attr( $options['index_blog_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>

      		<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'You can set the button to archive page displayed at right end of the heading. If you set blank, button is not displayed.', 'tcd-w' ); ?></p>
          </div>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Link text', 'tcd-w'); ?></span><input type="text" class="full_width" name="dp_options[index_blog_link_text]" value="<?php echo esc_attr( $options['index_blog_link_text'] ); ?>"></li>
          </ul>

		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
           // catch and desc ----------------------------------------------
      elseif ( 'catch_and_desc' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Catchphrase and description', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">

          <div class="theme_option_message2" style="margin-top:20px;">
           <p><?php _e( 'Display a catchphrase and description.', 'tcd-w' ); ?></p>
          </div>
          <input type="hidden" name="dp_options[index_contents_order][]" value="catch_and_desc">
          <p><label><input type="checkbox" name="dp_options[display_index_catch_and_desc]" value="1" <?php checked( 1, $options['display_index_catch_and_desc'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>

      		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the catchphrase, font size, font color.', 'tcd-w' ); ?></p>
          </div>
          <textarea name="dp_options[index_catch_and_desc_catch]" class="full_width"><?php echo esc_textarea( $options['index_catch_and_desc_catch'] ); ?></textarea>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_catch_and_desc_catch_font_size'); ?></li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[index_catch_and_desc_catch_color]" value="<?php echo esc_attr( $options['index_catch_and_desc_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $options['index_catch_and_desc_catch_color'] ); ?>"></li>
          </ul>

      		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
           <p><?php _e( 'Set the description to be displayed below the catchphrase.', 'tcd-w' ); ?></p>
          </div>
          <textarea name="dp_options[index_catch_and_desc_desc]" class="full_width"><?php echo esc_textarea( $options['index_catch_and_desc_desc'] ); ?></textarea>

		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
           // free space -----------------------------------------
      elseif ( 'wysiwyg1' === $order || 'wysiwyg2' === $order || 'wysiwyg3' === $order ) :
        $key = mb_substr( $order, -1 );
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Wysiwyg contents', 'tcd-w' ); ?><?php echo esc_html( $key ); ?></h3>
      	<div class="sub_box_content">

          <div class="theme_option_message2" style="margin-top:20px;">
           <p><?php _e( 'Please create content freely as you like blog posts.', 'tcd-w' ); ?></p>
          </div>
          <input type="hidden" name="dp_options[index_contents_order][]" value="wysiwyg<?php echo esc_attr( $key ); ?>">
          <p><label><input type="checkbox" name="dp_options[display_index_wysiwyg<?php echo esc_attr( $key ); ?>]" value="1" <?php checked( 1, $options['display_index_wysiwyg' . $key] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>
          <p style="margin-bottom:35px;"><label><input type="checkbox" name="dp_options[display_full_index_wysiwyg<?php echo esc_attr( $key ); ?>]" value="1" <?php checked( 1, $options['display_full_index_wysiwyg' . $key] ); ?>> <?php _e( 'Display this content full width', 'tcd-w' ); ?></label></p>
			    <?php
          wp_editor(
            $options['index_wysiwyg_editor' . $key],
            'index_wysiwyg_editor' . $key,
            array(
              'textarea_name' => 'dp_options[index_wysiwyg_editor' . $key . ']',
              'textarea_rows' => 10
            )
          );
          ?>

		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php endif; endforeach; ?>

    </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END #tab-content3 -->
<?php
}

function add_top_theme_options_validate( $input ) {

  global $dp_default_options, $header_content_type_options, $header_slider_animation_options, $header_slider_animation_time_options, $header_slider_img_animation_type_options, $writing_mode_options, $index_4_images_and_text_layout_options, $index_news_and_event_layout_options;

  // Image slider
  for ( $i = 1; $i <= 5; $i++ ) {
	  $input['header_slider_img' . $i] = absint( $input['header_slider_img' . $i] );
	  $input['header_slider_img_sp' . $i] = absint( $input['header_slider_img_sp' . $i] );
    if ( ! isset( $input['header_slider_img_animation_type' . $i] ) ) $input['header_slider_img_animation_type' . $i] = null;
    if ( ! array_key_exists( $input['header_slider_img_animation_type' . $i], $header_slider_img_animation_type_options ) ) $input['header_slider_img_animation_type' . $i] = null;
    $input['header_slider_overlay' . $i] = sanitize_hex_color( $input['header_slider_overlay' . $i] );
    $input['header_slider_overlay_opacity' . $i] = sanitize_text_field( $input['header_slider_overlay_opacity' . $i] );
	  $input['header_slider_catch' . $i] = sanitize_textarea_field( $input['header_slider_catch' . $i] );
	  $input['header_slider_catch_font_size' . $i] = absint( $input['header_slider_catch_font_size' . $i] );
	  $input['header_slider_catch_font_size_sp' . $i] = absint( $input['header_slider_catch_font_size_sp' . $i] );
	  $input['header_slider_catch_color' . $i] = sanitize_hex_color( $input['header_slider_catch_color' . $i] );
    if ( ! isset( $input['header_slider_catch_writing_mode' . $i] ) ) $input['header_slider_catch_writing_mode' . $i] = null;
    if ( ! array_key_exists( $input['header_slider_catch_writing_mode' . $i], $writing_mode_options ) ) $input['header_slider_catch_writing_mode' . $i] = null;
  }
  if ( ! isset( $input['header_slider_animation_time'] ) ) $input['header_slider_animation_time'] = null;
  if ( ! array_key_exists( $input['header_slider_animation_time'], $header_slider_animation_time_options ) ) $input['header_slider_animation_time'] = null;

  // Video
	$input['header_video'] = absint( $input['header_video'] );
	$input['header_video_img'] = absint( $input['header_video_img'] );
  if ( ! isset( $input['header_mobile_hide_setting_video'] ) ) $input['header_mobile_hide_setting_video'] = null;
  $input['header_mobile_hide_setting_video'] = ( $input['header_mobile_hide_setting_video'] == 1 ? 1 : 0 );
	$input['header_video_catch'] = sanitize_textarea_field( $input['header_video_catch'] );
	$input['header_video_catch_font_size'] = absint( $input['header_video_catch_font_size'] );
	$input['header_video_catch_font_size_sp'] = absint( $input['header_video_catch_font_size_sp'] );
	$input['header_video_catch_color'] = sanitize_hex_color( $input['header_video_catch_color'] );
  if ( ! isset( $input['header_video_catch_writing_mode'] ) ) $input['header_video_catch_writing_mode'] = null;
  if ( ! array_key_exists( $input['header_video_catch_writing_mode'], $writing_mode_options ) ) $input['header_video_catch_writing_mode'] = null;
  $input['header_video_overlay'] = sanitize_hex_color( $input['header_video_overlay'] );
  $input['header_video_overlay_opacity'] = sanitize_text_field( $input['header_video_overlay_opacity'] );

  // YouTube
	$input['header_youtube_id'] = sanitize_text_field( $input['header_youtube_id'] );
	$input['header_youtube_img'] = absint( $input['header_youtube_img'] );
  if ( ! isset( $input['header_mobile_hide_setting_yutu'] ) ) $input['header_mobile_hide_setting_yutu'] = null;
  $input['header_mobile_hide_setting_yutu'] = ( $input['header_mobile_hide_setting_yutu'] == 1 ? 1 : 0 );
	$input['header_youtube_catch'] = sanitize_textarea_field( $input['header_youtube_catch'] );
	$input['header_youtube_catch_font_size'] = absint( $input['header_youtube_catch_font_size'] );
	$input['header_youtube_catch_font_size_sp'] = absint( $input['header_youtube_catch_font_size_sp'] );
	$input['header_youtube_catch_color'] = sanitize_hex_color( $input['header_youtube_catch_color'] );
  if ( ! isset( $input['header_youtube_catch_writing_mode'] ) ) $input['header_youtube_catch_writing_mode'] = null;
  if ( ! array_key_exists( $input['header_youtube_catch_writing_mode'], $writing_mode_options ) ) $input['header_youtube_catch_writing_mode'] = null;
  $input['header_youtube_overlay'] = sanitize_hex_color( $input['header_youtube_overlay'] );
  $input['header_youtube_overlay_opacity'] = sanitize_text_field( $input['header_youtube_overlay_opacity'] );

  // Contents after the header content
  if ( ! isset( $input['display_index_content01'] ) ) $input['display_index_content01'] = null;
	$input['display_index_content01'] = ( $input['display_index_content01'] == 1 ? 1 : 0 );
  $input['index_content01_catch'] = wp_kses_post( $input['index_content01_catch'] );
  $input['index_content01_catch_font_size'] = absint( $input['index_content01_catch_font_size'] );
  $input['index_content01_catch_font_size_sp'] = absint( $input['index_content01_catch_font_size_sp'] );
  $input['index_content01_desc'] = wp_kses_post( $input['index_content01_desc'] );
  $input['index_content01_color'] = sanitize_hex_color( $input['index_content01_color'] );
  $input['index_content01_bg'] = sanitize_hex_color( $input['index_content01_bg'] );
  $input['index_content01_btn_bg'] = sanitize_hex_color( $input['index_content01_btn_bg'] );
  $input['index_content01_btn_color'] = sanitize_hex_color( $input['index_content01_btn_color'] );
  $input['index_content01_btn_bg_hover'] = sanitize_hex_color( $input['index_content01_btn_bg_hover'] );
  $input['index_content01_btn_color_hover'] = sanitize_hex_color( $input['index_content01_btn_color_hover'] );

  // Contents builder
  if ( ! isset( $input['index_contents_order'] ) || count( $input['index_contents_order'] ) !== count( $dp_default_options['index_contents_order'] ) ) {
    $input['index_contents_order'] = $dp_default_options['index_contents_order'];
  }
  foreach ( $input['index_contents_order'] as $order ) {
    if ( ! in_array( $order, $dp_default_options['index_contents_order'] ) ) {
      $input['index_contents_order'] = $dp_default_options['index_contents_order'];
      break;
    }
  }

  // 4 images and text
  if ( ! isset( $input['display_index_4_images_and_text'] ) ) $input['display_index_4_images_and_text'] = null;
	$input['display_index_4_images_and_text'] = ( $input['display_index_4_images_and_text'] == 1 ? 1 : 0 );
  if ( ! isset( $input['index_4_images_and_text_layout'] ) ) $input['index_4_images_and_text_layout'] = null;
  if ( ! array_key_exists( $input['index_4_images_and_text_layout'], $index_4_images_and_text_layout_options ) ) $input['index_4_images_and_text_layout'] = null;
  $input['index_4_images_and_text_bg'] = sanitize_hex_color( $input['index_4_images_and_text_bg'] );
  for ( $i = 1; $i <= 4; $i++ ) {
    $input['index_4_images_and_text_img' . $i] = absint( $input['index_4_images_and_text_img' . $i] );
  }
  $input['index_4_images_and_text_catch'] = wp_kses_post( $input['index_4_images_and_text_catch'] );
  $input['index_4_images_and_text_catch_font_size'] = absint( $input['index_4_images_and_text_catch_font_size'] );
  $input['index_4_images_and_text_catch_font_size_sp'] = absint( $input['index_4_images_and_text_catch_font_size_sp'] );
  $input['index_4_images_and_text_catch_color'] = sanitize_hex_color( $input['index_4_images_and_text_catch_color'] );
  $input['index_4_images_and_text_desc'] = wp_kses_post($input['index_4_images_and_text_desc'] );

  // Three column
  if ( ! isset( $input['display_index_three_column'] ) ) $input['display_index_three_column'] = null;
	$input['display_index_three_column'] = ( $input['display_index_three_column'] == 1 ? 1 : 0 );
  $input['index_three_column_bg'] = sanitize_hex_color( $input['index_three_column_bg'] );

  for ( $i = 1; $i <= 3; $i++ ) {
    $input['index_three_column_title' . $i] = wp_kses_post( $input['index_three_column_title' . $i] );
    $input['index_three_column_img' . $i] = absint( $input['index_three_column_img' . $i] );
    $input['index_three_column_desc' . $i] = wp_kses_post( $input['index_three_column_desc' . $i] );
    $input['index_three_column_btn_label' . $i] = sanitize_text_field( $input['index_three_column_btn_label' . $i] );
    $input['index_three_column_btn_url' . $i] = sanitize_text_field( $input['index_three_column_btn_url' . $i] );
    if ( ! isset( $input['index_three_column_btn_target' . $i] ) ) $input['index_three_column_btn_target' . $i] = null;
	  $input['index_three_column_btn_target' . $i] = ( $input['index_three_column_btn_target' . $i] == 1 ? 1 : 0 );
  }

  // News and event
	if ( ! isset( $input['display_index_news_and_event'] ) ) $input['display_index_news_and_event'] = null;
	$input['display_index_news_and_event'] = ( $input['display_index_news_and_event'] == 1 ? 1 : 0 );
  if ( ! isset( $input['index_news_and_event_layout'] ) ) $input['index_news_and_event_layout'] = null;
  if ( ! array_key_exists( $input['index_news_and_event_layout'], $index_news_and_event_layout_options ) ) $input['index_news_and_event_layout'] = null;
	$input['index_news_and_event_bg'] = sanitize_hex_color( $input['index_news_and_event_bg'] );
	$input['index_news_title'] = wp_kses_post( $input['index_news_title'] );
	$input['index_news_title_font_size'] = absint( $input['index_news_title_font_size'] );
	$input['index_news_title_font_size_sp'] = absint( $input['index_news_title_font_size_sp'] );
  $input['index_news_title_color'] = sanitize_hex_color( $input['index_news_title_color'] );
	$input['index_news_sub'] =  wp_kses_post(  $input['index_news_sub'] );
	$input['index_news_num'] = absint( $input['index_news_num'] );
	$input['index_news_link_text'] = sanitize_text_field( $input['index_news_link_text'] );
	$input['index_news_link_color'] = sanitize_hex_color( $input['index_news_link_color'] );
	$input['index_news_link_color_hover'] = sanitize_hex_color( $input['index_news_link_color_hover'] );
	$input['index_event_title'] = wp_kses_post( $input['index_event_title'] );
	$input['index_event_title_font_size'] = absint( $input['index_event_title_font_size'] );
	$input['index_event_title_font_size_sp'] = absint( $input['index_event_title_font_size_sp'] );
  $input['index_event_title_color'] = sanitize_hex_color( $input['index_event_title_color'] );
	$input['index_event_sub'] =  wp_kses_post(  $input['index_event_sub'] );
	$input['index_event_num'] = absint( $input['index_event_num'] );
	$input['index_event_link_text'] = sanitize_text_field( $input['index_event_link_text'] );
	$input['index_event_link_color'] = sanitize_hex_color( $input['index_event_link_color'] );
	$input['index_event_link_color_hover'] = sanitize_hex_color( $input['index_event_link_color_hover'] );

  // Interview
	if ( ! isset( $input['display_index_interview'] ) ) $input['display_index_interview'] = null;
	$input['display_index_interview'] = ( $input['display_index_interview'] == 1 ? 1 : 0 );
	$input['index_interview_title'] = wp_kses_post( $input['index_interview_title'] );
	$input['index_interview_title_font_size'] = absint( $input['index_interview_title_font_size'] );
	$input['index_interview_title_font_size_sp'] = absint( $input['index_interview_title_font_size_sp'] );
  $input['index_interview_title_color'] = sanitize_hex_color( $input['index_interview_title_color'] );
	$input['index_interview_sub'] = wp_kses_post( $input['index_interview_sub'] );
	$input['index_interview_num'] = absint( $input['index_interview_num'] );
	$input['index_interview_link_text'] = sanitize_text_field( $input['index_interview_link_text'] );

  // Plan contents
	if ( ! isset( $input['display_index_plan_content'] ) ) $input['display_index_plan_content'] = null;
	$input['display_index_plan_content'] = ( $input['display_index_plan_content'] == 1 ? 1 : 0 );
	$input['index_plan_content_catch'] = wp_kses_post( $input['index_plan_content_catch'] );
	$input['index_plan_content_catch_font_size'] = absint( $input['index_plan_content_catch_font_size'] );
	$input['index_plan_content_catch_font_size_sp'] = absint( $input['index_plan_content_catch_font_size_sp'] );
  $input['index_plan_content_catch_color'] = sanitize_hex_color( $input['index_plan_content_catch_color'] );
  $input['index_plan_content_post_id'] = absint( $input['index_plan_content_post_id'] );
	$input['index_plan_content_link_text'] = sanitize_text_field( $input['index_plan_content_link_text'] );

  // Image
	if ( ! isset( $input['display_index_image'] ) ) $input['display_index_image'] = null;
	$input['display_index_image'] = ( $input['display_index_image'] == 1 ? 1 : 0 );
  $input['index_image_image'] = absint( $input['index_image_image'] );
  $input['index_image_catch'] = wp_kses_post( $input['index_image_catch'] );
  $input['index_image_catch_font_size'] = absint( $input['index_image_catch_font_size'] );
  $input['index_image_catch_font_size_sp'] = absint( $input['index_image_catch_font_size_sp'] );
  $input['index_image_desc'] = wp_kses_post($input['index_image_desc'] );
  $input['index_image_btn_label'] = sanitize_text_field( $input['index_image_btn_label'] );
  $input['index_image_btn_url'] = sanitize_text_field( $input['index_image_btn_url'] );
	if ( ! isset( $input['index_image_btn_target'] ) ) $input['index_image_btn_target'] = null;
	$input['index_image_btn_target'] = ( $input['index_image_btn_target'] == 1 ? 1 : 0 );

  // Blog
	if ( ! isset( $input['display_index_blog'] ) ) $input['display_index_blog'] = null;
	$input['display_index_blog'] = ( $input['display_index_blog'] == 1 ? 1 : 0 );
	$input['index_blog_title'] = wp_kses_post( $input['index_blog_title'] );
	$input['index_blog_title_font_size'] = absint( $input['index_blog_title_font_size'] );
	$input['index_blog_title_font_size_sp'] = absint( $input['index_blog_title_font_size_sp'] );
  $input['index_blog_title_color'] = sanitize_hex_color( $input['index_blog_title_color'] );
	$input['index_blog_sub'] = wp_kses_post( $input['index_blog_sub'] );
	$input['index_blog_num'] = absint( $input['index_blog_num'] );
	$input['index_blog_link_text'] = sanitize_text_field( $input['index_blog_link_text'] );

  // Catchphrase & description
 	if ( ! isset( $input['display_index_catch_and_desc'] ) ) $input['display_index_catch_and_desc'] = null;
  $input['display_index_catch_and_desc'] = ( $input['display_index_catch_and_desc'] == 1 ? 1 : 0 );
  $input['index_catch_and_desc_catch'] = wp_kses_post( $input['index_catch_and_desc_catch'] );
  $input['index_catch_and_desc_catch_font_size'] = absint( $input['index_catch_and_desc_catch_font_size'] );
  $input['index_catch_and_desc_catch_font_size_sp'] = absint( $input['index_catch_and_desc_catch_font_size_sp'] );
  $input['index_catch_and_desc_catch_color'] = sanitize_hex_color( $input['index_catch_and_desc_catch_color'] );
  $input['index_catch_and_desc_desc'] = wp_kses_post( $input['index_catch_and_desc_desc'] );

  // Wysiwyg
  for ( $i = 1; $i <= 3; $i++ ) {
   if ( ! isset( $input['display_full_index_wysiwyg' . $i] ) ) $input['display_full_index_wysiwyg' . $i] = null;
   $input['display_full_index_wysiwyg' . $i] = ( $input['display_full_index_wysiwyg' . $i] == 1 ? 1 : 0 );
   if ( ! isset( $input['display_index_wysiwyg' . $i] ) ) $input['display_index_wysiwyg' . $i] = null;
   $input['display_index_wysiwyg' . $i] = ( $input['display_index_wysiwyg' . $i] == 1 ? 1 : 0 );
  }

	return $input;
}
