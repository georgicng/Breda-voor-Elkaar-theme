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
            'container_id' => 'main-nav',
            'container_class' => 'collapse navbar-collapse',
            'walker' => new wp_bootstrap4_navwalker(),
        );
        return $args;
    }

    // custom menu example @ https://digwp.com/2011/11/html-formatting-custom-menus/
    public static function get_clean_menu($menu_slug)
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

    public function contentdeck()
    {
        $args = array(
            'post_type' => array('content'),
            'posts_per_page' => 4,
        );

        $query = new \WP_Query($args);
        return array_map(function ($post) {
            return [
                'title' => $post->post_title,
                'content' => get_field("snippet", $post->ID),
                'link' => get_field("link", $post->ID),
            ];
        }, $query->posts);
    }

    public function links()
    {
        $args = array(
            'post_type' => array('link'),
            'posts_per_page' => 9,
        );

        $query = new \WP_Query($args);
        return array_map(function ($post) {
            return [
                'title' => $post->post_title,
                'link' => get_field("url", $post->ID),
            ];
        }, $query->posts);
    }
}
