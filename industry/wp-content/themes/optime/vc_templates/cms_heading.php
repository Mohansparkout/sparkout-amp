<?php
extract(shortcode_atts(array(
    'text' => '',
    'tag' => 'h2',
    'title_font_size' => '',
    'title_line_height' => '',
    'font_weight' => '600',
    'text_color' => '',
    'align_text' => 'align-left',
    'custom_fonts' => 'false',
    'google_fonts' => '',
    'animation' => '',
    'el_class' => '',
    'el_parallax' => 'false',
    'el_parallax_speed' => '1.5',
), $atts));

$inline_style = '';
if($custom_fonts == 'true') {
    // Build the data array
    $googleFontsParam = new Vc_Google_Fonts();
    $fieldSettings = array();
    $text_font_data = strlen( $google_fonts ) > 0 ? $googleFontsParam->_vc_google_fonts_parse_attributes( $fieldSettings, $google_fonts ) : '';

    // Build the inline style
    if(isset($text_font_data['values']['font_family'])) {
        $fontFamily = explode( ':', $text_font_data['values']['font_family'] );
        $styles[] = 'font-family:' . $fontFamily[0];
    }
    if(isset($text_font_data['values']['font_style'])) {
        $fontStyles = explode( ':', $text_font_data['values']['font_style'] );
        //$styles[] = 'font-weight:' . $fontStyles[1];
        $styles[] = 'font-style:' . $fontStyles[2];
    }
    if(isset($text_font_data['values']['font_family']) || isset($text_font_data['values']['font_style'])) {
        foreach( $styles as $attribute ){
            $inline_style .= $attribute.'; ';
        }
    }
    // Enqueue the right font
    $settings = get_option( 'wpb_js_google_fonts_subsets' );
    if ( is_array( $settings ) && ! empty( $settings ) ) {
        $subsets = '&subset=' . implode( ',', $settings );
    } else {
        $subsets = '';
    }
    // We also need to enqueue font from googleapis
    if ( isset( $text_font_data['values']['font_family'] ) ) {
        wp_enqueue_style(
            'vc_google_fonts_' . vc_build_safe_css_class( $text_font_data['values']['font_family'] ),
            '//fonts.googleapis.com/css?family=' . $text_font_data['values']['font_family'] . $subsets
        );
    }
} else {
    $inline_style = '';
}
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('digiton-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}

$styles_title = array(
    'color'         => $text_color,
    'font-size'     => $title_font_size,
    'line-height'     => $title_line_height,
    'font-weight'   => $font_weight,
);
$title_styles = '';
foreach ($styles_title as $key => $value) {
    if (!empty($value)) {
        $title_styles .= $key . ':' . $value . ';';
    }
}

$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
?>

<?php if(!empty($text)):?>
<div id="<?php echo esc_attr($atts['html_id']);?>" class="cms-heading <?php echo esc_attr( $el_class.' '.$align_text.' '.$el_parallax_class.' '.$animation_classes ); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <div class="title-heading">
        <<?php echo esc_attr( $tag );?> class="heading-tag" <?php echo !empty($title_styles || $inline_style) ? 'style="' . esc_attr($title_styles) . ' '. $inline_style .'"' : '' ?>>
            <?php echo wp_kses_post( $text ); ?>
        </<?php echo esc_attr( $tag ); ?>>
    </div>
</div>
<?php endif;?>
