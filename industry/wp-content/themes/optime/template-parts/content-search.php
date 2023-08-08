<?php
/**
 * Template part for displaying results in search pages
 *
 * @package Optime
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-hentry' ); ?>>

    <div class="entry-featured">
        <?php
            if (has_post_thumbnail()) {
                echo '<div class="post-image trim-hover">'; ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('large'); ?></a>
                <?php echo '</div>';
            }
        ?>
    </div><!-- .entry-featured -->
    <div class="entry-holder">
        <?php optime_archive_post_meta(); ?>
        <div class="entry-content">
            <?php
                optime_entry_excerpt();
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'optime' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>
        </div>
        <div class="item-readmore">
            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html__('Read More', 'optime'); ?><i class="zmdi zmdi-long-arrow-right"></i></a>
        </div>
    </div>
</article><!-- #post -->