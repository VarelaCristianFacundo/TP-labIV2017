<?php
require_once 'usuario.php';
require_once 'IApiUsable.php';

class usuarioApi extends Usuario implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
        $elCd=Usuario::TraerUnUsuarioPorId($id);
        if(!$elCd)
        {
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->error="No esta El CD";
            $NuevaRespuesta = $response->withJson($objDelaRespuesta, 500); 
        }else
        {
            $NuevaRespuesta = $response->withJson($elCd, 200); 
        }     
        return $NuevaRespuesta;
    }
    
    public function TraerTodos($request, $response, $args) {
      $todosLosCds=Usuario::TraerTodosLosUsuarios();
     	$newresponse = $response->withJson($todosLosCds, 200);  
    	return $newresponse;
    }

    public function CargarUno($request, $response, $args) {
     	
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $nombre= $ArrayDeParametros['nombre'];
        $apellido= $ArrayDeParametros['apellido'];
        $email= $ArrayDeParametros['email'];
        $sexo= $ArrayDeParametros['sexo'];
        $perfil= $ArrayDeParametros['perfil'];
        $password= $ArrayDeParametros['password'];
        
        $miUsuario = new Usuario();
        $miUsuario->nombre=$nombre;
        $miUsuario->apellido=$apellido;
        $miUsuario->email=$email;
        $miUsuario->sexo=$sexo;
        $miUsuario->perfil=$perfil;
        $miUsuario->password=$password;

        //$miUsuario->Agregar();
        Usuario::Agregar($miUsuario);
        
        //$response->getBody()->write("se guardo el cd");
        $objDelaRespuesta->respuesta="Se guardo el Usuario.";   
        return $response->withJson($objDelaRespuesta, 200);
    }
    
    public function BorrarUno($request, $response, $args) {
       	$ArrayDeParametros = $request->getParsedBody();
       	$id=$ArrayDeParametros['id'];
       	$usuario= new Usuario();
       	$usuario->id=$id;
       	$cantidadDeBorrados = Usuario::Eliminar($id);

       	$objDelaRespuesta= new stdclass();
  	    $objDelaRespuesta->cantidad=$cantidadDeBorrados;
  	    if($cantidadDeBorrados>0)
  	    	{
  	    		 $objDelaRespuesta->resultado="algo borro!!!";
  	    	}
  	    	else
  	    	{
  	    		$objDelaRespuesta->resultado="no Borro nada!!!";
  	    	}
  	    $newResponse = $response->withJson($objDelaRespuesta, 200);  
        	return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
       	//$response->getBody()->write("<h1>Modificar  uno</h1>");
       	$ArrayDeParametros = $request->getParsedBody();
  	    //var_dump($ArrayDeParametros);    	
  	    $miUsuario = new Usuario();
  	    $miUsuario->id       = $ArrayDeParametros['id'];
  	    $miUsuario->nombre   = $ArrayDeParametros['nombre'];
  	    $miUsuario->apellido = $ArrayDeParametros['apellido'];
  	    $miUsuario->email    = $ArrayDeParametros['email'];
        $miUsuario->sexo     = $ArrayDeParametros['sexo'];
        $miUsuario->perfil   = $ArrayDeParametros['perfil'];
        $miUsuario->password = $ArrayDeParametros['password'];

  	   	//$resultado = $miUsuario->ModificarCdParametros();
        $resultado = Usuario::Modificar($miUsuario);
  	   	$objDelaRespuesta= new stdclass();
    		//var_dump($resultado);
    		$objDelaRespuesta->resultado=$resultado;
            $objDelaRespuesta->tarea="modificar";
    		return $response->withJson($objDelaRespuesta, 200);		
    }


}