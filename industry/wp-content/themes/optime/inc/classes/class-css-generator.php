<?php
if ( ! class_exists( 'ReduxFrameworkInstances' ) )
{
    return;
}

class CSS_Generator
{
    /**
     * scssc class instance
     *
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null;

    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode = true;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';


    /**
     * Constructor
     */
    function __construct()
    {
        $this->opt_name = optime_get_opt_name();

        if ( empty( $this->opt_name ) )
        {
            return;
        }
        $this->dev_mode = optime_get_opt( 'dev_mode', '0' ) === '1' ? true : false;
        add_filter( 'cms_scssc_on', '__return_true' );
        add_action( 'init', array( $this, 'init' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 20 );
    }

    /**
     * init hook - 10
     */
    function init()
    {
        if ( ! class_exists( 'scssc' ) )
        {
            return;
        }

        $this->redux = ReduxFrameworkInstances::get_instance( $this->opt_name );

        if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework )
        {
            return;
        }

        if ( $this->dev_mode === true )
        {
            $this->generate_file();
        }
        else
        {
            add_action( "redux/options/{$this->opt_name}/saved", array( $this, 'generate_file' ) );
        }
    }

    /**
     * Generate options and css files
     */
    function generate_file()
    {
        $scss_dir = get_template_directory() . '/assets/scss/';
        $css_dir  = get_template_directory() . '/assets/css/';

        $this->scssc = new scssc();
        $this->scssc->setImportPaths( $scss_dir );

        $_options = $scss_dir . 'variables.scss';

        $this->redux->filesystem->execute( 'put_contents', $_options, array(
            'content' => $this->options_output()
        ) );
        $css_file = $css_dir . 'theme.css';
        if ( ! $this->dev_mode )
        {
            $this->scssc->setFormatter( 'scss_formatter_compressed' );
            $css_file = $css_dir . 'theme.min.css';
        }else{
            $this->scssc->setFormatter( 'scss_formatter' );
        }
        $this->redux->filesystem->execute( 'put_contents', $css_file, array(
            'content' => $this->scssc->compile( '@import "theme.scss"' )
        ) );
    }

    /**
     * Output options to _variables.scss
     *
     * @access protected
     * @return string
     */
    protected function options_output()
    {
        ob_start();

        $primary_color = optime_get_opt( 'primary_color', '#fb5b21' );
        if ( ! optime_is_valid_color( $primary_color ) )
        {
            $primary_color = '#ff5e14';
        }
        printf( '$primary_color: %s;', esc_attr( $primary_color ) );

        $secondary_color = optime_get_opt( 'secondary_color', '#282828' );
        if ( ! optime_is_valid_color( $secondary_color ) )
        {
            $secondary_color = '#282828';
        }
        printf( '$secondary_color: %s;', esc_attr( $secondary_color ) );

        $link_color = optime_get_opt( 'link_color', '' );
        if ( !empty($link_color['regular']) && isset($link_color['regular']) )
        {
            printf( '$link_color: %s;', esc_attr( $link_color['regular'] ) );
        } else {
            echo '$link_color: inherit;';
        }

        if ( !empty($link_color['hover']) && isset($link_color['hover']) )
        {
            printf( '$link_color_hover: %s;', esc_attr( $link_color['hover'] ) );
        } else {
            printf( '$link_color_hover: %s;', esc_attr( $primary_color ) );
        }

        if ( !empty($link_color['active']) && isset($link_color['active']) )
        {
            printf( '$link_color_active: %s;', esc_attr( $link_color['active'] ) );
        } else {
            printf( '$link_color_active: %s;', esc_attr( $primary_color ) );
        }

        /* Font */
        $body_default_font = optime_get_opt( 'body_default_font' );
        if (!empty($body_default_font) && $body_default_font != 'inherit') {
            echo '
                $body_default_font: '.esc_attr( $body_default_font ).';
            ';
        }

        $heading_default_font = optime_get_opt( 'heading_default_font', 'inherit' );
        if (!empty($heading_default_font) && $heading_default_font != 'inherit') {
            echo '
                $heading_default_font: '.esc_attr( $heading_default_font ).';
            ';
        }


        $menu_default_font = optime_get_opt( 'menu_default_font', 'Roboto' );
        if (!empty($menu_default_font)) {
            printf( '$menu_default_font: %s;', esc_attr( $menu_default_font ) );
        }

        return ob_get_clean();
    }

