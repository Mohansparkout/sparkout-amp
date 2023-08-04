<?php
$term_list = cms_get_grid_term_list('service');
vc_map(
    array(
        'name'     => esc_html__('Services Grid', 'optime'),
        'base'     => 'cms_services_grid',
        'class'    => 'services-grid',
        'icon' => 'cs_icon_for_vc',
        'category' => esc_html__('Theme Shortcodes', 'optime'),
        'params'   => array(
            array(
                'type' => 'cms_template_img',
                'param_name' => 'cms_template',
                'shortcode' => 'cms_services_grid',
                'heading' => esc_html__('Shortcode Template', 'optime'),
                'admin_label' => true,
                'std' => 'cms_services_grid.php',
                'group' => esc_html__('Template', 'optime'),
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Custom Source', 'optime'),
                'param_name' => 'custom_source',
                'value'      => '1',
                'description'        => 'Check here if you want custom source',
                'group'      => esc_html__('Source Settings', 'optime')
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__('Select Categories', 'optime'),
                'param_name' => 'source',
                'description' => esc_html__('Leave blank to select all category', 'optime'),
                'settings'   => array(
                    'multiple' => true,
                    'values'   => $term_list['auto_complete'],
                ),
                'dependency' => array(
                    'element'=>'custom_source',
                    'value'=>array(
                        'true',
                    )
                ),
                'group'      => esc_html__('Source Settings', 'optime'),
            ),
            array(
                'type'       => 'autocomplete',
                'class'      => '',
                'heading'    => esc_html__('Select Post Name', 'optime'),
                'param_name' => 'post_ids',
                'description' => esc_html__('Leave blank to show all post', 'optime'),
                'settings'   => array(
                    'multiple' => true,
                    'values'   => cms_get_type_posts_data('service')
                ),
                'dependency' => array(
                    'element'=>'custom_source',
                    'value'=>array(
                        'true',
                    )
                ),
                'group'      => esc_html__('Source Settings', 'optime'),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Order by', 'optime'),
                'param_name' => 'orderby',
                'value'      => array(
                    'Date'   => 'date',
                    'ID'     => 'ID',
                    'Author' => 'author',
                    'Title'  => 'title',
                    'Random' => 'rand',
                ),
                'std'        => 'date',
                'group'      => esc_html__('Source Settings', 'optime')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Sort order', 'optime'),
                'param_name' => 'order',
                'value'      => array(
                    'Ascending'  => 'ASC',
                    'Descending' => 'DESC',
                ),
                'std'        => 'DESC',
                'group'      => esc_html__('Source Settings', 'optime')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Total items', 'optime'),
                'param_name' => 'limit',
                'value'      => '6',
                'group'      => esc_html__('Source Settings', 'optime'),
                'description' => esc_html__('Set max limit for items in grid. Enter number only', 'optime'),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Item Gap', 'optime'),
                'param_name' => 'gap',
                'value'      => '30',
                'group'      => esc_html__('Grid Settings', 'optime'),
                'description' => esc_html__('Select gap between grid elements. Enter number only', 'optime'),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns XS Devices', 'optime'),
                'param_name'       => 'col_xs',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 1,
                'group'            => esc_html__('Grid Settings', 'optime'),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns SM Devices', 'optime'),
                'param_name'       => 'col_sm',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 2,
                'group'            => esc_html__('Grid Settings', 'optime'),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns MD Devices', 'optime'),
                'param_name'       => 'col_md',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 3,
                'group'            => esc_html__('Grid Settings', 'optime'),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns LG Devices', 'optime'),
                'param_name'       => 'col_lg',
                'edit_field_class' => 'vc_col-sm-3 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 3,
                'group'            => esc_html__('Grid Settings', 'optime'),
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

class WPBakeryShortCode_cms_services_grid extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        $html_id = cmsHtmlID('cms-services-grid');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>