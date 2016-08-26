<section id="comments">
<?php if ( have_comments() ) : ?>
    <h3>
        <?php
        $comments_number = get_comments_number();
        if ( 1 === $comments_number ) {
            /* translators: %s: post title */
            printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'madtrain' ), get_the_title() );
        } else {
            printf(
            /* translators: 1: number of comments, 2: post title */
                _nx(
                    '%1$s thought on &ldquo;%2$s&rdquo;',
                    '%1$s thoughts on &ldquo;%2$s&rdquo;',
                    $comments_number,
                    'comments title',
                    'madtrain'
                ),
                number_format_i18n( $comments_number ),
                get_the_title()
            );
        }
        ?>
    </h3>

    <ul class="media-list">
        <?php
        echo wp_list_comments( array(
            'avatar_size' => 42,
            'max_depth' => 3, // can be set in Settings > Discussion
            'style' => 'ul',
            'callback' => 'madtrain_comment',
            'end-callback' => 'madtrain_comment_end',
            'type' => 'comment',
            'reply_text' => 'Reply',
            'format' => 'html5',
            'echo' => false,
        ) );
        ?>
    </ul><!-- .comment-list -->

    <?php the_comments_navigation(); ?>

<?php endif; // Check for have_comments(). ?>

<?php

$fields =  array(
    'author' =>
        '<div class="form-group comment-form-author"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . ' class="form-control" /></div>',

    'email' =>
        '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . $aria_req . '  class="form-control"/><p class="help-block">'.__( 'Your email address will not be published.' ).'</p></div>',

    'url' =>
        '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
        '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" class="form-control" placeholder="' . esc_attr_x( 'http://', 'placeholder' ) .'" /></div>',
);

$args = array(
    'id_form'           => 'commentform',
//    'class_form'        => 'form-horizontal',
    'id_submit'         => 'submit',
    'class_submit'      => 'btn btn-warning',
    'name_submit'       => 'submit',
    'title_reply'       => __( 'Leave a Comment' ),
    'title_reply_to'    => __( 'Leave a Reply to %s' ),
    'cancel_reply_link' => __( 'Cancel Reply' ),
    'label_submit'      => __( 'Post Comment' ),
    'format'            => 'html5',

    'comment_field' =>  '<div class="form-group comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
        '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control" placeholder="' . esc_attr_x( 'Comment', 'placeholder' ) .'">' .
        '</textarea></div>',

    'must_log_in' => '<p class="must-log-in">' .
        sprintf(
            __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
            wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
        ) . '</p>',

    'logged_in_as' => '<p class="logged-in-as">' .
        sprintf(
            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
            admin_url( 'profile.php' ),
            $user_identity,
            wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
        ) . '</p>',
    'comment_notes_before' => '',

//    'comment_notes_before' => '<p class="comment-notes">' .
//        __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) .
//        '</p>',

    'comment_notes_after' => '<p class="help-block form-allowed-tags">' .
        sprintf(
            __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
            ' <code>' . allowed_tags() . '</code>'
        ) . '</p>',

    'fields' => apply_filters( 'comment_form_default_fields', $fields ),
);

comment_form($args);

?>
</section>