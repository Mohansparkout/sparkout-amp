<?php
extract(shortcode_atts(array(
    'form_item' => '',
    'shadow_color' => 'rgba(0,0,0,0.15)',
    'box_title' => '',
    'box_description' => '',
    'box_link' => '',
    'animation' => '',
    'el_class'  => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('optime-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
$forms = (array) vc_param_group_parse_atts($form_item);
if(!empty($forms)) : ?>
    <div class="cms-contact-form-tab  <?php echo esc_attr( $el_parallax_class.' '.$el_class.' '.$animation_classes )?>" <?php echo esc_attr($parallax_speed); ?>>
        <div class="nav nav-tabs" role="tablist">
            <?php foreach ($forms as $key => $value) {
                $title = isset($value['title']) ? $value['title'] : '';
                ?>
                <a class="tab-item <?php if ($key == 0){echo esc_attr('active');} ?>" data-toggle="tab" href="<?php echo esc_attr('.tab-' . $key); ?>" role="tab" aria-selected="true">
                    <span><?php echo esc_html($title); ?></span>
                </a>
                <?php
            }?>
        </div>

        <div class="tab-content">
            <?php foreach ($forms as $key => $value): ?>
                <div class="tab-pane fade <?php echo esc_attr('tab-' . $key) ?> <?php if ($key == 0){echo esc_attr('active'.' show');} ?>" role="tabpanel">
                    <?php
                    $id = isset($value['id']) ? $value['id'] : '';
                    if(class_exists('WPCF7')) {
                        ?>
                        <div class="cms-contact-form cms-contact-form-default  <?php echo esc_attr( $el_parallax_class.' '.$el_class.' '.$animation_classes )?>" <?php echo esc_attr($parallax_speed); ?>>
                            <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $id ).'"]'); ?>
                        </div>
                        <?php
                    }
                    $title = $box_title;
                    $description = $box_description;
                    $link = vc_build_link($box_link);
                    $a_btn_text = '';
                    $a_href = '';
                    $a_target = '';
                    if ( strlen( $link['url'] ) > 0 ) {
                        $a_btn_text = !empty($link['title']) ? $link['title'] : 'Contact Us';
                        $a_href = $link['url'];
                        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
                    }
                    $background_img_url = get_template_directory_uri() . '/assets/images/contact-box-widget.png';
                    ?>
                    <div class="cms-contact-box widget" style="background-image: url('<?php echo esc_url($background_img_url)?>');">
                        <div class="content-text">
                            <?php if (!empty($title)) : ?>
                                <h2 class="widget-title">
                                    <?php echo wp_kses_post($title); ?>
                                </h2>
                            <?php endif; ?>
                            <?php if (!empty($description)): ?>
                                <div class="cms-contact-text">
                                    <p><?php echo wp_kses_post($description); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($a_href)) : ?>
                            <div class="cms-contact-button">
                                <a href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>" class="btn hover--slide"><?php echo esc_html($a_btn_text); ?><i class="zmdi zmdi-arrow-right"></i></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif;?>

<?php
ob_start();
if (!empty($shadow_color)){
    ?>
    .cms-contact-form-tab:before {
        background-color: <?php echo esc_attr($shadow_color); ?>;
    }
    <?php
}
$dynamic_css = ob_get_clean();
if (function_exists('cms_inline_css')){
    cms_inline_css($dynamic_css);
}
?>
