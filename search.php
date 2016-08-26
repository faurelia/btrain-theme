<?php get_header(); ?>

<section class="container content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <main>

                <?php
                if ( have_posts() ) :
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                        get_template_part( 'single' );
                    endwhile;
                // Previous/next post navigation.
                generate_page_nav(true);

                else :
                    // If no content, include the "No posts found" template.
                    get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>

            </main>
        </div>
        <div class="col-md-4">
            <aside><?php get_sidebar(); ?></aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
