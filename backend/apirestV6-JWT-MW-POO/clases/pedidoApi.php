<?php
require_once 'pedido.php';
require_once 'IApiUsable.php';

class pedidoApi extends Pedido implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
        $elCd=cd::TraerUnCd($id);
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
      	$todosLosCds=pedido::TraerTodosLosPedidos();
        $newresponse = $response->withJson($todosLosCds, 200);  
        return $newresponse;
    }
      public function CargarUno($request, $response, $args) {
     	
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $id_usuario= $ArrayDeParametros['id_usuario'];
        $id_local= $ArrayDeParametros['id_local'];
        $precio= $ArrayDeParametros['precio'];
        $cantidad= $ArrayDeParametros['cantidad'];
        $estado= $ArrayDeParametros['estado'];
        $descripcion= $ArrayDeParametros['descripcion'];
        
        $miPedido = new Pedido();
        $miPedido->id_usuario=$id_usuario;
        $miPedido->id_local=$id_local;
        $miPedido->precio=$precio;
        $miPedido->cantidad=$cantidad;
        $miPedido->estado=$estado;
        $miPedido->descripcion=$descripcion;

        //$miPedido->Agregar();
        Pedido::Agregar($miPedido);
        
        //$response->getBody()->write("se guardo el cd");
        $objDelaRespuesta->respuesta="Se guardo el Pedido.";   
        return $response->withJson($objDelaRespuesta, 200);
    }
      public function BorrarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        $id=$ArrayDeParametros['id'];
        $pedido= new Pedido();
        $pedido->id=$id;
        $cantidadDeBorrados = Pedido::Eliminar($id);

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
        $miPedido = new Pedido();
        $miPedido->id       = $ArrayDeParametros['id'];
        $miPedido->id_usuario   = $ArrayDeParametros['id_usuario'];
        $miPedido->id_local = $ArrayDeParametros['id_local'];
        $miPedido->precio    = $ArrayDeParametros['precio'];
        $miPedido->cantidad     = $ArrayDeParametros['cantidad'];
        $miPedido->estado   = $ArrayDeParametros['estado'];
        $miPedido->descripcion = $ArrayDeParametros['descripcion'];

        //$resultado = $miPedido->ModificarCdParametros();
        $resultado = Pedido::Modificar($miPedido);
        $objDelaRespuesta= new stdclass();
        //var_dump($resultado);
        $objDelaRespuesta->resultado=$resultado;
            $objDelaRespuesta->tarea="modificar";
        return $response->withJson($objDelaRespuesta, 200);   
    }


}