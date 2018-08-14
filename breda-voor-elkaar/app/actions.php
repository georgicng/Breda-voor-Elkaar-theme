<?php

//prevent volunteers/organisations access to wp-admin
function my_checkRole()
{
    error_log('checking role');
    if (!(current_user_can('edit_posts')) && !(defined('DOING_AJAX') && DOING_AJAX)) {
        error_log('redirecting to profile');
        wp_redirect(home_url('/mijn-account'));
        exit;
    }
}
add_action('admin_init', 'my_checkRole');

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

//set google map api key for acf
add_action('acf/init', function () {
    acf_update_setting('google_api_key', 'AIzaSyA9qDweEXseaAPutq5yxeNDYi24OQpL3zo');
});

//change wp-login logo

add_action('login_enqueue_scripts', function () {
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo App\asset_path('images/logo.png') ?>);
            height:27px;
            width:207px;
            background-size: 207px 27px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
    <?php
});
