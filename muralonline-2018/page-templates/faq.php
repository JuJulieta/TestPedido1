<?php
/**
 * Template Name: FAQ
 */
?>

<?php while (have_posts()) : the_post(); ?>

  <div class="bg-orange">
    <div class="container">
      <h2><?php the_title(); ?></h2>
    </div>
  </div>

  <div class="questions">
    <?php if(have_rows('duvidas')) : while(have_rows('duvidas')): the_row(); ?>
      <article class="item">
        <div class="container">
          <h3 class="bg-green"><?php the_sub_field('duvida'); ?></h3>
          <div class="answer"><?php the_sub_field('respuesta'); ?></div>
        </div>
      </article>
    <?php endwhile; endif; ?>
  </div>

<?php endwhile; ?>
