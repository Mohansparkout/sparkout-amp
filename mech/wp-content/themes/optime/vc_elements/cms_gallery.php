<?php
vc_map(
    array(
        'name'     => esc_html__('Gallery Grid', 'optime'),
        'base'     => 'cms_gallery',
        'class'    => 'vc-cms-team-grid',
        'category' => esc_html__('Theme Shortcodes', 'optime'),
        'params'   => array(
            array(
                'type' => 'cms_template_img',
                'param_name' => 'cms_template',
                'shortcode' => 'cms_gallery',
                'heading' => esc_html__('Shortcode Template', 'optime'),
                'admin_label' => true,
                'std' => 'cms_gallery.php',
                'group' => esc_html__('Template', 'optime'),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Content', 'optime' ),
                'param_name' => 'gallery_list',
                'description' => esc_html__( 'Enter values for team item', 'optime' ),
                'value' => '',
                'group' => esc_html__('Source Settings', 'optime'),
                'dependency' => array(
                    'element'=>'cms_template',
                    'value'=>array(
                        'cms_gallery.php',
                    )
                ),
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Image', 'optime' ),
                        'param_name' => 'image',
                        'value' => '',
                        'description' => esc_html__( 'Select image from media library.', 'optime' ),
                        'group' => esc_html__('Source Settings', 'optime'),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Image size', 'optime' ),
                        'param_name' => 'img_size',
                        'value' => '',
                        'description' => esc_html__( "Enter image size (Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height).", 'optime' ),
                        'group'      => esc_html__('Source Settings', 'optime')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' =>esc_html__('Category', 'optime'),
                        'param_name' => 'category',
                        'admin_label' => true,
                        'group' => esc_html__('Source Settings', 'optime'),
                        'description' => 'Enter category. Enter multiple categories (Example: "Category 1, Category 2, Category 3")'
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => '',
                        'heading' => esc_html__('Button Link', 'optime'),
                        'param_name' => 'title_link',
                        'value' => '',
                    ),
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Type', 'optime'),
                'param_name' => 'layout',
                'value'      => array(
                    'Basic'   => 'basic',
                    'Masonry' => 'masonry',
                ),
                'group'      => esc_html__('Grid Settings', 'optime')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Filter on Masonry', 'optime'),
                'param_name' => 'filter',
                'value'      => array(
                    'Enable'  => 'true',
                    'Disable' => 'false'
                ),
                'dependency' => array(
                    'element' => 'layout',
                    'value'   => 'masonry'
                ),
                'group'      => esc_html__('Grid Settings', 'optime')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Default Title', 'optime'),
                'param_name' => 'filter_default_title',
                'value'      => 'All',
                'group'      => esc_html__('Filter', 'optime'),
                'description' => esc_html__('Enter default title for filter option display, empty: All', 'optime'),
                'dependency' => array(
                    'element' => 'filter',
                    'value'   => 'true'
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Title Color Active', 'optime'),
                'param_name' => 'filter_title_color',
                'value'      => array(
                    'Secondary'   => 'secondary',
                    'Primary'   => 'primary',
                    'General'   => 'general',
                    'Custom'   => 'custom',
                ),
                'group'      => esc_html__('Filter', 'optime'),
                'dependency' => array(
                    'element' => 'filter',
                    'value'   => 'true'
                ),
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Title Color Active', 'optime'),
                'param_name' => 'filter_title_color1',
                'group'      => esc_html__('Filter', 'optime'),
                'dependency' => array(
                    'element' => 'filter_title_color',
                    'value'   => 'custom',
                ),
                
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Alignment', 'optime'),
                'param_name' => 'filter_alignment',
                'value'      => array(
                    'Center'   => 'center',
                    'Left'   => 'left',
                    'Right'   => 'right',
                ),
                'description' => esc_html__('Select filter alignment.', 'optime'),
                'group'      => esc_html__('Filter', 'optime'),
                'dependency' => array(
                    'element' => 'filter',
                    'value'   => 'true'
                ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Left heading', 'optime'),
                'param_name' => 'left_heading',
                'value'      => '',
                'group'      => esc_html__('Filter', 'optime'),
                'description' => esc_html__('Just show when filter alignment = Right', 'optime'),
                'dependency' => array(
                    'element' => 'filter_alignment',
                    'value'   => 'right'
                ),
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

class WPBakeryShortCode_cms_gallery extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        $html_id = cmsHtmlID('cms-gallery');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>