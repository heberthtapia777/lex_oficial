<?php
	include "conexion.php";

	class banner{

		public function __construct(){
		}

		public function Registrar($banner_title, $banner_subtitle, $idUser){
			global $db;

			$img = '';

			$ubicacionTemporal = $_FILES["banner_img"]["tmp_name"];
			$dir_subida = '../modulo/banner/img/';
			$nombreArchivo = $_FILES["banner_img"]["name"];
			$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Renombrar archivo
			$nuevoNombre = sprintf("%s_%d.%s", uniqid(), 1, $extension);

			$img = $nuevoNombre;

			$fichero_subido = $dir_subida.basename($nuevoNombre);
			// Mover del temporal al directorio actual
			move_uploaded_file($ubicacionTemporal, $fichero_subido);


			$sql = "INSERT INTO banner(title, subtitle, imagen, creatorUser) VALUES('$banner_title', '$banner_subtitle', '$img', '$idUser')";
			$query = $db->Execute($sql);

			return $query;
		}

		public function Modificar($banner_id, $banner_title, $banner_subtitle, $idUser, $status){
			global $db;

			$img = '';

			$ubicacionTemporal = $_FILES["banner_img"]["tmp_name"];
			$dir_subida = '../modulo/banner/img/';
			$nombreArchivo = $_FILES["banner_img"]["name"];
			$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Renombrar archivo
			$nuevoNombre = sprintf("%s_%d.%s", uniqid(), 1, $extension);

			$img = $nuevoNombre;

			$fichero_subido = $dir_subida.basename($nuevoNombre);
			// Mover del temporal al directorio actual
			move_uploaded_file($ubicacionTemporal, $fichero_subido);

			$sql = "UPDATE banner set title = '$banner_title', subtitle = '$banner_subtitle', imagen = '$img', creatorUser = '$idUser' WHERE id = $banner_id";
			$query = $db->Execute($sql);

			return $query;
		}

		public function delet(){
			global $db;
			$id = $_POST["id"];
			$sql = "DELETE from banner WHERE id = '$id'";
			$query = $db->Execute($sql);

			return $query;
		}

		public function list(){
			global $db;
			$sql = "SELECT * FROM banner ORDER BY (id) DESC";
			$query = $db->Execute($sql);
			return $query;
		}

		public function edit( $id ){
			global $db;
			$sql = "SELECT * FROM banner WHERE id = '$id'";
			$sqlQuery = $db->Execute($sql);
			return $sqlQuery;
		}

		public function status($id, $val){
			global $db;
			$sql = "UPDATE banner set status = '$val' WHERE id = $id";
			$query = $db->Execute($sql);
			return $query;
		}

		public function listaEmpresa(){
			global $db;

			$sql = "SELECT * FROM cliente_empresa";
			$query = $db->Execute($sql);
			return $query;
		}

		public function listaTypeIndice(){
			global $db;

			$sql = "SELECT * FROM tipo";
			$query = $db->Execute($sql);
			return $query;
		}

		public function listaTema(){
			global $db;

			$sql = "SELECT * FROM tema";
			$query = $db->Execute($sql);
			return $query;
		}

		public function listaConcor(){
			global $db;
			$idBol = $_GET['idBol'];

			$sql = "SELECT * FROM concordancia WHERE boletin = '$idBol'";
			$query = $db->Execute($sql);
			return $query;
		}

		public function searchBol(){
			global $db;

			$id = $_POST['idBol'];
			$tipo = $_POST['tipo'];
			$text = $_POST['text'];

			$sql = "SELECT b.idBoletin FROM boletin AS b, tipo AS t WHERE b.id_tipo = t.id";
			if($id != '')
				$sql.= " AND b.idBoletin = $id";
			if($tipo != '')
				$sql.= " AND t.id = '$tipo'";
			if($text != '')
				$sql.= " AND t.asunto LIKE '%$text%'";

			$sql.= " ORDER BY b.idBoletin DESC";

			$query = $db->Execute($sql);
			return $query;
		}

		public function listaTypeUser(){
			global $db;

			$sql = "SELECT * FROM usergroups";
			$query = $db->Execute($sql);
			return $query;
		}

		public function Ingresar_Sistema($user, $pass){
			global $db;
			/*$sql = "SELECT u.*, s.businessName, s.logo AS logo, concat(e.name, ' ', e.apPaterno, ' ', e.apMaterno) AS empleado, e.*, e.status AS superadmin, e.name, e.apPaterno, e.apMaterno, e.birthDate
					FROM usuario u INNER JOIN sucursal s ON u.idSucursal = s.idSucursal
					INNER JOIN empleado e ON u.idEmpleado = e.idEmpleado
					WHERE e.login = '$user' AND e.pass = '$pass' AND u.status <> 'C'";*/
			$sql = "SELECT * FROM users  WHERE username = '$user' AND password = '$pass'";

			$query = $db->Execute($sql);
			return $query;
		}

		public function verPerfil($idusuario){
			global $conexion;
			$sql = "SELECT mnu_perfil from usuario WHERE idusuario = $idusuario";
			$query = $conexion->query($sql);
			return $query;
		}

	}
?>