    /**
     * Hooked wp_enqueue_scripts - 20
     * Make sure that the handle is enqueued from earlier wp_enqueue_scripts hook.
     */
    function enqueue()
    {
        $css = $this->inline_css();
        if ( !empty($css) )
        {
            wp_add_inline_style( 'optime-theme', $this->dev_mode ? $css : optime_css_minifier( $css ) );
        }
    }

    /**
     * Generate inline css based on theme options
     */
    protected function inline_css()
    {
        ob_start();
        /* Font */
        $body_default_font = optime_get_opt( 'body_default_font', '' );
        if ($body_default_font != 'inherit') {
            echo ".ft-main-r, body {
                font-weight: normal !important;
            }";
        }

        $heading_default_font_medium = optime_get_opt( 'heading_default_font_medium', 'inherit' );
        if ($heading_default_font_medium != 'inherit') {
            echo ".ft-heading-m, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
                font-weight: normal !important;
            }";
        }

        $heading_default_font_bold = optime_get_opt( 'heading_default_font_bold', 'inherit' );
        if ($heading_default_font_bold != 'inherit') {
            echo ".ft-heading-b {
                font-weight: normal !important;
            }";
        }
        /* General */
        $custom_pagetitle = optime_get_page_opt( 'custom_pagetitle', false );
        $ptitle_paddings = optime_get_page_opt( 'ptitle_paddings' );
        if (is_home() && !is_front_page()) {
            if ( isset($ptitle_paddings) && !empty($ptitle_paddings) && $custom_pagetitle) {
                echo "body #pagetitle {
                    padding-top:" .esc_attr($ptitle_paddings['padding-top']). ";
                    padding-bottom:" .esc_attr($ptitle_paddings['padding-bottom']). ";
                }";
            }
        }
        /* Logo */
        $logo_maxh = optime_get_opt( 'logo_maxh' );

        if (!empty($logo_maxh['height']) && $logo_maxh['height'] != 'px')
        {
            printf( '#site-header-wrap .site-branding a img { max-height: %s; }', esc_attr($logo_maxh['height']) );
        } ?>
        @media screen and (max-width: 991px) {
            <?php
            $logo_maxh_sm = optime_get_opt( 'logo_maxh_sm' );
            if (!empty($logo_maxh_sm['height']) && $logo_maxh_sm['height'] != 'px') {
                printf( '#site-header-wrap .site-branding a img { max-height: %s; }', esc_attr($logo_maxh_sm['height']) );
            } ?>
        }
        <?php /* Menu */
        $menu_text_transform = optime_get_opt( 'menu_text_transform' );
        if ( !empty( $menu_text_transform ) ) {
            printf( '.primary-menu > li > a { text-transform: %s !important; }', esc_attr($menu_text_transform) );
        }
        $menu_font_size = optime_get_opt( 'menu_font_size' );
        if ( !empty( $menu_font_size ) ) {
            printf( '.primary-menu > li > a { font-size: %s'.'px !important; }', esc_attr($menu_font_size) );
        }
        $main_menu_color = optime_get_opt( 'main_menu_color' );
        if ( !empty( $main_menu_color['regular'] ) ) {
            printf( '#site-header-wrap #mastmenu.primary-menu > li > a, #site-header-wrap .icon-in-nav:not(.mobile-icon) .search-icon { color: %s !important; }', esc_attr($main_menu_color['regular']) );
        }
        if ( !empty( $main_menu_color['hover'] ) ) {
            printf( '#site-header-wrap #mastmenu.primary-menu > li > a:hover, #site-header-wrap .icon-in-nav:not(.mobile-icon) .search-icon:hover { color: %s !important; }', esc_attr($main_menu_color['hover']) );
        }
        if ( !empty( $main_menu_color['active'] ) ) {
            printf( '#site-header-wrap #mastmenu.primary-menu > li.current_page_item > a, #site-header-wrap #mastmenu.primary-menu > li.current-menu-item > a, #site-header-wrap #mastmenu.primary-menu > li.current_page_ancestor > a, #site-header-wrap #mastmenu.primary-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr($main_menu_color['active']) );
        }
        $sticky_menu_color = optime_get_opt( 'sticky_menu_color' );
        if ( !empty( $sticky_menu_color['regular'] ) ) {
            printf( '#site-header-wrap .headroom--up #mastmenu.primary-menu > li > a { color: %s !important; }', esc_attr($sticky_menu_color['regular']) );
        }
        if ( !empty( $sticky_menu_color['hover'] ) ) {
            printf( '#site-header-wrap .site-header-main.offset-down-on.headroom--up #mastmenu.primary-menu > li > a:hover { color: %s !important; }', esc_attr($sticky_menu_color['hover']) );
        }
        if ( !empty( $sticky_menu_color['active'] ) ) {
            printf( '#site-header-wrap .headroom--up #mastmenu.primary-menu > li.current_page_item > a, #site-header-wrap .headroom--pinned:not(.headroom--top) #mastmenu.primary-menu > li.current-menu-item > a, #site-header-wrap .headroom--pinned:not(.headroom--top) #mastmenu.primary-menu > li.current_page_ancestor > a, #site-header-wrap .headroom--pinned:not(.headroom--top) #mastmenu.primary-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr($sticky_menu_color['active']) );
        }
        $h_bg_color = optime_get_page_opt( 'h_bg_color' ); ?>
        @media screen and (min-width: 992px) {
            <?php if(!empty($h_bg_color['rgba'])) {
                echo ".header-layout9 #headroom {
                    background-color:" .esc_attr($h_bg_color['rgba']). ";
                }";
            } ?>
        }

        <?php /* Page Title */
        ?>
        @media screen and (max-width: 991px) {
            <?php
            $ptitle_paddings_sm = optime_get_opt( 'ptitle_paddings_sm', array( 'padding-top' => '135px', 'padding-bottom' => '135px' ) );
            if ( isset($ptitle_paddings_sm) && isset($ptitle_paddings_sm['padding-top']) && !empty($ptitle_paddings_sm) ) {
                echo "body #pagetitle.page-title {
                    padding-top:" .esc_attr($ptitle_paddings_sm['padding-top']). ";
                    padding-bottom:" .esc_attr($ptitle_paddings_sm['padding-bottom']). ";
                }";
            } ?>
        }
        <?php
        $ptitle_overlay_style = optime_get_opt( 'ptitle_overlay_style', 'secondary' );
        $page_ptitle_overlay_style = optime_get_page_opt( 'ptitle_overlay_style', 'secondary' );
        $ptitle_bg_color = optime_get_opt( 'ptitle_bg_color' );
        $page_ptitle_bg_color = optime_get_page_opt( 'ptitle_bg_color' );
        if($custom_pagetitle && $page_ptitle_overlay_style == 'default' && !empty($page_ptitle_bg_color) ) {
            $ptitle_bg_color = $page_ptitle_bg_color;
            $ptitle_overlay_style = $page_ptitle_overlay_style;
        }
        if ( !empty($ptitle_bg_color) && $ptitle_overlay_style == 'default' )
        {
            printf( '#pagetitle.overlay-default { background-color: transparent; background-color: %s; }', esc_attr($ptitle_bg_color['rgba']) );
        }
        if ( $ptitle_overlay_style == 'none' )
        {
            echo "#pagetitle.bg-overlay:before {
                display: none;
            }";
        }
        $ptitle_content_align = optime_get_opt( 'ptitle_content_align' );
        if ( !empty( $ptitle_content_align ) ) {
            printf( '#pagetitle .page-title-inner { text-align: %s; }', esc_attr($ptitle_content_align) );
        }
        $ptitle_font_size = optime_get_opt( 'ptitle_font_size' );
        $page_title_font_size = optime_get_page_opt( 'ptitle_font_size' );
        if($custom_pagetitle && !empty($page_title_font_size)) {
            $ptitle_font_size = $page_title_font_size;
        }
        if ( !empty( $ptitle_font_size ) ) {
            printf( '#pagetitle h1.page-title { font-size: %s'.'px; }', esc_attr($ptitle_font_size) );
        }
        $ptitle_line_hegiht = optime_get_opt( 'ptitle_line_hegiht' );
        if ( !empty( $ptitle_line_hegiht ) ) {
            printf( '#pagetitle h1.page-title { line-height: %s'.'px; }', esc_attr($ptitle_line_hegiht) );
        }

        $ptitle_font_margin_top = optime_get_page_opt( 'ptitle_font_margin_top' );
        $ptitle_font_margin_bottom = optime_get_page_opt( 'ptitle_font_margin_bottom' );
        if ( !empty( $ptitle_font_margin_top ) ) {
            printf( '#pagetitle h1.page-title { margin-top: %s'.'px; }', esc_attr($ptitle_font_margin_top) );
        }
        if ( !empty( $ptitle_font_margin_bottom ) ) {
            printf( '#pagetitle h1.page-title { margin-bottom: %s'.'px; }', esc_attr($ptitle_font_margin_bottom) );
        }

        /* Content */
        $content_sidebar_space = optime_get_opt( 'content_sidebar_space' );
        $content_sidebar_space_number = ($content_sidebar_space/2).'px';
        ?>
        @media screen and (min-width: 992px) {
            <?php if ( !empty( $content_sidebar_space ) ) {
                printf( '.content-row { margin-left: -'.'%s; }', esc_attr($content_sidebar_space_number) );
                printf( '.content-row { margin-right: -'.'%s; }', esc_attr($content_sidebar_space_number) );
                printf( '.content-row #primary, .content-row #secondary { padding-left: %s !important; }', esc_attr($content_sidebar_space_number) );
                printf( '.content-row #primary, .content-row #secondary { padding-right: %s !important; }', esc_attr($content_sidebar_space_number) );
                printf( '.content-row #primary.content-has-sidebar .site-main{ margin: 0 !important; }');
            } ?>
        }
        <?php
        /* Footer */
        $footer_top_heading_fs = optime_get_opt( 'footer_top_heading_fs' );
        $footer_top_heading_tt = optime_get_opt( 'footer_top_heading_tt' );
        $footer_top_paddings = optime_get_opt( 'footer_top_paddings' );
        if(!empty($footer_top_heading_fs)) {
            echo '.top-footer .footer-widget-title {
                font-size: '.esc_attr( $footer_top_heading_fs ).'px !important;
            }';
        }
        if(!empty($footer_top_heading_tt)) {
            echo '.top-footer .footer-widget-title {
                text-transform: '.esc_attr( $footer_top_heading_tt ).' !important;
            }';
        }
        if ( isset($footer_top_paddings) && !empty($footer_top_paddings) ) {
            if(!empty($footer_top_paddings['padding-top'])) {
                echo ".site-footer .top-footer {
                    padding-top:" .esc_attr($footer_top_paddings['padding-top']). " !important;
                }";
            }
            if(!empty($footer_top_paddings['padding-bottom'])) {
                echo ".site-footer .top-footer {
                    padding-bottom:" .esc_attr($footer_top_paddings['padding-bottom']). " !important;
                }";
            }
        }
        /* Body */
        $site_layout = optime_get_opt( 'site_layout', 'default' );
        $site_background = optime_get_opt( 'site_background' );
        if($site_layout == 'boxed') {
            if(!empty($site_background['background-color'])) {
                echo "body.site-layout-boxed {
                    background-color:" .esc_attr($site_background['background-color']). ";
                }";
            }
            if(!empty($site_background['background-image'])) {
                echo "body.site-layout-boxed {
                    background-image: url(" .esc_url($site_background['background-image']). ");
                }";
            }
            if(!empty($site_background['background-repeat'])) {
                echo "body.site-layout-boxed {
                    background-repeat:" .esc_attr($site_background['background-repeat']). ";
                }";
            }
            if(!empty($site_background['background-position'])) {
                echo "body.site-layout-boxed {
                    background-position:" .esc_attr($site_background['background-position']). ";
                }";
            }
            if(!empty($site_background['background-attachment'])) {
                echo "body.site-layout-boxed {
                    background-attachment:" .esc_attr($site_background['background-attachment']). ";
                }";
            }
            if(!empty($site_background['background-size'])) {
                echo "body.site-layout-boxed {
                    background-size:" .esc_attr($site_background['background-size']). ";
                }";
            }
        }
        /* Custom Css */
        $custom_css = optime_get_opt( 'site_css' );
        if(!empty($custom_css)) { echo esc_attr($custom_css); }

        return ob_get_clean();
    }
}

new CSS_Generator();