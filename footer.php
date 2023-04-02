<?php if (!isset($_GET['novaapp'])) {
    if (!get_theme_mod('your_footer_visibility')) { ?>

        <footer id="footer" class="<?php if (get_theme_mod('your_navbar_color') == "light") {
                                        echo "";
                                    } else {
                                        echo "text-light bg-dark";
                                    }
                                    ?>">

            <div class="container <?php if (get_theme_mod('your_navbar_color') == "light") {
                                        echo "border-top";
                                    } else {
                                        echo "";
                                    }
                                    ?>">
                <div class="row text-center py-5">

                    <div class="col-12 col-sm-6 text-sm-start stamp">

                        <?php
                        // check to see if the logo exists and add it to the page
                        if (get_theme_mod('your_theme_logo')) : ?>

                            <?php echo wp_get_attachment_image(get_theme_mod('your_theme_logo'), 'full'); ?>

                        <?php // add a fallback if the logo doesn't exist
                        else : ?>

                            <h1 class="site-title"><?php bloginfo('name'); ?></h1>

                        <?php endif; ?>


                        <span class="tagline"><small><?php echo get_bloginfo('description'); ?></small></span>
                    </div>

                    <div class="col-12 col-sm-6 text-sm-end contact">

                        <?php
                        // check to see if the logo exists and add it to the page
                        if (get_theme_mod('your_footer_info')) : ?>

                            <?php echo get_theme_mod('your_footer_info'); ?>

                        <?php endif; ?>

                    </div>

                </div>
            </div>

        </footer>

<?php }
} ?>

<?php wp_footer(); ?>

</body>

</html>