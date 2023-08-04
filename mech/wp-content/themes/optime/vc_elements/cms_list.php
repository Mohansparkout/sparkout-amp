<?php
vc_map(array(
    "name" => 'List',
    "base" => "cms_list",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('Theme Shortcodes', 'optime'),
    "params" => array(
        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_list',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'admin_label' => true,
            'std' => 'cms_list.php',
            'group' => esc_html__('Template', 'optime'),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Lists', 'optime' ),
            'param_name' => 'cms_list',
            'description' => esc_html__( 'Enter values for list item', 'optime' ),
            'value' => '',
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" =>esc_html__("List item text", 'optime'),
                    "param_name" => "cms_list_item",
                    'admin_label' => true,
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Link', 'optime' ),
                    'param_name' => 'cms_list_link',
                    'value' => '',
                    'admin_label' => true,
                ),
            ),
        ),

        array(
            "type" => "textfield",
            "heading" =>esc_html__("Font Size", 'optime'),
            "param_name" => "cms_list_fontsize",
            'value' => '',
            "description" => "Enter: ...px;"
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Font Weight', 'optime'),
            'param_name' => 'cms_list_font_weight',
            'value' => array(
                'Bold' => '700',
                'SemiBold' => '600',
                'Medium' => '500',
                'Normal' => '400',
            ),
            'std' => '700',
        ),
        array(
            "type" => "colorpicker",
            "heading" =>esc_html__("List item Color", 'optime'),
            "param_name" => "cms_list_color",
            'value' => '',
            'std'   => '',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Library', 'optime' ),
            'value' => array(
                esc_html__( 'Font Awesome', 'optime' ) => 'fontawesome',
                esc_html__( 'Material Icon', 'optime' ) => 'materialdesign',
            ),
            'param_name' => 'icon_list',
            'description' => esc_html__( 'Select icon library.', 'optime' ),
            'group' => esc_html__('Icon', 'optime'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon FontAwesome', 'optime' ),
            'param_name' => 'icon_fontawesome',
            'value' => '',
            'std' => '',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'fontawesome',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'fontawesome',
            ),
            'description' => esc_html__( 'Select icon from library.', 'optime' ),
            'group' => esc_html__('Icon', 'optime'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon Material', 'optime' ),
            'param_name' => 'icon_material',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'material-design',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'materialdesign',
            ),
            'description' => esc_html__( 'Select icon from library.', 'optime' ),
            'group' => esc_html__('Icon', 'optime'),
        ),
        array(
            "type" => "textfield",
            "heading" =>esc_html__("Icon font size", 'optime'),
            "param_name" => "cms_icon_font_size",
            'group' => esc_html__('Icon', 'optime'),
            'value' => '',
            "description" => "Enter: ...px;"
        ),
        array(
            "type" => "colorpicker",
            "heading" =>esc_html__("Icon Color", 'optime'),
            "param_name" => "cms_icon_color",
            'group' => esc_html__('Icon', 'optime'),
            'value' => '',
            'std'   => '',
        ),
    )
));

class WPBakeryShortCode_cms_list extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
?>