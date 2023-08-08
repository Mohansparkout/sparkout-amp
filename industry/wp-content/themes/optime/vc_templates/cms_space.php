<?php
extract(shortcode_atts(array(
    'space_lg' => '',
    'space_md' => '',
    'space_sm' => '',
    'space_xs' => '',
), $atts));
$uqid = uniqid();

?>
<div id="cms-space-<?php echo esc_attr($uqid);?>">
    <?php
    ob_start();
    if(!empty($space_lg)) { ?>
    @media screen and (min-width: 992px) {
        #cms-space-<?php echo esc_attr($uqid);?> .cms-space {
            height: <?php echo esc_attr($space_lg); ?>px;
        }
    }
    <?php }
    if(!empty($space_md)) { ?>
    @media (min-width: 768px) and (max-width: 991px) {
        #cms-space-<?php echo esc_attr($uqid);?> .cms-space {
            height: <?php echo esc_attr($space_md); ?>px;
        }
    }
    <?php }

    if(!empty($space_sm)) { ?>
    @media (min-width: 576px) and (max-width: 767px) {
        #cms-space-<?php echo esc_attr($uqid);?> .cms-space {
            height: <?php echo esc_attr($space_sm); ?>px;
        }
    }
    <?php }

    if(!empty($space_xs)) { ?>
    @media screen and (max-width: 575px) {
        #cms-space-<?php echo esc_attr($uqid);?> .cms-space {
            height: <?php echo esc_attr($space_xs); ?>px;
        }
    }
    <?php }
    $dynamic_css = ob_get_clean();
    if (function_exists('cms_inline_css')){
        cms_inline_css($dynamic_css);
    }
    ?>
	<div class="cms-space"></div>
</div>