<?php
Cms_View_Template::instace()->addJavaScript('core-includes/javascript/vendor/jquery/jquery-1.7.min.js');
Cms_View_Template::instace()->addJavaScript('core-includes/javascript/vendor/jquery/plugins/tablednd-0.5/jquery.tablednd_0_5.js');
Cms_View_Template::instace()->getHeader();
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var sectionsTableSerialized;
		$("#sections_list").tableDnD({

			onDrop: function(table, row) {
				var rows = table.tBodies[0].rows;
				var debugStr = '';
				var documents = '';
				for (var i=0; i<rows.length; i++) {
					debugStr += rows[i].id+" ";

				}
				sectionsTableSerialized = $('#sections_list').tableDnDSerialize();
				/*$.ajax({
					type: "POST",
					url: 'index.php?a=kos&c=document:documentOrder',
					data: ({ tabla: debugStr, 
							category_id: 1}),
					success: function(data) {
						$('#result-1').html(data);                                            
					}
				});*/

			},
		});
		$('#reorder').click(function(){
			if(!sectionsTableSerialized)
			{
				alert('Debes modificar el orden para guardar las secciones.');
				return;
			}
			$.post('<?php Core_Common_Route::linkController('section:saveorder', array('site_id' => $site->get('id')));?>',
				sectionsTableSerialized,
				function(data){
					$('#orderresponse').text(data);
				}
			);
			return false;
		});
	}); // end document ready
</script>

	<div id="app">
		<div class="content">
			<h2 class="bc"><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a> &gt; Ordenar secciones del sitio</h2>
			
			<div class="form">
				<form action="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>" class="app" method="post" accept-charset="utf-8">
					<fieldset class="vertical">
						<h3><a id="new-product" href="#new-product">Ingresa la información de la nueva sección</a></h3>
					</fieldset>
				</form>
			</div>
			
			<table class="list" id="sections_list">
				<caption><h5 class="topborder">Secciones</h5></caption>
				<thead>
					<tr>
						<th>Nombre de la sección</th>
					</tr>
				</thead>
					<?php if($sections->count() > 0): ?>
				<tbody>
					<?php foreach($sections as $section): ?>
						<?php if($section->get('index_status') != 1): ?>
					<tr id="<?php echo $section->get('id'); ?>">
						<td><?php echo $section->get('name'); ?></td>
					</tr>
						<?php endif; ?>
					<?php endforeach; ?>
				</tbody>
					<?php endif; ?>
			</table>
			<form>
				<p style="display:none;"><input type="button" name="reorder" value="Guardar nuevo orden" id="reorder"></p>
				<p id="orderresponse"></p>
			</form>
		</div>
		<div class="menu">
		
		</div>
	</div>

<?php
Cms_View_Template::instace()->getFooter();
?>