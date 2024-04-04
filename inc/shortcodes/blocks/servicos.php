<?php

function servicos($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $servicos = get_theme_mod('servicos');
    $img = get_theme_mod('servicos_image');
    if(!$img) $img = THEME_IMG_URI . 'eduardo-miranda.webp';
    
    ob_start(); // Start HTML buffering
?>
    <section class="shoco-servicos bg-dark">
        <div class="servicos">
            <div class="title mb-5">
                <h2 class="fw-normal text-white">Serviços prestados pela GPR</h2>
            </div>
            <div class="servicos-wrap">
                <?php foreach ($servicos as $servico) : ?>
                    <div class="d-flex w-100 servico">
                        <span><?php echo $servico['desc']; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <img src="<?= $img; ?>" alt="">
    </section>
<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
