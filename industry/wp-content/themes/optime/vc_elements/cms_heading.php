<?php
vc_map(array(
    'name' => 'Heading',
    'base' => 'cms_heading',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            "shortcode" => "cms_heading",
            "heading" => esc_html__("Shortcode Template", 'optime'),
            "admin_label" => true,
            "group" => esc_html__("Template", 'optime'),
        ),
        /* Subtitle */
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Subtitle', 'optime' ),
            'param_name' => 'subtitle',
            'value' => '',
            'group'      => esc_html__('Subtitle', 'optime'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_heading--layout2.php',
                    'cms_heading--layout3.php',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font Size', 'optime' ),
            'param_name' => 'subtitle_font_size',
            'value' => '',
            'description' => 'Enter: ..px',
            'group'      => esc_html__('Subtitle', 'optime'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_heading--layout2.php',
                    'cms_heading--layout3.php',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Margin Bottom', 'optime' ),
            'param_name' => 'subtitle_margin_bottom',
            'value' => '',
            'description' => 'Enter: ..px',
            'group'      => esc_html__('Subtitle', 'optime'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_heading--layout2.php',
                    'cms_heading--layout3.php',
                )
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Color', 'optime'),
            'param_name' => 'subtitle_color',
            'value' => '',
            'group'      => esc_html__('Subtitle', 'optime'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_heading--layout2.php',
                    'cms_heading--layout3.php',
                )
            ),
        ),
        /* Title */
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Text', 'optime' ),
            'param_name' => 'text',
            'value' => '',
            'admin_label' => true,
            "group" => esc_html__("Title", 'optime'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element tag', 'optime'),
            'param_name' => 'tag',
            'value' => array(
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
                'p' => 'p',
                'div' => 'div',
            ),
            'std' => 'h2',
            "group" => esc_html__("Title", 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font Size', 'optime' ),
            'param_name' => 'title_font_size',
            'value' => '',
            'description' => 'Enter: ..px',
            'group'      => esc_html__('Title', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Line Height', 'optime' ),
            'param_name' => 'title_line_height',
            'value' => '',
            'description' => 'Enter: ..px',
            'group'      => esc_html__('Title', 'optime'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_heading.php',
                    'cms_heading--layout3.php',
                )
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Font Weight', 'optime'),
            'param_name' => 'font_weight',
            'value' => array(
                'SemiBold' => '600',
                'Normal' => '400',
                'Medium' => '500',
                'Bold' => '700',
            ),
            'std' => '600',
            "group" => esc_html__("Title", 'optime'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Text Color', 'optime'),
            'param_name' => 'text_color',
            'value' => '',
            "group" => esc_html__("Title", 'optime'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Custom Google Fonts', 'optime'),
            'param_name' => 'custom_fonts',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
            "group" => esc_html__("Title", 'optime'),
        ),
        array(
            'type' => 'google_fonts',
            'param_name' => 'google_fonts',
            'value' => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
            'settings' => array(
                'fields' => array(
                    'font_family_description' => esc_html__( 'Select font family.', 'optime' ),
                    'font_style_description' => esc_html__( 'Select font styling.', 'optime' ),
                ),
            ),
            'dependency' => array(
                'element'=>'custom_fonts',
                'value'=>array(
                    'true',
                )
            ),
            "group" => esc_html__("Title", 'optime'),
        ),
        /* Description */
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Description', 'optime' ),
            'param_name' => 'description',
            'value' => '',
            'group'      => esc_html__('Description', 'optime'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_heading--layout2.php',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font Size', 'optime' ),
            'param_name' => 'description_font_size',
            'value' => '',
            'description' => 'Enter: ..px',
            'group'      => esc_html__('Description', 'optime'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_heading--layout2.php',
                )
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Color', 'optime'),
            'param_name' => 'description_color',
            'value' => '',
            'group'      => esc_html__('Description', 'optime'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'cms_heading--layout2.php',
                )
            ),
        ),
        /* Extra */
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'optime' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'optime' ),
            'group'      => esc_html__('Extra', 'optime'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Text', 'optime'),
            'param_name' => 'align_text',
            'value' => array(
                'Left' => 'align-left',
                'Center' => 'align-center',
                'Right' => 'align-right',
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
    )
));

class WPBakeryShortCode_cms_heading extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        $html_id = cmsHtmlID('cms-heading');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>