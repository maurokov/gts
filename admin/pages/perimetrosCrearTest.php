<!DOCTYPE html>
<html>
  <head>
    <title>Drawing tools</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    
    <?php require("_html_script.php"); ?>
    
    <script>
	
     
	
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
					var coordinatesArray = event.overlay.getPath().getArray();
					console.log(coordinatesArray);
				}
				console.log(event); 
			});
		}


	
	
    </script>

  </body>
</html>