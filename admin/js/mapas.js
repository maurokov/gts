var map = null;
var geocoder = null;


var poly;
var markers = [];
var num = 0;

var g;

function initMap() {
	g = google.maps;
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 14,
		center: new g.LatLng(-33.0477778, -71.6011111),
		mapTypeId: g.MapTypeId.ROADMAP,
		disableDoubleClickZoom: true
	});
	
	poly = new google.maps.Polyline({
		strokeColor: '#000000',
		strokeOpacity: 1.0,
		strokeWeight: 3	
	});
	poly.setMap(map);
	
	// Add a listener for the click event
	map.addListener('click', addLatLng);
}

// Handles click events on a map, and adds a new point to the Polyline.
function addLatLng(event) {
	var path = poly.getPath();
	path.push(event.latLng);
	num = markers.length;
	
	var marker = new MarkerWithLabel({
		position: event.latLng,
		draggable: false,
		raiseOnDrag: true,
		map: map,
		labelContent: num+1,
		labelAnchor: new google.maps.Point(22, 0),
		labelClass: "labels", // the CSS class for the label
		labelStyle: {opacity: 0.75}
	});
	
	
	markers.push(marker);
	muestraPunto(marker);
}

function muestraPunto(marker){
	var j = markers.length;
	var table = document.getElementById("tablaRuta");
	var row = table.insertRow(-1);
	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);
	var cell3 = row.insertCell(2);
	var cell4 = row.insertCell(3);
	//var cell4 = row.insertCell(3);
	//var cell5 = row.insertCell(4);
	var pos = marker.getPosition();
	var lat = pos.lat();
	var lng = pos.lng();
	
	// Datos
	cell1.innerHTML = j;
	//cell2.innerHTML = lat,
	//cell3.innerHTML = lng,
	cell2.innerHTML = '<div id="marker_'+j+'"></div>';
	
	if(j == 0) {
		var htmlTiempo = '<p class="form-control-static">0</p><input id="tiempo_'+j+'" name="tiempo_'+j+'" value="0"" type="hidden" required>';
	} else {
		var htmlTiempo = '<div class="form-group"><input id="tiempo_'+j+'" name="tiempo_'+j+'" class="form-control" type="number" min="1" required></div>';
	}
	cell3.innerHTML = htmlTiempo;
	
	var latlng = '<input type="hidden" id="lat'+j+'" name="lat_'+j+'" value="'+lat+'"><input type="hidden" id="lng'+j+'" name="lng_'+j+'" value="'+lng+'">';
	cell4.innerHTML = latlng;

	$('#tiempo_'+j).on('input', function() {
		actualizaTiempoTotal();		
	});
	
	$('#formNuevaRuta').validator();
	geoCode(pos,"marker_"+j);
	
	$("#puntos").html("<p></p>");
}


function geoCode(latlng, id){
	var geocoder = new google.maps.Geocoder;
	geocoder.geocode({'location': latlng}, function(results, status) {
	if (status === google.maps.GeocoderStatus.OK) {
	  if (results[1]) {
		//map.setZoom(11);
		//var marker = new google.maps.Marker({
		//  position: latlng,
		//  map: map
		//});
		console.log(results[1].formatted_address);
		$("#"+id).html(results[1].formatted_address);
		//infowindow.setContent(results[1].formatted_address);
		//infowindow.open(map, marker);
	  } else {
		window.alert('No results found');
	  }
	} else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) { 
		wait = true;
		setTimeout("wait = true", 2000);
		//alert("OQL: " + status);
	} else {
	  console.log('Geocoder failed due to: ' + status);
	  $("#"+id).html('No se ha podido obtener dirección.');
	}
  });
}



function actualizaTiempoTotal() {
	suma = 0;
	$("input[id^='tiempo']").each(function(index, element) {
		valor = $(element).val();
		if(!isNaN(valor)) {
			suma = suma + Number(valor);
		}
	});
	$("#total").val(suma);
}

$('#formNuevaRuta').validator().on('submit', function (e) {
	if (e.isDefaultPrevented()) {
		console.log("NOK");
	} else {
		console.log("OK");
		$.ajax({
			url: API_ENDPOINT+'rutas/ruta',
			type: 'POST',
			data: $("#formNuevaRuta").serialize(),
			cache: false,
			success: function(data) {
				window.alert(data);
			}
		});
	}
});


			
