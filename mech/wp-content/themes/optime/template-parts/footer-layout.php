<?php
$footer_top_custom_width = optime_get_opt( 'footer_top_custom_width' );
$footer_copyright = optime_get_opt( 'footer_copyright' );
$back_totop_on = optime_get_opt('back_totop_on', true);
// Newsletter form
$footer_newsletter_title = optime_get_opt('footer_newsletter_title');
$footer_newsletter_desc = optime_get_opt('footer_newsletter_desc');
$footer_newsletter_form = optime_get_opt('footer_newsletter_form');
$defined_forms = array( 'form_1', 'form_2', 'form_3', 'form_4', 'form_5', 'form_6', 'form_7', 'form_8', 'form_9', 'form_10' );
$show_newsletter = true;
if (is_singular('post')){
    $show_newsletter = optime_get_opt( 'show_newsletter_post' );
}elseif (is_page()){
    $show_newsletter = optime_get_page_opt( 'show_newsletter_page' );
}elseif (is_singular('portfolio')){
    $show_newsletter = optime_get_page_opt( 'show_newsletter_portfolio' );
}elseif (is_singular('service')){
    $show_newsletter = optime_get_page_opt( 'show_newsletter_service' );
}elseif (is_singular('industry')){
    $show_newsletter = optime_get_page_opt( 'show_newsletter_industry' );
}
if(class_exists('Newsletter') && !empty($footer_newsletter_form) && $show_newsletter) {
    ?>
    <div class="footer-newsletter cms-newsletter placeholder-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="newsletter-heading-text">
                        <?php
                        if (!empty($footer_newsletter_title)){
                            ?><h5><?php echo esc_html($footer_newsletter_title);?></h5><?php
                        }
                        ?>
                        <?php
                        if (!empty($footer_newsletter_desc)){
                            ?><p><?php echo esc_html($footer_newsletter_desc);?></p><?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="cms-newsletter-inner">
                        <?php
                        if ( in_array( $footer_newsletter_form, $defined_forms ) ) {
                            $footer_newsletter_form = str_replace( 'form_', '', $footer_newsletter_form );
                            echo do_shortcode( '[newsletter_form form="' . esc_attr( $footer_newsletter_form ) . '"]' );
                        } else {
                            echo NewsletterSubscription::instance()->get_subscription_form();
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12">
                    <div class="cms-social-media">
                        <?php optime_social_media(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<footer id="colophon" class="site-footer footer-layout1 ft-main-r">
    <div class="bg-overlay">
        <?php if ( is_active_sidebar( 'sidebar-footer-1' ) || is_active_sidebar( 'sidebar-footer-2' ) || is_active_sidebar( 'sidebar-footer-3' ) || is_active_sidebar( 'sidebar-footer-4' ) ) : ?>
        <div class="top-footer <?php echo esc_attr( $footer_top_custom_width ); ?>">
            <div class="container">
                <div class="row">
                    <?php optime_footer_top(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="bottom-footer">
            <div class="bf-gap"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 <?php if (!is_active_sidebar( 'sidebar-footer-bottom' )):?>text-center<?php else: ?>content-flex<?php endif; ?>">
                        <div class="footer-bottom-copyright">
                            <?php
                            if ($footer_copyright) {
                                echo wp_kses_post($footer_copyright);
                            } else {
                                echo wp_kses_post('&copy;'.esc_attr(date("Y")).' Mechnovation Technologies');
                            } ?>
                        </div>
                        <?php if ( is_active_sidebar( 'sidebar-footer-bottom' )) : ?>
                            <div class="footer-bottom-widget">
                                <?php optime_footer_bottom(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php if (isset($back_totop_on) && $back_totop_on) : ?>
	    <a href="#" class="scroll-top fixed-bottom"><i class="zmdi zmdi-chevron-up"></i></a>
	<?php endif; ?>

</footer>