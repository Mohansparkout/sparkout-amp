<?php
$term_list = cms_get_grid_term_list('service');
$args = array(
    'name' => 'Services Carousel',
    'base' => 'cms_services_carousel',
    'class' => 'vc-cms-case-studies-carousel',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(

        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_services_carousel',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'admin_label' => true,
            'std' => 'cms_services_carousel.php',
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
            'description' => esc_html__('Set max limit for items in carousel. Enter number only', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image size', 'optime' ),
            'param_name' => 'img_size',
            'value' => '',
            'description' => esc_html__( "Enter image size (Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height).", "optime" ),
            'group'      => esc_html__('Source Settings', 'optime')
        ),
    ));

$args = optime_add_vc_extra_param($args);
vc_map($args);

class WPBakeryShortCode_cms_services_carousel extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>