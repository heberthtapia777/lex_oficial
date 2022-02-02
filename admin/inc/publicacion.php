<?php
	include "conexion.php";

	class publicacion{

		public function __construct(){
		}

		public function Registrar($publi_title, $publi_resume, $publi_contens, $publi_autor, $idUser){
			global $db;

			/**
			 * subida de una imagen
			 */
			$img = '';

			$ubicacionTemporal = $_FILES["publi_img"]["tmp_name"];
			$dir_subida = '../modulo/publicacion/img/';
			$nombreArchivo = $_FILES["publi_img"]["name"];
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

			$conteo = count($_FILES["publi_file"]["name"]);
			for ($i = 0; $i < $conteo; $i++) {
				$ubicacionTemporal = $_FILES["publi_file"]["tmp_name"][$i];
				$dir_subida = '../modulo/publicacion/file/';
				$nombreArchivo = $_FILES["publi_file"]["name"][$i];
				$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
				// Renombrar archivo
				$nuevoNombre = sprintf("%s_%d.%s", uniqid(), $i, $extension);
				if ($i == 0) {
					$archivo = $nuevoNombre;
				}else{
					$archivo = $archivo.','.$nuevoNombre;
				}
				$fichero_subido = $dir_subida.basename($nuevoNombre);
				// Mover del temporal al directorio actual
				move_uploaded_file($ubicacionTemporal, $fichero_subido);
			}

			$sql = "INSERT INTO publicacion(titulo, resumen, contenido, autor, archivo, imagen, creatorUser) VALUES('$publi_title', '$publi_resume', '$publi_contens', '$publi_autor', '$archivo', '$img','$idUser')";
			$query = $db->Execute($sql);

			return $query;
		}

		public function Modificar($publi_id, $publi_title, $publi_resume, $publi_contens, $publi_autor, $idUser){
			global $db;

			/**
			 * subida de una imagen
			 */
			$img = '';

			$ubicacionTemporal = $_FILES["publi_img"]["tmp_name"];
			$dir_subida = '../modulo/publicacion/img/';
			$nombreArchivo = $_FILES["publi_img"]["name"];
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

			$conteo = count($_FILES["publi_file"]["name"]);
			for ($i = 0; $i < $conteo; $i++) {
				$ubicacionTemporal = $_FILES["publi_file"]["tmp_name"][$i];
				$dir_subida = '../modulo/publicacion/file/';
				$nombreArchivo = $_FILES["publi_file"]["name"][$i];
				$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
				// Renombrar archivo
				$nuevoNombre = sprintf("%s_%d.%s", uniqid(), $i, $extension);
				if ($i == 0) {
					$archivo = $nuevoNombre;
				}else{
					$archivo = $archivo.','.$nuevoNombre;
				}
				$fichero_subido = $dir_subida.basename($nuevoNombre);
				// Mover del temporal al directorio actual
				move_uploaded_file($ubicacionTemporal, $fichero_subido);
			}

			$sql = "UPDATE publicacion set titulo = '$publi_title', resumen = '$publi_resume', contenido = '$publi_contens', autor = '$publi_autor', archivo = '$archivo', imagen = '$img',  creatorUser = '$idUser' WHERE id = $publi_id";
			$query = $db->Execute($sql);

			return $query;
		}

		public function delet(){
			global $db;
			$id = $_POST["id"];
			$sql = "DELETE from publicacion WHERE id = '$id'";
			$query = $db->Execute($sql);

			return $query;
		}

		public function list(){
			global $db;
			$sql = "SELECT * FROM publicacion ORDER BY (id) DESC";
			$query = $db->Execute($sql);
			return $query;
		}

		public function edit( $id ){
			global $db;
			$sql = "SELECT * FROM publicacion	WHERE id = '$id'";
			$sqlQuery = $db->Execute($sql);
			return $sqlQuery;
		}

		public function status($id, $val){
			global $db;
			$sql = "UPDATE publicacion set status = '$val' WHERE id = $id";
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