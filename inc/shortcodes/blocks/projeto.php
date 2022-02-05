<?php

function projeto($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $etapas = get_theme_mod('projeto_etapas');
    $timeline = get_theme_mod('projeto_timeline');
    
    ob_start(); // Start HTML buffering
?>
    <section class="shoco-projeto py-5 bg-white">
        <div class="container col-12 col-md-10 col-xl-9 mx-auto py-3">
            <div class="row w-100 m-0 mb-4">
                <?php foreach($etapas as $etapa): 
                    $icon_url = wp_get_attachment_image_src($etapa['icon'], 'large')[0];   
                ?>

                <div class="col-12 col-md-6 col-lg-3 etapa text-center">
                    <div class="title mb-3">
                        <h5 class="fw-bold text-black"><?php echo $etapa['title']; ?></h5>
                    </div>
                    <div class="icon mb-3">
                        <img src="<?php echo $icon_url; ?>" alt="">
                    </div>
                    <div class="desc">
                        <?php echo $etapa['desc']; ?>
                    </div>
                </div>
                    
                <?php endforeach; ?>
            </div>
            <div class="timeline d-none d-lg-block">
                <img class="w-100" src="<?php echo $timeline; ?>" alt="">
            </div>
        </div>
    </section>
<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
