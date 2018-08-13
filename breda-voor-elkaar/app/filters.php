<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment',
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__ . '\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory() . '/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );
    return template_path(locate_template(["views/{$comments_template}", $comments_template]) ?: $comments_template);
}, 100);

//return acf array instead of object in blade templates
add_filter('sober/controller/acf/array', function () {
    return true;
});

//Use custom nav walker for menu widget
add_filter('widget_nav_menu_args', function ($nav_menu_args) {
    $nav_menu_args = [
        'menu' => $nav_menu_args['menu'],
        'items_wrap' => '%3$s',
        'container' => 'nav',
        'container_class' => 'footer-menu__nav d-flex flex-column',
        'walker' => new Widget_Walker(),
    ];

    return $nav_menu_args;
});

/* Where to go if after tml login */

add_filter('login_redirect', function ($url) {
    error_log('redirect url: '. $url);
    if (current_user_can('edit_posts')) {
        error_log('redirect to admin: '. admin_url());
        return admin_url();
    }
    error_log('redirect toprofile: '. home_url('/mijn-account'));
    return home_url('/mijn-account');
});

//validate custom theme my login registration fields
add_filter('registration_errors', function ($errors) {
    if (empty($_POST['role'])) {
        $errors->add('empty_role', __('<div class="alert"><strong>ERROR<strong>: Please seect a role.</div>', 'mooiwerk'));
    }
    return $errors;
});

//alter main query
add_filter('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query()) {
        
        //alter query to include custom post types in search
        if ($query->is_search) {
            $query->set('post_type', array( 'post', 'course', 'vacancies' ));
        }

        // alter the query to change item count for the home and category pages
        if (is_home()) {
            $query->set('posts_per_page', 21);
        }
    }

    return $query;
});
