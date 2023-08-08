<?php
/**
 * Custom template tags for this theme.
 *
 * @package Optime
 */

/**
 * Header search popup
 **/
function optime_search_popup()
{
    $search_on = optime_get_opt( 'search_on', true );
    if($search_on) : ?>
    <div class="cms-modal cms-modal-search-form ">
        <div class="cms-close-search">
            <i class="fa fa-close"></i>
        </div>
            <div class="cms-modal-inner">
             <div class="cms-modal-content">
                <form role="search" method="get" class="cms-search-form placeholder-white" action="<?php echo esc_url(home_url( '/' )); ?>">
                    <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                    <input type="text" id="searchFocus" placeholder="<?php esc_attr_e('Type Words Then Enter', 'optime'); ?>" name="s" class="search-field" />
                </form>
            </div>
        </div>
    </div>
<?php endif; }

/**
 * Header layout
 **/
function optime_page_loading()
{
    $page_loading = optime_get_opt( 'show_page_loading', false );

    if($page_loading) { ?>
        <div id="cms-loadding" class="cms-loader">
            <div class="loading-center-absolute">
                <div class="lds-ring">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    <?php }
}

/**
 * Header layout
 **/
function optime_header_layout()
{
    $header_layout = optime_get_opt( 'header_layout', '1' );
    $custom_header = optime_get_page_opt( 'custom_header', '0' );

    if ( is_page() && $custom_header == '1' )
    {
        $page_header_layout = optime_get_page_opt('header_layout');
        $header_layout = $page_header_layout;
        if($header_layout == '0') {
            return;
        }
    }

    get_template_part( 'template-parts/header-layout', $header_layout );
}


/**
 * Page title layout
 **/
function optime_page_title_layout()
{

    $ptitle_layout = optime_get_opt( 'ptitle_layout', '1' );
    $ptitle_old_layout = $ptitle_layout;
    $custom_pagetitle = optime_get_page_opt( 'custom_pagetitle', '0' );
    if ( $custom_pagetitle == '1' )
    {
        $page_ptitle_layout = optime_get_page_opt('ptitle_layout');
        $ptitle_layout = $page_ptitle_layout;
    }
    if($ptitle_layout == '0') {
        if(is_search()) {
            get_template_part( 'template-parts/page-title',$ptitle_old_layout);
        }
        return;
    }
    get_template_part( 'template-parts/page-title', $ptitle_layout );
}

/**
 * Page title layout
 **/
function optime_footer()
{
    $footer_layout = optime_get_opt( 'footer_layout', '1' );
    $custom_footer = optime_get_page_opt( 'custom_footer', '0' );

    if ( is_page() && $custom_footer == '1' )
    {
        $page_footer_layout = optime_get_page_opt('footer_layout');
        $footer_layout = $page_footer_layout;
    }
    if($footer_layout == '0') {
        return;
    }
    get_template_part( 'template-parts/footer-layout', $footer_layout );
}

/**
 * Set primary content class based on sidebar position
 * 
 * @param  string $sidebar_pos
 * @param  string $extra_class
 */
function optime_primary_class( $sidebar_pos, $extra_class = '' )
{
    if ( class_exists( 'WooCommerce' ) && ( is_product_category() || is_product() || is_shop() ) ) :
        $sidebar_load = 'sidebar-shop';
    elseif (is_page()) :
        $sidebar_load = 'sidebar-page';
    elseif (is_singular('portfolio') || is_singular('industry')) :
        $sidebar_load = 'sidebar-portfolio';
    elseif (is_singular('service')) :
        $sidebar_load = 'sidebar-portfolio';
    else :
        $sidebar_load = 'sidebar-service';
    endif;

    if ( is_active_sidebar( $sidebar_load ) ) {
        $class = array( trim( $extra_class ) );
        switch ( $sidebar_pos )
        {
            case 'left':
                if ($sidebar_load == 'sidebar-shop'):$class[] = 'content-has-sidebar float-right col-xl-9 col-lg-9 col-md-12'; else: $class[] = 'content-has-sidebar float-right col-xl-8 col-lg-8 col-md-12';endif;
                break;
            case 'right':
                if ($sidebar_load == 'sidebar-shop'): $class[] = 'content-has-sidebar float-left col-xl-9 col-lg-9 col-md-12'; else: $class[] = 'content-has-sidebar float-left col-xl-8 col-lg-8 col-md-12'; endif;
                break;

            default:
                $class[] = 'content-full-width col-12';
                break;
        }

        $class = implode( ' ', array_filter( $class ) );

        if ( $class )
        {
            echo ' class="' . esc_html($class) . '"';
        }
    } else {
        echo ' class="content-area col-12"';
    }
}

