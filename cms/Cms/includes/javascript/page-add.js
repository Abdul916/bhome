(function($){
	$( function(){
		
		$('.date').datepicker({changeMonth: true,changeYear: true,dateFormat: 'yy-mm-dd'});
		$('.publish_date_input').hide();
		
		$('#publish_status').change( function(){
			
			var el = $(this);
			if(el.is(':checked'))
			{
				$('.publish_date_input').show();
			}else{
				$('.publish_date_input').hide();
			}
			
		});
	});
})(jQuery);