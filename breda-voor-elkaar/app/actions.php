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
