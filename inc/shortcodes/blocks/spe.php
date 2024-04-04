<?php

function spe($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $spe_logo = get_theme_mod('spe_logo');
    $spe_text = get_theme_mod('spe_text');

    ob_start(); // Start HTML buffering
?>
    <section class="shoco-spe py-5 bg-dark">
        <div class="container col-12 col-md-10 col-xl-8 mx-auto py-3">
            <div class="d-flex flex-column flex-lg-row text-light">
                <div class="image mb-4 mb-lg-auto me-lg-4 my-auto">
                    <img src="<?php echo $spe_logo; ?>" alt="<?php echo $spe_logo; ?>">
                </div>
                <small class="text m-0 ms-lg-5 my-auto">
                    <?php echo $spe_text; ?>
                </small>
            </div>
        </div>
    </section>
<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
