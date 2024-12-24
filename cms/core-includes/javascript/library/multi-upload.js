function setGallery( input_id) {

	var jObj = $('#' + input_id);

	jObj.on('change', function (e) {
		var input = e.currentTarget;
		var obj = $(e.currentTarget);
		var files = input.files;
		var mess = $('#mess_' + obj.attr('id'));

		mess.text('Cargando '  + files.length + ' imagenes');

		
		for (var i = 0; i < files.length; i++)
		{
			console.log(files[i]);
			var form = new FormData();
			form.append('Filedata', files[i]);


			fetch(obj.data('url'),{
				method: 'POST',
	            body: form
			})
			.then( function (checkStatus) {
				console.log('checkStatus', checkStatus);
			})
	  		.then( function (parseJSON) {
	  			console.log('reload', '#'+ obj.attr('id') + 'list', obj.data('galery_id'));
	  			reloadimageslist('#'+ obj.attr('id') + 'list', obj.data('galery_id'));
	  		});

		}
		// start upload
		
	})

	
}