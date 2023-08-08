<?php
vc_map(
	array(
		'name' => esc_html__('Progress Bar', 'optime'),
	    'base' => 'cms_progressbar',
	    'class' => 'vc-cms-progressbar',
	    'category' => esc_html__('Theme Shortcodes', 'optime'),
	    'params' => array(
	    	array(
                'type' => 'cms_template_img',
                'param_name' => 'cms_template',
                'shortcode' => 'cms_progressbar',
                'heading' => esc_html__('Shortcode Template', 'optime'),
                'admin_label' => true,
                'std' => 'cms_progressbar.php',
                'group' => esc_html__('Template', 'optime'),
            ),
            array(
	            'type' => 'textfield',
	            'heading' => esc_html__('Extra Class','optime'),
	            'param_name' => 'el_class',
	            'value' => '',
	            'group' => esc_html__('Template', 'optime')
	        ),
	        array(
	            'type' => 'param_group',
	            'heading' => esc_html__( 'Progress Bar Lists', 'optime' ),
	            'param_name' => 'cms_progressbar_list',
	            'value' => '',
	            'params' => array(
	                array(
			            'type' => 'textfield',
			            'heading' => esc_html__('Item Title','optime'),
			            'param_name' => 'item_title',
			            'value' => '',
			            'group' => esc_html__('Progress Bar Settings', 'optime'),
			            'admin_label' => true,
			        ),
					array(
						'type' => 'textfield',
						'class' => '',
						'value' => '',
						'heading' => esc_html__( 'Value', 'optime' ),
						'param_name' => 'value',
						'description' => 'Enter number only 1 to 100',
						'group' => esc_html__('Progress Bar Settings', 'optime'),
						'admin_label' => true,
					),
	            ),
	        ),
	        array(
	            'type' => 'colorpicker',
	            'heading' => esc_html__('Background progress','optime'),
	            'param_name' => 'bg_progress',
	            'value' => '',
	            'group' => esc_html__('Settings', 'optime')
	        ),
	        array(
	            'type' => 'colorpicker',
	            'heading' => esc_html__('Background progressbar','optime'),
	            'param_name' => 'bg_progressbar',
	            'value' => '',
	            'group' => esc_html__('Settings', 'optime')
	        ),
	    )
	)
);
class WPBakeryShortCode_cms_progressbar extends CmsShortCode{
	protected function content($atts, $content = null){
		/* CSS */
	    wp_enqueue_style('progressbar', get_template_directory_uri() . '/assets/css/progressbar.min.css', array(), '0.7.1');
	    /* JS */
	    wp_enqueue_script('progressbar', get_template_directory_uri() . '/assets/js/progressbar.min.js', array( 'jquery' ), '0.7.1', true);
	    wp_enqueue_script('cms-progressbar', get_template_directory_uri() . '/assets/js/progressbar.cms.js', array( 'jquery' ), 'all', true);
	    wp_enqueue_script('waypoints');
		return parent::content($atts, $content);
	}
}

?>