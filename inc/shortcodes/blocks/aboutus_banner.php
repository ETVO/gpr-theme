<?php

function aboutus_banner($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $banner_image = get_theme_mod('banner_image');
    $banner_text = get_theme_mod('banner_text');

    ob_start(); // Start HTML buffering
?>
    <section class="shoco-aboutus-banner" style="background-image: url('<?php echo $banner_image; ?>');">
        <div class="overlay w-100 h-100 d-flex">
            <div class="container m-auto py-5">
                <div class="title text-uppercase">
                    <h1 class="text-white text-center">
                        <?php echo $banner_text; ?>
                    </h1>
                </div>
            </div>
        </div>
    </section>
<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
