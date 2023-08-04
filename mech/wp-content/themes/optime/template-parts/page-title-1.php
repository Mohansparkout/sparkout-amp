<?php

$titles = optime_get_page_titles();
ob_start();
if ( $titles['title'] )
{
    printf( '<h1 class="page-title ft-heading-b">%s</h1>', wp_kses_post($titles['title']) );
}
if ( ( is_page() && get_post_meta( get_the_ID(), 'breadcrumb_on', true ) ) || optime_get_opt( 'breadcrumb_on', false ) )
{
    optime_breadcrumb();
}
$titles_html = ob_get_clean();
$header_layout = optime_get_opt('header_layout','1');
$page_header_layout = optime_get_page_opt('header_layout','1');
$absolute_header = false;
if ($header_layout == '1' || $header_layout == '3'){
    $absolute_header = true;
}
if (!is_search() && ($page_header_layout == '2' || $page_header_layout == '4')){
    $absolute_header = false;
}

$p_title_bg = optime_get_opt('page_ptitle_bg');
$custom_product_page_title = optime_get_opt('custom_product_page_title');
$bg['background-image'] = isset($p_title_bg['background-image'])?$p_title_bg['background-image']:'';
if(is_page()){
    $p_title_bg = optime_get_page_opt('page_ptitle_bg');
    $bg['background-image'] = isset($p_title_bg['background-image'])?$p_title_bg['background-image']:'';
}
if(is_singular('portfolio') || is_singular('service')){
    $bg['background-image'] = get_the_post_thumbnail_url(get_the_ID(),'full');
}

if(class_exists('WooCommerce')) {
    if (is_shop()) {
        $shop_id = get_option('woocommerce_shop_page_id', '');
        $bg = get_post_meta($shop_id, 'page_ptitle_bg', true);
    }
    if($custom_product_page_title) {
        if (is_singular('product')) {
            $bg = optime_get_opt('product_page_title_bg', true);
        }
    }
}
?>
<div id="pagetitle" style="<?php if(!empty($bg['background-image'])){?>background-image:url('<?php echo esc_attr($bg['background-image']); ?>');<?php } ?>"  class="page-title page-title-layout2 overlay-gradient <?php if($absolute_header){?>absolute-header<?php } ?>">
    <div class="container">
        <div class="page-title-inner">
            <?php printf( '%s', wp_kses_post($titles_html)); ?>
        </div>
    </div>
</div>