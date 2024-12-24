var currently_modal = null;
function showModal(element, close_selector, callback)
{
	if(callback === undefined)
	{
		//si no hay ningun callback
		callback = null;
	}
	var elem = element;
	var lighbox = $('<div class="jqmOverlay"></div>');
	var modelbox = $('<div class="jqmWindow"></div>');
	
	$('body').prepend(modelbox);
	$('body').prepend(lighbox);
	
	// setup de tamaños del pop
	var bodyh = $(document).height();
	var bodyw = $(document).width();
	var topp = (bodyh - modelbox.height()) / 2;
	var leftp = (bodyw - modelbox.width()) / 2;
	
	var css = { position: 'absolute',
				top: topp + 'px',
				left: leftp + 'px',
				display: 'block'
				};
	lighbox.css('opacity', 0.7);
	modelbox.css(css);
	//alert('alert: ' + element.attr('rel'));
	modelbox.load(element.attr('rel'), function(data){
		
		var bodyh = $(document).height();
		var bodyw = $(document).width();
		var topp = (bodyh - modelbox.height()) / 2;
		topp = 100;
		var leftp = (bodyw - modelbox.width()) / 2;
		
		var css = { position: 'absolute',
					top: topp + 'px',
					left: leftp + 'px',
					display: 'block'
					};
		modelbox.css(css);
		
		$(close_selector).click( function(){
			modelbox.remove();
			lighbox.remove();
			return false;
		});
		
		if(callback && $.isFunction(callback))
		{
			// si la referencia existe y es una referencia a una funcion
			var obj = {};
			obj.type = 'onLoad';
			obj.target = modelbox;
			obj.data = data;
			
			callback.call(this, obj);
		}
	});
}
function setModal( selector, close_selector, callback)
{
	$(selector).click( function(event){
		showModal($(this), close_selector, callback);
		//return false;
	})
}

