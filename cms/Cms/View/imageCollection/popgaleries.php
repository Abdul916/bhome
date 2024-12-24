<h3>Reordenar páginas principales de
  <a href="#" class="jqmClose modal_close_bluebg">Cerrar</a></h3>
<script type="text/javascript" charset="utf-8">
  function CallSaveOrden(serialization) {
    $.post('<?php Core_Common_Route::linkController('page:jxsetGallery', array('page_id' => $page->get('id'))) ?>',
      serialization,
      function(data) {
        // respuesta
        $('.inline_alert').css({
          'display': 'block'
        });
        loadImages('#<?php echo $field; ?>list', data);
        return false;
      }
    );
    return false;
  }
</script>
<style type="text/css" media="screen">
  #list {
    overflow: auto;
    height: 400px;
  }

  .inline_alert {
    display: none;
  }
</style>
<div id="modalcontent" class="">
  <form action="popgaleries_submit" method="post" id="galleryselection" accept-charset="utf-8">

    <input type="hidden" name="data_id" value="<?php echo $data_id; ?>" id="data_id">

    <p style="margin-top:0px">Selecciona la galería que deseas asignar a esta página</p>

    <div id="list" class="galerylist">

      <div class="box">
        <div class="img"><label for="radio0"><img src="cms_includes/images/empty-gallery.gif" width="110" height="85" /></label></div>
        <p>
          <input type="radio" name="selectedgalleryid" value="0" id="radio0">
          <label for="radio0">Nueva galería</label>
        </p>
      </div>

      <?php if ($imagecollections->count() > 0) :
        foreach ($imagecollections as $imgcoll) :
          // print_r($imgcoll);
          $image = $imgcoll->getFirstImage();
          if ($image->count() == 0)
            continue;

          $page = $imgcoll->getPage();
          $pag = null;

          if($page && $page->count() == 1) {
            $pag = $page;
          }else if($page && $page->count() == 1){
            $pag = $page;
          }
          $image = $image->getObjectAt(0);

          	if($image):

            ?>
            <div class="box">
              <div class="img"><label for="radio<?php echo $imgcoll->get('id'); ?>"><img src="<?php echo $image->get('sys_thumbnail'); ?>" width="110" /></label></div>
              <p>
                <input type="radio" name="selectedgalleryid" value="<?php echo $imgcoll->get('id'); ?>" id="radio<?php echo $imgcoll->get('id'); ?>">
                <label for="radio<?php echo $imgcoll->get('id');  ?>"><?php if(is_object($pag)) echo $pag->get('name'); ?></label>
              </p>
            </div>
          <?php
        endif;

      endforeach;
    endif; ?>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <p>
      <input type="submit" name="send" value="Seleccionar Galería" id="send">
      <div class="inline_alert">
        <p>Galería asignada con éxito</p>
      </div>
  </form>
  <script type="text/javascript" charset="utf-8">
    $('#galleryselection').submit(function() {
      CallSaveOrden($(this).serialize());
      return false;
    });
  </script>
  </p>
</div>
