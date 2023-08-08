<?php
$args = array(
    'name' => 'Recruitment Carousel',
    'base' => 'cms_recruitment_carousel',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(
        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_recruitment_carousel',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'admin_label' => true,
            'group' => esc_html__('Template', 'optime'),
            'std' => 'cms_recruitment_carousel.php'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'optime' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'optime' ),
            'group'            => esc_html__('Template', 'optime')
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation Style', 'optime' ),
            'param_name' => 'animation',
            'description' => esc_html__( 'Choose your animation style', 'optime' ),
            'admin_label' => false,
            'weight' => 0,
            'group' => esc_html__('Template', 'optime'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element Parallax', 'optime'),
            'param_name' => 'el_parallax',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
            'group' => esc_html__('Template', 'optime'),
        ),
        array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Parallax Speed', 'optime' ),
                'param_name' => 'el_parallax_speed',
                'value' => '',
                'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'optime' ),
                'group' => esc_html__('Template', 'optime'),
                'dependency' => array(
                    'element'=>'el_parallax',
                    'value'=>array(
                        'true',
                    )
                ),
            ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Client Item', 'optime' ),
            'value' => '',
            'param_name' => 'recruitment_item',
            'group' => esc_html__('Item Content', 'optime'),
            'params' => array(
                /* Work type */
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Work Type', 'optime'),
                    'param_name' => 'work_type',
                    'value' => array(
                        'Full Time' => 'full time',
                        'Part Time' => 'part time',
                    ),
                ),
                /* Work Location */
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Location', 'optime' ),
                    'param_name' => 'location',
                    'admin_label' => true,
                ),
                /* Title */
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Title', 'optime'),
                    'param_name' => 'title',
                    'description' => 'Enter title.',
                    'admin_label' => true,
                ),
                /* Description */
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Description', 'optime'),
                    'param_name' => 'description',
                    'description' => 'Enter description.',
                ),
                /* Link */
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Button Link', 'optime' ),
                    'param_name' => 'btn_link',
                    'value' => '',
                ),
            ),
        ),
    ));

$args = optime_add_vc_extra_param($args);
vc_map($args);

class WPBakeryShortCode_cms_recruitment_carousel extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>