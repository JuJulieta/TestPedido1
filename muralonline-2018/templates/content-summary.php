<div class="clearfix content-summary">
  <?php $bairros = wp_get_post_terms( $post->ID, 'bairro', array( '' ) ); foreach($bairros as $bairro) echo '<span>' . $bairro->name . '</span>'; ?>
  <span>CEP: <?php the_field('cep'); ?></span>
  <h5>Unidades:</h5>
  <span><?php the_field('unidades'); ?></span>
  <h5>Público-Alvo Estimado:</h5>
  <span><?php the_field('publico'); ?></span>
  <h5>Inserções:</h5>
  <span><?php the_field('insercoes'); ?></span>
</div>
