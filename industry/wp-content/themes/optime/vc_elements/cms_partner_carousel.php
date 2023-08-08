<?php
$args = array(
    'name' => 'Partner Carousel',
    'base' => 'cms_partner_carousel',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(

        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_partner_carousel',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'admin_label' => true,
            'group' => esc_html__('Template', 'optime'),
            'std' => 'cms_partner_carousel.php'
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
            'param_name' => 'partner_item',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Image', 'optime' ),
                    'param_name' => 'image',
                    'value' => '',
                    'description' => esc_html__( 'Select image from media library.', 'optime' ),
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Link', 'optime' ),
                    'param_name' => 'link',
                    'value' => '',
                    'admin_label' => true,
                ),
            ),
        ),

    ));

$args = optime_add_vc_extra_param($args);
vc_map($args);

class WPBakeryShortCode_cms_partner_carousel extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>