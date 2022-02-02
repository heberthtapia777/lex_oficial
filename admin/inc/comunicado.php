<?php
	include "conexion.php";

	class comunicado{

		public function __construct(){
		}

		public function Registrar($com_title, $com_resume, $com_contens, $com_autor, $idUser){
			global $db;

			/**
			 * subida de una imagen
			 */
			$img = '';

			$ubicacionTemporal = $_FILES["com_img"]["tmp_name"];
			$dir_subida = '../modulo/comunicado/img/';
			$nombreArchivo = $_FILES["com_img"]["name"];
			$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Renombrar archivo
			$nuevoNombre = sprintf("%s_%d.%s", uniqid(), 1, $extension);

			$img = $nuevoNombre;

			$fichero_subido = $dir_subida.basename($nuevoNombre);
			// Mover del temporal al directorio actual
			move_uploaded_file($ubicacionTemporal, $fichero_subido);

			/**
			 * Subida de varios archivos
			 */
			$archivo = '';

			$ubicacionTemporal = $_FILES["com_file"]["tmp_name"];
			$dir_subida = '../modulo/comunicado/file/';
			$nombreArchivo = $_FILES["com_file"]["name"];
			$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Renombrar archivo
			$nuevoNombre = sprintf("%s_%d.%s", uniqid(), 0, $extension);

			$archivo = $nuevoNombre;

			$fichero_subido = $dir_subida.basename($nuevoNombre);
			// Mover del temporal al directorio actual
			move_uploaded_file($ubicacionTemporal, $fichero_subido);


			$sql = "INSERT INTO comunicado(titulo, resumen, contenido, autor, archivo, imagen, creatorUser) VALUES('$com_title', '$com_resume', '$com_contens', '$com_autor', '$archivo', '$img','$idUser')";
			$query = $db->Execute($sql);

			return $query;
		}

		public function Modificar($com_id, $com_title, $com_resume, $com_contens, $com_autor, $idUser){
			global $db;

			/**
			 * subida de una imagen
			 */

			$img = '';

			$ubicacionTemporal = $_FILES["com_img"]["tmp_name"];
			$dir_subida = '../modulo/comunicado/img/';
			$nombreArchivo = $_FILES["com_img"]["name"];
			$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Renombrar archivo
			$nuevoNombre = sprintf("%s_%d.%s", uniqid(), 1, $extension);

			$img = $nuevoNombre;

			$fichero_subido = $dir_subida.basename($nuevoNombre);
			// Mover del temporal al directorio actual
			move_uploaded_file($ubicacionTemporal, $fichero_subido);

			/**
			 * Subida de varios archivos
			 */

			$archivo = '';

			$ubicacionTemporal = $_FILES["com_file"]["tmp_name"];
			$dir_subida = '../modulo/comunicado/file/';
			$nombreArchivo = $_FILES["com_file"]["name"];
			$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Renombrar archivo
			$nuevoNombre = sprintf("%s_%d.%s", uniqid(), 0, $extension);

			$archivo = $nuevoNombre;

			$fichero_subido = $dir_subida.basename($nuevoNombre);
			// Mover del temporal al directorio actual
			move_uploaded_file($ubicacionTemporal, $fichero_subido);

			$sql = "UPDATE comunicado set titulo = '$com_title', resumen = '$com_resume', contenido = '$com_contens', autor = '$com_autor', archivo = '$archivo', imagen = '$img',  creatorUser = '$idUser' WHERE id = $com_id";
			$query = $db->Execute($sql);

			return $query;
		}

		public function delet(){
			global $db;
			$id = $_POST["id"];
			$sql = "DELETE from comunicado WHERE id = '$id'";
			$query = $db->Execute($sql);

			return $query;
		}

		public function list(){
			global $db;
			$sql = "SELECT * FROM comunicado ORDER BY (id) DESC";
			$query = $db->Execute($sql);
			return $query;
		}

		public function edit( $id ){
			global $db;
			$sql = "SELECT * FROM comunicado	WHERE id = '$id'";
			$sqlQuery = $db->Execute($sql);
			return $sqlQuery;
		}

		public function status($id, $val){
			global $db;
			$sql = "UPDATE comunicado set status = '$val' WHERE id = $id";
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