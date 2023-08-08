<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Optime
 */

if ( class_exists( 'WooCommerce' ) && (is_shop() || is_product()) ) {
    dynamic_sidebar( 'sidebar-shop' );
} else {
    if (is_singular('portfolio') || is_singular('industry')){
        dynamic_sidebar( 'sidebar-portfolio' );
    }else if (is_singular('service')){
        dynamic_sidebar( 'sidebar-service' );
    }else{
        dynamic_sidebar( 'sidebar-blog' );
    }
}