<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Optime
 */

$post_author_on = optime_get_opt('post_author_on', true);
$post_date_on = optime_get_opt('post_date_on', true);
$post_tags_on = optime_get_opt( 'post_tags_on', true );
$post_categories_on = optime_get_opt( 'post_categories_on', true );
$post_sticky_on = optime_get_opt('post_sticky_on', true);
$post_title_on = optime_get_opt('post_title_on', false);
$post_comments_on = optime_get_opt('post_comments_on', true);
$social_share_on = optime_get_opt( 'social_share_on', false );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-hentry'); ?>>
    <div class="entry-featured">
        <?php if (has_post_format('gallery')) : ?>
            <?php
            $light_box = optime_get_post_format_value('post-gallery-lightbox', '0');
            $gallery_list = explode(',', optime_get_post_format_value('post-gallery-images', ''));
            wp_enqueue_script( 'owl-carousel' );
            wp_enqueue_script( 'optime-carousel' );
            ?>
            <div class="cms-carousel owl-carousel featured-active <?php if($light_box) {echo 'images-light-box';} ?>" data-item-xs="1" data-item-sm="1" data-item-md="1" data-item-lg="1" data-margin="30" data-loop="true" data-autoplay="true" data-autoplaytimeout="5000" data-smartspeed="250" data-center="false" data-arrows="true" data-bullets="false" data-stagepadding="0" data-stagepaddingsm="0" data-rtl="false">
                <?php
                foreach ($gallery_list as $img_id):
                    ?>
                    <div class="cms-carousel-item">
                        <a class="light-box" href="<?php echo esc_url(wp_get_attachment_image_url($img_id, 'full'));?>"><img src="<?php echo esc_url(wp_get_attachment_image_url($img_id, 'large'));?>" alt="<?php echo esc_attr(get_post_meta( $img_id, '_wp_attachment_image_alt', true )) ?>"></a>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        <?php elseif (has_post_format('quote')) : ?>
            <?php
            $quote_text = optime_get_post_format_value('post-quote-cite', '');
            echo esc_attr($quote_text);
            ?>
        <?php elseif (has_post_format('link')) : ?>
            <?php
            $link_pf = optime_get_post_format_value('post-link-url', '#');
            echo esc_url($link_pf);
            ?>
        <?php elseif (has_post_format('video')) : ?>
            <div class="entry-video featured-active">
                <?php
                $video_url = optime_get_post_format_value('post-video-url', '#');
                $video_file = optime_get_post_format_value('post-video-file', '');
                $video_html = optime_get_post_format_value('post-video-html', '');
                $video = '';
                if (!empty($video_url)) {
                    global $wp_embed;
                    echo esc_html($wp_embed->run_shortcode('[embed]' . $video_url . '[/embed]'));
                } elseif (!empty($video_file)) {
                    if (strpos('[embed', $video_file)) {
                        global $wp_embed;
                        echo esc_html($wp_embed->run_shortcode($video_file));
                    } else {
                        echo do_shortcode($video_file);
                    }
                } else {
                    if ('' != $video_html) {
                        echo esc_html($video_html);
                    }
                }
                ?>
            </div>
            <?php elseif (has_post_format('audio')) : ?>
                <?php
                $audio_url = optime_get_post_format_value('post-audio-url', '#');
                echo esc_url($audio_url);
                ?>
            <?php else : ?>
            <?php
            if (has_post_thumbnail()) {
                echo '<div class="post-image trim-hover">'; ?>
                <?php the_post_thumbnail('full'); ?>
                <?php echo '</div>';
            }
            ?>
        <?php endif; ?>
    </div><!-- .entry-featured -->
    <div class="entry-hoder">
        <div class="post-meta">
            <div class="post-meta-inner">
                <?php if($post_categories_on && get_the_category()){ ?>
                    <div class="meta-categories">
                        <?php  the_category(', '); ?>
                    </div>
                <?php } ?>
                <ul class="entry-meta">
                    <?php if ($post_author_on) : ?>
                        <li>
                            <span><?php echo esc_html__('By', 'optime').':'; ?></span>
                            <?php the_author_posts_link(); ?>
                        </li>
                    <?php endif; ?>
                    <?php if ($post_date_on) { ?>
                        <li>
                            <?php echo get_the_date(); ?>
                        </li>
                    <?php } ?>
                    <?php if ($post_comments_on) : ?>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php comments_number(esc_html__('0 Comments', 'optime'), esc_html__('1 Comment', 'optime'), esc_html__('% Comments', 'optime')); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php if($post_title_on){ ?>
                <div class="data">
                    <h3 class="entry-title">
                        <?php the_title(); ?>
                    </h3>
                </div>
            <?php } ?>

        </div>
    </div>
    <div class="entry-body">
        <div class="entry-content clearfix">
            <?php
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'optime' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <div class="entry-content-bottom clearfix">
            <?php
            if (($post_tags_on && !empty(get_the_tags())) || $social_share_on){
                ?>
                <div class="blog-single-tags-share">
                    <div class="row">
                        <?php if($post_tags_on && !empty(get_the_tags())) : ?>
                            <div class="blog-single-tags col-lg-8 col-md-8 col-sm-12">
                                <?php optime_entry_tagged_in(); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($social_share_on) : ?>
                            <div class="blog-single-social col-lg-4 col-md-4 col-sm-12 <?php if(!$post_tags_on){echo esc_attr('flex-start');} ?>">
                                <?php optime_socials_share_default(); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
                <?php
            }
            optime_post_nav_default();
            ?>
            <div class="admin-info">
                <div class="avatar-info">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?>
                </div>
                <div class="main-info">
                    <h3 class="name"><?php the_author_meta( 'display_name'); ?></h3>
                    <p class="desc"><?php the_author_meta( 'description'); ?></p>
                    <div class="socials">
                        <?php
                        $facebook = get_the_author_meta('facebook');
                        $twitter = get_the_author_meta('twitter');
                        $vimeo = get_the_author_meta('vimeo');
                        $linkedin = get_the_author_meta('linkedin');
                        $rss = get_the_author_meta('rss');
                        if (!empty($facebook)){
                            ?><a href="<?php echo esc_url($facebook) ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a><?php
                        }
                        if (!empty($twitter)){
                            ?><a href="<?php echo esc_url($twitter) ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a><?php
                        }
                        if (!empty($vimeo)){
                            ?><a href="<?php echo esc_url($vimeo) ?>"><i class="fa fa-vimeo-square" aria-hidden="true"></i></a><?php
                        }
                        if (!empty($linkedin)){
                            ?><a href="<?php echo esc_url($linkedin) ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a><?php
                        }
                        if (!empty($rss)){
                            ?><a href="<?php echo esc_url($rss) ?>"><i class="fa fa-rss" aria-hidden="true"></i></a><?php
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</article><!-- #post -->