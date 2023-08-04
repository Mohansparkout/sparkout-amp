<?php
/**
 * Functions and definitions
 *
 * @package Optime
 */
if (!function_exists('optime_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function optime_setup()
    {
        $footer_layout = optime_get_opt( 'footer_layout', '2' );
        // Make theme available for translation.
        load_theme_textdomain('optime', get_template_directory() . '/languages');

        // Custom Header
        add_theme_support("custom-header");

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'optime'),
        ));
        if($footer_layout == '8') :
            register_nav_menus(array(
                'menu-footer' => esc_html__('Menu Footer', 'optime'),
            ));
        endif;

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('optime_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for core custom logo.
        add_theme_support('custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ));
        add_theme_support('post-formats', array(
            'gallery',
            'video',
        ));

        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        /* Change default image thumbnail sizes in wordpress */
        update_option('thumbnail_size_w', 300);
        update_option('thumbnail_size_h', 300);
        update_option('thumbnail_crop', 1);
        update_option('medium_size_w', 600);
        update_option('medium_size_h', 600);
        update_option('medium_crop', 1);
        update_option('large_size_w', 980);
        update_option('large_size_h', 650);
        update_option('large_crop', 1);

        add_image_size('optime-medium', 600, 585, true);
        add_image_size('service-medium', 600, 400, true);
        add_image_size('optime-large', 1170, 700, true);
        // For WP 5.8
        remove_theme_support('widgets-block-editor');

    }
endif;
add_action('after_setup_theme', 'optime_setup');

add_action('cms_locations', function ($cms_locations){
    return $cms_locations;
});

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function optime_content_width()
{
    $GLOBALS['content_width'] = apply_filters('optime_content_width', 640);
}

add_action('after_setup_theme', 'optime_content_width', 0);

/**
 * Register widget area.
 */
function optime_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Blog Sidebar', 'optime'),
        'id'            => 'sidebar-blog',
        'description'   => esc_html__('Add widgets here.', 'optime'),
        'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Page Sidebar', 'optime'),
        'id'            => 'sidebar-page',
        'description'   => esc_html__('Add widgets here.', 'optime'),
        'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Case Study Sidebar', 'optime'),
        'id'            => 'sidebar-portfolio',
        'description'   => esc_html__('Add widgets here.', 'optime'),
        'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Service Sidebar', 'optime'),
        'id'            => 'sidebar-service',
        'description'   => esc_html__('Add widgets here.', 'optime'),
        'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    if(class_exists('Woocommerce')){
        register_sidebar(array(
            'name'          => esc_html__('Shop Sidebar', 'optime'),
            'id'            => 'sidebar-shop',
            'description'   => esc_html__('Add widgets here.', 'optime'),
            'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
            'after_widget'  => '</div></section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }
    if (class_exists('ReduxFramework')){
        $footer_layout = optime_get_opt( 'footer_layout', '1' );
        $footer_top_column = optime_get_opt( 'footer_top_column', '4' );
        if($footer_layout != '0' && isset($footer_top_column) && $footer_top_column) {
            for($i = 1 ; $i <= $footer_top_column ; $i++){
                register_sidebar(array(
                    'name' => sprintf(esc_html__('Footer Top %s', 'optime'), $i),
                    'id'            => 'sidebar-footer-' . $i,
                    'description'   => esc_html__('Add widgets here.', 'optime'),
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h6 class="footer-widget-title">',
                    'after_title'   => '</h6>',
                ));
            }
            register_sidebar(array(
                'name' => sprintf(esc_html__('Footer Bottom', 'optime')),
                'id'            => 'sidebar-footer-bottom',
                'description'   => esc_html__('Add widgets here.', 'optime'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h6 class="footer-widget-title">',
                'after_title'   => '</h6>',
            ));
        }
    }
}

add_action('widgets_init', 'optime_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function optime_scripts()
{
    $theme = wp_get_theme(get_template());
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.0.0');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0');
    wp_enqueue_style('font-material-icon', get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css', array(), '2.2.0');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.0.0');
    wp_enqueue_style('YouTubePopUp',get_template_directory_uri() . '/assets/css/YouTubePopUp.css',array(),'all');
    wp_enqueue_style('optime-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), $theme->get('Version'));
    wp_enqueue_style('optime-menu', get_template_directory_uri() . '/assets/css/menu.css', array(), $theme->get('Version'));
    wp_enqueue_style('optime-style', get_stylesheet_uri());
    wp_enqueue_style('optime-google-fonts', optime_fonts_url());
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    wp_enqueue_script('optime-nice-select', get_template_directory_uri() . '/assets/js/nice-select.min.js', array( 'jquery' ), 'all', true);
    wp_enqueue_script('optime-enscroll', get_template_directory_uri() . '/assets/js/enscroll.js', array( 'jquery' ), 'all', true);
    wp_enqueue_script('optime-match-height', get_template_directory_uri() . '/assets/js/match-height-min.js', array( 'jquery' ), '1.0.0', true);
    wp_enqueue_script('optime-magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('optime-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), $theme->get('Version'), true);
    wp_register_script('optime-carousel', get_template_directory_uri() . '/assets/js/cms-carousel.js', array('jquery'), $theme->get('Version'), true);
    wp_register_script('optime-carousel-filter', get_template_directory_uri() . '/assets/js/owl-filter.js', array('jquery'), $theme->get('Version'), true);
    wp_register_script('optime-counter-lib', get_template_directory_uri() . '/assets/js/counter.min.js', array('jquery'), $theme->get('Version'), true);
    wp_register_script('optime-counter', get_template_directory_uri() . '/assets/js/cms-counter.js', array('jquery'), $theme->get('Version'), true);
    wp_register_script('optime-parallax', get_template_directory_uri() . '/assets/js/cms-parallax.js', array( 'jquery'), $theme->get('Version'), true);
    wp_enqueue_script('video-popup', get_template_directory_uri() . '/assets/js/YouTubePopUp.jquery.js', array('jquery'), '1.0.1', true);
    $smoothscroll = optime_get_opt( 'smoothscroll', false );
    if(isset($smoothscroll) && $smoothscroll) {
        wp_enqueue_script('optime-smoothscroll', get_template_directory_uri() . '/assets/js/smoothscroll.min.js', array( 'jquery' ), 'all', true);
    }
    $parallaxscroll = optime_get_opt( 'parallaxscroll', false );
    if(isset($parallaxscroll) && $parallaxscroll) {
        wp_enqueue_script('optime-parallax');
    }
    wp_localize_script('optime-main','main_data',array('ajax_url'=>admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'optime_scripts');

/* add editor styles */
function optime_add_editor_styles()
{
    add_editor_style('editor-style.css');
}

add_action('admin_init', 'optime_add_editor_styles');

/* add admin styles */
function optime_admin_style()
{
    $theme = wp_get_theme(get_template());
    wp_enqueue_style('optime-admin-style', get_template_directory_uri() . '/assets/css/admin.css');
    wp_enqueue_style('font-material-icon', get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css', array(), '2.2.0');
    wp_enqueue_script('optime-main-admin', get_template_directory_uri() . '/assets/js/main-admin.js', array( 'jquery' ), $theme->get('Version'), true);
}

add_action('admin_enqueue_scripts', 'optime_admin_style');

/**
 * Helper functions for this theme.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Theme options
 */
require_once get_template_directory() . '/inc/theme-options.php';

/**
 * Page options
 */
require_once get_template_directory() . '/inc/page-options.php';

/**
 * CSS Generator.
 */
if (!class_exists('CSS_Generator')) {
    require_once get_template_directory() . '/inc/classes/class-css-generator.php';
}

/**
 * Breadcrumb.
 */
require_once get_template_directory() . '/inc/classes/class-breadcrumb.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/* Load list require plugins */
require_once( get_template_directory() . '/inc/require.plugins.php' );

/* Load lib Font */
require_once get_template_directory() . '/inc/libs/materialdesign.php';

/**
 * Custom params & remove VC Elements.
 */

function optime_vc_after_init()
{

    vc_remove_element("vc_button");
    vc_remove_element("vc_button2");
    vc_remove_element("vc_cta_button");
    vc_remove_element("vc_cta_button2");
    vc_remove_element("vc_cta");
    vc_remove_element("vc_cta");
    vc_remove_element("vc_tabs");
    vc_remove_element("vc_tour");
    vc_remove_element("vc_accordion");
    require_once ( get_template_directory() . '/vc_elements/cms_custom_vc_pagram.php' );

}

add_action('vc_after_init', 'optime_vc_after_init');

/**
 * Add new elements for VC
 */
function optime_vc_elements()
{

    if (class_exists('CmsShortCode')) {

        cms_require_folder('vc_elements', get_template_directory());
    }
}

add_action('vc_before_init', 'optime_vc_elements');

/**
 * Additional widgets for the theme
 */
require_once get_template_directory() . '/widgets/widget-recent-posts.php';
require_once get_template_directory() . '/widgets/widget-social.php';
require_once get_template_directory() . '/widgets/widget-getintouch.php';
require_once get_template_directory() . '/widgets/widget-pdf-download.php';
require_once get_template_directory() . '/widgets/widget-contact-box.php';
require_once get_template_directory() . '/widgets/class.widget-extends.php';
if(class_exists('WPCF7')) {
    require_once get_template_directory() . '/widgets/widget-contactform.php';
}

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/extends.php';


/**
 * Tutorials snippet functions. You should add those to extends.php
 * and remove the file.
 */
require_once get_template_directory() . '/inc/snippets.php';

/**
 * Add custom class in Row Visual Composer
 */
function optime_vc_shortcode_css_class( $classes, $settings_base, $atts )
{
    $classes_arr = explode( ' ', $classes );

    if ( 'vc_row' == $settings_base ) {
        if ( $atts['cms_row_class'] ) {
            $classes_arr[] = $atts['cms_row_class'];
        }
    }
    if ( 'vc_row' == $settings_base ) {
        if ( $atts['cms_row_overflow'] ) {
            $classes_arr[] = $atts['cms_row_overflow'];
        }
    }

    if ( 'vc_column' == $settings_base ) {
        if ( $atts['cms_column_class'] ) {
            $classes_arr[] = $atts['cms_column_class'];
        }
    }


    if ( isset($atts['animation_column']) && $atts['animation_column'] ) {
        wp_enqueue_script( 'vc_waypoints' );
        wp_enqueue_style( 'vc_animate-css' );
        $classes_arr[] = 'wpb_animate_when_almost_visible '.' wpb_'.$atts['animation_column'].' '.$atts['animation_column'];
    }

    if ( 'vc_single_image' == $settings_base ) {
        if ( $atts['cms_image_align'] ) {
            $classes_arr[] = $atts['cms_image_align'];
        }
    }

    return implode( ' ', $classes_arr );
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'optime_vc_shortcode_css_class', 10, 3 );
}


if ( ! function_exists( 'optime_fonts_url' ) ) :
    /**
     * Register Google fonts.
     *
     * Create your own optime_fonts_url() function to override in a child theme.
     *
     * @since league 1.1
     *
     * @return string Google fonts URL for the theme.
     */
    function optime_fonts_url()
    {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'optime' ) )
        {
            $fonts[] = 'Roboto:300,400,400i,500,500i,600,600i,700,700i';
        }


        if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'optime' ) )
        {
            $fonts[] = 'Poppins:400,500,600,700';
        }

        if ( 'off' !== _x( 'on', 'Lato font: on or off', 'optime' ) )
        {
            $fonts[] = 'Lato:400,700';
        }
        if ( 'off' !== _x( 'on', 'Cabin font: on or off', 'optime' ) )
        {
            $fonts[] = 'Cabin:400,700';
        }

        if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'optime' ) )
        {
            $fonts[] = 'Playfair Display:400';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/**
 * Commnet Form
 */
function optime_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'optime_comment_field_to_bottom' );

