<?php
class CMS_GetInTouch_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'cms_textbox_widget',
            esc_html__('CMS Get In Touch', 'optime'),
            array('description' => esc_html__('Get In Touch Widget', 'optime'),)
        );
    }

    function widget($args, $instance) {

        extract($args);

        $title = isset($instance['title']) ? (!empty($instance['title']) ? $instance['title']: '') : '';
        $mail_label = isset($instance['mail_label']) ? (!empty($instance['mail_label']) ? $instance['mail_label']: '') : '';
        $mail_text = isset($instance['mail_text']) ? (!empty($instance['mail_text']) ? $instance['mail_text']: '') : '';
        $phone_label = isset($instance['phone_label']) ? (!empty($instance['phone_label']) ? $instance['phone_label']: '') : '';
        $phone_text = isset($instance['phone_text']) ? (!empty($instance['phone_text']) ? $instance['phone_text']: '') : '';
        $phone_text_href = str_replace(array( ' ','+' ), '', $phone_text);
        $address_label = isset($instance['address_label']) ? (!empty($instance['address_label']) ? $instance['address_label']: '') : '';
        $address_text = isset($instance['address_text']) ? (!empty($instance['address_text']) ? $instance['address_text']: '') : '';
        $hours_label = isset($instance['hours_label']) ? (!empty($instance['hours_label']) ? $instance['hours_label']: '') : '';
        $hours_text = isset($instance['hours_text']) ? (!empty($instance['hours_text']) ? $instance['hours_text']: '') : '';
        ?>
        <div class="cms-get-in-touch widget">
            <?php if(!empty($title)) : ?>
                <h6 class="el-title footer-widget-title"><?php echo esc_attr($title); ?></h6>
            <?php endif; ?>
            <div class="cms-contact-info-inner">
                <?php if(!empty($mail_text)): ?>
                    <div class="cms-contact-info-item type-email">
                        <div class="cms-contact-info-holder">
                            <?php if (!empty($mail_label)){
                                ?><span><?php echo esc_attr( $mail_label  ).": "; ?></span><?php
                            }?>
                            <a href="mailto:<?php echo esc_attr( $mail_text ); ?>">
                                <?php echo wp_kses_post( $mail_text  ); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($phone_text)): ?>
                    <div class="cms-contact-info-item type-phone">
                        <div class="cms-contact-info-holder">
                            <?php if (!empty($phone_label)){
                                ?><span><?php echo esc_attr( $phone_label  ).": "; ?></span><?php
                            }?>
                            <a href="tel:<?php echo esc_attr( $phone_text_href ); ?>"><?php echo wp_kses_post( $phone_text  ); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($address_text)): ?>
                    <div class="cms-contact-info-item type-address">
                        <div class="cms-contact-info-holder">
                            <?php if (!empty($address_label)){
                                ?><span><?php echo esc_attr( $address_label  ).": "; ?></span><?php
                            }?>
                            <a href="http://maps.google.com/?q=<?php echo esc_attr( $address_text ); ?>" target="_blank">
                                <?php echo wp_kses_post( $address_text  ); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($hours_text)): ?>
                    <div class="cms-contact-info-item type-hours">
                        <div class="cms-contact-info-holder">
                            <?php if (!empty($hours_label)){
                                ?><span><?php echo esc_attr( $hours_label  ).": "; ?></span><?php
                            }?>
                            <span>
                                <?php echo wp_kses_post( $hours_text  ); ?>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['mail_label'] = strip_tags($new_instance['mail_label']);
        $instance['mail_text'] = strip_tags($new_instance['mail_text']);
        $instance['phone_label'] = strip_tags($new_instance['phone_label']);
        $instance['phone_text'] = strip_tags($new_instance['phone_text']);
        $instance['address_label'] = strip_tags($new_instance['address_label']);
        $instance['address_text'] = strip_tags($new_instance['address_text']);
        $instance['hours_label'] = strip_tags($new_instance['hours_label']);
        $instance['hours_text'] = strip_tags($new_instance['hours_text']);

        return $instance;
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $mail_label = isset($instance['mail_label']) ? esc_attr($instance['mail_label']) : '';
        $mail_text = isset($instance['mail_text']) ? esc_attr($instance['mail_text']) : '';
        $phone_label = isset($instance['phone_label']) ? esc_attr($instance['phone_label']) : '';
        $phone_text = isset($instance['phone_text']) ? esc_attr($instance['phone_text']) : '';
        $address_label = isset($instance['address_label']) ? esc_attr($instance['address_label']) : '';
        $address_text = isset($instance['address_text']) ? esc_attr($instance['address_text']) : '';
        $hours_label = isset($instance['hours_label']) ? esc_attr($instance['hours_label']) : '';
        $hours_text = isset($instance['hours_text']) ? esc_attr($instance['hours_text']) : '';

        ?>
        <p><label for="<?php echo esc_url($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('mail_label')); ?>"><?php esc_html_e( 'Mail Label', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('mail_label') ); ?>" name="<?php echo esc_attr( $this->get_field_name('mail_label') ); ?>" type="text" value="<?php echo esc_attr( $mail_label ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('mail_text')); ?>"><?php esc_html_e( 'Mail Text', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('mail_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('mail_text') ); ?>" type="text" value="<?php echo esc_attr( $mail_text ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('phone_label')); ?>"><?php esc_html_e( 'Phone Label', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('phone_label') ); ?>" name="<?php echo esc_attr( $this->get_field_name('phone_label') ); ?>" type="text" value="<?php echo esc_attr( $phone_label ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('phone_text')); ?>"><?php esc_html_e( 'Phone Text', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('phone_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('phone_text') ); ?>" type="text" value="<?php echo esc_attr( $phone_text ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('address_label')); ?>"><?php esc_html_e( 'Address Label', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('address_label') ); ?>" name="<?php echo esc_attr( $this->get_field_name('address_label') ); ?>" type="text" value="<?php echo esc_attr( $address_label ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('address_text')); ?>"><?php esc_html_e( 'Address Text', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('address_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('address_text') ); ?>" type="text" value="<?php echo esc_attr( $address_text ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('hours_label')); ?>"><?php esc_html_e( 'Hours Label', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('hours_label') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hours_label') ); ?>" type="text" value="<?php echo esc_attr( $hours_label ); ?>" /></p>

        <p><label for="<?php echo esc_url($this->get_field_id('hours_text')); ?>"><?php esc_html_e( 'Hours Text', 'optime' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('hours_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hours_text') ); ?>" type="text" value="<?php echo esc_attr( $hours_text ); ?>" /></p>
        <?php
    }

}

function register_getintouch_widget() {
    global $wp_widget_factory;
    $wp_widget_factory->register( 'CMS_GetInTouch_Widget' );
}
add_action('widgets_init', 'register_getintouch_widget'); ?>