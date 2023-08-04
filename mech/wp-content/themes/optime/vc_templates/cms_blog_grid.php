<?php
$atts_extra = shortcode_atts(array(
    'source'               => '',
    'orderby'              => 'date',
    'order'                => 'DESC',
    'limit'                => '6',
    'gap'                  => '30',
    'post_ids'             => '',
    'col_lg'               => 3,
    'col_md'               => 2,
    'col_sm'               => 2,
    'col_xs'               => 1,
    'layout'               => 'masonry',
    'pagination_type'      => 'false',
    'filter'               => 'false',
    'filter_default_title' => 'All',
    'filter_alignment'     => 'left',
    'filter_title_color'     => 'primary',
    'el_class'             => '',
    'img_size'             => 'full',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts);
$atts = array_merge($atts_extra, $atts);
extract($atts);
$tax = array();
extract(cms_get_posts_of_grid('post', $atts));
$filter_default_title = !empty($filter_default_title) ? $filter_default_title : 'All';

$col_lg = 12 / $col_lg;
$col_md = 12 / $col_md;
$col_sm = 12 / $col_sm;
$col_xs = 12 / $col_xs;
$grid_sizer = "col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
$gap_item = intval($gap / 2);
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
$grid_class = '';
if ($layout == 'masonry') {
    wp_enqueue_script('isotope');
    wp_enqueue_script('imagesloaded');
    wp_enqueue_script('optime-isotope', get_template_directory_uri() . '/assets/js/isotope.cms.js', array('jquery'), '1.0.0', true);
    $grid_class = 'cms-grid-inner cms-grid-masonry row';
    if($pagination_type == 'loadmore'|| $pagination_type === 'pagination') {
        $html_id = str_replace('-', '_', $html_id);
        wp_enqueue_script('cms-loadmore-grid', get_template_directory_uri() . '/assets/js/cms-loadmore-grid.js', array('jquery'), 'all', true);
        wp_localize_script('cms-loadmore-grid', 'cms_load_more_' . $html_id, array(
            'startPage' => $paged,
            'maxPages'  => $max,
            'total'     => $total,
            'perpage'   => $limit,
            'nextLink'  => $next_link,
            'layout'    => $layout
        ));
    }
} else {
    $grid_class = 'cms-grid-inner row';
}
wp_enqueue_script( 'vc_waypoints' );
wp_enqueue_style( 'vc_animate-css' );
?>

<div id="<?php echo esc_attr($html_id) ?>" class="cms-grid cms-grid-blog layout1 cms-grid-layout-modern <?php echo esc_attr($el_parallax_class.' '.$el_class); ?>" <?php echo esc_attr($parallax_speed); ?>>

    <?php if ($filter == "true" and $layout == 'masonry'): ?>
        <div class="grid-filter-wrap filter-<?php echo esc_attr($filter_title_color); ?> align-<?php echo esc_attr($filter_alignment); ?>">
            <span class="filter-item active" data-filter="*"><?php echo esc_html($filter_default_title); ?></span>
            <?php foreach ($categories as $category): ?>
                <?php $category_arr = explode('|', $category); ?>
                <?php $tax[] = $category_arr[1]; ?>
                <?php $term = get_term_by('slug',$category_arr[0], $category_arr[1]); ?>

                <span class="filter-item" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                    <?php echo esc_html($term->name); ?>
                </span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="<?php echo esc_attr($grid_class); ?> animation-time" data-gutter="<?php echo esc_attr($gap_item); ?>">
        <?php
        if (is_array($posts)):
            $sizes = explode(',',$img_size);
            $i = 0;
            foreach ($posts as $post) {
                $default_size = end($sizes);
                if(!empty($sizes[$i])){
                    $default_size = $sizes[$i];
                }
                $item_class   = "grid-item col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = cms_get_term_of_post_to_class($post->ID, array_unique($tax));
                ?>
                    <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                        <div class="grid-item-inner wpb_animate_when_almost_visible wpb_fadeIn fadeIn">
                            <?php
                            if (has_post_thumbnail($post->ID)) {
                                echo '<div class="item-featured">'; ?>
                                <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>"><?php echo get_the_post_thumbnail($post->ID,$default_size); ?></a>
                                <div class="overlay-gradient"></div>
                                <?php echo '</div>';
                            }
                            ?>
                            <div class="item-holder">
                                <div class="entry-meta">
                                    <div class="cats-meta">
                                        <?php optime_limit_the_terms($post->ID, 'category', 2);?>
                                    </div>
                                </div>
                                <h3 class="item-title">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                                </h3>
                                <p class="date"><?php $date_formart = get_option('date_format'); echo get_the_date($date_formart, $post->ID); ?></p>
                                <div class="item-content">
                                    <?php echo wp_trim_words( $post->post_excerpt, $num_words = 28, $more = null ); ?>
                                </div>
                                <div class="item-readmore">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html__('Read More', 'optime'); ?><i class="zmdi zmdi-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $i++;
            }
        endif; ?>
        <?php if ($layout == 'masonry') : ?>
            <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        <?php endif; ?>
    </div>

    <?php if ($layout == 'masonry' && $pagination_type == 'pagination') { ?>
        <div class="cms-grid-pagination">
            <?php optime_posts_pagination(); ?>
        </div>
    <?php } ?>
    <?php if (!empty($next_link) && $layout == 'masonry' && $pagination_type == 'loadmore') { ?>
        <div class="cms-load-more text-center">
            <div class="btn">
                <span class="text"><?php echo esc_html__('Load More', 'optime') ?></span>
                <span class="loading-icon"><i class="fa"></i></span>
            </div>
        </div>
    <?php } ?>
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