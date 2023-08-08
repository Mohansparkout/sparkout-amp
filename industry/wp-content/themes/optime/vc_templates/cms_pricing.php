<?php
$atts_extra = shortcode_atts( array(
	'content_list'              => '',
	'content_list_pricing_body' => '',
	'post_ids'                  => '',
	'col_lg'                    => 4,
	'col_md'                    => 3,
	'col_sm'                    => 2,
	'col_xs'                    => 1,

    'title_fontsize'                 => '18px',
    'title_color'                 => '#121c45',
    'desc_fontsize'                 => '13px',
    'desc_color'                 => '#616161',
    'price_fontsize'                 => '80px',
    'price_color'                 => '#121c45',
    'position_fontsize'                 => '14px',
    'position_color'                 => '#121c45',
    'pribody_fontsize'                 => '14px',
    'pribody_color'                 => '#9b9b9b',

	'el_class'             => '',
	'el_parallax'          => 'false',
	'el_parallax_speed'    => '1.5',
), $atts );
$atts       = array_merge( $atts_extra, $atts );
extract( $atts );
vc_icon_element_fonts_enqueue( 'linecons' );
$col_lg     = 12 / $col_lg;
$col_md     = 12 / $col_md;
$col_sm     = 12 / $col_sm;
$col_xs     = 12 / $col_xs;
$grid_sizer = "col-xl-{$col_lg} col-lg-{$col_md} col-md-{$col_sm} col-sm-{$col_xs} col-{$col_xs}";
$grid_class = 'cms-pricing-inner row';

$html_id_el = '#' . $html_id;
$cms_content_list  = array();
$cms_content_list  = (array) vc_param_group_parse_atts( $content_list );
$el_parallax_class = '';
$parallax_speed    = '';
if ( isset( $el_parallax ) && $el_parallax == 'true' ) {
	wp_enqueue_script( 'optime-parallax' );
	$el_parallax_class = 'el-parallax';
	$parallax_speed    = 'data-speed=' . $el_parallax_speed . '';
}

?>

<div id="<?php echo esc_attr( $html_id ) ?>"
	class="cms-grid cms-grid-pricing <?php echo esc_attr( $el_parallax_class . ' ' . $el_class ); ?>" <?php echo esc_attr( $parallax_speed ); ?>>

	<div class="<?php echo esc_attr( $grid_class ); ?>">
		<?php foreach ( $cms_content_list as $key => $value ) {
			$cms_content_list_pricing_body_arr = vc_param_group_parse_atts( $value['content_list_pricing_body'] );
			$title                             = isset( $value['title'] ) ? $value['title'] : '';
            $description                       = isset( $value['description'] ) ? $value['description'] : '';
			$price                             = isset( $value['price'] ) ? $value['price'] : '';
			$price_position                    = isset( $value['price_position'] ) ? $value['price_position'] : '';
			$button_text                       = isset( $value['button_text'] ) ? $value['button_text'] : '';

			$icon_list            = isset( $value['icon_list'] ) ? $value['icon_list'] : 'fontawesome';
			$icon_fontawesome     = isset( $value['icon_fontawesome'] ) ? $value['icon_fontawesome'] : '';
			$icon_material_design = isset( $value['icon_material_design'] ) ? $value['icon_material_design'] : '';
			$icon_linecons        = isset( $value['icon_linecons'] ) ? $value['icon_linecons'] : '';
            $button_text                       = isset( $value['button_text'] ) ? $value['button_text'] : '';
            $button_link                       = isset( $value['button_link'] ) ? $value['button_link'] : '';
			$link     = vc_build_link( $button_link );
			$a_href   = '';
			$a_target = '';
			if ( strlen( $link['url'] ) > 0 ) {
				$a_href   = $link['url'];
				$a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
			}

			$icon_name  = "icon_" . $icon_list;
			$icon_class = isset( ${$icon_name} ) ? ${$icon_name} : '';


			$item_class = "grid-pricing-wrap col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs} col-{$col_xs}";

			?>
            <div class="<?php echo esc_attr( $item_class . ' ' ); ?>">
                <div class="grid-pricing-content">
                    <?php if ( ! empty( $price ) ) : ?>
                        <div class="pricing-title">
                            <h3 style="font-size: <?php echo esc_attr($title_fontsize); ?>; color: <?php echo esc_attr($title_color); ?>;">
                                <?php echo esc_attr( $title ); ?>
                            </h3>
                        </div>
                        <div class="pricing-description" style="font-size: <?php echo esc_attr($desc_fontsize); ?>; color: <?php echo esc_attr($desc_color); ?>;">
                            <?php echo esc_attr( $description );?>
                        </div>
                        <div class="number-position">
                            <div class="pricing-price-number" style="font-size: <?php echo esc_attr($price_fontsize); ?>; color: <?php echo esc_attr($price_color); ?>;">
                                <?php echo esc_attr( $price ); ?>
                            </div>
                            <div class="pricing-price-position" style="font-size: <?php echo esc_attr($position_fontsize); ?>; color: <?php echo esc_attr($position_color); ?>;">
                                <?php echo esc_attr( $price_position ); ?>
                            </div>
                        </div>
                        <div class="pricing-body">
                            <ul>
                                <?php foreach ( $cms_content_list_pricing_body_arr as $key => $value ) {
                                    $item_body = isset( $value['item_body'] ) ? $value['item_body'] : '';
                                    ?>
                                    <li style="font-size: <?php echo esc_attr($pribody_fontsize); ?>; color: <?php echo esc_attr($pribody_color); ?>;">
                                        <?php echo esc_attr( $item_body ); ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="item-button">
                            <a class="btn hover--slide" href="<?php echo esc_url( $a_href ); ?>" target="<?php echo esc_attr( $a_target ); ?>">
                                <?php echo esc_attr( $button_text ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
		<?php } ?>
	</div>


</div>