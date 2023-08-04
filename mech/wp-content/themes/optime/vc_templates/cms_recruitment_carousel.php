<?php
extract(shortcode_atts(array(
    'recruitment_item' => '',
    'el_class' => '',
    'animation' => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',

), $atts));

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'optime-carousel' );
$html_id = cmsHtmlID('cms-recruitment-carousel');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
extract(optime_get_param_carousel($atts));
$recruitments = (array) vc_param_group_parse_atts($recruitment_item);
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
if(!empty($recruitments)) : ?>
    <div id="<?php echo esc_attr($html_id);?>" class="cms-recruitment-carousel default owl-carousel <?php echo esc_attr( $el_parallax_class.' '.$el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?> <?php echo esc_attr($parallax_speed); ?>>
        <?php foreach ($recruitments as $key => $value) {
            $work_type =  $value['work_type'];
            $location = isset($value['location']) ? $value['location'] : '';
            $title = isset($value['title']) ? $value['title'] : '';
            $description = isset($value['description']) ? $value['description'] : '';
            $btn_link = isset($value['btn_link']) ? $value['btn_link'] : '';
            $link = vc_build_link($btn_link);
            $a_btn_text = '';
            $a_href = '';
            $a_target = '';
            if ( strlen( $link['url'] ) > 0 ) {
                $a_btn_text = !empty($link['title']) ? $link['title'] : 'Read More';
                $a_href = $link['url'];
                $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
            }
            ?>
            <div class="cms-recruitment-item <?php echo esc_attr( $animation_classes ); ?>">
                <div class="top-content">
                    <span class="work-type"><?php echo esc_html($work_type); ?></span>
                    <span class="location"><?php echo esc_html($location); ?></span>
                </div>

                <div class="main-content">
                    <?php if(!empty($title)) : ?>
                        <h5 class="recruitment-title">
                            <?php echo wp_kses_post( $title ); ?>
                        </h5>
                    <?php endif;?>
                    <?php if($description) : ?>
                        <div class="recruitment-description">
                            <p><?php echo wp_kses_post( $description ); ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="item-readmore">
                        <a href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>"><?php echo esc_html($a_btn_text); ?><i class="zmdi zmdi-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

<?php endif;?>