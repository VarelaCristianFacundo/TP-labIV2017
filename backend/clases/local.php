<?php

	class Local
	{
	//--------------------------------------------------------------------------------//
	//--ATRIBUTOS (No sé por qué tuve que ponerlos public)
		public $id;
	 	public $direccion;
	 	public $cp;
	  	public $foto1;
	  	public $foto2;
	  	public $foto3;
	//--------------------------------------------------------------------------------//
	//--------------------------------------------------------------------------------//
	//--GETTERS Y SETTERS
		public function GetId()
		{
			return $this->id;
		}
		public function GetDireccion()
		{
			return $this->direccion;
		}
		public function GetCp()
		{
			return $this->cp;
		}
		public function GetFoto1()
		{
			return $this->foto1;
		}
		public function GetFoto2()
		{
			return $this->foto2;
		}
		public function GetFoto3()
		{
			return $this->foto3;
		}
		public function SetId($valor)
		{
			$this->id = $valor;
		}
		public function SetDireccion($valor)
		{
			$this->direccion = $valor;
		}
		public function SetCp($valor)
		{
			$this->cp = $valor;
		}
		public function SetFoto1($valor)
		{
			$this->foto1 = $valor;
		}
		public function SetFoto2($valor)
		{
			$this->foto2 = $valor;
		}
		public function SetFoto3($valor)
		{
			$this->foto3 = $valor;
		}
	//--------------------------------------------------------------------------------//
	//--CONSTRUCTOR
		public function __construct($id=NULL)
		{
			if($id !== NULL){
				$obj = self::TraerUnLocalPorId($id);
				$this->id = $obj->GetId();
				$this->direccion = $obj->GetDireccion();
				$this->cp = $obj->GetCp();
				$this->foto1 = $obj->GetFoto1();
				$this->foto2 = $obj->GetFoto2();
				$this->foto3 = $obj->GetFoto3();
			}
		}
	//--------------------------------------------------------------------------------//
	//--TOSTRING	
	  	public function ToString()
		{
		  	return $this->id." - ".$this->direccion." - ".$this->foto1." - ".$this->foto2." - ".$this->foto3."\r\n";
		}
	//--------------------------------------------------------------------------------//
	//--------------------------------------------------------------------------------//
	//--METODO DE CLASE
		public static function TraerUnLocalPorId($id){
			$conexion = self::CrearConexion();
			$sql = "SELECT U.id, U.direccion, U.cp, U.foto1, U.foto2, U.foto3
					FROM locales U
					WHERE U.id = :id";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":id", $id, PDO::PARAM_INT);
			$consulta->execute();
			$local = $consulta->fetchObject('Local');
			return $local;
		}
		public static function TraerTodosLosLocales(){
			$conexion = self::CrearConexion();
			$sql = "SELECT U.id, U.direccion, U.cp, U.foto1, U.foto2, U.foto3
					FROM locales U";
			$consulta = $conexion->prepare($sql);
			$consulta->execute();
			$local = $consulta->fetchall(PDO::FETCH_CLASS, 'Local');
			return $local;
		}
		public static function Agregar($local){
			$conexion = self::CrearConexion();
			$sql = "INSERT INTO locales (direccion, cp, foto1, foto2, foto3)
					VALUES (:direccion, :cp, :foto1, :foto2, :foto3)";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":direccion", $local->direccion, PDO::PARAM_STR);
			$consulta->bindValue(":cp", $local->cp, PDO::PARAM_STR);
			$consulta->bindValue(":foto1", $local->foto1, PDO::PARAM_STR);
			$consulta->bindValue(":foto2", $local->foto2, PDO::PARAM_STR);
			$consulta->bindValue(":foto3", $local->foto3, PDO::PARAM_STR);
			$consulta->execute();
			$idAgregado = $conexion->lastInsertId();
			return $idAgregado;
		}
		public static function Modificar($local){
			$conexion = self::CrearConexion();
			$sql = "UPDATE locales
					SET direccion = :direccion, cp = :cp, foto1 = :foto1, foto2 = :foto2, foto3 = :foto3
					WHERE id = :id";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":direccion", $local->direccion, PDO::PARAM_STR);
			$consulta->bindValue(":cp", $local->cp, PDO::PARAM_STR);
			$consulta->bindValue(":foto1", $local->foto1, PDO::PARAM_STR);
			$consulta->bindValue(":foto2", $local->foto2, PDO::PARAM_STR);
			$consulta->bindValue(":foto3", $local->foto3, PDO::PARAM_STR);
			$consulta->bindValue(":id", $local->id, PDO::PARAM_INT);
			$consulta->execute();
			$cantidad = $consulta->rowCount();
			return $cantidad;
		}
		public static function Eliminar($id){
			$conexion = self::CrearConexion();
			$sql = "DELETE FROM locales
					WHERE id = :id";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":id", $id, PDO::PARAM_INT);
			$consulta->execute();
			$cantidad = $consulta->rowCount();
			return $cantidad;
		}
		public static function ProximoID(){
			$conexion = self::CrearConexion();
			$sql = "SELECT AUTO_INCREMENT
					FROM information_schema.tables
					WHERE table_name = 'locales'
					AND table_schema = DATABASE()";
			$consulta = $conexion->prepare($sql);
			$consulta->execute();
			$id = $consulta->fetch();
			return $id;
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