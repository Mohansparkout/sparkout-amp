<?php
vc_map(array(
    'name' => 'Google Map',
    'base' => 'cms_googlemap',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('Theme Shortcodes', 'optime'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('API Key', 'optime'),
            'param_name' => 'api',
            'value' => '',
            'description' => esc_html__('Enter you api key of map, get key cmsom (https://console.developers.google.com)', 'optime')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Address', 'optime'),
            'param_name' => 'address',
            'value' => 'New York, United States',
            'description' => esc_html__('Enter address of Map', 'optime')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Coordinate', 'optime'),
            'param_name' => 'coordinate',
            'value' => '',
            'description' => esc_html__('Enter coordinate of Map, format input (latitude, longitude)', 'optime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Click Show Info window', 'optime'),
            'param_name' => 'infoclick',
            'value' => array(
                esc_html__('Yes, please', 'optime') => true
            ),
            'description' => esc_html__('Click a marker and show info window (Default Show).', 'optime')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Marker Coordinate', 'optime'),
            'param_name' => 'markercoordinate',
            'value' => '',
            'description' => esc_html__('Enter marker coordinate of Map, format input (latitude, longitude)', 'optime')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Marker Title', 'optime'),
            'param_name' => 'markertitle',
            'value' => '',
            'description' => esc_html__('Enter Title Info windows for marker', 'optime')
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Marker Description', 'optime'),
            'param_name' => 'markerdesc',
            'value' => '',
            'description' => esc_html__('Enter Description Info windows for marker', 'optime')
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Marker Icon', 'optime'),
            'param_name' => 'markericon',
            'value' => '',
            'description' => esc_html__('Select image icon for marker', 'optime')
        ),
        array(
            'type' => 'textarea_raw_html',
            'heading' => esc_html__('Marker List', 'optime'),
            'param_name' => 'markerlist',
            'value' => '',
            'description' => esc_html__('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'optime')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Info Window Max Width', 'optime'),
            'param_name' => 'infowidth',
            'value' => '200',
            'description' => esc_html__('Set max width for info window', 'optime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Map Type', 'optime'),
            'param_name' => 'type',
            'value' => array(
                'ROADMAP' => 'ROADMAP',
                'HYBRID' => 'HYBRID',
                'SATELLITE' => 'SATELLITE',
                'TERRAIN' => 'TERRAIN'
            ),
            'description' => esc_html__('Select the map type.', 'optime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Style Template', 'optime'),
            'param_name' => 'style',
            'value' => array(
                'Default' => '',
                'Custom' => 'custom',
                'Light Monochrome' => 'light-monochrome',
                'Blue water' => 'blue-water',
                'Midnight Commander' => 'midnight-commander',
                'Paper' => 'paper',
                'Red Hues' => 'red-hues',
                'Hot Pink' => 'hot-pink'
            ),
            'description' => 'Select your heading size for title.'
        ),
        array(
            'type' => 'textarea_raw_html',
            'heading' => esc_html__('Custom Template', 'optime'),
            'param_name' => 'content',
            'value' => '',
            'description' => esc_html__('Get template cmsom http://snazzymaps.com', 'optime')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Zoom', 'optime'),
            'param_name' => 'zoom',
            'value' => '13',
            'description' => esc_html__('zoom level of map, default is 13', 'optime')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Width', 'optime'),
            'param_name' => 'width',
            'value' => 'auto',
            'description' => esc_html__('Width of map without pixel, default is auto', 'optime')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Height', 'optime'),
            'param_name' => 'height',
            'value' => '350px',
            'description' => esc_html__('Height of map with pixel, default is 350px', 'optime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Scroll Wheel', 'optime'),
            'param_name' => 'scrollwheel',
            'value' => array(
                esc_html__('Yes, please', 'optime') => true
            ),
            'description' => esc_html__('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'optime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Pan Control', 'optime'),
            'param_name' => 'pancontrol',
            'value' => array(
                esc_html__('Yes, please', 'optime') => true
            ),
            'description' => esc_html__('Show or hide Pan control.', 'optime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Zoom Control', 'optime'),
            'param_name' => 'zoomcontrol',
            'value' => array(
                esc_html__('Yes, please', 'optime') => true
            ),
            'description' => esc_html__('Show or hide Zoom Control.', 'optime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Scale Control', 'optime'),
            'param_name' => 'scalecontrol',
            'value' => array(
                esc_html__('Yes, please', 'optime') => true
            ),
            'description' => esc_html__('Show or hide Scale Control.', 'optime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Map Type Control', 'optime'),
            'param_name' => 'maptypecontrol',
            'value' => array(
                esc_html__('Yes, please', 'optime') => true
            ),
            'description' => esc_html__('Show or hide Map Type Control.', 'optime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Street View Control', 'optime'),
            'param_name' => 'streetviewcontrol',
            'value' => array(
                esc_html__('Yes, please', 'optime') => true
            ),
            'description' => esc_html__('Show or hide Street View Control.', 'optime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Over View Map Control', 'optime'),
            'param_name' => 'overviewmapcontrol',
            'value' => array(
                esc_html__('Yes, please', 'optime') => true
            ),
            'description' => esc_html__('Show or hide Over View Map Control.', 'optime')
        ),
        array(
            'type' => 'textfield',
            'heading' =>esc_html__('Title', 'optime'),
            'param_name' => 'title',
            'group' => esc_html__('Contact Box', 'optime'),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Contact Locations', 'optime' ),
            'param_name' => 'cms_locations',
            'description' => esc_html__( 'Enter values for contact location item', 'optime' ),
            'value' => '',
            'group' => esc_html__('Contact Box', 'optime'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Location', 'optime'),
                    'param_name' => 'ctl_location',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Phone', 'optime'),
                    'param_name' => 'ctl_phone',
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Email', 'optime'),
                    'param_name' => 'ctl_email',
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Address', 'optime'),
                    'param_name' => 'ctl_address',
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Hours Open', 'optime'),
                    'param_name' => 'ctl_hours',
                ),
            ),
        ),
    )
));

class WPBakeryShortCode_cms_googlemap extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>