<?php
/**
 * Add a meta box of page template
 */
add_action( 'add_meta_boxes', 'register_template_meta_box', 11 );
add_action( 'save_post', 'save_template_meta_box' );

function register_template_meta_box() {
	add_meta_box(
    'template_meta_box',
    __( 'Page template setting', 'tcd-w' ),
    'render_template_meta_box',
    'page',
    'normal',
    'high'
  );
}

function save_template_meta_box( $post_id ) {

  $id = 'template_meta_box';

  $cf_keys = array(
    'page_tcd_template_type',
  );

	// Check if our nonce is set.
	if ( ! isset( $_POST[$id . '_nonce'] ) ) return;

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST[$id . '_nonce'], 'save_' . $id  ) ) {
  	return $post_id;
  }

  // check autosave
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
  	return $post_id;
  }

  // check permissions
  if ( 'page' == $_POST['post_type'] ) {
  	if ( ! current_user_can( 'edit_page', $post_id ) ) {
    		return $post_id;
  	}
  } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
    	return $post_id;
  }

  // save or delete
  if ( ! $fields = get_tcd_template_fields( 'all' ) ) {
    return $post_id;
  }

  foreach ( $fields as $field ) {

    if ( 'sub_box' === $field['type'] ) {

      foreach ( $field['fields'] as $sub_field ) {
        $cf_keys[] = $sub_field['id'];
      }

    } else {
      $cf_keys[] = $field['id'];
    }
  }

  foreach ( $cf_keys as $cf_key ) {

  	$old = get_post_meta( $post_id, $cf_key, true );
		$new = isset( $_POST[$cf_key] ) ? $_POST[$cf_key] : '';

  	if ( $new && $new != $old ) {
  		update_post_meta( $post_id, $cf_key, $new );
  	} elseif ( '' == $new && $old ) {
   		delete_post_meta( $post_id, $cf_key, $old );
  	}
  }
}

// フォーム用 画像フィールド出力
function mlcf_media_form( $cf_key, $label ) {
	global $post;
	if ( empty( $cf_key ) ) return false;
	if ( empty( $label ) ) $label = $cf_key;
	$media_id = get_post_meta( $post->ID, $cf_key, true );
?>
	<div class="cf cf_media_field hide-if-no-js <?php echo esc_attr( $cf_key ); ?>">
    <input type="hidden" class="cf_media_id" name="<?php echo esc_attr( $cf_key ); ?>" id="<?php echo esc_attr( $cf_key ); ?>" value="<?php echo esc_attr( $media_id ); ?>">
    <div class="preview_field"><?php if ( $media_id ) echo wp_get_attachment_image( $media_id, 'medium' ); ?></div>
		<div class="buttton_area">
   	 		<input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
     		<input type="button" class="cfmf-delete-img button<?php if ( ! $media_id ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>">
    	</div>
  	</div>
<?php
}

function render_template_meta_box( $post ) {

	$page_tcd_template_type = array(
		'name' => __( 'Page template type', 'tcd-w' ),
		'id' => 'page_tcd_template_type',
		'type' => 'radio',
		'default' => 'type1',
		'options' => array(
			array( 'name' => __( 'Normal', 'tcd-w' ), 'value' => 'type1' ),
			array( 'name' => __( 'Template1', 'tcd-w' ), 'value' => 'type2', 'img' => 'tmp-concept.jpg' ),
			array( 'name' => __( 'Template2', 'tcd-w' ), 'value' => 'type3', 'img' => 'tmp-floor.jpg' ),
			array( 'name' => __( 'Template3', 'tcd-w' ), 'value' => 'type4', 'img' => 'tmp-service.jpg' ),
		)
  );
	$page_tcd_template_type_meta = $post->page_tcd_template_type;

  if ( ! $page_tcd_template_type_meta ) {
    $page_tcd_template_type_meta = 'type1';
  }

	wp_nonce_field( 'save_template_meta_box', 'template_meta_box_nonce' );

  // テンプレートの選択
  ?>
	<dl class="ml_custom_fields_select">
	  <dt class="label"><label for="<?php echo esc_attr( $page_tcd_template_type['id'] ); ?>"><?php echo esc_html( $page_tcd_template_type['name'] ); ?></label></dt>
    <dd>
      <ul class="radio template cf">

        <?php foreach ( $page_tcd_template_type['options'] as $option ) : ?>
        <li>
          <?php if ( $page_tcd_template_type_meta === $option['value'] ) : ?>
          <label class="active"><input type="radio" name="<?php echo esc_attr( $page_tcd_template_type['id'] ); ?>" value="<?php echo esc_attr( $option['value'] ); ?>" checked="checked"><?php echo esc_html( $option['name'] ); ?></label>
          <?php else : ?>
          <label><input type="radio" name="<?php echo esc_attr( $page_tcd_template_type['id'] ); ?>" value="<?php echo esc_attr( $option['value'] ); ?>"><?php echo esc_html( $option['name'] ); ?></label>
          <?php endif; ?>

          <?php if ( 'type1' !== $option['value'] ) : ?>
          <a href="<?php echo get_template_directory_uri(); ?>/admin/assets/images/<?php echo esc_attr( $option['img'] ); ?>" target="_blank"><?php _e( 'View image', 'tcd-w' ); ?></a>
          <?php endif; ?>
        </li>
        <?php endforeach; ?>
      </ul>
    </dd>
  </dl>

  <?php
  // Render type2/type3/type4 fields
  for ( $i = 2; $i <= 4; $i++ ) : ?>
  <dl class="ml_custom_fields type2" id="page_tcd_template_type_type<?php echo $i; ?>"<?php if ( $page_tcd_template_type_meta !== 'type' . $i ) { echo ' style="display:none;"'; } ?>>
    <?php render_tcd_template_fields( 'type' . $i ); ?>
  </dl>
  <?php endfor;
}

/**
 * Get template fields array
 */
