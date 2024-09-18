<?php get_header();

/**
 * Detect plugin. For frontend only.
 */
include_once ABSPATH . 'wp-admin/includes/plugin.php';

?>

<?php if (have_posts()) : ?>

    <!-- the loop -->
    <?php while (have_posts()) : the_post(); ?>

        <article>

            <?php
            // check for plugin using plugin name
            if (is_plugin_active('advanced-custom-fields-pro/acf.php')) {
                if (get_field('campo_extra') && !get_field('fundo_da_pagina')) {
                    the_field('campo_extra');
                }
            } ?>

            <?php the_content(); ?>

            <?php
            // check for plugin using plugin name
            if (is_plugin_active('advanced-custom-fields-pro/acf.php')) {
                if (get_field('campo_extra') && get_field('fundo_da_pagina')) {
                    the_field('campo_extra');
                }
            } ?>

        </article><!-- .post -->

    <?php endwhile; ?>
    <!-- end of the loop -->

    <!-- pagination here -->

    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>