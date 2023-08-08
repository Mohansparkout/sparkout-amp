<?php
extract(shortcode_atts(array(
    'api' => 'AIzaSyA9YKb-KmokX_b8Ea6hKRVpKhdtjIXq3h8',
    'address' => 'New York, United States',
    'infoclick' => '',
    'coordinate' => '',
    'markercoordinate' => '',
    'markertitle' => '',
    'markerdesc' => '',
    'markerlist' => '',
    'markericon' => '',
    'infowidth' => '200',
    'width' => 'auto',
    'height' => '350px',
    'type' => 'ROADMAP',
    'style' => '',
    'zoom' => '13',
    'scrollwheel' => '',
    'pancontrol' => '',
    'zoomcontrol' => '',
    'scalecontrol' => '',
    'maptypecontrol' => '',
    'streetviewcontrol' => '',
    'overviewmapcontrol' => '',
    'styles' => 'default',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
    'title' => '',
    'cms_locations' => '',
), $atts));
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}

/* load scripts. */
$api_js = 'https://maps.googleapis.com/maps/api/js?key='.$api;
//$api_js = "https://maps.googleapis.com/maps/api/js?sensor=false&key=".$api;
wp_enqueue_script('maps-googleapis', $api_js, array(), '3.0.0', true);
wp_enqueue_script('cms.googlemap', get_template_directory_uri() . '/assets/js/cms-googlemap.js', array('maps-googleapis'), '3.0.0', true);

/* style defualt */
$map_styles = array(
    'light-monochrome'=>'[{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]}]',
    'blue-water'=>'[{"featureType":"water","stylers":[{"color":"#46bcec"},{"visibility":"on"}]},{"featureType":"landscape","stylers":[{"color":"#f2f2f2"}]},{"featureType":"road","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]}]',
    'midnight-commander'=>'[{"featureType":"water","stylers":[{"color":"#021019"}]},{"featureType":"landscape","stylers":[{"color":"#08304b"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#0c4152"},{"lightness":5}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#0b434f"},{"lightness":25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#0b3d51"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#000000"},{"lightness":13}]},{"featureType":"transit","stylers":[{"color":"#146474"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#144b53"},{"lightness":14},{"weight":1.4}]}]',
    'paper'=>'[{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#5f94ff"},{"lightness":26},{"gamma":5.86}]},{},{"featureType":"road.highway","stylers":[{"weight":0.6},{"saturation":-85},{"lightness":61}]},{"featureType":"road"},{},{"featureType":"landscape","stylers":[{"hue":"#0066ff"},{"saturation":74},{"lightness":100}]}]',
    'red-hues'=>'[{"stylers":[{"hue":"#dd0d0d"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]}]',
    'hot-pink'=>'[{"stylers":[{"hue":"#ff61a6"},{"visibility":"on"},{"invert_lightness":true},{"saturation":40},{"lightness":10}]}]',
);

/* Select Template */
$map_template = '';
switch ($style){
    case '':
        break;
    case 'custom':
        if($content){
            $map_template = $content;
        }
        break;
    default:
        $map_template = rawurlencode($map_styles[$style]);
        break;
}

/* marker render */
$marker = new stdClass();
if($markercoordinate){
    $marker->markercoordinate = $markercoordinate;
    if($markerdesc || $markertitle){
        $marker->markerdesc =   '<div class="info-content">'.
            '<h5>'.$markertitle.'</h5>'.
            '<span>'.$markerdesc.'</span>'.
            '</div>';
    }
    if($markericon){
        $marker->markericon = wp_get_attachment_url($markericon);
    }else{
        $marker->markericon = get_template_directory_uri() . '/assets/images/marker.png';
    }
}

if($markerlist){
    $marker->markerlist = $markerlist;
}

$marker = rawurlencode(json_encode($marker));

$marker_css = new stdClass();
    if($markericon){
        $marker_css->markericon = '<span></span>';
    }
$marker_css = rawurlencode(json_encode($marker_css));

