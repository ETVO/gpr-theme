<?php

function cultura($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $title = get_theme_mod('cultura_title');
    $backimg = get_theme_mod('cultura_backimg');
    $sideimg = get_theme_mod('cultura_sideimg');
    $valores = get_theme_mod('cultura_valores');

    ob_start(); // Start HTML buffering
?>
    <section class="shoco-cultura bg-white">
        <div class="banner" style="background-image: url('<?php echo $backimg; ?>');">
            <img class="w-100" src="<?php echo $backimg; ?>" alt="">
            <div class="overlay">
                <div class="title text-center text-white d-flex">
                    <h2 class="m-auto fw-normal"><?php echo $title; ?></h2>
                </div>
            </div>
        </div>
        <div class="row w-100 m-0 g-0">
            <div class="col-12 col-lg-6 d-flex">
                <div class="valores ms-auto row w-100 m-0 justify-content-end">
                    <?php foreach($valores as $valor): 
                        $image_url = $valor['image'];    
                    ?>
                        <div class="valor col-12 col-md-6 col-lg-4">
                            <div class="icon mb-3">
                                <img src="<?php echo $image_url; ?>" alt="">
                            </div>
                            <div class="title">
                                <h5 class="fs-6"><?php echo $valor['title']; ?></h5>
                            </div>
                            <div class="desc">
                                <?php echo $valor['desc']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="sideimg">
                    <img class="w-100" src="<?php echo $sideimg; ?>" alt="">
                </div>
            </div>
        </div>
    </section>
<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
