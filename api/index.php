<?php

session_start();

require 'vendor/autoload.php';

$app = new Slim\App();

$container = $app->getContainer();

// BD
$bd_dns  = 'mysql:host=127.0.0.1;dbname=gts';
$bd_user = 'gtsdevel';
$bd_pass = 'gtsdevel.,2016';
$bd_opt  = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
); 
$container["db"] = new PDO($bd_dns, $bd_user, $bd_pass, $bd_opt);

/*
	Metodos de API Flota
*/

// Login
$app->get("/login/{user}/{password}",  function ($request, $response, $args)  {
    $conn = $this->get("db");
	
	$user = $args['user'];
	$pass = $args['password'];
	$tiempo = time();
	
	$result = $conn->prepare("SELECT * FROM User WHERE userID= :user AND password= :pass AND isActive=1 LIMIT 1");
	$result->bindParam(':user', $user, PDO::PARAM_STR);
	$result->bindParam(':pass', $pass, PDO::PARAM_STR);
	$result->execute();
	
	if($row=$result->fetch(PDO::FETCH_ASSOC)) {		
		$_SESSION['valid'] = 1;
		$_SESSION['accountID'] = $row['accountID'];
		$_SESSION['userID'] = $row['userID'];
		$_SESSION['lastLoginTime'] = $row['lastLoginTime'];
		
		$resp['status'] = 200;
		$data['valid'] = 1;
		$resp['data'] = $data;
		
		// Actualizar lastLoginTime
		$result = $conn->prepare("UPDATE User SET lastLoginTime = ? WHERE userID = ?");
		$result->bindParam('1', $tiempo);
		$result->bindParam('2', $row['userID']);
		$result->execute();
		
    }
	else{
		$_SESSION['valid'] = 0;
		
		$resp['status'] = 200;
		$data['valid'] = 0;
		$resp['data'] = $data;
	}
	$response->getBody()->write(json_encode($resp));
	
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});

// Logout
$app->get("/logout",  function ($request, $response, $args)  {
	$_SESSION['valid'] = 0;
	$_SESSION['accountID'] = '';
	$resp['status'] = 200;
	$data['valid'] = 0;
	$resp['data'] = $data;
	$response->getBody()->write(json_encode($resp));
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});

// Obtiene usuarios de empresa
$app->get("/usuarios/empresa/{company}",  function ($request, $response, $args)  {
    $conn = $this->get("db");
	
	$company = $args['company'];
	
	$result = $conn->prepare("SELECT User.* FROM User WHERE User.accountID = ? ORDER BY User.userID ASC");
	$result->bindParam('1', $company, PDO::PARAM_STR);
	$result->execute();
	
	$datos = $result->fetchAll();
	
	$resp['status'] = 200;
	$resp['data'] = $datos;

	$response->getBody()->write(json_encode($resp));
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});

// Cambia estado de usuario
$app->post("/usuarios/estado/{userID}/{estado}",  function ($request, $response, $args)  {
    $conn = $this->get("db");
	
	$userID = $args['userID'];
	$estado = $args['estado'];
	
	if($estado) $isActive = 0;
	else $isActive = 1;
	
	$result = $conn->prepare("UPDATE User SET isActive = ? WHERE userID = ?");
	$result->bindParam('1', $isActive, PDO::PARAM_INT);
	$result->bindParam('2', $userID, PDO::PARAM_STR);
	$result->execute();
		
	$resp['status'] = 200;
	//$resp['data'] = $datos;

	$response->getBody()->write(json_encode($resp));
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});

// Obtiene usuario por userID
$app->get("/usuarios/user", function ($request, $response, $args)  {
	$conn = $this->get("db");
	$form = $request->getQueryParams();
	
	$userID = $form['userID'];
	$accountID = $form['accountID'];
	
	$result = $conn->prepare("SELECT * FROM User WHERE userID = ? AND accountID = ?");
	$result->bindParam('1', $userID);
	$result->bindParam('2', $accountID);
	$result->execute();
	
	$datos = $result->fetchAll();
	
	$resp['status'] = 200;
	$resp['data'] = $datos;

	$response->getBody()->write(json_encode($resp));
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});

