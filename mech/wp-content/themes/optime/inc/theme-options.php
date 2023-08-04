<?php
if (!class_exists('ReduxFramework')) {
    return;
}
if (class_exists('ReduxFrameworkPlugin')) {
    remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
}
if (class_exists('WPCF7')) {
    $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');

    $contact_forms = array();
    if ($cf7) {
        foreach ($cf7 as $cform) {
            $contact_forms[$cform->ID] = $cform->post_title;
        }
    } else {
        $contact_forms[esc_html__('No contact forms found', 'optime')] = 0;
    }
} else {
    $contact_forms = '';
}

if(class_exists('Newsletter')) {
    $footer_forms = array_filter( (array) get_option( 'newsletter_forms', array() ) );

    $footer_forms_list = array(
        esc_html__( 'Default Form', 'optime' ) => 'default'
    );

    if ( $footer_forms )
    {
        $index = 1;
        foreach ( $footer_forms as $key => $form )
        {
            $footer_forms_list[ sprintf( esc_html__( 'form_%s', 'optime' ), $index ) ] = $key;
            $index ++;
        }
    }
}else {
    $footer_forms_list = '';
}

$opt_name = optime_get_opt_name();
$theme = wp_get_theme();

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => class_exists('CmssuperheroesCore') ? 'submenu' : '',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => esc_html__('Theme Options', 'optime'),
    'page_title' => esc_html__('Theme Options', 'optime'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar' => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => true,
    // Show the time the page took to load, etc
    'update_notice' => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    'show_options_object' => false,
    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => class_exists('CmssuperheroesCore') ? $theme->get('TextDomain') : '',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => '',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => 'theme-options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => '',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave',
            ),
        ),
    ),
    'templates_path' => class_exists('CmssuperheroesCore') ? cmssuperheroes()->path('APP_DIR') . '/templates/redux/' : '',
);

Redux::SetArgs($opt_name, $args);

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('General', 'optime'),
    'icon' => 'el-icon-home',
    'fields' => array(
        array(
            'id'       => 'favicon',
            'type'     => 'media',
            'title'    => esc_html__('Favicon', 'optime'),
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/favicon.png'
            )
        ),
        array(
            'id'       => 'dev_mode',
            'type'     => 'switch',
            'title'    => esc_html__('Dev Mode (not recommended)', 'optime'),
            'description' => 'no minimize , generate css over time...',
            'default'  => false
        ),
        array(
            'id' => 'show_page_loading',
            'type' => 'switch',
            'title' => esc_html__('Enable Page Loading', 'optime'),
            'subtitle' => esc_html__('Enable page loading effect when you load site.', 'optime'),
            'default' => false
        ),
        array(
            'id' => 'smoothscroll',
            'type' => 'switch',
            'title' => esc_html__('Smooth Scroll', 'optime'),
            'default' => false
        ),
        array(
            'id' => 'parallaxscroll',
            'type' => 'switch',
            'title' => esc_html__('Parallax Scroll', 'optime'),
            'default' => false
        ),
        array(
            'id' => 'parallaxscroll_speed',
            'type' => 'text',
            'title' => esc_html__('Parallax Scroll Speed', 'optime'),
            'default' => '',
            'desc' => 'Enter parallax speed ratio (Note: Default value is 4, min value is 1)',
            'required' => array(0 => 'parallaxscroll', 1 => '=', 2 => '1'),
            'force_output' => true
        ),
        array(
            'id' => 'site_background',
            'type' => 'background',
            'title' => esc_html__('Site Background', 'optime'),
            'required' => array(0 => 'site_layout', 1 => '=', 2 => 'boxed'),
            'force_output' => true
        ),
    )
));

