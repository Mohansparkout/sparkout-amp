<?php
/**
 * Template part for displaying site branding
 */
//Site logo
$logo_light = optime_get_opt( 'logo_light', array( 'url' => '', 'id' => '' ) );
$logo_light_url = $logo_light['url'];

//Sticky is logo dark
$logo_dark = optime_get_opt( 'logo_dark', array( 'url' => '', 'id' => '' ) );
$logo_dark_url = $logo_dark['url'];

$logo_mobile = optime_get_opt( 'logo_mobile', array( 'url' => '', 'id' => '' ) );
$logo_mobile_url = $logo_mobile['url'];

if ($logo_dark_url || $logo_light_url || $logo_mobile_url)
{
    if ( is_front_page() && is_home() ) {
        printf('<h1 class="site-title" style="display: none;">%1$s</h1>', esc_attr( get_bloginfo( 'name' ) ));
    }
    printf(
        '<a class="logo-light" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_light_url )
    );
    printf(
        '<a class="logo-dark" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_dark_url )
    );
    printf(
        '<a class="logo-mobile" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_mobile_url )
    );
    if ( is_front_page() && is_home() ) {
        printf('</h1>');
    }
}
else
{
    printf(
        '<a class="logo-dark" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( get_template_directory_uri().'/assets/images/logo-dark.png' )
    );
    printf(
        '<a class="logo-light" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( get_template_directory_uri().'/assets/images/logo-light.png' )
    );
    printf(
        '<a class="logo-mobile" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( get_template_directory_uri().'/assets/images/logo-dark.png' )
    );
}