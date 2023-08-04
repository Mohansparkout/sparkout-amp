<?php
$args = array(
    'name' => 'Testimonial Carousel',
    'base' => 'cms_testimonial_carousel',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(

        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_testimonial_carousel',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'admin_label' => true,
            'group' => esc_html__('Template', 'optime'),
            'std' => 'cms_testimonial_carousel.php'
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
        /*Layout1*/
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Testimonial Item', 'optime' ),
            'value' => '',
            'param_name' => 'testimonial_item',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Avatar Image', 'optime' ),
                    'param_name' => 'image',
                    'value' => '',
                    'description' => esc_html__( 'Select image from media library.', 'optime' ),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Content', 'optime'),
                    'param_name' => 'content',

                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Name', 'optime'),
                    'param_name' => 'name',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Signature Image', 'optime' ),
                    'param_name' => 'signature_image',
                    'value' => '',
                    'description' => esc_html__( 'Select image from media library.', 'optime' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Position', 'optime'),
                    'param_name' => 'position',
                    'admin_label' => true,

                ),
            ),
        ),
        /*Background color*/
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Background Color', 'optime'),
            'param_name' => 'background',
            'value' => '',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_testimonial_carousel--layout2.php',
                )
            ),
        ),
        /*Title*/
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Title Color', 'optime'),
            'param_name' => 'title_color',
            'value' => '',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_testimonial_carousel.php',
                )
            ),
        ),
        /*Content*/
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Content Color', 'optime'),
            'param_name' => 'content_color',
            'value' => '',
        ),
        /*Name*/
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Name Color', 'optime'),
            'param_name' => 'name_color',
            'value' => '',
        ),
        /*Position*/
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Position Color', 'optime'),
            'param_name' => 'position_color',
            'value' => '',
        ),
    ));

$args = optime_add_vc_extra_param($args);
vc_map($args);

class WPBakeryShortCode_cms_testimonial_carousel extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>