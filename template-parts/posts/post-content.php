<?php if (have_posts()) : ?>

    <!-- the loop -->
    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <h5><?php the_title(); ?></h5>

            <?php the_content(); ?>

        </article><!-- .post -->

    <?php endwhile; ?>
    <!-- end of the loop -->

<?php endif; ?>