function get_tcd_template_fields( $type = null ) {

	$type2_fields = array();
	$type3_fields = array();
	$type4_fields = array();

	$type2_fields[] = array(
    'name' => 'A',
		'id' => 'page_type2_a',
		'type' => 'editor'
	);
	$type2_fields[] = array(
    'name' => 'B',
		'id' => 'page_type2_b',
		'type' => 'repeater',
    'callback' => 'render_type2_b'
	);
	$type2_fields[] = array(
    'name' => 'C',
    'desc' => __( 'Recommended size: width 1450px, height 360px', 'tcd-w' ),
		'id' => 'page_type2_c',
		'type' => 'image'
	);
	$type2_fields[] = array(
    'name' => 'D',
		'id' => 'page_type2_d',
		'type' => 'text'
	);
	$type2_fields[] = array(
    'name' => 'E',
		'id' => 'page_type2_e',
		'type' => 'image'
	);
	$type2_fields[] = array(
    'name' => 'F',
		'id' => 'page_type2_f',
		'type' => 'repeater',
    'callback' => 'render_type2_f'
	);

	$type3_fields[] = array(
    'name' => 'A',
		'id' => 'page_type3_a',
		'type' => 'editor'
	);
	$type3_fields[] = array(
    'name' => 'B',
		'id' => 'page_type3_b',
		'type' => 'repeater',
    'callback' => 'render_type3_block'
	);
	$type3_fields[] = array(
    'name' => 'C',
		'id' => 'page_type3_c',
    'desc' => __( 'Recommended size: width 1450px, height 360px', 'tcd-w' ),
		'type' => 'image'
	);
	$type3_fields[] = array(
    'name' => 'D',
		'id' => 'page_type3_d',
		'type' => 'repeater',
    'callback' => 'render_type3_block'
	);

	$type4_fields[] = array(
    'name' => 'A',
		'id' => 'page_type4_a',
		'type' => 'editor'
	);
	$type4_fields[] = array(
    'name' => 'B',
		'id' => 'page_type4_b',
    'desc' => __( 'Recommended size: width 1180px, height 430px', 'tcd-w' ),
		'type' => 'image'
	);
  $type4_fields[] = array(
    'name' => 'C',
    'type' => 'sub_box',
    'fields' => array(
	    array(
        'name' => __( 'C-1', 'tcd-w' ),
	    	'id' => 'page_type4_c_1',
	    	'type' => 'textarea'
	    ),
	    array(
        'name' => __( 'C-2', 'tcd-w' ),
	    	'id' => 'page_type4_c_2',
        'desc' => __( 'You can use HTML tags.', 'tcd-w' ),
	    	'type' => 'textarea'
	    ),
	    array(
        'name' => __( 'C-3', 'tcd-w' ),
	    	'id' => 'page_type4_c_3',
	    	'type' => 'textarea'
	    ),
	    array(
        'name' => __( 'C-4', 'tcd-w' ),
	    	'id' => 'page_type4_c_4',
        'desc' => __( 'You can use HTML tags.', 'tcd-w' ),
	    	'type' => 'textarea'
      )
    )
  );
  $type4_fields[] = array(
    'name' => 'D',
    'type' => 'sub_box',
    'fields' => array(

	array(
    'name' => __( 'D-1', 'tcd-w' ),
		'id' => 'page_type4_d_1',
		'type' => 'text'
  ),
	array(
    'name' => __( 'D-2', 'tcd-w' ),
		'id' => 'page_type4_d_2',
		'type' => 'text'
  ),
	array(
    'name' => __( 'D-3', 'tcd-w' ),
		'id' => 'page_type4_d_3',
		'type' => 'textarea'
  ),
	array(
    'name' => __( 'D-4', 'tcd-w' ),
		'id' => 'page_type4_d_4',
    'desc' => __( 'You can use HTML tags.', 'tcd-w' ),
		'type' => 'textarea'
  ),
	array(
    'name' => __( 'D-5', 'tcd-w' ),
		'id' => 'page_type4_d_5',
    'type' => 'repeater',
    'callback' => 'render_type4_d_plan_list'
  ),
	array(
    'name' => __( 'D-6', 'tcd-w' ),
		'id' => 'page_type4_d_6',
    'type' => 'repeater',
    'callback' => 'render_type4_d_plan_list'
  ),
	array(
    'name' => __( 'D-7', 'tcd-w' ),
		'id' => 'page_type4_d_7',
    'type' => 'repeater',
    'callback' => 'render_type4_d_plan_list'
  ),
	array(
    'name' => __( 'Headline in D-8', 'tcd-w' ),
		'id' => 'page_type4_d_8_headline',
    'type' => 'text'
  ),
	array(
    'name' => __( 'Background color of headline in D-8', 'tcd-w' ),
		'id' => 'page_type4_d_8_headline_bg',
    'type' => 'color',
    'default' => '#a19283'
  ),
	array(
    'name' => __( 'Table in D-8', 'tcd-w' ),
		'id' => 'page_type4_d_8_table',
    'type' => 'repeater',
    'callback' => 'render_type4_d_plan_table'
  ),
	array(
    'name' => __( 'Headline in D-9', 'tcd-w' ),
		'id' => 'page_type4_d_9_headline',
    'type' => 'text'
  ),
	array(
    'name' => __( 'Background color of headline in D-9', 'tcd-w' ),
		'id' => 'page_type4_d_9_headline_bg',
    'type' => 'color',
    'default' => '#a19283'
  ),
	array(
    'name' => __( 'Table in D-9', 'tcd-w' ),
		'id' => 'page_type4_d_9_table',
    'type' => 'repeater',
    'callback' => 'render_type4_d_plan_table'
  ),
	array(
    'name' => __( 'Headline in D-10', 'tcd-w' ),
		'id' => 'page_type4_d_10_headline',
    'type' => 'text'
  ),
	array(
    'name' => __( 'Background color of headline in D-10', 'tcd-w' ),
		'id' => 'page_type4_d_10_headline_bg',
    'type' => 'color',
    'default' => '#a19283'
  ),
	array(
    'name' => __( 'Table in D-10', 'tcd-w' ),
		'id' => 'page_type4_d_10_table',
    'type' => 'repeater',
    'callback' => 'render_type4_d_plan_table'
  ),
	array(
    'name' => __( 'Headline in D-11', 'tcd-w' ),
		'id' => 'page_type4_d_11_headline',
    'type' => 'text'
  ),
	array(
    'name' => __( 'Description in D-11', 'tcd-w' ),
		'id' => 'page_type4_d_11_desc',
    'desc' => __( 'You can use HTML tags.', 'tcd-w' ),
    'type' => 'textarea'
  )
    )
  );
	$type4_fields[] = array(
    'name' => 'E',
		'id' => 'page_type4_e',
    'desc' => __( 'Recommended size: width 1180px, height 430px', 'tcd-w' ),
		'type' => 'image'
	);
	$type4_fields[] = array(
    'name' => __( 'F-1', 'tcd-w' ),
		'id' => 'page_type4_f_1',
		'type' => 'textarea'
	);
	$type4_fields[] = array(
    'name' => __( 'F-2', 'tcd-w' ),
		'id' => 'page_type4_f_2',
    'desc' => __( 'You can use HTML tags.', 'tcd-w' ),
		'type' => 'textarea'
	);
	$type4_fields[] = array(
    'name' => 'G',
		'id' => 'page_type4_g',
		'type' => 'repeater',
    'callback' => 'render_type4_g'
	);
	$type4_fields[] = array(
    'name' => __( 'Background color in G', 'tcd-w' ),
		'id' => 'page_type4_g_bg',
    'type' => 'color',
    'default' => '#f5f5f5'
	);
  $type4_fields[] = array(
    'name' => 'H',
    'type' => 'sub_box',
    'fields' => array(
	    array(
        'name' => __( 'Headline in H-1', 'tcd-w' ),
	    	'id' => 'page_type4_h_1_headline',
	    	'type' => 'text',
	    ),
	    array(
        'name' => __( 'Description in H-1', 'tcd-w' ),
	    	'id' => 'page_type4_h_1_desc',
	    	'type' => 'textarea',
	    ),
	    array(
        'name' => __( 'Headline in H-2', 'tcd-w' ),
	    	'id' => 'page_type4_h_2_headline',
	    	'type' => 'text',
	    ),
	    array(
        'name' => __( 'Description in H-2', 'tcd-w' ),
	    	'id' => 'page_type4_h_2_desc',
	    	'type' => 'textarea',
	    ),
	    array(
        'name' => __( 'Headline in H-3', 'tcd-w' ),
	    	'id' => 'page_type4_h_3_headline',
	    	'type' => 'text',
	    ),
	    array(
        'name' => __( 'Description in H-3', 'tcd-w' ),
	    	'id' => 'page_type4_h_3_desc',
	    	'type' => 'textarea',
	    ),
	    array(
        'name' => __( 'Headline in H-4', 'tcd-w' ),
	    	'id' => 'page_type4_h_4_headline',
	    	'type' => 'text',
	    ),
	    array(
        'name' => __( 'Description in H-4', 'tcd-w' ),
	    	'id' => 'page_type4_h_4_desc',
	    	'type' => 'textarea',
	    )
    )
  );

  if ( preg_match( '/^type\d$/', $type ) ) {
    return ${$type . '_fields'};
  } else {
    return array_merge( $type2_fields, $type3_fields, $type4_fields );
  }
}

