<?php

/*
	Conductores
*/

// Obtiene usuarios de empresa
$app->get("/conductores/empresa/{company}",  function ($request, $response, $args)  {
    $conn = $this->get("db");
	$company = $args['company'];
	$result = $conn->prepare("SELECT Driver.* FROM Driver WHERE Driver.accountID = ? ORDER BY Driver.driverID ASC");
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

// Obtiene usuario por driverID
$app->get("/conductores/conductor", function ($request, $response, $args)  {
	$conn = $this->get("db");
	$form = $request->getQueryParams();
	
	$driverID = $form['driverID'];
	$accountID = $form['accountID'];
	
	$result = $conn->prepare("SELECT * FROM Driver WHERE driverID = ? AND accountID = ?");
	$result->bindParam('1', $driverID);
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

// Crea o edita nuevo usuario
$app->post("/conductores/conductor",  function ($request, $response, $args)  {
	$conn = $this->get("db");
	$form = $request->getParsedBody();
	
	$licenseNumber = $form['licenseNumber'];
	$description = $form['description'];
	$contactPhone = $form['contactPhone'];
	$active = $form['active'];
	$accountID = $form['accountID'];
	$mode = $form['mode'];
	$exp = "";

	try {  
		if($mode == "new") {
			$res = $conn->prepare("INSERT INTO Driver (licenseNumber, description, contactPhone, driverStatus, driverID, accountID) VALUES (?, ?, ?, ?, ?, ?)");
			$res->bindParam(1, $licenseNumber, PDO::PARAM_STR);
			$res->bindParam(2, $description, PDO::PARAM_STR);
			$res->bindParam(3, $contactPhone, PDO::PARAM_STR);
			$res->bindParam(4, $active, PDO::PARAM_INT);
			$res->bindParam(5, $licenseNumber, PDO::PARAM_STR); // PK - driverID
			$res->bindParam(6, $accountID, PDO::PARAM_STR);
		} else if($mode == "edit") {
			$res = $conn->prepare("UPDATE Driver SET description = ?, contactPhone = ?, driverStatus = ? WHERE driverID = ? AND accountID = ?");
			$res->bindParam(1, $description, PDO::PARAM_STR);
			$res->bindParam(2, $contactPhone, PDO::PARAM_STR);
			$res->bindParam(3, $active, PDO::PARAM_INT);
			$res->bindParam(4, $licenseNumber, PDO::PARAM_STR);
			$res->bindParam(5, $accountID, PDO::PARAM_STR);
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

$app->delete("/conductores/conductor",  function ($request, $response, $args)  {
	$conn = $this->get("db");
	$form = $request->getParsedBody();
	
	$driverID = $form['driverID'];
	$accountID = $form['accountID'];
	
	$exp = "";

	try {  
		$res = $conn->prepare("DELETE FROM Driver WHERE driverID = ? AND accountID = ?");
		$res->bindParam(1, $driverID, PDO::PARAM_STR);
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


?>