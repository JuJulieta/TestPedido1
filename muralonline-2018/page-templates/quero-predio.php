<?php
/**
 * Template Name: Predio
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
        <div class="col-md-10">
          <?php the_content(); ?>
        </div>
      </div>

      <?php
        $img_id = get_field('image');
        $img_url = wp_get_attachment_image_src($img_id, 'large');
      ?>
      <img src="<?php echo $img_url[0]; ?>">
    </div>
  </div>

  <div class="info">
    <div class="bg-green">
      <div class="container">
        <h2><?php _e('Conheça a tela', 'sage'); ?></h2>
      </div>
    </div>
    <div class="container map">
      <?php
        $img_id = get_field('meet_image');
        $img_url = wp_get_attachment_image_src($img_id, 'large');
      ?>
      <img src="<?php echo $img_url[0]; ?>">
      <div class="text-center">
        <a href="<?php the_permalink( 190 ); ?>" class="btn">quero no meu prédio</a>
      </div>

      <div class="text-center">
        <h2 class="dialog"><?php _e('Veja as regiões que já estamos presentes', 'sage'); ?></h2>

        <?php the_field('map', 11); ?>

        <br/>
        Selecione o item no mapa para ver mais detalhes
      </div>
    </div>
  </div>

<?php endwhile; ?>
