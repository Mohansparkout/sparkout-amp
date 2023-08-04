<?php
extract(shortcode_atts(array(
    'title'         => '',
    'title_color'         => '',
    'grouping'         => '0',
    'separator'         => '',
    'digit'         => '',
    'prefix'         => '',
    'suffix'         => '',
    'el_class'         => '',
    'animation'         => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
    'icon_image'   => '',
    //setting
    'fontsize_title'   => '14px',
    'color_title'   => '#222',
    'fontsize_digit'   => '33px',
    'color_digit'   => '#222',

), $atts));
wp_enqueue_script( 'waypoints' );
wp_enqueue_script( 'optime-counter-lib' );
wp_enqueue_script( 'optime-counter' );
$html_id = cmsHtmlID('cms-counter');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
$icon_image_url = '';
if (!empty($icon_image)) {
    $attachment_image = wp_get_attachment_image_src($icon_image, 'full');
    $icon_image_url = $attachment_image[0];
}
?>
<div id="<?php echo esc_attr($html_id);?>" class="cms-counter layout2 <?php echo esc_attr( $el_parallax_class.' '.$animation_classes.' '.$el_class ); ?>" <?php echo esc_attr($parallax_speed); ?>>

    <div class="cms-counter-inner">
        <?php if(!empty($icon_image_url) || !empty($digit)) : ?>
        <div class="cms-counter-content">
            <div class="cms-counter-content-inner">
                <?php if(!empty($icon_image_url)) { ?>
                    <div class="cms-counter-icon">
                        <img src="<?php echo esc_url( $icon_image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>"/>
                    </div>
                <?php } ?>
                <span id="<?php echo esc_attr($html_id);?>-digit" class="cms-counter-digit" data-grouping="<?php echo esc_attr($grouping); ?>" data-separator="<?php echo esc_attr($separator); ?>" data-digit="<?php echo esc_attr($digit);?>" data-prefix="<?php echo esc_attr($prefix);?>" data-suffix="<?php echo esc_attr($suffix);?>" style="font-size: <?php echo esc_attr($fontsize_digit);?>; color: <?php echo esc_attr($color_digit);?>; "></span>
                <?php if(!empty($title)) : ?>
                    <p class="cms-counter-title" style="font-size: <?php echo esc_attr($fontsize_title);?>; color: <?php echo esc_attr($color_title);?>; ">
                        <?php echo apply_filters('the_title',$title);?>
                    </p>
                <?php endif;?>
            </div>
        </div>
    <?php endif; ?>

</div>
</div>

<?php
if(!empty($bg_icon_hover)) {
    ob_start();
    ?>
    #<?php echo esc_attr($html_id);?> .cms-counter-content-inner .cms-counter-icon:hover {
        background-color: <?php echo esc_attr($bg_icon_hover); ?> !important;
    }
    <?php
    $dynamic_css = ob_get_clean();
    if (function_exists('cms_inline_css')){
        cms_inline_css($dynamic_css);
    }
}
?>
