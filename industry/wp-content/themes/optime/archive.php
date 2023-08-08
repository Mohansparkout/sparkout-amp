<?php
/**
 * The template for displaying archive pages
 *
 * @package Optime
 */

get_header();
$sidebar_pos = optime_get_opt( 'archive_sidebar_pos', 'left' );
?>
<div class="container content-container">
    <div class="row content-row">
        <div id="primary" <?php optime_primary_class( $sidebar_pos, 'content-area' ); ?>>
            <main id="main" class="site-main">
            <?php

                if ( have_posts() )
                {
                    while ( have_posts() )
                    {
                        the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called loop-post-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content' );
                    }

                    optime_posts_pagination();
                }
                else
                {
                    get_template_part( 'template-parts/content', 'none' );
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
