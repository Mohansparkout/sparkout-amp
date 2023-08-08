<?php
    if(class_exists('WPCF7')) {
        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

        $contact_forms = array();
        if ( $cf7 ) {
            foreach ( $cf7 as $cform ) {
                $contact_forms[ $cform->post_title ] = $cform->ID;
            }
        } else {
            $contact_forms[ esc_html__( 'No contact forms found', 'optime' ) ] = 0;
        }

        vc_map(array(
            'name' => 'Contact Form Tab',
            'base' => 'cms_contact_form_tab',
            'icon' => 'cs_icon_for_vc',
            'category' => esc_html__('Theme Shortcodes', 'optime'),
            'params' => array(
                /* Template */
                array(
                    'type' => 'cms_template_img',
                    'param_name' => 'cms_template',
                    'shortcode' => 'cms_contact_form_tab',
                    'heading' => esc_html__('Shortcode Template', 'optime'),
                    'admin_label' => true,
                    'std' => 'cms_contact_form_tab.php',
                    'group' => esc_html__('Template', 'optime'),
                ),
                array(
                    'type' => 'param_group',
                    'value' => '',
                    'param_name' => 'form_item',
                    'group' => esc_html__('Form Item', 'optime'),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' =>esc_html__('Tab title', 'optime'),
                            'param_name' => 'title',
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__( 'Select contact form', 'optime' ),
                            'param_name' => 'id',
                            'value' => $contact_forms,
                            'save_always' => true,
                            'description' => esc_html__( 'Choose previously created contact form cmsom the drop down list.', 'optime' ),
                        ),
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Tab Shadow Color', 'optime'),
                    'param_name' => 'shadow_color',
                    'value' => '',
                    'group' => esc_html__('Form Item', 'optime'),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__( 'Title', 'optime' ),
                    'param_name' => 'box_title',
                    'value' => '',
                    'admin_label' => true,
                    'group' => esc_html__('Contact Box', 'optime'),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__( 'Description', 'optime' ),
                    'param_name' => 'box_description',
                    'value' => '',
                    'admin_label' => true,
                    'group' => esc_html__('Contact Box', 'optime'),
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Button Link', 'optime' ),
                    'param_name' => 'box_link',
                    'value' => '',
                    'group' => esc_html__('Contact Box', 'optime'),
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

        class WPBakeryShortCode_cms_contact_form_tab extends CmsShortCode
        {

            protected function content($atts, $content = null)
            {
                return parent::content($atts, $content);
            }
        }
    }
?>