<?php

class WalkerCustomComment extends Walker
{
    //public $tree_type = 'comment';
    public $db_fields = array ('parent' => 'comment_parent', 'id' => 'comment_ID');

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<div class="media">';
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</div>';
    }

    public function start_el(&$output, $comment, $depth = 0, $args = array('avatar_size' => 42))
    {
        if (1 == $depth) {
            $output .= '<li class="media" id="'.get_comment_ID().'">';
        } else {
            $output .= '<div class="media" id="'.get_comment_ID().'">';
        }

        $avatar = 'holder.js/42x42';
        if  ( 0 != $args['avatar_size'] ) {
            $avatar = get_avatar( $comment, $args['avatar_size'], '', '', array('class' => 'media-object') );
        }

        $author = sprintf( __( '%s <em class="says">says:</em>' ), get_comment_author_link( $comment ) );

        ob_start();
        edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' );
        $edit = ob_get_clean();

        /* translators: 1: comment date, 2: comment time */
        $time = sprintf(__('%1$s at %2$s'), get_comment_date('', $comment), get_comment_time());
        $comment_meta = sprintf('<a href="' . esc_url(get_comment_link( $comment, $args )).'"><time datetime="'.comment_time( 'c' ).'">%s</time></a> %s', $time, $edit);



        $output.=sprintf('
        <div class="media-left">
            <a href="#">%s</a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">%s</h4>
            <small class="comment-metadata">%s</small>
            %s', $avatar, $author, $comment_meta, get_comment());

    }

    public function end_el(&$output, $comment, $depth = 0, $args = array())
    {
        if (1 == $depth) {
            $output .= '</li>';
        } else {
            $output .= '</div>';
        }
    }
}

/**
 * Proper way to enqueue scripts and styles
 */
function madtrain_enqueue_style() {
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'madtrain-css', get_stylesheet_uri() );
}

function madtrain_enqueue_script() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.7', true );
    wp_enqueue_script( 'holder-js', get_template_directory_uri() . '/js/holder.js', array(), '2.3.2', true );
}

add_action( 'wp_enqueue_scripts', 'madtrain_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'madtrain_enqueue_script' );


// Register Sidebars
if (function_exists('register_sidebar')) {
    register_sidebar( array(
        'id'            => 'sidebar',
        //'class'         => 'test',
        'name'          => __( 'Right Sidebar', 'text_domain' ),
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'madtrain' ),
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
        'before_widget' => '<section>',
        'after_widget'  => '</section>',
    ));

    register_sidebar( array(
        'id'            => 'footer-area-1',
        //'class'         => 'test',
        'name'          => __( 'Bottom Area 1', 'text_domain' ),
        'description'   => __( 'Add widgets in the left area of footer section.', 'madtrain' ),
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
        'before_widget' => '<section>',
        'after_widget'  => '</section>',
    ));

    register_sidebar( array(
        'id'            => 'footer-area-2',
        //'class'         => 'test',
        'name'          => __( 'Bottom Area 2', 'text_domain' ),
        'description'   => __( 'Add widgets in the middle area of footer section.', 'madtrain' ),
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
        'before_widget' => '<section>',
        'after_widget'  => '</section>',
    ));

    register_sidebar( array(
        'id'            => 'footer-area-3',
        //'class'         => 'test',
        'name'          => __( 'Bottom Area 3', 'text_domain' ),
        'description'   => __( 'Add widgets in the right area of footer section.', 'madtrain' ),
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
        'before_widget' => '<section>',
        'after_widget'  => '</section>',
    ));
}

/**
 * Register our nav menu
 *
 */
function register_menu() {
    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
        'primary'   => __( 'Left Header Menu', 'madtrain' ),
        'secondary' => __( 'Right Header Menu', 'madtrain' ),
    ) );
}
add_action( 'init', 'register_menu' );


function wpb_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );


if ( !function_exists("generate_page_nav") ) {
    function generate_page_nav($print = false)
    {
        $page_nav = '<nav aria-label="Posts Pagination"><ul class="pager">';
        if (get_previous_posts_link()) {
            $page_nav .= sprintf(
                '<li class="previous">%s</li>',
                get_previous_posts_link('<span aria-hidden="true">&larr;</span> Older'
                ));
        } else {
            $page_nav .= sprintf(
                '<li class="previous disabled"><a href="javascript:void(0)">%s</a></li>',
                '<span aria-hidden="true">&larr;</span> Older'
            );
        }

        if (get_next_posts_link()) {
            $page_nav .= sprintf(
                '<li class="next">%s</li>',
                get_next_posts_link('Newer <span aria-hidden="true">&rarr;</span>'
                ));
        } else {
            $page_nav .= sprintf(
                '<li class="next disabled"><a href="javascript:void(0)">%s</a></li>',
                'Newer <span aria-hidden="true">&rarr;</span>'
            );
        }
        $page_nav .= '</nav>';

        if ( !$print ) {
            return $page_nav;
        }

        echo $page_nav;
    }
}


function madtrain_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> id="comment-<?php comment_ID() ?>" class="media">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard media-left">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
        <br />
    <?php endif; ?>



    <div class="media-body">
        <h5 class="media-heading">
            <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
        </h5>
        <small class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                <?php
                /* translators: 1: date, 2: time */
                printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
            ?>
        </small>
        <?php comment_text(); ?>

        <footer class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </footer>
    </div>


    <?php if ( 'div' != $args['style'] ) : ?>
        </div>
    <?php endif; ?>
    <?php
}

function madtrain_comment_end($comment, $args, $depth)
{

}