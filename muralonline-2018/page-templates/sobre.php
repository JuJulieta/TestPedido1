<?php
/**
 * Template Name: Sobre
 */
?>

<?php while (have_posts()) : the_post(); ?>

  <div class="info">
    <div class="bg-orange">
      <div class="container">
        <h2><?php the_title(); ?></h2>
      </div>
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>

<?php endwhile; ?>
