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

    $post_type = 'empreendimento';
    $orderby = 'title';
    $order = 'ASC';

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
        'orderby'                => array('date' => 'ASC', $orderby => $order),
    );

    // The Query
    $query = new WP_Query($args);

    ob_start(); // Start HTML buffering

    if ($query->have_posts()) {

        $posts = $query->posts;
        $post_count = count($posts);

        $id = 'empreGPR' . rand(0, 100);

        $slides_xl = 4;
        $slides_lg = 2;
        $slides_xs = 1;
?>

        <section class="shoco-empreendimentos py-5 px-2">

            <?php if ($show_title) : ?>
                <div class="title thin-title text-center pb-3">
                    <h2>
                        <?php echo $title; ?>
                    </h2>
                </div>
            <?php endif; ?>

            <div class="position-relative">
                <div class="carousel slide items" data-bs-ride="carousel" data-bs-interval="false" data-custom-indicators="false" id="<?php echo $id; ?>">

                    <div class="container col-12 col-md-10 pt-5 mx-auto">
                        <?php
                        generate_slider_inner($posts, $slides_xl, ':xl');
                        generate_slider_inner($posts, $slides_lg, ':lg.xl');
                        generate_slider_inner($posts, $slides_xs, '.lg');
                        ?>
                    </div>

                    <?php
                    generate_slider_indicators($id, $post_count, $slides_xl, ':xl');
                    generate_slider_indicators($id, $post_count, $slides_lg, ':lg.xl');
                    generate_slider_indicators($id, $post_count, $slides_xs, '.lg');
                    ?>

                    <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo $id; ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#<?php echo $id; ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Seguinte</span>
                    </button>
                </div>
            </div>
        </section>

    <?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}


function generate_slider_inner($items, $slide_count, $bp)
{
    $matches = [];
    $start = '';
    preg_match('/:([a-z]{2})*/', $bp, $matches);
    $start = $matches[1];

    $matches = [];
    $stop = '';
    preg_match('/\.([a-z]{2})*/', $bp, $matches);
    $stop = $matches[1];

    $display_class = '';

    if (trim($start) != '') {
        $display_class = "d-toggle";
        $display_class .= " d-none";
        $display_class .= " d-$start-block";

        if (trim($stop) != '') {
            $display_class .= " d-$stop-none";
        }
    } else if (trim($stop) != '') {
        $display_class = "d-toggle";
        $display_class .= " d-block";
        $display_class .= " d-$stop-none";
    }

    ?>
    <div class="carousel-inner <?php echo $display_class; ?>">
        <?php

        $each = 0;
        for ($i = 0; $i < count($items); $i++) {
            if ($each == 0) {
        ?>
                <div class="carousel-item <?php if ($i == 0) echo "active"; ?>">
                    <div class="m-0 row w-100 h-100 justify-content-center">
                    <?php
                }

                $post = $items[$i];

                $permalink = esc_url(get_the_permalink($post->ID));

                $image_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
                $image_alt = get_the_post_thumbnail_caption($post->ID);

                $nome = get_field('nome_curto', $post->ID);
                $endereco = get_field('endereco', $post->ID);

                $caracters = array(
                    'medidas',
                    'habitacoes',
                );

                $slides_xl = 3;
                $slides_lg = 2;
                $slides_xs = 1;

                    ?>
                    <div class="item col-lg-<?php echo round(12 / $slide_count); ?>">
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


                    if ($each == $slide_count - 1) {
                        $each = 0;
                    ?>
                    </div>
                </div>
            <?php
                    } else {
                        $each++;
                    }
                }

                if ($each > 0) {
                    $each = 0;
            ?>
    </div>
    </div>
<?php
                }

?>
</div>
<?php
}

function generate_slider_indicators($target_id, $item_count, $slide_count, $bp)
{
    $matches = [];
    $start = '';
    preg_match('/:([a-z]{2})*/', $bp, $matches);
    $start = $matches[1];

    $matches = [];
    $stop = '';
    preg_match('/\.([a-z]{2})*/', $bp, $matches);
    $stop = $matches[1];

    $display_class = '';

    if (trim($start) != '') {
        $display_class = "d-toggle";
        $display_class .= " d-none";
        $display_class .= " d-$start-flex";

        if (trim($stop) != '') {
            $display_class .= " d-$stop-none";
        }
    } else if (trim($stop) != '') {
        $display_class = "d-toggle";
        $display_class .= " d-flex";
        $display_class .= " d-$stop-none";
    }

?>
    <div class="carousel-indicators <?php echo $display_class; ?>">
        <div class="indicators-wrap">
            <div class="indicators-inner">

                <?php

                $each = 0;
                $slide = 0;
                for ($i = 0; $i < $item_count; $i++) {
                    if ($each == 0) {
                ?>
                        <button type="button" data-bs-target="#<?php echo $target_id; ?>" data-bs-slide-to="<?php echo $slide; ?>" class="<?php if ($i == 0) echo "active"; ?>" aria-current="<?php if ($i == 0) echo "true";
                                                                                                                                                                                                else echo "false"; ?>" aria-label="Slide <?php echo ($slide + 1); ?>">
                        <?php
                        $slide++;
                    }


                    if ($each == $slide_count - 1) {
                        $each = 0;
                        ?>
                        </button>
                    <?php
                    } else {
                        $each++;
                    }
                }

                if ($each > 0) {
                    $each = 0;
                    ?>
                    </button>
                <?php
                }

                ?>
            </div>
        </div>
    </div>
<?php
}
