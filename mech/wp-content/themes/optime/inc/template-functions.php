<?php
/**
 * Helper functions for the theme
 *
 * @package Optime
 */

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function optime_get_opt( $opt_id, $default = false ) {
	$opt_name = optime_get_opt_name();
	if ( empty( $opt_name ) ) {
		return $default;
	}

	global ${$opt_name};
	if ( ! isset( ${$opt_name} ) || ! isset( ${$opt_name}[ $opt_id ] ) ) {
		$options = get_option( $opt_name );
	} else {
		$options = ${$opt_name};
	}
	if ( ! isset( $options ) || ! isset( $options[ $opt_id ] ) || $options[ $opt_id ] === '' ) {
		return $default;
	}
	if ( is_array( $options[ $opt_id ] ) && is_array( $default ) ) {
		foreach ( $options[ $opt_id ] as $key => $value ) {
			if ( isset( $default[ $key ] ) && $value === '' ) {
				$options[ $opt_id ][ $key ] = $default[ $key ];
			}
		}
	}

	return $options[ $opt_id ];
}

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function optime_get_page_opt( $opt_id, $default = false ) {
	$page_opt_name = optime_get_page_opt_name();
	if ( empty( $page_opt_name ) ) {
		return $default;
	}
	$id = get_the_ID();
	if ( ! is_archive() && is_home() ) {
		if ( ! is_front_page() ) {
			$page_for_posts = get_option( 'page_for_posts' );
			$id             = $page_for_posts;
		}
	}

	return $options = ! empty($id) ? get_post_meta( intval( $id ), $opt_id, true ) : $default;
}

/**
 *
 * Get post format values.
 *
 * @param $post_format_key
 * @param bool $default
 *
 * @return bool|mixed
 */
function optime_get_post_format_value( $post_format_key, $default = false ) {
	global $post;

	return $value = ! empty( $post->ID ) ? get_post_meta( $post->ID, $post_format_key, true ) : $default;
}


/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function optime_get_opt_name_default(){
    return apply_filters( 'optime_opt_name', 'cms_theme_options' );
}
function optime_get_opt_name() {
    if(isset($_POST['opt_name']) && !empty($_POST['opt_name'])){
        return $_POST['opt_name'];
    }
    $opt_name = optime_get_opt_name_default();
    if(defined('ICL_LANGUAGE_CODE')){
        if(ICL_LANGUAGE_CODE != 'all' && !empty(ICL_LANGUAGE_CODE)){
            $opt_name = $opt_name.'_'.ICL_LANGUAGE_CODE;
        }
    }

    return $opt_name;
}


