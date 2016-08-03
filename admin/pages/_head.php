<?php

require("_session.php");


// Definicion de variables
$APP_ENDPOINT = "http://".$_SERVER['SERVER_NAME']."/admin/";
$API_ENDPOINT = "http://".$_SERVER['SERVER_NAME']."/api/";

// Definicion de funciones
function versionjs($file_name){ echo $file_name."?v=".time(); }

?>