/* Optimize Images */
add_filter( 'jpeg_quality', function(){return 60;} );

add_filter( 'user_contactmethods', 'optime_custom_contact_info' );
/**
 * Adds support for Social Contact Info.
 *
 * @param array $fields  Array of default contact fields.
 * @return array $fields Amended array of contact fields.
 */
function optime_custom_contact_info( $fields ) {

    // Add Social link.
    $fields['facebook'] = esc_html__( 'LinkedIn', 'optime' );
    $fields['twitter'] = esc_html__( 'Twitter', 'optime' );
    $fields['vimeo'] = esc_html__( 'Vimeo', 'optime' );
    $fields['linkedin'] = esc_html__( 'Linkedin', 'optime' );
    $fields['rss'] = esc_html__( 'RSS', 'optime' );

    // Return the amended contact fields.
    return $fields;

}

function optime_limit_the_category($limit) {
    $limit++;
    ob_start();
    the_category(' ');
    $cats = implode('<a', array_slice(explode('<a', ob_get_clean()), 0, $limit));
    echo wp_kses_post($cats);
}
function optime_limit_the_terms($post_id, $term_name, $limit) {
    $limit++;
    ob_start();
    the_terms( $post_id, $term_name, '', ' ' );
    $cats = implode('<a', array_slice(explode('<a', ob_get_clean()), 0, $limit));
    echo wp_kses_post($cats);
}