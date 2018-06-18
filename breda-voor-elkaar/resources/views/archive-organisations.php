<?php /* Template Name: Organisaties */?>

<?php //get_header(); ?>

<?php
// Pagination
if (get_query_var('paged')) {
    $current_page = get_query_var('paged');
} elseif (get_query_var('page')) {
    $current_page = get_query_var('page');
} else {
    $current_page = 1;
}
$users_per_page = 3;

$args = array(
    //Add filter and pagination arguments here later, and get them from ?= variables with default values.
    'role' => 'organisation',
    'number' => $users_per_page,
    'paged' => $current_page,
);

// The Query
$user_query = new WP_User_Query($args);

// Totals for pagination
$total_users = $user_query->get_total(); // How many users we have in total (beyond the current page)
$num_pages = ceil($total_users / $users_per_page); // How many pages of users we will need

// User Loop
if (!empty($user_query->get_results())) {
    foreach ($user_query->get_results() as $user) {
        ?>
        <ul>
            <li> <?php echo $user->ID ?> </li>
            <li> <?php echo $user->display_name ?> </li>
            <li> <?php the_field('afbeelding', 'user_' . $user->ID)?> </li>
        </ul>
        <?php
    }
    numeric_pagination($current_page, $num_pages);
} else {
    echo 'Geen organisatie gevonden die aan uw zoekopdracht voldeed.';
}
?>

<?php //get_footer(); ?>

<?php

/**
 * Calculate pagination for users.
 * This should end up in functions.php and be re-used in multiple templates, instead of defined at the bottom of the templates itself.
 */
function numeric_pagination($current_page, $num_pages) {
    echo '<div class="pagination">';
    $start_number = $current_page - 2;
    $end_number = $current_page + 2;

    if (($start_number - 1) < 1) {
        $start_number = 1;
        $end_number = min($num_pages, $start_number + 4);
    }
    
    if (($end_number + 1) > $num_pages) {
        $end_number = $num_pages;
        $start_number = max(1, $num_pages - 4);
    }

    if ($start_number > 1) {
        echo " 1 ... ";
    }

    for ($i = $start_number; $i <= $end_number; $i++) {
        if ($i === $current_page) {
            echo '<a class="active" href="?page='.$i.'">';
            echo " {$i} ";
            echo '</a>';
        } else {
            echo '<a href="?page='.$i.'">';
            echo " {$i} ";
            echo '</a>';
        }
    }

    if ($end_number < $num_pages) {
        echo " ... {$num_pages} ";
    }
    echo '</div>';
}
?>