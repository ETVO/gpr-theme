<?php

/**
 * Page template
 * 
 * @package WordPress
 */

if(isset($_POST['password'])) {
    $entered_pass = md5($_POST['password']);

    $actual_pass = md5(get_field('password'));

    if($entered_pass != $actual_pass) {
        $url = home_url('investidor');
        echo "<script>alert('Senha incorreta! Tente novamente.'); window.location.href = '$url';</script>";
    }
}
else {
    wp_redirect(home_url('investidor'));
}

get_header();

$image = get_field('image');

if(!$image) {
    $image = get_the_post_thumbnail_url(get_field('empreendimento')->ID, 'large');
}

$subtitle = 'Acesso Investidor';
$title = get_the_title();
?>

<div class="arquivo-wrap">
    <div class="arquivo-heading" style="background-image: url('<?php echo $image; ?>');">
        <div class="overlay d-flex">
            <div class="container m-auto d-flex ">
                
                <div class="content m-auto ms-0">
                    <a href="<?php echo home_url('investidor'); ?>" class="subtitle text-decoration-none"><?php echo $subtitle; ?></a>
                    <h1 class="title"><?php echo $title; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container col-xl-9 py-5">


        <div class="arquivo-title d-flex mb-5">
            <span class="back-btn d-flex">
                <a href="<?php echo home_url('investidor'); ?>" class="my-auto">
                    <img src="<?php echo THEME_IMG_URI . '/seta.svg'; ?>" alt="">
                </a>
            </span>
            <span class="m-auto text">
                <h2 class="fw-normal mb-0">Arquivo</h2>
            </span>
        </div>

        <div class="arquivo-content">
            <?php
            the_content();
            ?>
        </div>
    </div>
</div>

<?php

get_footer();
