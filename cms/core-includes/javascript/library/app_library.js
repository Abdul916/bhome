// funciones para links de lectura de contenido

function autoLoad(e)
{
	var element = $(e);
	
	var rel = element.attr('rel');
	var url = element.attr('href');
	
	$('#' + rel).load(url);
}
function setAutoLoad( selector)
{
	$(selector).each(function(){
		$(this).click( function(){
			
			autoLoad(this);

			return false;
		});
	});
}


function loadContentByAnchor()
{
	/*
	Leerá el contenido asignado al anchor
	*/
	var urlAnchor = $.urlAnchor();
	if(urlAnchor)
	{
		var inpageAnchor = $('#'+urlAnchor);
		var container = $('#'+urlAnchor+'Info');
		container.load(inpageAnchor.attr('rel'));
	}
	
}

function setRemoteContentLoadElement(elink)
{
	elink.click( function(){
		setTimeout( function(){loadContentByAnchor();}, 100);	// timeout para asegurarce que el anchor exista cuando se solicite
	});
}
function setRemoteContentLoad( selector)
{
	$(selector).each( function(){
		var el = $(this);
		
		setRemoteContentLoadElement( $(this));
	})
}

function prepareAutoUpdate(element)
{
	var el = element;
	var saveurl = el.attr('href');
	//var currentlink = $(jQuery('<a href="' + el.attr('href') +'" class ="' + el.attr('class') +'" rel="' + el.attr('rel') +'" >' + el.text() + '</a>'));
	
	var parameters = el.attr('rel').split(":"); // alert(jQuery(this).get(0).id);
	var input = parameters[0];		// campo input
	var app = parameters[1]			// aplicacion
	var controller = parameters[2];	// controlador para edicion
	var action = parameters[3];		// accion a ejecutar
	var field_id = parameters[4];	// campo que se debe actualizar
	var id = parameters[5];			// id del objeto a editar
	
	var fieldObj = $('#'+input);
	
	if(fieldObj.length == 1)
	{
		
		var texto = $('<label id="'+input+'_label">'+fieldObj.val()+'</label>');
		texto.insertAfter(fieldObj);
		fieldObj.hide();
	}else{
		alert('Error JS0001: el objeto no se encuentra o existe más de uno');
	}
}

function autoDelete(el, callback)
{
	el.click( function(){
		if(callback === undefined)
		{
			//si no hay ningun callback
			callback = null;
		}
		var saveurl = el.attr('href');
		
		//var currentlink = $(jQuery('<a href="' + el.attr('href') +'" class ="' + el.attr('class') +'" rel="' + el.attr('rel') +'" >' + el.text() + '</a>'));
		
		var parameters = el.attr('rel').split(":"); // alert(jQuery(this).get(0).id);
		
		var element = parameters[0];		// campo input, tr, etc. 
		var app = parameters[1];
		var controller = parameters[2];	// controlador para edicion
		var action = parameters[3];		// accion a ejecutar
		var element_id = parameters[4];	// campo que se debe actualizar
		if(confirm('¿Estas seguro de querer eliminar este elemento?'))
		{
			// el usuario quiere eliminar
			var saveurl = 'index.php?a='+app+'&c='+controller+':'+action;
			var pdata = {'element_id': element_id};
			$.post(saveurl, pdata, function(data){
				$('#'+element).remove();
				
				if(callback && $.isFunction(callback))
				{
					// si la referencia existe y es una referencia a una funcion
					var obj = {};
					obj.type = 'onDelete';
					obj.target = el;
					obj.data = element_id;
					
					callback.apply(obj);
				}
				
			});
			
		}
		return false;
	});
}

