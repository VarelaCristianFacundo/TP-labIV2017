<?php

	class Pedido
	{
	//--------------------------------------------------------------------------------//
	//--ATRIBUTOS (No sé por qué tuve que ponerlos public)
		public $id;
		public $id_usuario;
		public $id_local;
	 	public $fecha;
	 	public $importe;
	 	public $descripcion;
	 	public $estado;
	//--------------------------------------------------------------------------------//
	//--------------------------------------------------------------------------------//
	//--GETTERS Y SETTERS
		public function GetId()
		{
			return $this->id;
		}
		public function GetIdUsuario()
		{
			return $this->id_usuario;
		}
		public function GetDescripcion()
		{
			return $this->descripcion;
		}
		public function GetIdLocal()
		{
			return $this->id_local;
		}
		public function GetFecha()
		{
			return $this->fecha;
		}
		public function GetImporte()
		{
			return $this->importe;
		}
		public function GetEstado()
		{
			return $this->estado;
		}
		public function SetId($valor)
		{
			$this->id = $valor;
		}
		public function SetIdUsuario($valor)
		{
			$this->id_usuario = $valor;
		}
		public function SetIdLocal($valor)
		{
			$this->id_local = $valor;
		}
		public function SetFecha($valor)
		{
			$this->fecha = $valor;
		}
		public function SetDescripcion($valor)
		{
			$this->fecha = $descripcion;
		}
		public function SetImporte($valor)
		{
			$this->importe = $valor;
		}
		public function SetEstado($valor)
		{
			$this->estado = $valor;
		}
	//--------------------------------------------------------------------------------//
	//--CONSTRUCTOR
		public function __construct($id=NULL)
		{
			if($id !== NULL){
				$obj = self::TraerUnPedidoPorId($id);
				$this->id = $obj->GetId();
				$this->id_local = $obj->GetIdLocal();
				$this->id_usuario = $obj->GetIdUsuario();
				$this->fecha = $obj->GetFecha();
				$this->importe = $obj->GetImporte();
				$this->estado = $obj->GetEstado();
				$this->estado = $obj->GetDescripcion();
			}
		}
	//--------------------------------------------------------------------------------//
	//--------------------------------------------------------------------------------//
	//--METODO DE CLASE
		public static function TraerUnPedidoPorId($id){
			$conexion = self::CrearConexion();
			$sql = "SELECT U.id, U.id_usuario, U.id_local, U.fecha, U.importe, U.estado
					FROM pedidos U
					WHERE U.id = :id";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":id", $id, PDO::PARAM_INT);
			$consulta->execute();
			$pedido = $consulta->fetchObject('Pedido');
			return $pedido;
		}
		public static function TraerTodosLosPedidos(){
			$conexion = self::CrearConexion();
			$sql = "SELECT U.id, U.id_usuario, U.id_local, U.fecha, U.importe, U.estado
					FROM pedidos U";
			$consulta = $conexion->prepare($sql);
			$consulta->execute();
			$pedido = $consulta->fetchall(PDO::FETCH_CLASS, 'Pedido');
			return $pedido;
		}
		public static function Agregar($pedido){
			$conexion = self::CrearConexion();
			$sql = "INSERT INTO pedidos (id_usuario, id_local, fecha, importe, estado)
					VALUES (:id_usuario, :id_local, :fecha, :importe, :estado)";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":id_usuario", $pedido->id_usuario, PDO::PARAM_INT);
			$consulta->bindValue(":id_local", $pedido->id_local, PDO::PARAM_INT);
			$consulta->bindValue(":fecha", $pedido->fecha, PDO::PARAM_STR);
			$consulta->bindValue(":importe", $pedido->importe, PDO::PARAM_INT);
			$consulta->bindValue(":estado", $pedido->estado, PDO::PARAM_STR);
			$consulta->execute();
			$idAgregado = $conexion->lastInsertId();
			return $idAgregado;
		}
		public static function Modificar($pedido){
			$conexion = self::CrearConexion();
			$sql = "UPDATE pedidos
					SET id_usuario = :id_usuario, id_local = :id_local, fecha = :fecha, importe = :importe, estado = :estado
					WHERE id = :id";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":id_usuario", $pedido->id_usuario, PDO::PARAM_INT);
			$consulta->bindValue(":id_local", $pedido->id_local, PDO::PARAM_INT);
			$consulta->bindValue(":fecha", $pedido->fecha, PDO::PARAM_STR);
			$consulta->bindValue(":importe", $pedido->importe, PDO::PARAM_INT);
			$consulta->bindValue(":estado", $pedido->estado, PDO::PARAM_STR);
			$consulta->bindValue(":id", $pedido->id, PDO::PARAM_INT);
			$consulta->execute();
			$cantidad = $consulta->rowCount();
			return $cantidad;
		}
		public static function ModificarEstado($pedido){
			$conexion = self::CrearConexion();
			$sql = "UPDATE pedidos
					SET estado = :estado
					WHERE id = :id";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":estado", $pedido->nuevoEstado, PDO::PARAM_STR);
			$consulta->bindValue(":id", $pedido->id, PDO::PARAM_INT);
			$consulta->execute();
			$cantidad = $consulta->rowCount();
			return $cantidad;
		}
		public static function Eliminar($id){
			$conexion = self::CrearConexion();
			$sql = "DELETE FROM pedidos
					WHERE id = :id";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":id", $id, PDO::PARAM_INT);
			$consulta->execute();
			$cantidad = $consulta->rowCount();
			return $cantidad;
		}
		public static function CrearConexion(){
			try
			{
				$conexion = new PDO("mysql:host=localhost;dbname=pizzeria;charset=utf8;",'root','');
				return $conexion;
			}
			catch (Exception $e) {
				print_r("Error: " . $e->GetMessage());
				die();
				return;
			}
		}
	//--------------------------------------------------------------------------------//
	}


?>