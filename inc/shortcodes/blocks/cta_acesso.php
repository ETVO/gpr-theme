<?php

function cta_acesso($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $image = get_theme_mod('acesso_image');
    $text = get_theme_mod('acesso_text');
    $link = get_theme_mod('acesso_link');

    ob_start(); // Start HTML buffering
?>
    <section class="shoco-cta-acesso">
        <div class="content bg-dark row w-100 g-0 p-0 m-0" style="background-image: url('<?php echo $image; ?>');">
            <div class="image d-block d-lg-none order-last col-12">
                <img src="<?php echo $image; ?>" alt="">
            </div>
            <div class="overlay d-flex col-12">
                <div class="container m-auto">
                    <div class="inner">
                        <div class="title mb-3">
                            <h2 class="fs-1 text-white">Acesso Investidor</h2>
                        </div>
                        <div class="text mb-3">
                            <?php echo $text; ?>
                        </div>
                        <div class="action pt-4">
                            <a href="<?php echo $link ?>">Informações do Investidor</a>
                        </div>
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
