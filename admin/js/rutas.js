// JavaScript Document
var rutas;

// Cambiar estado
var rutaEstadoCambiar = function(accountID, rutaID, estado) {
	$.ajax({
		url: API_ENDPOINT+'/rutas/ruta/estado/'+rutaID+'/'+estado,
		type: 'POST',
		data: null,
		cache: false,
		success: function(data) {
			tabla.ajax.reload( null, false );
		}
	});
};

// Borrar usuario
var rutaBorrar = function(rutaID) {
	var nombreRuta = "";
	for( var i=0, ien=rutas.length ; i<ien ; i++ ) {
		if(rutas[i].id === rutaID) {
			nombreRuta = rutas[i].nombre;
			break;
		}
	}
	
	bootbox.confirm("¿Desea eliminar la ruta " + nombreRuta + " del sistema? ¡Esta acción es irreversible!", function(result) {
		if(result){
			$.ajax({
				url: API_ENDPOINT+'/rutas/ruta',
				type: 'DELETE',
				data: {accountID: ACCOUNTID, rutaID: rutaID},
				cache: false,
				success: function(data) {
					tabla.ajax.reload( null, false );
				}
			});
		}
	}); 
};


tabla = $(document).ready(function() {
	tabla = $('#dataTables-misrutas').DataTable( {
	  "ajax": {
		"url": API_ENDPOINT+"/rutas/empresa/"+ACCOUNTID,
		"dataSrc": function ( json ) {
			rutas = json.data;
			for ( var i=0, ien=json.data.length ; i<ien ; i++ ) {
				if(json.data[i].activo === "1") {
						htmlactivo = '<span class="glyphicon glyphicon-ok-circle"></span>';
						htmlacciones = '<a href="#" onClick="rutaEstadoCambiar(\''+json.data[i].accountID+'\', \''+json.data[i].id+'\', '+json.data[i].activo+')"><span class="glyphicon glyphicon-ban-circle"></span></a>';
					} else {
						htmlactivo = '<span class="glyphicon glyphicon-ban-circle"></span>';
						htmlacciones = '<a href="#" onClick="rutaEstadoCambiar(\''+json.data[i].accountID+'\', \''+json.data[i].id+'\', '+json.data[i].activo+')"><span class="glyphicon glyphicon-ok-circle"></span></a>';
					}
				
				
				json.data[i][0] = json.data[i].nombre;
				json.data[i][1] = json.data[i].tiempoTotal;
				json.data[i][2] = json.data[i].fecha_modificacion;
				json.data[i][3] = htmlactivo;
				json.data[i][4] = '<a href="#"><span class="glyphicon glyphicon-edit"></span></a> '+htmlacciones+' <a href="#" onClick="rutaBorrar(\''+json.data[i].id+'\')"><span class="glyphicon glyphicon-remove-circle"></span></a>';
			}
		  return json.data;
		}
	  }
	} );
 });