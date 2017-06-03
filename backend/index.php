<?php
require_once "vendor/autoload.php";
require 'jwt/vendor/autoload.php';
use \Firebase\JWT\JWT;

//instancia de slim
$app = new \Slim\Slim();

// Definimos conexion de la base de datos, utilizando PDO con el driver mysql.
define('BD_SERVIDOR', 'localhost');
define('BD_NOMBRE', 'pizzeria');
define('BD_USUARIO', 'root');
define('BD_PASSWORD', '');

// Hacemos la conexión a la base de datos con PDO.
// Para activar las collations en UTF8 podemos hacerlo al crear la conexión por PDO
// o bien una vez hecha la conexión con
// $db->exec("set names utf8");
$db = new PDO('mysql:host=' . BD_SERVIDOR . ';dbname=' . BD_NOMBRE . ';charset=utf8', BD_USUARIO, BD_PASSWORD);


// Si necesitamos acceder a alguna variable global en el framework
// Tenemos que pasarla con use() en la cabecera de la función. Ejemplo: use($db)
$app->get('/traerTodos', function() use($db,$app) {

	// Preparamos la consulta a la tabla.
	$consulta = $db->prepare("select * from usuarios");
	$consulta->execute();
	// Almacenamos los resultados en un array asociativo.
	$resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($resultados));
});



