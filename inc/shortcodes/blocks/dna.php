<?php

function dna($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $dna_image = get_theme_mod('dna_image');
    $dna_title = get_theme_mod('dna_title');
    $dna_text = get_theme_mod('dna_text');

    ob_start(); // Start HTML buffering
?>
    <section class="shoco-dna py-5 bg-white">
        <div class="container col-12 col-md-10 col-xl-8 mx-auto py-3">
            <div class="title text-center mb-4">
                <h2 class="fs-1"><?php echo $dna_title; ?></h2>
            </div>
            <div class="d-flex flex-column flex-lg-row">
                <div class="image mb-4 mb-lg-auto me-lg-4 my-auto">
                    <img src="<?php echo $dna_image; ?>" alt="<?php echo $dna_title; ?>">
                </div>
                <small class="text m-0 ms-lg-5 my-auto">
                    <?php echo $dna_text; ?>
                </small>
            </div>
        </div>
    </section>
<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
