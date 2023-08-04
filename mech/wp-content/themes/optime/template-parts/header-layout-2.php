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
$lang_slides = optime_get_opt( 'lang_slides' );
$result = 1;
if (!empty($lang_slides)){
    $result = count($lang_slides);
}
$show_lang = true;
if ( $result == 1 && empty($lang_slides[0]['title']) ){
    $show_lang = false;
}
$h_btn_text = optime_get_opt( 'h_btn_text' );
$h_btn_link_type = optime_get_opt( 'h_btn_link_type', 'page_link' );
$h_btn_page_link = optime_get_opt( 'h_btn_page_link' );
$h_btn_custom_link = optime_get_opt( 'h_btn_custom_link' );
$h_btn_target = optime_get_opt( 'h_btn_target', '_self' );

//Top Bar Link1
$top_bar_text1 = optime_get_opt( 'top_bar_text1' );
$top_bar_link_type1 = optime_get_opt( 'top_bar_link_type1', 'page_link' );
$top_bar_page_link1 = optime_get_opt( 'top_bar_page_link1' );
$top_bar_custom_link1 = optime_get_opt( 'top_bar_custom_link1' );

//Top Bar Link2
$top_bar_text2 = optime_get_opt( 'top_bar_text2' );
$top_bar_link_type2 = optime_get_opt( 'top_bar_link_type2', 'page_link' );
$top_bar_page_link2 = optime_get_opt( 'top_bar_page_link2' );
$top_bar_custom_link2 = optime_get_opt( 'top_bar_custom_link2' );

?>
<header id="masthead" class="site-header">
    <div id="site-header-wrap" class="header-layout2 fixed-height <?php if($sticky_on == 1) { echo 'is-sticky'; } ?>">
        <div class="site-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="header-top-inner">
                            <div class="header-top-left">
                                <?php if(!empty($top_bar_phone)) : ?>
                                    <div class="site-contact-item">
                                        <i class="zmdi zmdi-phone"></i>
                                        <p><?php echo esc_html__('Phone', 'optime').': '.esc_html( $top_bar_phone ); ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($top_bar_time)) : ?>
                                    <div class="site-contact-item">
                                        <i class="zmdi zmdi-time"></i>
                                        <p><?php echo esc_html__('Hours', 'optime').': '.esc_html( $top_bar_time ); ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($top_bar_email)) : ?>
                                    <div class="site-contact-item item-link">
                                        <i class="zmdi zmdi-email"></i>
                                        <a href="mailto:<?php echo esc_attr($top_bar_email); ?>"><?php echo esc_html__('Email', 'optime').': '.esc_html( $top_bar_email ); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="header-top-right">
                                <div class="header-top-right-inner">
                                    <?php if(!empty($top_bar_text1)) : ?>
                                        <div class="header-top-right-link">
                                            <?php
                                            switch ( $top_bar_link_type1 ) {
                                                case 'custom_link': ?>
                                                    <a href="<?php echo wp_kses_post($top_bar_custom_link1); ?>" target="_blank"><?php echo wp_kses_post( $top_bar_text1 ); ?></a>
                                                    <?php break;

                                                default: ?>
                                                    <a href="<?php echo get_permalink($top_bar_page_link1); ?>" target="_blank"><?php echo wp_kses_post( $top_bar_text1 ); ?></a>
                                                    <?php break;
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($top_bar_text2)) : ?>
                                        <div class="header-top-right-link">
                                            <?php
                                            switch ( $top_bar_link_type2 ) {
                                                case 'custom_link': ?>
                                                    <a href="<?php echo wp_kses_post($top_bar_custom_link2); ?>" target="_blank"><?php echo wp_kses_post( $top_bar_text2 ); ?></a>
                                                    <?php break;

                                                default: ?>
                                                    <a href="<?php echo get_permalink($top_bar_page_link2); ?>" target="_blank"><?php echo wp_kses_post( $top_bar_text2 ); ?></a>
                                                    <?php break;
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
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
                    <div class="col-lg-2 col-md-12 col-sm-12">
                        <div class="site-branding">
                            <?php get_template_part( 'template-parts/header-branding' ); ?>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-12 col-sm-12">
                        <div class="header-main-inner">
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
                                                <span class="btn btn--icon">
                                                    <?php echo wp_kses_post( $h_btn_text ); ?>
                                                </span>
                                                <?php break;

                                            case 'custom_link': ?>
                                                <a href="<?php echo wp_kses_post($h_btn_custom_link); ?>" target="<?php echo esc_attr($h_btn_target); ?>" class="btn btn--icon"><?php echo wp_kses_post( $h_btn_text ); ?></a>
                                                <?php break;

                                            default: ?>
                                                <a href="<?php echo get_permalink($h_btn_page_link); ?>" target="<?php echo esc_attr($h_btn_target); ?>" class="btn btn--icon"><?php echo wp_kses_post( $h_btn_text ); ?></a>
                                                <?php break;
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <?php
                                if (class_exists('SitePress')) {
                                    ?>
                                    <div class="language-dropdow">
                                        <?php do_action('wpml_add_language_selector'); ?>
                                    </div>
                                    <?php
                                }elseif ($show_lang){
                                    ?>
                                    <div class="language-dropdow">
                                        <ul>
                                            <li class="lang-item">
                                                <a class="lang-sel" href="<?php echo esc_attr($lang_slides[0]['url'])?>">
                                                    <span><?php echo esc_html($lang_slides[0]['title'])?></span>
                                                </a>
                                                <?php
                                                if ($result > 1){
                                                    ?> <ul class="lang-submenu"><?php
                                                        for($i=1;$i<$result;$i++){
                                                            ?>
                                                            <li class="lang-item">
                                                                <a href="<?php echo esc_attr($lang_slides[$i]['url'])?>"><?php echo esc_html($lang_slides[$i]['title'])?></a>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?></ul> <?php
                                                }
                                                ?>

                                            </li>
                                        </ul>
                                    </div>
                                    <?php
                                }
                                ?>
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