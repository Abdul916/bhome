var linkordenar;
var linkguardar;
var cancel;
var sorted_on = false;

function setOrderBtnAction(selector_btn)
{
	// asigna la acci�n del botoon que iniciara el orden
	$(selector_btn).click( function(){
		linkordenar = $(this);
    	
		linkordenar.hide();
    	linkguardar = $(' <a href="#" class="button smalltext">Guardar nuevo orden</a>');
		cancel = $(' <a href="#" class="smalltext cancel">Cancelar</a>');
    	linkguardar.insertAfter(linkordenar);
		cancel.insertAfter(linkguardar);
    	
		setListSorteable( linkordenar.attr('rel'));

    	linkguardar.click( function(){
    		console.log(linkordenar.attr('rel'));
    		savePhotosOrder(linkordenar.attr('rel')+' li');
    		
    		return false;
    	});
		cancel.click( function(){
    		//alert(linkordenar.attr('rel'));
    		//$(linkordenar.attr('rel')).sortable = null;
    		$( linkordenar.attr('rel') ).sortable('disable');
			linkordenar.show();
			cancel.remove();
			linkguardar.remove();
			
			$(linkordenar.attr('rel')).removeClass('sorteable_galery');
			
    		return false;
    	});
		return false;
	});
}

function setListSorteable( selector_lista)
{
	// setup de la lista para poder reordenarla
	if(sorted_on)
	{
		// ya esta activo, prender denuevo
		$( selector_lista ).sortable({ disabled: false });
	}else{
		$(selector_lista).sortable(
	    {  opacity: 0.7, 
	       revert: true, 
	       scroll: true, 
	       handle: $(".img").add(".img img") 
	    });
	}
	
	$(selector_lista).addClass('sorteable_galery');
	sorted_on = true;
}
function savePhotosOrder(list_selector)
	{
    	var items = $(list_selector);
    	var photos = new Array();
    
    	for(var x=0; x<items.length; x++)
    	{
    		console.log(items[x]);
    		photos[x] = $(items[x]).attr('rel');	
		}
		//alert(photos);
		
	 	$.ajax({
			url: 'index.php?a=cms&c=imageCollection:js_saveOrder',
			type: 'POST',
			data: {datos_json : JSON.stringify(photos)},
			success: function(data){
				
				// borrar botones y mandar mensaje que se borre solo
				$( linkordenar.attr('rel') ).sortable('disable');
				linkordenar.show();
				cancel.remove();
				linkguardar.remove();

				$(linkordenar.attr('rel')).removeClass('sorteable_galery');
				alerta = $('<p style="font-size: 12px; color: #008300;">Se actualizo el orden de la galer&iacute;a</p>');
				alerta.insertAfter(linkordenar);
				
				setTimeout( function(){
					alerta.fadeOut(400, function(){ $(this).remove();});
				}, 1200);
			}
		});
   	}	


	/*

    $('#btn_order').click( function(){
    	
		SavePhotos();
		return false;
	});
    
    	 
	*/
