<?php

	class Reserva
	{

		//--------------------------------------------------------------------------------//
		//--ATRIBUTOS (No sé por qué tuve que ponerlos public)
			public $id;
		 	public $id_usuario;
		 	public $id_local;
		 	public $fecha;
		  	public $cantidad;
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
			public function GetIdLocal()
			{
				return $this->id_local;
			}
			public function GetFecha()
			{
				return $this->fecha;
			}
			public function GetCantidad()
			{
				return $this->cantidad;
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
			public function SetCantidad($valor)
			{
				$this->cantidad = $valor;
			}
		//--------------------------------------------------------------------------------//
		//--CONSTRUCTOR
			public function __construct($id=NULL)
			{
				if($id !== NULL){
					$obj = self::TraerUnaReservaPorId($id);
					$this->id = $obj->GetId();
					$this->id_usuario = $obj->GetIdUsuario();
					$this->id_local = $obj->GetIdLocal();
					$this->fecha = $obj->GetFecha();
					$this->cantidad = $obj->GetCantidad();
				}
			}
		//--------------------------------------------------------------------------------//
		//--------------------------------------------------------------------------------//
		//--METODO DE CLASE
			public static function TraerUnaReservaPorId($id){
				$conexion = self::CrearConexion();
				$sql = "SELECT U.id, U.id_usuario, U.id_local, U.fecha, U.cantidad
						FROM reservas U
						WHERE U.id = :id";
				$consulta = $conexion->prepare($sql);
				$consulta->bindValue(":id", $id, PDO::PARAM_INT);
				$consulta->execute();
				$reserva = $consulta->fetchObject('Reserva');
				return $reserva;
			}
			public static function TraerTodosLasReservas(){
				$conexion = self::CrearConexion();
				$sql = "SELECT U.id, U.id_usuario, U.id_local, U.fecha, U.cantidad
						FROM reservas U";
				$consulta = $conexion->prepare($sql);
				$consulta->execute();
				$reserva = $consulta->fetchall(PDO::FETCH_CLASS, 'Reserva');
				return $reserva;
			}
			public static function Agregar($reserva){
				$conexion = self::CrearConexion();
				$sql = "INSERT INTO reservas (id_usuario, id_local, fecha, cantidad)
						VALUES (:id_usuario, :id_local, :fecha, :cantidad)";
				$consulta = $conexion->prepare($sql);
				$consulta->bindValue(":id_usuario", $reserva->id_usuario, PDO::PARAM_INT);
				$consulta->bindValue(":id_local", $reserva->id_local, PDO::PARAM_INT);
				$consulta->bindValue(":fecha", $reserva->fecha, PDO::PARAM_STR);
				$consulta->bindValue(":cantidad", $reserva->cantidad, PDO::PARAM_INT);
				$consulta->execute();
				$idAgregado = $conexion->lastInsertId();
				return $idAgregado;
			}
			public static function Modificar($reserva){
				$conexion = self::CrearConexion();
				$sql = "UPDATE reservas
						SET id_usuario = :id_usuario, id_local = :id_local, fecha = :fecha, cantidad = :cantidad
						WHERE id = :id";
				$consulta = $conexion->prepare($sql);
				$consulta->bindValue(":id_usuario", $reserva->id_usuario, PDO::PARAM_INT);
				$consulta->bindValue(":id_local", $reserva->id_local, PDO::PARAM_INT);
				$consulta->bindValue(":fecha", $reserva->fecha, PDO::PARAM_STR);
				$consulta->bindValue(":cantidad", $reserva->cantidad, PDO::PARAM_INT);
				$consulta->bindValue(":id", $reserva->id, PDO::PARAM_INT);
				$consulta->execute();
				$cantidad = $consulta->rowCount();
				return $cantidad;
			}
			public static function Eliminar($id){
				$conexion = self::CrearConexion();
				$sql = "DELETE FROM reservas
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