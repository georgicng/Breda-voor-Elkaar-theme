<?php
namespace App;

use WP_Query;

// Create Full width CTA
// Use the shortcode: [caption title="ctiematige kop met een link naar bijvoorbeeld het trainingsaanbod" image="" direction="left"]
//  Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.
//[/caption]
function create_caption_shortcode($atts, $content = null)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'title' => 'Korte titel van een quote oid',
            'image' => '',
            'direction' => 'left',
        ),
        $atts,
        'caption'
    );

    $title = $atts['title'];
    $image = $atts['image'];
    $direction = $atts['direction'];

    if (empty($image) && $direction == "left") {
        $image = App\asset_path("images/b_pattern2.png");
    }

    if (empty($image) && $direction == "right") {
        $image = App\asset_path("images/b_pattern1.png");
    }

    ob_start();

    ?>

<section class="featured">
    <?php if ($direction == "right") {?>
        <div class="featured__content-wrapper">
            <div class="featured__content featured__content_ml">
                <h1 class="featured__title"><?php echo $title; ?></h1>
                <div class="featured__text"><?php echo $content; ?></div>
            </div>
        </div>
        <div class="featured__image-wrapper">
            <img src="<?php echo $image; ?>" class="featured__image">
        </div>
    <?php } else {?>
        <div class="featured__image-wrapper">
            <img src="<?php echo $image; ?>" class="featured__image">
        </div>
        <div class="featured__content-wrapper">
            <div class="featured__content featured__content_mr">
                <h1 class="featured__title"><?php echo $title; ?></h1>
                <div class="featured__text"><?php echo $content; ?></div>
            </div>
        </div>
        <?php }?>
        </section>
    <?php

    $output = ob_get_contents();
    ob_end_clean();
// Restore original Post Data
    wp_reset_postdata();
    return $output;

}

add_shortcode('caption', __NAMESPACE__ . '\\create_caption_shortcode');
