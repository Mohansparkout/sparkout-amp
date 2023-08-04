<?php
extract(shortcode_atts(array(
    'cms_progressbar_list' => '',
    'el_class' => '',
    'bg_progress' => '#eee',
    'bg_progressbar' => '#ff5e14',
), $atts));
$html_id = cmsHtmlID('cms-progress');
$cms_progressbar = array();
$cms_progressbar = (array)vc_param_group_parse_atts($cms_progressbar_list);
if (!empty($cms_progressbar)) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="cms-progressbar layout1 <?php echo esc_attr($el_class); ?>">
        <?php foreach ($cms_progressbar as $key => $value) {
            $item_title = isset($value['item_title']) ? $value['item_title'] : '';
            $value = isset($value['value']) ? $value['value'] : ''; ?>
            <div class="cms-progress-item">
                <div class="progress-text">
                    <?php if ($item_title): ?>
                        <h5 class="cms-progress-title">
                            <?php echo apply_filters('the_title', $item_title); ?>
                        </h5>
                    <?php endif; ?>
                    <span class="cms-progress-percent" data-goal="<?php echo esc_attr($value).'%'; ?>">
                        <?php echo esc_attr($value) . '%'; ?>
                    </span>
                </div>
                <div class="cms-progress progress" style="background-color: <?php echo esc_attr($bg_progress); ?>;">
                    <div class="progress-bar" role="progressbar" data-valuetransitiongoal="<?php echo esc_attr($value); ?>" style="background-color: <?php echo esc_attr($bg_progressbar); ?>;">
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php endif; ?>