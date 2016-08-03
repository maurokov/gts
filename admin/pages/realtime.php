<?php

require("_head.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>mi Flota en Línea | Tiempo real</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
    	.labels {
		  color: black;
		  background-color: red;
		  font-family: "Lucida Grande", "Arial", sans-serif;
		  font-size: 10px;
		  text-align: center;
		  width: 70px;
		  white-space: nowrap;
		}		
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("_menu.php"); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tiempo real</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="form-group">
                            <select id="vehicles">
                              <option value="volvo">Volvo</option>
                              <option value="saab">Saab</option>
                              <option value="mercedes">Mercedes</option>
                              <option value="audi">Audi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-lg-10">
	                	<div id="mapcontainer" style="width: 100%; height: 600px;"></div>
	                </div>
                    <div class="col-lg-2">
                    	Resumen de mi Flota
	                </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php require("_html_script.php"); ?>
    
    <!-- GTS -->
    <script type="text/javascript">
		var API_ENDPOINT = '<?=$API_ENDPOINT ?>';
		var ACCOUNTID = '<?=$_SESSION["accountID"] ?>';
	</script>
    
    <script type="text/javascript">
	
		var map = null;
		var g;
		var markers = [];
		var datos = [];

		function initMap(){
			g = google.maps;
			var mapOptions = {
				zoom: 14,
				center: new g.LatLng(-33.0477778, -71.6011111), 
				mapTypeId: g.MapTypeId.ROADMAP,
				draggableCursor: 'auto',
				draggingCursor: 'move',
				disableDoubleClickZoom: true
			};
			map = new g.Map(document.getElementById('mapcontainer'), mapOptions);
			//g.event.addListener(map, "click", mapLeftClick);
			mapHolder = null;
			mapOptions = null;
			
			loadData();
		};
		
		// Adds a marker to the map.
		function addMarker(location, label) {
			var marker = new MarkerWithLabel({
				position: location,
				map: map,
				draggable: false,
				raiseOnDrag: true,
				labelContent: label,
				labelAnchor: new google.maps.Point(22, 0),
				labelClass: "labels", // the CSS class for the label
				labelStyle: {opacity: 0.75}
				
				
	
				//size: new google.maps.Size(20, 20),
			//77	labelAnchor: new google.maps.Point(35, 120),
				//labelClass: "labels", // the CSS class for the label
				//labelInBackground: false,
				//icon: pinSymbol('red')
			});
		  	markers.push(marker);
		}
		
		window.onload = function() {
			initMap('mapcontainer');
		};
		
		
		var loadData = function() {
			fillVehicles();

			$.ajax({
				url: API_ENDPOINT+'/event/empresa/'+ACCOUNTID,
				type: 'GET',
				data: null,
				cache: false,
				success: function(data) {
					$.each(data.data,function(index, value){
						console.log('My array has at position ' + index + ', this value: ' + value);
						$.each(value,function(index, value){
												console.log('My ' + index + ', this value: ' + value);
	
						});
						deviceID = value.deviceID;
						ts = value.timestamp;
						status = value.statusCode;
						lat = value.latitude;
						lng = value.longitude;
						myLatlng = new google.maps.LatLng(lat,lng);
						console.log(myLatlng);
						console.log(map);
						
						addMarker(myLatlng, deviceID);
					});
				}
			});		
		
		
		};
		
		function pinSymbol(color) {
		  return {
			path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
			fillColor: color,
			fillOpacity: 1,
			strokeColor: '#000',
			strokeWeight: 2,
			scale: 4
		  };
		};
		
		
		// Llenar Vehiculos
		
		function fillVehicles() {
			$.ajax({
				url: API_ENDPOINT+'/devices/empresa/'+ACCOUNTID,
				type: 'GET',
				data: null,
				cache: false,
				success: function(data) {
					var $select = $('#vehicles'); 
					$select.find('option').remove();  
					$select.append('<option value="0" selected>Todos</option>');
					$.each(data.data,function(index, value){
						description = value.description;					
						$select.append('<option value=' + description + '>' + description + '</option>');
					});
				}
			});		
		
		}
				
	
	
	</script>

</body>

</html>
