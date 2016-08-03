/*

	Funciones JS para Usuarios

*/

// Init
$("#panel-usuarios").hide();


// Cambiar estado
var usuarioEstadoCambiar = function(accountID, userID, estado) {
	$.ajax({
		url: API_ENDPOINT+'/usuarios/estado/'+userID+'/'+estado,
		type: 'POST',
		data: null,
		cache: false,
		success: function(data) {
			tabla.ajax.reload( null, false );
		}
	});
};

// Borrar usuario
var usuarioBorrar = function(accountID, userID) {
	bootbox.confirm("¿Desea eliminar al usuario " + userID + " del sistema?", function(result) {
		if(result){
			$.ajax({
				url: API_ENDPOINT+'/usuarios/user',
				type: 'DELETE',
				data: {accountID: accountID, userID: userID},
				cache: false,
				success: function(data) {
					tabla.ajax.reload( null, false );
				}
			});
		}
	}); 
	
};

// Modificar usuario
var usuarioEditar = function(accountID, userID) {
	
	// Se obtienen datos de usaurio
	$.ajax({
		url: API_ENDPOINT+'/usuarios/user',
		type: 'GET',
		data: {accountID: accountID, userID: userID},
		cache: false,
		success: function(json) {
			$("#contactName").val(json.data[0].contactName); 
			$("#userID").val(json.data[0].userID); 
			$("#password").val(json.data[0].password);
			$("#contactEmail").val(json.data[0].contactEmail);
			$("#contactPhone").val(json.data[0].contactPhone);
			$("#accountID").val(json.data[0].accountID);
			$("#active option[value='"+json.data[0].isActive+"']").attr("selected","selected");		
			usuariosForm('edit');
		}
	});
};

// Muestra formulario
var usuariosForm = function(modo) {
	
	if(modo === "edit") {  
		$("#userID").prop('readonly', true);
		$("#mode").val("edit");
	}
	if(modo === "new") {
		$("#userID").prop('readonly', false);
		$("#userID").val(""); 
		$("#contactName").val(""); 
		$("#contactEmail").val(""); 
		$("#contactPhone").val(""); 
		$("#password").val("");
		$("#accountID").val(ACCOUNTID);
		$("#mode").val("new");
	}
	
	$("#panel-usuarios").show();
	
};

// Tabla de datos
$(document).ready(function() {
	tabla = $('#dataTables-misrutas').DataTable( {
		responsive: true,
		
		"columnDefs": [
			{  "title": "Usuario", className: "dt-body-left", "targets": [ 0 ]},
			{  "title": "Nombre", className: "dt-body-right", "targets": [ 1 ]},
			{  "title": "Ult. Acceso", className: "dt-body-right", "targets": [ 2 ]},
			{  "title": "Estado", className: "dt-body-center", "targets": [ 3 ]},
			{  "title": "Acciones", className: "dt-body-center", "targets": [ 4 ]}
					  ],
		"ajax": {
			"url": API_ENDPOINT+"usuarios/empresa/"+ACCOUNTID,
			"dataSrc": function ( json ) {
				for ( var i=0, ien=json.data.length ; i<ien ; i++ ) {
					if(json.data[i].isActive === "1") {
						htmlactivo = '<span class="glyphicon glyphicon-ok-circle"></span>';
						htmlacciones = '<a href="#" onClick="usuarioEstadoCambiar(\''+json.data[i].accountID+'\', \''+json.data[i].userID+'\', '+json.data[i].isActive+')"><span class="glyphicon glyphicon-ban-circle"></span></a>';
					} else {
						htmlactivo = '<span class="glyphicon glyphicon-ban-circle"></span>';
						htmlacciones = '<a href="#" onClick="usuarioEstadoCambiar(\''+json.data[i].accountID+'\', \''+json.data[i].userID+'\', '+json.data[i].isActive+')"><span class="glyphicon glyphicon-ok-circle"></span></a>';
					}
					
					json.data[i][0] = json.data[i].userID;
					json.data[i][1] = json.data[i].contactName;
					json.data[i][2] = jsonFechaFormatoChile(json.data[i].lastLoginTime);
					json.data[i][3] = htmlactivo;
					json.data[i][4] = '<a href="#" onClick="usuarioEditar(\''+json.data[i].accountID+'\', \''+json.data[i].userID+'\')"><span class="glyphicon glyphicon-edit"></span></a> '+htmlacciones+' <a href="#" onClick="usuarioBorrar(\''+json.data[i].accountID+'\', \''+json.data[i].userID+'\')"><span class="glyphicon glyphicon-remove-circle"></span></a>';
				}
				return json.data;
			}
		}
	} );
 });
 
// Nuevo usuario 
$(function() {
	$('#form-submit').click(function(e){
	 	e.preventDefault();
	 	var l = Ladda.create(this);
	 	l.start();
		
		$.ajax({
			url: API_ENDPOINT+'usuarios/user',
			type: 'POST',
			data: $("#form-usuarios").serialize(),
			cache: false,
			success: function(data) {
				if(data.resp === true) {
					tabla.ajax.reload( null, false );
					$("#panel-usuarios").hide();
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


 