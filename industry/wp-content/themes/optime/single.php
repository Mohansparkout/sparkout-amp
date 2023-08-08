<?php
/**
 * The template for displaying all single posts
 *
 * @package Optime
 */

get_header();

if ( is_singular('product')  ) :
    $sidebar_pos = optime_get_opt( 'sidebar_shop', 'left' );
else :
    $sidebar_pos = optime_get_opt( 'post_sidebar_pos', 'left' );
endif;
$page_for_posts = get_option( 'page_for_posts' );
$post_comment_on = optime_get_opt('post_comment_on',true);
$post_navigation_link_on = optime_get_opt( 'post_navigation_link_on', true );
$post_navigation_link_on_industrial = optime_get_opt( 'post_navigation_link_on_industrial', true );
$post_related_on_con_general = optime_get_opt( 'post_related_on_con_general', true );
?>
<div class="container content-container">
    <div class="row content-row">
        <div id="primary" <?php optime_primary_class( $sidebar_pos, 'content-area' ); ?>>
            <main id="main" class="site-main">
                <?php

                    while ( have_posts() )
                    {
                        the_post();
                        get_template_part( 'template-parts/content-single/content');
                        if ( comments_open() || get_comments_number() && $post_comment_on) {
                            comments_template();
                        }
                    }
                ?>
            </main><!-- #main -->
        </div><!-- #primary -->

        <?php if ( 'left' == $sidebar_pos || 'right' == $sidebar_pos ) : ?>
        <aside id="secondary" <?php optime_secondary_class( $sidebar_pos, 'widget-area' ); ?>>
            <?php get_sidebar(); ?>
        </aside>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
