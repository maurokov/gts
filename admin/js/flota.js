// JavaScript Document

$(document).ready(function() {
	tabla = $('#dataTables-misrutas').DataTable( {
	  "ajax": {
		"url": API_ENDPOINT+"devices/empresa/"+ACCOUNTID,
		"dataSrc": function ( json ) {
		  for ( var i=0, ien=json.data.length ; i<ien ; i++ ) {
			json.data[i][0] = json.data[i].deviceID;
			json.data[i][1] = json.data[i].description;
			json.data[i][2] = jsonFechaFormatoChile(json.data[i].lastEventTimestamp);
			if(json.data[i].isActive === "1") json.data[i][3] = '<span class="glyphicon glyphicon-ok-circle"></span>';
			else json.data[i][3] = '<span class="glyphicon glyphicon-ban-circle"></span>';
			json.data[i][4] = '<a href="#"><span class="glyphicon glyphicon-edit"></span></a> <a href="#"><span class="glyphicon glyphicon-ban-circle"></span></a> <a href="#"><span class="glyphicon glyphicon-remove-circle"></span></a>';
		  }
		  return json.data;
		}
	  }
	} );
 });