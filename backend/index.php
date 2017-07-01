<?php
require_once "vendor/autoload.php";
require 'jwt/vendor/autoload.php';
use \Firebase\JWT\JWT;

//instancia de slim
$app = new \Slim\Slim();

// Definimos conexion de la base de datos, utilizando PDO con el driver mysql.
define('BD_SERVIDOR', 'mysql.hostinger.com.ar');
define('BD_NOMBRE', 'u484790069_pizza');
define('BD_USUARIO', 'u484790069_cvare');
define('BD_PASSWORD', 'Neverwinter17593');

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


$app->get('/traerDatosUsuarios', function() use($db,$app) {

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

$app->get('/traerDatosLocales', function() use($db,$app) {

	// Preparamos la consulta a la tabla.
	$consulta = $db->prepare("select * from locales");
	$consulta->execute();
	// Almacenamos los resultados en un array asociativo.
	$resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($resultados));
});

$app->get('/traerDatosPedidos', function() use($db,$app) {

	// Preparamos la consulta a la tabla.
	$consulta = $db->prepare("select * from pedidos");
	$consulta->execute();
	// Almacenamos los resultados en un array asociativo.
	$resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($resultados));
});

$app->get('/traerDatosProductos', function() use($db,$app) {

	// Preparamos la consulta a la tabla.
	$consulta = $db->prepare("select * from productos");
	$consulta->execute();
	// Almacenamos los resultados en un array asociativo.
	$resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($resultados));
});



