<?php

function servicos($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $servicos = get_theme_mod('servicos');

    ob_start(); // Start HTML buffering
?>
    <section class="shoco-servicos py-5 bg-dark">
        <div class="container col-12 col-md-10 col-xl-8 mx-auto py-3">
            <div class="title text-center mb-5">
                <h2 class="fw-normal text-white">Serviços prestados pela GPR</h2>
            </div>
            <div class="row g-3">
                <?php foreach($servicos as $servico): ?>
                    <div class="col-12 col-md-6 col-lg-4 mx-auto px-2">
                        <div class="servico">
                            <span><?php echo $servico['desc']; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