/**
 * Set secondary content class based on sidebar position
 * 
 * @param  string $sidebar_pos
 * @param  string $extra_class
 */
function optime_secondary_class( $sidebar_pos, $extra_class = '' )
{
    if ( class_exists( 'WooCommerce' ) && ( is_product_category() || is_product() || is_shop() ) ) :
        $sidebar_load = 'sidebar-shop';
    elseif (is_page()) :
        $sidebar_load = 'sidebar-page';
    elseif (is_singular('portfolio') || is_singular('industry')) :
        $sidebar_load = 'sidebar-portfolio';
    elseif (is_singular('service')) :
        $sidebar_load = 'sidebar-portfolio';
    else :
        $sidebar_load = 'sidebar-service';
    endif;

    if ( is_active_sidebar( $sidebar_load ) ) {
        $class = array(trim($extra_class));
        switch ($sidebar_pos) {
            case 'left':
                if ($sidebar_load == 'sidebar-shop'): $class[] = 'widget-has-sidebar col-xl-3 col-lg-3 col-md-12'; else: $class[] = 'widget-has-sidebar col-xl-4 col-lg-4 col-md-12'; endif;
                break;

            case 'right':
                if ($sidebar_load == 'sidebar-shop'): $class[] = 'widget-has-sidebar col-xl-3 col-lg-3 col-md-12'; else: $class[] = 'widget-has-sidebar col-xl-4 col-lg-4 col-md-12'; endif;
                break;

            default:
                break;
        }

        $class = implode(' ', array_filter($class));

        if ($class) {
            echo ' class="' . esc_html($class) . '"';
        }
    }
}


/**
 * Prints HTML for breadcrumbs.
 */
function optime_breadcrumb()
{
    if ( ! class_exists( 'CMS_Breadcrumb' ) )
    {
        return;
    }

    $breadcrumb = new CMS_Breadcrumb();
    $entries = $breadcrumb->get_entries();

    if ( empty( $entries ) )
    {
        return;
    }

    ob_start();

    foreach ( $entries as $entry )
    {
        $entry = wp_parse_args( $entry, array(
            'label' => '',
            'url'   => ''
        ) );

        if ( empty( $entry['label'] ) )
        {
            continue;
        }

        echo '<li>';

        if ( ! empty( $entry['url'] ) )
        {
            printf(
                '<a class="breadcrumb-entry" href="%1$s">%2$s</a>',
                esc_url( $entry['url'] ),
                esc_attr( $entry['label'] )
            );
        }
        else
        {
            printf( '<span class="breadcrumb-entry" >%s</span>', esc_html( $entry['label'] ) );
        }

        echo '</li>';
    }

    $output = ob_get_clean();

    if ( $output )
    {
        printf( '<ul class="cms-breadcrumb">%s</ul>', wp_kses_post($output));
    }
}


function optime_entry_link_pages()
{
    wp_link_pages( array(
        'before' => sprintf( '<div class="page-links">', esc_html__( 'Pages:', 'optime' ) ),
        'after'  => '</div>',
    ) );
}


if ( ! function_exists( 'optime_entry_excerpt' ) ) :
    /**
     * Print post excerpt based on length.
     *
     * @param  integer $length
     */
    function optime_entry_excerpt( $length = 47 )
    {
        $cms_the_excerpt = get_the_excerpt();
        if(!empty($cms_the_excerpt)) {
            echo esc_html($cms_the_excerpt);
        } else {
            echo wp_kses_post(optime_get_the_excerpt( $length ));
        }
    }
