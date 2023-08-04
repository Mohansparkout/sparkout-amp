<?php
extract(shortcode_atts(array(
    'fancybox_item' => '',
    'title_color' => '#fff',
    'description_color' => '',
    'el_class' => '',
    'animation' => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',

), $atts));

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'optime-carousel' );
$html_id = cmsHtmlID('cms-fancybox-carousel');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
extract(optime_get_param_carousel($atts));
$fancyboxs = (array) vc_param_group_parse_atts($fancybox_item);
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
if(!empty($fancyboxs)) : ?>
    <div id="<?php echo esc_attr($html_id);?>" class="cms-fancybox-carousel default owl-carousel <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?> <?php echo esc_attr($parallax_speed); ?>>
        <?php foreach ($fancyboxs as $key => $value) {
            $title = isset($value['title']) ? $value['title'] : '';
            $description = isset($value['description']) ? $value['description'] : '';
            $image = isset($value['image']) ? $value['image'] : '';
            $image_url = '';
            $image_alt = '';
            if (!empty($image)) {
                $attachment_image = wp_get_attachment_image_src($image, 'thumbnail');
                $image_url = $attachment_image[0];
                $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                if (empty($image_alt)){
                    $image_alt = $title;
                }
            }
            ?>
            <div class="fancybox-item-wrap <?php echo esc_attr( $animation_classes ); ?>">
                <div class="cms-fancybox-item">
                    <?php if(!empty($image_url)): ?>
                        <div class="cms-fancybox-icon">
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr($image_alt);?>" />
                        </div>
                    <?php endif; ?>
                    <div class="cms-fancybox-content">
                        <?php if(!empty($title)) : ?>
                            <h5 class="cms-fancybox-title" style="<?php if(!empty($title_color)) { echo 'color:'.esc_attr($title_color).';'; }?>">
                                <?php echo wp_kses_post( $title ); ?>
                            </h5>
                        <?php endif;?>
                        <?php if($description) : ?>
                            <div class="cms-fancybox-description" <?php if(!empty($description_color)) : ?> style="<?php if(!empty($description_color)) { echo 'color:'.esc_attr($description_color).';'; } ?>" <?php endif; ?>>
                                <p><?php echo wp_kses_post( $description ); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

<?php endif;?>