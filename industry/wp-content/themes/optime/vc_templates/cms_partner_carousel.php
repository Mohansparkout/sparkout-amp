<?php
extract(shortcode_atts(array(
    'partner_item' => '',
    'el_class' => '',
    'animation' => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',

), $atts));

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'optime-carousel' );
$html_id = cmsHtmlID('cms-partner-carousel');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
extract(optime_get_param_carousel($atts));
$partners = (array) vc_param_group_parse_atts($partner_item);
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
if(!empty($partners)) : ?>

    <div id="<?php echo esc_attr($html_id);?>" class="cms-partner-carousel layout1  default owl-carousel <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?> <?php echo esc_attr($parallax_speed); ?>>
        <?php foreach ($partners as $key => $value) {
            $image = isset($value['image']) ? $value['image'] : '';
            $image_url = '';
            $image_alt = '';
            if (!empty($image)) {
                $attachment_image = wp_get_attachment_image_src($image, 'thumbnail');
                $image_url = $attachment_image[0];
                $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                if (empty($image_alt)){
                    $image_alt = esc_html('brand-image');
                }
            }
            $partner_link = isset($value['link']) ? $value['link'] : '';
            $link = vc_build_link($partner_link);
            $a_href = '';
            $a_target = '';
            if ( strlen( $link['url'] ) > 0 ) {
                $a_href = $link['url'];
                $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
            }
            ?>
            <div class="cms-partner-item <?php echo esc_attr( $animation_classes ); ?>">
                <?php if(!empty($image_url)): ?>
                    <a href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>">
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                    </a>
                <?php endif; ?>
            </div>
        <?php } ?>
    </div>

<?php endif;?>