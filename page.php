<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <!-- the loop -->
    <?php while (have_posts()) : the_post(); ?>

        <article>

            <?php // https://developer.wordpress.org/reference/functions/the_meta/
            $keys = get_post_custom_keys();
            if ($keys) {
                $li_html = '';
                foreach ((array) $keys as $key) {
                    $keyt = trim($key);
                    if (is_protected_meta($keyt, 'post')) {
                        continue;
                    }

                    $values = array_map('trim', get_post_custom_values($key));
                    $value  = implode(', ', $values);

                    echo do_shortcode($value);
                }
            }
            ?>

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