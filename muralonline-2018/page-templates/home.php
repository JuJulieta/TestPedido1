<?php
/**
 * Template Name: Home
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <section class="slider-home">
    <div class="container text-center">
      <div class="slider-items">
        <?php if(have_rows('banners')) : while(have_rows('banners')): the_row(); ?>
          <article class=".img-wrapper">
            <img src="<?php $img = get_sub_field('imagen'); echo $img['url']; ?>">
          </article>
        <?php endwhile; endif; ?>
      </div>
      <div class="marquee">
        <span><?php the_field('marquee'); ?></span>
      </div>
    </div>
  </section>

  <section class="search-section bg-green">
    <div class="container">
      <h2><?php the_field('text_search'); ?></h2>
      <?php echo get_search_form(); ?>
    </div>
  </section>

  <section class="featured">
    <div class="container">
      <div class="text-center">
        <h2 class="dialog green"><?php _e('Destaques do mês', 'sage'); ?></h2>
        <p><?php the_field('text_destaques'); ?></p>
      </div>

      <div class="row products">
        <?php
          $args = array(
            'post_type' => 'product',
            'posts_per_page' => 3,
            'product_cat' => 'destaques'
          );
          $query = new WP_Query($args);
          while($query->have_posts()) : $query->the_post();
        ?>
        <article class="col-md-4 item">
          <div class="img-wrapper">
            <?php the_post_thumbnail(); ?>
          </div>
          <div class="wrapper">
            <div class="text">
              <h4><?php the_title(); ?></h4>
              <?php $bairros = wp_get_post_terms( $post->ID, 'bairro', array( '' ) ); foreach($bairros as $bairro) echo '<span>' . $bairro->name . '</span>'; ?>
              <span>CEP: <?php the_field('cep'); ?></span>
              <h5>Unidades:</h5>
              <span><?php the_field('unidades'); ?></span>
              <h5>Público-Alvo Estimado:</h5>
              <span><?php the_field('publico'); ?></span>
              <h5>Inserções:</h5>
              <span><?php the_field('insercoes'); ?></span>
            </div>
            <div class="dialog">
              <div>
                <span>POR</span><span>R$</span><h3><?php $_product = wc_get_product( $post->ID ); echo $_product->get_price(); ?></h3>
              </div>
              <h4>Monitor/Trimestre</h4>
              <h4>MENSAL</h4>
            </div>
          </div>

          <div class="wc_add_to_cart_with_variations">
          <?php
          echo apply_filters( 'woocommerce_variable_add_to_cart',
            sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s btn">%s</a>',
              esc_url( $_product->add_to_cart_url() ),
              esc_attr( isset( $quantity ) ? $quantity : 1 ),
              esc_attr( $_product->get_id() ),
              esc_attr( $_product->get_sku() ),
              esc_attr( isset( $class ) ? $class : 'button' ),
              esc_html( $_product->add_to_cart_text() )
            ),
          $_product );
          ?>
          </div>

        </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>

  <section class="ads-info">
    <div class="container">
      <div class="text-center">
        <h2 class="dialog orange"><?php the_field('title_anunciar'); ?></h2>
        <p><?php the_field('text_anunciar'); ?></p>
      </div>
      <div class="dialogs row">
        <?php if(have_rows('steps')) : while(have_rows('steps')): the_row(); ?>
          <div class="col-sm-6 col-lg-3">
            <h2><?php the_sub_field('title'); ?></h2>
            <?php the_sub_field('text'); ?>
          </div>
        <?php endwhile; endif; ?>
      </div>

      <div class="text-center">
        <a href="<?php the_permalink( 71 ); ?>" class="btn"><?php _e('Clique aqui e anuncie agora', 'sage'); ?></a>
      </div>
    </div>
  </section>

  <section class="ads-info ads-info--alt">
    <div class="container">
      <div class="text-center">
        <h2 class="dialog orange"><?php the_field('title_condominio'); ?></h2>
        <p><?php the_field('text_condominio'); ?></p>
      </div>

      <div class="text-center--alt">
        <a href="<?php the_permalink( 44 ); ?>" class="btn">Clique aqui e fale com nosso consultor</a>
      </div>

      <div class="text-center link-termos">
        <a href="<?php the_permalink( 798 ); ?>"><?php _e('Termos de uso', 'sage'); ?></a>
      </div>
    </div>
  </section>

<?php endwhile; ?>
