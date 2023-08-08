<?php
extract(shortcode_atts(array(
    'cms_locations' => '',
    'el_class' => '',
    'animation' => '',
), $atts));
wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'optime-carousel' );
$location = array();
$location = (array) vc_param_group_parse_atts($cms_locations);
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
extract(optime_get_param_carousel($atts));
$html_id = cmsHtmlID('cms-contact-location');
if(!empty($location)) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="cms-contact-location layout1 owl-carousel <?php echo esc_attr($el_class.' '.$animation_classes); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?>>
        <?php foreach ($location as $key => $value) {
            $image = isset($value['ctl_image']) ? $value['ctl_image'] : '';
            $image_url = '';
            $image_alt = '';
            if (!empty($image)) {
                $attachment_image = wp_get_attachment_image_src($image, 'thumbnail');
                $image_url = $attachment_image[0];
                $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                if (empty($image_alt)){
                    $image_alt = esc_html__('location-image', 'optime');
                }
            }
            $ctl_location = isset($value['ctl_location']) ? $value['ctl_location'] : '';
            $ctl_phone = isset($value['ctl_phone']) ? $value['ctl_phone'] : '';
            $ctl_email = isset($value['ctl_email']) ? $value['ctl_email'] : '';
            $ctl_address = isset($value['ctl_address']) ? $value['ctl_address'] : '';
            $ctl_hours = isset($value['ctl_hours']) ? $value['ctl_hours'] : '';
            $ctl_link = isset($value['ctl_link']) ? $value['ctl_link'] : '';
            $link = vc_build_link($ctl_link);
            $a_btn_text = '';
            $a_href = '';
            $a_target = '';
            if ( strlen( $link['url'] ) > 0 ) {
                $a_btn_text = !empty($link['title']) ? $link['title'] : 'Contact Us';
                $a_href = $link['url'];
                $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
            }
            ?>
            <div class="contact-item">
                <?php if(!empty($image_url)): ?>
                    <div class="contact-image">
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" />
                    </div>
                <?php endif; ?>
                <?php if(!empty($ctl_location)): ?>
                    <div class="location">
                        <p><?php echo esc_attr($ctl_location); ?></p>
                    </div>
                <?php endif; ?>
                <div class="contact-info">
                    <p><?php esc_html_e('Phone', 'optime'); echo ': '.esc_html($ctl_phone);?></p>
                    <p><?php esc_html_e('Email', 'optime'); echo ': '.esc_html($ctl_email);?></p>
                    <p><?php esc_html_e('Address', 'optime'); echo ': '.esc_html($ctl_address);?></p>
                    <p><?php esc_html_e('Hours', 'optime'); echo ': '.esc_html($ctl_hours);?></p>
                    <a class="contact-link btn" href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>">
                        <?php echo esc_html($a_btn_text); ?><i class="zmdi zmdi-arrow-right"></i>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
<?php endif; ?>