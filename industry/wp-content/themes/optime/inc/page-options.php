<?php
/**
 * Register metabox for posts based on Redux Framework. Supported methods:
 *     isset_args( $post_type )
 *     set_args( $post_type, $redux_args, $metabox_args )
 *     add_section( $post_type, $sections )
 * Each post type can contains only one metabox. Pease note that each field id
 * leads by an underscore sign ( _ ) in order to not show that into Custom Field
 * Metabox from WordPress core feature.
 *
 * @param  optime_Post_Metabox $metabox
 */

function optime_page_options_register( $metabox ) {
	if ( ! $metabox->isset_args( 'post' ) ) {
		$metabox->set_args( 'post', array(
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'optime' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'page' ) ) {
		$metabox->set_args( 'page', array(
			'opt_name'            => optime_get_page_opt_name(),
			'display_name'        => esc_html__( 'Page Settings', 'optime' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_audio' ) ) {
		$metabox->set_args( 'cms_pf_audio', array(
			'opt_name'     => 'post_format_audio',
			'display_name' => esc_html__( 'Audio', 'optime' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_link' ) ) {
		$metabox->set_args( 'cms_pf_link', array(
			'opt_name'     => 'post_format_link',
			'display_name' => esc_html__( 'Link', 'optime' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_quote' ) ) {
		$metabox->set_args( 'cms_pf_quote', array(
			'opt_name'     => 'post_format_quote',
			'display_name' => esc_html__( 'Quote', 'optime' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_video' ) ) {
		$metabox->set_args( 'cms_pf_video', array(
			'opt_name'     => 'post_format_video',
			'display_name' => esc_html__( 'Video', 'optime' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_gallery' ) ) {
		$metabox->set_args( 'cms_pf_gallery', array(
			'opt_name'     => 'post_format_gallery',
			'display_name' => esc_html__( 'Gallery', 'optime' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if (!$metabox->isset_args('product')) {
        $metabox->set_args('product', array(
            'opt_name'            => optime_get_page_opt_name(),
            'display_name'        => esc_html__('Product Settings', 'optime'),
            'show_options_object' => false,
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

	/* Extra Post Type */
	if ( ! $metabox->isset_args( 'portfolio' ) ) {
		$metabox->set_args( 'portfolio', array(
			'opt_name'            => 'portfolio_option',
			'display_name'        => esc_html__( 'Case Study Settings', 'optime' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'service' ) ) {
		$metabox->set_args( 'service', array(
			'opt_name'            => 'services_option',
			'display_name'        => esc_html__( 'Service Settings', 'optime' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

    if ( ! $metabox->isset_args( 'industry' ) ) {
        $metabox->set_args( 'industry', array(
            'opt_name'            => 'industries_option',
            'display_name'        => esc_html__( 'Industry Settings', 'optime' ),
            'show_options_object' => false,
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ) );
    }
    /**
     * Config post meta options
     *
     */
    $single_post_fields = array();
    $single_post_fields[] = array(
        'id'      => 'custom_pagetitle',
        'type'    => 'switch',
        'title'   => esc_html__( 'Custom Page Title', 'optime' ),
        'default' => false,
        'indent'  => true
    );
    $single_post_fields[] = array(
        'id'           => 'ptitle_layout',
        'type'         => 'image_select',
        'title'        => esc_html__( 'Layout', 'optime' ),
        'subtitle'     => esc_html__( 'Select a layout for page title.', 'optime' ),
        'options'      => array(
            '0' => get_template_directory_uri() . '/assets/images/page-title-layout/p0.jpg',
            '1' => get_template_directory_uri() . '/assets/images/page-title-layout/p1.jpg',
        ),
        'default'      => optime_get_option_of_theme_options( 'ptitle_layout' ),
        'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
        'force_output' => true
    );
    $single_post_fields[] = array(
        'id'           => 'custom_title',
        'type'         => 'text',
        'title'        => esc_html__( 'Custom Title', 'optime' ),
        'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'optime' ),
        'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
        'force_output' => true
    );
    $single_post_fields[] = array(
        'id'           => 'page_ptitle_color',
        'type'         => 'color',
        'title'        => esc_html__( 'Title Color', 'optime' ),
        'subtitle'     => esc_html__( 'Page title color.', 'optime' ),
        'output'       => array( 'body #pagetitle h1.page-title' ),
        'default'      => '',
        'transparent'  => false,
        'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
        'force_output' => true
    );
    $single_post_fields[] = array(
        'id'                    => 'page_ptitle_bg',
        'type'                  => 'background',
        'title'                 => esc_html__( 'Background', 'optime' ),
        'subtitle'              => esc_html__( 'Page title background.', 'optime' ),
        'output'                => array( '#pagetitle' ),
        'background-color'      => false,
        'background-repeat'     => false,
        'background-position'   => false,
        'background-attachment' => false,
        'background-size'       => false,
        'required'              => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
        'force_output'          => true
    );
    $single_post_fields[] = array(
        'id'           => 'ptitle_bg_color',
        'type'         => 'color_rgba',
        'title'        => esc_html__( 'Select Color', 'optime' ),
        'required'     => array( 0 => 'ptitle_overlay_style', 1 => 'equals', 2 => 'default' ),
        'force_output' => true,
    );
    $single_post_fields[] = array(
        'id'           => 'ptitle_paddings',
        'type'         => 'spacing',
        'title'        => esc_html__( 'Content Paddings', 'optime' ),
        'subtitle'     => esc_html__( 'Content page title paddings.', 'optime' ),
        'mode'         => 'padding',
        'units'        => array( 'em', 'px', '%' ),
        'top'          => true,
        'right'        => false,
        'bottom'       => true,
        'left'         => false,
        'output'       => array( 'body #pagetitle' ),
        'default'      => array(
            'top'    => '',
            'right'  => '',
            'bottom' => '',
            'left'   => '',
            'units'  => 'px',
        ),
        'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
        'force_output' => true
    );
    $metabox->add_section('post', array(
        'title' => esc_html__('Sidebar Position', 'optime'),
        'icon' => 'el el-refresh',
        'fields' => $single_post_fields
    ));
    /**
     * Config page meta options
     *
     */
    $metabox->add_section( 'page', array(
        'title'  => esc_html__( 'Header', 'optime' ),
        'desc'   => esc_html__( 'Header settings for the page.', 'optime' ),
        'icon'   => 'el-icon-website',
        'fields' => array(
            array(
                'id'      => 'custom_header',
                'type'    => 'switch',
                'title'   => esc_html__( 'Custom Header', 'optime' ),
                'default' => false,
                'indent'  => true
            ),
            array(
                'id'           => 'header_layout',
                'type'         => 'image_select',
                'title'        => esc_html__( 'Layout', 'optime' ),
                'subtitle'     => esc_html__( 'Select a layout for header.', 'optime' ),
                'options'      => array(
                    '0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
                    '1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
                    '2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
                    '3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
                    '4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
                ),
                'default'      => optime_get_option_of_theme_options( 'header_layout' ),
                'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'h_bg_color',
                'type'         => 'color_rgba',
                'title'        => esc_html__( 'Background Color', 'optime' ),
                'required'     => array( 0 => 'header_layout', 1 => 'equals', 2 => '9' ),
                'force_output' => true,
            ),
        )
    ) );

    $metabox->add_section( 'page', array(
        'title'  => esc_html__( 'Page Title', 'optime' ),
        'desc'   => esc_html__( 'Settings for page title.', 'optime' ),
        'icon'   => 'el-icon-map-marker',
        'fields' => array(
            array(
                'id'      => 'custom_pagetitle',
                'type'    => 'switch',
                'title'   => esc_html__( 'Custom Page Title', 'optime' ),
                'default' => false,
                'indent'  => true
            ),
            array(
                'id'           => 'ptitle_layout',
                'type'         => 'image_select',
                'title'        => esc_html__( 'Layout', 'optime' ),
                'subtitle'     => esc_html__( 'Select a layout for page title.', 'optime' ),
                'options'      => array(
                    '0' => get_template_directory_uri() . '/assets/images/page-title-layout/p0.jpg',
                    '1' => get_template_directory_uri() . '/assets/images/page-title-layout/p1.jpg',
                ),
                'default'      => optime_get_option_of_theme_options( 'ptitle_layout' ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'custom_title',
                'type'         => 'text',
                'title'        => esc_html__( 'Title', 'optime' ),
                'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'optime' ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'page_ptitle_color',
                'type'         => 'color',
                'title'        => esc_html__( 'Title Color', 'optime' ),
                'subtitle'     => esc_html__( 'Page title color.', 'optime' ),
                'output'       => array( 'body #pagetitle h1.page-title' ),
                'default'      => '',
                'transparent'  => false,
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_font_size',
                'type'         => 'text',
                'title'        => esc_html__( 'Title Font Size', 'optime' ),
                'validate'     => 'numeric',
                'desc'         => 'Enter number',
                'msg'          => 'Please enter number',
                'default'      => '',
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_font_margin_top',
                'type'         => 'text',
                'title'        => esc_html__( 'Title Margin Top', 'optime' ),
                'validate'     => 'numeric',
                'desc'         => 'Enter number',
                'msg'          => 'Please enter number',
                'default'      => '',
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_font_margin_bottom',
                'type'         => 'text',
                'title'        => esc_html__( 'Title Margin Bottom', 'optime' ),
                'validate'     => 'numeric',
                'desc'         => 'Enter number',
                'msg'          => 'Please enter number',
                'default'      => '',
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'                    => 'page_ptitle_bg',
                'type'                  => 'background',
                'title'                 => esc_html__( 'Background', 'optime' ),
                'subtitle'              => esc_html__( 'Page title background.', 'optime' ),
                'output'                => array( '#pagetitle' ),
                'background-color'      => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'background-attachment' => false,
                'background-size'       => false,
                'required'              => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output'          => true
            ),
            array(
                'id'           => 'ptitle_bg_color',
                'type'         => 'color_rgba',
                'title'        => esc_html__( 'Select Color', 'optime' ),
                'required'     => array( 0 => 'ptitle_overlay_style', 1 => 'equals', 2 => 'default' ),
                'force_output' => true,
            ),
            array(
                'id'           => 'ptitle_paddings',
                'type'         => 'spacing',
                'title'        => esc_html__( 'Content Paddings', 'optime' ),
                'subtitle'     => esc_html__( 'Content page title paddings.', 'optime' ),
                'mode'         => 'padding',
                'units'        => array( 'em', 'px', '%' ),
                'top'          => true,
                'right'        => false,
                'bottom'       => true,
                'left'         => false,
                'output'       => array( 'body #pagetitle.page-title' ),
                'default'      => array(
                    'top'    => '',
                    'right'  => '',
                    'bottom' => '',
                    'left'   => '',
                    'units'  => 'px',
                ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
        )
    ) );

    $metabox->add_section( 'page', array(
        'title'  => esc_html__( 'Content', 'optime' ),
        'desc'   => esc_html__( 'Settings for content area.', 'optime' ),
        'icon'   => 'el-icon-pencil',
        'fields' => array(
            array(
                'id'       => 'content_bg_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background Color', 'optime' ),
                'subtitle' => esc_html__( 'Content background color.', 'optime' ),
                'output'   => array( 'background-color' => '#content' )
            ),
            array(
                'id'             => 'content_padding',
                'type'           => 'spacing',
                'output'         => array( '#content' ),
                'right'          => false,
                'left'           => false,
                'mode'           => 'padding',
                'units'          => array( 'px' ),
                'units_extended' => 'false',
                'title'          => esc_html__( 'Content Padding', 'optime' ),
                'desc'           => esc_html__( 'Default: Theme Option.', 'optime' ),
                'default'        => array(
                    'padding-top'    => '',
                    'padding-bottom' => '',
                    'units'          => 'px',
                )
            ),
            array(
                'id'      => 'show_sidebar_page',
                'type'    => 'switch',
                'title'   => esc_html__( 'Show Sidebar', 'optime' ),
                'default' => false,
                'indent'  => true
            ),
            array(
                'id'           => 'sidebar_page_pos',
                'type'         => 'button_set',
                'title'        => esc_html__( 'Sidebar Position', 'optime' ),
                'options'      => array(
                    'left'  => esc_html__( 'Left', 'optime' ),
                    'right' => esc_html__( 'Right', 'optime' ),
                ),
                'default'      => 'left',
                'required'     => array( 0 => 'show_sidebar_page', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
        )
    ) );

    $metabox->add_section( 'page', array(
        'title'  => esc_html__( 'Footer', 'optime' ),
        'desc'   => esc_html__( 'Settings for page footer.', 'optime' ),
        'icon'   => 'el el-website',
        'fields' => array(
            array(
                'id'      => 'custom_footer',
                'type'    => 'switch',
                'title'   => esc_html__( 'Custom Footer', 'optime' ),
                'default' => false,
                'indent'  => true
            ),
            array(
                'id'           => 'footer_layout',
                'type'         => 'image_select',
                'title'        => esc_html__( 'Layout', 'optime' ),
                'options'      => array(
                    '0' => get_template_directory_uri() . '/assets/images/footer-layout/f0.jpg',
                    '1' => get_template_directory_uri() . '/assets/images/footer-layout/f1.jpg'
                ),
                'default'      => '1',
                'required'     => array( 0 => 'custom_footer', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'       => 'footer_bg1',
                'type'     => 'background',
                'title'    => esc_html__('Background', 'optime'),
                'subtitle' => esc_html__('Footer background.', 'optime'),
                'default'  => '',
                'output'   => array('footer.site-footer.footer-layout1 .bg-overlay'),
                'force_output' => true,
                'required' => array( 0 => 'footer_layout', 1 => 'equals', 2 => '1' ),
            ),
            array(
                'id' => 'footer_border_top',
                'type' => 'color',
                'title' => esc_html__('Border top color', 'optime'),
                'subtitle' => esc_html__('Footer border top color', 'optime'),
                'default' => '',
                'transparent'  => false,
                'output' => array('border-top-color' => 'footer#colophon'),
                'force_output' => true,
                'required' => array( 0 => 'footer_layout', 1 => 'equals', 2 => '1' ),
            ),
            array(
                'id'      => 'show_newsletter_page',
                'type'    => 'switch',
                'title'   => esc_html__( 'Show Newsletter In Footer', 'optime' ),
                'default' => true,
                'indent'  => true
            ),
        )
    ) );

    /**
     * Config post format meta options
     *
     */

    $metabox->add_section( 'cms_pf_video', array(
        'title'  => esc_html__( 'Video', 'optime' ),
        'fields' => array(
            array(
                'id'    => 'post-video-url',
                'type'  => 'text',
                'title' => esc_html__( 'Video URL', 'optime' ),
                'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'optime' )
            ),

            array(
                'id'    => 'post-video-file',
                'type'  => 'editor',
                'title' => esc_html__( 'Video Upload', 'optime' ),
                'desc'  => esc_html__( 'Upload video file', 'optime' )
            ),

            array(
                'id'    => 'post-video-html',
                'type'  => 'textarea',
                'title' => esc_html__( 'Embadded video', 'optime' ),
                'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'optime' )
            )
        )
    ) );

    $metabox->add_section( 'cms_pf_gallery', array(
        'title'  => esc_html__( 'Gallery', 'optime' ),
        'fields' => array(
            array(
                'id'       => 'post-gallery-lightbox',
                'type'     => 'switch',
                'title'    => esc_html__( 'Lightbox?', 'optime' ),
                'subtitle' => esc_html__( 'Enable lightbox for gallery images.', 'optime' ),
                'default'  => true
            ),
            array(
                'id'       => 'post-gallery-images',
                'type'     => 'gallery',
                'title'    => esc_html__( 'Gallery Images ', 'optime' ),
                'subtitle' => esc_html__( 'Upload images or add from media library.', 'optime' )
            )
        )
    ) );

    $metabox->add_section( 'cms_pf_audio', array(
        'title'  => esc_html__( 'Audio', 'optime' ),
        'fields' => array(
            array(
                'id'          => 'post-audio-url',
                'type'        => 'text',
                'title'       => esc_html__( 'Audio URL', 'optime' ),
                'description' => esc_html__( 'Audio file URL in format: mp3, ogg, wav.', 'optime' ),
                'validate'    => 'url',
                'msg'         => 'Url error!'
            )
        )
    ) );

    $metabox->add_section( 'cms_pf_link', array(
        'title'  => esc_html__( 'Link', 'optime' ),
        'fields' => array(
            array(
                'id'       => 'post-link-url',
                'type'     => 'text',
                'title'    => esc_html__( 'URL', 'optime' ),
                'validate' => 'url',
                'msg'      => 'Url error!'
            )
        )
    ) );

    $metabox->add_section( 'cms_pf_quote', array(
        'title'  => esc_html__( 'Quote', 'optime' ),
        'fields' => array(
            array(
                'id'    => 'post-quote-cite',
                'type'  => 'text',
                'title' => esc_html__( 'Cite', 'optime' )
            )
        )
    ) );
	/**
	 * Config Case Study meta options
	 *
	 */
	$portfolio_fields       = array(
		array(
			'id'             => 'portfolio_content_padding',
			'type'           => 'spacing',
			'output'         => array( '.single-portfolio #content'),
			'right'          => false,
			'left'           => false,
			'mode'           => 'padding',
			'units'          => array( 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Content Padding', 'optime' ),
			'desc'           => esc_html__( 'Default: Theme Option.', 'optime' ),
			'default'        => array(
				'padding-top'    => '',
				'padding-bottom' => '',
				'units'          => 'px',
			)
		),
        array(
            'id'      => 'show_sidebar_portfolio',
            'type'    => 'switch',
            'title'   => esc_html__( 'Show Sidebar', 'optime' ),
            'default' => true,
            'indent'  => true
        ),
        array(
            'id'      => 'show_newsletter_portfolio',
            'type'    => 'switch',
            'title'   => esc_html__( 'Show Newsletter In Footer', 'optime' ),
            'default' => true,
            'indent'  => true
        ),
	);
	$metabox->add_section( 'portfolio', array(
		'title'  => esc_html__( 'Page Title', 'optime' ),
		'icon'   => 'el-icon-map-marker',
		'fields' => array(
			array(
				'id'      => 'custom_pagetitle',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Page Title', 'optime' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'ptitle_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'optime' ),
				'subtitle'     => esc_html__( 'Select a layout for page title.', 'optime' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/page-title-layout/p0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/page-title-layout/p1.jpg',
				),
				'default'      => optime_get_option_of_theme_options( 'ptitle_layout' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'sub_title',
				'type'         => 'text',
				'title'        => esc_html__( 'Sub Title', 'optime' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'custom_title',
				'type'         => 'text',
				'title'        => esc_html__( 'Title', 'optime' ),
				'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'optime' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'page_ptitle_color',
				'type'         => 'color',
				'title'        => esc_html__( 'Title Color', 'optime' ),
				'subtitle'     => esc_html__( 'Page title color.', 'optime' ),
				'output'       => array( 'body #pagetitle h1.page-title' ),
				'default'      => '',
				'transparent'  => false,
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'ptitle_font_size',
				'type'         => 'text',
				'title'        => esc_html__( 'Title Font Size', 'optime' ),
				'validate'     => 'numeric',
				'desc'         => 'Enter number',
				'msg'          => 'Please enter number',
				'default'      => '',
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'ptitle_description',
				'type'         => 'textarea',
				'title'        => esc_html__( 'Description', 'optime' ),
				'validate'     => 'html_custom',
				'default'      => '',
				'allowed_html' => array(
					'a'      => array(
						'href'  => array(),
						'title' => array(),
						'class' => array(),
					),
					'br'     => array(),
					'em'     => array(),
					'strong' => array(),
					'span'   => array(),
					'p'      => array(),
					'div'    => array(
						'class' => array()
					),
					'h1'     => array(
						'class' => array()
					),
					'h2'     => array(
						'class' => array()
					),
					'h3'     => array(
						'class' => array()
					),
					'h4'     => array(
						'class' => array()
					),
					'h5'     => array(
						'class' => array()
					),
					'h6'     => array(
						'class' => array()
					),
					'ul'     => array(
						'class' => array()
					),
					'li'     => array(),
				),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'ptitle_description_font_size',
				'type'         => 'text',
				'title'        => esc_html__( 'Description Font Size', 'optime' ),
				'validate'     => 'numeric',
				'desc'         => 'Enter number',
				'msg'          => 'Please enter number',
				'default'      => '',
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'ptitle_description_line_height',
				'type'         => 'text',
				'title'        => esc_html__( 'Description Line Height', 'optime' ),
				'validate'     => 'numeric',
				'desc'         => 'Enter number',
				'msg'          => 'Please enter number',
				'default'      => '',
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'ptitle_description_color',
				'type'         => 'color',
				'title'        => esc_html__( 'Description Color', 'optime' ),
				'subtitle'     => esc_html__( 'Page title color.', 'optime' ),
				'output'       => array( 'body #pagetitle .page-title-desc' ),
				'default'      => '',
				'transparent'  => false,
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'                    => 'page_ptitle_bg',
				'type'                  => 'background',
				'title'                 => esc_html__( 'Background', 'optime' ),
				'subtitle'              => esc_html__( 'Page title background.', 'optime' ),
				'output'                => array( '#pagetitle' ),
				'background-color'      => false,
				'background-repeat'     => false,
				'background-position'   => false,
				'background-attachment' => false,
				'background-size'       => false,
				'required'              => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output'          => true
			),
			array(
				'id'           => 'ptitle_paddings',
				'type'         => 'spacing',
				'title'        => esc_html__( 'Content Paddings', 'optime' ),
				'subtitle'     => esc_html__( 'Content page title paddings.', 'optime' ),
				'mode'         => 'padding',
				'units'        => array( 'em', 'px', '%' ),
				'top'          => true,
				'right'        => false,
				'bottom'       => true,
				'left'         => false,
				'output'       => array( 'body #pagetitle' ),
				'default'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
					'units'  => 'px',
				),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
			array(
				'id'           => 'ptitle_content_align',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Content Align', 'optime' ),
				'options'      => array(
					'themeoption' => esc_html__( 'Theme Option', 'optime' ),
					'left'        => esc_html__( 'Left', 'optime' ),
					'center'      => esc_html__( 'Center', 'optime' ),
					'right'       => esc_html__( 'Right', 'optime' ),
				),
				'default'      => 'themeoption',
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
		)
	) );
    $metabox->add_section( 'portfolio', array(
        'title'  => esc_html__( 'Content', 'optime' ),
        'icon'   => 'el-icon-pencil',
        'fields' => $portfolio_fields
    ) );

    /**
     * Config service meta options
     *
     */
    $service_fields       = array(
        array(
            'id' => 'service_icon',
            'type' => 'media',
            'title' => esc_html__('Service Icon', 'optime'),
        ),
        array(
            'id'             => 'service_content_padding',
            'type'           => 'spacing',
            'output'         => array( '.single-service #content'),
            'right'          => false,
            'left'           => false,
            'mode'           => 'padding',
            'units'          => array( 'px' ),
            'units_extended' => 'false',
            'title'          => esc_html__( 'Content Padding', 'optime' ),
            'desc'           => esc_html__( 'Default: Theme Option.', 'optime' ),
            'default'        => array(
                'padding-top'    => '',
                'padding-bottom' => '',
                'units'          => 'px',
            )
        ),
        array(
            'id'      => 'show_sidebar_service',
            'type'    => 'switch',
            'title'   => esc_html__( 'Show Sidebar', 'optime' ),
            'default' => true,
            'indent'  => true
        ),
        array(
            'id'      => 'show_newsletter_service',
            'type'    => 'switch',
            'title'   => esc_html__( 'Show Newsletter In Footer', 'optime' ),
            'default' => true,
            'indent'  => true
        ),
    );
    $metabox->add_section( 'service', array(
        'title'  => esc_html__( 'Page Title', 'optime' ),
        'icon'   => 'el-icon-map-marker',
        'fields' => array(
            array(
                'id'      => 'custom_pagetitle',
                'type'    => 'switch',
                'title'   => esc_html__( 'Custom Page Title', 'optime' ),
                'default' => false,
                'indent'  => true
            ),
            array(
                'id'           => 'ptitle_layout',
                'type'         => 'image_select',
                'title'        => esc_html__( 'Layout', 'optime' ),
                'subtitle'     => esc_html__( 'Select a layout for page title.', 'optime' ),
                'options'      => array(
                    '0' => get_template_directory_uri() . '/assets/images/page-title-layout/p0.jpg',
                    '1' => get_template_directory_uri() . '/assets/images/page-title-layout/p1.jpg',
                ),
                'default'      => optime_get_option_of_theme_options( 'ptitle_layout' ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'sub_title',
                'type'         => 'text',
                'title'        => esc_html__( 'Sub Title', 'optime' ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'custom_title',
                'type'         => 'text',
                'title'        => esc_html__( 'Title', 'optime' ),
                'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'optime' ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'page_ptitle_color',
                'type'         => 'color',
                'title'        => esc_html__( 'Title Color', 'optime' ),
                'subtitle'     => esc_html__( 'Page title color.', 'optime' ),
                'output'       => array( 'body #pagetitle h1.page-title' ),
                'default'      => '',
                'transparent'  => false,
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_font_size',
                'type'         => 'text',
                'title'        => esc_html__( 'Title Font Size', 'optime' ),
                'validate'     => 'numeric',
                'desc'         => 'Enter number',
                'msg'          => 'Please enter number',
                'default'      => '',
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_description',
                'type'         => 'textarea',
                'title'        => esc_html__( 'Description', 'optime' ),
                'validate'     => 'html_custom',
                'default'      => '',
                'allowed_html' => array(
                    'a'      => array(
                        'href'  => array(),
                        'title' => array(),
                        'class' => array(),
                    ),
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    'span'   => array(),
                    'p'      => array(),
                    'div'    => array(
                        'class' => array()
                    ),
                    'h1'     => array(
                        'class' => array()
                    ),
                    'h2'     => array(
                        'class' => array()
                    ),
                    'h3'     => array(
                        'class' => array()
                    ),
                    'h4'     => array(
                        'class' => array()
                    ),
                    'h5'     => array(
                        'class' => array()
                    ),
                    'h6'     => array(
                        'class' => array()
                    ),
                    'ul'     => array(
                        'class' => array()
                    ),
                    'li'     => array(),
                ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_description_font_size',
                'type'         => 'text',
                'title'        => esc_html__( 'Description Font Size', 'optime' ),
                'validate'     => 'numeric',
                'desc'         => 'Enter number',
                'msg'          => 'Please enter number',
                'default'      => '',
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_description_line_height',
                'type'         => 'text',
                'title'        => esc_html__( 'Description Line Height', 'optime' ),
                'validate'     => 'numeric',
                'desc'         => 'Enter number',
                'msg'          => 'Please enter number',
                'default'      => '',
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_description_color',
                'type'         => 'color',
                'title'        => esc_html__( 'Description Color', 'optime' ),
                'subtitle'     => esc_html__( 'Page title color.', 'optime' ),
                'output'       => array( 'body #pagetitle .page-title-desc' ),
                'default'      => '',
                'transparent'  => false,
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'                    => 'page_ptitle_bg',
                'type'                  => 'background',
                'title'                 => esc_html__( 'Background', 'optime' ),
                'subtitle'              => esc_html__( 'Page title background.', 'optime' ),
                'output'                => array( '#pagetitle' ),
                'background-color'      => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'background-attachment' => false,
                'background-size'       => false,
                'required'              => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output'          => true
            ),
            array(
                'id'           => 'ptitle_paddings',
                'type'         => 'spacing',
                'title'        => esc_html__( 'Content Paddings', 'optime' ),
                'subtitle'     => esc_html__( 'Content page title paddings.', 'optime' ),
                'mode'         => 'padding',
                'units'        => array( 'em', 'px', '%' ),
                'top'          => true,
                'right'        => false,
                'bottom'       => true,
                'left'         => false,
                'output'       => array( 'body #pagetitle' ),
                'default'      => array(
                    'top'    => '',
                    'right'  => '',
                    'bottom' => '',
                    'left'   => '',
                    'units'  => 'px',
                ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_content_align',
                'type'         => 'button_set',
                'title'        => esc_html__( 'Content Align', 'optime' ),
                'options'      => array(
                    'themeoption' => esc_html__( 'Theme Option', 'optime' ),
                    'left'        => esc_html__( 'Left', 'optime' ),
                    'center'      => esc_html__( 'Center', 'optime' ),
                    'right'       => esc_html__( 'Right', 'optime' ),
                ),
                'default'      => 'themeoption',
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
        )
    ) );
    $metabox->add_section( 'service', array(
        'title'  => esc_html__( 'Content', 'optime' ),
        'icon'   => 'el-icon-pencil',
        'fields' => $service_fields
    ) );

    /**
     * Config Industry meta options
     *
     */
    $industry_fields       = array(
        array(
            'id'             => 'portfolio_content_padding',
            'type'           => 'spacing',
            'output'         => array( '.single-portfolio #content'),
            'right'          => false,
            'left'           => false,
            'mode'           => 'padding',
            'units'          => array( 'px' ),
            'units_extended' => 'false',
            'title'          => esc_html__( 'Content Padding', 'optime' ),
            'desc'           => esc_html__( 'Default: Theme Option.', 'optime' ),
            'default'        => array(
                'padding-top'    => '',
                'padding-bottom' => '',
                'units'          => 'px',
            )
        ),
        array(
            'id'      => 'show_sidebar_industry',
            'type'    => 'switch',
            'title'   => esc_html__( 'Show Sidebar', 'optime' ),
            'default' => true,
            'indent'  => true
        ),
        array(
            'id'      => 'show_newsletter_industry',
            'type'    => 'switch',
            'title'   => esc_html__( 'Show Newsletter In Footer', 'optime' ),
            'default' => true,
            'indent'  => true
        ),
    );
    $metabox->add_section( 'industry', array(
        'title'  => esc_html__( 'Page Title', 'optime' ),
        'icon'   => 'el-icon-map-marker',
        'fields' => array(
            array(
                'id'      => 'custom_pagetitle',
                'type'    => 'switch',
                'title'   => esc_html__( 'Custom Page Title', 'optime' ),
                'default' => false,
                'indent'  => true
            ),
            array(
                'id'           => 'ptitle_layout',
                'type'         => 'image_select',
                'title'        => esc_html__( 'Layout', 'optime' ),
                'subtitle'     => esc_html__( 'Select a layout for page title.', 'optime' ),
                'options'      => array(
                    '0' => get_template_directory_uri() . '/assets/images/page-title-layout/p0.jpg',
                    '1' => get_template_directory_uri() . '/assets/images/page-title-layout/p1.jpg',
                ),
                'default'      => optime_get_option_of_theme_options( 'ptitle_layout' ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'sub_title',
                'type'         => 'text',
                'title'        => esc_html__( 'Sub Title', 'optime' ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'custom_title',
                'type'         => 'text',
                'title'        => esc_html__( 'Title', 'optime' ),
                'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'optime' ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'page_ptitle_color',
                'type'         => 'color',
                'title'        => esc_html__( 'Title Color', 'optime' ),
                'subtitle'     => esc_html__( 'Page title color.', 'optime' ),
                'output'       => array( 'body #pagetitle h1.page-title' ),
                'default'      => '',
                'transparent'  => false,
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_font_size',
                'type'         => 'text',
                'title'        => esc_html__( 'Title Font Size', 'optime' ),
                'validate'     => 'numeric',
                'desc'         => 'Enter number',
                'msg'          => 'Please enter number',
                'default'      => '',
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_description',
                'type'         => 'textarea',
                'title'        => esc_html__( 'Description', 'optime' ),
                'validate'     => 'html_custom',
                'default'      => '',
                'allowed_html' => array(
                    'a'      => array(
                        'href'  => array(),
                        'title' => array(),
                        'class' => array(),
                    ),
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    'span'   => array(),
                    'p'      => array(),
                    'div'    => array(
                        'class' => array()
                    ),
                    'h1'     => array(
                        'class' => array()
                    ),
                    'h2'     => array(
                        'class' => array()
                    ),
                    'h3'     => array(
                        'class' => array()
                    ),
                    'h4'     => array(
                        'class' => array()
                    ),
                    'h5'     => array(
                        'class' => array()
                    ),
                    'h6'     => array(
                        'class' => array()
                    ),
                    'ul'     => array(
                        'class' => array()
                    ),
                    'li'     => array(),
                ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_description_font_size',
                'type'         => 'text',
                'title'        => esc_html__( 'Description Font Size', 'optime' ),
                'validate'     => 'numeric',
                'desc'         => 'Enter number',
                'msg'          => 'Please enter number',
                'default'      => '',
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_description_line_height',
                'type'         => 'text',
                'title'        => esc_html__( 'Description Line Height', 'optime' ),
                'validate'     => 'numeric',
                'desc'         => 'Enter number',
                'msg'          => 'Please enter number',
                'default'      => '',
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_description_color',
                'type'         => 'color',
                'title'        => esc_html__( 'Description Color', 'optime' ),
                'subtitle'     => esc_html__( 'Page title color.', 'optime' ),
                'output'       => array( 'body #pagetitle .page-title-desc' ),
                'default'      => '',
                'transparent'  => false,
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'                    => 'page_ptitle_bg',
                'type'                  => 'background',
                'title'                 => esc_html__( 'Background', 'optime' ),
                'subtitle'              => esc_html__( 'Page title background.', 'optime' ),
                'output'                => array( '#pagetitle' ),
                'background-color'      => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'background-attachment' => false,
                'background-size'       => false,
                'required'              => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output'          => true
            ),
            array(
                'id'           => 'ptitle_paddings',
                'type'         => 'spacing',
                'title'        => esc_html__( 'Content Paddings', 'optime' ),
                'subtitle'     => esc_html__( 'Content page title paddings.', 'optime' ),
                'mode'         => 'padding',
                'units'        => array( 'em', 'px', '%' ),
                'top'          => true,
                'right'        => false,
                'bottom'       => true,
                'left'         => false,
                'output'       => array( 'body #pagetitle' ),
                'default'      => array(
                    'top'    => '',
                    'right'  => '',
                    'bottom' => '',
                    'left'   => '',
                    'units'  => 'px',
                ),
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'           => 'ptitle_content_align',
                'type'         => 'button_set',
                'title'        => esc_html__( 'Content Align', 'optime' ),
                'options'      => array(
                    'themeoption' => esc_html__( 'Theme Option', 'optime' ),
                    'left'        => esc_html__( 'Left', 'optime' ),
                    'center'      => esc_html__( 'Center', 'optime' ),
                    'right'       => esc_html__( 'Right', 'optime' ),
                ),
                'default'      => 'themeoption',
                'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => '1' ),
                'force_output' => true
            ),
        )
    ) );
    $metabox->add_section( 'industry', array(
        'title'  => esc_html__( 'Content', 'optime' ),
        'icon'   => 'el-icon-pencil',
        'fields' => $industry_fields
    ) );

}


add_action( 'cms_post_metabox_register', 'optime_page_options_register' );

function optime_get_option_of_theme_options( $key, $default = '' ) {
	if ( empty( $key ) ) {
		return '';
	}
	$options = get_option( optime_get_opt_name(), array() );
	$value   = isset( $options[ $key ] ) ? $options[ $key ] : $default;

	return $value;
}