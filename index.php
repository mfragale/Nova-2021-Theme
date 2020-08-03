<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <!-- the loop -->
    <?php while (have_posts()) : the_post(); ?>

        <article>

            <?php the_content(); ?>

        </article><!-- .post -->

    <?php endwhile; ?>
    <!-- end of the loop -->

    <!-- pagination here -->

    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

















































<?php get_footer(); ?>
