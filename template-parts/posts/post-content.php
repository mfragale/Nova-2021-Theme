<?php if (have_posts()) : ?>

    <!-- the loop -->
    <?php while (have_posts()) : the_post(); ?>



        <article id="post-<?php the_ID(); ?>" class="<?php post_class(); ?> col">
            <a href="<?php the_permalink(); ?>" class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('<?php the_post_thumbnail_url(); ?>');">
                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                    <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold"><?php the_title(); ?></h2>
                    <ul class="d-flex list-unstyled mt-auto">
                        <li class="me-auto">
                            <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white">
                        </li>
                        <li class="d-flex align-items-center me-3">
                            <svg class="bi me-2" width="1em" height="1em">
                                <use xlink:href="#geo-fill"></use>
                            </svg>
                            <small>Earth</small>
                        </li>
                        <li class="d-flex align-items-center">
                            <svg class="bi me-2" width="1em" height="1em">
                                <use xlink:href="#calendar3"></use>
                            </svg>
                            <small>3d</small>
                        </li>
                    </ul>
                </div>
            </a>
        </article>





    <?php endwhile; ?>
    <!-- end of the loop -->

<?php endif; ?>