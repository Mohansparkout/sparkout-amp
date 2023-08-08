<?php
extract(shortcode_atts(array(
    'form' => '',
    'nl_title' => 'STAY IN TOUCH',
    'animation'   => '',
    'el_class'   => '',
    'el_parallax'   => 'false',
    'el_parallax_speed'   => '1.5',
), $atts));
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$el_parallax_class = '';
$parallax_speed = '';
if(isset($el_parallax) && $el_parallax == 'true') {
    wp_enqueue_script('digiton-parallax');
    $el_parallax_class = 'el-parallax';
    $parallax_speed = 'data-speed='.$el_parallax_speed.'';
}
$defined_forms = array( 'form_1', 'form_2', 'form_3', 'form_4', 'form_5', 'form_6', 'form_7', 'form_8', 'form_9', 'form_10' );
if(class_exists('Newsletter')) { ?>
    <div class="cms-newsletter placeholder-white <?php echo esc_attr( $el_parallax_class.' '.$el_class.' '.$animation_classes ); ?>" <?php echo esc_attr($parallax_speed); ?>>
        <div class="cms-newsletter-inner">
            <?php
            if ( in_array( $form, $defined_forms ) ) {
                $form = str_replace( 'form_', '', $form );
                echo do_shortcode( '[newsletter_form form="' . esc_attr( $form ) . '"]' );
            } else {
                echo NewsletterSubscription::instance()->get_subscription_form();
            }
            ?>
        </div>
    </div>
<?php } ?>