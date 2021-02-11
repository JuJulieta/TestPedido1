<footer class="content-info">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-md-6 col-lg-7">
        <p><?php the_field('footer_text', 'options'); ?></p>
        <span class="whatsapp"><?php the_field('whatsapp', 'options') ?></span><br/>
        <span class="contact_email"><?php the_field('contact_email', 'options') ?></span>
      </div>
      <div class="col-md-6 col-lg-3">
        <img src="<?php bloginfo('template_directory'); ?>/dist/images/logo-footer.svg">
      </div>
    </div>
  </div>

  <div class="footer-fixed-menu">
    <div class="footer-fixed-menu__wrapper">
      <?php
        if (has_nav_menu('footer_fixed')) {
          wp_nav_menu(array('theme_location' => 'footer_fixed'));
        }
      ?>
    </div>

    <button class="footer-fixed-menu__toggler">Eu quero <i class="fa fa-caret-right"></i></button>
  </div>
</footer>
<script type="text/javascript" async src="https://d335luupugsy2.cloudfront.net/js/loader-scripts/4d530131-0800-4335-b933-4743d61f6f6f-loader.js" ></script>
