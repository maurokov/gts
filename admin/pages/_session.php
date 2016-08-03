<?php
session_start();

// Manejo de Sesion

if(isset($_SESSION['valid'])) {
	if($_SESSION['valid'] == 1) {
		//print_r($_SESSION);
	} else {
		header('Location: login.php');
	}
} else {
	header('Location: login.php');
}

?>