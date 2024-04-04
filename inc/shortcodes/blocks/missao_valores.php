<?php

function missao_valores($attrs)
{
  $attrs = shortcode_atts([], $attrs);

  $missao = get_theme_mod('missao');
  if(!$missao) $missao = 'Ser uma opção de aplicação financeira rentável aos investidores, através de projetos imobiliários em Florianópolis na modalidade preço de custo.';
  
  $valores = get_theme_mod('valores');
  if(!$valores) $valores = 'Até 2027, ser reconhecida como uma empresa referência no mercado imobiliário de Florianópolis, pela credibilidade na idealização de projetos imobiliários na modalidade preço de custo.';

  ob_start(); // Start HTML buffering
?>
  <section class="shoco-missao">

    <div class="container col-12 col-md-10 col-xl-8 mx-auto py-3">
      <div class="row g-4 g-lg-5">
        <div class="col-12 col-lg-6">
          <div class="inner">
            <h3>Missão:</h3>
            <p><?= $missao ?></p>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="inner">
            <h3>Valores:</h3>
            <p><?= $valores ?></p>
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
