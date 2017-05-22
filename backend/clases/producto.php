<?php

	class Producto
	{
	//--------------------------------------------------------------------------------//
	//--ATRIBUTOS (No sé por qué tuve que ponerlos public)
		public $id;
	 	public $precio;
	 	public $descripcion;
	 	public $categoria;
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
		public function GetDescripcion()
		{
			return $this->descripcion;
		}
		public function GetPrecio()
		{
			return $this->precio;
		}
		public function GetCategoria()
		{
			return $this->categoria;
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
		public function SetPrecio($valor)
		{
			$this->precio = $valor;
		}
		public function SetDescripcion($valor)
		{
			$this->descripcion = $valor;
		}
		public function SetCategoria($valor)
		{
			$this->categoria = $valor;
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
				$obj = self::TraerUnProductoPorId($id);
				$this->id = $obj->GetId();
				$this->precio = $obj->GetPrecio();
				$this->descripcion = $obj->GetDescripcion();
				$this->categoria = $obj->GetCategoria();
				$this->foto1 = $obj->GetFoto1();
				$this->foto2 = $obj->GetFoto2();
				$this->foto3 = $obj->GetFoto3();
			}
		}
	//--------------------------------------------------------------------------------//
	//--TOSTRING	
	  	public function ToString()
		{
		  	return $this->id." - ".$this->precio." - ".$this->descripcion." - ".$this->categoria." - ".$this->foto1." - ".$this->foto2." - ".$this->foto3."\r\n";
		}
	//--------------------------------------------------------------------------------//
	//--------------------------------------------------------------------------------//
	//--METODO DE CLASE
		public static function TraerUnProductoPorId($id){
			$conexion = self::CrearConexion();
			$sql = "SELECT U.id, U.precio, U.descripcion, U.categoria, U.foto1, U.foto2, U.foto3
					FROM productos U
					WHERE U.id = :id";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":id", $id, PDO::PARAM_INT);
			$consulta->execute();
			$producto = $consulta->fetchObject('Producto');
			return $producto;
		}
		public static function TraerTodosLosProductos(){
			$conexion = self::CrearConexion();
			$sql = "SELECT U.id, U.precio, U.descripcion, U.categoria, U.foto1, U.foto2, U.foto3
					FROM productos U";
			$consulta = $conexion->prepare($sql);
			$consulta->execute();
			$producto = $consulta->fetchall(PDO::FETCH_CLASS, 'Producto');
			return $producto;
		}
		public static function Agregar($producto){
			$conexion = self::CrearConexion();
			$sql = "INSERT INTO productos (precio, descripcion, categoria, foto1, foto2, foto3)
					VALUES (:precio, :descripcion, :categoria, :foto1, :foto2, :foto3)";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":precio", $producto->precio, PDO::PARAM_INT);
			$consulta->bindValue(":descripcion", $producto->descripcion, PDO::PARAM_STR);
			$consulta->bindValue(":categoria", $producto->categoria, PDO::PARAM_STR);
			$consulta->bindValue(":foto1", $producto->foto1, PDO::PARAM_STR);
			$consulta->bindValue(":foto2", $producto->foto2, PDO::PARAM_STR);
			$consulta->bindValue(":foto3", $producto->foto3, PDO::PARAM_STR);
			$consulta->execute();
			$idAgregado = $conexion->lastInsertId();
			return $idAgregado;
		}
		public static function Modificar($producto){
			$conexion = self::CrearConexion();
			$sql = "UPDATE productos
					SET precio = :precio, descripcion = :descripcion, categoria = :categoria, foto1 = :foto1, foto2 = :foto2, foto3 = :foto3
					WHERE id = :id";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":precio", $producto->precio, PDO::PARAM_INT);
			$consulta->bindValue(":descripcion", $producto->descripcion, PDO::PARAM_STR);
			$consulta->bindValue(":categoria", $producto->categoria, PDO::PARAM_STR);
			$consulta->bindValue(":foto1", $producto->foto1, PDO::PARAM_STR);
			$consulta->bindValue(":foto2", $producto->foto2, PDO::PARAM_STR);
			$consulta->bindValue(":foto3", $producto->foto3, PDO::PARAM_STR);
			$consulta->bindValue(":id", $producto->id, PDO::PARAM_INT);
			$consulta->execute();
			$cantidad = $consulta->rowCount();
			return $cantidad;
		}
		public static function Eliminar($id){
			$conexion = self::CrearConexion();
			$sql = "DELETE FROM productos
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
					WHERE table_name = 'productos'
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