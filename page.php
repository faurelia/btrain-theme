<?php get_header(); ?>

<section class="container content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <main>
                <?php
                // Start the Loop.
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content', 'page' );
                endwhile;

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

                ?>
            </main>
        </div>
    </div>
</section>

<?php get_footer(); ?>
