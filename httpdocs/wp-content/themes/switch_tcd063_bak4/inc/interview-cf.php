<?php
/*
 * Add a meta box of an interview
 */
$interviewee_media_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Use the featured image', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Video', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'YouTube', 'tcd-w' ) )
);

$interview_fields = array(
	array(
		'id' => 'interviewee_name',
		'title' => __( 'Name of interviewee', 'tcd-w' ),
		'type' => 'text',
    'default' => '',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'interviewee_age',
		'title' => __( 'Age of interviewee', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
  ),
  array(
		'id' => 'interviewee_media_type',
    'title' => __( 'Media type to display', 'tcd-w' ),
    'type' => 'radio',
    'default' => 'type1',
    'options' => $interviewee_media_type_options,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
  ),
	array(
		'id' => 'interviewee_video',
		'title' => __( 'Video file', 'tcd-w' ),
    'description' => __( 'Please upload MP4 format file.', 'tcd-w' ),
		'type' => 'video',
		'before_field' => '<dl id="interviewee_media_type_type2" class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
  ),
	array(
		'id' => 'interviewee_youtube',
		'title' => __( 'Video ID of YouTube', 'tcd-w' ),
    'description' => __( 'Please input a video ID of YouTube', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl id="interviewee_media_type_type3" class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
  ),
  array(
		'id' => 'interviewee_faq',
		'title' => __( 'FAQ', 'tcd-w' ),
    'type' => 'repeater_table',
    'header' => array(
      'header' => __( 'Question', 'tcd-w' ),
      'desc' => __( 'Answer', 'tcd-w' )
    ),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
  )
);
$interview_args = array(
	'id' => 'interview_meta_box',
	'title' => __( 'Interview', 'tcd-w' ),
	'screen' => array( 'interview' ),
	'context' => 'normal',
	'fields' => $interview_fields
);
$interview_meta_box = new TCD_Meta_Box( $interview_args );

/**
 * Add custom fields to custom taxonomy "Interview category"
 */

// Add form fields to edit-tags.php (Add New Category)
function interview_cat_add_form_fields() {
?>
<div class="form-field">
  <label for="catch"><?php _e( 'Catchphrase', 'tcd-w' ); ?></label>
  <input name="catch" id="catch" type="text" value="">
  <p><?php _e( 'The catchphrase is used after the page header.', 'tcd-w' ); ?></p>
</div>
<div class="form-field">
  <label for="desc"><?php _e( 'Description', 'tcd-w' ); ?></label>
  <textarea name="desc" id="desc"></textarea>
  <p><?php _e( 'The description is used after the page header.', 'tcd-w' ); ?></p>
</div>
<?php
}

// Add form fields to term.php (Edit Category)
function interview_cat_edit_form_fields( $category ) {
  $ph_desc_writing_mode = get_term_meta( $category->term_id, 'ph_desc_writing_mode', true );
  $ph_img = get_term_meta( $category->term_id, 'ph_img', true );
  $ph_img_animation_type = get_term_meta( $category->term_id, 'ph_img_animation_type', true );
?>
</table>
<table class="form-table">
  <tr>
  	<th scope="row"><label for="catch"><?php _e( 'Catchphrase', 'tcd-w' ); ?></label></th>
    <td>
      <input name="catch" id="catch" class="large-text" type="text" value="<?php echo esc_attr( get_term_meta( $category->term_id, 'catch', true ) ); ?>">
      <p><?php _e( 'The catchphrase is used after the page header.', 'tcd-w' ); ?></p>
    </td>
  </tr>
  <tr>
  	<th scope="row"><label for="desc"><?php _e( 'Description', 'tcd-w' ); ?></label></th>
    <td>
      <textarea name="desc" id="desc" class="large-text"><?php echo esc_textarea( get_term_meta( $category->term_id, 'desc', true ) ); ?></textarea>
      <p><?php _e( 'The description is used after the page header.', 'tcd-w' ); ?></p>
    </td>
  </tr>
</table>
<?php
}

// Save
function interview_cat_update_term_meta( $term_id ) {

  $meta_keys = array( 'catch', 'desc' );

  foreach ( $meta_keys as $meta_key ) {

    $old = get_term_meta( $term_id, $meta_key, true );
    $new = isset( $_POST[$meta_key] ) ? $_POST[$meta_key] : '';

    if ( $new && $new !== $old ) {
      update_term_meta( $term_id, $meta_key, $new );
    } elseif ( '' === $new && $old ) {
      delete_term_meta( $term_id, $meta_key, $old );
    }

  }
}

add_action( 'interview_category_add_form_fields', 'interview_cat_add_form_fields' );
add_action( 'interview_category_edit_form_fields', 'interview_cat_edit_form_fields' );
add_action( 'created_interview_category', 'interview_cat_update_term_meta' );
add_action( 'edited_interview_category', 'interview_cat_update_term_meta' );

