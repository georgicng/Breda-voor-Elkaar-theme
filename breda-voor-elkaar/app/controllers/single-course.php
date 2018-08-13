<?php

namespace App;

use Sober\Controller\Controller;

class SingleCourse extends Controller
{
    public function title()
    {
        global $post;
        return $post->post_title;
    }

    public function subtitle()
    {
        global $post;
        return get_field("lesson", $post->ID);
    }

    public function content()
    {
        global $post;
        return $post->post_content;
    }

    public function date()
    {
        global $post;
        return date_format(date_create(get_field("date", $post->ID)), "d M");
    }
}
