<header class="banner">
  <div class="container">
    <div class="logo-responsive">
      <h1 class="logo-responsive__title"><a href="<?php echo esc_url(site_url('/')) ?>"><?php bloginfo('name'); ?></a></h1>
    </div>

    <div class="row align-items-center">
      <div class="col-md-10">
        <?php echo do_shortcode('[ubermenu config_id="main" menu="19"]') ?>
      </div>

      <div class="col-md-2">
        <ul class="header-meta-menu">
          <li class="header-meta-menu__item header-meta-menu__item--account">
            <a href="<?php the_permalink( 195 ); ?>"><i class="far fa-user"></i></a>
          </li>
          <li class="header-meta-menu__item header-meta-menu__item--search">
            <a href="<?php the_permalink( 71 ); ?>"><i class="fas fa-search"></i></a>
          </li>
          <li class="header-meta-menu__item header-meta-menu__item--cart">
            <a href="<?php echo wc_get_cart_url(); ?>">
              <i class="fas fa-shopping-cart"></i>
              <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>
