<?php

namespace App;

use Sober\Controller\Controller;

class FrontPage extends Controller
{
    public function contentdeck()
    {
        $args = array(
            'post_type' => array('content'),
            'posts_per_page' => 4,
        );

        $query = new \WP_Query($args);
        return array_map(function ($post) {
            return [
                'title' => $post->post_title,
                'content' => get_field("snippet", $post->ID),
                'link' => get_field("link", $post->ID),
            ];
        }, $query->posts);
    }

    public function links()
    {
        $args = array(
            'post_type' => array('link'),
            'posts_per_page' => 9,
        );

        $query = new \WP_Query($args);
        return array_map(function ($post) {
            return [
                'title' => $post->post_title,
                'link' => get_field("url", $post->ID),
            ];
        }, $query->posts);
    }

    public function courses()
    {
        $args = array(
            'post_type' => array('course'),
            'posts_per_page' => 3,
        );
        $query = new \WP_Query($args);
        return array_map(function ($post) {
            return [
                'title' => $post->post_title,
                'link' => $post->post_permalink,
                'excerpt' => $post->post_excerpt,
                'date' => get_field("date", $post->ID),
                'lesson' => get_field("lesson", $post->ID),
            ];
        }, $query->posts);
    }

    public function courseLink()
    {
        return \get_post_type_archive_link('post');
    }

    public function courseIntro()
    {
        return 'Sub Title';
    }

    public function courseDescription()
    {
        return 'body';
    }

    public function courseTitle()
    {
        return 'Title';
    }

    public function news()
    {
        $args = array(
            'post_type' => array('post'),
            'posts_per_page' => 6,
            'category_name' => 'news',
        );

        $query = new \WP_Query($args);
        return array_map(function ($post) {
            return [
                'title' => $post->post_title,
                'excerpt' => $post->post_content,
                'link' => \get_permalink($post->ID),
                'image_link' => \get_the_post_thumbnail_url($post->ID, [500, 500]),
            ];
        }, $query->posts);
    }

    public function newsTitle()
    {
        return 'Latest News';
    }
}
