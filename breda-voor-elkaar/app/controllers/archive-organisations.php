<?php

namespace App;

use Sober\Controller\Controller;

class ArchiveOrganisations extends Controller
{
    private $filter_keys;

    private $fields;

    private $meta_query;

    public function __construct()
    {
        if (!session_id()) {
            session_start();
        }
        if (isset($_GET['nr'])) {
            $_SESSION['nr'] = $_GET['nr'];
        }

        $this->filter_keys = array(
            'field_5b06cc6d43567' => 'categorie',
        );

        $this->setMetaQuery();

        $this->setFields();
    }

    private function setMetaQuery()
    {
        $this->meta_query = array('relation' => 'OR');
        foreach ($this->filter_keys as $acf_key => $key) {
            if (isset($_GET[$key])) {
                if (is_array($_GET[$key])) {
                    foreach ($_GET[$key] as $value) {
                        $meta_addition = array(
                            'key' => rawurldecode($key),
                            'value' => rawurldecode($value),
                            'compare' => 'LIKE',
                        );
                        array_push($this->meta_query, $meta_addition);
                    }
                } else {
                    $meta_addition = array(
                        'key' => rawurldecode($key),
                        'value' => rawurldecode($_GET[$key]),
                        'compare' => 'LIKE',
                    );
                    array_push($this->meta_query, $meta_addition);
                }
            }
        }
    }

    private function setFields()
    {
        $this->fields = [];

        foreach ($this->filter_keys as $acf_key => $key) {
            $field = get_field_object($acf_key, false, false);

            if (isset($_GET[$key])) {
                $field['value'] = $_GET[$key];
            } else {
                $field['value'] = array();
            }
            array_push($this->fields, $field);
        }
    }

    public function fields()
    {
        return $this->fields;
    }

    public function organisations()
    {
        global $wpdb;

        // Pagination
        if (get_query_var('paged')) {
            $current_page = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $current_page = get_query_var('page');
        } else {
            $current_page = 1;
        }
        $users_per_page = 10;
        if (isset($_SESSION['nr'])) {
            $users_per_page = $_SESSION['nr'];
        }

        // Arguments for out main query
        $args = array(
            // Add filter and pagination arguments here later, and get them from ?= variables with default values.
            'role' => 'organisation',
            'number' => $users_per_page,
            'paged' => $current_page,
            'meta_query' => $meta_query,
        );

        // Add search term to wp-query if it is set in the url.
        if (isset($_GET['search'])) {
            $search_term = $wpdb->esc_like($_GET['search']);
            $args['search'] = '*' . $search_term . '*';
            $args['search_columns'] = array(
                'user_login',
                'user_nicename',
                'user_email',
                'user_url',
            );
        }

        // The Query
        $user_query = new WP_User_Query($args);

        // Totals for pagination
        $this->total_users = $$user_query->get_total();
        $this->num_pages = ceil($this->total_users / $users_per_page);

        return array_map(function ($user) {
            return [
                'name' => $user->display_name,
                'id' => $user->ID,
                'link' => get_author_posts_url($user->ID),
                'image_link' => get_field('afbeelding', 'user_' . $user->ID),
                'bio' => $user->description,
                'vacancies' => $this->getVacancies($user->ID),
                'categories' => $this->getCategories($user->ID),
            ];
        }, $user_query->get_results());
    }

    private function getCategories($id)
    {
        return get_field('categorie', 'user_' . $id);
    }

    private function getVacancies($id)
    {
        return get_field('vacancies', 'user_' . $id);
    }
}
