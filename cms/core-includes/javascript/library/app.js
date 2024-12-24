/*
	FUNCIONES GENERALES PARA EL USO DEL FRAMEWORK
*/

function setAjaxLinks()
{
	$('a.ajax').each(function(){
		$(this).click( function( event){
			//alert($(this).attr('href'));
			var rel = $(this).attr('rel');
			$.post($(this).attr('href'), function(data){
				$('#' + rel).html(data);
			});
			event.preventDefault();
		});
	});
}
function setInlineEditionLink(obj)
{
	obj.click( function()
	{
		var saveurl = $(this).attr('href');
		var currentlink = $(jQuery('<a href="' + $(this).attr('href') +'" class ="inline_edit" >' + $(this).text() + '</a>'));
		var seccname = $(this).text();
		var input = $(jQuery('<input type="text" value ="' + seccname + '" />'));
		var savebtn = $(jQuery('<input type="button" value ="Guardar" />'));
		var cancelbtn = $(jQuery('<a href="#" class="cancel">Cancelar</a>'));
		var divcontainer = $( jQuery('<div class=""></div>'))
		divcontainer.html(input);
		savebtn.insertAfter(input);
		cancelbtn.insertAfter(savebtn);
		
		$(this).replaceWith(divcontainer);
		
		
		input.focus();
		savebtn.click( function(){
			$.post(saveurl, {'name': input.val()}, function(data){
				currentlink.text(data);
				divcontainer.replaceWith(currentlink);
				setInlineEditionLink(currentlink);
			});
			return false;
		});
		cancelbtn.click( function(){
			
			divcontainer.replaceWith(currentlink);
			setInlineEditionLink(currentlink);
			return false;
		});
		return false;
	});
}
function setInlineEdition()
{
	$('.inline_edit').each( function(i ,e) {
		
		setInlineEditionLink($(this));
	});
}