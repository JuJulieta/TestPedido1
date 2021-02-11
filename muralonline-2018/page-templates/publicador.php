<?php
/**
 * Template Name: Publicador
 */
?>

<?php while (have_posts()) : the_post(); ?>

  <div class="bg-green">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <h2><?php the_title(); ?></h2>
          <?php the_content(); ?>
          <?php if(is_page(13)): ?>
            <a href="<?php the_permalink( 122 ); ?>">Cadastrar-se</a>
          <?php endif; ?>
          <a href="<?php echo get_site_url(); ?>"><?php _e('Voltar para o site www.muraldigitalonline.com.br', 'sage'); ?></a>
        </div>
      </div>
    </div>
  </div>

<?php endwhile; ?>
