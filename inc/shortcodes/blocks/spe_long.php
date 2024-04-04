<?php

function spe_long($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $image = get_theme_mod('spe_long_image');
    $text = get_theme_mod('spe_long_text');

    ob_start(); // Start HTML buffering
?>
    <section class="shoco-spe-long">
        <div class="strip d-flex py-5 bg-white">
            <div class="container d-flex">
                <div class="strip-inner m-auto d-flex flex-column flex-sm-row">
                    <div class="title mt-auto">SPE:</div>
                    <div class="subtitle text-uppercase mt-auto ms-sm-1">Uma nova forma de investir</div>
                </div>
            </div>
        </div>
        <div class="spe-content bg-dark" style="background-image: url('<?php echo $image; ?>');">
            <div class="image d-block d-lg-none">
                <img src="<?php echo $image; ?>" alt="">
            </div>
            <div class="overlay d-flex">
                <div class="container col-md-10 d-flex m-auto">
                    <div class="text">
                        <?php echo $text; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
