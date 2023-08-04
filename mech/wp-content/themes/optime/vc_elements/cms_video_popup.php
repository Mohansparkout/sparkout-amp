<?php
$args = array(
    'name' => 'Video Popup',
    'base' => 'cms_video_popup',
    'class' => 'vc-cms-video-popup',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(

        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_video_popup',
            'heading' => esc_html__('Shortcode Template', 'optime'),
            'admin_label' => true,
            'std' => 'cms_video_popup.php',
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
            'type' => 'dropdown',
            'heading' => esc_html__('Video Popup Style','optime'),
            'param_name' => 'popup_style',
            'group' => esc_html__('Video Settings', 'optime'),
            'value' => array(
                'Video Popup Contain Image' => 'video-has-image',
                'Video Popup No Image' => 'video-no-image'
            )
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Video Image', 'optime' ),
            'param_name' => 'video_image',
            'value' => '',
            'description' => esc_html__( 'Select image cmsom media library.', 'optime' ),
            'group' => esc_html__('Video Settings', 'optime'),
            'dependency' => array(
                'element'=>'popup_style',
                'value'=>array(
                    'video-has-image',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Image height', 'optime'),
            'param_name' => 'image_height',
            'description' => 'Enter ..px',
            'group' => esc_html__('Video Settings', 'optime'),
            'dependency' => array(
                'element'=>'popup_style',
                'value'=>array(
                    'video-has-image',
                )
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button Play Style','optime'),
            'param_name' => 'button_style',
            'group' => esc_html__('Video Settings', 'optime'),
            'value' => array(
                'Default' => 'default',
                'White Button' => 'white-button'
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button Size','optime'),
            'param_name' => 'button_size',
            'group' => esc_html__('Video Settings', 'optime'),
            'value' => array(
                'Default' => 'size-default',
                'Small' => 'size-small'
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Button Text','optime'),
            'param_name' => 'button_text',
            'group' => esc_html__('Video Settings', 'optime'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Video Source','optime'),
            'param_name' => 'video_source',
            'description' => 'Enter the video url here.',
            'group'       => esc_html__('Video Settings','optime'),
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Video Autoplay', 'optime'),
            'param_name' => 'video_autoplay',
            'value'      => '1',
            'description'        => 'Check here if you want video autoplay',
            'group'      => esc_html__('Video Settings', 'optime')
        ),
    ));
vc_map($args);

class WPBakeryShortCode_cms_video_popup extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>