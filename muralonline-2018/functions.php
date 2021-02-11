<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/helpers.php', // Theme helpers
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

//Hide Add to cart, order, breadcrumbs and result count
add_action( 'woocommerce_after_shop_loop_item', function(){
  remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
}, 1 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
//Hide tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );          // Remove the description tab
    unset( $tabs['reviews'] );      // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab

    return $tabs;

}

//Taxonomy
// Register Custom Taxonomy
function custom_taxonomy_bairro() {

  $labels = array(
    'name'                       => _x( 'Localização', 'Taxonomy General Name', 'sage' ),
    'singular_name'              => _x( 'Localização', 'Taxonomy Singular Name', 'sage' ),
    'menu_name'                  => __( 'Localização', 'sage' ),
    'all_items'                  => __( 'Todos Localização', 'sage' ),
    'parent_item'                => __( 'Localização superior', 'sage' ),
    'parent_item_colon'          => __( 'Localização superior:', 'sage' ),
    'add_new_item'               => __( 'Agregar Nuevo Localização', 'sage' ),
    'edit_item'                  => __( 'Editar Localização', 'sage' ),
    'update_item'                => __( 'Actualizar Localização', 'sage' ),
    'view_item'                  => __( 'Ver Localização', 'sage' ),
    'add_or_remove_items'        => __( 'Añadir o remover Localização', 'sage' ),
    'popular_items'              => __( 'Localização populares', 'sage' ),
    'search_items'               => __( 'Buscar Localização', 'sage' ),
    'not_found'                  => __( 'Not Found', 'sage' ),
    'no_terms'                   => __( 'No Localização', 'sage' ),
    'items_list'                 => __( 'Items list', 'sage' ),
    'items_list_navigation'      => __( 'Items list navigation', 'sage' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'bairro', array( 'product' ), $args );

}
add_action( 'init', 'custom_taxonomy_bairro', 0 );


//Agregar información adicional

add_action( 'woocommerce_before_add_to_cart_form', "whq_agregar_info", 20 );

function whq_agregar_info(){
  get_template_part('templates/content', 'summary');
}

//Add to cart button text
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );
function woo_custom_cart_button_text() {
  return __( 'QUERO ESTE PLANO', 'woocommerce' );
}

// Replace the 'x' in WooCommerce cart.php with text because 'x' is not helpfull at all for screenreader users, see https://gist.github.com/Willem-Siebe/dc34719917e77fcecbc6.
function wsis_woocommerce_remove_item( $wsis_html, $cart_item_key ) {
  $cart_item_key = $cart_item_key;

  $wsis_html = sprintf( '<a href="%s" class="remove" title="%s"><span class="aaawsis-remove-item">× %s</span></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Excluir', 'woocommerce' ), __( 'Excluir', 'woocommerce' ));

  return $wsis_html;
}

add_filter ( 'woocommerce_cart_item_remove_link', 'wsis_woocommerce_remove_item', 10, 2 );

/**
* Add Continue Shopping Button on Cart Page
* Add to theme functions.php file or Code Snippets plugin
*/
add_action( 'woocommerce_after_cart_table', 'woo_add_continue_shopping_button_to_cart' );
function woo_add_continue_shopping_button_to_cart() {
 $shop_page_url = get_permalink( 71 );

 echo ' <a href="'.$shop_page_url.'" class="button continue">Continuar comprando</a>';
}

//Redirect to shop
function my_custom_add_to_cart_redirect( $url ) {
  $url = get_permalink( 71 );
  return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' );

//Don't include attributes on product title
add_filter( 'woocommerce_product_variation_title_include_attributes', 'custom_product_variation_title', 10, 2 );
function custom_product_variation_title($should_include_attributes, $product){
    $should_include_attributes = false;
    return $should_include_attributes;
}

/**
 * Add a custom field (in an order) to the emails
 */
add_filter( 'woocommerce_email_order_meta_fields', 'custom_woocommerce_email_order_meta_fields', 10, 3 );

function custom_woocommerce_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
    $fields['cpf'] = array(
      'label' => 'CPF',
      'value' => $order->get_meta( '_billing_cpf' )
    );
    $fields['rg'] = array(
      'label' => 'RG',
      'value' => $order->get_meta( '_billing_rg' )
    );
    $fields['empresa'] = array(
      'label' => 'Nome da empresa',
      'value' => $order->get_meta( '_billing_company' )
    );
    $fields['ie'] = array(
      'label' => 'Inscrição Estadual',
      'value' => $order->get_meta( '_billing_ie' )
    );
    $fields['cnpj'] = array(
      'label' => 'CNPJ',
      'value' => $order->get_meta( '_billing_cnpj' )
    );
    return $fields;
}

//Redirect to shop

