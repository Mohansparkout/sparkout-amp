<?php
extract(shortcode_atts(array(
	'video_source' => 'https://www.youtube.com/watch?v=SF4aHwxHtZ0',
	'video_autoplay' => false,
	'video_image' => '',
	'image_height' => '527px',
	'button_style' => 'default',
	'button_size' => 'size-default',
	'button_text' => '',
	'popup_style' => '',
	'animation' => '',
	'el_class' => '',
	'el_parallax' => 'false',
	'el_parallax_speed' => '1.5',
), $atts));
$html_id = cmsHtmlID('cms-video-popup');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation($animation_tmp);
$el_parallax_class = '';
$parallax_speed = '';
if (isset($el_parallax) && $el_parallax == 'true') {
	wp_enqueue_script('optime-parallax');
	$el_parallax_class = 'el-parallax';
	$parallax_speed = 'data-speed=' . $el_parallax_speed . '';
}
$background_image = '';
if ($popup_style != "video-no-image") {
	$background_image .= 'background:url(' . wp_get_attachment_image_src($video_image, 'full')[0] . ');';
	$background_image .= 'height' . ':' . $image_height . ';';
}
?>

<div id="<?php echo esc_attr($html_id) ?>" class="cms-video-popup <?php echo esc_attr($el_parallax_class . ' ' . $el_class . ' ' . $animation_classes); ?>"  <?php echo esc_attr($parallax_speed); ?>>
    <div class="cms-video-popup-content bg-image" <?php echo !empty($background_image) ? 'style="' . esc_attr($background_image) . '"' : '' ?>>
        <a class="<?php echo esc_attr($button_style) . ' ';if ($video_autoplay) { ?>video-autoplay<?php } else {?>video-no-autoplay<?php }?> play-video-button <?php if ($popup_style != "video-no-image") {echo 'has-image';}?>" href="<?php echo esc_url($video_source); ?>">
            <div class="icon <?php echo esc_attr($button_size); ?>">
                <i class="fa fa-play"></i>
                <span class="radar"></span>
            </div>
            <?php if (!empty($button_text)) {?>
                <p class="button-text"><?php echo wp_kses_post($button_text); ?></p>
            <?php }?>
        </a>
    </div>
</div>