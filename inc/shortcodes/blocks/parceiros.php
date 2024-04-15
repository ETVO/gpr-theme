<?php

function parceiros($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $parceiros_image = get_theme_mod('parceiros_image');
    $parceiros_title = get_theme_mod('parceiros_title');

    ob_start(); // Start HTML buffering
?>
    <section class="shoco-dna py-5 bg-white">
        <div class="container col-12 col-md-10 col-xl-8 mx-auto py-3">
            <div class="title text-center mb-4">
                <h2 class="fs-1"><?php echo $parceiros_title; ?></h2>
            </div>
            <div class="d-flex flex-column flex-lg-row">
                <div class="image m-auto">
                    <img class="w-100" src="<?php echo $parceiros_image; ?>" alt="<?php echo $parceiros_title; ?>">
                </div>
            </div>
        </div>
    </section>
<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
