<?php
/*
 * Manage logo tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_seo_dp_default_options' );

// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_seo_tab_label' );

// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_seo_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_seo_theme_options_validate' );


function add_seo_dp_default_options( $dp_default_options ) {

  // OGP
	$dp_default_options['use_ogp'] = 0;
	$dp_default_options['fb_app_id'] = '';
	$dp_default_options['ogp_image'] = '';

	// Twitter Cards
	$dp_default_options['twitter_account_name'] = '';
	
	// Emoji
	$dp_default_options['use_emoji'] = 1;

	return $dp_default_options;
}

function add_seo_tab_label( $tab_labels ) {
	$tab_labels['seo'] = __( 'SEO', 'tcd-w' );
	return $tab_labels;
}

function add_seo_tab_panel( $options ) {
	global $dp_default_options, $logo_type_options;
?>
<div id="tab-content-logo" class="tab-content">

	<?php // Header logo ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('OGP', 'tcd-w');  ?></h3>
        <div class="theme_option_field_ac_content">
            <div class="theme_option_message2">
                <p><?php _e( 'OGP is a mechanism for correctly conveying page information.', 'tcd-w' ); ?></p>
            </div>
            <p><label><input id="dp_options[use_ogp]" name="dp_options[use_ogp]" type="checkbox" value="1" <?php checked( '1', $options['use_ogp'] ); ?>><?php _e( 'Use OGP', 'tcd-w' );  ?></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'OGP image', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'This image is displayed for OGP if the page does not have a thumbnail.', 'tcd-w' ); ?></p>
      <p><?php _e( 'Recommend image size. Width:1200px, Height:630px', 'tcd-w' ); ?></p>
     </div>

		<div class="image_box cf">
			<div class="cf cf_media_field hide-if-no-js">
				<input type="hidden" value="<?php echo esc_attr( $options['ogp_image'] ); ?>" id="ogp_image" name="dp_options[ogp_image]" class="cf_media_id">
				<div class="preview_field"><?php if ( $options['ogp_image'] ) { echo wp_get_attachment_image( $options['ogp_image'], 'medium'); } ?></div>
				<div class="button_area">
					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['ogp_image'] ) { echo 'hidden'; } ?>">
				</div>
			</div>
		</div>
    <h4 class="theme_option_headline2"><?php _e( 'Facebook OGP', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
        <p><?php _e( 'To use Facebook OGP please set your app ID.', 'tcd-w' ); ?></p>
        <p><a href="https://tcd-theme.com/2018/01/facebook_app_id.html" target="_blank"><?php _e( 'Information about Facebook app ID.', 'tcd-w' ); ?></a></p>
    </div>
	<p><?php _e( 'Your app ID', 'tcd-w' );  ?> <input class="regular-text" type="text" name="dp_options[fb_app_id]" value="<?php esc_attr_e( $options['fb_app_id'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e('X Cards', 'tcd-w');  ?></h4>
    <div class="theme_option_message2">
        <p><?php _e( 'This theme requires Facebook OGP settings to use X cards.', 'tcd-w' ); ?></p>
        <p><a href="https://tcd-theme.com/2016/11/twitter-cards.html" target="_blank"><?php _e( 'Information about X Cards.', 'tcd-w' ); ?></a></p>
    </div>
    <ul class="option_list">
        <li class="cf"><span class="label"><?php _e( 'Your X account name (exclude @ mark)', 'tcd-w' ); ?></span><input class="regular-text" type="text" name="dp_options[twitter_account_name]" value="<?php echo esc_attr( $options['twitter_account_name'] ); ?>"></li>
    </ul>
</div><!-- END #tab-content2 -->

</div><!-- END .theme_option_field -->
<?php // 絵文字の設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Emoji', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'We recommend to checkoff this option if you dont use any Emoji in your post content.', 'tcd-w' );  ?></p>
     </div>

     <p><label><input name="dp_options[use_emoji]" type="checkbox" value="1" <?php checked( 1, $options['use_emoji'] ); ?>><?php _e( 'Use emoji', 'tcd-w' ); ?></label></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->
</div>

<?php
}

function add_seo_theme_options_validate( $input ) {

 	// OGP
 	if ( ! isset( $input['use_ogp'] ) ) $input['use_ogp'] = null;
    $input['use_ogp'] = ( $input['use_ogp'] == 1 ? 1 : 0 );
 	$input['fb_app_id'] = sanitize_text_field( $input['fb_app_id'] );
	$input['ogp_image'] = absint( $input['ogp_image'] );
	
	// Emoji
	if ( ! isset( $input['use_emoji'] ) ) $input['use_emoji'] = null;
	$input['use_emoji'] = ( $input['use_emoji'] == 1 ? 1 : 0 );

	// Twitter Cardsの設定
 	$input['twitter_account_name'] = sanitize_text_field( $input['twitter_account_name'] );
	return $input;
}
