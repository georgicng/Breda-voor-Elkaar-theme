<?php

namespace App;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    public function primarymenu()
    {
        $args = array(
            'theme_location' => 'primary_navigation',
            'menu_class' => 'navbar-nav ml-auto',
            'container_id' => 'main-nav',
            'container_class' => 'collapse navbar-collapse primary-menu',
            'walker' => new wp_bootstrap4_navwalker(),
        );
        return $args;
    }

    // custom menu
    public static function getCleanMenu($menu_slug)
    {
        $menu_name = $menu_slug;
        if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
            $menu = wp_get_nav_menu_object($locations[$menu_name]);
            $menu_items = wp_get_nav_menu_items($menu->term_id);

            $menu_list = '<div id="main-nav" class="collapse navbar-collapse">' . "\n";
            $menu_list .= "\t\t\t\t" . '<ul class="navbar-nav ml-auto">' . "\n";
            foreach ((array) $menu_items as $key => $menu_item) {
                $title = $menu_item->title;
                $url = $menu_item->url;
                $menu_list .= "\t\t\t\t\t" . '<li class="nav-item"><a href="' . $url . '" class="nav-link">' . $title . '</a></li>' . "\n";
            }
            $menu_list .= "\t\t\t\t" . '</ul>' . "\n";
            $menu_list .= "\t\t\t" . '</div>' . "\n";
        } else {
            // $menu_list = '<!-- no list defined -->';
        }
        return $menu_list;
    }

}
