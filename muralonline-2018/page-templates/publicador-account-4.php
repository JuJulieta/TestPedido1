<?php
/**
 * Template Name: Publicador Account 4
 */
?>

<?php while (have_posts()) : the_post(); ?>

  <!--<div class="bg-green">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-5 text-left">
          <h2><?php _e('Publicador ;)', 'sage'); ?></h2>
        </div>
        <div class="col-md-4  text-left text-sm-right">
          <h2><?php _e('Olá', 'sage'); ?> Sr.Walter</h2>
          <span>Condomínio Costa Marina</span>
        </div>
      </div>
    </div>
  </div>-->

  <section class="container button-back">
    <a href="<?php the_permalink( 15 ); ?>" class="btn"><?php _e('<< VOLTAR', 'sage'); ?></a>
  </section>

  <section class="lamina">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ">
          <h3><?php _e('LÂMINA PERSONALIZADA', 'sage'); ?></h3>
          <?php echo do_shortcode( '[contact-form-7 id="125" title="Lâmina personalizada"]', false ); ?>
        </div>
      </div>
    </div>
  </section>
<?php endwhile; ?>