/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function optime_get_page_opt_name() {
	return apply_filters( 'optime_page_opt_name', 'cms_page_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function optime_get_post_opt_name() {
	return apply_filters( 'optime_post_opt_name', 'optime_post_options' );
}

/**
 * Get page title and description.
 *
 * @return array Contains 'title'
 */
function optime_get_page_titles() {
	$title = '';

	// Default titles
	if ( ! is_archive() ) {
		// Posts page view
		if ( is_home() ) {
			// Only available if posts page is set.
			if ( ! is_front_page() && $page_for_posts = get_option( 'page_for_posts' ) ) {
				$title = get_post_meta( $page_for_posts, 'custom_title', true );
				if ( empty( $title ) ) {
					$title = get_the_title( $page_for_posts );
				}
			}
			if ( is_front_page() ) {
				$title = esc_html__( 'Blog', 'optime' );
			}
		} // Single page view
        elseif ( is_page() ) {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
		} elseif ( is_404() ) {
			$title = esc_html__( '404', 'optime' );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results', 'optime' );
		} else {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
            if(class_exists('WooCommerce')){
                if (is_product()){
                    $title = optime_get_opt('product_page_title', '');
                    if ( ! $title ) {
                        $title = get_the_title();
                    }
                }
            }
		}
	} elseif ( is_author() ) {
		$title = esc_html__( 'Author:', 'optime' ) . ' ' . get_the_author();
	}
	else {
		$title = get_the_archive_title();
        if(class_exists('WooCommerce')) {
            if (is_shop()) {
                $shop_id = get_option('woocommerce_shop_page_id', '');
                $title = get_post_meta($shop_id, 'custom_title', true);
            }
        }
	}

	return array(
		'title' => $title,
	);
}

/**
 * Generates an excerpt from the post content with custom length.
 * Default length is 55 words, same as default the_excerpt()
 *
 * The excerpt words amount will be 55 words and if the amount is greater than
 * that, then the string '&hellip;' will be appended to the excerpt. If the string
 * is less than 55 words, then the content will be returned as it is.
 *
 * @param int $length Optional. Custom excerpt length, default to 55.
 * @param int|WP_Post $post Optional. You will need to provide post id or post object if used outside loops.
 *
 * @return string           The excerpt with custom length.
 */
function optime_get_the_excerpt( $length = 55, $post = null ) {
	$post = get_post( $post );
	if ( post_password_required( $post ) ) {
		return esc_html__( 'Post password required.', 'optime' );
	}

	$content = apply_filters( 'the_content', strip_shortcodes( $post->post_content ) );
	$excerpt_more = apply_filters( 'optime_excerpt_more', '&hellip;' );
	$excerpt      = wp_trim_words( $content, $length, '' );

	return $excerpt;
}


/**
 * Check if provided color string is valid color.
 * Only supports 'transparent', HEX, RGB, RGBA.
 *
 * @param  string $color
 *
 * @return boolean
 */
function optime_is_valid_color( $color ) {
	$color = preg_replace( "/\s+/m", '', $color );

	if ( $color === 'transparent' ) {
		return true;
	}

	if ( '' == $color ) {
		return false;
	}

	// Hex format
	if ( preg_match( "/(?:^#[a-fA-F0-9]{6}$)|(?:^#[a-fA-F0-9]{3}$)/", $color ) ) {
		return true;
	}

	// rgb or rgba format
	if ( preg_match( "/(?:^rgba\(\d+\,\d+\,\d+\,(?:\d*(?:\.\d+)?)\)$)|(?:^rgb\(\d+\,\d+\,\d+\)$)/", $color ) ) {
		preg_match_all( "/\d+\.*\d*/", $color, $matches );
		if ( empty( $matches ) || empty( $matches[0] ) ) {
			return false;
		}

		$red   = empty( $matches[0][0] ) ? $matches[0][0] : 0;
		$green = empty( $matches[0][1] ) ? $matches[0][1] : 0;
		$blue  = empty( $matches[0][2] ) ? $matches[0][2] : 0;
		$alpha = empty( $matches[0][3] ) ? $matches[0][3] : 1;

		if ( $red < 0 || $red > 255 || $green < 0 || $green > 255 || $blue < 0 || $blue > 255 || $alpha < 0 || $alpha > 1.0 ) {
			return false;
		}
	} else {
		return false;
	}

	return true;
}

/**
 * Minify css
 *
 * @param  string $css
 *
 * @return string
 */
function optime_css_minifier( $css ) {
	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );
	// Remove spaces before and after comment
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
	// Remove comment blocks, everything between /* and */, unless
	// preserved with /*! ... */ or /** ... */
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );
	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
	// Remove space before , ; { } ( ) >
	$css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );
	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
	// Converts all zeros value into short-hand
	$css = preg_replace( '/0 0 0 0/', '0', $css );
	// Shortern 6-character hex color codes to 3-character where possible
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );
}

/**
 * Header Tracking Code to wp_head hook.
 */
function optime_header_code() {
	$site_header_code = optime_get_opt( 'site_header_code' );
	if ( $site_header_code !== '' ) {
		print wp_kses( $site_header_code, wp_kses_allowed_html() );
	}
}

add_action( 'wp_head', 'optime_header_code' );

