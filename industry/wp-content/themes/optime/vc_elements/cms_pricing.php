<?php
vc_map(
    array(
        'name'     => esc_html__('Pricing', 'optime'),
        'base'     => 'cms_pricing',
        'class'    => 'vc-cms-pricing',
        'category' => esc_html__('Theme Shortcodes', 'optime'),
        'params'   => array(
            array(
                'type' => 'cms_template_img',
                'param_name' => 'cms_template',
                'shortcode' => 'cms_pricing',
                'heading' => esc_html__('Shortcode Template', 'optime'),
                'admin_label' => true,
                'std' => 'cms_pricing.php',
                'group' => esc_html__('Template', 'optime'),
            ),
            
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Content', 'optime' ),
                'param_name' => 'content_list',
                'description' => esc_html__( 'Enter values for team item', 'optime' ),
                'value' => '',
                'group' => esc_html__('Source Settings', 'optime'),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' =>esc_html__('Title', 'optime'),
                        'param_name' => 'title',
                        'admin_label' => true,
                        'group' => esc_html__('Source Settings', 'optime'),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' =>esc_html__('Description', 'optime'),
                        'param_name' => 'description',
                        'admin_label' => true,
                        'group' => esc_html__('Source Settings', 'optime'),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' =>esc_html__('Price', 'optime'),
                        'param_name' => 'price',
                        'group' => esc_html__('Source Settings', 'optime'),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' =>esc_html__('Price position', 'optime'),
                        'param_name' => 'price_position',
                        'group' => esc_html__('Source Settings', 'optime'),
                    ),
                    array(
                        'type' => 'param_group',
                        'heading' => esc_html__( 'Content Body', 'optime' ),
                        'param_name' => 'content_list_pricing_body',
                        'description' => esc_html__( 'Enter values for team item', 'optime' ),
                        'value' => '',
                        'group' => esc_html__('Source Settings', 'optime'),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'heading' =>esc_html__('Item Body', 'optime'),
                                'param_name' => 'item_body',
                                'group' => esc_html__('Source Settings', 'optime'),
                            ), 
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' =>esc_html__('Button Text', 'optime'),
                        'param_name' => 'button_text',
                        'group' => esc_html__('Source Settings', 'optime'),
                        
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => '',
                        'heading' => esc_html__('Button Link', 'optime'),
                        'param_name' => 'button_link',
                        'value' => '',
                    ),
                ),
            ),
            /*Setting*/
            //title
            array(
                "type" => "textfield",
                "heading" =>esc_html__("Title Font Size", 'optime'),
                "param_name" => "title_fontsize",
                'value' => '',
                "description" => "Enter: ...px;",
                'group'      => esc_html__('Settings', 'optime'),
            ),
            array(
                "type" => "colorpicker",
                "heading" =>esc_html__("title Color", 'optime'),
                "param_name" => "title_color",
                'value' => '',
                'group'      => esc_html__('Settings', 'optime'),
            ),
            //Description
            array(
                "type" => "textfield",
                "heading" =>esc_html__("Description Font Size", 'optime'),
                "param_name" => "desc_fontsize",
                'value' => '',
                "description" => "Enter: ...px;",
                'group'      => esc_html__('Settings', 'optime'),
            ),
            array(
                "type" => "colorpicker",
                "heading" =>esc_html__("Description Color", 'optime'),
                "param_name" => "desc_color",
                'value' => '',
                'group'      => esc_html__('Settings', 'optime'),
            ),
            //price
            array(
                "type" => "textfield",
                "heading" =>esc_html__("Price number Font Size", 'optime'),
                "param_name" => "price_fontsize",
                'value' => '',
                "description" => "Enter: ...px;",
                'group'      => esc_html__('Settings', 'optime'),
            ),
            array(
                "type" => "colorpicker",
                "heading" =>esc_html__("Price number Color", 'optime'),
                "param_name" => "price_color",
                'value' => '',
                'group'      => esc_html__('Settings', 'optime'),
            ),
            //position
            array(
                "type" => "textfield",
                "heading" =>esc_html__("Position Font Size", 'optime'),
                "param_name" => "position_fontsize",
                'value' => '',
                "description" => "Enter: ...px;",
                'group'      => esc_html__('Settings', 'optime'),
            ),
            array(
                "type" => "colorpicker",
                "heading" =>esc_html__("Position Color", 'optime'),
                "param_name" => "position_color",
                'value' => '',
                'group'      => esc_html__('Settings', 'optime'),
            ),
            //pricing body
            array(
                "type" => "textfield",
                "heading" =>esc_html__("Pricing body Font Size", 'optime'),
                "param_name" => "pribody_fontsize",
                'value' => '',
                "description" => "Enter: ...px;",
                'group'      => esc_html__('Settings', 'optime'),
            ),
            array(
                "type" => "colorpicker",
                "heading" =>esc_html__("Pricing body Color", 'optime'),
                "param_name" => "pribody_color",
                'value' => '',
                'group'      => esc_html__('Settings', 'optime'),
            ),

            /*Grid Settings*/
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns XS Devices', 'optime'),
                'param_name'       => 'col_xs',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 1,
                'group'            => esc_html__('Grid Settings', 'optime')
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns SM Devices', 'optime'),
                'param_name'       => 'col_sm',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 2,
                'group'            => esc_html__('Grid Settings', 'optime')
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns MD Devices', 'optime'),
                'param_name'       => 'col_md',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 3,
                'group'            => esc_html__('Grid Settings', 'optime')
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns LG Devices', 'optime'),
                'param_name'       => 'col_lg',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 4,
                'group'            => esc_html__('Grid Settings', 'optime')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra class name', 'optime' ),
                'param_name' => 'el_class',
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'optime' ),
                'group'            => esc_html__('Grid Settings', 'optime')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Element Parallax', 'optime'),
                'param_name' => 'el_parallax',
                'value' => array(
                    'No' => 'false',
                    'Yes' => 'true',
                ),
                'group' => esc_html__('Grid Settings', 'optime'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Parallax Speed', 'optime' ),
                'param_name' => 'el_parallax_speed',
                'value' => '',
                'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'optime' ),
                'group' => esc_html__('Grid Settings', 'optime'),
                'dependency' => array(
                    'element'=>'el_parallax',
                    'value'=>array(
                        'true',
                    )
                ),
            ),
        )
)
);

class WPBakeryShortCode_cms_pricing extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        $html_id = cmsHtmlID('cms-pricing');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>