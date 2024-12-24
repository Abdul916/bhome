<?php 
$uid = md5(rand(0,10));
 ?>
<div class="galery uniq-<?php echo $uid; ?>">
	<?php
	//echo "<pre>"; var_dump(gd_info()); echo "</pre>";
	if($images->isCollection()): ?>
	<ul id="gallery<?php echo $icollec->get('id');?>" class="vlist imagecollection">
		<?php foreach($images as $image): ?>
		<li id="<?php echo 'img'.$image->get('id'); ?>" rel="<?php echo $image->get('id'); ?>">
			<div class="img">
				<img src="<?php if(is_file($image->get('sys_thumbnail'))){ echo $image->get('sys_thumbnail');}else{
					// generar el thumb
					$filename = Core_Base_File::getFilename($image->get('file_path'));
					/*
					echo extension_loaded('gd');
					echo '/';
					echo function_exists('gd_info');
					*/
					if(false && function_exists('gd_info') && is_file('../'.$image->get('file_path')))
					{
						
						if( !is_dir('cache/galerias/'))
						{
							echo 'rutanoexite/';
						}
						if( !is_writable('cache/galerias/'))
						{
							echo 'nowritable/';
						}
						
						WideImage::load( '../'.$image->get('file_path'))->resize(100, 150)->crop('center', 'center', 90, 67)->saveToFile( 'cache/galerias/'.$filename);
					}else{
						echo '/'.$image->get('file_path');
					}
					
					
				} ?>" class="w-32 h-24 object-cover" />
				<div class="opt">
					<a href="javascript:if(confirm('¿Borrar esta imagen?')) { removeImage(<?php echo $image->get('id'); ?>); }" class="delete">Borrar</a>
					<a href="#" class="gimglink<?php echo $image->get('id'); ?> imgconf openmodal" rel="<?php Core_Common_Route::linkController('image:popconfigure', array('image_id' => $image->get('id'), 'site_id' => $site_id)) ?>">Editar</a>
				</div>

			</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	<div class="clear"></div>
	<?php if($images->count() > 0): ?>
	<a href="#" class="button smalltext" rel="#gallery<?php echo $icollec->get('id');?>" id="btn_order<?php echo $icollec->get('id');?>">Ordenar galería</a>
	<?php endif; ?>
	<div class="clear"></div>
</div>
<script type="text/javascript" charset="utf-8">
	/*$('.openmodal').click( function(){
		alert('ouch');
		return false;
	});*/
console.log($('.uniq-<?php echo $uid; ?> .openmodal'));
	$('.uniq-<?php echo $uid; ?> .openmodal').click( function(){
		console.log('open modal');
		showModal($(this), '.jqmClose', function(){
			console.log($('#updateimage'));
			$('#updateimage').submit(function() {

			  $.post('<?php Core_Common_Route::linkController('image:updateconfig') ?>', $(this).serialize(), function(data) {
			    $('.pop_jxresult').html(data);
			  });

			  return false;
			});
			
			$('.delete_thumbnail').click( function(){
				$.post('<?php Core_Common_Route::linkController('image:jx_thumb_delete'); ?>',
				{'image_id': $(this).attr('rel')},
				function(){
					$('#pop_img_display').html('');
					alert('Thumbnail borrado con exito');
				});
				return false;
			});
		});
		return false;
	});
	
	/*
	setModal( '.openmodal', '.jqmClose', function(){
		
	});*/
</script>