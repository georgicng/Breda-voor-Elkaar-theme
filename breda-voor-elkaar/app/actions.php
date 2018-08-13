<?php

//process favorite submission
/*add_action('init', function () {
    if (isset($_POST['Favoriet'])) {
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
        $current_array = get_field('field_5b0frsad5dfc7', 'user_' . $user_id);
        $current_array = (array) $current_array;
        if (!in_array($post_id, $current_array)) {
            $current_array[] = $post_id;
            update_field('field_5b0frsad5dfc7', $current_array, 'user_' . $user_id);
        }
    } elseif (isset($_POST['Reageer'])) {
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
        $current_array = get_field('field_5b0fe6fd5dfc7', 'user_' . $user_id);
        $current_array = (array) $current_array;
        if (!in_array($post_id, $current_array)) {
            $current_array[] = $post_id;
            update_field('field_5b0fe6fd5dfc7', $current_array, 'user_' . $user_id);
        }
    }
});
*/

//set post result to 21 per page
add_action('pre_get_posts', function ($query) {
    // do not alter the query on wp-admin pages and only alter it if it's the main query
    if (!is_admin() && $query->is_main_query()) {
        // alter the query for the home and category pages
        if (is_home()) {
            $query->set('posts_per_page', 21);
        }
    }
});

//prevent volunteers/organisations access to wp-admin
function my_checkRole()
{
    if (!(current_user_can('edit_posts')) && !(defined('DOING_AJAX') && DOING_AJAX)) {
        wp_redirect(home_url('/mijn-account'));
        exit;
    }
}
add_action('admin_init', 'my_checkRole');

/* Where to go if after tml login */
function login_redirection($url)
{
    if (!current_user_can('edit_posts')) {
        return home_url('/mijn-account');
    }
    return admin_url();
}
add_filter('login_redirect', 'login_redirection');

//style theme-my-login with bootstrap
function make_tml_forms_bootstrap_compatible()
{
    foreach (tml_get_forms() as $form) {
        foreach (tml_get_form_fields($form) as $field) {
            if ('hidden' == $field->get_type()) {
                continue;
            }

            $field->render_args['before'] = '<div class="form-group">';
            $field->render_args['after'] = '</div>';
            if ('checkbox' != $field->get_type()) {
                $field->add_attribute('class', 'form-control');
            }
        }
    }
}
add_action('init', 'make_tml_forms_bootstrap_compatible');

//add roles to register option
function add_tml_registration_form_fields()
{
    tml_add_form_field('register', 'role', array(
        'type'     => 'dropdown',
        'label'    => 'Role',
        'options'   => ['volunteer' => 'Vrijwilliger','organisation' => 'Organisatie'],
        'id'       => 'role',
        'priority' => 15,
        'class' => 'form-control',
        'render_args' => [
            'before' => '<div class="form-group">',
            'after' => '</div>'
        ]
    ));
}
add_action('init', 'add_tml_registration_form_fields');

//validate custom theme my login registration fields
function validate_tml_registration_form_fields($errors)
{
    if (empty($_POST['role'])) {
        $errors->add('empty_role', __('<div class="alert"><strong>ERROR<strong>: Please seect a role.</div>', 'mooiwerk'));
    }
    return $errors;
}
add_filter('registration_errors', 'validate_tml_registration_form_fields');

//save theme-my-login fields: in this case set roles
function save_tml_registration_form_fields($user_id)
{
    if (! empty($_POST['role'])) {
        $user = new WP_User($user_id);
        $user->set_role($_POST['role']);
    }
}
add_action('user_register', 'save_tml_registration_form_fields');

//remove acf fields from theme-my-login reisgtation form
function remove_tml_register_fields()
{
    tml_remove_form_field('register', 'register_form');
}
add_action('init', 'remove_tml_register_fields');


//add cpt to search query
function my_add_cpts_to_search($query)
{
    if ($query->is_search) {
        $query->set('post_type', array( 'post', 'course', 'vacancies' ));
    }
    return $query;
}
add_filter('pre_get_posts', 'my_add_cpts_to_search');