//REGISTRO DE USUARIOS
$app->post("/registro", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por POST
	$p = $app->request->post();


	$consulta = $db->prepare("INSERT INTO usuarios (nombre, apellido, email, sexo, perfil,  password) VALUES (:para, :param2, :param3, :param4, :param5, :param6)");
	$status = 200;


	$consulta->bindValue(":para", $p['nombre'], PDO::PARAM_STR);
	$consulta->bindValue(":param2", $p['apellido'], PDO::PARAM_STR);
	$consulta->bindValue(":param3", $p['email'], PDO::PARAM_STR);
	$consulta->bindValue(":param4", $p['sexo'], PDO::PARAM_STR);
	$consulta->bindValue(":param5", $p['perfil'], PDO::PARAM_STR);
	$consulta->bindValue(":param6", $p['password'], PDO::PARAM_STR);
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

//POST PARA EL LOGIN CON JWT
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
			"id" => $usuarioLogueado->id,
		    "nombre" => $usuarioLogueado->nombre,
		    "apellido" => $usuarioLogueado->apellido,
		    "email" => $usuarioLogueado->email,
		    "perfil" => $usuarioLogueado->perfil,

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




$app->post("/editarUser", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por put
	$p = $app->request->post();

	$consulta = $db->prepare("UPDATE usuarios SET nombre=:para, apellido=:param2, email=:param3, sexo=:param4, perfil=:param5, password=:param6 WHERE id=:id");
	$status = 200;

	$consulta->bindValue(":para", $p['nombre'], PDO::PARAM_STR);
	$consulta->bindValue(":param2", $p['apellido'], PDO::PARAM_STR);
	$consulta->bindValue(":param3", $p['email'], PDO::PARAM_STR);
	$consulta->bindValue(":param4", $p['sexo'], PDO::PARAM_STR);
	$consulta->bindValue(":param5", $p['perfil'], PDO::PARAM_STR);
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

$app->post("/borrarUser/", function() use($app, $db)
{
	
	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por put
	$p = $app->request->post();

	$consulta = $db->prepare("DELETE FROM usuarios where id=:id");
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



//REGISTRO DE LOCALES
$app->post("/altaLocal", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por POST
	$p = $app->request->post();


	$consulta = $db->prepare("INSERT INTO locales (direccion, cp, foto1, foto2, foto3) VALUES (:para, :param2, :param3, :param4, :param5)");
	$status = 200;


	$consulta->bindValue(":para", $p['direccion'], PDO::PARAM_STR);
	$consulta->bindValue(":param2", $p['cp'], PDO::PARAM_STR);
	$consulta->bindValue(":param3", $p['foto1'], PDO::PARAM_STR);
	$consulta->bindValue(":param4", $p['foto2'], PDO::PARAM_STR);
	$consulta->bindValue(":param5", $p['foto3'], PDO::PARAM_STR);
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

//BORRAR LOCAL
$app->post("/borrarLocal/", function() use($app, $db)
{
	
	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por put
	$p = $app->request->post();

	$consulta = $db->prepare("DELETE FROM locales where id=:id");
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


//EDITAR LOCAL
$app->post("/editarLocal", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por put
	$p = $app->request->post();

	$consulta = $db->prepare("UPDATE locales SET direccion=:para, cp=:param2, foto1=:param3, foto2=:param4, foto3=:param5 WHERE id=:id");
	$status = 200;

	$consulta->bindValue(":para", $p['direccion'], PDO::PARAM_STR);
	$consulta->bindValue(":param2", $p['cp'], PDO::PARAM_STR);
	$consulta->bindValue(":param3", $p['foto1'], PDO::PARAM_STR);
	$consulta->bindValue(":param4", $p['foto2'], PDO::PARAM_STR);
	$consulta->bindValue(":param5", $p['foto3'], PDO::PARAM_STR);
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

$app->post("/altaReserva", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por POST
	$p = $app->request->post();


	$consulta = $db->prepare("INSERT INTO reservas (id_usuario, local, fecha, cantidad) VALUES (:para, :param2, :param3, :param4)");
	$status = 200;


	$consulta->bindValue(":para", $p['id_usuario'], PDO::PARAM_INT);
	$consulta->bindValue(":param2", $p['local'], PDO::PARAM_STR);
	$consulta->bindValue(":param3", $p['fecha'], PDO::PARAM_STR);
	$consulta->bindValue(":param4", $p['cantidad'], PDO::PARAM_STR);
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

$app->post("/altaEvento", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por POST
	$p = $app->request->post();


	$consulta = $db->prepare("INSERT INTO eventos (id_usuario, fecha, precio, cantidad, id_local) VALUES (:para, :param2, :param3, :param4, :param5)");
	$status = 200;


	$consulta->bindValue(":para", $p['id_usuario'], PDO::PARAM_INT);
	$consulta->bindValue(":param2", $p['fecha'], PDO::PARAM_STR);
	$consulta->bindValue(":param3", $p['precio'], PDO::PARAM_INT);
	$consulta->bindValue(":param4", $p['cantidad'], PDO::PARAM_INT);
	$consulta->bindValue(":param5", $p['id_local'], PDO::PARAM_INT);
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


$app->post("/altaPedido", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por POST
	$p = $app->request->post();


	$consulta = $db->prepare("INSERT INTO pedidos (id_usuario, id_local, precio, cantidad, estado, descripcion) VALUES (:para, :param2, :param3, :param4, :param5, :param6)");
	$status = 200;


	$consulta->bindValue(":para", $p['id_usuario'], PDO::PARAM_INT);
	$consulta->bindValue(":param2", $p['id_local'], PDO::PARAM_INT);
	$consulta->bindValue(":param3", $p['precio'], PDO::PARAM_STR);
	$consulta->bindValue(":param4", $p['cantidad'], PDO::PARAM_STR);
	$consulta->bindValue(":param5", $p['estado'], PDO::PARAM_STR);
	$consulta->bindValue(":param6", $p['descripcion'], PDO::PARAM_STR);
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

$app->post("/editarPedido", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por put
	$p = $app->request->post();

	$consulta = $db->prepare("UPDATE pedidos SET id_usuario=:para, id_local=:param2, precio=:param3, cantidad=:param4, estado=:param5, descripcion=:param6 WHERE id=:id");
	$status = 200;

	$consulta->bindValue(":para", $p['id_usuario'], PDO::PARAM_INT);
	$consulta->bindValue(":param2", $p['id_local'], PDO::PARAM_INT);
	$consulta->bindValue(":param3", $p['precio'], PDO::PARAM_INT);
	$consulta->bindValue(":param4", $p['cantidad'], PDO::PARAM_INT);
	$consulta->bindValue(":param5", $p['estado'], PDO::PARAM_STR);
	$consulta->bindValue(":param6", $p['descripcion'], PDO::PARAM_STR);
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

$app->post("/borrarPedido/", function() use($app, $db)
{
	
	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por put
	$p = $app->request->post();

	$consulta = $db->prepare("DELETE FROM pedidos where id=:id");
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

$app->post("/altaProducto", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por POST
	$p = $app->request->post();


	$consulta = $db->prepare("INSERT INTO productos (descripcion, categoria, precio) VALUES (:para, :param2, :param3)");
	$status = 200;


	$consulta->bindValue(":para", $p['descripcion'], PDO::PARAM_STR);
	$consulta->bindValue(":param2", $p['categoria'], PDO::PARAM_STR);
	$consulta->bindValue(":param3", $p['precio'], PDO::PARAM_INT);
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

$app->post("/editarProducto", function() use($app, $db)
{

	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por put
	$p = $app->request->post();

	$consulta = $db->prepare("UPDATE productos SET descripcion=:para, categoria=:param2, precio=:param3 WHERE id=:id");
	$status = 200;

	$consulta->bindValue(":para", $p['descripcion'], PDO::PARAM_STR);
	$consulta->bindValue(":param2", $p['categoria'], PDO::PARAM_STR);
	$consulta->bindValue(":param3", $p['precio'], PDO::PARAM_INT);
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

$app->post("/borrarProducto/", function() use($app, $db)
{
	
	$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por put
	$p = $app->request->post();

	$consulta = $db->prepare("DELETE FROM productos where id=:id");
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