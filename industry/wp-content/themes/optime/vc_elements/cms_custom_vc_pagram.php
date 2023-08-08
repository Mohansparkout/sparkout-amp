<?php
/*
 * VC
 */
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("CMS Custom Style", 'optime'),
    "param_name" => "cms_row_class",
    "value" => array(
        'None' => '',
        'Row Overlay' => 'row-overlay',
        'Row Background Color Primary' => 'cms-bg-primary',
        'Row Carousel Stretch Right' => 'row-carousel-stretch-right',
    ),
    "group" => esc_html__("CMS Customs", 'optime'),
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("CMS Row Overflow", 'optime'),
    "param_name" => "cms_row_overflow",
    "value" => array(
        'Overflow Hidden' => '',
        'Overflow Unset' => 'row-overflow-unset',
    ),
    "group" => esc_html__("CMS Customs", 'optime'),
));


vc_add_param("vc_column", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("CMS Custom Style", 'optime'),
    "param_name" => "cms_column_class",
    "value" => array(
        'None' => '',
        'Column Overlay' => 'col-overlay',
    ),
    "group" => esc_html__("CMS Customs", 'optime'),
));

vc_add_param("vc_column_inner",
    array(
        'type' => 'animation_style',
        'heading' => esc_html__( 'Animation', 'optime' ),
        'param_name' => 'animation_column',
        'description' => esc_html__( 'Choose your animation style', 'optime' ),
        'admin_label' => false,
        'weight' => 0,
        "group" => esc_html__("CMS Customs", 'optime'),
    )
);

// VC Image
//--------------------------------------------------
vc_remove_param( 'vc_single_image', 'style' );
vc_add_param("vc_single_image",
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Styles', 'optime' ),
        'param_name' => 'style',
        "value" => array(
            'Default' => 'default',
            'Box Overlay left' => 'box-overlay-left',
            'Box Overlay right' => 'box-overlay-right',
        ),
        "group" => esc_html__("Styles", 'optime'),
    )
);
vc_add_param("vc_single_image",
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Image alignment small (Screen < 767px)', 'optime' ),
        'param_name' => 'cms_image_align',
        "value" => array(
            'Inherit' => 'inherit',
            'Left' => 'image_align_xs_left',
            'Center' => 'image_align_xs_center',
            'Right' => 'image_align_xs_right',
        ),
        "group" => esc_html__("Styles", 'optime'),
    )
);