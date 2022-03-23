<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
    <div class="content">
        <?php the_content(); ?>
    </div>
</article>

<?php get_footer(); ?>