<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'jwt/vendor/autoload.php';
use Firebase\JWT\JWT;

require '../composer/vendor/autoload.php';
require_once '/clases/AccesoDatos.php';
require_once '/clases/cdApi.php';
require_once '/clases/usuarioApi.php';
require_once '/clases/eventoApi.php';
require_once '/clases/localApi.php';
require_once '/clases/pedidoApi.php';
require_once '/clases/productoApi.php';
require_once '/clases/reservaApi.php';
require_once '/clases/AutentificadorJWT.php';
require_once '/clases/MWparaCORS.php';
require_once '/clases/MWparaAutentificar.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
/*

¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);
//$app = new \Slim\Slim();

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Bienvenidos al WS");

    return $response;
});


//POST PARA EL LOGIN CON JWT
$app->post("/auth", function($request, $response, $args) use($app)
{
  $p = $request->getParsedBody();
  require_once "clases/usuario.php";
  //var_dump("asdsad",$p);
  //$res = array("resultado" => $app->request->post()); //Devuelvo todo lo que le pasé por post
  //$p = $app->request->post();
  $db = new PDO("mysql:host=localhost;dbname=pizzeria;charset=utf8;",'root','');

  $consulta = $db->prepare("SELECT U.id, U.nombre, U.apellido, U.email, U.perfil, U.sexo, U.password
            FROM usuarios U
            WHERE U.email = :email AND U.password = :pass");
  $status = 200;

   $consulta->bindValue(":email", $p['email'], PDO::PARAM_STR);
   $consulta->bindValue(":pass", $p['clave'], PDO::PARAM_STR);
   //$consulta->bindValue(":email", "admin@admin.com", PDO::PARAM_STR);
   //$consulta->bindValue(":pass", "1234", PDO::PARAM_STR);
  
  $consulta->execute();
  
  $usuarioLogueado = $consulta->fetchObject('Usuario');
  //var_dump($usuarioLogueado);

  $tok = array();

  if ($usuarioLogueado)
  {
    $jwt = AutentificadorJWT::CrearToken($usuarioLogueado);
    // $key = "varela";
    // $token = array(
    //   "id" => $usuarioLogueado->id,
    //     "nombre" => $usuarioLogueado->nombre,
    //     "apellido" => $usuarioLogueado->apellido,
    //     "email" => $usuarioLogueado->email,
    //     "perfil" => $usuarioLogueado->perfil,

    // );
    //var_dump($jwt);
    // $jwt = JWT::encode($token, $key);
    $tok['token'] = $jwt;
    // $decoded = JWT::decode($jwt, $key, array('HS256'));
    // $decoded_array = (array) $decoded;
    // JWT::$leeway = 60; // $leeway in seconds
  }

  else
  {
    $tok['token'] = "¡Usuario o Clave Incorrecta!";
  }

  $objDelaRespuesta = new stdclass();
  $objDelaRespuesta->respuesta = json_encode($p);
  $objDelaRespuesta->token = $jwt;

  // $app->response->headers->set("Content-type", "application/json");
  // $app->response->status(200);
  // $app->response->body(json_encode($tok));
  //var_dump($objDelaRespuesta);
  $response->withHeader('Content-type', 'application/json');
  return $response->withJson($objDelaRespuesta, 200);
  //return;
})->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->group('/usuario', function () {
  $this->get('/traerDatosUsuarios', \usuarioApi::class . ':traerTodos');
  $this->post('/registro', \usuarioApi::class . ':CargarUno');
  $this->post('/borrarUser', \usuarioApi::class . ':BorrarUno');
  $this->post('/editarUser', \usuarioApi::class . ':ModificarUno');
  // $this->get('/{id}', \usuarioApi::class . ':traerUno');
})->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->group('/evento', function () {
  $this->post('/altaEvento', \eventoApi::class . ':CargarUno');
  // $this->get('/', \eventoApi::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  // $this->get('/{id}', \eventoApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  // $this->delete('/', \eventoApi::class . ':BorrarUno');
  // $this->put('/', \eventoApi::class . ':ModificarUno');
})->add(\MWparaCORS::class . ':HabilitarCORSTodos');//->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->group('/local', function () {
  $this->get('/traerDatosLocales', \localApi::class . ':traerTodos');
  $this->post('/altaLocal', \localApi::class . ':CargarUno');
  $this->post('/borrarLocal', \localApi::class . ':BorrarUno');
  $this->post('/editarLocal', \localApi::class . ':ModificarUno');
  // $this->get('/{id}', \localApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaCORS::class . ':HabilitarCORSTodos');
//->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->group('/pedido', function () {
  $this->get('/traerDatosPedidos', \pedidoApi::class . ':traerTodos');
  $this->post('/altaPedido', \pedidoApi::class . ':CargarUno');
  $this->post('/borrarPedido', \pedidoApi::class . ':BorrarUno');
  $this->post('/editarPedido', \pedidoApi::class . ':ModificarUno');
  //->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  // $this->get('/{id}', \pedidoApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaCORS::class . ':HabilitarCORSTodos');//->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->group('/producto', function () { 
  $this->get('/traerDatosProductos', \productoApi::class . ':traerTodos');
  $this->post('/altaProducto', \productoApi::class . ':CargarUno');
  $this->post('/borrarProducto', \productoApi::class . ':BorrarUno');
  $this->post('/editarProducto', \productoApi::class . ':ModificarUno');
  // $this->get('/{id}', \productoApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaCORS::class . ':HabilitarCORSTodos');//->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->group('/reserva', function () {
  $this->post('/altaReserva', \reservaApi::class . ':CargarUno');
  // $this->get('/', \reservaApi::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  // $this->get('/{id}', \reservaApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  // $this->delete('/', \reservaApi::class . ':BorrarUno');
  // $this->put('/', \reservaApi::class . ':ModificarUno');
})->add(\MWparaCORS::class . ':HabilitarCORSTodos');//->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->run();

/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
// $app->group('/cd', function () {
 
//   $this->get('/', \cdApi::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
 
//   $this->get('/{id}', \cdApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

//   $this->post('/', \cdApi::class . ':CargarUno');

//   $this->delete('/', \cdApi::class . ':BorrarUno');

//   $this->put('/', \cdApi::class . ':ModificarUno');
     
// })->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');
