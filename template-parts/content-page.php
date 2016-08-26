
<article>
    <?php
    // Post thumbnail.
    the_post_thumbnail();
    ?>

    <header>
        <?php the_title( '<h3>', '</h3>' ); ?>
    </header>

    
    <?php the_content(); ?>
    
    <?php
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'madtrain' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'madtrain' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
    ?>
    
    <?php edit_post_link( __( 'Edit', 'madtrain' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

</article><!-- #post-## -->
