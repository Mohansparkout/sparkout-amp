<?php
class CMS_ContactForm_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'cms_contactform_widget',
            esc_html__('CMS Contact Form 7', 'optime'),
            array('description' => esc_html__('Contact Form Widget', 'optime'),)
        );
    }

    function widget($args, $instance) {

        extract($args);

        $subtitle = isset($instance['subtitle']) ? (!empty($instance['subtitle']) ? $instance['subtitle']: '') : '';
        $title = isset($instance['title']) ? (!empty($instance['title']) ? $instance['title']: '') : '';
        $contactform = isset($instance['contactform']) ? (!empty($instance['contactform']) ? $instance['contactform']: '') : '';
        ?>
        <div class="cms-contact-form cms-contact-form-layout4 widget">
            <?php if(!empty($subtitle)) : ?>
                <h5 class="el-subt-title"><?php echo esc_attr( $subtitle ); ?></h5>
            <?php endif; ?>
            <?php if(!empty($title)) : ?>
                <h3 class="el-title"><?php echo esc_attr( $title ); ?></h3>
            <?php endif; ?>
            <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $contactform ).'"]'); ?>
        </div>
    <?php }

    function update( $new_instance, $old_instance ) {
         $instance = $old_instance;
         $instance['subtitle'] = strip_tags($new_instance['subtitle']);
         $instance['title'] = strip_tags($new_instance['title']);
         $instance['contactform'] = strip_tags($new_instance['contactform']);

         return $instance;
    }

    function form( $instance ) {
         $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
         $subtitle = isset($instance['subtitle']) ? esc_attr($instance['subtitle']) : '';
         $contactform = isset($instance['contactform']) ? esc_attr($instance['contactform']) : ''; ?>
         <p><label for="<?php echo esc_url($this->get_field_id('subtitle')); ?>"><?php esc_html_e( 'Sub Title', 'optime' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('subtitle') ); ?>" name="<?php echo esc_attr( $this->get_field_name('subtitle') ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" /></p>
         
         <p><label for="<?php echo esc_url($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title', 'optime' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
    
        <p><label for="<?php echo esc_url($this->get_field_id('contactform')); ?>"><?php esc_html_e( 'Forms', 'optime' ); ?></label>
        <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('contactform') ); ?>" name="<?php echo esc_attr( $this->get_field_name('contactform') ); ?>">
            <?php 
                $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
                if ( $cf7 ) {
                    foreach ( $cf7 as $cform ) { ?>
                        <option value="<?php echo esc_attr($cform->ID); ?>" <?php if( $contactform == $cform->ID ){ echo 'selected="selected"';} ?>><?php echo esc_attr($cform->post_title); ?></option>
                    <?php }
                }
            ?>
         </select>
         </p>
    <?php
    }

}

function register_contactform_widget() {
    global $wp_widget_factory;
    $wp_widget_factory->register( 'CMS_ContactForm_Widget' );
}
add_action('widgets_init', 'register_contactform_widget'); ?>