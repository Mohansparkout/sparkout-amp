<?php
vc_map(array(
    'name' => 'Fancy Box',
    'base' => 'cms_fancybox',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(
        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_fancybox',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'std' => 'cms_fancybox.php',
            'group' => esc_html__('Template', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Extra class name', 'optime'),
            'param_name' => 'el_class',
            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in Custom CSS.', 'optime'),
            'group' => esc_html__('Template', 'optime')
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__('Animation Style', 'optime'),
            'param_name' => 'animation',
            'description' => esc_html__('Choose your animation style', 'optime'),
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
            'heading' => esc_html__('Parallax Speed', 'optime'),
            'param_name' => 'el_parallax_speed',
            'value' => '',
            'description' => esc_html__('Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'optime'),
            'group' => esc_html__('Template', 'optime'),
            'dependency' => array(
                'element' => 'el_parallax',
                'value' => array(
                    'true',
                )
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Fancybox Background', 'optime'),
            'param_name' => 'background_color',
            'value' => '',
            'group' => esc_html__('Template', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Fancybox Padding', 'optime'),
            'param_name' => 'fancybox_padding',
            'description' => 'Enter padding of fancybox',
            'group' => esc_html__('Template', 'optime'),
        ),
        /* Title */
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Title', 'optime'),
            'param_name' => 'title',
            'description' => 'Enter title.',
            'admin_label' => true,
            'group' => esc_html__('Title', 'optime'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Color', 'optime'),
            'param_name' => 'title_color',
            'value' => '',
            'group' => esc_html__('Title', 'optime'),
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
            'heading' => esc_html__('Margin Top', 'optime'),
            'param_name' => 'title_margin_top',
            'description' => 'Enter ..px',
            'group' => esc_html__('Title', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Line Height', 'optime' ),
            'param_name' => 'title_line_height',
            'value' => '',
            'description' => 'Enter: ..px',
            'group'      => esc_html__('Title', 'optime'),
        ),
        /* Description */
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Description', 'optime'),
            'param_name' => 'description',
            'description' => 'Enter description.',
            'group' => esc_html__('Description', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font Size', 'optime' ),
            'param_name' => 'description_font_size',
            'value' => '',
            'description' => 'Enter: ..px',
            'group'      => esc_html__('Description', 'optime'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Color', 'optime'),
            'param_name' => 'description_color',
            'value' => '',
            'group' => esc_html__('Description', 'optime'),
        ),
        /* Icon */
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Icon Library', 'optime'),
            'value' => array(
                esc_html__('Image Icon', 'optime') => 'image_icon',
                esc_html__('Font Awesome', 'optime') => 'fontawesome',
            ),
            'param_name' => 'icon_list',
            'description' => esc_html__('Select icon library.', 'optime'),
            'group' => esc_html__('Icon', 'optime'),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Image', 'optime'),
            'param_name' => 'image_icon',
            'value' => '',
            'description' => esc_html__('Select image from media library.', 'optime'),
            'group' => esc_html__('Icon', 'optime'),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'image_icon',
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Image max height', 'optime'),
            'param_name' => 'img_max_height',
            'description' => 'Enter ..px',
            'group' => esc_html__('Icon', 'optime'),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'image_icon',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon FontAwesome', 'optime'),
            'param_name' => 'icon_fontawesome',
            'value' => '',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'fontawesome',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'fontawesome',
            ),
            'description' => esc_html__('Select icon from library.', 'optime'),
            'group' => esc_html__('Icon', 'optime'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon Color', 'optime'),
            'param_name' => 'icon_color',
            'value' => '',
            'group' => esc_html__('Icon', 'optime'),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => array(
                    'fontawesome',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Icon Font Size', 'optime'),
            'param_name' => 'icon_font_size',
            'group' => esc_html__('Icon', 'optime'),
            'description' => 'Enter ..px',
            'dependency' => array(
                'element' => 'icon_list',
                'value' => array(
                    'fontawesome',
                )
            ),
        ),
    )
));

class WPBakeryShortCode_cms_fancybox extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>