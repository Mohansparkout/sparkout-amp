<?php
$atts_extra = shortcode_atts(array(
    'source'               => '',
    'orderby'              => 'date',
    'order'                => 'DESC',
    'limit'                => '6',
    'gap'                  => '30',
    'post_ids'             => '',
    'col_lg'               => 3,
    'col_md'               => 3,
    'col_sm'               => 2,
    'col_xs'               => 1,
    'el_class'             => '',
    'pagination_type'      => 'pagination',
    'el_parallax'        => 'false',
    'el_parallax_speed'   => '1.5',
), $atts);
$atts = array_merge($atts_extra, $atts);
extract($atts);
$tax = array();
extract(cms_get_posts_of_grid('service', $atts));

$col_lg = 12 / $col_lg;
$col_md = 12 / $col_md;
$col_sm = 12 / $col_sm;
$col_xs = 12 / $col_xs;
$grid_sizer = "col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
$gap_item = intval($gap / 2);
$grid_class = 'cms-grid-inner row';
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
wp_enqueue_script( 'vc_waypoints' );
wp_enqueue_style( 'vc_animate-css' );
?>
<div id="<?php echo esc_attr($html_id) ?>" class="cms-grid cms-services-grid layout1 <?php echo esc_attr($el_parallax_class.' '.$el_class); ?>" <?php echo esc_attr($parallax_speed); ?>>
    <div class="<?php echo esc_attr($grid_class); ?> animation-time" data-gutter="<?php echo esc_attr($gap_item); ?>">
        <?php if (is_array($posts)):
            foreach ($posts as $key => $post) {
                $item_class   = "grid-item col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs} col-{$col_xs}";
                $icon_image = get_post_meta($post->ID, 'service_icon',true);
                ?>
                <div class="<?php echo esc_attr($item_class); ?>">
                    <div class="grid-item-inner style1 wpb_animate_when_almost_visible wpb_fadeIn fadeIn">
                        <div class="item-holder">
                            <?php
                            if (!empty($icon_image['url'])){
                                ?>
                                <div class="icon-wrap">
                                    <img class="service-icon" src="<?php echo esc_url($icon_image['url']); ?>" alt="<?php if(isset($icon_image['alt'])) { echo esc_attr($icon_image['alt']); } else { echo esc_attr($post->post_title); } ?>">
                                </div>
                                <?php
                            }
                            ?>
                            <h4>
                                <a href="<?php echo esc_url(get_the_permalink($post->ID));?>"><?php echo get_the_title($post->ID);?></a>
                            </h4>
                            <div class="item-content">
                                <?php echo wp_trim_words( $post->post_excerpt, $num_words = 25, $more = null ); ?>
                            </div>
                            <div class="item-readmore">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html__('Read More', 'optime'); ?><i class="zmdi zmdi-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        endif; ?>
    </div>
</div>
<?php
ob_start();
$html_id_el = '#'.$html_id;
?>
<?php echo esc_attr($html_id_el); ?> .cms-grid-inner {
    margin: 0 -<?php echo esc_attr($gap_item); ?>px;
    }
<?php echo esc_attr($html_id_el); ?> .cms-grid-inner .grid-item, <?php echo esc_attr($html_id_el); ?> .cms-grid-inner .grid-sizer {
    padding: <?php echo esc_attr($gap_item); ?>px !important;
    }
<?php
$dynamic_css = ob_get_clean();
if (function_exists('cms_inline_css')){
    cms_inline_css($dynamic_css);
}
?>