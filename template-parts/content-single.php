<article>
    <header>
        <?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
    </header>
    <?php if ( !is_single() || is_search() ) : ?>
        <?php the_excerpt(); ?>
    <?php else: ?>
        <?php the_content(); ?>
    <?php endif; ?>
    <hr>
    <footer>
        <?php if ( get_the_tag_list() !== false ): ?>
            <?php the_tags( '<ul class="list-inline"><li>', '</li><li>', '</li></ul>' ); ?>
        <?php endif; ?>
        <ul class="list-inline">
            <li><i class="glyphicon glyphicon-time"></i> <?php echo get_the_date( 'F d, Y' ) ?></li>
            <li><i class="glyphicon glyphicon-comment"></i>
                <?php if ( comments_open() ): ?>
                    <?php comments_popup_link( __( 'Leave a comment', 'madtrain' ), __( '1 Comment', 'madtrain' ), __( '% Comments', 'madtrain' ) ); ?>
                <?php else: ?>
                    <?php echo "Comments are closed." ?>
                <?php endif; ?>
            </li>
            <li>
                <i class="glyphicon glyphicon-list"></i>
                <?php echo get_the_category_list( __( ', ', 'madtrain' ) ); ?>
            </li>
        </ul>
    </footer>
</article>

<?php if (is_single() && comments_open()): ?>
    <?php comments_template(); ?>
<?php endif; ?>