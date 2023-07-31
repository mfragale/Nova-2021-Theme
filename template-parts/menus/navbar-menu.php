<?php

/**
 * Create my custom menus
 */

// https://gist.github.com/hitautodestruct/4345363#file-wp_custom_nav-php
// https://digwp.com/2011/11/html-formatting-custom-menus/
// https://wordpress.stackexchange.com/questions/228947/get-css-class-of-menu-item-in-custom-menu-structure
// https://stackoverflow.com/questions/10019493/adding-class-current-page-item

$menu_name = 'navbar';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[$menu_name]);
$menuitems = wp_get_nav_menu_items($menu->term_id);
?>

<div class="collapse navbar-collapse <?php if (get_theme_mod('your_navbar_alignment') == "right") {
                                            echo "justify-content-end";
                                        } else if (get_theme_mod('your_navbar_alignment') == "left") {
                                            echo "justify-content-start";
                                        } else {
                                            echo "justify-content-center";
                                        }
                                        ?>">
    <ul class="navbar-nav">
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
            $parent = $item->menu_item_parent;

            // item does not have a parent so menu_item_parent equals 0 (false)
            if (!$parent) :

                // save this id for later comparison with sub-menu items
                $parent_id = $item->ID;
        ?>

                <li class="nav-item dropdown <?php
                                                echo $active, ' ';
                                                foreach ($classes as $class) {
                                                    echo $class, ' ';
                                                }; ?>">
                    <a class="nav-link <?php if (has_sub_menu($menu_name, $item->ID)) { ?>dropdown-toggle<?php } ?>" <?php if (has_sub_menu($menu_name, $item->ID)) { ?>data-bs-toggle="dropdown" role="button" aria-expanded="false" <?php } ?> href="<?php echo $link; ?>">
                        <div class="active_highlight">
                            <?php if ($description) : ?><i class="fa-duotone fa-<?php echo $description; ?>"></i><?php endif // $description
                                                                                                                    ?>
                            <span><?php echo $title; ?></span>
                        </div>
                    </a>
                <?php endif; // !$parent 
                ?>

                <?php if ($parent_id == $item->menu_item_parent) : ?>

                    <?php if (!$submenu) :
                        $submenu = true; ?>
                        <ul class="dropdown-menu <?php if (get_theme_mod('your_navbar_color') == "light") {
                                                        echo "dropdown-menu-light";
                                                    } else {
                                                        echo "dropdown-menu-dark";
                                                    }
                                                    ?>">
                        <?php endif; // !$submenu
                        ?>

                        <li class="dropdown-item">
                            <a href="<?php echo $link; ?>" class="title"><?php if ($description) : ?><i class="fa-duotone fa-<?php echo $description; ?>"></i><?php endif // $description
                                                                                                                                                                ?> <?php echo $title; ?></a>
                        </li>

                        <?php if ($menuitems[$count + 1]->menu_item_parent != $parent_id && $submenu) : ?>
                        </ul>
                    <?php $submenu = false;
                        endif; // $menuitems[$count + 1]->menu_item_parent != $parent_id && $submenu 
                    ?>

                <?php endif; // $parent_id == $item->menu_item_parent
                ?>

                <?php if ($menuitems[$count + 1]->menu_item_parent != $parent_id) : ?>
                </li>
            <?php $submenu = false;
                endif; // $menuitems[$count + 1]->menu_item_parent != $parent_id
            ?>

        <?php $count++;
        endforeach; // $item
        ?>

    </ul>
</div>