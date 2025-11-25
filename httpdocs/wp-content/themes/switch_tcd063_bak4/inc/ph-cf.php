<?php
/*
 * Add a meta box of page header
 */

$ph_desc_writing_mode_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Horizontal writing', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Vertical writing', 'tcd-w' ) )
);

$ph_img_animation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Zoom in', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Zoom out', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'None', 'tcd-w' ) )
);

$ph_fields = array(
	array(
		'id' => 'ph_title',
		'title' => __( 'Title', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<div class="tcd_cf_content">',
		'after_field' => '</div>',
		'before_title' => '<div class="tcd_cf_headline">',
		'after_title' => '</div>'
	),
	array(
		'id' => 'ph_desc',
		'title' => __( 'Description', 'tcd-w' ),
		'type' => 'textarea',
		'before_field' => '<div class="tcd_cf_content">',
		'after_field' => '</div>',
		'before_title' => '<div class="tcd_cf_headline">',
		'after_title' => '</div>'
	),
	array(
		'id' => 'ph_desc_font_size',
		'title' => __( 'Font size of the description', 'tcd-w' ),
    'type' => 'number',
    'default' => 40,
    'unit' => 'px',
    'min' => 1,
    'step' => 1,
		'before_field' => '<div class="tcd_cf_content">',
		'after_field' => '</div>',
		'before_title' => '<div class="tcd_cf_headline">',
		'after_title' => '</div>'
	),
	array(
		'id' => 'ph_desc_font_size_sp',
		'title' => __( 'Font size of the description for mobile', 'tcd-w' ),
    'type' => 'number',
    'default' => 18,
    'unit' => 'px',
    'min' => 1,
    'step' => 1,
		'before_field' => '<div class="tcd_cf_content">',
		'after_field' => '</div>',
		'before_title' => '<div class="tcd_cf_headline">',
		'after_title' => '</div>'
	),
	array(
		'id' => 'ph_desc_color',
		'title' => __( 'Font color of the description', 'tcd-w' ),
    'type' => 'color',
    'default' => '#ffffff',
		'before_field' => '<div class="tcd_cf_content">',
		'after_field' => '</div>',
		'before_title' => '<div class="tcd_cf_headline">',
		'after_title' => '</div>'
  ),
	array(
		'id' => 'ph_desc_writing_mode',
		'title' => __( 'Writing mode of the description', 'tcd-w' ),
    'type' => 'radio',
    'default' => 'type1',
    'options' => $ph_desc_writing_mode_options,
		'before_field' => '<div class="tcd_cf_content">',
		'after_field' => '</div>',
		'before_title' => '<div class="tcd_cf_headline">',
		'after_title' => '</div>'
  ),
	array(
		'id' => 'ph_img',
		'title' => __( 'Background image', 'tcd-w' ),
    'description' => __( 'Recommended image size. Width: 1450px, Height: 600px', 'tcd-w' ),
		'type' => 'image',
		'before_field' => '<div class="tcd_cf_content">',
		'after_field' => '</div>',
		'before_title' => '<div class="tcd_cf_headline">',
		'after_title' => '</div>'
	),
	array(
		'id' => 'ph_img_animation_type',
		'title' => __( 'Animation type of the background image', 'tcd-w' ),
    'type' => 'radio',
    'default' => 'type3',
    'options' => $ph_img_animation_type_options,
		'before_field' => '<div class="tcd_cf_content">',
		'after_field' => '</div>',
		'before_title' => '<div class="tcd_cf_headline">',
		'after_title' => '</div>'
  ),
	array(
		'id' => 'ph_overlay',
		'title' => __( 'Color overlay on the background image', 'tcd-w' ),
    'type' => 'color',
    'default' => '#000000',
		'before_field' => '<div class="tcd_cf_content">',
		'after_field' => '</div>',
		'before_title' => '<div class="tcd_cf_headline">',
		'after_title' => '</div>'
	),
	array(
		'id' => 'ph_overlay_opacity',
		'title' => __( 'Opacity of the overlay on the background image', 'tcd-w' ),
    'type' => 'number',
    'default' => 0.5,
    'min' => 0,
    'max' => 1.0,
    'step' => 0.1,
		'before_field' => '<div class="tcd_cf_content" style="border-bottom:none;">',
		'after_field' => '</div>',
		'before_title' => '<div class="tcd_cf_headline">',
		'after_title' => '</div>'
	),
);
$ph_args = array(
	'id' => 'ph_meta_box',
	'title' => __( 'Page header settings', 'tcd-w' ),
	'screen' => array( 'page' ),
	'context' => 'normal',
	'fields' => $ph_fields
);
$ph_meta_box = new TCD_Meta_Box( $ph_args );