//Favicon
function optime_site_favicon(){

    $favicon = optime_get_opt( 'favicon' );

    if(!empty($favicon['url']))
        echo '<link rel="icon" type="image/png" href="'.esc_url($favicon['url']).'"/>';
}
add_action('wp_head', 'optime_site_favicon');

/**
 * Footer Tracking Code to wp_footer hook.
 */
function optime_footer_code() {
	$site_footer_code = optime_get_opt( 'site_footer_code' );
	if ( $site_footer_code !== '' ) {
		print wp_kses( $site_footer_code, wp_kses_allowed_html() );
	}
}

add_action( 'wp_footer', 'optime_footer_code' );


/**
 * Custom Comment List
 */
function optime_comment_list( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
	?>
    <<?php echo ''.$tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		    <div class="comment-inner clearfix">
		        <div class="comment-media">
					<?php if ( $args['avatar_size'] != 0 ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					} ?>
		        </div>
		        <div class="comment-content">
		            <h4 class="comment-title">
		            	<?php printf( '%s', get_comment_author_link() ); ?>
		            </h4>
                    <div class="comment-date">
                        <span><?php echo esc_html(get_comment_date()).' - ';?></span><span><?php echo esc_html(get_comment_time('h:i a')); ?></span>
                    </div>
		            <div class="comment-text"><?php comment_text(); ?></div>
                    <div class="comment-reply">
                        <?php comment_reply_link( array_merge( $args, array(
                            'add_below' => $add_below,
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth']
                        ) ) ); ?>
                    </div>
		        </div>
		    </div>
		<?php if ( 'div' != $args['style'] ) : ?>
        </div>
	<?php endif;
}

function optime_comment_reply_text( $link ) {
$link = str_replace( 'Reply', esc_html__('Reply', 'optime'), $link );
return $link;
}
add_filter( 'comment_reply_link', 'optime_comment_reply_text' );

/**
 * Save custom theme meta
 */
function optime_save_meta_boxes( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_subtitle'] ) ) {
		update_post_meta( $post_id, 'post_subtitle', $_POST['post_subtitle'] );
	}
}

add_action( 'save_post', 'optime_save_meta_boxes' );


add_filter( 'cms_extra_post_types', 'optime_add_posttype' );
function optime_add_posttype( $postypes ) {
	$portfolio_slug = optime_get_opt( 'portfolio_slug', 'portfolios' );
	$service_slug = optime_get_opt( 'service_slug', 'services' );
    $industry_slug = optime_get_opt( 'industry_slug', 'industries' );
	$postypes['portfolio'] = array(
        'status'     => true,
        'item_name'  => __('Case Studies', 'optime'),
        'items_name' => __('Case Studies', 'optime'),
        'args'       => array(
            'menu_icon'          => 'dashicons-portfolio',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'rewrite'             => array(
                'slug'       => $portfolio_slug
            ),
        ),
        'labels'     => array(
            'add_new_item' => 'Add new Case Study',
            'edit_item' => 'Edit Case Study'
        )

	);

    $postypes['service'] = array(
        'status'     => true,
        'item_name'  => esc_html__( 'Services', 'optime' ),
        'items_name' => esc_html__( 'Services', 'optime' ),
        'args'       => array(
            'menu_icon'          => 'dashicons-image-filter',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'rewrite'             => array(
                'slug'       => $service_slug,
            ),
        ),
        'labels'     => array(
            'add_new_item' => 'Add new Service',
            'edit_item' => 'Edit Service'
        )
    );
    $postypes['industry'] = array(
        'status'     => true,
        'item_name'  => __('Industries', 'optime'),
        'items_name' => __('Industries', 'optime'),
        'args'       => array(
            'menu_icon'          => 'dashicons-filter',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'rewrite'             => array(
                'slug'       => $industry_slug
            ),
        ),
        'labels'     => array(
            'add_new_item' => 'Add new Industry',
            'edit_item' => 'Edit Industry'
        )

    );
	return $postypes;
}

