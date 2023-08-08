<?php
class CS_Pdf_Download_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'cs_pdf_download_widget', // Base ID
            esc_html__('CMS Pdf Download', 'optime'), // Name
            array('description' => esc_html__('Link download pdf file in media', 'optime'),) // Args
        );
    }

    function widget($args, $instance) {
        extract($args);
        if (!empty($instance['title'])) {
            $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Pdf Download', 'optime' ) : $instance['title'], $instance, $this->id_base);
        }
        $pdf_icon = get_template_directory_uri() . '/assets/images/pdf.png';

        $pdf_name_1 = isset($instance['pdf_name_1']) ? $instance['pdf_name_1'] : '';
        $link_pdf_1 = isset($instance['link_pdf_1']) ? $instance['link_pdf_1'] : '';

        $pdf_name_2 = isset($instance['pdf_name_2']) ? $instance['pdf_name_2'] : '';
        $link_pdf_2 = isset($instance['link_pdf_2']) ? $instance['link_pdf_2'] : '';

        $pdf_name_3 = isset($instance['pdf_name_3']) ? $instance['pdf_name_3'] : '';
        $link_pdf_3 = isset($instance['link_pdf_3']) ? $instance['link_pdf_3'] : '';

        $pdf_name_4 = isset($instance['pdf_name_4']) ? $instance['pdf_name_4'] : '';
        $link_pdf_4 = isset($instance['link_pdf_4']) ? $instance['link_pdf_4'] : '';

        $pdf_name_5 = isset($instance['pdf_name_5']) ? $instance['pdf_name_5'] : '';
        $link_pdf_5 = isset($instance['link_pdf_5']) ? $instance['link_pdf_5'] : '';

        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', $before_widget);
        }
        echo ''.$before_widget;
        if (!empty($title))
            echo ''.$before_title . $title . $after_title;
            echo "<div class='cms-pdf-download'>";
            if ($pdf_name_1 != '' && $link_pdf_1 != '') {
                ?>
                <a target="_blank" href="<?php echo esc_url($link_pdf_1);?>" class="btn hover--slide">
                    <img src="<?php echo esc_url($pdf_icon);?>" alt="<?php esc_attr($pdf_name_1);?>">
                    <p><?php echo esc_html($pdf_name_1)?></p>
                </a>
                <?php
            }
            if ($pdf_name_2 != '' && $link_pdf_2 != '') {
                ?>
                <a target="_blank" href="<?php echo esc_url($link_pdf_2);?>" class="btn hover--slide">
                    <img src="<?php echo esc_url($pdf_icon);?>" alt="<?php esc_attr($pdf_name_2);?>">
                    <p><?php echo esc_html($pdf_name_2)?></p>
                </a>
                <?php
            }
            if ($pdf_name_3 != '' && $link_pdf_3 != '') {
                ?>
                <a target="_blank" href="<?php echo esc_url($link_pdf_3);?>" class="btn hover--slide">
                    <img src="<?php echo esc_url($pdf_icon);?>" alt="<?php esc_attr($pdf_name_3);?>">
                    <p><?php echo esc_html($pdf_name_3)?></p>
                </a>
                <?php
            }

            if ($pdf_name_4 != '' && $link_pdf_4 != '') {
                ?>
                <a target="_blank" href="<?php echo esc_url($link_pdf_4);?>" class="btn hover--slide">
                    <img src="<?php echo esc_url($pdf_icon);?>" alt="<?php esc_attr($pdf_name_4);?>">
                    <p><?php echo esc_html($pdf_name_4)?></p>
                </a>
                <?php
            }

            if ($pdf_name_5 != '' && $link_pdf_5 != '') {
                ?>
                <a target="_blank" href="<?php echo esc_url($link_pdf_5);?>" class="btn hover--slide">
                    <p><?php echo esc_html($pdf_name_5)?></p>
                    <img src="<?php echo esc_url($pdf_icon);?>" alt="<?php esc_attr($pdf_name_5);?>">
                </a>
                <?php
            }
            echo "</div>";
        echo ''.$after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        $instance['pdf_name_1'] = strip_tags($new_instance['pdf_name_1']);
        $instance['link_pdf_1'] = strip_tags($new_instance['link_pdf_1']);

        $instance['pdf_name_2'] = strip_tags($new_instance['pdf_name_2']);
        $instance['link_pdf_2'] = strip_tags($new_instance['link_pdf_2']);

        $instance['pdf_name_3'] = strip_tags($new_instance['pdf_name_3']);
        $instance['link_pdf_3'] = strip_tags($new_instance['link_pdf_3']);

        $instance['pdf_name_4'] = strip_tags($new_instance['pdf_name_4']);
        $instance['link_pdf_4'] = strip_tags($new_instance['link_pdf_4']);

        $instance['pdf_name_5'] = strip_tags($new_instance['pdf_name_5']);
        $instance['link_pdf_5'] = strip_tags($new_instance['link_pdf_5']);

        return $instance;
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';

        $pdf_name_1 = isset($instance['pdf_name_1']) ? esc_attr($instance['pdf_name_1']) : '';
        $link_pdf_1 = isset($instance['link_pdf_1']) ? esc_attr($instance['link_pdf_1']) : '';
        $pdf_name_2 = isset($instance['pdf_name_2']) ? esc_attr($instance['pdf_name_2']) : '';
        $link_pdf_2 = isset($instance['link_pdf_2']) ? esc_attr($instance['link_pdf_2']) : '';
        $pdf_name_3 = isset($instance['pdf_name_3']) ? esc_attr($instance['pdf_name_3']) : '';
        $link_pdf_3 = isset($instance['link_pdf_3']) ? esc_attr($instance['link_pdf_3']) : '';
        $pdf_name_4 = isset($instance['pdf_name_4']) ? esc_attr($instance['pdf_name_4']) : '';
        $link_pdf_4 = isset($instance['link_pdf_4']) ? esc_attr($instance['link_pdf_4']) : '';
        $pdf_name_5 = isset($instance['pdf_name_5']) ? esc_attr($instance['pdf_name_5']) : '';
        $link_pdf_5 = isset($instance['link_pdf_5']) ? esc_attr($instance['link_pdf_5']) : '';

        ?>
        <p><label for="<?php echo esc_url($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'optime' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('pdf_name_1')); ?>"><?php esc_html_e( 'Pdf Name 1:', 'optime' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pdf_name_1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pdf_name_1') ); ?>" type="text" value="<?php echo esc_attr( $pdf_name_1 ); ?>" /></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('link_pdf_1')); ?>"><?php esc_html_e( 'Pdf Link 1:', 'optime' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_pdf_1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_pdf_1') ); ?>" type="text" value="<?php echo esc_attr( $link_pdf_1 ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('pdf_name_2')); ?>"><?php esc_html_e( 'Pdf Name 2:', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pdf_name_2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pdf_name_2') ); ?>" type="text" value="<?php echo esc_attr( $pdf_name_2 ); ?>" /></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('link_pdf_2')); ?>"><?php esc_html_e( 'Pdf Link 2:', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_pdf_2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_pdf_2') ); ?>" type="text" value="<?php echo esc_attr( $link_pdf_2 ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('pdf_name_3')); ?>"><?php esc_html_e( 'Pdf Name 3:', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pdf_name_3') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pdf_name_3') ); ?>" type="text" value="<?php echo esc_attr( $pdf_name_3 ); ?>" /></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('link_pdf_3')); ?>"><?php esc_html_e( 'Pdf Link 3:', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_pdf_3') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_pdf_3') ); ?>" type="text" value="<?php echo esc_attr( $link_pdf_3 ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('pdf_name_4')); ?>"><?php esc_html_e( 'Pdf Name 4:', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pdf_name_4') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pdf_name_4') ); ?>" type="text" value="<?php echo esc_attr( $pdf_name_4 ); ?>" /></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('link_pdf_4')); ?>"><?php esc_html_e( 'Pdf Link 4:', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_pdf_4') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_pdf_4') ); ?>" type="text" value="<?php echo esc_attr( $link_pdf_4 ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('pdf_name_5')); ?>"><?php esc_html_e( 'Pdf Name 5:', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pdf_name_5') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pdf_name_5') ); ?>" type="text" value="<?php echo esc_attr( $pdf_name_5 ); ?>" /></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('link_pdf_5')); ?>"><?php esc_html_e( 'Pdf Link 5:', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_pdf_5') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_pdf_5') ); ?>" type="text" value="<?php echo esc_attr( $link_pdf_5 ); ?>" /></p>

    <?php
    }

}

/**
* Class CS_Social_Widget
*/

function register_pdf_download_widget() {
    global $wp_widget_factory;
    $wp_widget_factory->register( 'CS_Pdf_Download_Widget' );
}

add_action('widgets_init', 'register_pdf_download_widget');
?>