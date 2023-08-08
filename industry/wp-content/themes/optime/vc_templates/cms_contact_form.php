<?php
extract(shortcode_atts(array(
    'id'        => '',
    'title'        => '',
    'title_icon'        => '',
    'animation' => '',
    'el_class'  => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
if(class_exists('WPCF7')) { ?>
    <div class="cms-contact-form cms-contact-form-default <?php if (!empty($title)){echo esc_attr('has-title');} ?> <?php echo esc_attr( $el_parallax_class.' '.$el_class.' '.$animation_classes )?>" <?php echo esc_attr($parallax_speed); ?>>
        <?php
        if (!empty($title)){
            $image = $title_icon;
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
            <div class="title">
                <?php
                if (!empty($image_url)){
                    ?><img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr($image_alt); ?>" /><?php
                }
                ?>
                <h3><?php echo esc_html($title); ?></h3>
            </div>
            <?php
        }
        ?>
        <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $id ).'"]'); ?>
    </div>
<?php } ?>