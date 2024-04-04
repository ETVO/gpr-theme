<?php

function address_map($attrs, $content) {
    $attrs = shortcode_atts( array(
    ), $attrs );

    $address = get_theme_mod('contato_address', 'GPR Investimentos Imobiliários');

    $map_address = htmlspecialchars(strip_tags(str_replace('</p>', '+', $address)));

    $map_url = "https://maps.google.com/maps?q=" . $map_address 
    . "&t=m&mrt=yp&z=15&output=embed&iwloc=addr&msa=0";

    $directions_url = "https://www.google.com/maps/dir//$map_address";
    
    $logo = get_theme_mod( 'contato_map_logo' );

    $show_address = $address;
    
    ob_start(); // Start HTML buffering
    
    if($address):
    ?>

        <section class="shoco-address-map">
            <div class="overlay d-flex">
                <div class="m-auto">
                    <div class="logo mb-4 mb-md-5">
                        <img src="<?php echo $logo; ?>" alt="">
                    </div>
                    <div class="address mb-4">
                        <?php echo $show_address; ?>
                    </div>
                    <div class="action text-center">
                        <a href="<?php echo $directions_url; ?>" target="_blank">
                            Como chegar
                        </a>
                    </div>
                </div>
            </div>

            <iframe frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="<?php echo $map_url; ?>" title="<?php echo $map_address; ?>" aria-label="<?php echo $address ?>">
            </iframe>
        </section>

    <?php
    endif;

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}