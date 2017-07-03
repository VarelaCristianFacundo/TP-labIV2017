<?php
require_once 'local.php';
require_once 'IApiUsable.php';

class localApi extends Local implements IApiUsable
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
      	$todosLosCds=Local::TraerTodosLosLocales();
     	$newresponse = $response->withJson($todosLosCds, 200);  
    	return $newresponse;
    }
      public function CargarUno($request, $response, $args) {
     	
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $direccion= $ArrayDeParametros['direccion'];
        $cp= $ArrayDeParametros['cp'];
        $foto1= $ArrayDeParametros['foto1'];
        $foto2= $ArrayDeParametros['foto2'];
        $foto3= $ArrayDeParametros['foto3'];
        
        $miLocal = new Local();
        $miLocal->direccion=$direccion;
        $miLocal->cp=$cp;
        $miLocal->foto1=$foto1;
        $miLocal->foto2=$foto2;
        $miLocal->foto3=$foto3;
        
        Local::Agregar($miLocal);

        //$response->getBody()->write("se guardo el cd");
        $objDelaRespuesta->respuesta="Se guardo el local.";   
        return $response->withJson($objDelaRespuesta, 200);
    }
      public function BorrarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        $id=$ArrayDeParametros['id'];
        $local= new Local();
        $local->id=$id;
        $cantidadDeBorrados = Local::Eliminar($id);

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
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);     
        $miLocal = new Local();
        $miLocal->id       = $ArrayDeParametros['id'];
        $miLocal->direccion   = $ArrayDeParametros['direccion'];
        $miLocal->cp = $ArrayDeParametros['cp'];
        $miLocal->foto1    = $ArrayDeParametros['foto1'];
        $miLocal->foto2     = $ArrayDeParametros['foto2'];
        $miLocal->foto3   = $ArrayDeParametros['foto3'];
        
        //$resultado = $miLocal->ModificarCdParametros();
        $resultado = Local::Modificar($miLocal);
        $objDelaRespuesta= new stdclass();
            //var_dump($resultado);
        $objDelaRespuesta->resultado=$resultado;
        $objDelaRespuesta->tarea="modificar";
        return $response->withJson($objDelaRespuesta, 200);  
    }


}