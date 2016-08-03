<?php
	require("_head.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require("_html_head.php"); ?>
    <title>mi Flota en Línea | Gestión Conductores</title>
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
                        <h1 class="page-header">Gestión de conductores</h1>
                        
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            Conductores
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs" onClick="usuariosForm('new')">
                                        Nuevo conductor
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-conductores">                                    
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
                
                <div class="row">
                	<div class="col-lg-12">
                        
                        <div class="panel panel-green" id="panel-conductores">
                        <div class="panel-heading">
                            Crear conductor
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        
                        	<form role="form" id="form-conductores" autocomplete="off">
                            	<div class="form-group">
                                    <label>RUT</label>
                                    <input class="form-control" type="text" name="licenseNumber" id="licenseNumber" maxlength="11" oninput="validaRut(this)" required>
                                    <p class="help-block">RUT sin puntos ni guión.</p>
                                </div>
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" type="text" name="description" id="description" maxlength="128" autocomplete="off" required>
                                    <p class="help-block">Nombre completo de conductor.</p>
                                </div>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input class="form-control" type="number" name="contactPhone" id="contactPhone"  maxlength="32" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>Activo</label>
                                    <select class="form-control" name="active" id="active">
                                        <option value="1" selected>Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>	
                               
                               	<input type="hidden" name="accountID" id="accountID" value="<?=$_SESSION["accountID"] ?>">
                                <input type="hidden" name="mode" id="mode" value="">
                                
                                <a href="#" id="form-submit" class="btn btn-lg btn-success ladda-button" data-style="expand-left"><span class="ladda-label">Guardar</span></a>
                                
                            </form>

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
    <script src="<?=versionjs('../js/conductores.js');?>"></script>
    
</body>

</html>
