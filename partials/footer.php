<?php
/**
 * Footer component
 * 
 * @package WordPress
 */ 

$footer_logo = get_theme_mod('footer_logo');

$social = array(
    array(
        'href' => '',
        'title' => 'Instagram',
        'icon' => 'instagram',
    ),
    array(
        'href' => '',
        'title' => 'LinkedIn',
        'icon' => 'linkedin',
    ),
    array(
        'href' => '',
        'title' => 'Facebook',
        'icon' => 'facebook',
    ),
    array(
        'href' => '',
        'title' => 'YouTube',
        'icon' => 'youtube',
    ),
);
?>

<footer>
    <div class="footer-nav">
        <div class="container col-xl-8 d-flex py-3">
            <div class="brand me-auto p-0">
                <img src="<?php echo $footer_logo; ?>" alt="<?php echo bloginfo('site_title') ?>">
            </div>
            <div class="social me-auto">
                <?php foreach($social as $link): ?>
                    <a
                        class="tlink" 
                        href="<?php echo $link['href']; ?>" 
                        title="<?php echo $link['title']; ?>"
                    >
                        <span class="bi bi-<?php echo $link['icon']; ?>"></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</footer>