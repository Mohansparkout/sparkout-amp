<?php
/**
 * The template for displaying Archive Services
 *
 * @package Optime
 */

get_header();
?>
    <div class="container">
        <div class="row">
            <div id="primary" class="col-12">
                <main id="main" class="site-main">
                    <?php
                    echo apply_filters('the_content','[cms_services_grid pagination_type="loadmore" col_xs="1" col_sm="1" col_md="2" col_lg="3"]');
                    ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
    </div>
<?php get_footer(); ?>