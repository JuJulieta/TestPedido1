<?php
/**
 * Template for displaying search forms in Twenty Eleven
 */
?>
  <form method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label>
    <span class="screen-reader-text"><?php _e('Procurar...', 'sage'); ?></span>
    <input type="search" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Procurar...', 'twentyeleven' ); ?>" />
  </label>

  <input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'sage' ); ?>" />
</form>