function custom_shop_page_redirect() {
    if( is_shop() ){
        wp_redirect( get_permalink( 71 ) );
        exit();
    }
}
add_action( 'template_redirect', 'custom_shop_page_redirect' );

/*******Xibo**********/



function get_client_list($layout = "",$page = 1){
  $res = get_media_xibo($layout,$page);
  return $res;
}

function get_my_list($layout = ""){
  global $wpdb;
  $access_token = login_xibo();
  $xibo_table = $wpdb->prefix . "xibo";
  $user = wp_get_current_user();
  $data = array(
            'user_id' => $user->ID
  );
  $results = $wpdb->get_results("SELECT private_key from {$xibo_table} WHERE user_id = {$user->ID}");
  $res = array();
  if ( $results ){
    foreach ( $results as $result){
      $url = get_field('url','option')."/api/library?mediaId={$result->private_key}&access_token=".$access_token;
      $response = wp_remote_get( $url, array('headers' => array('access_token' => $access_token)));
      if ( !is_wp_error( $response ) ) {
         array_push($res, json_decode($response["body"])[0]);
      }
    }
  }
  return $res;
}

function set_client_layer($xibo_id = 0, $layout = "",$name = "", $image = "", $page = 1){
  global $wpdb;
  $xibo_table = $wpdb->prefix . "xibo";
  $user = wp_get_current_user();
  $data = array(
            'user_id' => $user->ID,
            'private_key' => $xibo_id,
            'page' => $page,
            'category' => $layout,
            'assunto' => $name,
            'tempo' => 2,
            'image' => $image,
            'state' => 0
  );
  return $wpdb->insert( $xibo_table, $data);
}

function add_client_layer(){
  $response = set_client_layer($_POST['id']);
  if($response){
    wp_send_json_success($response);
  }else{
    wp_send_json_error($response);
  }
}


function remove_client_layer(){
  global $wpdb;
  $access_token = login_xibo();
  $xibo_table = $wpdb->prefix . "xibo";
  $user = wp_get_current_user();
  $mediaId = $_POST['mediaId'];
  $data = array(
            'private_key' => $mediaId,
            'user_id' => $user->ID
  );
  if($wpdb->delete( $xibo_table, $data)){
    wp_send_json_success( $response, 200 );
  }else{
    wp_send_json_error();
  }
}

function send_selection(){
  $user = wp_get_current_user();
  $selection = $_POST['selection'];
  $to = "jcbustosj@gmail.com";
  $subject = 'Mural Digital Order';
  $body = $selection;
  $headers = array('Content-Type: text/html; charset=UTF-8');
  $status = wp_mail( $to, $subject, $body, $headers );
  if($status){
    wp_send_json_success($status);
  }else{
    wp_send_json_error($status);
  }
}

add_action('wp_ajax_send_selection', 'send_selection');
add_action('wp_ajax_remove_layer', 'remove_client_layer');
add_action('wp_ajax_add_layer', 'add_client_layer');

function get_media_xibo($layout = "", $page = 1){
  $access_token = login_xibo();
  $url = get_field('url','option')."/api/library?access_token=".$access_token;
  if($layout != "")
    $url .= "&tags=".$layout;
  $url .= "&start=".(($page-1)*10);
  $response = wp_remote_get( $url, array('headers' => array('access_token' => $access_token)));
  if ( is_wp_error( $response ) ) {
     return false;
  } else {
     $res = $response;
     $body = json_decode($response["body"]);
     $headers = $response["headers"];
     $total = getProtectedValue($headers, "data")["x-total-count"];
     return array("body" => $body, "total" => $total);
  }
}

function getProtectedValue($obj,$name) {
  $array = (array)$obj;
  $prefix = chr(0).'*'.chr(0);
  return $array[$prefix.$name];
}

function get_categories_xibo($body = array(), $page = 1){
  $access_token = login_xibo();
  $url = get_field('url','option')."/api/library?start={$page}&length=99999&access_token=".$access_token;
  $response = wp_remote_get( $url, array('headers' => array('access_token' => $access_token)));
  $i = 0;
  $categories = array();
  if (!is_wp_error( $response ) ) {
    $body_array = json_decode($response["body"]);
    foreach ($body_array as $value) {
      if (!in_array($value->tags, $categories) && $value->tags != "") {
        array_push($categories, $value->tags);
      }
    }
  }
  return $categories;
}

function get_layout_view_xibo(){
  $access_token = login_xibo();
  $url = get_field('url','option')."/api/layout?access_token=".$access_token;
  $response = wp_remote_get( $url, array('headers' => array(
                                                                'access_token' => $access_token,
                                                                'Authorization' => 'Bearer '.$access_token
                                                            )));
  if ( is_wp_error( $response ) ) {
     return false;
  } else {
     $body = json_decode($response["body"]);
     return $body;
  }
}

