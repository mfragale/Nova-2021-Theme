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

<div class="collapse navbar-collapse">
    <ul class="navbar-nav ms-auto me-auto">
        <?php
        $count = 0;
        $submenu = false;

        foreach ($menuitems as $item) :

            $link = $item->url;
            $title = $item->title;
            $class = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($item->classes), $item)));
            $active = ($item->object_id == get_queried_object_id()) ? 'active' : '';

            // item does not have a parent so menu_item_parent equals 0 (false)
            if (!$item->menu_item_parent) :

                // save this id for later comparison with sub-menu items
                $parent_id = $item->ID;
        ?>

                <li class="nav-item <?php echo $active; ?>">
                    <a class="nav-link" href="<?php echo $link; ?>">
                        <div class="active_highlight">
                            <?php if ($class) : ?><i class="fad <?php echo $class; ?>"></i><?php endif ?>
                            <span><?php echo $title; ?></span>
                        </div>
                    </a>
                <?php endif; ?>

                <?php if ($parent_id == $item->menu_item_parent) : ?>

                    <?php if (!$submenu) : $submenu = true; ?>
                        <ul class="sub-menu">
                        <?php endif; ?>

                        <li class="item">
                            <a href="<?php echo $link; ?>" class="title"><?php echo $title; ?></a>
                        </li>

                        <?php if ($menuitems[$count + 1]->menu_item_parent != $parent_id && $submenu) : ?>
                        </ul>
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
</div>