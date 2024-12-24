var gmap = null;
var page_update_markers_array = new Array();

var array_map_markers = new Array();

var current_selected_input_pin = null;

var GMapper = function(){
	return {
		map: null
	};
}();

function setGMapMarkerPosition(map, map_parent, markerDisplay, markerPosition)
{
	markerDisplay.val([
	    markerPosition.lat(),
	    markerPosition.lng()
	  ].join(', '));
}

function deletePin(pin_id, indice)
{
	alert('borrar ' + pin_id + ' -> ' + indice);
}

// gmapAddUpdatePin 
function gmapAddUpdatePin(container_id, map, map_parent, markerpos, field)
{
	//alert('agregar pin de db');
	var pin_name = field.attr('name');
	var pin_str = String(pin_name).split('[');
	var pin_str2 = String(pin_str[1]).split(']'); 
	//alert(pin_str2);
	
	var html_content = '<h3> Ping</h3> <p><a href="#" onClick="deletePin(' + pin_str2[0] + ', ' + page_update_markers_array.length + ')">Borrar pin</a></p>';
	
	var marker = new google.maps.Marker({map: gmap, position: markerpos, content: html_content, draggable: true});
	
	
	
	var pinInfo = field;
	var pin_index = array_map_markers.length;
	//map_parent.find('#pins').append(pinInfo);
	//return;
	google.maps.event.addListener(marker, 'click', function() {
	    
		if(current_selected_input_pin)
		{ current_selected_input_pin.unwrap(); }
		
		pinInfo.wrap('<span class="selected_ping"> <a href="#" class="borrar_pin" data-index="' + pin_index + '" id="wrap_input_' + pin_str2[0] + '" rel="' + pin_str2[0] + '">x</a></span>');
		
		$('#wrap_input_' + pin_str2[0]).click( function(){
			var link = $(this);
			var rel = link.attr('rel');
			var data = {mark_id: rel};
			
			$.post('index.php?a=cms&c=mapMark:jx_delete', data, function(){
				var ind = link.attr('data-index') * 1;
				array_map_markers[ind],marker.setMap(null);
				array_map_markers.splice(ind,1);
				link.parent().remove();
			});
			
			current_selected_input_pin = pinInfo;
			
			return false;
		});
		
		current_selected_input_pin = pinInfo;
	});
	
	google.maps.event.addListener(marker, 'drag', function(latLng)
	{
		setGMapMarkerPosition(gmap, map_parent, pinInfo, marker.getPosition());
	});
	
	array_map_markers.push({field: field, marker: marker});
	
	setGMapMarkerPosition(gmap, map_parent, pinInfo, marker.getPosition());
}
function gmapAddPin(container_id, map, map_parent, markerpos)
{
	//map = GMapper.map;
	
	var marker = new google.maps.Marker({map: gmap, position: markerpos, draggable: true});
	
	var pin_index = array_map_markers.length;
	var pinInfo = $('<input type="text" class="new_pin_' + pin_index + '" name="' + container_id + '-pin[]">');
	
	map_parent.find('#pins').append(pinInfo);
	
	pinInfo = $('.new_pin_' + pin_index);
	
	
	// click manager
	
	google.maps.event.addListener(marker, 'click', function() {
	    
		if(current_selected_input_pin)
		{ current_selected_input_pin.unwrap(); }
		
		pinInfo.wrap('<span class="selected_ping"> <a href="#" id="wrap_input_' + pin_index + '" class="borrar_pin" data-index="' + pin_index + '">x</a></span>');
		
		$('#wrap_input_' + pin_index).click( function(){
			var link = $(this);
			var rel = link.attr('rel');
			var data = {mark_id: rel};
			
			var ind = link.attr('data-index') * 1;
			array_map_markers[ind],marker.setMap(null);
			array_map_markers.splice(ind,1);
			link.parent().remove();
			
			current_selected_input_pin = pinInfo;
			
			return false;
		});
		current_selected_input_pin = pinInfo;
		current_selected_input_pin = pinInfo;
	});
	
	google.maps.event.addListener(marker, 'drag', function(latLng)
	{
		setGMapMarkerPosition(gmap, map_parent, pinInfo, marker.getPosition());
	});
	
	array_map_markers.push({field: pinInfo, marker: marker});
	// end clic manager
	
	
	//drag
	google.maps.event.addListener(marker, 'drag', function(latLng){
		setGMapMarkerPosition(gmap, map_parent, pinInfo, marker.getPosition());
	});
	
	page_update_markers_array.push(marker);
	
	setGMapMarkerPosition(gmap, map_parent, pinInfo, marker.getPosition());
} 
function setGMapControls(container_id, map)
{
	// setea los controles del mapa
	//alert(map.constructor);
	var map_parent = $('#'+container_id).parent();
	var addPinBtn = map_parent.find('a#btn_add_pin');
	var mapp = gmap;
	addPinBtn.click( function(){
		
		gmapAddPin(container_id, gmap, map_parent, mapp.getCenter());
		return false;
	});
	google.maps.event.addListener(gmap, 'zoom_changed', function() {
		map_parent.find('#map_zoom').val(gmap.getZoom());
		var markerPostion = gmap.getCenter();
		map_parent.find('#map_center').val([
		    markerPostion.lat(),
		    markerPostion.lng()
		  ].join(','));
	});
	google.maps.event.addListener(gmap, 'dragend', function() {
		var markerPostion = gmap.getCenter();
		map_parent.find('#map_center').val([
		    markerPostion.lat(),
		    markerPostion.lng()
		  ].join(','));
		
	});
	var map_center = map_parent.find('#map_center');
	map_parent.find('#map_zoom').val(gmap.getZoom());
	if(map_center.val() == '')
	{
		var markerPosition = gmap.getCenter();
		map_center.val([
		    markerPosition.lat(),
		    markerPosition.lng()
		  ].join(','));
	}
}
function initGMap(container_id, config_obj)
{
	var map_parent = $('#'+container_id).parent();
	var map_center = map_parent.find('#map_center');
	
	// DEFINICION DE OPCIONES DEL MENU
	
	// zoom
	var map_center;
	var zoom = map_parent.find('#map_zoom');
	if(zoom.val() == '')
	{
		var def_zoom = 1;
	}else{
		var def_zoom = zoom.val() * 1;
	}
	
	// centro del mapa
	
	
	if(config_obj.position && map_center.val() == '')
	{
		map.setCenter(new google.maps.LatLng(config_obj.position.lat, config_obj.setCenter.long));
	}else if(map_center.val() != ''){
		var current_center = map_center.val();
		var mc = current_center.split(',');
		
		map_center = new google.maps.LatLng(mc[0], mc[1]);
	}else{
		// centro por default
		map_center = new google.maps.LatLng(10.314919, -102.568359);
	}
	
	
	var options = {scaleControl: config_obj.scaleControl,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					center: map_center,
					zoom: def_zoom};
	
	gmap = new google.maps.Map(document.getElementById(container_id), options);
	var map = gmap;
	
    // Si existen pines agregarlos
	var pinnes = $('#uppins input.markers');
	
	if(pinnes.length > 0)
	{
		pinnes.each( function(){
			var val = $(this).val();
			vp = val.split(',');
			var pinpos = new google.maps.LatLng(vp[0], vp[1]);
			gmapAddUpdatePin(container_id, gmap, map_parent, pinpos, $(this));
		});
	}
	// end pines
	
	//map.setCenter(new google.maps.LatLng(19.491105413016882,-99.08825784674549));
	//map.setZoom(5);
	
    //map.setMapTypeId();
	
    var infowindow = new google.maps.InfoWindow();
	setGMapControls(container_id, map);
}