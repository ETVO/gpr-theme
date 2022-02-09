<?php

/**
 * 404 error page template
 * 
 * @package WordPress
 */

get_header();

?>
<div class="inner-404 flex-fill d-flex">

    <div class="m-auto text-center">
        <h1 class="text-primary" style="font-weight: 700; font-size: 5rem;">404</h1>
        <div class="text-muted fw-light" style="font-size: .9rem">Página não encontrada.</div>
        <div style="font-size: .9rem">
            <a href="<?php echo home_url(); ?>">Voltar à Home</a>
        </div>
    </div>

</div>
<?php
get_footer();
