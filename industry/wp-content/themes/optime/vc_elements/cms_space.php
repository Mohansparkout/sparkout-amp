<?php
vc_map(array(
    "name" => 'Space',
    "base" => "cms_space",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('Theme Shortcodes', 'optime'),
    "params" => array(

        array(
            "type" => "textfield",
            "heading" => esc_html__("Space LG Devices", 'optime'),
            "param_name" => "space_lg",
            "description" => "Enter number."
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Space MD Devices", 'optime'),
            "param_name" => "space_md",
            "description" => "Enter number."
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Space SM Devices", 'optime'),
            "param_name" => "space_sm",
            "description" => "Enter number."
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Space XS Devices", 'optime'),
            "param_name" => "space_xs",
            "description" => "Enter number."
        ),

    )
));

class WPBakeryShortCode_cms_space extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>