/* control render */
$controls = new stdClass();
if($scrollwheel == true){ $controls->scrollwheel = 1; } else { $controls->scrollwheel = 0; }
if($pancontrol == true){ $controls->pancontrol = true; } else { $controls->pancontrol = false; }
if($zoomcontrol == true){ $controls->zoomcontrol = true; } else { $controls->zoomcontrol = false; }
if($scalecontrol == true){ $controls->scalecontrol = true; } else { $controls->scalecontrol = false; }
if($maptypecontrol == true){ $controls->maptypecontrol = true; } else { $controls->maptypecontrol = false; }
if($streetviewcontrol == true){ $controls->streetviewcontrol = true; } else { $controls->streetviewcontrol = false; }
if($overviewmapcontrol == true){ $controls->overviewmapcontrol = true; } else { $controls->overviewmapcontrol = false; }
if($infoclick == true){ $controls->infoclick = true; } else { $controls->infoclick = false; }
$controls->infowidth = $infowidth;
$controls->style = $style;

$controls = rawurlencode(json_encode($controls));

/* data render */
$setting = array(
    "data-address='$address'",
    "data-marker='$marker'",
    "data-loader='$marker_css'",
    "data-coordinate='$coordinate'",
    "data-type='$type'",
    "data-zoom='$zoom'",
    "data-template='$map_template'",
    "data-controls='$controls'"
);
$location = array();
$location = (array) vc_param_group_parse_atts($cms_locations);
$html_id = cmsHtmlID('cms-map-contact-box');

?>

<div class="cms-google-map style-<?php echo esc_attr( $styles ); ?> <?php echo esc_attr($el_parallax_class); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <div class="map-render" <?php echo implode(' ', $setting); ?> style="width:<?php echo esc_attr($width); ?>;height: <?php echo esc_attr($height); ?>"></div>
    <?php
    if(!empty($location) && !empty($title)) : ?>
        <div class="container map-contact-wrap">
            <div class="row">
                <div class="col-lg-12">
                    <div id="<?php echo esc_attr($html_id); ?>" class="cms-map-contact-box">
                        <div class="title">
                            <h3><?php echo esc_html($title);?></h3>
                        </div>
                        <div class="card-wrap">
                            <?php foreach ($location as $key => $value) {
                                $ctl_location = isset($value['ctl_location']) ? $value['ctl_location'] : '';
                                $ctl_phone = isset($value['ctl_phone']) ? $value['ctl_phone'] : '';
                                $ctl_email = isset($value['ctl_email']) ? $value['ctl_email'] : '';
                                $ctl_address = isset($value['ctl_address']) ? $value['ctl_address'] : '';
                                $ctl_hours = isset($value['ctl_hours']) ? $value['ctl_hours'] : '';
                                $active_section = 1;
                                ?>
                                <div class="card">
                                    <div class="card-header" id="heading-<?php echo esc_attr($key); ?>">
                                        <div class="collapse-item" data-toggle="collapse" role="button" data-target="#collapse-<?php echo esc_attr($key); ?>" aria-expanded="<?php if($key == ($active_section - 1)) { echo 'true'; } else { echo 'false'; } ?>" aria-controls="collapse-<?php echo esc_attr($key); ?>">
                                            <?php echo esc_attr($ctl_location); ?>
                                        </div>
                                    </div>
                                    <div id="collapse-<?php echo esc_attr($key); ?>" class="collapse  <?php if($key == ($active_section - 1)) { echo 'show'; } ?>" aria-labelledby="heading-<?php echo esc_attr($key); ?>" data-parent="#<?php echo esc_attr($html_id); ?>">
                                        <div class="card-body">
                                            <p><?php esc_html_e('Phone', 'optime'); echo ': '.esc_html($ctl_phone);?></p>
                                            <p><?php esc_html_e('Email', 'optime'); echo ': '.esc_html($ctl_email);?></p>
                                            <p><?php esc_html_e('Address', 'optime'); echo ': '.esc_html($ctl_address);?></p>
                                            <p><?php esc_html_e('Hours', 'optime'); echo ': '.esc_html($ctl_hours);?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;
    ?>
</div>