<?php

/**
 * Create my custom menus
 */

// https://gist.github.com/hitautodestruct/4345363#file-wp_custom_nav-php
// https://digwp.com/2011/11/html-formatting-custom-menus/
// https://wordpress.stackexchange.com/questions/228947/get-css-class-of-menu-item-in-custom-menu-structure
// https://stackoverflow.com/questions/10019493/adding-class-current-page-item

$menu_name = 'navbar';

if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    // $submenu = false;
    // $count = 0;

    // Open DIV navbar-collapse
    $menu_list = '<div class="collapse navbar-collapse ';

    // Add classes based on theme options
    if (get_theme_mod('your_navbar_alignment') == "right") {
        $menu_list .= 'justify-content-end';
    } else if (get_theme_mod('your_navbar_alignment') == "left") {
        $menu_list .= 'justify-content-start';
    } else {
        $menu_list .= 'justify-content-center';
    }

    // Close DIV opening tag and open UL
    $menu_list .= '"> <ul class="navbar-nav">';
    $count = 0;

    // Loop through menu items
    foreach ($menu_items as $item) {

        // Get item info
        $link = $item->url;
        $title = $item->title;
        $classes = $item->classes;
        $description = $item->description;
        $parentId = $item->menu_item_parent;
        $id = $item->ID;

        $menu_list .= '<li class="nav-item">';
        $menu_list .= '<a class="nav-link" href="' . $link . '">';
        $menu_list .= '<span>';
        $menu_list .= 'Título: ' . $title . '<br/>';
        $menu_list .= 'ID: ' . $id . '<br/>';

        if ($item->object_id == get_queried_object_id() || $post->post_parent == $item->object_id) {
            $menu_list .= 'Active: Yes <br/>';
        } else {
            $menu_list .= 'Active: No <br/>';
        }

        if (has_sub_menu($menu_name, $id)) {
            $menu_list .= 'Has sub?: Yes <br/>';
        } else {
            $menu_list .= 'Has sub?: No <br/>';
        }

        if ($parentId == true) {
            $menu_list .= 'Is sub?: Yes <br/>';
        } else {
            $menu_list .= 'Is sub?: No <br/>';
            $parent_id = $item->ID;
        }

        $menu_list .= 'Count: ' . $count . '<br/>';

        $menu_list .= 'Arr Count: ' . array_search($item, $menu_items) . '<br/>';

        $menu_list .= 'Prnt ID: ' . $parentId . '<br/>';

        if ($parent_id != $id) {
            $menu_list .= 'Sub Prnt ID: ' . $parent_id . '<br/>';
        } else {
            $menu_list .= 'Sub Prnt ID: X <br/>';
        }

        if (has_sub_menu($menu_name, $parentId) && $parentId == true) {
            $menu_list .= 'Is 1st subitem?: No <br/>';
        }

        // if (array_search($item, $menu_items) + 1) {
        //     $menu_list .= 'Next Prnt ID: ' . $menu_items[array_search($item, $menu_items) + 1]->menu_item_parent . '<br/>';
        // } else {
        //     $menu_list .= 'Next Prnt ID: X <br/>';
        // }

        // if (prev($menu_items) == true) {
        //     $menu_list .= 'Main 1st ?: Yes <br/>';
        // } else {
        //     $menu_list .= 'Main 1st?: No <br/>';
        // }

        // if (next($menu_items) == true) {
        //     $menu_list .= 'Main last ?: Yes <br/>';
        // } else {
        //     $menu_list .= 'Main last?: No <br/>';
        // }

        // if (prev($menu_items) == true) {
        //     if ($menu_items[array_search($item, $menu_items)]->menu_item_parent != $parent_id) {
        //         $menu_list .= 'Is last subitem?: Yes <br/>';
        //     } else {
        //         $menu_list .= 'Is last subitem?: No <br/>';
        //     }
        // } else {
        //     $menu_list .= 'Is last subitem?: No <br/>';
        // }

        // 


        $count++;

        $menu_list .= '</span></a><li>';

        // // If item does not have a parent, then "menu_item_parent" equals 0 (false)
        // if (!$parent) {

        //     // Save this id for later comparison with sub-menu items
        //     //$parent_id = $item->ID;

        //     // Open LI tag
        //     $menu_list .= '<li class="nav-item dropdown ';

        //     // If this item's ID equals the current page's ID or the page's parent ID, add active class
        //     if ($item->object_id == get_queried_object_id() || $post->post_parent == $item->object_id) {
        //         $menu_list .= 'active ';
        //     }

        //     // Loop through and add the classes added on the Menu Admin Page
        //     foreach ($classes as $class) {
        //         $menu_list .= $class . ' ';
        //     }

        //     // Close LI opening tag
        //     $menu_list .= '">';

        //     // Open A tag
        //     $menu_list .= '<a class="nav-link ';

        //     // If this item has children items, add dropdown-toggle class
        //     if (has_sub_menu($menu_name, $item->ID)) {
        //         $menu_list .= 'dropdown-toggle';
        //     }

        //     // Close A tag class attribute
        //     $menu_list .= '"';

        //     // If this item has children items, add these attributes
        //     if (has_sub_menu($menu_name, $item->ID)) {
        //         $menu_list .= 'data-bs-toggle="dropdown" role="button" aria-expanded="false"';
        //     }

        //     // Add href attribute and close A tag
        //     $menu_list .= 'href="' . $link . '">';

        //     // Open DIV
        //     $menu_list .= '<div class="active_highlight">';

        //     // If there is a description from the Menu Admin Page, add an icon to the item
        //     if ($description) {
        //         $menu_list .= '<i class="fa-duotone fa-' . $description . '"></i>';
        //     }

        //     // Add title in SPAN tag and close DIV and close A
        //     $menu_list .= '<span>' . $title . ' ' . $parent_id . ' ' . $item->menu_item_parent . '</span></div></a>';
        // } // Close if no parent

        // // If this item is a submenu item
        // // If the ID of current item being looped through ($parent_id) equals the item's parent ID (???)
        // if ($parent_id == $item->menu_item_parent) {

        //     if (has_sub_menu($menu_name, $item->ID)) {
        //         //$submenu = true;

        //         $menu_list .= '<ul class="dropdown-menu ';

        //         if (get_theme_mod('your_navbar_color') == "light") {
        //             $menu_list .= 'dropdown-menu-light';
        //         } else {
        //             $menu_list .= 'dropdown-menu-dark';
        //         }

        //         $menu_list .= '">';
        //     }

        //     $menu_list .= '<li class="dropdown-item"><a href="' . $link . '" class="title">';

        //     if ($description) {
        //         $menu_list .= '<i class="fa-duotone fa-' . $description . '"></i>';
        //     }

        //     $menu_list .= $title . ' ' . $parent_id . ' ' . $item->menu_item_parent . '</a>';

        //     $menu_list .= '</li>';

        //     //  $parent_id != $menuitems[$count + 1]->menu_item_parent && $submenu
        //     if ($menuitems[$count + 1]->menu_item_parent != $parent_id && $submenu) {
        //         $menu_list .= '</ul>';

        //         $submenu = false;
        //     }
        // }

        // if ($menuitems[$count + 1]->menu_item_parent != $parent_id) {
        //     $menu_list .= '</li>';

        //     $submenu = false;
        // }

        // $count++;
    } // Close foreach ITEM

    // Close DVI navbar-collapse
    $menu_list .= '</ul></div>';
} else {
    $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
}
// $menu_list now ready to output
echo $menu_list;
