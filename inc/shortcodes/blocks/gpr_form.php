<?php

function gpr_form($attrs)
{
    $attrs = shortcode_atts([], $attrs);

    $form_image = get_theme_mod('form_image');

    ob_start(); // Start HTML buffering
?>
    <section class="shoco-gpr-form" style="background-image: url('<?php echo $form_image; ?>');">
        <div class="wrap d-flex py-5">
            <!-- <img src="<?php echo $form_image; ?>" alt=""> -->
            <div class="container col-12 col-md-10 col-xl-9 d-flex m-auto">
                <div class="form-content my-auto">
                    <div class="title">
                        <h2 class="text-center text-primary">Entre em contato</h2>
                    </div>
                    <div class="form">
                        <form action="" onsubmit="return false">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="nome" placeholder="Nome Sobrenome">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="seuemail@exemplo.com.br">
                            </div>
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone:</label>
                                <input type="text" class="form-control" id="telefone" placeholder="(00) 9 9999 9999">
                            </div>
                            <div class="mb-3">
                                <label for="mensagem" class="form-label">Mensagem:</label>
                                <textarea class="form-control" id="mensagem" rows="3" placeholder="Mensagem"></textarea>
                            </div>
                            <div class="pt-2 d-flex">
                                <button class="btn btn-primary rounded-pill ms-auto">
                                    Enviar <span class="bi-chevron-right"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
