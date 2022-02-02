<?php

function empreendimentos_list($attrs)
{
    $attrs = shortcode_atts(array(), $attrs);

    $title = $attrs['title'];

    $post_type = 'empreendimento';
    $orderby = 'title';
    $order = 'ASC';

    // Posts Per Page (-1 means it shows all)

    // WP_Query arguments
    $args = array(
        'post_type'              => $post_type,
        'post_status'            => array('publish'),
        'has_password'           => false,
        'no_found_posts'         => true,

        // Order ASC first by 'menu_order', only after by 'title' or 'date'
        'orderby'                => array('menu_order' => 'ASC', $orderby => $order),
    );

    // The Query
    $query = new WP_Query($args);

    ob_start(); // Start HTML buffering

    if ($query->have_posts()) {
?>

        <section class="shoco-empreendimentos-list">
            <div class="">

                <div class="items">
                    <?php
                    $i = 0;
                    while ($query->have_posts()) :

                        $query->the_post();

                        $post = get_post();

                        $permalink = esc_url(get_the_permalink());

                        $title = get_the_title();

                        // $nome = get_the_title();
                        $nome = get_field('nome_curto');
                        $endereco = get_field('endereco');
                        $dormitorios = get_field('dormitorios');
                        $metragem = get_field('metragem');
                        $area = get_field('area');
                        $images = get_field('images');

                        $destaque = get_post_meta(get_the_ID(), 'empreendimento_destaque', true);

                        $caracters = array(
                            'medidas',
                            'habitacoes',
                        )

                    ?>
                        <div class="item d-flex <?php if ($i % 2 == 0) echo 'bg-white'; ?>">
                            <div class="inner container col-12 col-md-10 col-xl-9 mx-auto py-5">
                                <div class="images d-flex mb-2">
                                    <div class="empha">
                                        <img src="<?php echo $images['image_1']['url']; ?>" alt="<?php echo $images['image_1']['caption']; ?>">
                                    </div>
                                    <div class="side d-flex flex-row flex-lg-column">
                                        <img src="<?php echo $images['image_2']['url']; ?>" alt="<?php echo $images['image_2']['caption']; ?>">
                                        <img src="<?php echo $images['image_3']['url']; ?>" alt="<?php echo $images['image_3']['caption']; ?>">
                                    </div>
                                </div>
                                <div class="info p-1">
                                    <div class="title">
                                        <a href="<?php echo $permalink; ?>">
                                            <h2 class="nome text-black">
                                                <?php echo $title; ?>
                                            </h5>
                                        </a>
                                    </div>

                                    <small class="endereco text-uppercase">
                                        <span class="icon bi-geo-alt-fill"></span>
                                        <a class="text" target="_blank" href="https://google.com/maps/place/<?php echo $endereco; ?>"><?php echo $endereco; ?></a>
                                    </small>

                                    <div class="meta d-flex flex-column flex-md-row mt-3">
                                        <div class="std me-4 pe-4 border-end">
                                            <div class="carac d-flex">
                                                <img src="<?php echo THEME_IMG_URI . '/dormitorios.png'; ?>" alt="">
                                                <span><?php echo $dormitorios; ?></span>
                                            </div>
                                            <div class="carac d-flex">
                                                <img src="<?php echo THEME_IMG_URI . '/metragem.png'; ?>" alt="">
                                                <span><?php echo $metragem; ?></span>
                                            </div>
                                            <div class="carac d-flex">
                                                <img src="<?php echo THEME_IMG_URI . '/area.png'; ?>" alt="">
                                                <span><?php echo $area; ?></span>
                                            </div>
                                        </div>
                                        <div class="custom">
                                            <?php foreach ($destaque as $carac) : ?>
                                                <div class="carac d-flex">
                                                    <img src="<?php echo $carac['icon'] ?>" alt="">
                                                    <span><?php echo $carac['desc']; ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="action mt-3">
                                        <a href="<?php echo $permalink; ?>" class="me-auto text-uppercase">
                                            Ver Mais
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $i++;
                    endwhile;
                    ?>
                </div>
            </div>
        </section>

<?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
