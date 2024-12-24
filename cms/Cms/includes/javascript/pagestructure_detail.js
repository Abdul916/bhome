var pagesTableSerialized;
	
function saveneworden()
{
	if(!pagesTableSerialized)
	{
		alert('No has modificado nada.');
		return;
	}
	var structure_id = $('#structure_id').val();
	var site_id = $('#site_id').val();
	
	$.post('index.php?a=cms&c=pageStructure:saveorder&structure_id=' + structure_id + '&site_id=' + site_id, 
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
		$("#field_list").tableDnD({
			onDrop: function(table, row) {
				pagesTableSerialized = $("#field_list").tableDnDSerialize();
			}
		});
		
	});
	
	
});