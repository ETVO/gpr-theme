<?php

function empreendimentos($attrs)
{
    $attrs = shortcode_atts(array(
        'max' => 0,
        'show_all' => 0,
        'show_title' => 1,
        'title' => 'Empreendimentos',
        'cols' => 3,
    ), $attrs);

    $show_title = $attrs['show_title'];
    $show_caracters = $attrs['show_caracters'];
    $title = $attrs['title'];
    $cols = $attrs['cols'];

    $item_col_class = 'col-lg-' . round(12 / $cols);
    if ($cols == 4)
        $item_col_class = 'col-md-4 ' . $item_col_class;

    $post_type = 'empreendimento';
    $orderby = 'title';
    $order = 'ASC';

    // Posts Per Page (-1 means it shows all)
    $ppp = -1;
    $show_all = true;
    if (!$attrs['show_all']) {
        $show_all = false;

        if ($attrs['max'] > 0) {
            $ppp = $attrs['max']    ;
        } else {
            $ppp = 3;
        }
    } else {
        $ppp = -1;
    }

    // WP_Query arguments
    $args = array(
        'post_type'              => $post_type,
        'post_status'            => array('publish'),
        'has_password'           => false,
        // 'nopaging'               => $nopaging,
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

        <section class="shoco-empreendimentos pt-3 pb-5 show-all-<?php echo $show_all; ?>">
            <div class="container col-12 col-md-10 col-xl-9 pt-5 mx-auto">
                <?php if ($show_title) : ?>
                    <div class="title thin-title text-center">
                        <h2>
                            <?php echo $title; ?>
                        </h2>
                    </div>
                <?php endif; ?>

                <div class="items row g-3 py-3">
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
                        <div class="item mx-auto col-12 col-sm-6 <?php echo $item_col_class; ?>">
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
                    <?php

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
