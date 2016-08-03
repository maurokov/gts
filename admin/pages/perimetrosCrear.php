<?php
require("_head.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require("_html_head.php"); ?>
    <title>mi Flota en Línea | Crear Perímetros</title>
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
                        <h1 class="page-header">Crear nuevo perímetro</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                <div class="row">
                	<div class="col-lg-9">
	                	<div id="map" style="width: 100%; height: 600px;"></div>
	                </div>
	                <div class="col-lg-3">
                    
                    	<form role="form" id="formNuevoPerimetro" data-toggle="validator">
                            
                            <div class="form-group">
                                <label>Nombre del perímetro</label>
                                <input class="form-control" id="nombrePerimetro" name="nombrePerimetro" data-minlength="2" placeholder="Ingrese nombrel perímetro" required>
                            </div>
                            
                            <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>
                        
                        </form>
                        
	                </div>
                </div>
                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php require("_html_script.php"); ?>
    
    <!-- GTS -->
    <script type="text/javascript">
		var tabla;
		var API_ENDPOINT = '<?=$API_ENDPOINT ?>';
		var ACCOUNTID = '<?=$_SESSION["accountID"] ?>';
	</script>
    
    <script>
	
		var path = [];
     
	
		function initMap() {
			var map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: -33.0477778, lng: -71.6011111},
				zoom: 14,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			
			var drawingManager = new google.maps.drawing.DrawingManager({
				drawingMode: google.maps.drawing.OverlayType.MARKER,
				drawingControl: true,
				drawingControlOptions: {
					position: google.maps.ControlPosition.TOP_CENTER,
					drawingModes: [
						google.maps.drawing.OverlayType.CIRCLE,
						google.maps.drawing.OverlayType.POLYGON
						//google.maps.drawing.OverlayType.POLYLINE,
						//google.maps.drawing.OverlayType.RECTANGLE
					]
				},
				//markerOptions: {icon: 'images/beachflag.png'},
				circleOptions: {
					strokeWeight: 2,
					clickable: false,
					editable: true,
					zIndex: 1
				}
			});
			drawingManager.setMap(map);
		  
			google.maps.event.addListener(drawingManager, 'circlecomplete', function(circle) {
				var radius = circle.getRadius();
				console.log('radius', circle.getRadius());
				console.log('lat', circle.getCenter().lat());
				console.log('lng', circle.getCenter().lng());
			});
			
			google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
				if (event.type == google.maps.drawing.OverlayType.CIRCLE) {
					var radius = event.overlay.getRadius();
				}
				
				if (event.type == google.maps.drawing.OverlayType.POLYGON) {
					var paths = event.overlay.getPath().getArray();
					//console.log(paths);
					for (var i = 0; i < paths.length; i++) {
						latLng = new Object();
						latLng.lat = paths[i].lat();
						latLng.lng = paths[i].lng();
					  	path.push(latLng);  
					}

					console.log(JSON.stringify(path));
				}
				console.log(event); 
			});
		}


	
	
    </script>

</body>

</html>
