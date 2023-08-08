<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Optime
 */

$primary_image=optime_get_opt( 'primary_image' );
if (empty($primary_image["url"])){
    $primary_image["url"] = get_template_directory_uri() . '/assets/images/image-404.jpg';
}
$page404_color=optime_get_opt( 'page404_color', '#fff');
$number_fontsize=optime_get_opt( 'number_fontsize', '220px');
$page404_htext=optime_get_opt( 'page404_htext', ' OOPS! PAGE NOT FOUND');
$page404_hfontsize=optime_get_opt( 'page404_hfontsize','40px');
$page404_desc=optime_get_opt( 'page404_desc', ' The page you are looking is not available or has been removed. Try going to HomePage by using the button below.');
$page404_desc_fontsize=optime_get_opt( 'page404_desc_fontsize', '20px');

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="content-404 bg-gradient" style="background-image: url('<?php echo esc_url($primary_image["url"]); ?>')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 error-404-text">
                            <div class="page-number">
                                <h1 style="color: <?php echo esc_attr($page404_color) ?>; font-size:<?php echo esc_attr($number_fontsize) ?>; "> <?php echo esc_html('404'); ?></h1>
                            </div>
                            <div class="page-heading">
                                <h2 style="color: <?php echo esc_attr($page404_color) ?>; font-size:<?php echo esc_attr($page404_hfontsize) ?>; "> <?php echo esc_attr($page404_htext) ?></h2>
                            </div>
                            <div class="page-desc">
                                <p style="color: <?php echo esc_attr($page404_color) ?>; font-size:<?php echo esc_attr($page404_desc_fontsize) ?>; "> <?php echo esc_attr($page404_desc) ?></p>
                            </div>
                            <div class="page-button">
                                <a class="btn" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__('Back To Homepage', 'optime'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
