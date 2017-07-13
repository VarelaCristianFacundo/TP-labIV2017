<?php

	class Usuario
	{
		//--------------------------------------------------------------------------------//
		//--ATRIBUTOS
			public $id;
		 	public $nombre;
		  	public $apellido;
		  	public $email;
		  	public $sexo;
		  	public $perfil;
		  	public $password;
		//--------------------------------------------------------------------------------//

		//--------------------------------------------------------------------------------//
		//--GETTERS Y SETTERS
			public function GetId()
			{
				return $this->id;
			}
			public function GetNombre()
			{
				return $this->nombre;
			}
			public function GetApellido()
			{
				return $this->apellido;
			}
			public function GetEmail()
			{
				return $this->email;
			}
			public function GetSexo()
			{
				return $this->sexo;
			}
			public function GetPerfil()
			{
				return $this->perfil;
			}
			public function SetId($valor)
			{
				$this->id = $valor;
			}
			public function SetNombre($valor)
			{
				$this->nombre = $valor;
			}
			public function SetApellido($valor)
			{
				$this->apellido = $valor;
			}
			public function SetEmail($valor)
			{
				$this->email = $valor;
			}
				public function SetSexo($valor)
			{
				$this->sexo = $valor;
			}
				public function SetPerfil($valor)
			{
				$this->perfil = $valor;
			}


		//--------------------------------------------------------------------------------//
		// //--CONSTRUCTOR
		// 	public function __construct($id=NULL)
		// 	{
		// 		if($id !== NULL){
		// 			$obj = self::TraerUnUsuarioPorId($id);
		// 			$this->id = $obj->GetId();
		// 			$this->nombre = $obj->GetNombre();
		// 			$this->apellido = $obj->GetApellido();
		// 			$this->email = $obj->GetEmail();
		// 			$this->sexo = $obj->GetSexo();
		// 			$this->perfil = $obj->GetPerfil();
		// 		}
		// 	}
		//--------------------------------------------------------------------------------//

		//--TOSTRING	
		  	public function ToString()
			{
			  	return $this->id." - ".$this->nombre." - ".$this->apellido." - ".$this->email." - ".$this->sexo." - ".$this->perfil."\r\n";
			}
		//--------------------------------------------------------------------------------//
		//--------------------------------------------------------------------------------//


		//--METODO DE CLASE
			public static function TraerUnUsuarioPorId($id){
				 //$id = (int)$id;
				// $conexion = self::CrearConexion();
				// $sql = "SELECT U.id, U.nombre, U.apellido, U.email, U.perfil, U.sexo
				// 		FROM usuarios U
				// 		WHERE U.id = :id";
				// $consulta = $conexion->prepare($sql);
				// $consulta->bindValue(":id", $id, PDO::PARAM_INT);
				// $consulta->execute();
				// $usuario = $consulta->fetchObject('Usuario');
				// return $usuario;


			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre, apellido, email, perfil, sexo from usuarios where id = $id");
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('Usuario');
			return $cdBuscado;	


			}
			public static function TraerTodosLosUsuarios(){
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("SELECT U.id, U.nombre, U.apellido, U.email, U.perfil, U.sexo FROM usuarios U");
				$consulta->execute();			
				return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
			}
			
			public static function TraerUsuarioLogueado($usuario){
				$conexion = self::CrearConexion();
				$sql = "SELECT U.id, U.nombre, U.apellido, U.email, U.perfil, U.sexo
						FROM usuarios U
						WHERE U.email = :email AND U.password = :pass";
				$consulta = $conexion->prepare($sql);
				$consulta->bindValue(":email", $usuario->email, PDO::PARAM_STR);
				$consulta->bindValue(":pass", $usuario->password, PDO::PARAM_STR);
				$consulta->execute();
				$usuarioLogueado = $consulta->fetchObject('Usuario');
				return $usuarioLogueado;
			}

			public static function Agregar($usuario){
				$conexion = self::CrearConexion();
				$sql = "INSERT INTO usuarios (nombre, apellido, email, sexo, perfil, password)
						VALUES (:nombre, :apellido, :email, :sexo, :perfil, :pass)";
				$consulta = $conexion->prepare($sql);
				$consulta->bindValue(":nombre", $usuario->nombre, PDO::PARAM_STR);
				$consulta->bindValue(":apellido", $usuario->apellido, PDO::PARAM_STR);
				$consulta->bindValue(":email", $usuario->email, PDO::PARAM_STR);
				$consulta->bindValue(":sexo", $usuario->sexo, PDO::PARAM_STR);
				$consulta->bindValue(":perfil", $usuario->perfil, PDO::PARAM_STR);
				$consulta->bindValue(":pass", $usuario->password, PDO::PARAM_STR);
				$consulta->execute();
				$idAgregado = $conexion->lastInsertId();
				return $idAgregado;
			}

			public static function Modificar($usuario){
				$conexion = self::CrearConexion();
				$sql = "UPDATE usuarios
						SET nombre = :nombre, apellido = :apellido, email = :email, sexo = :sexo, perfil = :perfil
						WHERE id = :id"; //, password = :pass
				$consulta = $conexion->prepare($sql);
				$consulta->bindValue(":nombre", $usuario->nombre, PDO::PARAM_STR);
				$consulta->bindValue(":apellido", $usuario->apellido, PDO::PARAM_STR);
				$consulta->bindValue(":email", $usuario->email, PDO::PARAM_STR);
				$consulta->bindValue(":sexo", $usuario->sexo, PDO::PARAM_STR);
				$consulta->bindValue(":perfil", $usuario->perfil, PDO::PARAM_STR);
				//$consulta->bindValue(":pass", $usuario->password, PDO::PARAM_STR);
				$consulta->bindValue(":id", $usuario->id, PDO::PARAM_INT);
				$consulta->execute();
				$cantidad = $consulta->rowCount();
				return $cantidad;
			}
			public static function Eliminar($id){
				$conexion = self::CrearConexion();
				$sql = "DELETE FROM usuarios
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