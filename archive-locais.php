<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <div class="locais">
        <div class="container">

            <!-- the loop -->
            <?php while (have_posts()) : the_post(); ?>


                <a href="<?php the_permalink(); ?>">
                    <div class="row align-items-center">
                        <div class="col-3"><img src="<?php the_post_thumbnail_url(); ?>"></div>
                        <div class="col-7">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <div class="col-2 text-right"><i class="fal fa-angle-right"></i></div>
                    </div>
                </a>


            <?php endwhile; ?>
            <!-- end of the loop -->
            
        </div>
    </div>

    <!-- pagination here -->

    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>