<?php

namespace App;

use Sober\Controller\Controller;

class Single extends Controller
{
    public function headerImage()
    {
        global $post;
        return get_the_post_thumbnail_url($post, array(1270, 300));
    }

    public function item()
    {
        global $post;

        return [
            'title' => $post->post_title,
            'content' => $post->post_content,
        ];
    }

}
