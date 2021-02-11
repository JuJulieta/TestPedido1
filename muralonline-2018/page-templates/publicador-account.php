<?php
/**
 * Template Name: Publicador Account
 */
?>

<?php while (have_posts()) : the_post(); ?>

<?php $categories = get_categories_xibo(); ?>
<?php $libraries = get_libraries_xibo(); ?>
  <div class="bg-green">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-5 text-left">
          <h2><?php _e('Banco de conteúdos ;)', 'sage'); ?></h2>
        </div>
        <div class="col-md-4  text-left text-sm-right">
          <h2><?php _e('Olá ', 'sage'); $user = wp_get_current_user(); echo $user->user_firstname . ' ' . $user->user_lastname; ?></h2>
          <h3><?php echo do_shortcode( '[user_meta key="empresa"]', false ); ?></h3>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
  jQuery(function  () {
          var categories_filter = document.getElementById("category_filter");
          <?php if(isset($_GET['layout'])){ ?>
            categories_filter.value = "<?php echo $_GET['layout']; ?>";
          <?php } ?>
          categories_filter.addEventListener("change", function() {
              if(categories_filter.value == "")
              {
                  window.location.href = "<?php echo get_permalink( 15 ); ?>";
              }else{
                  window.location.href = "<?php echo get_permalink( 15 ); ?>?layout="+categories_filter.value;
              }
          });
        });
