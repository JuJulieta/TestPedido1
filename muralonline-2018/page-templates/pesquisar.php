<?php
/**
 * Template Name: Pesquisar
 */
?>

<?php while (have_posts()) : the_post(); ?>

  <div class="bg-green">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <h2><?php the_title(); ?></h2>
          <?php echo get_search_form(); ?>

        </div>
      </div>
    </div>
  </div>

<?php endwhile; ?>
