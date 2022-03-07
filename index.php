<?php get_header(); ?>

<div class="container px-4 py-5" id="custom-cards">
    <h2 class="pb-2 border-bottom">Blog</h2>

    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">


        <?php get_template_part('template-parts/posts/post-content'); ?>


        <?php if ($wp_query->max_num_pages > 1) { ?>
            <div class="btn btn-primary misha_loadmore">More posts</div>
        <?php } ?>

    </div>
</div>





<?php get_footer(); ?>