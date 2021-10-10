<?php get_header(); ?>

<div class="container">
    <div class="row py-5">

        <section id="all_my_posts">

            <?php get_template_part('template-parts/posts/post-content'); ?>

        </section>

        <?php if ($wp_query->max_num_pages > 1) { ?>
            <div class="btn btn-primary misha_loadmore">More posts</div>
        <?php } ?>

    </div>
</div>

<?php get_footer(); ?>