<?php
require("_head.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require("_html_head.php"); ?>
    <title>mi Flota en Línea | Crear Rutas</title>
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
                        <h1 class="page-header">Crear nueva ruta</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                <div class="row">
                	<div class="col-lg-6">
	                	<div id="map" style="width: 100%; height: 600px;"></div>
	                </div>
	                <div class="col-lg-6">
                    
                    	<form role="form" id="formNuevaRuta" data-toggle="validator">
	                		                	
                            <div class="table-responsive">
                                <table id="tablaRuta" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>N</th>
                                            <th>Direccion (aprox.)</th>
                                            <th>Tiempo (min)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                            <div class="form-group">
                                <label>Nombre de la ruta</label>
                                <input class="form-control" id="nombreRuta" name="nombreRuta" data-minlength="2" placeholder="Ingrese nombre de la ruta" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Tiempo Total</label>
                                <input class="form-control" id="total" name="total" readonly required>
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
    
    <script src="<?=versionjs('../js/mapas.js');?>"></script>

</body>

</html>