// Crea/Edita nuevo usuario
$app->post("/usuarios/user",  function ($request, $response, $args)  {
	$conn = $this->get("db");
	$form = $request->getParsedBody();
	
	$userID = $form['userID'];
	$password = $form['password'];
	$contactName = $form['contactName'];
	$contactEmail = $form['contactEmail'];
	$contactPhone = $form['contactPhone'];
	$active = $form['active'];
	$accountID = $form['accountID'];
	$mode = $form['mode'];
	$exp = "";

	try {  
		if($mode == "new") {
			$res = $conn->prepare("INSERT INTO User (userID, password, contactName, contactEmail, contactPhone, isActive, accountID) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$res->bindParam(1, $userID, PDO::PARAM_STR);
			$res->bindParam(2, $password, PDO::PARAM_STR);
			$res->bindParam(3, $contactName, PDO::PARAM_STR);
			$res->bindParam(4, $contactEmail, PDO::PARAM_STR);
			$res->bindParam(5, $contactPhone, PDO::PARAM_STR);
			$res->bindParam(6, $active, PDO::PARAM_INT);
			$res->bindParam(7, $accountID, PDO::PARAM_STR);
		} else if($mode == "edit") {
			$res = $conn->prepare("UPDATE User SET contactName = ?, contactEmail = ?, contactPhone = ?, isActive = ?, password = ? WHERE userID = ? AND accountID = ?");
			$res->bindParam(1, $contactName, PDO::PARAM_STR);
			$res->bindParam(2, $contactEmail, PDO::PARAM_STR);
			$res->bindParam(3, $contactPhone, PDO::PARAM_STR);
			$res->bindParam(4, $active, PDO::PARAM_INT);
			$res->bindParam(5, $password, PDO::PARAM_STR);
			$res->bindParam(6, $userID, PDO::PARAM_STR);
			$res->bindParam(7, $accountID, PDO::PARAM_STR);
		}
		$result = $res->execute();
	} catch(PDOException $e) {
		$exp = $e;
	}

	if(isset($result)) {
		if($result) $resp["resp"] = true;
		else $resp["resp"] = false;
	}
	
	$resp['status'] = 200;
	$resp['exception'] = $exp;
	$response->getBody()->write(json_encode($resp));
	
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});

$app->delete("/usuarios/user",  function ($request, $response, $args)  {
	$conn = $this->get("db");
	$form = $request->getParsedBody();
	
	$userID = $form['userID'];
	$accountID = $form['accountID'];
	
	$exp = "";

	try {  
		$res = $conn->prepare("DELETE FROM User WHERE userID = ? AND accountID = ?");
		$res->bindParam(1, $userID, PDO::PARAM_STR);
		$res->bindParam(2, $accountID, PDO::PARAM_STR);
		$result = $res->execute();
	} catch(PDOException $e) {
		$exp = $e;
	}

	if(isset($result)) {
		if($result) $resp["resp"] = true;
		else $resp["resp"] = false;
	}
	
	$resp['status'] = 200;
	$resp['exception'] = $exp;
	$response->getBody()->write(json_encode($resp));
	
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});


/*
	Device - Vehiculos (Equipo GPS)
*/

// Obtiene devices de empresa
$app->get("/devices/empresa/{company}",  function ($request, $response, $args)  {
    $conn = $this->get("db");
	
	$company = $args['company'];
	
	$result = $conn->prepare("SELECT Device.* FROM Device WHERE Device.accountID = ?");
	$result->bindParam('1', $company);
	$result->execute();
	
	$datos = $result->fetchAll();
	
	$resp['status'] = 200;
	$resp['data'] = $datos;

	$response->getBody()->write(json_encode($resp));
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});


/* 
	Rutas
*/

$app->post("/rutas/ruta/empresa_hoja_ruta/{empresa}",  function ($request, $response, $args)  {
    $conn = $this->get("db");
	
	$empresa = $args['empresa'];
	
	$result = $conn->prepare("SELECT nombre,tiempoTotal FROM ix_Rutas WHERE accountID = ?");	
	$result->bindParam('1', $empresa, PDO::PARAM_STR); // --> PARAM_INT... es PARAM_STR
	$result->execute();

	$datos = array();
	while($row = $result->fetch( PDO::FETCH_ASSOC )){ 
		$dato['nombre'] = $row['nombre'];
		$dato['tiempoTotal'] = $row['tiempoTotal'];
		array_push($datos, $dato);
	}
		
	$resp['status'] = 200;
	$resp['data'] = $datos;


	$response->getBody()->write(json_encode($resp));
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});

// Obtiene rutas de empresa
// Mira fijate son iguales el de arriba con el de abajo... el tema es que fijate en esto este es lo mismo..
$app->get("/rutas/empresa/{company}",  function ($request, $response, $args)  {
    $conn = $this->get("db");
	
	$company = $args['company'];
	
	$result = $conn->prepare("SELECT * FROM ix_Rutas WHERE accountID = :company");
	$result->bindParam(':company', $company);
	$result->execute();
	
	$datos = array();
	while($row = $result->fetch( PDO::FETCH_ASSOC )){ 
		$dato['id'] = $row['id'];
		$dato['nombre'] = $row['nombre'];
		$dato['tiempoTotal'] = $row['tiempoTotal'];
		$dato['fecha_creacion'] = $row['fecha_creacion'];
		$dato['fecha_modificacion'] = $row['fecha_modificacion'];
		$dato['activo'] = $row['activo'];
		$dato['puntos'] = json_decode($row['puntos']);
		array_push($datos, $dato);
	}
	
	$resp['status'] = 200;
	$resp['data'] = $datos;

	$response->getBody()->write(json_encode($resp));
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});

// Agrega Ruta Nueva
$app->post("/rutas/ruta",  function ($request, $response, $args)  {
	$conn = $this->get("db");
	$form = $request->getParsedBody();
	
	$nombre = $form['nombreRuta'];
	$tiempo = $form['total'];
	
	$puntos = array();
	foreach($form as $key => $param){
		if (preg_match('/tiempo/',$key)) {
			$punto['tiempo'] = $param;
		}
		if (preg_match('/lat/',$key)) {
			$punto['lat'] = $param;
		}
		if (preg_match('/lng/',$key)) {
			$punto['lng'] = $param;
			array_push($puntos, $punto);
		}
	}
	$puntos = json_encode($puntos);
	
	$res = $conn->prepare("INSERT INTO ix_Rutas (nombre, tiempoTotal, puntos, accountID, userID) VALUES (?, ?, ?, ?, ?)");
	$res->bindParam(1, $nombre, PDO::PARAM_STR);
	$res->bindParam(2, $tiempo, PDO::PARAM_INT);
	$res->bindParam(3, $puntos, PDO::PARAM_STR);
	$res->bindParam(4, $_SESSION['accountID'], PDO::PARAM_INT);
	$res->bindParam(5, $_SESSION['userID'], PDO::PARAM_INT);
	$result = $res->execute();

	if($result) $resp["resp"] = true;
	else $resp["resp"] = false;
	$response->getBody()->write(json_encode($resp));
	
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});

// Modifica Ruta


// Cambia estado de ruta
$app->post("/rutas/ruta/estado/{rutaID}/{estado}",  function ($request, $response, $args)  {
    $conn = $this->get("db");
	
	$rutaID = $args['rutaID'];
	$estado = $args['estado'];
	
	if($estado) $isActive = 0;
	else $isActive = 1;
	
	$result = $conn->prepare("UPDATE ix_Rutas SET activo = ? WHERE id = ?");
	$result->bindParam('1', $isActive, PDO::PARAM_INT);
	$result->bindParam('2', $rutaID, PDO::PARAM_INT);
	$result->execute();
		
	$resp['status'] = 200;
	//$resp['data'] = $datos;

	$response->getBody()->write(json_encode($resp));
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});


// Elimina Ruta
$app->delete("/rutas/ruta",  function ($request, $response, $args)  {
	$conn = $this->get("db");
	$form = $request->getParsedBody();
	
	$rutaID = $form['rutaID'];
	$accountID = $form['accountID'];
	
	$exp = "";

	try {  
		$res = $conn->prepare("DELETE FROM ix_Rutas WHERE id = ? AND accountID = ?");
		$res->bindParam(1, $rutaID, PDO::PARAM_STR);
		$res->bindParam(2, $accountID, PDO::PARAM_STR);
		$result = $res->execute();
	} catch(PDOException $e) {
		$exp = $e;
	}

	if(isset($result)) {
		if($result) $resp["resp"] = true;
		else $resp["resp"] = false;
	}
	
	$resp['status'] = 200;
	$resp['exception'] = $exp;
	$response->getBody()->write(json_encode($resp));
	
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});



// Perimetros




/* 
	Metodos de Eventos (GPS)
*/

// Obtiene puntos GPS (Ultimo punto por device de accountID)	
$app->get("/event/empresa/{company}",  function ($request, $response, $args)  {
    $conn = $this->get("db");
	$company = $args['company'];

	try {
		$sqlMode = $conn->exec("SET sql_mode = ''");
		$stmt = $conn->prepare("SELECT ed.* FROM (SELECT deviceID, MAX(timestamp) AS timestamp FROM EventData WHERE accountID = ? AND latitude != 0 AND longitude !=0 GROUP BY deviceID) l JOIN EventData ed ON ed.deviceID = l.deviceID AND ed.timestamp = l.timestamp GROUP BY ed.timestamp, ed.deviceID");
		$stmt->bindParam('1', $company, PDO::PARAM_STR);
		$stmt->execute();		
	}
	catch (PDOException $e){
		$resp['e'] = $e;
	}
	catch (Exception $e) {
	 	$resp['e'] = $e;
	}
	$datos = $stmt->fetchAll();
	
	$resp['status'] = 200;
	$resp['data'] = $datos;

	$response->getBody()->write(json_encode($resp));
	$jResponse = $response->withHeader(
        'Content-type',
        'application/json; charset=utf-8'
    );
    return $jResponse;
});


/*
//GET
$allGetVars = $request->getQueryParams();
foreach($allGetVars as $key => $param){
   //GET parameters list
}

//POST or PUT
$allPostPutVars = $request->getParsedBody();
foreach($allPostPutVars as $key => $param){
   //POST or PUT parameters list
}
*/

include("routes/conductores.php");


$app->run();

