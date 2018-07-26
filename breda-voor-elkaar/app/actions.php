<?php
add_action('init', function () {
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

add_action('pre_get_posts', function ($query) {
    // do not alter the query on wp-admin pages and only alter it if it's the main query
    if (!is_admin() && $query->is_main_query()) {
        // alter the query for the home and category pages
        if (is_home()) {
            $query->set('posts_per_page', 21);
        }
    }
});

function sendContactFormToSiteAdmin()
{
    try {
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
            throw new Exception('Bad form parameters. Check the markup to make sure you are naming the inputs correctly.');
        }
        if (!is_email($_POST['email'])) {
            throw new Exception('Email address not formatted correctly.');
        }

        $subject = 'Contact Form: ' . $reason . ' - ' . $_POST['name'];
        $headers = 'From: My Blog Contact Form <contact@myblog.com>';
        $send_to = "my@contactemail.com";
        $subject = "MyBlog Contact Form ($reason): " . $_POST['name'];
        $message = "Message from " . $_POST['name'] . ": \n\n " . $_POST['message'] . " \n\n Reply to: " . $_POST['email'];

        if (wp_mail($send_to, $subject, $message, $headers)) {
            echo json_encode(array('status' => 'success', 'message' => 'Contact message sent.'));
            exit;
        } else {
            throw new Exception('Failed to send email. Check AJAX handler.');
        }
    } catch (Exception $e) {
        echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        exit;
    }
}
add_action("wp_ajax_contact_send", "sendContactFormToSiteAdmin");
add_action("wp_ajax_nopriv_contact_send", "sendContactFormToSiteAdmin");
