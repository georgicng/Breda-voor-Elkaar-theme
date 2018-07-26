<?php
namespace App;

use WP_Query;

// Create Centered Youtube Embed Video Section
// Use the shortcode: [vembed title="" url="3"]
function create_vembed_shortcode($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'title' => 'Video titel',
            'link' => 'https://www.youtube.com/embed/rKXFgWP-2xQ',
        ),
        $atts,
        'video'
    );

    $title = $atts['title'];
    $link = $atts['link'];

    ob_start();

    ?>
    <section class="video">
        <div class="video__wrapper">
            <h1 class="video__title"><?php echo $title; ?></h1>
            <iframe width="560" height="315" src="<?php echo $link; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
        </div>
    </section>
    <?php

    $output = ob_get_contents();
    ob_end_clean();
// Restore original Post Data
    wp_reset_postdata();
    return $output;

}

add_shortcode('vembed', __NAMESPACE__ . '\\create_vembed_shortcode');
