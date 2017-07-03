<?php
require_once 'producto.php';
require_once 'IApiUsable.php';

class productoApi extends Producto implements IApiUsable
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
      	$todosLosCds=Producto::TraerTodosLosProductos();
        $newresponse = $response->withJson($todosLosCds, 200);  
        return $newresponse;
    }
      public function CargarUno($request, $response, $args) {
     	
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $descripcion= $ArrayDeParametros['descripcion'];
        $categoria= $ArrayDeParametros['categoria'];
        $precio= $ArrayDeParametros['precio'];
        
        $miProducto = new Producto();
        $miProducto->descripcion=$descripcion;
        $miProducto->categoria=$categoria;
        $miProducto->precio=$precio;
        
        //$miProducto->Agregar();
        Producto::Agregar($miProducto);
        
        //$response->getBody()->write("se guardo el cd");
        $objDelaRespuesta->respuesta="Se guardo el Producto.";   
        return $response->withJson($objDelaRespuesta, 200);
    }
      public function BorrarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        $id=$ArrayDeParametros['id'];
        $producto= new Producto();
        $producto->id=$id;
        $cantidadDeBorrados = Producto::Eliminar($id);

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
        $miProducto = new Producto();
        $miProducto->id       = $ArrayDeParametros['id'];
        $miProducto->descripcion   = $ArrayDeParametros['descripcion'];
        $miProducto->categoria = $ArrayDeParametros['categoria'];
        $miProducto->precio    = $ArrayDeParametros['precio'];
        
        //$resultado = $miProducto->ModificarCdParametros();
        $resultado = Producto::Modificar($miProducto);
        $objDelaRespuesta= new stdclass();
            //var_dump($resultado);
            $objDelaRespuesta->resultado=$resultado;
            $objDelaRespuesta->tarea="modificar";
            return $response->withJson($objDelaRespuesta, 200); 
    }


}