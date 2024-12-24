<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Reorden de páginas en sección</title>
	<link href="cms_includes/popupcss.css?v=1" media="screen" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="core-includes/javascript/vendor/jquery/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="core-includes/javascript/vendor/jquery/plugins/tablednd-0.5/jquery.tablednd_0_5.js"></script>

	<script type="text/javascript" charset="utf-8">

	var pagesTableSerialized;

	function saveneworden()
	{
		if(!pagesTableSerialized)
		{
			alert('No has modificado nada.');
			return;
		}
		$.post('<?php Core_Common_Route::linkController('page:saveorder', array('parent_type' => Cms_Model_MenuItem::PARENT_PAGE, 'parent_id' => $currentparent->get('id'), 'site_id' => $site->get('id')));?>',
			pagesTableSerialized,
			function(data){
				$('#orderresponse').text(data);
			}
		);
	}

	$(document).ready(function()
	{
		$(document).ready(function(){
			//initTable();
			$("#pages_list").tableDnD({
				onDrop: function(table, row) {
					pagesTableSerialized = $("#pages_list").tableDnDSerialize();
				}
			});

		});

	});
	</script>
</head>

<body>
	<div class="ajax_response" id="orderresponse"></div>
	<table border="0" cellspacing="0" cellpadding="0" id="pages_list">
		<thead>
		<tr><th>Nombre de la página (page)</th></tr>
		</thead>
		<tbody>
			<?php if($pages->count() > 0): ?>
			<?php foreach($pages as $page): ?>
			<tr id="<?php echo $page->get('id'); ?>"><td><?php echo $page->get('orden').' -  '.$page->get('name'); ?></td></tr>
			<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>

</body>

</html>