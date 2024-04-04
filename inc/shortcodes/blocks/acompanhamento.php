<?php

function acompanhamento($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $text = get_theme_mod('acompanhamento_text');
    $link = get_theme_mod('acompanhamento_link');
    $image = get_theme_mod('acompanhamento_image');

    ob_start(); // Start HTML buffering
?>
    <section class="shoco-acompanhamento">
        <div class="row g-0 p-0 m-0 w-100">
            <div class="content col-12 col-lg-6 text-white">
                <div class="content-inner">
                    <div class="title mb-3">
                        <h2 class="fs-1">Acompanhamento</h2>
                    </div>
                    <div class="text mb-3">
                        <?php echo $text; ?>
                    </div>
                    <div class="action pt-4">
                        <a href="<?php echo $link ?>">Acesso Investidor</a>
                    </div>
                </div>
            </div>
            <div class="image col-12 col-lg-6">
                <img class="w-100" src="<?php echo $image; ?>" alt="Acompanhamento">
            </div>
        </div>
    </section>
<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
