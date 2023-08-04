<?php

/* Remove result count & product ordering & item product category..... */
function optime_woocommerce_remove_function() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 0 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5, 0 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10, 0 );
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10, 0 );
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10, 0 );
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10, 0 );

    /*Single product*/
    //woocommerce_template_single_add_to_cart
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10,0);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10,0);
    // Remove the sorting dropdown from Woocommerce
    remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
// Remove the result count from WooCommerce
    remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );

}
add_action( 'init', 'optime_woocommerce_remove_function' );

add_filter('single_product_archive_thumbnail_size', 'optime_woocommerce_product_size');
function optime_woocommerce_product_size($size){
    $size = 'full';
    return $size;
}
/* Product Category */
add_action( 'woocommerce_after_shop_loop_item', 'optime_woocommerce_product' );
function optime_woocommerce_product() {
    ?>
    <div class="woocommerce-product-inner">
        <div class="woocommerce-product-header">
            <?php woocommerce_show_product_loop_sale_flash(); ?>
            <a href="<?php the_permalink(); ?>">
                <?php woocommerce_template_loop_product_thumbnail(); ?>
            </a>
            <div class="woocomerce-overlay-add-cart">
                <?php woocommerce_template_loop_add_to_cart();?>
            </div>
        </div>
        <div class="woocommerce-product-holder">
            <h3 class="woocommerce-product-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="woocommerce-product-meta clearfix">
                <?php woocommerce_template_loop_rating(); ?>
                <?php woocommerce_template_loop_price(); ?>
            </div>
        </div>
    </div>
<?php }
add_action('woocommerce_single_product_summary','woocommerce_single_price_ratings',11);
function woocommerce_single_price_ratings(){?>
    <div class="single-price-rating">
        <?php
        woocommerce_template_single_price();
        woocommerce_template_single_rating();
        ?>
    </div>
<?php }

add_action('woocommerce_before_single_product','optime_related_enqueue_crousel',11);
function optime_related_enqueue_crousel(){
    wp_enqueue_script( 'owl-carousel' );
    wp_enqueue_style( 'owl-carousel' );
    wp_enqueue_script( 'optime-carousel' );
}
/* Add the custom Tabs Specification */
function optime_custom_product_tab_specification( $tabs ) {
    $tabs['tab-product-feature'] = array(
        'title'    => esc_html__( 'Product Specification', 'optime' ),
        'callback' => 'optime_custom_tab_content_specification',
        'priority' => 10,
    );
    return $tabs;
}
/* Removes the "shop" title on the main shop page */
function optime_hide_page_title()
{
    return false;
}
add_filter('woocommerce_show_page_title', 'optime_hide_page_title');

/* Replace text Onsale */
add_filter( 'woocommerce_sale_flash', 'optime_replace_sale_text' );
function optime_replace_sale_text( $html ) {
    return str_replace( 'Sale!', 'Sale', $html );
}

function wpb_custom_billing_fields( $fields = array() ) {
    unset($fields['billing_address_2']);
    return $fields;
}
add_filter('woocommerce_billing_fields','wpb_custom_billing_fields');
add_filter('woocommerce_gallery_thumbnail_size',function($size){
    return array('full','full');
},10,2);

add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );

function iconic_cart_count_fragments( $fragments ) {

    $fragments['span.cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';

    return $fragments;

}

add_filter('woocommerce_product_review_comment_form_args', 'optime_add_fields_tag', 10,1);
function optime_add_fields_tag($comment_form){
    $commenter = wp_get_current_commenter();
    $comment_form['fields'] = array(
        'author' => '<div class="fields-wrap"><p class="comment-form-author">' .
            '<input id="author" name="author" type="text" placeholder="'.esc_html__( 'Name *', 'optime' ).'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required /></p>',
        'email'  => '<p class="comment-form-email">' .
            '<input id="email" name="email" placeholder="'.esc_html__( 'Email *', 'optime' ).'" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required /></p></div>',
    );
    return $comment_form;
}