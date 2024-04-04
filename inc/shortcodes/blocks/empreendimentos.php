<?php

function empreendimentos($attrs)
{
    $attrs = shortcode_atts(array(), $attrs);

    $id = 'empreendimentosGPR' . rand(0, date('Y'));
    $i = 0;

    $post_type = 'empreendimento';
    $orderby = 'date';
    $order = 'DESC';

    // Posts Per Page (-1 means it shows all)
    $ppp = -1;

    // WP_Query arguments
    $args = array(
        'post_type'              => $post_type,
        'post_status'            => array('publish'),
        'has_password'           => false,
        'posts_per_page'         => $ppp,
        'no_found_posts'         => true,

        // Order ASC first by 'menu_order', only after by 'title' or 'date'
        'orderby'                => array('menu_order' => 'ASC', $orderby => $order),
    );

    // The Query
    $query = new WP_Query($args);

    ob_start(); // Start HTML buffering

    if ($query->have_posts()) {
?>

        <div class="shoco-empreendimentos py-5">
            <div class="container col-12 col-md-10 col-xl-9 pt-3 pb-5 mx-auto">

                <div class="title thin-title text-center">
                    <h2>
                        Empreendimentos
                    </h2>
                </div>

                <div class="posts">
                    <div class="multi-carousel carousel slide items" data-bs-ride="false" id="<?php echo $id; ?>">

                        <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo $id; ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <div class="carousel-inner">
                            <?php
                            while ($query->have_posts()) :

                                $query->the_post();

                                $post = get_post();

                                $permalink = esc_url(get_the_permalink());

                                $image_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
                                $image_alt = get_the_post_thumbnail_caption();

                                // $nome = get_the_title();
                                $nome = get_field('nome_curto');
                                $endereco = get_field('endereco');

                                $caracters = array(
                                    'medidas',
                                    'habitacoes',
                                )


                            ?>
                                <div class="carousel-item <?php if ($i++ == 0) echo "active"; ?>">
                                    <div class="item col-12 col-sm-6 col-lg-4">
                                        <div class="inner">
                                            <div class="image">
                                                <a class="d-block" href="<?php echo $permalink; ?>">
                                                    <img class="w-100" src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                                                </a>
                                            </div>
                                            <div class="info text-start">
                                                <a href="<?php echo $permalink; ?>">
                                                    <h5 class="nome text-black">
                                                        <?php echo $nome; ?>
                                                    </h5>
                                                </a>
                                                <small class="endereco text-uppercase">
                                                    <span class="icon bi-geo-alt-fill"></span>
                                                    <a class="text" target="_blank" href="https://google.com/maps/place/<?php echo $endereco; ?>"><?php echo $endereco; ?></a>
                                                </small>
                                                <div class="action">
                                                    <a href="<?php echo $permalink; ?>" class="me-auto text-uppercase">
                                                        Ver Mais
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endwhile; ?>
                        </div>

                        <button class="carousel-control-next" type="button" data-bs-target="#<?php echo $id; ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Seguinte</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

<?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
