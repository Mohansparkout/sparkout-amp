<?php
$args = array(
    'name' => 'Contact Location',
    'base' => 'cms_contact_location',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(
        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_contact_location',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'admin_label' => true,
            'std' => 'cms_contact_location.php',
            'group' => esc_html__('Template', 'optime'),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Contact Locations', 'optime' ),
            'param_name' => 'cms_locations',
            'description' => esc_html__( 'Enter values for contact location item', 'optime' ),
            'value' => '',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Image', 'optime'),
                    'param_name' => 'ctl_image',
                    'value' => '',
                    'description' => esc_html__('Select image from media library.', 'optime'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Location', 'optime'),
                    'param_name' => 'ctl_location',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Phone', 'optime'),
                    'param_name' => 'ctl_phone',
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Email', 'optime'),
                    'param_name' => 'ctl_email',
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Address', 'optime'),
                    'param_name' => 'ctl_address',
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Hours Open', 'optime'),
                    'param_name' => 'ctl_hours',
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Button Link', 'optime' ),
                    'param_name' => 'ctl_link',
                    'value' => '',
                ),
            ),
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
    ));
$args = optime_add_vc_extra_param($args);
vc_map($args);

class WPBakeryShortCode_cms_contact_location extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
?>