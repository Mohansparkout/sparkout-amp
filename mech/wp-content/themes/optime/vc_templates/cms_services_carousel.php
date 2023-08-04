<?php
extract(shortcode_atts(array(
    'source'               => '',
    'orderby'              => 'date',
    'order'                => 'DESC',
    'limit'                => '6',
    'post_ids'             => '',
    'animation'             => '',
    'el_class'             => '',
    'img_size'             => 'service-medium',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'optime-carousel' );
$html_id = cmsHtmlID('cms-services-carousel');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
extract(cms_get_posts_of_grid('service', $atts));
extract(optime_get_param_carousel($atts));
?>

<div id="<?php echo esc_attr($html_id) ?>" class="cms-services-carousel owl-carousel animation-time <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?> <?php echo esc_attr($parallax_speed); ?>>
    <?php if (is_array($posts)):
        $sizes = explode(',',$img_size);
        $i = 0;
        foreach ($posts as $post) {
            $default_size = end($sizes);
            if(!empty($sizes[$i])){
                $default_size = $sizes[$i];
            }
            ?>
            <div class="grid-item-inner">
                    <?php
                    if (has_post_thumbnail($post->ID)) {
                        echo '<div class="item-featured scale-hover">'; ?>
                        <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>"><?php echo get_the_post_thumbnail($post->ID,$default_size); ?></a>
                        <div class="overlay-gradient">
                        </div>
                        <?php echo '</div>';
                    }
                    ?>
                    <div class="item-holder">
                        <h5>
                            <a href="<?php echo esc_html(get_the_permalink($post->ID));?>"><?php echo get_the_title($post->ID);?></a>
                        </h5>
                        <div class="item-content">
                            <?php echo wp_trim_words( $post->post_excerpt, $num_words = 25, $more = null ); ?>
                        </div>
                        <div class="item-readmore">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html__('Read More', 'optime'); ?><i class="zmdi zmdi-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            <?php
        }
    endif; ?>
</div>