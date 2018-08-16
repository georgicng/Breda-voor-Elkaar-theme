<?php

//prevent volunteers/organisations access to wp-admin
add_action('admin_init', function () {
    error_log('checking role');
    if (!(current_user_can('edit_posts')) && !(defined('DOING_AJAX') && DOING_AJAX)) {
        error_log('redirecting to profile');
        wp_redirect(home_url('/mijn-account'));
        exit;
    }
});

//style theme-my-login with bootstrap
add_action('init', function () {
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
});

//add roles to register option
add_action('init', function () {
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
});

//save theme-my-login fields: in this case set roles
add_action('user_register', function ($user_id) {
    if (! empty($_POST['role'])) {
        $user = new WP_User($user_id);
        $user->set_role($_POST['role']);
    }
});

//remove acf fields from theme-my-login reisgtation form
add_action('init', function () {
    tml_remove_form_field('register', 'register_form');
});

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
