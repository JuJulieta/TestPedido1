<?php

namespace Roots\Sage\Customizer;

use Roots\Sage\Assets;

/**
 * Add postMessage support
 */
function customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');


/**
 * Jqueryui JS
 */
function jqueryui_js() {
  wp_enqueue_script('sage/jqueryui', Assets\asset_path('scripts/jquery-ui.min.js'), ['jquery-ui'], null, true);
}
add_action('jqueryui_init', __NAMESPACE__ . '\\jqueryui_js');
