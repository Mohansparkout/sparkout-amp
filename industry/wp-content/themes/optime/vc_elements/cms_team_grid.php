<?php
$args = array(
    'name' => 'Team Grid',
    'base' => 'cms_team_grid',
    'class' => 'cms-team-grid',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(

        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_team_grid',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'admin_label' => true,
            'std' => 'cms_team_grid.php',
            'group' => esc_html__('Template', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'optime' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'optime' ),
            'group'            => esc_html__('Template', 'optime')
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation Style', 'optime' ),
            'param_name' => 'animation',
            'description' => esc_html__( 'Choose your animation style', 'optime' ),
            'admin_label' => false,
            'weight' => 0,
            "group" => esc_html__("Template", 'optime'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element Parallax', 'optime'),
            'param_name' => 'el_parallax',
            'value' => array(
                'No' => 'false',
                'Yes' => 'true',
            ),
            'group' => esc_html__('Template', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Parallax Speed', 'optime' ),
            'param_name' => 'el_parallax_speed',
            'value' => '',
            'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'optime' ),
            'group' => esc_html__('Template', 'optime'),
            'dependency' => array(
                'element'=>'el_parallax',
                'value'=>array(
                    'true',
                )
            ),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Team Members', 'optime' ),
            'param_name' => 'teams',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Image', 'optime' ),
                    'param_name' => 'image',
                    'description' => esc_html__( 'Select image from media library.', 'optime' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Title', 'optime'),
                    'param_name' => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Occupation', 'optime'),
                    'param_name' => 'occupation',
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Facebook', 'optime'),
                    'param_name' => 'facebook',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Twitter', 'optime'),
                    'param_name' => 'twitter',
                    'admin_label' => true,
                ),
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Image size', 'optime' ),
            'param_name' => 'img_size',
            'value' => '',
            'description' => __( "Enter image size (Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height). Enter multiple sizes (Example: 100x100,200x200,300x300)).", 'optime' ),
            'group'      => esc_html__('Grid Settings', 'optime')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns XS Devices', 'optime'),
            'param_name'       => 'col_xs',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6),
            'std'              => 1,
            'group'            => esc_html__('Grid Settings', 'optime')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns SM Devices', 'optime'),
            'param_name'       => 'col_sm',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6),
            'std'              => 2,
            'group'            => esc_html__('Grid Settings', 'optime')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns MD Devices', 'optime'),
            'param_name'       => 'col_md',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6),
            'std'              => 3,
            'group'            => esc_html__('Grid Settings', 'optime')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns LG Devices', 'optime'),
            'param_name'       => 'col_lg',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'value'            => array(1, 2, 3, 4, 6),
            'std'              => 4,
            'group'            => esc_html__('Grid Settings', 'optime')
        ),

    ));
vc_map($args);

class WPBakeryShortCode_cms_team_grid extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>