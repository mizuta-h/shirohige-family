<?php
/*
 * Manage password tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_pw_dp_default_options' );

// Add label of password tab
add_action( 'tcd_tab_labels', 'add_pw_tab_label' );

// Add HTML of password tab
add_action( 'tcd_tab_panel', 'add_pw_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_pw_theme_options_validate' );

global $pw_align_options;
$pw_align_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Align left', 'tcd-w' ) ),
  'type2' => array('value' => 'type2','label' => __( 'Align center', 'tcd-w' ) )
);

function add_pw_dp_default_options( $dp_default_options ) {

	$dp_default_options['pw_label'] = '';
	$dp_default_options['pw_align'] = 'type1';

	for ( $i = 1; $i <= 5; $i++ ) {
		$dp_default_options['pw_name' . $i] = '';
		$dp_default_options['pw_btn_label' . $i] = '';
		$dp_default_options['pw_btn_url' . $i] = '';
		$dp_default_options['pw_btn_target' . $i] = 0;
		$dp_default_options['pw_editor' . $i] = '';
	}

	return $dp_default_options;
}

function add_pw_tab_label( $tab_labels ) {
	$tab_labels['password'] = __( 'Password protected pages', 'tcd-w' );
	return $tab_labels;
}

function add_pw_tab_panel( $options ) {
	global $dp_default_options, $pw_align_options;
?>
<div id="tab-content-password" class="tab-content">

   <div class="theme_option_field cf theme_option_field_ac open active">
    <h3 class="theme_option_headline"><?php _e('Password protected pages', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

    <div class="theme_option_message2">
     <p><?php _e( 'WordPress Default Function We have prepared a function to customize the protected page with "password protection" set. By default the password entry field and send button are only displayed, but you can display arbitrary guidance sentences and link buttons.', 'tcd-w' ); ?></p>
    </div>

		<h4 class="theme_option_headline2"><?php _e( 'Password field and button align', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
     <p><?php _e( 'Please select the arrangement of password field and confirm-button displayed on the protected page from "Left align" or "Align center".', 'tcd-w' ); ?></p>
    </div>
		<ul class="cf horizontal">
			<?php foreach ( $pw_align_options as $option ) : ?>
			<li><label class="description"><input type="radio" name="dp_options[pw_align]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $option['value'], $options['pw_align'] ); ?>><?php _e( $option['label'], 'tcd-w' ); ?></label></li>
			<?php endforeach; ?>
    </ul>

		<h4 class="theme_option_headline2"><?php _e( 'Password field', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
     <p><?php _e( 'Set the label to be displayed before the password entry field.', 'tcd-w' ); ?></p>
    </div>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Label', 'tcd-w'); ?></span><input type="text" class="full_width" name="dp_options[pw_label]" value="<?php echo esc_attr( $options['pw_label'] ); ?>"></li>
    </ul>

		<h4 class="theme_option_headline2"><?php _e( 'Contents to encourage member registration', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
     <p><?php _e( 'Create induced content for member registration. Please select the guide content you want to display from the post edit screen which set "password protection".', 'tcd-w' ); ?></p>
    </div>

		<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
		<div class="sub_box">
			<h5 class="theme_option_subbox_headline"><?php echo  __( 'Content', 'tcd-w' ) . $i; ?><span><?php if ( $options['pw_name' . $i] ) { echo ' : ' . esc_html( $options['pw_name' . $i] ); } ?></span></h4>
			<div class="sub_box_content">

        <div class="theme_option_message2" style="margin-top:20px;">
         <p><?php _e( '"Name of contents" is used in edit post page.', 'tcd-w' ); ?></p>
        </div>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Name of contents', 'tcd-w'); ?></span><input type="text" class="theme_option_subbox_headline_label full_width" name="dp_options[pw_name<?php echo $i; ?>]" value="<?php echo esc_attr( $options['pw_name'.$i] ); ?>"></li>
        </ul>

				<h6 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h6>
        <div class="theme_option_message2">
         <p><?php _e( 'Set the buttons displayed under the member registration.', 'tcd-w' ); ?></p>
        </div>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Label', 'tcd-w'); ?></span><input type="text" class="full_width" name="dp_options[pw_btn_label<?php echo $i; ?>]" value="<?php echo esc_attr( $options['pw_btn_label' . $i] ); ?>"></li>
         <li class="cf button_option">
          <span class="label"><?php _e('URL', 'tcd-serum'); ?></span>
          <div class="admin_link_option">
           <input type="text" name="dp_options[pw_btn_url<?php echo $i; ?>]" value="<?php echo esc_attr( $options['pw_btn_url' . $i] ); ?>" placeholder="https://example.com/">
           <input id="pw_btn_target<?php echo $i; ?>" class="admin_link_option_target" type="checkbox" name="dp_options[pw_btn_target<?php echo $i; ?>]" value="1" <?php checked( 1, $options['pw_btn_target' . $i] ); ?>>
           <label for="pw_btn_target<?php echo $i; ?>">&#xe92a;</label>
          </div>
         </li>
        </ul>

				<h6 class="theme_option_headline2"><?php _e( 'Sentences to encourage member registration', 'tcd-w' ); ?></h6>
        <div class="theme_option_message2">
         <p><?php _e( 'You can display not only text but also images and Youtube videos as guided content, just like regular posts. "Sentences to encourage member registration" is displayed under excerpts.', 'tcd-w' ); ?></p>
        </div>
				<?php wp_editor( $options['pw_editor' . $i], 'pw_editor' . $i, array ( 'textarea_name' => 'dp_options[pw_editor' . $i . ']' ) ); ?>

			</div>
		</div>
		<?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END #tab-content10 -->
<?php
}

function add_pw_theme_options_validate( $input ) {

	global $pw_align_options;

	$input['pw_label'] = sanitize_text_field( $input['pw_label'] );
 	if ( ! isset( $input['pw_align'] ) ) $input['pw_align'] = null;
 	if ( ! array_key_exists( $input['pw_align'], $pw_align_options ) ) $input['pw_align'] = null;
	for ( $i = 1; $i <= 5; $i++ ) {
		$input['pw_name' . $i] = sanitize_text_field( $input['pw_name' . $i] );
		$input['pw_btn_label' . $i] = sanitize_text_field( $input['pw_btn_label' . $i] );
		$input['pw_btn_url' . $i] = esc_url_raw( $input['pw_btn_url' . $i] );
		if ( ! isset( $input['pw_btn_target' . $i] ) ) $input['pw_btn_target' . $i] = null;
		$input['pw_btn_target' . $i] = ( $input['pw_btn_target' . $i] == 1 ? 1 : 0 );
		$input['pw_editor' . $i] = $input['pw_editor' . $i];
	}

	return $input;
}
