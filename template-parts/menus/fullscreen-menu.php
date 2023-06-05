<?php

/**
 * Create my custom menus
 */

// https://gist.github.com/hitautodestruct/4345363#file-wp_custom_nav-php
// https://digwp.com/2011/11/html-formatting-custom-menus/
// https://wordpress.stackexchange.com/questions/228947/get-css-class-of-menu-item-in-custom-menu-structure
// https://stackoverflow.com/questions/10019493/adding-class-current-page-item

$menu_name = 'fullscreen_menu';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[$menu_name]);
$menuitems = wp_get_nav_menu_items($menu->term_id);

?>

<nav id="fullscreenmenu">

    <ul class="main-nav">
        <?php
        $count = 0;
        $submenu = false;

        foreach ($menuitems as $item) :

            $link = $item->url;
            $title = $item->title;
            //$class = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($item->classes), $item)));
            $classes = $item->classes;
            $description = $item->description;
            $active = ($item->object_id == get_queried_object_id() || $post->post_parent == $item->object_id) ? 'active' : '';

            // item does not have a parent so menu_item_parent equals 0 (false)
            if (!$item->menu_item_parent) :

                // save this id for later comparison with sub-menu items
                $parent_id = $item->ID;

                // item has child
                if ($menuitems[$count + 1]->menu_item_parent == $parent_id) :
        ?>
                    <li class="<?php echo $active;
                                foreach ($classes as $class) {
                                    echo $class, ' ';
                                }; ?>">
                        <a data-bs-toggle="collapse" href="#z<?php echo $parent_id; ?>" role="button" aria-expanded="false" aria-controls="z<?php echo $parent_id; ?>">
                            <?php if ($description) : ?><i class="fa-duotone fa-<?php echo $description; ?>"></i><?php endif ?>
                            <span><?php echo $title; ?></span>
                            <i class="fa-light fa-plus float-end"></i>
                        </a>

                    <?php else : // item doen't have child 
                    ?>

                    <li class="<?php echo $active;
                                foreach ($classes as $class) {
                                    echo $class, ' ';
                                }; ?>">
                        <a href="<?php echo $link; ?>">
                            <?php if ($description) : ?><i class="fa-duotone fa-<?php echo $description; ?>"></i><?php endif ?>
                            <span><?php echo $title; ?></span>
                        </a>
                    <?php endif; ?>


                <?php endif; ?>

                <?php if ($parent_id == $item->menu_item_parent) : ?>

                    <?php if (!$submenu) : $submenu = true; ?>
                        <div class="submenu collapse" id="z<?php echo $parent_id; ?>">
                        <?php endif; ?>
                        <div>
                            <a href="<?php echo $link; ?>" class="title <?php echo $active; ?>">
                                <?php if ($class) : ?><i class="fa-duotone fa-<?php echo $description; ?>"></i><?php endif ?>
                                <span><?php echo $title; ?></span>
                            </a>
                        </div>
                        <?php if ($menuitems[$count + 1]->menu_item_parent != $parent_id && $submenu) : ?>
                        </div>
                    <?php $submenu = false;
                        endif; ?>

                <?php endif; ?>

                <?php if ($menuitems[$count + 1]->menu_item_parent != $parent_id) : ?>
                    </li>
                <?php $submenu = false;
                endif; ?>

            <?php $count++;
        endforeach; ?>

    </ul>

    <?php if (is_user_logged_in()) { ?>
        <div class="user_profile">
            <p class="text-muted">
                <small> Logado como:
                    <?php
                    $current_user = wp_get_current_user();
                    echo $current_user->first_name;
                    ?>

                    <?php if (current_user_can('administrator')) { ?>
                        |
                        <a target="_blank" href="/wp-admin/" class="text-decoration-none">Dashboard <i class="fa-solid fa-gauge-max"></i></a>
                    <?php } ?>

                    |
                    <a href="<?php echo wp_logout_url(get_permalink()); ?>" class="text-decoration-none">Sair <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </small>
            </p>
        </div>
    <?php } ?>
</nav>