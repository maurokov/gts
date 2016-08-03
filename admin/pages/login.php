<?php

session_start();

// Definicion de variables
$APP_ENDPOINT = "http://".$_SERVER['SERVER_NAME']."/admin/";
$API_ENDPOINT = "http://".$_SERVER['SERVER_NAME']."/api/";

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require("_html_head.php"); ?>
    <title>mi Flota en Línea | Iniciar sesión</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">mi Flota en Línea</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" id="user" placeholder="Usuario" name="user" type="text" maxlength="32" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="pass" placeholder="Contraseña" name="password" type="password" maxlength="32">
                                </div> 
                                <!-- Change this to a button or input when using this as a form -->
                                <a href="#" id="form-submit" class="btn btn-lg btn-success btn-block ladda-button" data-style="expand-left"><span class="ladda-label">Iniciar sesión</span></a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require("_html_script.php"); ?>

	<script type="text/javascript">
		var APP_ENDPOINT = '<?=$APP_ENDPOINT ?>';
		var API_ENDPOINT = '<?=$API_ENDPOINT ?>';
	</script>

	<script src="../js/login.js"></script>

</body>

</html>
