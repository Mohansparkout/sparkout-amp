<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Optime
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function optime_body_classes( $classes )
{
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    if (optime_get_opt( 'site_boxed', false )) {
        $classes[] = 'site-boxed';
    }

    if ( class_exists('WPBakeryVisualComposerAbstract') ) {
        $classes[] = 'visual-composer';
    }

    return $classes;
}
add_filter( 'body_class', 'optime_body_classes' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function optime_pingback_header()
{
    if ( is_singular() && pings_open() )
    {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'optime_pingback_header' );
