<?php

namespace App;

use Sober\Controller\Controller;

class ArchiveVacancies extends Controller
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
            'field_5b06d097c1efe' => 'frequentie',
            'field_5b06d0e7c1f00' => 'opleidingsniveau',
            'field_5b06da1440f4e' => 'vergoeding',
        );

        $this->setMetaQuery();

        $this->setFields();
    }

    private function setMetaQuery()
    {
        $this->meta_query = array('relation' => 'OR');
        foreach ($this->filter_keys as $acf_key => $key) {
            if (isset($_GET[$key])) {
                foreach ($_GET[$key] as $value) {
                    $meta_addition = array(
                        'key' => rawurldecode($key),
                        'value' => rawurldecode($value),
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

    public function vacancies()
    {
        global $wpdb;
        if (get_query_var('paged')) {
            $current_page = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $current_page = get_query_var('page');
        } else {
            $current_page = 1;
        }
        $posts_per_page = 10;

        $args = array(
            // Add filter and pagination arguments here later, and get them from ?= variables with default values.
            'post_type' => 'vacancies',
            'posts_per_page' => $posts_per_page,
            'paged' => $current_page,
            'meta_query' => $this->meta_query,
        );
        // Add search term to wp-query if it is set in the url.
        if (isset($_GET['search'])) {
            $search_term = $wpdb->esc_like($_GET['search']);
            $args['s'] = $search_term;
        }

        // The Query
        $query = new \WP_Query($args);
        $posts = $query->posts;

        // Totals for pagination
        $this->total_posts = $query->found_posts; // How many posts we have in total (beyond the current page)
        $this->num_pages = ceil($this->total_posts / $posts_per_page); // How many pages of posts we will need

        return array_map(function ($post) {
            return [
                'title' => $post->post_title,
                'link' => get_permalink($post->ID),
                'image_link' => get_the_post_thumbnail_url($post->ID, [200, 200]),
                'excerpt' => $this->getExcerpt($post, 60),
                'subtitle' => $post->post_title,
                'footer' => get_field("image_link", $post->ID),
            ];
        }, $query->posts);
    }

    private function getExcerpt($post, $wordsreturned)
    {
        if (get_class($post) == 'WP_Post') {
            $string = strip_tags($post->post_content);
            $retval = $string; //  Just in case of a problem

            $array = explode(" ", $string);
            if (count($array) <= $wordsreturned) {
                $retval = $string;
            } else {
                array_splice($array, $wordsreturned);
                $retval = implode(" ", $array) . " ...";
            }
            return $retval;
        }
        return '';
    }
}
