<?php
/**
 * Template Name: Fale conosco
 */
?>

<?php while (have_posts()) : the_post(); ?>

  <section class="lamina">
    <div class="container">
      <h3><?php the_title(); ?></h3>
      <?php echo do_shortcode( '[contact-form-7 id="183" title="Prospectar"]', false ); ?>
    </div>
  </section>
<?php endwhile; ?>
