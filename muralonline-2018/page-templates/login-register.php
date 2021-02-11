<?php
/**
 * Template Name: Login / Register
 */
?>

<?php while (have_posts()) : the_post(); ?>

  <div class="bg-green">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h2>Login</h2>
          <strong class="nowrap"><?php echo do_shortcode( '[wppb-login]' ); ?></strong>
          <a href="<?php echo get_site_url(); ?>"><?php _e('Voltar para o site www.muraldigitalonline.com.br', 'sage'); ?></a>
        </div>
        <div class="col-md-6">
          <h2>CADASTRAR-SE</h2>
          <strong class="nowrap"><?php echo do_shortcode( '[wppb-register]' ); ?></strong>
        </div>
      </div>
    </div>
  </div>

<?php endwhile; ?>
