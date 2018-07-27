<?php
namespace App;

use WP_Query;

// Create Full width CTA
// Use the shortcode: [cta text="Actiematige kop met een link naar bijvoorbeeld het trainingsaanbod" link="" button_text="bekijk"]
function create_cta_shortcode($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'text' => 'Actiematige kop met een link naar bijvoorbeeld het trainingsaanbod',
            'link' => '#',
            'button_text' => 'bekijk',
        ),
        $atts,
        'cta'
    );

    $text = $atts['text'];
    $link = $atts['link'];
    $button_text = $atts['button_text'];

    ob_start();

    ?>
    <section class="cta">
        <div class="cta__wrapper">
            <h1 class="cta__text"><?php echo $text; ?></h1>
            <a href="<?php echo $link; ?>" class="btn cta__button"><?php echo $button_text ?></a>
        </div>
    </section>
    <?php

    $output = ob_get_contents();
    ob_end_clean();
// Restore original Post Data
    wp_reset_postdata();
    return $output;

}

add_shortcode('cta', __NAMESPACE__ . '\\create_cta_shortcode');
