/*

	Funciones JS para Usuarios

*/

// Init
$("#panel-conductores").hide();


// Cambiar estado
var conductorEstadoCambiar = function(accountID, userID, estado) {
	$.ajax({
		url: API_ENDPOINT+'/conductores/estado/'+userID+'/'+estado,
		type: 'POST',
		data: null,
		cache: false,
		success: function(data) {
			tabla.ajax.reload( null, false );
		}
	});
};

// Borrar chofer
var conductorBorrar = function(accountID, driverID) {
	bootbox.confirm("¿Desea eliminar al conductor " + driverID + " del sistema?", function(result) {
		if(result){
			$.ajax({
				url: API_ENDPOINT+'/conductores/conductor',
				type: 'DELETE',
				data: {accountID: accountID, driverID: driverID},
				cache: false,
				success: function(data) {
					tabla.ajax.reload( null, false );
				}
			});
		}
	}); 
	
};

// Modificar chofer
var conductorEditar = function(accountID, driverID) {
	
	// Se obtienen datos de usaurio
	$.ajax({
		url: API_ENDPOINT+'/conductores/conductor',
		type: 'GET',
		data: {accountID: accountID, driverID: driverID},
		cache: false,
		success: function(json) {
			$("#licenseNumber").val(json.data[0].licenseNumber);
			$("#description").val(json.data[0].description);
			$("#contactPhone").val(json.data[0].contactPhone);
			$("#accountID").val(json.data[0].accountID);
			$("#active option[value='"+json.data[0].driverStatus+"']").attr("selected","selected");		
			usuariosForm('edit');
		}
	});
};

// Muestra formulario
var usuariosForm = function(modo) {
	
	if(modo === "edit") {  
		$("#licenseNumber").prop('readonly', true);
		$("#mode").val("edit");
	}
	if(modo === "new") {
		$("#licenseNumber").prop('readonly', false);
		$("#licenseNumber").val(""); 
		$("#description").val(""); 
		$("#contactPhone").val("");
		$("#accountID").val(ACCOUNTID);
		$("#mode").val("new");
	}
	
	$("#panel-conductores").show();
	
};

// Tabla de datos
$(document).ready(function() {
	tabla = $('#dataTables-conductores').DataTable( {
		responsive: true,
		
		"columnDefs": [
			{  "title": "Nombre", className: "dt-body-right", "targets": [ 0 ]},
			{  "title": "RUT", className: "dt-body-right", "targets": [ 1 ]},
			{  "title": "Teléfono", className: "dt-body-right", "targets": [ 2 ]},
			{  "title": "Estado", className: "dt-body-center", "targets": [ 3 ]},
			{  "title": "Acciones", className: "dt-body-center", "targets": [ 4 ]}
					  ],
		"ajax": {
			"url": API_ENDPOINT+"conductores/empresa/"+ACCOUNTID,
			"dataSrc": function ( json ) {
				for ( var i=0, ien=json.data.length ; i<ien ; i++ ) {
					if(json.data[i].driverStatus === "1") {
						htmlactivo = '<span class="glyphicon glyphicon-ok-circle"></span>';
						htmlacciones = '<a href="#" onClick="conductorEstadoCambiar(\''+json.data[i].accountID+'\', \''+json.data[i].driverID+'\', '+json.data[i].driverStatus+')"><span class="glyphicon glyphicon-ban-circle"></span></a>';
					} else {
						htmlactivo = '<span class="glyphicon glyphicon-ban-circle"></span>';
						htmlacciones = '<a href="#" onClick="conductorEstadoCambiar(\''+json.data[i].accountID+'\', \''+json.data[i].driverID+'\', '+json.data[i].driverStatus+')"><span class="glyphicon glyphicon-ok-circle"></span></a>';
					}
					
					json.data[i][0] = json.data[i].description;
					json.data[i][1] = json.data[i].licenseNumber;
					json.data[i][2] = json.data[i].contactPhone;
					json.data[i][3] = htmlactivo;
					json.data[i][4] = '<a href="#" onClick="conductorEditar(\''+json.data[i].accountID+'\', \''+json.data[i].driverID+'\')"><span class="glyphicon glyphicon-edit"></span></a> '+htmlacciones+' <a href="#" onClick="conductorBorrar(\''+json.data[i].accountID+'\', \''+json.data[i].driverID+'\')"><span class="glyphicon glyphicon-remove-circle"></span></a>';
				}
				return json.data;
			}
		}
	} );
 });
 
// Nuevo chofer 
$(function() {
	$('#form-submit').click(function(e){
	 	e.preventDefault();
	 	var l = Ladda.create(this);
	 	l.start();
		
		$.ajax({
			url: API_ENDPOINT+'conductores/conductor',
			type: 'POST',
			data: $("#form-conductores").serialize(),
			cache: false,
			success: function(data) {
				if(data.resp === true) {
					tabla.ajax.reload( null, false );
					$("#panel-conductores").hide();
				} else {
					alert('Ha ocurrido un error. Error msg: ' + data.exception);
				}
			},
			always: l.stop()
		});
	
	 	return false;
	});
});

// Modificar usaurio


 