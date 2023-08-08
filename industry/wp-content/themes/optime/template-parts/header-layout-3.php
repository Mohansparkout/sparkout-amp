<?php
/**
 * Template part for displaying default header layout
 */
$header_layout = optime_get_opt( 'header_layout' );
$sticky_on = optime_get_opt( 'sticky_on', false );
$search_on = optime_get_opt( 'search_on', true );
$top_bar_phone = optime_get_opt( 'top_bar_phone' );
$top_bar_time = optime_get_opt( 'top_bar_time' );
$top_bar_email = optime_get_opt( 'top_bar_email' );
$h_btn_text = optime_get_opt( 'h_btn_text' );
$h_btn_link_type = optime_get_opt( 'h_btn_link_type', 'page_link' );
$h_btn_page_link = optime_get_opt( 'h_btn_page_link' );
$h_btn_custom_link = optime_get_opt( 'h_btn_custom_link' );
$h_btn_target = optime_get_opt( 'h_btn_target', '_self' );

?>
<header id="masthead" class="site-header">
    <div id="site-header-wrap" class="header-layout3 fixed-height <?php if($sticky_on == 1) { echo 'is-sticky'; } ?>">
        <div class="site-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="header-top-inner">
                            <div class="header-top-left">
                                <div class="site-branding">
                                    <?php get_template_part( 'template-parts/header-branding' ); ?>
                                </div>
                            </div>
                            <div class="header-top-right">
                                <?php if(!empty($top_bar_phone)) : ?>
                                    <div class="site-contact-item">
                                        <i class="zmdi zmdi-phone"></i>
                                        <div class="contact-inner">
                                            <p><?php echo esc_html__('Call Us', 'optime').':'; ?></p>
                                            <p><?php echo esc_html( $top_bar_phone ); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($top_bar_time)) : ?>
                                    <div class="site-contact-item">
                                        <i class="zmdi zmdi-time"></i>
                                        <div class="contact-inner">
                                            <p><?php echo esc_html__('Opening Hours', 'optime').':'; ?></p>
                                            <p><?php echo esc_html( $top_bar_time ); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($top_bar_email)) : ?>
                                    <div class="site-contact-item item-link">
                                        <i class="zmdi zmdi-email"></i>
                                        <div class="contact-inner">
                                            <p><?php echo esc_html__('Email Us', 'optime').':'; ?></p>
                                            <a href="mailto:<?php echo esc_attr($top_bar_email); ?>"><?php echo esc_html( $top_bar_email ); ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="cms-social-media">
                                    <?php optime_social_media(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="headroom" class="site-header-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="header-main-inner">
                            <div class="site-branding">
                                <?php get_template_part( 'template-parts/header-branding' ); ?>
                            </div>
                            <nav id="site-navigation" class="main-navigation">
                                <?php get_template_part( 'template-parts/header-menu' ); ?>
                            </nav>
                            <div class="site-header-right">
                                <?php if (class_exists('ReduxFramework')) { ?>
                                    <?php if($search_on) : ?>
                                        <div class="icon-in-nav">
                                            <div class="search-icon h-btn-search">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php } ?>
                                <?php if(!empty($h_btn_text)) : ?>
                                    <div class="header-button">
                                        <?php
                                        switch ( $h_btn_link_type ) {
                                            case 'contact_form': ?>
                                                <span class="btn btn--icon hover--slide">
                                                    <?php echo wp_kses_post( $h_btn_text ); ?>
                                                </span>
                                                <?php break;

                                            case 'custom_link': ?>
                                                <a href="<?php echo wp_kses_post($h_btn_custom_link); ?>" target="<?php echo esc_attr($h_btn_target); ?>" class="btn btn--icon hover--slide"><?php echo wp_kses_post( $h_btn_text ); ?></a>
                                                <?php break;

                                            default: ?>
                                                <a href="<?php echo get_permalink($h_btn_page_link); ?>" target="<?php echo esc_attr($h_btn_target); ?>" class="btn btn--icon hover--slide"><?php echo wp_kses_post( $h_btn_text ); ?></a>
                                                <?php break;
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div id="main-menu-mobile">
                        <?php if (class_exists('ReduxFramework')) { ?>
                            <?php if($search_on) : ?>
                                <div class="icon-in-nav mobile-icon">
                                    <div class="search-icon h-btn-search">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php } ?>
                        <span class="btn-nav-mobile open-menu">
                            <span></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>