add_filter( 'cms_extra_taxonomies', 'optime_add_tax' );
function optime_add_tax( $taxonomies ) {
    $taxonomies['portfolio-category'] = array(
        'status'     => true,
        'post_type'  => array( 'portfolio' ),
        'taxonomy'   => esc_html__( 'Category', 'optime' ),
        'taxonomies' => esc_html__( 'Categories', 'optime' ),
        'args'       => array(),
        'labels'     => array()
    );
	$taxonomies['service-category']  = array(
		'status'     => true,
		'post_type'  => array( 'service' ),
		'taxonomy'   => esc_html__( 'Category', 'optime' ),
		'taxonomies' => esc_html__( 'Categories', 'optime' ),
		'args'       => array(),
		'labels'     => array()
	);

	return $taxonomies;
}

add_filter( 'cms_enable_megamenu', 'optime_enable_megamenu' );
function optime_enable_megamenu() {
	return true;
}
add_filter( 'cms_enable_onepage', 'optime_enable_onepage' );
function optime_enable_onepage() {
	return false;
}

/* Add default pagram Carousel */
function optime_get_param_carousel( $atts ) {
	$default  = array(
		'col_xs'           => '1',
		'col_sm'           => '2',
		'col_md'           => '3',
		'col_lg'           => '4',
		'margin'           => '30',
		'loop'             => 'false',
		'autoplay'         => 'false',
		'autoplay_timeout' => '5000',
		'smart_speed'      => '250',
		'center'           => 'false',
		'stage_padding'    => '0',
		'arrows'           => 'false',
		'bullets'          => 'false',
	);
	$new_data = array_merge( $default, $atts );
	extract( $new_data );
	$carousel      = array(
		'data-item-xs' => $col_xs,
		'data-item-sm' => $col_sm,
		'data-item-md' => $col_md,
		'data-item-lg' => $col_lg,

		'data-margin'          => $margin,
		'data-loop'            => $loop,
		'data-autoplay'        => $autoplay,
		'data-autoplaytimeout' => $autoplay_timeout,
		'data-smartspeed'      => $smart_speed,
		'data-center'          => $center,
		'data-arrows'          => $arrows,
		'data-bullets'         => $bullets,
		'data-stagepadding'    => $stage_padding,
		'data-rtl'             => is_rtl() ? 'true' : 'false',
	);
	$carousel_data = '';
	foreach ( $carousel as $key => $value ) {
		if ( isset( $value ) ) {
			$carousel_data .= $key . '=' . $value . ' ';
		}
	}
	$new_data['carousel_data'] = $carousel_data;

	return $new_data;
}

