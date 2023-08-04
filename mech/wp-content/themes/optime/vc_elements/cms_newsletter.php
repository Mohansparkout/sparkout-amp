<?php
/**
 * Newsletter form for VC
 * Require Newsletter plugin to be installed
 *
 * @package Autosmart
 * @since   Autosmart 1.0
 */

if(class_exists('Newsletter')) {
    $forms = array_filter( (array) get_option( 'newsletter_forms', array() ) );

    $forms_list = array(
        esc_html__( 'Default Form', 'optime' ) => 'default'
    );

    if ( $forms )
    {
        $index = 1;
        foreach ( $forms as $key => $form )
        {
            $forms_list[ sprintf( esc_html__( 'Form %s', 'optime' ), $index ) ] = $key;
            $index ++;
        }
    }

    vc_map(array(
        "name" => 'Newsletter',
        "base" => "cms_newsletter",
        "icon" => "cs_icon_for_vc",
        'description' => esc_html__( 'Newsletter Form', 'optime' ),
        "category" => esc_html__('Theme Shortcodes', 'optime'),
        "params" => array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Newsletter Form', 'optime' ),
                'description' => esc_html__( 'Pick default or custom forms from Newsletter Plugin.', 'optime' ),
                'value'       => $forms_list,
                'admin_label' => true,
                'param_name'  => 'form'
            ),
             array(
                "type" => "textfield",
                "heading" => esc_html__( "Extra class name", "optime" ),
                "param_name" => "el_class",
                "description" => esc_html__( "Style particular content element differently - add a class name and refer to it in Custom CSS.", "optime" ),
            ),
            array(
                'type' => 'animation_style',
                'heading' => esc_html__( 'Animation Style', 'optime' ),
                'param_name' => 'animation',
                'description' => esc_html__( 'Choose your animation style', 'optime' ),
                'admin_label' => false,
                'weight' => 0,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Element Parallax', 'optime'),
                'param_name' => 'el_parallax',
                'value' => array(
                    'No' => 'false',
                    'Yes' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Parallax Speed', 'optime' ),
                'param_name' => 'el_parallax_speed',
                'value' => '',
                'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'optime' ),
                'dependency' => array(
                    'element'=>'el_parallax',
                    'value'=>array(
                        'true',
                    )
                ),
            ),
        )
    ));

    class WPBakeryShortCode_cms_newsletter extends CmsShortCode
    {

        protected function content($atts, $content = null)
        {
            return parent::content($atts, $content);
        }
    }
}
?>