<?php
$atts_extra = shortcode_atts(array(
    'gallery_list'      => '',
    'gap'                  => '30',
    'post_ids'             => '',
    'col_lg'               => 4,
    'col_md'               => 3,
    'col_sm'               => 2,
    'col_xs'               => 1,
    'layout'               => 'basic',
    'filter'               => 'true',
    'filter_default_title' => 'All',
    'filter_alignment'     => 'center',
    'left_heading' => '',
    'filter_title_color'     => 'secondary',
    'filter_title_color1'     => '',
    'title_link'     => '',
    'grid_title'     => '',
    'grid_title_font_size'     => '',
    'grid_desc'     => '',
    'grid_desc_font_size'     => '',
    'grid_title_color'     => '',
    'grid_desc_color'     => '',
    'el_class'             => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts);

$atts = array_merge($atts_extra, $atts);
extract($atts);
$filter_default_title = !empty($filter_default_title) ? $filter_default_title : 'All';

$col_lg = 12 / $col_lg;
$col_md = 12 / $col_md;
$col_sm = 12 / $col_sm;
$col_xs = 12 / $col_xs;
$grid_sizer = "col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs} col-{$col_xs}";

$gap_item = intval($gap / 2);

wp_enqueue_style(
    'inline-style',
    get_template_directory_uri() . '/assets/css/inline-style.css'
);

$grid_class = '';
if ($layout == 'masonry') {
    wp_enqueue_script('isotope');
    wp_enqueue_script('imagesloaded');
    wp_enqueue_script('optime-isotope', get_template_directory_uri() . '/assets/js/isotope.cms.js', array('jquery'), '1.0.0', true);
    $grid_class = 'cms-grid-inner cms-grid-masonry row';
} else {
    $grid_class = 'cms-grid-inner row';
}
$cms_content_list = array();
$cms_content_list = (array) vc_param_group_parse_atts( $gallery_list );
$item['category'] = '';
?>

<div id="<?php echo esc_attr($html_id) ?>" class="cms-grid cms-gallery-grid images-light-box clearfix ">
    <?php if ($filter == "true" and $layout == 'masonry'): ?>
        <?php
        if ( $filter_alignment == 'right' and !empty($left_heading) ){
            ?><h2><?php echo esc_html($left_heading)?></h2><?php
        }
        ?>
        <div class="grid-filter-wrap filter-<?php echo esc_attr($filter_title_color); ?> align-<?php echo esc_attr($filter_alignment); ?>">
            <span class="filter-item active" data-filter="*"><?php echo esc_html($filter_default_title); ?></span>
            <?php $cat_list = array();
            foreach ( $cms_content_list as $item ) {
                $item_category = isset($item['category']) ? $item['category'] : '';
                $c_a = explode(',',$item_category);
                foreach ( $c_a as $c){
                  $r_c = str_replace(' ', '-', strtolower(trim($c)));
                  $cat_list[$r_c] = $c;
              }
          }
          ?>
          <?php foreach ($cat_list as $key => $value):
            ?>
            <span class="filter-item" data-filter="<?php echo esc_attr('.' . $key); ?>">
                <?php echo esc_attr($value); ?>
            </span>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php if(!empty($header_content)) :?>
        <div class="cms-grid-header-content">
            <?php echo esc_html($header_content); ?>
        </div>
    <?php endif; ?>
    <div class="<?php echo esc_attr($grid_class); ?>" data-gutter="<?php echo esc_attr($gap_item); ?>">
    <?php if ($layout == 'masonry') : ?>
        <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
    <?php endif; ?>
    <?php foreach ($cms_content_list as $key => $value) {
        $grid_title = isset($value['grid_title']) ? $value['grid_title'] : '';
        $grid_title_font_size = isset($value['grid_title_font_size']) ? $value['grid_title_font_size'] : '20px';
        $grid_desc_font_size = isset($value['grid_desc_font_size']) ? $value['grid_desc_font_size'] : '14px';
        $grid_desc = isset($value['grid_desc']) ? $value['grid_desc'] : '';
        $grid_desc_color = isset($value['grid_desc_color']) ? $value['grid_desc_color'] : '#ffffff';
        $grid_title_color = isset($value['grid_title_color']) ? $value['grid_title_color'] : '#01477f';
        $email = isset($value['email']) ? $value['email'] : '';
        $category = isset($value['category']) ? $value['category'] : '';
        $image = isset($value['image']) ? $value['image'] : '';
        $social = isset($value['social']) ? $value['social'] : '';
        $el_social = (array) vc_param_group_parse_atts( $social );
        $img_size = isset($value['img_size']) ? $value['img_size'] : '700x700';
        $image_title = get_the_title($image);
        $img = wpb_getImageBySize( array(
            'attach_id'  => $image,
            'thumb_size' => $img_size,
            'class'      => '',
        ));

        $title_link = isset($value['title_link']) ? $value['title_link'] : '';
        $link = vc_build_link($title_link);
        $a_href = '';
        $a_target = '';
        if ( strlen( $link['url'] ) > 0 ) {
            $a_href = $link['url'];
            $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
        }

        $thumbnail = $img['thumbnail'];
        $item_class = "grid-item col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs} col-{$col_xs}";
        $c_l = explode(',',$category);
        $filter_class_a = array();
        foreach ( $c_l as $c_c ) {
          $filter_class_a[] = str_replace(' ','-',trim(strtolower($c_c)));
      }
      $filter_class = implode(' ',$filter_class_a);
      ?>
    <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
        <div class="grid-item-inner">
            <span class="hover-effect cms-over">
                <?php if(!empty($image)) : ?>
                    <?php echo wp_kses_post($thumbnail); ?>
                <?php endif; ?>
            </span>
            <div class="grid-item-content">
                <div class="up-icon">
                    <a class="light-box" href="<?php echo esc_url(wp_get_attachment_image_url($image, 'full')); ?>" title="<?php echo esc_attr($image_title)?>">
                        <i class="zmdi zmdi-plus"></i>
                    </a>
                </div>
                <?php
                if (!empty($a_href)){
                    ?>
                    <div class="gallery-link">
                        <a class="gallery-image" href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target);?>" >
                            <i class="zmdi zmdi-link"></i>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php } ?>
</div>
</div>
<?php
ob_start();
if (!empty($filter_title_color1)){
    ?>
    .filter-custom.grid-filter-wrap span {
        color: <?php echo esc_attr($filter_title_color1); ?>;
    }
    <?php
}
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