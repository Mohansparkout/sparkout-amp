<?php
extract(shortcode_atts(array(
    'background_color' => '#fff',
    'fancybox_padding' => '10px 0 0',
    'title' => '',
    'title_font_size' => '18px',
    'title_margin_top' => '26px',
    'title_line_height' => '',
    'title_color' => '',
    'description' => '',
    'description_font_size' => '15px',
    'description_color' => '',
    'icon_list' => 'image_icon',
    'icon_fontawesome' => '',
    'image_icon' => '',
    'img_max_height' => '247px',
    'icon_color' => '',
    'icon_font_size' => '',
    'icon_align_vertical' => 'middle',
    'animation' => '',
    'el_class' => '',
    'icon_styles' => 'normal',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
$icon = $image_icon;
if($icon_list == 'fontawesome'){
    $icon  = $icon_fontawesome;
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
<div class="cms-fancybox <?php if (empty($description)){echo esc_attr('no-desc');} ?> layout2 <?php echo esc_attr($el_parallax_class.' '.$el_class.' '.$animation_classes); ?>" <?php echo esc_attr($parallax_speed); ?> style="background-color:<?php echo esc_attr($background_color);?>;padding:<?php echo esc_attr($fancybox_padding);?>;">
    <div class="cms-fancybox-inner clearfix">
        <?php
        if (!empty($icon)){
            ?>
            <div class="cms-fancybox-icon" style="<?php if(!empty($img_max_height)) { echo 'height:'.esc_attr($img_max_height).';'; } ?>">
                <?php if($icon_list == 'image_icon'){?>
                    <img src="<?php echo wp_get_attachment_image_src($icon,'full')[0]; ?>" alt="<?php echo esc_attr($title);?>" style="<?php if(!empty($img_max_height)) { echo 'max-height:'.esc_attr($img_max_height).';'; } ?>">
                <?php }else{?>
                    <i class="<?php echo esc_attr($icon); ?>" style="<?php if(!empty($icon_font_size)) { echo 'font-size:'.esc_attr($icon_font_size).';'; } if(!empty($icon_color)){echo 'color:'.esc_attr($icon_color).';';} ?>"></i>
                <?php }?>
            </div>
            <?php
        }
        ?>
        <div class="cms-fancybox-content" style="<?php if(!empty($title_margin_top)) { echo 'margin-top:'.esc_attr($title_margin_top).';'; }?>">
            <?php if(!empty($title)) : ?>
                <h5 class="cms-fancybox-title" style="<?php echo 'font-size:'.esc_attr($title_font_size).'; ';if(!empty($title_color)) { echo 'color:'.esc_attr($title_color).';'; } if(!empty($title_line_height)) { echo 'line-height:'.esc_attr($title_line_height).';'; }?>">
                    <?php echo wp_kses_post( $title ); ?>
                </h5>
            <?php endif;?>
            <?php if($description) : ?>
                <div class="cms-fancybox-description" <?php if(!empty($description_color)) : ?> style="<?php if(!empty($description_color)) { echo 'color:'.esc_attr($description_color).';'; } ?>" <?php endif; ?>>
                    <p style="<?php echo 'font-size:'.esc_attr($description_font_size).'; ';?>"><?php echo wp_kses_post( $description ); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>