function optime_add_vc_extra_param( $old_param, $dependency = array()) {
	$extra_param         = array(
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Columns XS (< 767px)", 'optime' ),
			"param_name"       => "col_xs",
			"edit_field_class" => "vc_col-sm-3",
			"value"            => array( 1, 2, 3, 4 ),
			"std"              => 1,
			"group"            => 'Carousel Settings',
            "dependency"       => $dependency,
		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Columns SM (< 991px)", 'optime' ),
			"param_name"       => "col_sm",
			"edit_field_class" => "vc_col-sm-3",
			"value"            => array( 1, 2, 3, 4 ),
			"std"              => 2,
			"group"            => 'Carousel Settings',
            "dependency"       => $dependency,
		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Columns MD (< 1199px)", 'optime' ),
			"param_name"       => "col_md",
			"edit_field_class" => "vc_col-sm-3",
			"value"            => array( 1, 2, 3, 4 ),
			"std"              => 3,
			"group"            => 'Carousel Settings',
            "dependency"       => $dependency,
		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Columns LG (> 1200px)", 'optime' ),
			"param_name"       => "col_lg",
			"edit_field_class" => "vc_col-sm-3",
			"value"            => array( 1, 2, 3, 4, 5, 6 ),
			"std"              => 4,
			"group"            => 'Carousel Settings',
            "dependency"       => $dependency,
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Margin Items', 'optime' ),
			'param_name'  => 'margin',
			'value'       => '',
			'group'       => 'Carousel Settings',
			'description' => 'Enter number: ...( Default 30 )',
            "dependency"       => $dependency,
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Loop Items", 'optime' ),
			"param_name" => "loop",
			"value"      => array(
				"No"  => "false",
				"Yes" => "true",
			),
			"group"      => 'Carousel Settings',
            "dependency"       => $dependency,
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Autoplay", 'optime' ),
			"param_name" => "autoplay",
			"value"      => array(
				"No"  => "false",
				"Yes" => "true",
			),
			"group"      => 'Carousel Settings',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Autoplay Timeout', 'optime' ),
			'param_name'  => 'autoplay_timeout',
			'value'       => '',
			'group'       => 'Carousel Settings',
			'description' => 'Enter number: ...( Default 5000 )',
			'dependency'  => array(
				'element' => 'autoplay',
				'value'   => 'true',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Smart Speed', 'optime' ),
			'param_name'  => 'smart_speed',
			'value'       => '',
			'group'       => 'Carousel Settings',
			'description' => 'Enter number: ...( Default 250 )',
			'dependency'  => array(
				'element' => 'autoplay',
				'value'   => 'true',
			),
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Center", 'optime' ),
			"param_name" => "center",
			"value"      => array(
				"No"  => "false",
				"Yes" => "true",
			),
			"group"      => 'Carousel Settings',
            "dependency"       => $dependency,
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Stage Padding', 'optime' ),
			'param_name'  => 'stage_padding',
			'value'       => '',
			'group'       => 'Carousel Settings',
			'description' => 'Enter number: ...( Default 0 )',
			'dependency'  => array(
				'element' => 'center',
				'value'   => 'true',
			),
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Show Arrows", 'optime' ),
			"param_name" => "arrows",
			"value"      => array(
				"No"  => "false",
				"Yes" => "true",
			),
			"group"      => 'Carousel Settings',
            "dependency"       => $dependency,
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Show Bullets", 'optime' ),
			"param_name" => "bullets",
			"value"      => array(
				"No"  => "false",
				"Yes" => "true",
			),
			"group"      => 'Carousel Settings',
            "dependency"       => $dependency,
		),
	);
	$old_param['params'] = array_merge( $old_param['params'], $extra_param );

	return $old_param;
}

/*
 * Set post views count using post meta
 */
function optime_set_post_views( $postID ) {
	$countKey = 'post_views_count';
	$count    = get_post_meta( $postID, $countKey, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $countKey );
		add_post_meta( $postID, $countKey, '0' );
	} else {
		$count ++;
		update_post_meta( $postID, $countKey, $count );
	}
}

function optime_get_list_post_by_posttype($post_type = 'post'){
    $results = get_posts(array('post_type' => $post_type, 'post_status' => 'publish','posts_per_page' => -1));
    $list_post = array();
    foreach ($results as $key => $value){
        $list_post[$value->ID] = $value->post_title;
    }
    return $list_post;
}

// remove <br> in contact form7
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/* Create Demo Data */
add_filter('swa_ie_export_mode', 'optime_enable_export_mode');
function optime_enable_export_mode()
{
    return defined('DEV_MODE') && DEV_MODE == true;
}
/* Dashboard Theme */
add_filter('cms_documentation_link',function(){
     return 'http://doc.farost.net/optime/';
});

add_filter('cms_ticket_link', 'optime_add_cms_ticket_link');
function optime_add_cms_ticket_link($url)
{
    $url = array('type' => 'url', 'link' => 'mailto:farost.agency@gmail.com');
    return $url;
}
add_filter('cms_video_tutorial_link',function(){
     return 'https://www.youtube.com/channel/UCymMdxOyAEsemLQYs_oBIiA';
});
add_filter('swa_post_types', 'function_swa_post_types');
function function_swa_post_types($post_type)
{
    $post_type[] = 'portfolio';
    $post_type[] = 'service';
    $post_type[] = 'industry';
    $post_type[] = 'cms-mega-menu';
    return $post_type;
}