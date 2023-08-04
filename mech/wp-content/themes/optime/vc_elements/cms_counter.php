<?php
vc_map(array(
    'name' => 'Counter',
    'base' => 'cms_counter',
    'icon' => 'cs_icon_for_vc',
    'class' => 'cms-vc-icon',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(

        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_counter',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'admin_label' => true,
            'std' => 'cms_counter.php',
            'group' => esc_html__('Template', 'optime'),
        ),
        //Icon
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Icon Image', 'optime' ),
            'param_name' => 'icon_image',
            'value' => '',
            'description' => esc_html__( 'Select icon image from media library.', 'optime' ),
            'group' => esc_html__('Icon', 'optime'),
        ),
        /* Digit */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Digit', 'optime'),
            'param_name' => 'digit',
            'description' => 'Enter digit.',
            'group' => esc_html__('Digit', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Prefix', 'optime'),
            'param_name' => 'prefix',
            'description' => 'Enter prefix.',
            'group' => esc_html__('Digit', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Suffix', 'optime'),
            'param_name' => 'suffix',
            'description' => 'Enter suffix.',
            'group' => esc_html__('Digit', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font size digit', 'optime' ),
            'param_name' => 'fontsize_digit',
            'value' => '',
            'group' => esc_html__('Digit', 'optime'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Color digit', 'optime' ),
            'param_name' => 'color_digit',
            'value' => '',
            'group' => esc_html__('Digit', 'optime'),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Use Grouping', 'optime'),
            'param_name' => 'grouping',
            'value' => array(
                'No' => '0',
                'Yes' => '1',
            ),
            'group' => esc_html__('Digit', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Separator', 'optime'),
            'param_name' => 'separator',
            'group' => esc_html__('Digit', 'optime'),
            'dependency' => array(
                'element'=>'grouping',
                'value'=>array(
                    '1',
                )
            ),
        ),
        /* Title */
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Title', 'optime'),
            'param_name' => 'title',
            'description' => 'Enter title.',
            'group' => esc_html__('Title', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font size title', 'optime' ),
            'param_name' => 'fontsize_title',
            'value' => '',
            'group' => esc_html__('Title', 'optime'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Color title', 'optime' ),
            'param_name' => 'color_title',
            'value' => '',
            'group' => esc_html__('Title', 'optime'),
        ),
        /* Extra */
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'optime' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'optime' ),
            'group'            => esc_html__('Extra', 'optime')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Width', 'optime'),
            'param_name' => 'width',
            'value' => '',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_counter.php',
                )
            ),
            'description' => esc_html__('With of counter with pixel, default is 230px', 'optime')
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Background Color', 'optime' ),
            'param_name' => 'background',
            'value' => '',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_counter.php',
                )
            ),
            'group' => esc_html__('Extra', 'optime'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Border Color', 'optime' ),
            'param_name' => 'border_color',
            'value' => '',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_counter.php',
                )
            ),
            'group' => esc_html__('Extra', 'optime'),
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation Style', 'optime' ),
            'param_name' => 'animation',
            'description' => esc_html__( 'Choose your animation style', 'optime' ),
            'admin_label' => false,
            'weight' => 0,
            'group' => esc_html__('Extra', 'optime'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element Parallax', 'optime'),
            'param_name' => 'el_parallax',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
            'group' => esc_html__('Extra', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Parallax Speed', 'optime' ),
            'param_name' => 'el_parallax_speed',
            'value' => '',
            'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'optime' ),
            'group' => esc_html__('Extra', 'optime'),
            'dependency' => array(
                'element'=>'el_parallax',
                'value'=>array(
                    'true',
                )
            ),
        ),
    )
));

class WPBakeryShortCode_cms_counter extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>