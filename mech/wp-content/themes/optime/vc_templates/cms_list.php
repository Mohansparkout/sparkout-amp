<?php
extract(shortcode_atts(array(
    'cms_list_fontsize' => '14px',
    'cms_list_font_weight' => '700',
    'cms_list_color' => '#121c45',
    'cms_list' => '',
    'cms_list_item' => '',
    'icon_list' => 'fontawesome',
    'icon_fontawesome' => '',
    'icon_material' => '',
    'cms_icon_font_size'   => '18px',
    'cms_icon_color'   => '#121c45',
), $atts));
$icon  = $icon_fontawesome;
if ($icon_list == 'materialdesign'){
    if (!empty($icon_material)){
        $icon = $icon_material;
    }
}
$cms_lists = array();
$cms_lists = (array) vc_param_group_parse_atts($cms_list);
?>
<div class="cms-list cms-lists-default">
    <div class="cms-list-inner">
        <div class="cms-list-content">
            <ul>
                <?php foreach ($cms_lists as $key => $value) {
                    $list_link = isset($value['cms_list_link']) ? $value['cms_list_link'] : '';
                    $link = vc_build_link($list_link);
                    $a_href = '';
                    $a_target = '';
                    ?>
                    <li>
                        <?php
                        if ( strlen( $link['url'] ) > 0 ) {
                            $a_href = $link['url'];
                            $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
                            ?>
                            <a href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>" style="<?php if(!empty($cms_list_fontsize)) { echo 'font-size:'.esc_attr($cms_list_fontsize).';'; } if(!empty($cms_list_font_weight)) { echo 'font-weight:'.esc_attr($cms_list_font_weight).';'; } if(!empty($cms_list_color)) { echo 'color:'.esc_attr($cms_list_color).';'; } ?>">
                                <?php
                                if (!empty($icon)){
                                    ?> <i class="<?php echo esc_attr($icon); ?>" style="color: <?php echo esc_attr($cms_icon_color); ?>; font-size: <?php echo esc_attr($cms_icon_font_size); ?>;"></i> <?php
                                }
                                echo esc_html($value['cms_list_item']);
                                ?>
                            </a>
                            <?php
                        }else{
                            ?>
                            <p style="<?php if(!empty($cms_list_fontsize)) { echo 'font-size:'.esc_attr($cms_list_fontsize).';'; } if(!empty($cms_list_font_weight)) { echo 'font-weight:'.esc_attr($cms_list_font_weight).';'; } if(!empty($cms_list_color)) { echo 'color:'.esc_attr($cms_list_color).';'; } ?>">
                                <?php
                                if (!empty($icon)){
                                    ?> <i class="<?php echo esc_attr($icon); ?>" style="color: <?php echo esc_attr($cms_icon_color); ?>; font-size: <?php echo esc_attr($cms_icon_font_size); ?>;"></i> <?php
                                }
                                echo esc_html($value['cms_list_item']);
                                ?>
                            </p>
                            <?php
                        }
                        ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>