</script>
  <section class="filters">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-5">
          <select name="" id="category_filter">
            <option value=""><?php _e('Categorias','sage'); ?></option>
            <?php foreach ($categories as $value) { ?>
              <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-5 pull-right text-center btn-add">
          <a href="<?php echo get_permalink( 41 ) ?>" class=""><?php _e('Solicitar Lâmina Personalizada', 'sage'); ?></a>

        </div>
      </div>
    </div>
  </section>

  <section class="ads">
    <div class="container">
      <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <script type="text/javascript">
                    function set_library(){
                      var formData = new FormData()
                      formData.append("file",jQuery("#file")[0].files[0]);
                      formData.append("action", "set_library_xibo");
                      formData.append("assunto", jQuery(".assunto").val());
                      formData.append("tempo", jQuery(".tempo").val());
                      formData.append("category", jQuery(".category").val());
                      jQuery.ajax({
                        url : "<?php echo admin_url( 'admin-ajax.php' ) ?>",
                        type: 'post',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                        success: function(resultado){
                          location.reload();
                        }

                      });
                    }
                    function remove_layer(mediaId){
                      if(confirm("<?php _e('você realmente quer eliminar a imagem?', 'sage'); ?>")){
                        var formData = new FormData()
                        formData.append("mediaId",mediaId);
                        formData.append("action", "remove_layer");
                        jQuery.ajax({
                          url : "<?php echo admin_url( 'admin-ajax.php' ) ?>",
                          type: 'post',
                          data: formData,
                          async: false,
                          cache: false,
                          contentType: false,
                          enctype: 'multipart/form-data',
                          processData: false,
                          success: function(resultado){
                            location.reload();
                          }

                        });
                      }
                    }


                    function add_layer(mediaId){
                      var formData = new FormData()
                      formData.append("id",mediaId);
                      formData.append("action", "add_layer");
                      jQuery.ajax({
                        url : "<?php echo admin_url( 'admin-ajax.php' ) ?>",
                        type: 'post',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                        success: function(resultado){
                          location.reload();
                        }
                      });
                    }

                    function send(){
                      var table = jQuery("#myOrder").html();
                      var formData = new FormData()
                      formData.append("selection","<table>"+table+"</table>");
                      formData.append("action", "send_selection");
                      jQuery.ajax({
                        url : "<?php echo admin_url( 'admin-ajax.php' ) ?>",
                        type: 'post',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                        success: function(resultado){
                          jQuery("#message").html("<?php _e("Obrigado, pedido enviado!", "sage"); ?>");
                        }
                      });

                    }
                  </script>
                  <div class="modal-header text-center">
                      <h4 class="modal-title w-100 font-weight-bold"><?php _e('Solicitar lâmina', 'sage'); ?></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body mx-4">
                      <div class="md-form mb-12">
                          <label data-error="wrong" data-success="right" for="orangeForm-name"><?php _e('Assunto', 'sage'); ?></label>
                          <input type="text" id="orangeForm-name" class="form-control validate assunto">
                      </div>
                      <div class="md-form mb-12">
                          <label data-error="wrong" data-success="right" for="orangeForm-tempo"><?php _e('Tempo', 'sage'); ?></label>
                          <input type="number" id="orangeForm-tempo" class="form-control validate tempo">
                      </div>
                      <div class="md-form mb-12">
                          <label data-error="wrong" data-success="right" for="orangeForm-previsualizacao"><?php _e('Pré-Visualizaçao', 'sage'); ?></label>
                          <input type="file" id="file" class="form-control">
                      </div>
                      <div class="md-form mb-12">
                        <label data-error="wrong" data-success="right" for="orangeForm-category"><?php _e('Category', 'sage'); ?></label>
                        <select id="orangeForm-category" class="form-control category">
                            <option value="">----</option>
                          <?php foreach ($categories as $value) { ?>
                            <option value="<?php echo $value->name; ?>"><?php echo $value->name; ?></option>
                          <?php } ?>
                        </select>
                      </div>

                  </div>
                  <div class="modal-footer d-flex justify-content-center">
                      <button class="btn btn-deep-orange" onclick="set_library();">Guardar</button>
                  </div>
              </div>
          </div>
      </div>
      <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
      <script type="text/javascript">
        jQuery(function  () {
          jQuery("#draggable").sortable({
              items: "> tr",
              helper: "clone"
          })
        });
      </script>
      <?php
        if(isset($_GET['start'])){
          $start = $_GET['start'];
        }else{
          $start = 1;
        }
      ?>
      <?php $layers = get_client_list($_GET['layout'],$start); ?>
      <?php $mylayers = get_my_list($_GET['layout']); ?>
      <style type="text/css">
        .tab, .btn-add{
          background: #54b089;
          color: #fff;
          font-weight: 900;
          padding: 0 2rem;
          border-radius: 20px;
          font-size: 1.25rem;
          height: 2.625rem;
          line-height: 2.625rem;
          text-transform: uppercase;
          cursor: pointer;
          margin-right: 20px;
        }

        .tab.active{
          background: #147049;
        }

        .tab a, .btn-add a{
          text-decoration: none;
          color: #fff;
        }
      </style>
      <div class="ads-buttons text-center">
      </div>
      <ul class="nav nav-tabs">
        <li class="tab active"><a class="active" data-toggle="tab" href="#list" onclick="jQuery('.tab').toggleClass('active')"><?php _e("BANCO DE LÂMINAS","sage"); ?></a></li>
        <li class="tab"><a data-toggle="tab" href="#cart" onclick="jQuery('.tab').toggleClass('active')"><?php _e("Suas lâminas ativas","sage"); ?></a></li>
      </ul>

      <div class="tab-content">
        <div id="list" class="tab-pane fade in active show">
          <table>
            <thead>
              <tr>
                <th><?php _e('lâmina', 'sage'); ?></th>
                <th><?php _e('Categoria', 'sage'); ?></th>
                <th><?php _e('Assunto', 'sage'); ?></th>
                <th><?php _e('Pré-Visualizaçao', 'sage'); ?></th>
                <th><?php _e('Remover', 'sage'); ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($layers["body"] as $value) { ?>
              <tr>
                <td><?php echo $value->mediaId; ?></td>
                <td><?php echo $value->tags; ?></td>
                <td><?php echo $value->name; ?></td>
                <td><img src="<?php echo get_field('url','option'); ?>/api/library/download/<?php echo $value->mediaId ?>?preview=1&access_token=<?php echo $_SESSION['access_token']; ?>" alt=""></td>
                <td class="remove" style="color: green;"><a href="javascript:void(0);" onclick="add_layer('<?php echo $value->mediaId; ?>')" style="color:green;border-color: green;">+</a><span><?php _e('Adicionar', 'sage'); ?></span></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          <style type="text/css">
            .pagination>ul{
              list-style: none;
              margin: 20px auto;
              width: 300px;
            }
            .pagination>ul>li{
              cursor:pointer;
              float: left;
              padding: 7px;
              border: 1px solid black;
              margin-left: 3px;
            }
          </style>
          <div class="pagination">

            <ul>
              <?php if((int)$start > 1){ ?>
                <li style='cursor:pointer' onclick='window.location.href="?start=1"'>Princípio</li>
                <li style='cursor:pointer' onclick='window.location.href="?start=<?php echo $start-1 ?>"'><?php echo $start-1 ?></li>
              <?php } ?>
              <li style='cursor: auto;background-color: #cdcdcd;color: white;'><?php echo $start ?></li>
              <?php if((int)$layers["total"] > $start+10){ ?>
                <li style='cursor:pointer' onclick='window.location.href="?start=<?php echo $start+1 ?>"'><?php echo $start+1 ?></li>
                <li style='cursor:pointer' onclick='window.location.href="?start=<?php echo round($layers['total']/10) ?>"'>Final</li>

              <?php } ?>
            </ul>
          </div>
        </div>
        <div id="cart" class="tab-pane fade">
          <table id="myOrder">
            <thead>
              <tr>
                <th><?php _e('lâmina', 'sage'); ?></th>
                <th><?php _e('Categoria', 'sage'); ?></th>
                <th><?php _e('Assunto', 'sage'); ?></th>
                <th><?php _e('Pré-Visualizaçao', 'sage'); ?></th>
                <th><?php _e('Remover', 'sage'); ?></th>
              </tr>
            </thead>
            <tbody id="draggable">
              <?php foreach ($mylayers as $value) { ?>
                <tr>
                  <td><?php echo $value->mediaId; ?></td>
                  <td><?php echo $value->tags; ?></td>
                  <td><?php echo $value->name; ?></td>
                  <td><img src="<?php echo get_field('url','option'); ?>/api/library/download/<?php echo $value->mediaId ?>?preview=1&access_token=<?php echo $_SESSION['access_token']; ?>" alt=""></td>
                  <td class="remove"><a href="javascript:void(0);" onclick="remove_layer('<?php echo $value->mediaId; ?>')">-</a><span><?php _e('Eliminar', 'sage'); ?></span></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="ads-buttons">
            <button class="btn btn-default btn-rounded mb-4" onclick="send();"><?php _e("Enviar","sage") ?></button>
          </div>
          <div class="message" id="message">

          </div>
        </div>
      <p><?php _e('Para alterar a ordem de exibição, clique e arraste para a ordem desejada', 'sage'); ?></p>
    </div>
  </section>

<?php endwhile; ?>
