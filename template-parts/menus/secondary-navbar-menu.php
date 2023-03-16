<?php

/**
 * Create my custom menus
 */

// https://gist.github.com/hitautodestruct/4345363#file-wp_custom_nav-php
// https://digwp.com/2011/11/html-formatting-custom-menus/
// https://wordpress.stackexchange.com/questions/228947/get-css-class-of-menu-item-in-custom-menu-structure
// https://stackoverflow.com/questions/10019493/adding-class-current-page-item

$menu_name = 'secondary_navbar';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[$menu_name]);
$menuitems = wp_get_nav_menu_items($menu->term_id);

if ($menuitems) {
?>
    <div class="container-fluid px-0">
        <nav class="secondary-navbar">
            <ul class="nav nav-fill">

                <?php foreach ($menuitems as $item) :
                    $link = $item->url;
                    $title = $item->title;
                    //$class = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($item->classes), $item)));
                    $classes = $item->classes;
                    $description = $item->description;
                    $active = ($item->object_id == get_queried_object_id()) ? 'active' : '';
                ?>
                    <li class="nav-item">
                        <a href="<?php echo $link; ?>" aria-current="page" class="nav-link <?php echo $active; ?>">
                            <?php if ($description) : ?><i class="fa-duotone fa-<?php echo $description; ?>"></i><?php endif ?>
                            <span><?php echo $title; ?></span>
                        </a>
                    </li>

                <?php endforeach; ?>

            </ul>
        </nav>
    </div>
<?php } ?>