function get_layout_xibo($id){
  $access_token = login_xibo();
  $url = get_field('url','option')."/api/layout?layoutId={$id}&access_token=".$access_token;
  $response = wp_remote_get( $url, array('headers' => array(
                                                                'access_token' => $access_token,
                                                                'Authorization' => 'Bearer '.$access_token
                                                            )));
  if ( is_wp_error( $response ) ) {
     return false;
  } else {
     $body = json_decode($response["body"]);
     return $body;
  }
}

function set_library(){
  $file = $_FILES['file'];
  $assunto = $_POST['assunto'];
  $tempo = $_POST['tempo'];
  $category = $_POST['category'];
  $access_token = login_xibo();
  $data = array(
                'files' => $file,
                'name' => $assunto
              );
  $url = get_field('url','option')."/api/library?access_token=".$access_token;
  $file_open = @fopen( $file['tmp_name'], 'r' );
  $file_size = $file['size'];
  $file_data = fread( $file_open, $file_size );
  $args = array(
                  'headers'     => array(
                                        'accept'        => 'application/json',
                                        'content-type'  => $file['type'],
                                        'access_token'  => $access_token,
                                        'Authorization' => 'Bearer '.$access_token
                                      ),
                  'data'        => array('name' => $assunto),
                  'body'        => $file_data
                );
  $response = wp_remote_post($url, $args );
  if ( is_wp_error( $response ) ) {
      wp_send_json_error();
  } else {
      $body = json_decode($response["body"]);
      $mediaId = $body->files[0]->mediaId;
      $url = get_field('url','option')."/api/library/{$mediaId}?access_token=".$access_token;
      $data = array(
                    'mediaId' => $mediaId,
                    'name' => $assunto,
                    'duration' => $tempo,
                    'tags' => $category,
                    'retired' => 0
                );
      $response2 = wp_remote_post( $url, array(
          'method' => 'PUT',
          'timeout' => 4500,
          'redirection' => 5,
          'httpversion' => '1.0',
          'blocking' => true,
          'headers' => array(
                        'access_token'  => $access_token,
                        'Authorization' => 'Bearer '.$access_token
                      ),
          'body' => $data
        )
      );
      if ( is_wp_error( $response2 ) ) {
          wp_send_json_error();
      } else {
        set_client_layer($mediaId, $category ,$assunto, "", 1);
         wp_send_json_success( $response2, 200 );
      }
  }

}

add_action('wp_ajax_set_library_xibo', 'set_library');

function get_libraries_xibo(){
  $page = isset($_GET['page'])?$_GET['page']:"";
  $length = isset($_GET['length'])?$_GET['length']:"";
  $search = isset($_GET['search'])?$_GET['search']:"";
  $categories = isset($_GET['categories'])?$_GET['categories']:"";
  $access_token = login_xibo();
  $url = get_field('url','option')."/api/library?media=".$search."&tags=".$categories."&start=".$start."&length=".$length."&access_token=".$access_token;
  $response = wp_remote_get( $url, array('headers' => array(
                                                              'access_token' => $access_token,
                                                              'Authorization' => 'Bearer '.$access_token
                                                            )));
  if ( is_wp_error( $response ) ) {
     return false;
  } else {
     $body = json_decode($response["body"]);
     return $response["body"];
  }
}

function login_xibo(){
  if(!isset($_SESSION['access_token'])){
    $url = get_field('url','option')."/api/authorize/access_token";
    $data = array(
                  'client_secret' => get_field('secret_id','option'),
                  'client_id' => get_field('client_id','option'),
                  'grant_type' => 'client_credentials'
                );

    $response = wp_remote_post( $url, array(
          'method' => 'POST',
          'timeout' => 4500,
          'redirection' => 5,
          'httpversion' => '1.0',
          'blocking' => true,
          'headers' => array(),
          'body' => $data
        )
    );

    if ( is_wp_error( $response ) ) {
       return false;
    } else {
       $body = json_decode($response["body"]);
       $_SESSION['access_token'] = trim($body->access_token);
       return $_SESSION['access_token'];
    }
  }else{
    return $_SESSION['access_token'];
  }
}

/**
 * Add the field to the checkout
 */
add_filter( 'woocommerce_checkout_fields' , 'woocommerce_checkout_field_editor' );
// Our hooked in function - $fields is passed via the filter!
function woocommerce_checkout_field_editor( $fields ) {
    $fields['billing']['referrer'] = array(
        'label'     => __('Indicado por', 'woocommerce'),
        'placeholder'   => _x('', 'placeholder', 'woocommerce'),
        'required'  => false
    );
    return $fields;
}
