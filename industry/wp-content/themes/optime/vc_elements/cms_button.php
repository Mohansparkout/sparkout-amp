<?php
vc_map(array(
    'name' => 'Button',
    'base' => 'cms_button',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Text', 'optime' ),
            'param_name' => 'button_text',
            'value' => '',
            'admin_label' => true,
            'group' => esc_html__('Button Settings', 'optime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Button Icon','optime'),
            'param_name' => 'button_icon',
            'value' => '0',
            'group' => esc_html__('Button Settings', 'optime')
        ),
        array(
            'type' => 'vc_link',
            'class' => '',
            'heading' => esc_html__('Link', 'optime'),
            'param_name' => 'button_link',
            'value' => '',
            'group' => esc_html__('Button Settings', 'optime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button Style', 'optime'),
            'param_name' => 'button_style',
            'value' => array(
                'Default' => 'btn-default',
                'White Button' => 'btn-white',
                'Text Only' => 'btn-text-only',
            ),
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Large', 'optime'),
            'param_name' => 'align_lg',
            'value' => array(
                'Left' => 'align-left',
                'Center' => 'align-center',
                'Right' => 'align-right',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Medium', 'optime'),
            'param_name' => 'align_md',
            'value' => array(
                'Left' => 'align-left-md',
                'Center' => 'align-center-md',
                'Right' => 'align-right-md',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Small', 'optime'),
            'param_name' => 'align_sm',
            'value' => array(
                'Left' => 'align-left-sm',
                'Center' => 'align-center-sm',
                'Right' => 'align-right-sm',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Mini', 'optime'),
            'param_name' => 'align_xs',
            'value' => array(
                'Left' => 'align-left-xs',
                'Center' => 'align-center-xs',
                'Right' => 'align-right-xs',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        /* Padding */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Top', 'optime'),
            'param_name' => 'padding_top',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Right', 'optime'),
            'param_name' => 'padding_right',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Bottom', 'optime'),
            'param_name' => 'padding_bottom',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Left', 'optime'),
            'param_name' => 'padding_left',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        /* Margin*/
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin top', 'optime'),
            'param_name' => 'margin_top',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin right', 'optime'),
            'param_name' => 'margin_right',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin bottom', 'optime'),
            'param_name' => 'margin_bottom',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Margin left', 'optime'),
            'param_name' => 'margin_left',
            'description' => 'Enter: ..px',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        /* Border radius */
        /* Padding */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Top', 'optime'),
            'param_name' => 'br_top',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Right', 'optime'),
            'param_name' => 'br_right',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Bottom', 'optime'),
            'param_name' => 'br_bottom',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Left', 'optime'),
            'param_name' => 'br_left',
            'description' => 'Enter px, em',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'optime' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'optime' ),
            'group'            => esc_html__('Button Settings', 'optime')
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation Style', 'optime' ),
            'param_name' => 'animation',
            'description' => esc_html__( 'Choose your animation style', 'optime' ),
            'admin_label' => false,
            'weight' => 0,
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element Parallax', 'optime'),
            'param_name' => 'el_parallax',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
            'group' => esc_html__('Button Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Parallax Speed', 'optime' ),
            'param_name' => 'el_parallax_speed',
            'value' => '',
            'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'optime' ),
            'group' => esc_html__('Button Settings', 'optime'),
            'dependency' => array(
                'element'=>'el_parallax',
                'value'=>array(
                    'true',
                )
            ),
        ),
    )
));

class WPBakeryShortCode_cms_button extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>