endif;

/**
 * Prints post edit link when applicable
 */
function optime_entry_edit_link()
{
    edit_post_link(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                esc_html__( 'Edit', 'optime' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ),
        '<div class="entry-edit-link"><i class="fa fa-edit"></i>',
        '</div>'
    );
}


/**
 * Prints posts pagination based on query
 *
 * @param  WP_Query $query     Custom query, if left blank, this will use global query ( current query )
 * @return void
 */
function optime_posts_pagination( $query = null )
{
    $classes = array();

    if ( empty( $query ) )
    {
        $query = $GLOBALS['wp_query'];
    }

    if ( empty( $query->max_num_pages ) || ! is_numeric( $query->max_num_pages ) || $query->max_num_pages < 2 )
    {
        return;
    }

    $paged = get_query_var( 'paged' );

    if ( ! $paged && is_front_page() && ! is_home() )
    {
        $paged = get_query_var( 'page' );
    }

    $paged = $paged ? intval( $paged ) : 1;

    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) )
    {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $html_prev = '<i class="zmdi zmdi-arrow-left"></i>';
    $html_next = '<i class="zmdi zmdi-arrow-right"></i>';
    // Set up paginated links.
    $links = paginate_links( array(
        'base'     => $pagenum_link,
        'total'    => $query->max_num_pages,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => $html_prev,
        'next_text' => $html_next,
    ) );

    $template = '
    <nav class="navigation posts-pagination">
        <div class="posts-page-links">%2$s</div>
    </nav>';

    if ( $links )
    {
        printf(
            wp_kses_post($template),
            esc_html__( 'Navigation', 'optime' ),
            wp_kses_post($links)
        );
    }
}

/**
 * Prints archive and post meta
 */
if ( ! function_exists( 'optime_archive_post_meta' ) ) :
    function optime_archive_post_meta()
    {
        $archive_author_on = optime_get_opt('archive_author_on', true);
        $archive_date_on = optime_get_opt('archive_date_on', true);
        $archive_tags_on = optime_get_opt('archive_tags_on', true);
        $archive_category_on = optime_get_opt('archive_categories_on', true);
        $archive_sticky_on = optime_get_opt('archive_sticky_on', true);
        $archive_comments_on = optime_get_opt('archive_comments_on', true);
        if (is_single()) {
            $archive_author_on = optime_get_opt('post_author_on', true);
            $archive_date_on = optime_get_opt('post_date_on', true);
            $archive_tags_on = optime_get_opt('post_tags_on', true);
            $archive_category_on = optime_get_opt('post_categories_on', true);
            $archive_sticky_on = optime_get_opt('post_sticky_on', true);
            $archive_comments_on = optime_get_opt('post_comments_on', true);
        }
        if ($archive_author_on || $archive_comments_on || $archive_tags_on || $archive_date_on) { ?>
            <div class="post-meta">
                <div class="post-meta-inner">
                    <?php if($archive_category_on && get_the_category()){ ?>
                        <div class="meta-categories">
                            <?php  the_category(', '); ?>
                        </div>
                    <?php } ?>
                    <ul class="entry-meta">
                        <?php if($archive_tags_on && get_the_tags()){ ?>
                            <li>
                                <?php  the_tags('',', ',''); ?>
                            </li>
                        <?php } ?>
                        <?php if ($archive_author_on) : ?>
                            <li>
                                <span><?php echo esc_html__('By', 'optime').':'; ?></span>
                                <?php the_author_posts_link(); ?>
                            </li>
                        <?php endif; ?>
                        <?php if ($archive_date_on) { ?>
                            <li>
                                <?php echo get_the_date(); ?>
                            </li>
                        <?php } ?>
                        <?php if ($archive_comments_on) : ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"><?php echo comments_number(esc_html__('0 Comments', 'optime'), esc_html__('1 Comment', 'optime'), esc_html__('% Comments', 'optime')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="data">
                    <?php if(!is_singular('post')){?>
                        <h3 class="entry-title">
                            <?php if (!is_single()){ ?>
                                <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark">
                                    <?php if (is_sticky() && $archive_sticky_on) { ?>
                                        <i class="fa fa-thumb-tack"></i>
                                    <?php } ?><?php the_title(); ?>
                                </a>
                            <?php }else{ ?>
                                <?php the_title(); ?>
                            <?php }?>
                        </h3>
                    <?php } ?>
                </div>
                <?php //} ?>
            </div>
            <?php
        }
    }
