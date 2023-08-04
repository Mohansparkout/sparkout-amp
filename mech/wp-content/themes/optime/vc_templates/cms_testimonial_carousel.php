<?php
extract(shortcode_atts(array(
    'background' => 'transparent',
    'name' => '',
    'testimonial_item' => '',
    'el_class' => '',
    'animation' => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
    'content_color'   => '#9b9b9b',
    'name_color'   => '#282828',
    'position_color' => '#616161',

), $atts));

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_style( 'owl-carousel' );
wp_enqueue_script( 'optime-carousel' );
$html_id = cmsHtmlID('cms-testimonial-carousel');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
extract(optime_get_param_carousel($atts));
$testimonials = (array) vc_param_group_parse_atts($testimonial_item);
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
if(!empty($testimonials)) : ?>

    <div id="<?php echo esc_attr($html_id);?>" class="cms-testimonial-carousel layout1 svg-nav owl-carousel <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?> <?php echo esc_attr($parallax_speed); ?> style="<?php if(!empty($background)) { echo 'background-color:'.esc_attr($background).';'; } ?>">
        <?php foreach ($testimonials as $key => $value) {
            $image = isset($value['image']) ? $value['image'] : '';
            $image_url = '';
            $image_alt = '';
            if (!empty($image)) {
                $attachment_image = wp_get_attachment_image_src($image, 'thumbnail');
                $image_url = $attachment_image[0];
                $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                if (empty($image_alt)){
                    $image_alt = esc_html__('avatar-image', 'optime');
                }
            }
            $content = isset($value['content']) ? $value['content'] : '';
            $signature_image = isset($value['signature_image']) ? $value['signature_image'] : '';
            $sig_image_url = '';
            $sig_image_alt = '';
            if (!empty($signature_image)) {
                $sig_attachment_image = wp_get_attachment_image_src($signature_image, 'thumbnail');
                $sig_image_url = $sig_attachment_image[0];
                $sig_image_alt = get_post_meta($signature_image, '_wp_attachment_image_alt', true);
                if (empty($sig_image_alt)){
                    $sig_image_alt = esc_html__('signature-image', 'optime');
                }
            }
            $position = isset($value['position']) ? $value['position'] : '';
            ?>
            <div class="cms-testimonial-item <?php echo esc_attr( $animation_classes ); ?>">
                <div class="cms-testimonial-item-inner">
                    <?php if(!empty($image_url)): ?>
                        <div class="cms-testimonial-avatar"><img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" /></div>
                    <?php endif; ?>
                    <div class="cms-testimonial-content clearfix" style="<?php if(!empty($content_color)) { echo 'color:'.esc_attr($content_color).';'; } ?>">
                        <p class="content"><?php echo esc_html($content); ?></p>
                    </div>
                    <?php if(!empty($sig_image_url)): ?>
                        <div class="cms-testimonial-signature"><img src="<?php echo esc_url( $sig_image_url ); ?>" alt="<?php echo esc_attr( $sig_image_alt ); ?>" /></div>
                    <?php endif;
                    if (!empty($position)) {
                        ?><p class="position" style="<?php if(!empty($position_color)) { echo 'color:'.esc_attr($position_color).';'; } ?>"><?php echo esc_html($position);?></p><?php
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>

<?php endif;?>