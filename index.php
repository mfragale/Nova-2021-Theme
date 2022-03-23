<?php get_header(); ?>


<?php get_template_part('template-parts/posts/post-content'); ?>


<?php if ($wp_query->max_num_pages > 1) { ?>
    <div class="btn btn-primary misha_loadmore">More posts</div>
<?php } ?>


<?php get_footer(); ?>