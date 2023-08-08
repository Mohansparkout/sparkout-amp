<?php
/**
 * The template for displaying Archive Portfolio
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
	            	$term = get_term_by( 'slug', get_query_var( 'portfolio-category' ), get_query_var( 'taxonomy' ) );
	                echo apply_filters('the_content','[cms_case_studies_grid filter="false" pagination_type="loadmore" col_xs="1" col_sm="2" col_md="2" col_lg="3" source="'.$term->slug.'|portfolio-category"]');
	            ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div>
</div>
<?php get_footer(); ?>