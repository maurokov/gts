<?php

require("_head.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require("_html_head.php"); ?>
    <title>mi Flota en Línea | Gestión Rutas</title>
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
                        <h1 class="page-header">Gestión de mis rutas</h1>
                        
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            Mis Rutas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-misrutas">
                                    <thead>
                                        <tr>
                                            <th>Nombre Ruta</th>
                                            <th>Tiempo Total</th>
                                            <th>Modificada</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                    </div>
                    <!-- /.col-lg-12 -->
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
		var tabla;
		var API_ENDPOINT = '<?=$API_ENDPOINT ?>';
		var ACCOUNTID = '<?=$_SESSION["accountID"] ?>';
	</script>
    
    <script src="<?=versionjs('../js/flota-utils.js');?>"></script>
    <script src="<?=versionjs('../js/rutas.js');?>"></script>

</body>

</html>
