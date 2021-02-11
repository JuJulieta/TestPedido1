<?php
/**
 * Template Name: Shop
 */
?>

<?php while (have_posts()) : the_post(); ?>

  <section class="filters">
    <div class="container">
      <div class="row">
        <!--<div class="col-md-4">
          <?php echo get_search_form(); ?>
        </div>-->
        <div class="col-md-7 property_filter_selector">
          <!--<input type="text" placeholder="Cidade">-->
          <div class="property_filter_selector_trigger" data-status="empty">Escolha o Estado / Cidade / Bairro</div>
          <div class="property_filter_selector_dropdown">
            <ul>
                <?php
                  $args = array(
                      'taxonomy' => 'bairro',
                  );

                  whq_terms_checklist( 0, $args );
                ?>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <!--<input type="text" placeholder="Filtros">-->
          <select id="property_filter_orderby">
            <option value="" disabled selected>Ordenação padrão</option>
            <option value="name_asc">Nome (asc)</option>
            <option value="name_desc">Nome (dsc)</option>
            <option value="price_asc">Preço (asc)</option>
            <option value="price_desc">Preço (dsc)</option>
            <option value="date_asc">Data de publicação (asc)</option>
            <option value="date_desc">Data de publicação (dsc)</option>
          </select>
        </div>
        <div class="col-md-1">
          <!--<input type="submit" class="submit" name="submit" id="searchsubmit" value="Search">-->
          <div class="property_filter_searchbutton">
            <img src="<?php echo get_template_directory_uri(); ?>/dist/images/icon-search.png" alt="search" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="featured">
    <div class="container">
      <div class="row products">
        <?php
          $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
          $args = array(
            'post_type' => 'product',
            'posts_per_page' => 9,
            'paged' => $paged,
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
              <span><?php the_sub_field('cidade'); ?></span>
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
            </div>
          </div>

          <!--<a href="<?php the_permalink(); ?>" class="btn">Adicionar</a>-->

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
        <?php endwhile;?>
        <div class="pagination">
           <?php
             $big = 999999999; // need an unlikely integer

             echo paginate_links( array(
               'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
               'format' => '?paged=%#%',
               'current' => max( 1, get_query_var('paged') ),
               'total' => $query->max_num_pages,
               'prev_text' => '<',
               'next_text' => '>'
             ) );
           ?>
         </div>
         <?php wp_reset_postdata(); ?>
      </div>
      <div class="row text-center">
        <a href="<?php global $woocommerce; echo $woocommerce->cart->get_cart_url(); ?>" class="gotocart button btn">Finalizar compra</a>
      </div>
    </div>
  </section>

<?php endwhile; ?>