/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Header', 'optime'),
    'icon' => 'el-icon-website',
    'fields' => array(
        array(
            'id' => 'header_layout',
            'type' => 'image_select',
            'title' => esc_html__('Layout', 'optime'),
            'subtitle' => esc_html__('Select a layout for header.', 'optime'),
            'options' => array(
                '1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
                '2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
                '3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
                '4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
            ),
            'default' => '1'
        ),
        array(
            'id' => 'h8_background_color',
            'type' => 'color',
            'title' => esc_html__('Background Color', 'optime'),
            'transparent' => false,
            'default' => '',
            'required' => array(0 => 'header_layout', 1 => 'equals', 2 => '8'),
            'force_output' => true
        ),
        array(
            'id' => 'sticky_on',
            'type' => 'switch',
            'title' => esc_html__('Sticky Header', 'optime'),
            'subtitle' => esc_html__('Header will be sticked when applicable.', 'optime'),
            'default' => false
        ),
        array(
            'id' => 'search_on',
            'type' => 'switch',
            'title' => esc_html__('Search Header', 'optime'),
            'subtitle' => esc_html__('Header will be logo search when on.', 'optime'),
            'default' => true
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Information', 'optime'),
    'icon' => 'el-icon-circle-arrow-right',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'top_bar_bgr',
            'type' => 'background',
            'background-image' => false,
            'transparent' => false,
            'background-repeat' => false,
            'background-size' => false,
            'background-attachment' => false,
            'background-position' => false,
            'output' => array('#site-header-wrap.header-layout3 .site-header-top', '#site-header-wrap.header-layout2 .site-header-top'),
            'title' => esc_html__('Background Color', 'optime'),
            'default' => '',
            'validate' => 'color'
        ),
        array(
            'id' => 'top_bar_color',
            'type' => 'color',
            'transparent' => false,
            'title' => esc_html__('Text Color', 'optime'),
            'output' => array('#site-header-wrap.header-layout1 .site-header-top, #site-header-wrap.header-layout2 .site-header-top, #site-header-wrap.header-layout3 .site-header-top')
        ),
        array(
            'id' => 'top_bar_phone',
            'type' => 'text',
            'title' => esc_html__('Phone', 'optime'),
            'default' => '',
            'desc' => 'Ex: +55 654 541 17'
        ),

        array(
            'id' => 'top_bar_time',
            'type' => 'text',
            'title' => esc_html__('Time', 'optime'),
            'default' => '',
            'desc' => 'Ex: Mon-Fri: 8am – 7pm'
        ),
        array(
            'id' => 'top_bar_email',
            'type' => 'text',
            'title' => esc_html__('Email', 'optime'),
            'default' => '',
            'desc' => 'Ex: Optime@farost.com'
        ),
        array(
            'id'          => 'lang_slides',
            'type'        => 'slides',
            'title'       => esc_html__('Language Dropdown', 'optime'),
            'subtitle'    => esc_html__('Set language is supported in theme.', 'optime'),
            'placeholder' => array(
                'title'           => esc_html__('Language Name', 'optime'),
                'url'             => esc_html__('Link', 'optime'),
            ),
        ),
        array(
            'title' => esc_html__('Button Navigation', 'optime'),
            'type' => 'section',
            'id' => 'button_navigation',
            'indent' => true
        ),
        array(
            'id' => 'h_btn_text',
            'type' => 'textarea',
            'title' => esc_html__('Button Text', 'optime'),
            'validate' => 'html_custom',
            'default' => '',
            'allowed_html' => array(
                'br' => array(),
                'strong' => array(),
                'span' => array(),
                'p' => array(),
                'i' => array(
                    'class' => array()
                ),
            ),
        ),
        array(
            'id' => 'h_btn_link_type',
            'type' => 'button_set',
            'title' => esc_html__('Button Link', 'optime'),
            'options' => array(
                'page_link' => esc_html__('Page Link', 'optime'),
                'custom_link' => esc_html__('Custom Link', 'optime'),
                'contact_form' => esc_html__('Popup Contact Form 7', 'optime'),
            ),
            'default' => 'page_link',
        ),
        array(
            'id' => 'h_btn_page_link',
            'type' => 'select',
            'title' => esc_html__('Page Link', 'optime'),
            'data' => 'page',
            'args' => array(
                'post_type' => 'page',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
            ),
            'required' => array(0 => 'h_btn_link_type', 1 => 'equals', 2 => 'page_link'),
            'force_output' => true
        ),
        array(
            'id' => 'h_btn_custom_link',
            'type' => 'text',
            'title' => esc_html__('Custom Link', 'optime'),
            'default' => '',
            'required' => array(0 => 'h_btn_link_type', 1 => 'equals', 2 => 'custom_link'),
            'force_output' => true
        ),
        array(
            'id' => 'title_contact_form',
            'type' => 'text',
            'title' => esc_html__('Title Contact Form', 'optime'),
            'default' => '',
            'required' => array(0 => 'h_btn_link_type', 1 => 'equals', 2 => 'contact_form'),
            'force_output' => true
        ),
        array(
            'id' => 'popup_contact_form',
            'type' => 'select',
            'title' => __('Select Contact Form', 'optime'),
            'options' => $contact_forms,
            'default' => '',
            'required' => array(0 => 'h_btn_link_type', 1 => 'equals', 2 => 'contact_form'),
            'force_output' => true
        ),
        array(
            'id' => 'h_btn_target',
            'type' => 'button_set',
            'title' => esc_html__('Button Target', 'optime'),
            'options' => array(
                '_self' => esc_html__('Self', 'optime'),
                '_blank' => esc_html__('Blank', 'optime')
            ),
            'default' => '_self',
        ),

        array(
            'id' => 'top_bar_text1',
            'type' => 'text',
            'title' => esc_html__('Top Bar Link Text 1', 'optime'),
            'default' => '',
            'desc' => 'Ex: Contacts'
        ),
        array(
            'id' => 'top_bar_link_type1',
            'type' => 'button_set',
            'title' => esc_html__('Top Bar Link 1', 'optime'),
            'options' => array(
                'page_link' => esc_html__('Page Link', 'optime'),
                'custom_link' => esc_html__('Custom Link', 'optime'),
            ),
            'default' => 'page_link',
        ),
        array(
            'id' => 'top_bar_page_link1',
            'type' => 'select',
            'title' => esc_html__('Page Link 1', 'optime'),
            'data' => 'page',
            'args' => array(
                'post_type' => 'page',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
            ),
            'required' => array(0 => 'top_bar_link_type1', 1 => 'equals', 2 => 'page_link'),
            'force_output' => true
        ),
        array(
            'id' => 'top_bar_custom_link1',
            'type' => 'text',
            'title' => esc_html__('Custom Link 1', 'optime'),
            'default' => '',
            'required' => array(0 => 'top_bar_link_type1', 1 => 'equals', 2 => 'custom_link'),
            'force_output' => true
        ),

        array(
            'id' => 'top_bar_text2',
            'type' => 'text',
            'title' => esc_html__('Top Bar Link Text 2', 'optime'),
            'default' => '',
            'desc' => 'Ex: Careers'
        ),
        array(
            'id' => 'top_bar_link_type2',
            'type' => 'button_set',
            'title' => esc_html__('Top Bar Link 2', 'optime'),
            'options' => array(
                'page_link' => esc_html__('Page Link', 'optime'),
                'custom_link' => esc_html__('Custom Link', 'optime'),
            ),
            'default' => 'page_link',
        ),
        array(
            'id' => 'top_bar_page_link2',
            'type' => 'select',
            'title' => esc_html__('Page Link 2', 'optime'),
            'data' => 'page',
            'args' => array(
                'post_type' => 'page',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
            ),
            'required' => array(0 => 'top_bar_link_type2', 1 => 'equals', 2 => 'page_link'),
            'force_output' => true
        ),
        array(
            'id' => 'top_bar_custom_link2',
            'type' => 'text',
            'title' => esc_html__('Custom Link 2', 'optime'),
            'default' => '',
            'required' => array(0 => 'top_bar_link_type2', 1 => 'equals', 2 => 'custom_link'),
            'force_output' => true
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Logo', 'optime'),
    'icon' => 'el el-picture',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'logo_light',
            'type' => 'media',
            'title' => esc_html__('Logo Light', 'optime'),
            'subtitle' => 'For Header layout1',
            'default' => array(
                'url' => get_template_directory_uri() . '/assets/images/logo-light.png'
            ),
        ),
        array(
            'id' => 'logo_dark',
            'type' => 'media',
            'title' => esc_html__('Logo Dark', 'optime'),
            'subtitle' => 'For Header layout 2,3,4 and Sticky header',
            'default' => array(
                'url' => get_template_directory_uri() . '/assets/images/logo-dark.png'
            ),
        ),
        array(
            'id' => 'logo_mobile',
            'type' => 'media',
            'title' => esc_html__('Logo Tablet & Mobile', 'optime'),
            'subtitle' => 'For Mobile and Tablet',
            'default' => array(
                'url' => get_template_directory_uri() . '/assets/images/logo-dark.png'
            ),
        ),
        array(
            'id' => 'logo_maxh',
            'type' => 'dimensions',
            'title' => esc_html__('Logo Max height', 'optime'),
            'subtitle' => esc_html__('Set maximum height for your logo, just in case the logo is too large, default: 43px.', 'optime'),
            'width' => false,
            'unit' => 'px',
        ),
        array(
            'id' => 'logo_maxh_sm',
            'type' => 'dimensions',
            'title' => esc_html__('Logo Max height Tablet & Mobile', 'optime'),
            'width' => false,
            'unit' => 'px'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Navigation', 'optime'),
    'icon' => 'el el-lines',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'menu_default_font',
            'type' => 'select',
            'title' => esc_html__('Menu Default Font', 'optime'),
            'options' => array(
                'Roboto' => esc_html__('Roboto', 'optime'),
                'Cabin' => esc_html__('Cabin', 'optime'),
                'GT-Walsheim-Regular' => esc_html__('GT Walsheim Regular', 'optime'),
                'GT-Walsheim-Medium' => esc_html__('GT Walsheim Medium', 'optime'),
                'GT-Walsheim-Bold' => esc_html__('GT Walsheim Bold', 'optime'),
                'Nimbus-Sans-Regular' => esc_html__('Nimbus Sans Regular', 'optime'),
                'Nimbus-Sans-Bold' => esc_html__('Nimbus Sans Bold', 'optime'),
                'Maison-Neue-Mono' => esc_html__('Maison Neue Mono', 'optime'),
                'Maison-Neue-Bold' => esc_html__('Maison Neue Bold', 'optime'),
                'Proxima-Nova-Bold' => esc_html__('Proxima Nova Bold', 'optime'),
                'Proxima-Nova-Semibold' => esc_html__('Proxima Nova Semibold', 'optime'),
                'Proxima-Nova-Regular' => esc_html__('Proxima Nova Regular', 'optime'),
                'Calibre-Regular' => esc_html__('Calibre Regular', 'optime'),
                'Calibre-Medium' => esc_html__('Calibre Medium', 'optime'),
                'Calibre-Semibold' => esc_html__('Calibre Semibold', 'optime'),
                'Norwester' => esc_html__('Norwester', 'optime'),
                'Avenir-Next-Bold' => esc_html__('Avenir Next Bold', 'optime'),
                'AvenirNext-DemiBold' => esc_html__('Avenir Next DemiBold', 'optime'),
                'Avenir-Next-Medium' => esc_html__('Avenir Next Medium', 'optime'),
                'Avenir-Next-Regular' => esc_html__('Avenir Next Regular', 'optime'),
                'inherit' => esc_html__('Inherit', 'optime'),
            ),
            'default' => 'Roboto',
            'desc' => 'The selector & tag is used: .primary-menu > li > a'
        ),
        array(
            'id' => 'font_menu',
            'type' => 'typography',
            'title' => esc_html__('Custom Google Font', 'optime'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'font-style' => false,
            'font-weight' => true,
            'text-align' => false,
            'font-size' => false,
            'line-height' => false,
            'color' => false,
            'output' => array('body .primary-menu > li > a, body .primary-menu .sub-menu li a'),
            'units' => 'px'
        ),
        array(
            'id' => 'menu_font_size',
            'type' => 'text',
            'title' => esc_html__('Font Size', 'optime'),
            'validate' => 'numeric',
            'desc' => 'Enter number',
            'msg' => 'Please enter number',
            'default' => ''
        ),
        array(
            'id' => 'menu_text_transform',
            'type' => 'select',
            'title' => esc_html__('Text Transform', 'optime'),
            'options' => array(
                '' => esc_html__('Capitalize', 'optime'),
                'uppercase' => esc_html__('Uppercase', 'optime'),
                'lowercase' => esc_html__('Lowercase', 'optime'),
                'initial' => esc_html__('Initial', 'optime'),
                'inherit' => esc_html__('Inherit', 'optime'),
                'none' => esc_html__('None', 'optime'),
            ),
            'default' => ''
        ),
        array(
            'title' => esc_html__('Main Menu', 'optime'),
            'type' => 'section',
            'id' => 'main_menu',
            'indent' => true
        ),
        array(
            'id' => 'main_menu_color',
            'type' => 'link_color',
            'title' => esc_html__('Color', 'optime'),
            'default' => array(
                'regular' => '',
                'hover' => '',
                'active' => '',
            ),
        ),
        array(
            'title' => esc_html__('Sticky Menu', 'optime'),
            'type' => 'section',
            'id' => 'sticky_menu',
            'indent' => true
        ),
        array(
            'id' => 'sticky_menu_color',
            'type' => 'link_color',
            'title' => esc_html__('Color', 'optime'),
            'default' => array(
                'regular' => '',
                'hover' => '',
                'active' => '',
            ),
        ),
    )
));