endif;
/**
 * Prints tag list
 */
if ( ! function_exists( 'optime_entry_tagged_in' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function optime_entry_tagged_in()
    {
        $tags_list = get_the_tag_list( '', '' );
        if ( $tags_list )
        {
            echo '<div class="entry-tags">';
            printf('%2$s', '', $tags_list);
            echo '</div>';
        }
    }
endif;

/**
 * Prints category list
 */
if ( ! function_exists( 'optime_entry_category_in' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function optime_entry_category_in($postID)
    {
        if(get_the_terms($postID,'category')){?>
            <div class="entry-cats">
                <label><?php echo esc_html__('CATEGORIES:', 'optime');?></label>
                <?php the_terms( $postID, 'category', '', ', ' ); ?>
            </div>
        <?php }
    }
endif;

/**
 * List socials share for post.
 */
function optime_socials_share_default() { ?>
    <ul>
        <li><a class="fb-social" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a class="tw-social" title="Twitter" target="_blank" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a class="g-social" title="Google Plus" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
        <li><a class="pin-social" title="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_post_thumbnail_url('full'); ?>&media=&description=<?php echo urlencode(the_title_attribute('echo=0')); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
    </ul>
    <?php
}


/**
 * Footer Top
 */
function optime_footer_top() {
    $footer_top_column = optime_get_opt( 'footer_top_column' );
    if(empty($footer_top_column))
        return;

    $_class = "";
    $first_class = 'col-xl-4 col-lg-4 col-md-4';
    switch ($footer_top_column){
        case '3':
            $_class = 'col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12';
            break;
        case '4':
            $_class = 'col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12';
            $first_class = 'col-xl-3 col-lg-3 col-md-12';
            break;
        case '5':
            $_class = 'col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12';
            break;
    }
    ?>
    <div class="<?php echo esc_attr($first_class);?>">
        <?php
        // Footer top left is sidebar-footer-1
        if ( is_active_sidebar( 'sidebar-footer-1' ) ){
            echo '<div class="cms-footer-item">';
            dynamic_sidebar( 'sidebar-footer-1');
            echo "</div>";
        }
        ?>
    </div>

    <?php
    // Footer top right start by sidebar-footer-2
    for($i = 2 ; $i <= $footer_top_column ; $i++){
        ?> <div class="<?php echo esc_attr($_class);?>"><?php
        if ( is_active_sidebar( 'sidebar-footer-' . $i ) ){
            echo '<div class="cms-footer-item">';
            dynamic_sidebar( 'sidebar-footer-' . $i );
            echo "</div>";
        }
        ?> </div><?php
    }
    ?>
    <?php
}

function optime_footer_bottom() {
    $footer_top_column = optime_get_opt( 'footer_top_column' );
    if(empty($footer_top_column))
        return;
    if ( is_active_sidebar( 'sidebar-footer-bottom' ) ){
        dynamic_sidebar( 'sidebar-footer-bottom' );
    }
}

/**
* Display navigation to next/previous post when applicable.
*/
function optime_post_nav_default() {
    global $post;
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <?php
    $next_post = get_next_post();
    $previous_post = get_previous_post();
    if( !empty($next_post) || !empty($previous_post) ) { ?>
        <div class="post-previous-next default">
            <div class="nav-links row clearfix">
                <div class="line-gap"></div>
                    <div class="nav-link-prev grid-item col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <?php if ( is_a( $previous_post , 'WP_Post' ) && get_the_title( $previous_post->ID ) != '') {
                        $url_prev = wp_get_attachment_image_src(get_post_thumbnail_id($previous_post->ID), 'thumbnail', false);
                        $image_alt = get_post_meta(get_post_thumbnail_id($previous_post->ID), '_wp_attachment_image_alt', true);
                        if (empty($image_alt)){
                            $image_alt = get_the_title( $previous_post->ID );
                        }
                        ?>
                        <div class="grid-item-inner">
                            <?php if (!empty($url_prev[0])){?>
                                <div class="item-featured">
                                    <a href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>" class="image-link">
                                        <img src="<?php echo esc_url($url_prev[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
                                        <div class="nav-arrow"><i class="zmdi zmdi-arrow-left"></i></div>
                                    </a>
                                </div>
                            <?php } ?>
                            <div class="item-holder">
                                <span><?php esc_html_e('Previous', 'optime') ?></span>
                                <h4 class="item-title">
                                    <a href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>"><?php echo get_the_title( $previous_post->ID ); ?></a>
                                </h4>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="nav-link-next grid-item col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <?php if ( is_a( $next_post , 'WP_Post' ) && get_the_title( $next_post->ID ) != '') {
                        $url_next = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), 'thumbnail', false);
                        $image_alt = get_post_meta(get_post_thumbnail_id($next_post->ID), '_wp_attachment_image_alt', true);
                        if (empty($image_alt)){
                            $image_alt = get_the_title( $next_post->ID );
                        }
                        ?>
                        <div class="grid-item-inner">
                            <div class="item-holder">
                                <span><?php esc_html_e('Next', 'optime') ?></span>
                                <h4 class="item-title">
                                    <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><?php echo get_the_title( $next_post->ID ); ?></a>
                                </h4>
                            </div>
                            <?php if (!empty($url_next[0])){?>
                                <div class="item-featured">
                                    <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>" class="image-link">
                                        <img src="<?php echo esc_url($url_next[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
                                        <div class="nav-arrow"><i class="zmdi zmdi-arrow-right"></i></div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
            </div><!-- .nav-links -->
        </div>
    <?php }
}

/**
 * Social Footer
 */
function optime_social_media() {
    $social_media = optime_get_opt( 'social_media' );
    $social = $social_media['enabled'];
    if ($social) : foreach ($social as $key=>$value) { ?>
        <?php switch($key) {

            case 'facebook': echo '<a title="Facebook" href="'.esc_url(optime_get_opt( 'social_facebook_url' )).'"><i class="zmdi zmdi-facebook"></i></a>';
                break;

            case 'twitter': echo '<a title="Twitter" href="'.esc_url(optime_get_opt( 'social_twitter_url' )).'"><i class="zmdi zmdi-twitter"></i></a>';
                break;

            case 'linkedin': echo '<a title="Linkedin" href="'.esc_url(optime_get_opt( 'social_inkedin_url' )).'"><i class="zmdi zmdi-linkedin"></i></a>';
                break;

            case 'rss': echo '<a title="Rss" href="'.esc_url(optime_get_opt( 'social_rss_url' )).'"><i class="zmdi zmdi-rss"></i></i></a>';
                break;

            case 'instagram': echo '<a title="Instagram" href="'.esc_url(optime_get_opt( 'social_instagram_url' )).'"><i class="zmdi zmdi-instagram"></i></a>';
                break;

            case 'google': echo '<a title="Google+" href="'.esc_url(optime_get_opt( 'social_google_url' )).'"><i class="zmdi zmdi-google-plus"></i></a>';
                break;

            case 'skype': echo '<a title="Skype" href="'.esc_url(optime_get_opt( 'social_skype_url' )).'"><i class="zmdi zmdi-skype"></i></a>';
                break;

            case 'pinterest': echo '<a title="Pinterest" href="'.esc_url(optime_get_opt( 'social_pinterest_url' )).'"><i class="zmdi zmdi-pinterest"></i></a>';
                break;

            case 'vimeo': echo '<a title="Vimeo" href="'.esc_url(optime_get_opt( 'social_vimeo_url' )).'"><i class="zmdi zmdi-vimeo"></i></a>';
                break;

            case 'youtube': echo '<a title="Youtube" href="'.esc_url(optime_get_opt( 'social_youtube_url' )).'"><i class="zmdi zmdi-youtube"></i></a>';
                break;

            case 'yelp': echo '<a title="Yelp" href="'.esc_url(optime_get_opt( 'social_yelp_url' )).'"><i class="fa fa-yelp"></i></a>';
                break;

            case 'tumblr': echo '<a title="Tumblr" href="'.esc_url(optime_get_opt( 'social_tumblr_url' )).'"><i class="fa fa-tumblr"></i></a>';
                break;

            case 'tripadvisor': echo '<a title="Tripadvisor" href="'.esc_url(optime_get_opt( 'social_tripadvisor_url' )).'"><i class="fa fa-tripadvisor"></i></a>';
                break;

        }
    }
    endif;
}
function optime_contact_form() {
    $h_btn_link_type = optime_get_opt('h_btn_link_type', 'page_link');
    $popup_contact_form = optime_get_opt('popup_contact_form');
    $title_contact_form = optime_get_opt('title_contact_form');
    if(class_exists('WPCF7') && $h_btn_link_type == 'contact_form' && !empty($popup_contact_form)) { ?>
    <div class="cms-modal cms-modal-contact-form">
        <div class="cms-close-search">
            <i class="fa fa-close"></i>
        </div>
        <div class="cms-modal-inner">
            <div class="cms-contact-form placeholder-dark cms-contact-form-flat style-primary">
                <?php
                if (!empty($title_contact_form)){
                    ?><h3 class="el-title"><?php echo esc_html($title_contact_form);?></h3><?php
                }else{
                    ?><h3 class="el-title"><?php echo esc_html__('Request a Free Quote', 'optime');?></h3><?php
                }
                echo do_shortcode('[contact-form-7 id="'.esc_attr( $popup_contact_form ).'"]');
                ?>
            </div>
        </div>
    </div>
<?php }
}

function optime_parallax_scroll() {
    $parallaxscroll = optime_get_opt( 'parallaxscroll', false );
    $parallaxscroll_speed = optime_get_opt( 'parallaxscroll_speed', '4' );
    $data_parallax = '';
    if($parallaxscroll == true) {
        $data_parallax = 'data-speed='.$parallaxscroll_speed.'';
        echo esc_html( $data_parallax );
    }
    return $data_parallax;
}

/**
 * Related Post
 */
function optime_related_post()
{
    global $post;
    $current_id = $post->ID;
    $posttags = get_the_category($post->ID);
    if (empty($posttags)) return;

    $tags = array();

    foreach ($posttags as $tag) {

        $tags[] = $tag->term_id;
    }
    $post_number = '4';
    $item_class = 'col-xl-4 col-lg-4 col-md-12';
    $post_sidebar_pos = optime_get_opt( 'post_sidebar_pos', 'none' );
    if($post_sidebar_pos == 'left' || $post_sidebar_pos == 'right') {
        $post_number = '3';
        $item_class = 'col-xl-6 col-lg-6 col-md-12';
    }
    $query_similar = new WP_Query(array('posts_per_page' => $post_number, 'post_type' => 'post', 'post_status' => 'publish', 'category__in' => $tags));
    if (count($query_similar->posts) > 1) {
        ?>
        <div class="cms-related-post cms-grid-blog-layout5 clearfix">
            <h3 class="section-title"><?php echo esc_html__('More News', 'optime'); ?></h3>
            <div class="cms-related-post-inner row">
                <?php foreach ($query_similar->posts as $post):
                    $thumbnail_url = '';
                    if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) :
                        $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
                    endif;
                    if ($post->ID !== $current_id) : ?>
                        <div class="grid-item <?php echo esc_attr($item_class); ?>">
                            <div class="grid-item-inner">
                                <div class="item-featured">
                                    <a href="<?php the_permalink(); ?>" class="bg-overlay" style="background-image: url(<?php echo esc_url($thumbnail_url[0]); ?>);"></a>
                                </div>
                                <div class="item-holder">
                                    <h3 class="item-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="item-date ft-heading-b">
                                        <?php $date_formart = get_option('date_format'); echo get_the_date($date_formart, $post->ID); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
        </div>
    <?php }

    wp_reset_postdata();
}