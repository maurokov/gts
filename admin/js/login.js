$(function() {
	$('#form-submit').click(function(e){
	 	e.preventDefault();
	 	var l = Ladda.create(this);
	 	l.start();
		var user = $('#user').val();
		var pass = $('#pass').val();
	 	$.ajax({
			type: "GET",
			url: API_ENDPOINT+"login/"+user+"/"+pass,
			crossDomain: true,
			beforeSend: function() {
			},
			complete: function() {
				l.stop(); 
			},
			dataType: 'json',
			success: function(response) {
				if(response.status == 200) {
					if(response.data.valid == 1) {
						window.location.href = APP_ENDPOINT + 'pages/index.php';
					} else {
						alert("Error: Usuario o contraseña inválida.");
					}
				} else {
					alert("Error: Problema técnico.");
				}
			},
			error: function() {
				//console.error("error");
				alert('Error: No se puede conectar a nuestro backend.');
			},
			always: l.stop()
		});
	 	return false;
	});
});