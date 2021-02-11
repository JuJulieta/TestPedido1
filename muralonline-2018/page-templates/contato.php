<?php
/**
 * Template Name: Contato
 */
?>

<?php while (have_posts()) : the_post(); ?>

  <div class="bg-orange">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-5 text-left">
          <h2><?php the_title(); ?></h2>
        </div>
      </div>
    </div>
  </div>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <?php echo do_shortcode( '[contact-form-7 id="43" title="Formulario de contacto 1"]'); ?>
        </div>
        <div class="col-md-4">
          <img src="<?php bloginfo('template_directory'); ?>/dist/images/map-contato.png">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </section>

<?php endwhile; ?>
