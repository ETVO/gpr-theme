<?php

function arquivos($attrs)
{
    $attrs = shortcode_atts(array(), $attrs);

    $item_col_class = 'col-lg-4';

    $post_type = 'arquivo';
    $orderby = 'date';
    $order = 'ASC';

    // WP_Query arguments
    $args = array(
        'post_type'              => $post_type,
        'post_status'            => array('publish'),
        'has_password'           => false,
        // 'nopaging'               => $nopaging,
        'posts_per_page'         => -1,
        'no_found_posts'         => true,

        // Order ASC first by 'menu_order', only after by 'title' or 'date'
        'orderby'                => array('menu_order' => 'ASC', $orderby => $order),
    );

    // The Query
    $query = new WP_Query($args);

    ob_start(); // Start HTML buffering

    if ($query->have_posts()) {
?>

        <section class="shoco-arquivos pt-3 pb-5">
            <div class="container col-12 col-md-10 col-xl-9 pt-5 mx-auto">

                <div class="items row g-3 py-3">
                    <?php
                    while ($query->have_posts()) :

                        $query->the_post();

                        $post = get_post();

                        $permalink = esc_url(get_the_permalink());

                        $image_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
                        $image_alt = get_the_post_thumbnail_caption();


                        $title = get_the_title();

                        // $nome = get_the_title();
                        $password = get_field('password');
                        $empreendimento = get_field('empreendimento');

                        if (!$image_url) {
                            $image_url = get_the_post_thumbnail_url($empreendimento->ID, 'thumbnail');
                        }

                        $caracters = array(
                            'medidas',
                            'habitacoes',
                        )

                    ?>
                        <div class="item mx-auto col-12 col-sm-6 <?php echo $item_col_class; ?>">
                            <div class="inner">
                                <div class="image">
                                    <img class="w-100" src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                                    <div class="title">
                                        <h5 class="text-white">
                                            <?php echo $title; ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="info text-start">
                                    <form class="form" autocomplete="off" action="<?php echo $permalink; ?>" method="post">
                                        <input autocomplete="false" name="hidden" type="text" style="display:none;">
                                        <div class="password">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Senha:</label>
                                                <input type="password" class="form-control" autocomplete="off" name="password" id="password" required>
                                            </div>
                                        </div>
                                        <div class="action d-flex">
                                            <button type="submit" class="btn btn-outline-primary ms-auto text-uppercase">
                                                Acessar
                                            </button>
                                        </div>
                                    </form>
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
