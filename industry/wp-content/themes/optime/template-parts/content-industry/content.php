<?php
/**
 * Template part for displaying posts in loop
 *
 * @package optime
 */
$sidebar_pos = '';
$show_sidebar_page = optime_get_page_opt( 'show_sidebar_industry', true );
if ($show_sidebar_page){
    $sidebar_pos = optime_get_opt( 'industry_sidebar_pos' );
}
?>
<div class="container content-container">
    <div class="row content-row">
        <div id="primary" <?php optime_primary_class( $sidebar_pos, 'content-area' ); ?>>
            <main id="main" class="site-main">
                <div class="post-type-inner">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="post-type-industry">
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php if ( 'left' == $sidebar_pos || 'right' == $sidebar_pos ) : ?>
            <aside id="secondary" <?php optime_secondary_class( $sidebar_pos, 'widget-area' ); ?>>
                <?php get_sidebar(); ?>
            </aside>
        <?php endif; ?>
    </div>
</div>