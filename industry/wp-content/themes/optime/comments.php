<?php
/**
 * The template for displaying comments.
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package Optime
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
$post_comments_form_on = optime_get_opt( 'post_comments_form_on', true );

if($post_comments_form_on) : ?>

    <div id="comments" class="comments-area">

        <?php
        // You can start editing here -- including this comment!
        if ( have_comments() ) : ?>
            <div class="comment-list-wrap">
                <h3 class="comments-title">
                    <?php
                        $comment_count = get_comments_number();
                        if ( 1 === intval($comment_count) ) {
                            echo '1 '.esc_html__( 'Comment', 'optime' );
                        } else {
                            echo esc_html( $comment_count ).' '.esc_html__('Comments', 'optime');
                        }
                    ?>
                </h3><!-- .comments-title -->

                <?php the_comments_navigation(); ?>

                <ul class="comment-list">
                    <?php
                        wp_list_comments( array(
                            'style'      => 'ul',
                            'short_ping' => true,
                            'avatar_size' => 60,
                            'callback'   => 'optime_comment_list'
                        ) );
                    ?>
                </ul><!-- .comment-list -->

                <?php the_comments_navigation(); ?>
            </div>
            <?php if ( ! comments_open() ) : ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'optime' ); ?></p>
            <?php
            endif;

        endif; // Check for have_comments().

    $args = array(
            'id_form'           => 'commentform',
            'id_submit'         => 'submit',
            'title_reply'       => esc_attr__( 'Leave A Reply', 'optime'),
            'title_reply_to'    => esc_attr__( 'Add Comment To ', 'optime') . '%s',
            'cancel_reply_link' => esc_attr__( 'Cancel Comment', 'optime'),
            'label_submit'      => esc_attr__( 'Submit Comment', 'optime'),
            'comment_notes_before' => '',
            'fields' => apply_filters( 'comment_form_default_fields', array(

                    'author' =>
                    '<div class="row input-wrap"><div class="input-wrap-inner comment-form-author col-lg-4 col-md-4 col-sm-12">'.
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                    '" size="30" placeholder="'.esc_attr__('Name *', 'optime').'"/></div>',

                    'email' =>
                    '<div class="input-wrap-inner comment-form-email col-lg-4 col-md-4 col-sm-12">'.
                    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                    '" size="30" placeholder="'.esc_attr__('Email *', 'optime').'"/></div>',

                    'url' =>
                        '<div class="input-wrap-inner comment-form-url col-lg-4 col-md-4 col-sm-12">'.
                        '<input id="url" name="url" type="url" value="' . esc_attr(  $commenter['comment_author_url'] ) .
                        '" size="30" placeholder="'.esc_attr__('Website', 'optime').'"/></div></div>',
            )
            ),
            'comment_field' => 
            '<div class="row"><div class="comment-form-comment col-lg-12 col-md-12 col-sm-12">'.
            '<textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.esc_attr__('Comment *', 'optime').'" aria-required="true">' .
            '</textarea></div></div>',
            'submit_field'         => '<div class="row"><p class="form-submit col-12">%1$s %2$s</p></div>',

    );
    comment_form($args);
    ?>

    </div><!-- #comments -->

<?php endif; ?>