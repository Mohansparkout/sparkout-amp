<?php
vc_map(array(
    'name' => 'Call To Action',
    'base' => 'cms_call_to_action',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_call_to_action',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'admin_label' => true,
            'std' => 'cms_call_to_action.php',
            'group' => esc_html__('Template', 'optime'),
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
            'type' => 'textarea',
            'heading' => esc_html__( 'Title', 'optime' ),
            'param_name' => 'title',
            'value' => '',
            'admin_label' => true,
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Subtitle', 'optime' ),
            'param_name' => 'subtitle',
            'value' => '',
            'admin_label' => true,
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_call_to_action.php',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Button Text', 'optime' ),
            'param_name' => 'button_text',
            'value' => '',
        ),
        array(
            'type' => 'vc_link',
            'class' => '',
            'heading' => esc_html__('Button Link', 'optime'),
            'param_name' => 'button_link',
            'value' => '',
        ),
        //Subtitle
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Color Subtitle', 'optime' ),
            'param_name' => 'color_Subtitle',
            'value' => '',
            'group' => esc_html__('Style', 'optime'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_call_to_action.php',
                    'cms_call_to_action--layout2.php',
                )
            ),
        ),
        //title
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Color title', 'optime' ),
            'param_name' => 'color_title',
            'value' => '',
            'group' => esc_html__('Style', 'optime'),
        ),
    )
));

class WPBakeryShortCode_cms_call_to_action extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>