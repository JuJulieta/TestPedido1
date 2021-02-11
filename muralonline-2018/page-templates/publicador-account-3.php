<?php
/**
 * Template Name: Publicador Account 3
 */
?>
<?php
  if(isset($_POST['name'])){
    set_client_layer($_GET['layout'],$_POST['name'], $_POST['image'], $_POST['time']);
  }
?>

<?php while (have_posts()) : the_post(); ?>

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

  <section class="filters">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-5">
          <?php $categories = get_categories_xibo(); ?>
          <select name="" id="">
            <?php foreach ($categories as $value) { ?>
              <option value="<?php echo $value->name; ?>"><?php echo $value->name; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-2 sidebar-ads">
          <h3><?php _e('Condomínio', 'sage'); ?></h3>
          <ul>
            <li><a href="#">Elevadores</a></li>
            <li><a href="#">Elevadores</a></li>
            <li><a href="#">Elevadores</a></li>
            <li class="active"><a href="#">Elevadores</a></li>
            <li><a href="#">Elevadores</a></li>
            <li><a href="#">Elevadores</a></li>
          </ul>
        </div>
        <?php $layout = get_layout_xibo($_GET['layout']); ?>
        <div class="col-md-10 ads-buttons">
          <img src="<?php echo get_field('url','option'); ?>/api/library/download/<?php echo $layout[0]->backgroundImageId ?>?preview=1&access_token=<?php echo $_SESSION['access_token']; ?>">
          <div>
            <input type="hidden" name="tempo" value="0" id="tempo">
            <a href="<?php echo get_permalink(29); ?>" class="btn"><?php _e('Voltar', 'sage'); ?></a>
            <a href="<?php echo get_field('url','option'); ?>/layout/preview/<?php echo $_GET['layout']; ?>" target="_BLANK" class="btn"><?php _e('Visualizar', 'sage'); ?></a>
            <a href="#" class="btn"><?php _e('Tempo de permanência', 'sage'); ?> <?php echo $layout[0]->duration ?> s</a>
            <a id="nextUrl" href="<?php echo get_permalink(41); ?>?layout=<?php echo $_GET['layout'] ?>" class="btn"><?php _e('Publicar', 'sage'); ?></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="ads">
    <div class="container">
      <div class="text-center">
        <h2 class="dialog orange"><?php _e('Suas lâminas ativas', 'sage'); ?></h2>
      </div>
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
                      formData.append("category", "<?php echo $_GET['layout']; ?>");
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

                  </div>
                  <div class="modal-footer d-flex justify-content-center">
                      <button class="btn btn-deep-orange" onclick="set_library();">Guardar</button>
                  </div>
              </div>
          </div>
      </div>
      <div class="ads-buttons text-center">
          <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalRegisterForm"><?php _e('Adicionar design', 'sage'); ?></a>
      </div>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
      <script type="text/javascript">
        jQuery(function  () {
          jQuery("tbody").sortable({
              items: "> tr",
              helper: "clone"
          })
        });
      </script>
      <?php $layers = get_client_list($_GET['layout']); ?>
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
          <tbody id="draggable">
          <?php foreach ($layers as $value) { ?>
            <tr>
              <td><?php echo $value->mediaId; ?></td>
              <td><?php echo $value->tags; ?></td>
              <td><?php echo $value->name; ?></td>
              <td><img src="<?php echo get_field('url','option'); ?>/api/library/download/<?php echo $value->mediaId ?>?preview=1&access_token=<?php echo $_SESSION['access_token']; ?>" alt=""></td>
              <td class="remove"><a href="javascript:void(0);" onclick="remove_layer('<?php echo $value->mediaId; ?>')">X</a><span>Remover</span></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      <p><?php _e('Para alterar a ordem de exibição, clique e arraste para a ordem desejada', 'sage'); ?></p>
    </div>
  </section>

<?php endwhile; ?>