function autoupdate( element)
{
	// asigna prodedimientos de auto update en elementos html
	// save vía ajax
	
	element.click( function(){
		var el = $(this);
		var saveurl = el.attr('href');
		//var currentlink = $(jQuery('<a href="' + el.attr('href') +'" class ="' + el.attr('class') +'" rel="' + el.attr('rel') +'" >' + el.text() + '</a>'));
		
		var parameters = el.attr('rel').split(":"); // alert(jQuery(this).get(0).id);
		
		var input = parameters[0];		// campo input
		var app = parameters[1]			// aplicacion
		var controller = parameters[2];	// controlador para edicion
		var action = parameters[3];		// accion a ejecutar
		var field_id = parameters[4];	// campo que se debe actualizar
		var id = parameters[5];			// id del objeto a editar
		
		var options_holder = null;
		// verificar si existe place holder para las obciones
		if(parameters.length > 6 )
		{
			var options_holder = parameters[6];			// id del place holder de las obciones
			$('#'+options_holder).addClass('edit_container');
		}
		
		var labelObj = $('#'+input+'_label');
		labelObj.hide();
		
		var fieldObj = $('#'+input);
		fieldObj.show();
		
		element.hide();
		
		var savebtn = $(jQuery('<a href="#" class="save autoupdate_save">Guardar</a>'));
		var cancelbtn = $(jQuery('<span> | </span><a href="#" class="cancel autoupdate_cancel">Cancelar</a>'));
		
		if(!options_holder)
		{
			savebtn.insertAfter(fieldObj);
			cancelbtn.insertAfter(savebtn);
		}else if(options_holder)
		{
			$('#'+options_holder).append(savebtn);
			cancelbtn.insertAfter(savebtn);
		}
		
		cancelbtn.click( function(){
			fieldObj.hide();
			labelObj.show();
			element.show();
			
			savebtn.remove();
			cancelbtn.remove();
			return false;
		});
		
		savebtn.click( function(){
			// acciones para guardar el elemento
			var saveurl = 'index.php?a='+app+'&c='+controller+':'+action;
			var pdata = {'element_id':id, 'field':field_id, 'data': fieldObj.val()};
			//alert(saveurl);
			
			$.post(saveurl, pdata, function(data){
				//currentlink.text(data);
				//divcontainer.replaceWith(currentlink);
				var response = $.parseJSON(data);
				if(response.result != 1)
				{
					alert('Error '+response.result);
				}else if(response.result == 1){
					fieldObj.val(response.newvalue);
					labelObj.text(response.newvalue);
				}
				
				fieldObj.hide();
				labelObj.show();
				element.show();

				savebtn.remove();
				cancelbtn.remove();
			});
			return false;
		});
		
		return false;
	});
}

function setAutoUpdate( selector_class)
{
	
	$('.'+selector_class).each( function(){
		var el = $(this);
		prepareAutoUpdate(el);
		
		autoupdate( $(this));
	})
}

function setAutoDelete( selector_class, callback)
{
	$('.'+selector_class).each( function(){
		var el = $(this);
		autoDelete(el, callback);
	})
}




/* FUNCIONES PARA ROLLOVER OPTIONS */
function enterfunction( event)
{
	var theTR = $(event.target).closest('tr');
	//var dataRow = $(event.target);
	var auxId = String(theTR.attr('id')).split('_');
	//jQuery(this).get(0).id.split("-");
	
	var id = auxId[1];
	//alert(id);
	//alert('opt_'+id);
	$('#opt_'+id).css('display', 'table-row');
	$('#dat_'+id).css('display', 'none');
	$('#opt_'+id).mouseleave(leavefunction);
}
function leavefunction( event)
{
	var theTR = $(event.target).closest('tr');
	//var dataRow = $(event.target);
	var auxId = String(theTR.attr('id')).split('_');
	//jQuery(this).get(0).id.split("-");
	
	var id = auxId[1];
	$('#opt_'+id).css('display', 'none');
	$('#dat_'+id).css('display', 'table-row');
}

function hoverOptions(selector)
{
	$(selector+ ' tbody tr.data').mouseenter(enterfunction);
}

