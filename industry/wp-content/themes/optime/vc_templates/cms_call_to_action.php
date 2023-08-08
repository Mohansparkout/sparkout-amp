<?php
extract(shortcode_atts(array(
    'title' => '',
    'subtitle' => '',
    'button_text' => '',
    'button_link' => '',
    'animation'   => '',
    'el_class'   => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',

    //setting
    'color_subtitle' => '#222',
    'color_title' => '#222',
), $atts));

$link = vc_build_link($button_link);
$a_href = '';
$a_target = '';
if ( strlen( $link['url'] ) > 0 ) {
    $a_href = $link['url'];
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
?>
<div class="cms-call-to-action layout1 <?php echo esc_attr($el_parallax_class.' '.$el_class.' '.$animation_classes); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <?php if(!empty($title)) : ?>
        <div class="cms-cta-title">
            <h2 style="color: <?php echo esc_attr($color_title); ?>;"><?php echo wp_kses_post($title); ?></h2>
        </div>
    <?php endif; ?>
    <?php if(!empty($subtitle)) : ?>
        <div class="cms-cta-subtitle">
            <p style="color: <?php echo esc_attr($color_subtitle); ?>;"><?php echo esc_attr($subtitle); ?></p>
        </div>
    <?php endif; ?>
    <div class="item-button">
        <?php if(!empty($button_text)) : ?>
            <a href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>" class="btn">
                <span><?php echo esc_attr($button_text); ?></span>
            </a>
        <?php endif; ?>
    </div>
</div>