/*--------------------------------------------------------------
# Page Title area
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Page Title', 'optime'),
    'icon' => 'el-icon-map-marker',
    'fields' => array(
        array(
            'id' => 'ptitle_layout',
            'type' => 'image_select',
            'title' => esc_html__('Layout', 'optime'),
            'subtitle' => esc_html__('Select a layout for page title.', 'optime'),
            'options' => array(
                '0' => get_template_directory_uri() . '/assets/images/page-title-layout/p0.jpg',
                '1' => get_template_directory_uri() . '/assets/images/page-title-layout/p1.jpg',
            ),
            'default' => '1'
        ),
        array(
            'id' => 'ptitle_bg_color',
            'type' => 'color_rgba',
            'title' => esc_html__('Select Color', 'optime'),
            'required' => array(0 => 'ptitle_overlay_style', 1 => 'equals', 2 => 'default'),
            'force_output' => true
        ),
        array(
            'id' => 'ptitle_bg',
            'type' => 'background',
            'title' => esc_html__('Background', 'optime'),
            'subtitle' => esc_html__('Page title background.', 'optime'),
            'output' => array('#pagetitle'),
            'background-color' => false,
        ),
        array(
            'id' => 'ptitle_paddings',
            'type' => 'spacing',
            'title' => esc_html__('Content Paddings', 'optime'),
            'subtitle' => esc_html__('Content page title paddings.', 'optime'),
            'mode' => 'padding',
            'units' => array('em', 'px', '%'),
            'top' => true,
            'right' => false,
            'bottom' => true,
            'left' => false,
            'output' => array('#pagetitle.page-title'),
            'default' => array(
                'top' => '',
                'right' => '',
                'bottom' => '',
                'left' => '',
                'units' => 'px',
            )
        ),
        array(
            'id' => 'ptitle_paddings_sm',
            'type' => 'spacing',
            'title' => esc_html__('Content Paddings Tablet & Mobile', 'optime'),
            'subtitle' => esc_html__('Content page title paddings for Tablet & Mobile.', 'optime'),
            'mode' => 'padding',
            'units' => array('em', 'px', '%'),
            'top' => true,
            'right' => false,
            'bottom' => true,
            'left' => false,
            'default' => array(
                'top' => '',
                'right' => '',
                'bottom' => '',
                'left' => '',
                'units' => 'px',
            )
        ),
        array(
            'id' => 'ptitle_content_align',
            'type' => 'button_set',
            'title' => esc_html__('Content Align', 'optime'),
            'options' => array(
                'left' => esc_html__('Left', 'optime'),
                'center' => esc_html__('Center', 'optime'),
                'right' => esc_html__('Right', 'optime'),
            ),
            'default' => 'left'
        ),
        array(
            'title' => esc_html__('Title', 'optime'),
            'type' => 'section',
            'id' => 'pt_title',
            'indent' => true
        ),
        array(
            'id' => 'ptitle_color',
            'type' => 'color',
            'title' => esc_html__('Title Color', 'optime'),
            'subtitle' => esc_html__('Page title color.', 'optime'),
            'output' => array('#pagetitle h1.page-title'),
            'default' => '',
            'transparent' => false,
        ),
        array(
            'id' => 'ptitle_font_size',
            'type' => 'text',
            'title' => esc_html__('Font Size', 'optime'),
            'validate' => 'numeric',
            'desc' => 'Enter number',
            'msg' => 'Please enter number',
            'default' => ''
        ),
        array(
            'id' => 'ptitle_line_hegiht',
            'type' => 'text',
            'title' => esc_html__('Line Height', 'optime'),
            'validate' => 'numeric',
            'desc' => 'Enter number',
            'msg' => 'Please enter number',
            'default' => ''
        ),
        array(
            'title' => esc_html__('Breadcrumb', 'optime'),
            'type' => 'section',
            'id' => 'pt_breadcrumb',
            'indent' => true
        ),
        array(
            'id' => 'breadcrumb_on',
            'type' => 'switch',
            'title' => esc_html__('Breadcrumb', 'optime'),
            'default' => false
        ),
    )
));

/*--------------------------------------------------------------
# WordPress default content
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Content', 'optime'),
    'icon' => 'el-icon-pencil',
    'fields' => array(
        array(
            'id' => 'content_bg_color',
            'type' => 'color_rgba',
            'title' => esc_html__('Background Color', 'optime'),
            'subtitle' => esc_html__('Content background color.', 'optime'),
            'output' => array('background-color' => '#content')
        ),
        array(
            'id' => 'content_sidebar_space',
            'type' => 'text',
            'title' => esc_html__('Content & Sidebar Space', 'optime'),
            'validate' => 'numeric',
            'desc' => 'Enter number (Default 50).',
            'msg' => 'Please enter number',
            'default' => ''
        ),
        array(
            'id' => 'search_field_placeholder',
            'type' => 'text',
            'title' => esc_html__('Search Form - Text Placeholder', 'optime'),
            'default' => '',
            'desc' => esc_html__('Default: Search Keywords', 'optime'),
        ),
    )
));


Redux::setSection($opt_name, array(
    'title' => esc_html__('Archive', 'optime'),
    'icon' => 'el-icon-list',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'archive_sidebar_pos',
            'type' => 'button_set',
            'title' => esc_html__('Sidebar Position', 'optime'),
            'subtitle' => esc_html__('Select a sidebar position for blog home, archive, search...', 'optime'),
            'options' => array(
                'left' => esc_html__('Left', 'optime'),
                'right' => esc_html__('Right', 'optime'),
                'none' => esc_html__('Disabled', 'optime')
            ),
            'default' => 'left'
        ),
        array(
            'id' => 'archive_author_on',
            'title' => esc_html__('Author', 'optime'),
            'subtitle' => esc_html__('Show author name on each post.', 'optime'),
            'type' => 'switch',
            'default' => true,
        ),
        array(
            'id' => 'archive_date_on',
            'title' => esc_html__('Date', 'optime'),
            'subtitle' => esc_html__('Show date posted on each post.', 'optime'),
            'type' => 'switch',
            'default' => true,
        ),
        array(
            'id' => 'archive_tags_on',
            'title' => esc_html__('Tags', 'optime'),
            'subtitle' => esc_html__('Show tag names on each post.', 'optime'),
            'type' => 'switch',
            'default' => true,
        ),
        array(
            'id' => 'archive_categories_on',
            'title' => esc_html__('Categories', 'optime'),
            'subtitle' => esc_html__('Show category names on each post.', 'optime'),
            'type' => 'switch',
            'default' => true,
        ),
        array(
            'id' => 'archive_sticky_on',
            'title' => esc_html__('Sticky', 'optime'),
            'subtitle' => esc_html__('Show sticky on each post.', 'optime'),
            'type' => 'switch',
            'default' => true
        ),
        array(
            'id' => 'archive_comments_on',
            'title' => esc_html__('Comments', 'optime'),
            'subtitle' => esc_html__('Show comments count on each post.', 'optime'),
            'type' => 'switch',
            'default' => true,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Single Post', 'optime'),
    'icon' => 'el-icon-file-edit',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'post_sidebar_pos',
            'type' => 'button_set',
            'title' => esc_html__('Sidebar Position', 'optime'),
            'subtitle' => esc_html__('Select a sidebar position', 'optime'),
            'options' => array(
                'left' => esc_html__('Left', 'optime'),
                'right' => esc_html__('Right', 'optime'),
                'none' => esc_html__('Disabled', 'optime')
            ),
            'default' => 'left'
        ),
        array(
            'id' => 'post_title_on',
            'title' => esc_html__('Title', 'optime'),
            'subtitle' => esc_html__('Show title on single post.', 'optime'),
            'type' => 'switch',
            'default' => false
        ),
        array(
            'id' => 'post_author_on',
            'title' => esc_html__('Author', 'optime'),
            'subtitle' => esc_html__('Show author name on single post.', 'optime'),
            'type' => 'switch',
            'default' => true
        ),
        array(
            'id' => 'post_date_on',
            'title' => esc_html__('Date', 'optime'),
            'subtitle' => esc_html__('Show date on single post.', 'optime'),
            'type' => 'switch',
            'default' => true
        ),
        array(
            'id' => 'post_tags_on',
            'title' => esc_html__('Tags', 'optime'),
            'subtitle' => esc_html__('Show tag names on single post.', 'optime'),
            'type' => 'switch',
            'default' => true
        ),
        array(
            'id' => 'post_categories_on',
            'title' => esc_html__('Categories', 'optime'),
            'subtitle' => esc_html__('Show category names on single post.', 'optime'),
            'type' => 'switch',
            'default' => true
        ),
        array(
            'id' => 'social_share_on',
            'title' => esc_html__('Socials Share', 'optime'),
            'subtitle' => esc_html__('Show socials share on single post.', 'optime'),
            'type' => 'switch',
            'default' => false
        ),
        array(
            'id' => 'post_comments_on',
            'title' => esc_html__('Comments', 'optime'),
            'subtitle' => esc_html__('Show comments count on single post.', 'optime'),
            'type' => 'switch',
            'default' => true
        ),
        array(
            'id'       => 'post_comments_form_on',
            'title'    => esc_html__('Comments Form', 'optime'),
            'subtitle' => esc_html__('Show comments form on single post.', 'optime'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'show_newsletter_post',
            'title'    => esc_html__('Show Newsletter In Footer', 'optime'),
            'subtitle' => esc_html__('Show newsletter in footer single post.', 'optime'),
            'type'     => 'switch',
            'default'  => false
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Single Case Study', 'optime'),
        'icon' => 'el el-briefcase',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'portfolio_sidebar_pos',
            'type' => 'button_set',
            'title' => esc_html__('Sidebar Position', 'optime'),
            'subtitle' => esc_html__('Select a sidebar position', 'optime'),
            'options' => array(
                'left' => esc_html__('Left', 'optime'),
                'right' => esc_html__('Right', 'optime'),
                'none' => esc_html__('Disabled', 'optime')
            ),
            'default' => 'left'
        ),
        array(
            'id' => 'portfolio_slug',
            'type' => 'text',
            'title' => esc_html__('Slug', 'optime'),
            'default' => '',
            'subtitle' => esc_html__('The slug name cannot be the same as a page name. Make sure to regenertate permalinks, after making changes.', 'optime'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Single Service', 'optime'),
    'icon' => 'el el-cog',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'service_sidebar_pos',
            'type' => 'button_set',
            'title' => esc_html__('Sidebar Position', 'optime'),
            'subtitle' => esc_html__('Select a sidebar position', 'optime'),
            'options' => array(
                'left' => esc_html__('Left', 'optime'),
                'right' => esc_html__('Right', 'optime'),
                'none' => esc_html__('Disabled', 'optime')
            ),
            'default' => 'left'
        ),
        array(
            'id' => 'service_slug',
            'type' => 'text',
            'title' => esc_html__('Slug', 'optime'),
            'default' => '',
            'subtitle' => esc_html__('The slug name cannot be the same as a page name. Make sure to regenertate permalinks, after making changes.', 'optime'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Single Industry', 'optime'),
    'icon' => 'el el-filter',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'industry_sidebar_pos',
            'type' => 'button_set',
            'title' => esc_html__('Sidebar Position', 'optime'),
            'subtitle' => esc_html__('Select a sidebar position', 'optime'),
            'options' => array(
                'left' => esc_html__('Left', 'optime'),
                'right' => esc_html__('Right', 'optime'),
                'none' => esc_html__('Disabled', 'optime')
            ),
            'default' => 'left'
        ),
        array(
            'id' => 'industry_slug',
            'type' => 'text',
            'title' => esc_html__('Slug', 'optime'),
            'default' => '',
            'subtitle' => esc_html__('The slug name cannot be the same as a page name. Make sure to regenertate permalinks, after making changes.', 'optime'),
        ),
    )
));

/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer', 'optime'),
    'icon' => 'el el-website',
    'fields' => array(
        array(
            'id' => 'footer_layout',
            'type' => 'image_select',
            'title' => esc_html__('Layout', 'optime'),
            'subtitle' => esc_html__('Select a layout for upper footer area.', 'optime'),
            'options' => array(
                '0' => get_template_directory_uri() . '/assets/images/footer-layout/f0.jpg',
                '1' => get_template_directory_uri() . '/assets/images/footer-layout/f1.jpg',
            ),
            'default' => '1'
        ),
        array(
            'id' => 'footer_bg1',
            'type' => 'background',
            'title' => esc_html__('Background', 'optime'),
            'subtitle' => esc_html__('Footer background.', 'optime'),
            'default' => '',
            'output' => array('.site-footer.footer-layout1 .bg-overlay'),
            'required' => array(0 => 'footer_layout', 1 => 'equals', 2 => '1'),
        ),
        array(
            'id' => 'footer_separator_color',
            'type' => 'background',
            'title' => esc_html__('Separator Color', 'optime'),
            'output' => array('.site-footer.footer-layout1 .bottom-footer .bf-gap'),
            'required' => array(0 => 'footer_layout', 1 => 'equals', 2 => '1'),
            'background-image' => false,
            'default' => '#878787',
        ),
        array(
            'id' => 'back_totop_on',
            'type' => 'switch',
            'title' => esc_html__('Back to Top Button', 'optime'),
            'subtitle' => esc_html__('Show back to top button when scrolled down.', 'optime'),
            'default' => true
        ),
    )
));

/*--------------------------------------------------------------
# Page 404
--------------------------------------------------------------*/
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Newsletter', 'optime'),
    'icon' => 'el el-circle-arrow-right',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'footer_newsletter_title',
            'type' => 'text',
            'title' => esc_html__('Title', 'optime'),
            'default' => ''
        ),
        array(
            'id' => 'footer_newsletter_desc',
            'type' => 'text',
            'title' => esc_html__('Description', 'optime'),
            'default' => ''
        ),
        array(
            'id' => 'footer_newsletter_form',
            'type' => 'select',
            'title' => __('Newsletter Form', 'optime'),
            'options' => $footer_forms_list,
            'default' => '',
            'force_output' => true
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Top', 'optime'),
    'icon' => 'el el-circle-arrow-right',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'footer_top_column',
            'type' => 'button_set',
            'title' => esc_html__('Columns', 'optime'),
            'options' => array(
                '3' => esc_html__('3 Column', 'optime'),
                '4' => esc_html__('4 Column', 'optime'),
                '5' => esc_html__('5 Column', 'optime'),
            ),
            'default' => '5',
            'force_output' => true
        ),
        array(
            'id' => 'footer_top_paddings',
            'type' => 'spacing',
            'title' => esc_html__('Paddings', 'optime'),
            'subtitle' => esc_html__('Footer top paddings.', 'optime'),
            'mode' => 'padding',
            'units' => array('px'),
            'right' => false,
            'left' => false,
            'default' => array(
                'padding-top' => '',
                'padding-bottom' => ''
            ),
        ),
        array(
            'id' => 'footer_top_color',
            'type' => 'color',
            'title' => esc_html__('Text Color', 'optime'),
            'output' => array('.top-footer')
        ),
        array(
            'id' => 'footer_top_link_color',
            'type' => 'link_color',
            'title' => esc_html__('Links Color', 'optime'),
            'regular' => true,
            'hover' => true,
            'active' => true,
            'visited' => true,
            'output' => array('.top-footer a'),
        ),
        array(
            'title' => esc_html__('Widget Title', 'optime'),
            'type'  => 'section',
            'id' => 'footer_wg_title',
            'indent' => true,
        ),
        array(
            'id'          => 'footer_top_heading_font',
            'type'        => 'typography',
            'title'       => esc_html__('Font Family', 'optime'),
            'google'      => true,
            'font-backup' => false,
            'all_styles'  => false,
            'font-style'  => false,
            'font-weight'  => true,
            'text-align'  => false,
            'font-size'  => false,
            'line-height'  => false,
            'color'  => false,
            'indent' => true,
            'output'      => array('footer.site-footer .top-footer .footer-widget-title'),
        ),
        array(
            'id'    => 'footer_top_heading_color',
            'type'  => 'color',
            'title' => esc_html__('Title Color', 'optime'),
            'output'      => array('footer.site-footer .top-footer .footer-widget-title'),
        ),
        array(
            'id'       => 'footer_top_heading_fs',
            'type'     => 'text',
            'title'    => esc_html__('Font Size', 'optime'),
            'validate' => 'numeric',
            'desc'     => 'Enter number',
            'msg'      => 'Please enter number',
            'default'  => '',
            'output'      => array('footer.site-footer .top-footer .footer-widget-title'),
        ),
        array(
            'id'       => 'footer_top_heading_tt',
            'type'     => 'select',
            'title'    => esc_html__('Text Transform', 'optime'),
            'options'  => array(
                'capitalize'  => esc_html__('Capitalize', 'optime'),
                'uppercase' => esc_html__('Uppercase', 'optime'),
                'lowercase'  => esc_html__('Lowercase', 'optime'),
                'initial'  => esc_html__('Initial', 'optime'),
                'inherit'  => esc_html__('Inherit', 'optime'),
                'none'  => esc_html__('None', 'optime'),
            ),
            'default'  => ''
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Bottom', 'optime'),
    'icon' => 'el el-circle-arrow-right',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'footer_copyright',
            'type' => 'textarea',
            'title' => esc_html__('Copyright', 'optime'),
            'validate' => 'html_custom',
            'default' => '',
            'subtitle' => esc_html__('Custom HTML Allowed: a,br,em,strong,span,p,div,h1->h6', 'optime'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Page 404', 'optime'),
    'icon' => 'el-icon-file-edit',
    'fields' => array(
        array(
            'id' => 'primary_image',
            'type' => 'media',
            'title' => esc_html__('Image 404', 'optime'),
        ),
        array(
            'id' => 'page404_color',
            'type' => 'color',
            'title' => esc_html__('Text Color', 'optime'),
            'default' => '#ffffff'
        ),
        array(
            'id' => 'number_fontsize',
            'type' => 'text',
            'title' => esc_html__('Number 404 Font Size', 'optime'),
            'default' => '220px'
        ),
        array(
            'id' => 'page404_htext',
            'type' => 'text',
            'title' => esc_html__('Heading Text', 'optime'),
            'default' => ''
        ),
        array(
            'id' => 'page404_hfontsize',
            'type' => 'text',
            'title' => esc_html__('Heading Font Size', 'optime'),
            'default' => '40px'
        ),
        array(
            'id' => 'page404_desc',
            'type' => 'text',
            'title' => esc_html__('Description', 'optime'),
            'default' => '',
        ),
        array(
            'id' => 'page404_desc_fontsize',
            'type' => 'text',
            'title' => esc_html__('Description Font Size', 'optime'),
            'default' => '20px'
        ),
    )
));
/*--------------------------------------------------------------
# Colors
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Colors', 'optime'),
    'icon' => 'el-icon-file-edit',
    'fields' => array(
        array(
            'id' => 'primary_color',
            'type' => 'color',
            'title' => esc_html__('Primary Color', 'optime'),
            'transparent' => false,
            'default' => '#ff5e14'
        ),
        array(
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => esc_html__('Secondary Color', 'optime'),
            'transparent' => false,
            'default' => '#121c45'
        ),
        array(
            'id' => 'link_color',
            'type' => 'link_color',
            'title' => __('Link Colors', 'optime'),
            'default' => array(
                'regular' => 'inherit',
                'hover' => '#ff5e14',
                'active' => '#ff5e14'
            ),
            'output' => array('a')
        )
    )
));

/*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography', 'optime'),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'body_default_font',
            'type' => 'select',
            'title' => esc_html__('Body Default Font', 'optime'),
            'options' => array(
                'GT-Walsheim-Regular' => esc_html__('GT Walsheim Regular', 'optime'),
                'GT-Walsheim-Medium' => esc_html__('GT Walsheim Medium', 'optime'),
                'GT-Walsheim-Bold' => esc_html__('GT Walsheim Bold', 'optime'),
                'Nimbus-Sans-Regular' => esc_html__('Nimbus Sans Regular', 'optime'),
                'Nimbus-Sans-Bold' => esc_html__('Nimbus Sans Bold', 'optime'),
                'Maison-Neue-Mono' => esc_html__('Maison Neue Mono', 'optime'),
                'Maison-Neue-Bold' => esc_html__('Maison Neue Bold', 'optime'),
                'Proxima-Nova-Bold' => esc_html__('Proxima Nova Bold', 'optime'),
                'Proxima-Nova-Semibold' => esc_html__('Proxima Nova Semibold', 'optime'),
                'Proxima-Nova-Regular' => esc_html__('Proxima Nova Regular', 'optime'),
                'Calibre-Regular' => esc_html__('Calibre Regular', 'optime'),
                'Calibre-Medium' => esc_html__('Calibre Medium', 'optime'),
                'Calibre-Semibold' => esc_html__('Calibre Semibold', 'optime'),
                'Norwester' => esc_html__('Norwester', 'optime'),
                'Avenir-Next-Bold' => esc_html__('Avenir Next Bold', 'optime'),
                'AvenirNext-DemiBold' => esc_html__('Avenir Next DemiBold', 'optime'),
                'Avenir-Next-Medium' => esc_html__('Avenir Next Medium', 'optime'),
                'Avenir-Next-Regular' => esc_html__('Avenir Next Regular', 'optime'),
                'inherit' => esc_html__('Inherit', 'optime'),
            ),
            'default' => 'inherit',
            'desc' => 'This will be the font used when you use the class & tags: .ft-main-r, body'
        ),
        array(
            'id' => 'heading_default_font',
            'type' => 'select',
            'title' => esc_html__('Heading Default Font', 'optime'),
            'options' => array(
                'GT-Walsheim-Medium' => esc_html__('GT Walsheim Medium', 'optime'),
                'GT-Walsheim-Regular' => esc_html__('GT Walsheim Regular', 'optime'),
                'GT-Walsheim-Bold' => esc_html__('GT Walsheim Bold', 'optime'),
                'Nimbus-Sans-Regular' => esc_html__('Nimbus Sans Regular', 'optime'),
                'Nimbus-Sans-Bold' => esc_html__('Nimbus Sans Bold', 'optime'),
                'Maison-Neue-Mono' => esc_html__('Maison Neue Mono', 'optime'),
                'Maison-Neue-Bold' => esc_html__('Maison Neue Bold', 'optime'),
                'Proxima-Nova-Bold' => esc_html__('Proxima Nova Bold', 'optime'),
                'Proxima-Nova-Semibold' => esc_html__('Proxima Nova Semibold', 'optime'),
                'Proxima-Nova-Regular' => esc_html__('Proxima Nova Regular', 'optime'),
                'Calibre-Regular' => esc_html__('Calibre Regular', 'optime'),
                'Calibre-Medium' => esc_html__('Calibre Medium', 'optime'),
                'Calibre-Semibold' => esc_html__('Calibre Semibold', 'optime'),
                'Norwester' => esc_html__('Norwester', 'optime'),
                'Avenir-Next-Bold' => esc_html__('Avenir Next Bold', 'optime'),
                'AvenirNext-DemiBold' => esc_html__('Avenir Next DemiBold', 'optime'),
                'Avenir-Next-Medium' => esc_html__('Avenir Next Medium', 'optime'),
                'Avenir-Next-Regular' => esc_html__('Avenir Next Regular', 'optime'),
                'inherit' => esc_html__('Inherit', 'optime'),
            ),
            'default' => 'inherit',
            'desc' => 'This will be the font used when you use the class & tags: .ft-heading-m, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6'
        ),
    )
));

$custom_font_selectors_1 = Redux::get_option($opt_name, 'custom_font_selectors_1');
$custom_font_selectors_1 = !empty($custom_font_selectors_1) ? explode(',', $custom_font_selectors_1) : array();

Redux::setSection($opt_name, array(
    'title' => esc_html__('Google Fonts', 'optime'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'font_main',
            'type' => 'typography',
            'title' => esc_html__('Main Font', 'optime'),
            'subtitle' => esc_html__('This will be the default font of your website.', 'optime'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => true,
            'font-size' => true,
            'text-align' => false,
            'output' => array('body'),
            'units' => 'px'
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => esc_html__('H1', 'optime'),
            'subtitle' => esc_html__('This will be the default font for all H1 tags of your website.', 'optime'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'text-align' => false,
            'output' => array('h1', '.h1', '.text-heading'),
            'units' => 'px'
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => esc_html__('H2', 'optime'),
            'subtitle' => esc_html__('This will be the default font for all H2 tags of your website.', 'optime'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'text-align' => false,
            'output' => array('h2', '.h2'),
            'units' => 'px'
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => esc_html__('H3', 'optime'),
            'subtitle' => esc_html__('This will be the default font for all H3 tags of your website.', 'optime'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'text-align' => false,
            'output' => array('h3', '.h3'),
            'units' => 'px'
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => esc_html__('H4', 'optime'),
            'subtitle' => esc_html__('This will be the default font for all H4 tags of your website.', 'optime'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'text-align' => false,
            'output' => array('h4', '.h4'),
            'units' => 'px'
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => esc_html__('H5', 'optime'),
            'subtitle' => esc_html__('This will be the default font for all H5 tags of your website.', 'optime'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'text-align' => false,
            'output' => array('h5', '.h5'),
            'units' => 'px'
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => esc_html__('H6', 'optime'),
            'subtitle' => esc_html__('This will be the default font for all H6 tags of your website.', 'optime'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'text-align' => false,
            'output' => array('h6', '.h6'),
            'units' => 'px'
        )
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Fonts Selectors', 'optime'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'custom_font_1',
            'type' => 'typography',
            'title' => esc_html__('Custom Font', 'optime'),
            'subtitle' => esc_html__('This will be the font that applies to the class selector.', 'optime'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'text-align' => false,
            'output' => $custom_font_selectors_1,
            'units' => 'px',

        ),
        array(
            'id' => 'custom_font_selectors_1',
            'type' => 'textarea',
            'title' => esc_html__('CSS Selectors', 'optime'),
            'subtitle' => esc_html__('Add class selectors to apply above font.', 'optime'),
            'validate' => 'no_html'
        )
    )
));

/* Social Media */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Social Media', 'optime'),
    'icon' => 'el el-twitter',
    'subsection' => false,
    'fields' => array(
        array(
            'id' => 'social_media',
            'type' => 'sorter',
            'title' => 'Enable and Sort',
            'desc' => 'Choose which social networks are displayed and edit where they link to.',
            'options' => array(
                'enabled' => array(
                    'facebook' => 'Facebook',
                    'instagram' => 'Instagram',
                    'twitter' => 'Twitter',
                ),
                'disabled' => array(
                    'tripadvisor' => 'Tripadvisor',
                    'google' => 'Google',
                    'youtube' => 'Youtube',
                    'vimeo' => 'Vimeo',
                    'tumblr' => 'Tumblr',
                    'pinterest' => 'Pinterest',
                    'yelp' => 'Yelp',
                    'skype' => 'Skype',
                    'linkedin' => 'Linkedin',
                    'rss' => 'Rss',
                )
            ),
        ),
        array(
            'id'      => 'social_facebook_url',
            'type'    => 'text',
            'title'   => esc_html__('Facebook URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_twitter_url',
            'type'    => 'text',
            'title'   => esc_html__('Twitter URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_inkedin_url',
            'type'    => 'text',
            'title'   => esc_html__('Inkedin URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_rss_url',
            'type'    => 'text',
            'title'   => esc_html__('Rss URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_instagram_url',
            'type'    => 'text',
            'title'   => esc_html__('Instagram URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_google_url',
            'type'    => 'text',
            'title'   => esc_html__('Google URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_skype_url',
            'type'    => 'text',
            'title'   => esc_html__('Skype URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_pinterest_url',
            'type'    => 'text',
            'title'   => esc_html__('Pinterest URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_vimeo_url',
            'type'    => 'text',
            'title'   => esc_html__('Vimeo URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_youtube_url',
            'type'    => 'text',
            'title'   => esc_html__('Youtube URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_yelp_url',
            'type'    => 'text',
            'title'   => esc_html__('Yelp URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_tumblr_url',
            'type'    => 'text',
            'title'   => esc_html__('Tumblr URL', 'optime'),
            'default' => '',
        ),
        array(
            'id'      => 'social_tripadvisor_url',
            'type'    => 'text',
            'title'   => esc_html__('Tripadvisor URL', 'optime'),
            'default' => '',
        ),
    )
));

/* Custom Code /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Custom Code', 'optime'),
    'icon' => 'el-icon-edit',
    'fields' => array(

        array(
            'id' => 'site_header_code',
            'type' => 'textarea',
            'theme' => 'chrome',
            'title' => esc_html__('Header Custom Codes', 'optime'),
            'subtitle' => esc_html__('It will insert the code to wp_head hook.', 'optime'),
        ),
        array(
            'id' => 'site_footer_code',
            'type' => 'textarea',
            'theme' => 'chrome',
            'title' => esc_html__('Footer Custom Codes', 'optime'),
            'subtitle' => esc_html__('It will insert the code to wp_footer hook.', 'optime'),
        ),

    ),
));

/* Custom CSS /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Custom CSS', 'optime'),
    'icon' => 'el-icon-adjust-alt',
    'fields' => array(

        array(
            'id' => 'customcss',
            'type' => 'info',
            'desc' => esc_html__('Custom CSS', 'optime')
        ),

        array(
            'id' => 'site_css',
            'type' => 'ace_editor',
            'title' => esc_html__('CSS Code', 'optime'),
            'subtitle' => esc_html__('Advanced CSS Options. You can paste your custom CSS Code here.', 'optime'),
            'mode' => 'css',
            'validate' => 'css',
            'theme' => 'chrome',
            'default' => ""
        ),

    ),
));