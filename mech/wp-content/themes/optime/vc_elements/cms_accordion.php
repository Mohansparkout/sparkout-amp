<?php
vc_map(array(
    'name' => 'Accordion',
    'base' => 'cms_accordion',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(
        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_accordion',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'admin_label' => true,
            'std' => 'cms_accordion.php',
            'group' => esc_html__('Template', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' =>esc_html__('Active section', 'optime'),
            'param_name' => 'active_section',
            'description' => 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).',
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Accordion Items', 'optime' ),
            'param_name' => 'cms_accordion',
            'description' => esc_html__( 'Enter values for accordion item', 'optime' ),
            'value' => '',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Title', 'optime'),
                    'param_name' => 'ac_title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textarea',
                    'heading' =>esc_html__('Content', 'optime'),
                    'param_name' => 'ac_content',
                ),
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title Font Size', 'optime' ),
            'param_name' => 'title_font_size',
            'value' => '',
            'description' => 'Enter: ..px',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Title color', 'optime' ),
            'param_name' => 'title_color'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Content color', 'optime' ),
            'param_name' => 'content_color'
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

class WPBakeryShortCode_cms_accordion extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
?>