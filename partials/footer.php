<?php

/**
 * Footer component
 * 
 * @package WordPress
 */

$footer_logo = get_theme_mod('footer_logo');

$social = get_theme_mod('info_social');

$phone = get_theme_mod('info_telefone');
$whatsapp = get_theme_mod('info_whatsapp');
$address = get_theme_mod('info_endereco');

$chars = ['(', ')', ' ', '-', '+'];
$phone_link = str_replace($chars, '', $phone);
$whatsapp_link = str_replace($chars, '', $whatsapp);

$address_map = "https://google.com/maps/place/" . htmlspecialchars(strip_tags(str_replace('</p>', '+', $address)));

if (substr('$whatsapp_link', 0, 2) != '55') $whatsapp_link = '55' . $whatsapp_link;

?>

<footer>
    <div class="footer-nav">
        <div class="container col-xl-8 d-flex py-3 flex-column flex-md-row">
            <div class="brand mx-auto mb-3 mb-lg-0 ms-lg-0 me-lg-5 p-0">
                <img src="<?php echo $footer_logo; ?>" alt="<?php echo bloginfo('site_title') ?>">
            </div>
            <div class="social mx-auto ms-lg-0">
                <?php foreach ($social as $link) : ?>
                    <a class="tlink" href="<?php echo $link['href']; ?>" title="<?php echo $link['icon']; ?>">
                        <span class="bi bi-<?php echo $link['icon']; ?>"></span>
                    </a>
                <?php endforeach; ?>
            </div>



            <div class="navbar navbar-expand-lg d-none d-lg-block">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'    => 'footer_menu',
                        'depth'             => 2,
                        'container_class'   => 'ms-auto',
                        'menu_class'        => 'navbar-nav',
                        'walker'            => new BS_Menu_Walker()
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="footer-info">
        <div class="container col-xl-8 d-flex py-3 flex-column flex-md-row">
            <div class="phones me-md-4 text-center">
                <a href="tel:<?php echo $phone_link; ?>" target="_blank">
                    <h5 class="mb-1"><?php echo $phone; ?></h5>
                </a>
                <a href="https://api.whatsapp.com/send/?phone=<?php echo $whatsapp_link; ?>" target="_blank">
                    <span class="bi-whatsapp"></span>&nbsp;
                    <?php echo $whatsapp; ?>
                </a>
            </div>
            <div class="address mt-3 mt-md-auto ms-md-0 m-auto text-center text-md-start">
                <a target="_blank" href="<?php echo $address_map; ?>">
                    <?php echo $address; ?>
                </a>    
            </div>
        </div>
    </div>
    <div class="footer-bottom d-flex py-3">
        <span class="m-auto text-uppercase">
            <?php echo date('Y'); ?> © GPR Investimentos Imobiliários&nbsp;&bull;&nbsp;Desenvolvido por <a href="https://imobmark.com.br/">Imobmark</a>
        </span>
    </div>
</footer>