$app->post("/auth", function() use($app, $db)
{


	require_once "clases/usuario.php";

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por post
	$p = $app->request->post();



	$consulta = $db->prepare("SELECT U.id, U.nombre, U.apellido, U.email, U.perfil, U.sexo
						FROM usuarios U
						WHERE U.email = :email AND U.password = :pass");
	$status = 200;




	$consulta->bindValue(":email", $p['email'], PDO::PARAM_STR);
	$consulta->bindValue(":pass", $p['clave'], PDO::PARAM_STR);
	// $consulta->bindValue(":email", "admin@admin.com", PDO::PARAM_STR);
	// $consulta->bindValue(":pass", "12345", PDO::PARAM_STR);
	
	$consulta->execute();
	
	$usuarioLogueado = $consulta->fetchObject('Usuario');


	if ($usuarioLogueado)
	{

		$key = "varela";
		$token = array(
		    "nombre" => $usuarioLogueado->nombre,
		    "apellido" => $usuarioLogueado->apellido,
		    "email" => $usuarioLogueado->email,
		    "perfil" => $usuarioLogueado->perfil,
		    "exp"=> time()+100000
		);

		$jwt = JWT::encode($token, $key);
		$tok['token'] = $jwt;

		$decoded = JWT::decode($jwt, $key, array('HS256'));
		$decoded_array = (array) $decoded;
		JWT::$leeway = 60; // $leeway in seconds
	}

	else
	{
		$tok['err'] = "¡Usuario o Clave Incorrecta!";
	}


// $resultados = array('asd' => $usuarioLogueado);
// $app->response->headers->set("Content-type", "application/json");
// 	$app->response->status(200);
// 	$app->response->body(json_encode($resultados));
// return;

// print_r(json_encode($res));

// print_r("\n-----\n");

// print_r($usuarioLogueado);
// print_r(json_encode($res));
// die();


	// // En el execute es dónde asociamos el :param1 con el valor que le toque.
	// if ($exito)
	// 	$res = array("rta" => true);
	// else{
	// 	$res = array("rta" => false);
	// 	$status = 500;
	// }

	// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($tok));
	return;
});



$app->post("/auth/login", function() use($app, $db)
{


	require_once "clases/usuario.php";


	
	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por post
	$p = $app->request->post();


	$consulta = $db->prepare("SELECT U.id, U.nombre, U.apellido, U.email, U.perfil, U.sexo
						FROM usuarios U
						WHERE U.email = :email AND U.password = :pass");
	$status = 200;

	$consulta->bindValue(":email", $p['email'], PDO::PARAM_STR);
	$consulta->bindValue(":pass", $p['clave'], PDO::PARAM_STR);
	// $consulta->bindValue(":email", "pepe", PDO::PARAM_STR);
	// $consulta->bindValue(":pass", "123", PDO::PARAM_STR);
	
	$consulta->execute();
	
	$usuarioLogueado = $consulta->fetchObject('Usuario');


	if ($usuarioLogueado)
	{

		$key = "varela";
		$token = array(
		    "nombre" => $usuarioLogueado->nombre,
		    "apellido" => $usuarioLogueado->apellido,
		    "email" => $usuarioLogueado->email,
		    "perfil" => $usuarioLogueado->perfil,
		    "exp"=> time()+100000
		);

		$jwt = JWT::encode($token, $key);
		$tok['token'] = $jwt;
		print_r(json_encode($tok));

		$decoded = JWT::decode($jwt, $key, array('HS256'));
		print_r($decoded);
		$decoded_array = (array) $decoded;
		JWT::$leeway = 60; // $leeway in seconds
		$decoded = JWT::decode($jwt, $key, array('HS256'));

	}

	else
	{
		$tok['err'] = "¡Usuario o Clave Incorrecta!";
	}


	// // En el execute es dónde asociamos el :param1 con el valor que le toque.
	// if ($exito)
	// 	$res = array("rta" => true);
	// else{
	// 	$res = array("rta" => false);
	// 	$status = 500;
	// }

	// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($tok));
});














/* ANTES
// Si necesitamos acceder a alguna variable global en el framework
// Tenemos que pasarla con use() en la cabecera de la función. Ejemplo: use($db)
$app->get('/traerTodos', function() use($db,$app) {

	// Preparamos la consulta a la tabla.
	$consulta = $db->prepare("select * from persona");
	$consulta->execute();
	// Almacenamos los resultados en un array asociativo.
	$resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($resultados));
});
*/























// POST: Para crear recursos
$app->post("/registro/", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por POST
	$p = $app->request->post();

	$consulta = $db->prepare("INSERT INTO persona (id, nombre, apellido, dni, foto, sexo, password) VALUES (:id, :para, :param2, :param3, :param4, :param5, :param6)");
	$status = 200;

	$consulta->bindValue(":para", $p['nombre'], PDO::PARAM_STR);
	$consulta->bindValue(":param2", $p['apellido'], PDO::PARAM_STR);
	$consulta->bindValue(":param3", $p['dni'], PDO::PARAM_STR);
	$consulta->bindValue(":param4", $p['foto'], PDO::PARAM_STR);
	$consulta->bindValue(":param5", $p['sexo'], PDO::PARAM_STR);
	$consulta->bindValue(":param6", $p['password'], PDO::PARAM_STR);
	$consulta->bindValue(":id", $p['id'], PDO::PARAM_INT);
	$exito = $consulta->execute();
	
	// En el execute es dónde asociamos el :param1 con el valor que le toque.
	if ($exito)
		$res = array("rta" => true);
	else{
		$res = array("rta" => false);
		$status = 500;
	}

	// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($res));
});

// PUT: Para editar recursos
$app->post("/registros/", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por put
	$p = $app->request->post();

	$consulta = $db->prepare("UPDATE persona SET nombre=:para, apellido=:param2, dni=:param3, foto=:param4, sexo=:param5, password=:param6 WHERE id=:id");
	$status = 200;

	$consulta->bindValue(":para", $p['nombre'], PDO::PARAM_STR);
	$consulta->bindValue(":param2", $p['apellido'], PDO::PARAM_STR);
	$consulta->bindValue(":param3", $p['dni'], PDO::PARAM_STR);
	$consulta->bindValue(":param4", $p['foto'], PDO::PARAM_STR);
	$consulta->bindValue(":param5", $p['sexo'], PDO::PARAM_STR);
	$consulta->bindValue(":param6", $p['password'], PDO::PARAM_STR);
	$consulta->bindValue(":id", $p['id'], PDO::PARAM_INT);
	$exito = $consulta->execute();
	
	// En el execute es dónde asociamos el :param1 con el valor que le toque.
	if ($exito)
		$res = array("rta" => true);
	else{
		$res = array("rta" => false);
		$status = 500;
	}

	// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($res));

});

// DELETE: Para eliminar recursos
$app->post("/registross/", function() use($app, $db)
{
	
	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por put
	$p = $app->request->post();

	$consulta = $db->prepare("DELETE FROM persona where id=:id");
	$status = 200;

	$consulta->bindValue(":id", $p['id'], PDO::PARAM_INT);
	

	if($exito = $consulta->execute())
		$res = array("rta" => true);	
	else{
		$res = array("rta" => false);
		$status = 500;
	}

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status($status);
	$app->response->body(json_encode($res));
});



$app->run();