function render_tcd_template_fields_input( $field, $meta_values ) {

  if ( ! isset( $field['type'] ) ) {
    $field['type'] = 'text';
  }

  if ( 'sub_box' !== $field['type'] ) {

    if ( isset( $meta_values[$field['id']][0] ) ) {
      $meta_value = $meta_values[$field['id']][0];
    } elseif ( ! empty( $field['default'] ) ) {
      $meta_value = $field['default'];
    } else {
      $meta_value = '';
    }
  }

  echo '<dt class="label">';

  if ( 'radio' === $field['type'] || 'sub_box' === $field['type'] ) {
    echo esc_html( $field['name'] );
  } else {
    echo '<label for="' . esc_attr( $field['id'] ) . '">' . esc_html( $field['name'] ) . '</label>';
  }

  echo '</dt>';
  echo '<dd class="content">';

  if ( ! empty( $field['desc'] ) ) {
	  echo '<p class="desc">' . $field['desc'] . '</p>';
  }

  switch ( $field['type'] ) {

    case 'sub_box' :

      echo '<div class="sub_box">';
      echo '<h4 class="theme_option_subbox_headline">' . esc_html( $field['name'] ) . '</h4>';
      echo '<div class="sub_box_content">';
      echo '<dl class="ml_custom_fields">';

      foreach ( $field['fields'] as $sub_field ) {
        render_tcd_template_fields_input( $sub_field, $meta_values );
      }

      echo '</dl></div></div>' . "\n";

      break;

    case 'checkbox' :

      foreach ( $field['options'] as $option ) {
        echo '<p><label><input type="checkbox" id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $option['value'] ) . '"';
        echo strval( $option['value'] ) === $meta_value ? ' checked="checked"' : '';
        echo '>' . esc_html( $option['label'] ) . '</label></p>';
      }
      break;

    case 'color':
		  echo '<input id="' . esc_attr( $field['id'] ) . '" class="c-color-picker" type="text" name="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $meta_value ) . '" data-default-color="' . esc_attr( $field['default'] ) . '">';
      break;

	  case 'font-size' :
		  echo '<input class="tiny-text" type="number" name="' . esc_attr( $field['id'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $meta_value ) . '" min="1" step="1"> px';
		  break;

	  case 'image' :
		  mlcf_media_form( $field['id'], $field['name'] );
		  break;

    case 'radio' :

      foreach ( $field['options'] as $option ) {
        echo '<p><label><input type="radio" id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $option['value'] ) . '"';
        echo $option['value'] === $meta_value ? ' checked="checked"' : '';
        echo '>' . esc_html( $option['label'] ) . '</label></p>';
      }
      break;

	  case 'repeater' :

      if ( function_exists( $field['callback'] ) ) {
        call_user_func( $field['callback'], $field, $meta_value );
      }
		  break;

	  case 'textarea' :

		  $rows = 0;

		  if ( ! empty( $field['rows'] ) ) {
			  $rows = absint( $field['rows'] );
		  }
		  if ( $rows < 1 ) {
			  $rows = 2;
		  }

		  echo '<textarea name="' . esc_attr( $field['id'] ). '" id="' . esc_attr( $field['id'] ) . '" cols="60" rows="' . $rows . '" class="widefat">' . esc_textarea( $meta_value ) . '</textarea>';

		  break;

    case 'editor':
      wp_editor( $meta_value, esc_attr( $field['id'] ), array( 'textarea_name' => esc_attr( $field['id'] ) ) );
      break;

	  default :

		  echo '<input type="' . esc_attr( $field['type'] ) . '" name="' . esc_attr( $field['id'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $meta_value ) . '" class="regular-text">';
      break;

  }

  echo '</dd>' . "\n";

}

/* フィールド入力フォームを出力 */
function render_tcd_template_fields( $type ) {

	global $post;

  if ( ! $fields = get_tcd_template_fields( $type ) ) return false;
	$meta_values = get_post_meta( $post->ID );

	foreach( $fields as $field ) {

    render_tcd_template_fields_input( $field, $meta_values );

	}
}

function render_type2_b( $field, $meta_value ) {

  $key = 'addindex';
  ob_start();
  ?>
  <div id="topt_repeater-<?php echo $key; ?>" class="repeater-item">
	  <table class="block-contents-table">
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header"><?php _e( 'Layout', 'tcd-w' ); ?></th>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/concept-B-type1.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[layout][<?php echo $key; ?>]" value="type1" checked="checked"><?php _e( 'Type1', 'tcd-w' ); ?></label>
        </td>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/concept-B-type2.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[layout][<?php echo $key; ?>]" value="type2"><?php _e( 'Type2', 'tcd-w' ); ?></label>
        </td>
	  	</tr>
      <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
	    <tr class="block-contents-table__row">
      <th class="block-contents-table__header"><?php echo $i; ?></th>
        <td><?php _e( 'Recommended size: width 570px, height 570px', 'tcd-w' ); ?></td>
        <td class="u-center">
	  			<div class="cf cf_media_field hide-if-no-js">
            <input type="hidden" value="" id="<?php echo esc_attr( $field['id'] ); ?>_img<?php echo $i; ?>_<?php echo $key; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[img<?php echo $i; ?>][]" class="cf_media_id">
	  				<div class="preview_field"></div>
	  				<div class="button_area">
	  					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
	  					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button hidden">
	  				</div>
	  			</div>
        </td>
      </tr>
      <?php endfor; ?>
	    <tr class="block-contents-table__row">
	  		<th rowspan="2" class="block-contents-table__header">5</th>
        <td><?php _e( 'Headline', 'tcd-w' ); ?></td>
        <td>
          <input class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[headline][]" value="">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description', 'tcd-w' ); ?><br /><span class="desc"><?php _e('You can use HTML tags.', 'tcd-w'); ?></span></td>
        <td>
          <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[desc][]"></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header"><?php _e( 'Delete', 'tcd-w' ); ?></th>
        <td colspan="2" class="u-center">
          <p class="delete-row">
            <a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a>
          </p>
        </td>
	  	</tr>
	  </table>
  </div>
  <?php
	$clone = ob_get_clean();

	echo '<div class="repeater-wrapper" data-delete-confirm="' . __( 'Delete?', 'tcd-w' ) . '">' . "\n";
	echo '<div class="repeater ui-sortable">' . "\n";

  $meta_value = maybe_unserialize( $meta_value );

  if ( isset( $meta_value['headline'][0] ) ) {

    foreach( array_keys( $meta_value['headline'] ) as $repeater_index ) :

      $layout = isset( $meta_value['layout'][$repeater_index] ) ? $meta_value['layout'][$repeater_index] : 'type1';
      for ( $i = 1; $i <= 4; $i++ ) {
        ${'img' . $i} = isset( $meta_value['img' . $i][$repeater_index] ) ? $meta_value['img' . $i][$repeater_index] : '';
      }
      $headline = $meta_value['headline'][$repeater_index];
      $desc = isset( $meta_value['desc'][$repeater_index] ) ? $meta_value['desc'][$repeater_index] : '';
  ?>
	<div class="repeater-item ui-sortable-handle">
	  <table class="block-contents-table">
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header"><?php _e( 'Layout', 'tcd-w' ); ?></th>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/concept-B-type1.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[layout][<?php echo $repeater_index; ?>]" value="type1" <?php checked( 'type1', $layout ); ?>><?php _e( 'Type1', 'tcd-w' ); ?></label>
        </td>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/concept-B-type2.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[layout][<?php echo $repeater_index; ?>]" value="type2" <?php checked( 'type2', $layout ); ?>><?php _e( 'Type2', 'tcd-w' ); ?></label>
        </td>
	  	</tr>
      <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
	    <tr class="block-contents-table__row">
        <th class="block-contents-table__header"><?php echo $i; ?></th>
        <td><?php _e( 'Recommended size: width 570px, height 570px', 'tcd-w' ); ?></td>
        <td class="u-center">
	  			<div class="cf cf_media_field hide-if-no-js">
	  				<input type="hidden" value="<?php echo esc_attr( ${'img' . $i} ); ?>" id="<?php echo esc_attr( $field['id'] ); ?>_img<?php echo $i; ?>_<?php echo $repeater_index; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[img<?php echo $i; ?>][]" class="cf_media_id">
	  				<div class="preview_field">
              <?php if ( ${'img' . $i} ) { echo wp_get_attachment_image( ${'img' . $i}, 'medium' ); } ?>
            </div>
	  				<div class="button_area">
	  					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
	  					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button<?php if ( ! ${'img' . $i} ) { echo ' hidden'; } ?>">
	  				</div>
	  			</div>
        </td>
	  	</tr>
      <?php endfor; ?>
	    <tr class="block-contents-table__row">
	  		<th rowspan="2" class="block-contents-table__header">5</th>
        <td><?php _e( 'Headline', 'tcd-w' ); ?></td>
        <td>
          <input class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[headline][]" value="<?php echo esc_attr( $headline ); ?>">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description', 'tcd-w' ); ?><br /><span class="desc"><?php _e('You can use HTML tags.', 'tcd-w'); ?></span></td>
        <td>
          <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[desc][]"><?php echo esc_textarea( $desc ); ?></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header"><?php _e( 'Delete', 'tcd-w' ); ?></th>
        <td colspan="2" class="u-center">
          <p class="delete-row">
            <a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a>
          </p>
        </td>
	  	</tr>
	  </table>
  </div>
  <?php
    endforeach;
  } else {
		//echo $clone . "\n";
  }

  echo '</div>';
  echo ' <a href="#" class="button button-secondary button-add-row" data-clone="' . esc_attr( $clone ) . '">' . __( 'Add item', 'tcd-w' ) . '</a>';
  echo '</div>';

}

function render_type2_f( $field, $meta_value ) {

  $key = 'addindex';
  ob_start();
  ?>
  <div id="topt_repeater-<?php echo $key; ?>" class="repeater-item">
	  <table class="block-contents-table">
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header"><?php _e( 'Layout', 'tcd-w' ); ?></th>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/concept-F-type1.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[layout][<?php echo $key; ?>]" value="type1" checked="checked"><?php _e( 'Type1', 'tcd-w' ); ?></label>
        </td>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/concept-F-type2.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[layout][<?php echo $key; ?>]" value="type2"><?php _e( 'Type2', 'tcd-w' ); ?></label>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th rowspan="2" class="block-contents-table__header">1</th>
        <td><?php _e( 'Headline', 'tcd-w' ); ?></td>
        <td>
          <textarea class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[headline][]"></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description', 'tcd-w' ); ?><br /><span class="desc"><?php _e('You can use HTML tags.', 'tcd-w'); ?></span></td>
        <td>
          <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[desc][]"></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <th class="block-contents-table__header">2</th>
        <td><?php _e( 'Recommended size: width 570px, height 370px', 'tcd-w' ); ?></td>
        <td class="u-center">
	  			<div class="cf cf_media_field hide-if-no-js">
            <input type="hidden" value="" id="<?php echo esc_attr( $field['id'] ); ?>_img_<?php echo $key; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[img][]" class="cf_media_id">
	  				<div class="preview_field"></div>
	  				<div class="button_area">
	  					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
	  					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button hidden">
	  				</div>
	  			</div>
        </td>
      </tr>
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header"><?php _e( 'Delete', 'tcd-w' ); ?></th>
        <td colspan="2" class="u-center">
          <p class="delete-row">
            <a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a>
          </p>
        </td>
	  	</tr>
	  </table>
  </div>
  <?php
	$clone = ob_get_clean();

	echo '<div class="repeater-wrapper" data-delete-confirm="' . __( 'Delete?', 'tcd-w' ) . '">' . "\n";
	echo '<div class="repeater ui-sortable">' . "\n";

  $meta_value = maybe_unserialize( $meta_value );

  if ( isset( $meta_value['headline'][0] ) ) {

    foreach( array_keys( $meta_value['headline'] ) as $repeater_index ) :

      $layout = isset( $meta_value['layout'][$repeater_index] ) ? $meta_value['layout'][$repeater_index] : 'type1';
      $img = isset( $meta_value['img'][$repeater_index] ) ? $meta_value['img'][$repeater_index] : '';
      $headline = $meta_value['headline'][$repeater_index];
      $desc = isset( $meta_value['desc'][$repeater_index] ) ? $meta_value['desc'][$repeater_index] : '';
  ?>
	<div class="repeater-item ui-sortable-handle">
	  <table class="block-contents-table">
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header"><?php _e( 'Layout', 'tcd-w' ); ?></th>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/concept-F-type1.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[layout][<?php echo $repeater_index; ?>]" value="type1" <?php checked( 'type1', $layout ); ?>><?php _e( 'Type1', 'tcd-w' ); ?></label>
        </td>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/concept-F-type2.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[layout][<?php echo $repeater_index; ?>]" value="type2" <?php checked( 'type2', $layout ); ?>><?php _e( 'Type2', 'tcd-w' ); ?></label>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th rowspan="2" class="block-contents-table__header">1</th>
        <td><?php _e( 'Headline', 'tcd-w' ); ?></td>
        <td>
          <textarea class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[headline][]"><?php echo esc_attr( $headline ); ?></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description', 'tcd-w' ); ?><br /><span class="desc"><?php _e('You can use HTML tags.', 'tcd-w'); ?></span></td>
        <td>
          <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[desc][]"><?php echo esc_textarea( $desc ); ?></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <th class="block-contents-table__header">2</th>
        <td><?php _e( 'Recommended size: width 570px, height 370px', 'tcd-w' ); ?></td>
        <td class="u-center">
	  			<div class="cf cf_media_field hide-if-no-js">
	  				<input type="hidden" value="<?php echo esc_attr( $img ); ?>" id="<?php echo esc_attr( $field['id'] ); ?>_img_<?php echo $repeater_index; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[img][]" class="cf_media_id">
	  				<div class="preview_field">
              <?php if ( $img ) { echo wp_get_attachment_image( $img, 'medium' ); } ?>
            </div>
	  				<div class="button_area">
	  					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
	  					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button<?php if ( ! $img ) { echo ' hidden'; } ?>">
	  				</div>
	  			</div>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header"><?php _e( 'Delete', 'tcd-w' ); ?></th>
        <td colspan="2" class="u-center">
          <p class="delete-row">
            <a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a>
          </p>
        </td>
	  	</tr>
	  </table>
  </div>
  <?php
    endforeach;
  } else {
		//echo $clone . "\n";
  }

  echo '</div>';
  echo ' <a href="#" class="button button-secondary button-add-row" data-clone="' . esc_attr( $clone ) . '">' . __( 'Add item', 'tcd-w' ) . '</a>';
  echo '</div>';

}

function render_type4_d_plan_list( $field, $meta_value ) {

  $meta_value = maybe_unserialize( $meta_value );

  $key = 'addindex';
  ob_start();
  ?>
  <tr class="a-table__row repeater-item">
  <th class="a-table__h"></th>
    <td class="a-table__col"><input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[data][]" value="" class="widefat"></td>
    <td class="a-table__col a-table__delete col-delete">
      <a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete', 'tcd-w' ); ?></a>
    </td>
  </tr>
  <?php $clone = ob_get_clean(); ?>

  <?php
  $name = isset( $meta_value['name'] ) ? $meta_value['name'] : '';
  $name_bg = isset( $meta_value['name_bg'] ) ? $meta_value['name_bg'] : '#a19283';
  $strong = isset( $meta_value['strong'] ) ? $meta_value['strong'] : 0;
  $price = isset( $meta_value['price'] ) ? $meta_value['price'] : '';
  $price_bg = isset( $meta_value['price_bg'] ) ? $meta_value['price_bg'] : '#ece9e6';
  $price_color = isset( $meta_value['price_color'] ) ? $meta_value['price_color'] : '#442506';
  $unit = isset( $meta_value['unit'] ) ? $meta_value['unit'] : '';
  $per = isset( $meta_value['per'] ) ? $meta_value['per'] : '';
  ?>
  <div class="repeater-wrapper" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
    <table class="a-table a-table--border repeater">
      <tbody>
        <tr class="a-table__row">
          <th class="a-table__h a-table__col"><?php _e( 'Plan name', 'tcd-w' ); ?></th>
          <td class="a-table__col" colspan="2">
            <input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[name]" value="<?php echo esc_attr( $name ); ?>" class="large-text">
          </td>
        </tr>
        <tr class="a-table__row">
          <th class="a-table__h a-table__col"><?php _e( 'Background color of the plan name', 'tcd-w' ); ?></th>
          <td class="a-table__col" colspan="2">
            <p><input type="text" class="c-color-picker" name="<?php echo esc_attr( $field['id'] ); ?>[name_bg]" value="<?php echo esc_attr( $name_bg ); ?>" class="large-text" data-default-color="#a19283"></p>
            <p><label><input type="checkbox" name="<?php echo esc_attr( $field['id'] ); ?>[strong]" value="1" <?php checked( 1, $strong ); ?>> <?php _e( 'Apply this color to borders to emphasize the table', 'tcd-w' ); ?></label></p>
          </td>
        </tr>
        <tr class="a-table__row">
          <th class="a-table__h a-table__col"><?php _e( 'Plan price', 'tcd-w' ); ?></th>
          <td class="a-table__col" colspan="2">
            <input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[price]" value="<?php echo esc_attr( $price ); ?>" class="large-text">
          </td>
        </tr>
        <tr class="a-table__row">
          <th class="a-table__h a-table__col"><?php _e( 'Background color of the plan price', 'tcd-w' ); ?></th>
          <td class="a-table__col" colspan="2">
            <input type="text" class="c-color-picker" name="<?php echo esc_attr( $field['id'] ); ?>[price_bg]" value="<?php echo esc_attr( $price_bg ); ?>" class="large-text" data-default-color="#ece9e6">
          </td>
        </tr>
        <tr class="a-table__row">
          <th class="a-table__h a-table__col"><?php _e( 'Font color of the plan price', 'tcd-w' ); ?></th>
          <td class="a-table__col" colspan="2">
            <input type="text" class="c-color-picker" name="<?php echo esc_attr( $field['id'] ); ?>[price_color]" value="<?php echo esc_attr( $price_color ); ?>" class="large-text" data-default-color="#442506">
          </td>
        </tr>
        <tr class="a-table__row">
          <th class="a-table__h a-table__col"><?php _e( 'Unit of the price', 'tcd-w' ); ?></th>
          <td class="a-table__col" colspan="2">
            <input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[unit]" value="<?php echo esc_attr( $unit ); ?>" class="large-text">
          </td>
        </tr>
        <tr class="a-table__row">
          <th class="a-table__h a-table__col"><?php _e( 'Per month, per week, per day, etc.', 'tcd-w' ); ?></th>
          <td class="a-table__col" colspan="2">
            <input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[per]" value="<?php echo esc_attr( $per ); ?>" class="large-text">
          </td>
        </tr>

        <?php
        if ( isset( $meta_value['data'][0] ) ) :
          foreach( $meta_value['data'] as $repeater_index => $data ) :
        ?>
        <tr class="a-table__row repeater-item">
          <th class="a-table__h"></th>
          <td>
            <input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[data][]" value="<?php echo esc_attr( $data ); ?>" class="widefat">
          </td>
          <td class="a-table__delete col-delete">
            <a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete', 'tcd-w' ); ?></a>
          </td>
        </tr>
        <?php
          endforeach;
        endif;
        ?>
      </tbody>
    </table>
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
  </div>
<?php
}

function render_type4_d_plan_table( $field, $meta_value ) {

  $meta_value = maybe_unserialize( $meta_value );

  $key = 'addindex';
  ob_start();
  ?>
  <tr class="a-table__row repeater-item">
    <td><input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[name][]" value="" class="widefat"></td>
    <td><input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[content][]" value="" class="widefat"></td>
    <td><input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[price][]" value="" class="widefat"></td>
    <td class="a-table__row col-delete">
      <a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete', 'tcd-w' ); ?></a>
    </td>
  </tr>
  <?php $clone = ob_get_clean(); ?>
  <div class="repeater-wrapper" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
    <table class="a-table a-table--border repeater">
    <thead>
      <tr class="a-table__row repeater-item">
        <th class="a-table__h a-table__col"><?php _e( 'Plan name', 'tcd-w' ); ?></th>
        <th class="a-table__h a-table__col"><?php _e( 'Plan content', 'tcd-w' ); ?></th>
        <th class="a-table__h a-table__col"><?php _e( 'Plan price', 'tcd-w' ); ?></th>
        <th class="a-table__h a-table__col"></th>
      </tr>
    </thead>
    <tbody>

    <?php
    if ( isset( $meta_value['name'][0] ) ) :

      foreach( array_keys( $meta_value['name'] ) as $repeater_index ) :

        $name = isset( $meta_value['name'][$repeater_index] ) ? $meta_value['name'][$repeater_index] : '';
        $content = isset( $meta_value['content'][$repeater_index] ) ? $meta_value['content'][$repeater_index] : '';
        $price = isset( $meta_value['price'][$repeater_index] ) ? $meta_value['price'][$repeater_index] : '';
      ?>
      <tr class="a-table__row repeater-item">
        <td>
          <input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[name][]" value="<?php echo esc_attr( $name ); ?>" class="widefat">
        </td>
        <td>
          <input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[content][]" value="<?php echo esc_attr( $content ); ?>" class="widefat">
        </td>
        <td>
          <input type="text" name="<?php echo esc_attr( $field['id'] ); ?>[price][]" value="<?php echo esc_attr( $price ); ?>" class="widefat">
        </td>
        <td class="a-table__delete col-delete">
          <a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete', 'tcd-w' ); ?></a>
        </td>
      </tr>
      <?php
      endforeach;
    endif;
  ?>
  </tbody>
  </table>
  <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
</div>
<?php
}

function render_type4_g( $field, $meta_value ) {

  $icon_type_options = array(
    'type1' => array( 'value' => 'type1', 'label' => __( 'Icon font', 'tcd-w' ) ),
    'type2' => array( 'value' => 'type2', 'label' => __( 'Icon image', 'tcd-w' ) )
  );

  $icon_font_options = array(
    'bookmark',
    'building',
    'vcard-o',
    'gift',
    'cubes',
    'music',
    'check-square-o',
    'font',
    'tv',
    'plug',
    'wifi',
    'pencil',
    'file-text',
    'signal',
    'cogs',
    'globe',
    'lightbulb',
    'cube',
    'tasks',
    'live_help'
  );

  $meta_value = maybe_unserialize( $meta_value );

  $key = 'addindex';
  ob_start();
  ?>
  <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
    <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
	  <div class="sub_box_content">
      <h5 class="theme_option_headline2"><?php _e( 'Icon type', 'tcd-w' ); ?></h5>
      <?php foreach ( $icon_type_options as $option ) : ?>
      <p><label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[icon_type][<?php echo $key; ?>]" value="<?php echo esc_attr( $option['value'] ); ?>"<?php if ( 'type1' === $option['value'] ) { echo ' checked="checked"'; } ?>><?php echo esc_html( $option['label'] ); ?></label></p>
      <?php endforeach; ?>
      <h5 class="theme_option_headline2"><?php _e( 'Icon font', 'tcd-w' ); ?></h5>
      <ul class="a-icon-list">
      <?php foreach ( $icon_font_options as $option ) : ?>
      <li class="a-icon-list__item a-icon-list__item--<?php echo esc_attr( $option ); ?>">
        <label>
          <span></span>
          <input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[icon_font][<?php echo $key; ?>]" value="<?php echo esc_attr( $option ); ?>"<?php if ( 'bookmark' === $option ) { echo ' checked="checked"'; } ?>>
        </label>
      <?php endforeach; ?>
      </ul>

      <h5 class="theme_option_headline2"><?php _e( 'Icon image', 'tcd-w' ); ?></h5>
	  	<div class="cf cf_media_field hide-if-no-js">
      <input type="hidden" value="" id="<?php echo esc_attr( $field['id'] ); ?>_icon_img_<?php echo $key; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[icon_img][<?php echo $key; ?>]" class="cf_media_id">
	  		<div class="preview_field"></div>
	  		<div class="button_area">
	  			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button hidden">
	  		</div>
	  	</div>

      <h5 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h5>
      <p class="desc"><?php _e('You can use HTML tags.', 'tcd-w'); ?></p>
      <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[desc][<?php echo $key; ?>]"></textarea>
      <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
		</div>
  </div>
	<?php $clone = ob_get_clean(); ?>

  <div class="repeater-wrapper" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
    <div class="repeater sortable">

    <?php
    if ( isset( $meta_value['desc'][0] ) ) :
      foreach( array_keys( $meta_value['desc'] ) as $repeater_index ) :

      $icon_type = isset( $meta_value['icon_type'][$repeater_index] ) ? $meta_value['icon_type'][$repeater_index] : 'type1';
      $icon_font = isset( $meta_value['icon_font'][$repeater_index] ) ? $meta_value['icon_font'][$repeater_index] : 'type1';
      $icon_img = isset( $meta_value['icon_img'][$repeater_index] ) ? $meta_value['icon_img'][$repeater_index] : '';
      $desc = $meta_value['desc'][$repeater_index];
    ?>
    <div class="sub_box repeater-item repeater-item-<?php echo $repeater_index; ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-w' ); ?><?php echo $repeater_index + 1; ?></h4>
	    <div class="sub_box_content">
        <h5 class="theme_option_headline2"><?php _e( 'Icon type', 'tcd-w' ); ?></h5>
        <?php foreach ( $icon_type_options as $option ) : ?>
        <p><label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[icon_type][<?php echo $repeater_index; ?>]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $icon_type, $option['value'] ); ?>><?php echo esc_html( $option['label'] ); ?></label></p>
        <?php endforeach; ?>
        <h5 class="theme_option_headline2"><?php _e( 'Icon font', 'tcd-w' ); ?></h5>
        <ul class="a-icon-list">
        <?php foreach ( $icon_font_options as $option ) : ?>
        <li class="a-icon-list__item a-icon-list__item--<?php echo esc_attr( $option ); ?>">
          <label>
            <span></span>
            <input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[icon_font][<?php echo $repeater_index; ?>]" value="<?php echo esc_attr( $option ); ?>" <?php checked( $icon_font, $option ); ?>>
          </label>
        <?php endforeach; ?>
        </ul>

        <h5 class="theme_option_headline2"><?php _e( 'Icon image', 'tcd-w' ); ?></h5>
	    	<div class="cf cf_media_field hide-if-no-js">
        <input type="hidden" value="<?php echo esc_attr( $icon_img ); ?>" id="<?php echo esc_attr( $field['id'] ); ?>_icon_img_<?php echo $repeater_index; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[icon_img][<?php echo $repeater_index; ?>]" class="cf_media_id">
          <div class="preview_field">
            <?php if ( $icon_img ) { echo wp_get_attachment_image( $icon_img, 'medium' ); } ?>
          </div>
	    		<div class="button_area">
	    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button<?php if ( ! $icon_img ) : ?> hidden><?php endif; ?>">
	    		</div>
	    	</div>

        <h5 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h5>
        <p class="desc"><?php _e('You can use HTML tags.', 'tcd-w'); ?></p>
        <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[desc][<?php echo $repeater_index; ?>]"><?php echo esc_textarea( $desc ); ?></textarea>
        <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
	  	</div>
    </div>
    <?php
      endforeach;
    endif;
    ?>
    </div>
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php  _e( 'Add item', 'tcd-w' ); ?></a>
  </div>
  <?php
}


function render_type3_block( $field, $meta_value ) {

  $key = 'addindex';
  ob_start();
  ?>
  <div id="topt_repeater-<?php echo $key; ?>" class="repeater-item">
	  <table class="block-contents-table">
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header">1</th>
        <td><?php _e( 'Headline', 'tcd-w' ); ?></td>
        <td>
          <input class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[headline][]" value="">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header">2</th>
        <td><?php _e( 'Recommended size: width 1180px, height 430px', 'tcd-w' ); ?></td>
        <td class="u-center">
	  			<div class="cf cf_media_field hide-if-no-js">
	  				<input type="hidden" value="" id="<?php echo esc_attr( $field['id'] ); ?>_img_<?php echo $key; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[img][]" class="cf_media_id">
	  				<div class="preview_field"></div>
	  				<div class="button_area">
	  					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
	  					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button hidden">
	  				</div>
	  			</div>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th rowspan="4" class="block-contents-table__header">3</th>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/floor-B-1-type1.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[b1_layout][<?php echo $key; ?>]" value="type1" checked="checked"><?php _e( 'Type1', 'tcd-w' ); ?></label>
        </td>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/floor-B-1-type2.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[b1_layout][<?php echo $key; ?>]" value="type2"><?php _e( 'Type2', 'tcd-w' ); ?></label>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Recommended size: width 490px, height 360px', 'tcd-w' ); ?></td>
        <td class="u-center">
	  			<div class="cf cf_media_field hide-if-no-js">
	  				<input type="hidden" value="" id="<?php echo esc_attr( $field['id'] ); ?>_b1_img_<?php echo $key; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[b1_img][]" class="cf_media_id">
	  				<div class="preview_field"></div>
	  				<div class="button_area">
	  					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
	  					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button hidden">
	  				</div>
	  			</div>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Headline', 'tcd-w' ); ?></td>
        <td>
          <input class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[b1_headline][]" value="">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description', 'tcd-w' ); ?><br /><span class="desc"><?php _e('You can use HTML tags.', 'tcd-w'); ?></span></td>
        <td>
          <textarea class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[b1_desc][]"></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th rowspan="4" class="block-contents-table__header">4</th>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/floor-B-2-type1.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[b2_layout][<?php echo $key; ?>]" value="type1" checked="checked"><?php _e( 'Type1', 'tcd-w' ); ?></label>
        </td>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/floor-B-2-type2.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[b2_layout][<?php echo $key; ?>]" value="type2"><?php _e( 'Type2', 'tcd-w' ); ?></label>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Recommended size: width 570px, height 370px', 'tcd-w' ); ?></td>
        <td class="u-center">
	  			<div class="cf cf_media_field hide-if-no-js">
	  				<input type="hidden" value="" id="<?php echo esc_attr( $field['id'] ); ?>_b2_img_<?php echo $key; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[b2_img][]" class="cf_media_id">
	  				<div class="preview_field"></div>
	  				<div class="button_area">
	  					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
	  					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button hidden">
	  				</div>
	  			</div>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Headline', 'tcd-w' ); ?></td>
        <td>
          <input class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[b2_headline][]" value="">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description', 'tcd-w' ); ?><br /><span class="desc"><?php _e('You can use HTML tags.', 'tcd-w'); ?></span></td>
        <td>
          <textarea class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[b2_desc][]"></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th rowspan="6" class="block-contents-table__header">5</th>
        <td><?php _e( 'Headline in 5-1', 'tcd-w' ); ?></td>
        <td>
          <input type="text" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_headline_1][]" value="">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description in 5-1', 'tcd-w' ); ?></td>
        <td>
          <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_desc_1][]"></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Headline in 5-2', 'tcd-w' ); ?></td>
        <td>
          <input type="text" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_headline_2][]" value="">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description in 5-2', 'tcd-w' ); ?></td>
        <td>
          <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_desc_2][]"></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Headline in 5-3', 'tcd-w' ); ?></td>
        <td>
          <input type="text" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_headline_3][]" value="">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description in 5-3', 'tcd-w' ); ?></td>
        <td>
          <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_desc_3][]"></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header"><?php _e( 'Delete', 'tcd-w' ); ?></th>
        <td colspan="2" class="u-center">
          <p class="delete-row">
            <a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a>
          </p>
        </td>
	  	</tr>
	  </table>
  </div>
  <?php
	$clone = ob_get_clean();

	echo '<div class="repeater-wrapper" data-delete-confirm="' . __( 'Delete?', 'tcd-w' ) . '">' . "\n";
	echo '<div class="repeater ui-sortable">' . "\n";

  $meta_value = maybe_unserialize( $meta_value );

  if ( isset( $meta_value['headline'][0] ) ) {

    foreach( array_keys( $meta_value['headline'] ) as $repeater_index ) :

      $headline = $meta_value['headline'][$repeater_index];
      $img = isset( $meta_value['img'][$repeater_index] ) ? $meta_value['img'][$repeater_index] : '';

      $b1_layout = isset( $meta_value['b1_layout'][$repeater_index] ) ? $meta_value['b1_layout'][$repeater_index] : 'type1';
      $b1_img = isset( $meta_value['b1_img'][$repeater_index] ) ? $meta_value['b1_img'][$repeater_index] : '';
      $b1_headline = isset( $meta_value['b1_headline'][$repeater_index] ) ? $meta_value['b1_headline'][$repeater_index] : '';
      $b1_desc = isset( $meta_value['b1_desc'][$repeater_index] ) ? $meta_value['b1_desc'][$repeater_index] : '';

      $b2_layout = isset( $meta_value['b2_layout'][$repeater_index] ) ? $meta_value['b2_layout'][$repeater_index] : 'type1';
      $b2_img = isset( $meta_value['b2_img'][$repeater_index] ) ? $meta_value['b2_img'][$repeater_index] : '';
      $b2_headline = isset( $meta_value['b2_headline'][$repeater_index] ) ? $meta_value['b2_headline'][$repeater_index] : '';
      $b2_desc = isset( $meta_value['b2_desc'][$repeater_index] ) ? $meta_value['b2_desc'][$repeater_index] : '';

      $b3_headline_1 = isset( $meta_value['b3_headline_1'][$repeater_index] ) ? $meta_value['b3_headline_1'][$repeater_index] : '';
      $b3_desc_1 = isset( $meta_value['b3_desc_1'][$repeater_index] ) ? $meta_value['b3_desc_1'][$repeater_index] : '';
      $b3_headline_2 = isset( $meta_value['b3_headline_2'][$repeater_index] ) ? $meta_value['b3_headline_2'][$repeater_index] : '';
      $b3_desc_2 = isset( $meta_value['b3_desc_2'][$repeater_index] ) ? $meta_value['b3_desc_2'][$repeater_index] : '';
      $b3_headline_3 = isset( $meta_value['b3_headline_3'][$repeater_index] ) ? $meta_value['b3_headline_3'][$repeater_index] : '';
      $b3_desc_3 = isset( $meta_value['b3_desc_3'][$repeater_index] ) ? $meta_value['b3_desc_3'][$repeater_index] : '';

  ?>
	<div class="repeater-item ui-sortable-handle">
	  <table class="block-contents-table">
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header">1</th>
        <td><?php _e( 'Headline', 'tcd-w' ); ?></td>
        <td>
          <input class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[headline][]" value="<?php echo esc_attr( $headline ); ?>">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header">2</th>
        <td><?php _e( 'Recommended size: width 1180px, height 430px', 'tcd-w' ); ?></td>
        <td class="u-center">
	  			<div class="cf cf_media_field hide-if-no-js">
            <input type="hidden" value="<?php echo esc_attr( $img ); ?>" id="<?php echo esc_attr( $field['id'] ); ?>_img_<?php echo $repeater_index; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[img][]" class="cf_media_id">
            <div class="preview_field">
              <?php if ( $img ) { echo wp_get_attachment_image( $img, 'medium' ); } ?>
            </div>
	  				<div class="button_area">
	  					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
              <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button<?php if ( ! $img ) { echo ' hidden'; } ?>">
	  				</div>
	  			</div>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th rowspan="4" class="block-contents-table__header">3</th>
        <?php for ( $i = 1; $i <= 2; $i++ ) : ?>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/floor-B-1-type<?php echo $i; ?>.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[b1_layout][<?php echo $repeater_index; ?>]" value="type<?php echo $i; ?>" <?php checked( $b1_layout, 'type' . $i ); ?>><?php printf( __( 'Type%d', 'tcd-w' ), $i ); ?></label>
        </td>
        <?php endfor; ?>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Recommended size: width 490px, height 360px', 'tcd-w' ); ?></td>
        <td class="u-center">
	  			<div class="cf cf_media_field hide-if-no-js">
            <input type="hidden" value="<?php echo esc_attr( $b1_img ); ?>" id="<?php echo esc_attr( $field['id'] ); ?>_b1_img_<?php echo $repeater_index; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[b1_img][]" class="cf_media_id">
            <div class="preview_field">
              <?php if ( $b1_img ) { echo wp_get_attachment_image( $b1_img, 'medium' ); } ?>
            </div>
	  				<div class="button_area">
	  					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
              <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button<?php if ( ! $b1_img ) { echo ' hidden'; } ?>">
	  				</div>
	  			</div>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Headline', 'tcd-w' ); ?></td>
        <td>
          <input class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[b1_headline][]" value="<?php echo esc_attr( $b1_headline ); ?>">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description', 'tcd-w' ); ?><br /><span class="desc"><?php _e('You can use HTML tags.', 'tcd-w'); ?></span></td>
        <td>
          <textarea class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[b1_desc][]"><?php echo esc_textarea( $b1_desc ); ?></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th rowspan="4" class="block-contents-table__header">4</th>
        <?php for ( $i = 1; $i <= 2; $i++ ) : ?>
        <td class="u-center">
          <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/floor-B-2-type<?php echo $i; ?>.png" alt="">
          </figure>
          <label><input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>[b2_layout][<?php echo $repeater_index; ?>]" value="type<?php echo $i; ?>" <?php checked( $b2_layout, 'type' . $i ); ?>><?php printf( __( 'Type%d', 'tcd-w' ), $i ); ?></label>
        </td>
        <?php endfor; ?>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Recommended size: width 570px, height 370px', 'tcd-w' ); ?></td>
        <td class="u-center">
	  			<div class="cf cf_media_field hide-if-no-js">
            <input type="hidden" value="<?php echo esc_attr( $b2_img ); ?>" id="<?php echo esc_attr( $field['id'] ); ?>_b2_img_<?php echo $repeater_index; ?>" name="<?php echo esc_attr( $field['id'] ); ?>[b2_img][]" class="cf_media_id">
            <div class="preview_field">
              <?php if ( $b2_img ) { wp_get_attachment_image( $b2_img, 'medium' ); } ?>
            </div>
	  				<div class="button_area">
	  					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
              <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button<?php if ( ! $b2_img ) { echo ' hidden'; } ?>">
	  				</div>
	  			</div>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Headline', 'tcd-w' ); ?></td>
        <td>
          <input class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[b2_headline][]" value="<?php echo esc_attr( $b2_headline ); ?>">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description', 'tcd-w' ); ?><br /><span class="desc"><?php _e('You can use HTML tags.', 'tcd-w'); ?></span></td>
        <td>
          <textarea class="large-text" type="text" name="<?php echo esc_attr( $field['id'] ); ?>[b2_desc][]"><?php echo esc_textarea( $b2_desc ); ?></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th rowspan="6" class="block-contents-table__header">5</th>
        <td><?php _e( 'Headline in 5-1', 'tcd-w' ); ?></td>
        <td>
          <input type="text" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_headline_1][]" value="<?php echo esc_attr( $b3_headline_1 ); ?>">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description in 5-1', 'tcd-w' ); ?></td>
        <td>
          <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_desc_1][]"><?php echo esc_textarea( $b3_desc_1 ); ?></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Headline in 5-2', 'tcd-w' ); ?></td>
        <td>
          <input type="text" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_headline_2][]" value="<?php echo esc_attr( $b3_headline_2 ); ?>">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description in 5-2', 'tcd-w' ); ?></td>
        <td>
          <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_desc_2][]"><?php echo esc_textarea( $b3_desc_2 ); ?></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Headline in 5-3', 'tcd-w' ); ?></td>
        <td>
          <input type="text" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_headline_3][]" value="<?php echo esc_attr( $b3_headline_3 ); ?>">
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
        <td><?php _e( 'Description in 5-3', 'tcd-w' ); ?></td>
        <td>
          <textarea rows="4" class="large-text" name="<?php echo esc_attr( $field['id'] ); ?>[b3_desc_3][]"><?php echo esc_textarea( $b3_desc_3 ); ?></textarea>
        </td>
	  	</tr>
	    <tr class="block-contents-table__row">
	  		<th class="block-contents-table__header"><?php _e( 'Delete', 'tcd-w' ); ?></th>
        <td colspan="2" class="u-center">
          <p class="delete-row">
            <a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a>
          </p>
        </td>
	  	</tr>
	  </table>
  </div>
  <?php
    endforeach;
  } else {
		//echo $clone . "\n";
  }

  echo '</div>';
  echo ' <a href="#" class="button button-secondary button-add-row" data-clone="' . esc_attr( $clone ) . '">' . __( 'Add item', 'tcd-w' ) . '</a>';
  echo '</div>';

}
