<?php

	class Producto
	{
	//--------------------------------------------------------------------------------//
	//--ATRIBUTOS (No sé por qué tuve que ponerlos public)
		public $id;
	 	public $descripcion;
	 	public $categoria;
	 	public $precio;
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
	//--------------------------------------------------------------------------------//
	//--CONSTRUCTOR
		// public function __construct($id=NULL)
		// {
		// 	if($id !== NULL){
		// 		$obj = self::TraerUnProductoPorId($id);
		// 		$this->id = $obj->GetId();
		// 		$this->precio = $obj->GetPrecio();
		// 		$this->descripcion = $obj->GetDescripcion();
		// 		$this->categoria = $obj->GetCategoria();
		// 		$this->foto1 = $obj->GetFoto1();
		// 		$this->foto2 = $obj->GetFoto2();
		// 		$this->foto3 = $obj->GetFoto3();
		// 	}
		// }
	//--------------------------------------------------------------------------------//
	//--TOSTRING	
	  	public function ToString()
		{
		  	return $this->id." - ".$this->precio." - ".$this->descripcion." - ".$this->categoria."\r\n";
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
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT U.id, U.descripcion, U.categoria, U.precio FROM productos U");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");
		}
		public static function Agregar($producto){
			$conexion = self::CrearConexion();
			$sql = "INSERT INTO productos (descripcion, categoria, precio)
					VALUES (:descripcion, :categoria, :precio)";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":descripcion", $producto->descripcion, PDO::PARAM_STR);
			$consulta->bindValue(":categoria", $producto->categoria, PDO::PARAM_STR);
			$consulta->bindValue(":precio", $producto->precio, PDO::PARAM_INT);
			$consulta->execute();
			$idAgregado = $conexion->lastInsertId();
			return $idAgregado;
		}
		public static function Modificar($producto){
			$conexion = self::CrearConexion();
			$sql = "UPDATE productos
					SET descripcion = :descripcion, categoria = :categoria, precio = :precio
					WHERE id = :id";
			$consulta = $conexion->prepare($sql);
			$consulta->bindValue(":descripcion", $producto->descripcion, PDO::PARAM_STR);
			$consulta->bindValue(":categoria", $producto->categoria, PDO::PARAM_STR);
			$consulta->bindValue(":precio", $producto->precio, PDO::PARAM_INT);
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
				//$conexion = new PDO("mysql:host=mysql.hostinger.com.ar;dbname=u484790069_pizza;charset=utf8;",'u484790069_cvare','Neverwinter17593');
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