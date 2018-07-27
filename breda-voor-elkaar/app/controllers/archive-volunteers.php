<?php

namespace App;

use Sober\Controller\Controller;

class ArchiveVolunteers extends Controller
{
    public function volunteers()
    {
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
            'role' => 'volunteer',
            'number' => $users_per_page,
            'paged' => $current_page,
        );

        // The Query
        $user_query = new WP_User_Query($args);

        // Totals for pagination
        $this->total_users = $$user_query->get_total();
        $this->num_pages = ceil($this->total_users / $users_per_page);

        return array_map(function ($user) {
            return [
                'name' => $user->display_name,
                'image-link' => $this->getIcon($user->ID),
                'bio' => $user->description,
            ];
        }, $user_query->get_results());
    }

    public function getIcon($id)
    {
        return "//placehold.it/50x50";
    }
}
