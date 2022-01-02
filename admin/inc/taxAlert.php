<?php
	include "conexion.php";

	class taxAlert{

		public function __construct(){
		}

		public function Registrar($tax_title, $tax_resume, $tax_contens, $name_file, $name_img, $idUser){
			global $db;

			$archivo = '';

			$ubicacionTemporal = $_FILES["tax_file"]["tmp_name"];
			$dir_subida = '../modulo/taxAlert/file/';
			$nombreArchivo = $_FILES["tax_file"]["name"];
			$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Renombrar archivo
			$nuevoNombre = sprintf("%s_%d.%s", uniqid(), 1, $extension);

			$archivo = $nuevoNombre;

			$fichero_subido = $dir_subida.basename($nuevoNombre);
			// Mover del temporal al directorio actual
			move_uploaded_file($ubicacionTemporal, $fichero_subido);

			$img = '';

			$ubicacionTemporal = $_FILES["tax_img"]["tmp_name"];
			$dir_subida = '../modulo/taxAlert/img/';
			$nombreArchivo = $_FILES["tax_img"]["name"];
			$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Renombrar archivo
			$nuevoNombre = sprintf("%s_%d.%s", uniqid(), 1, $extension);

			$img = $nuevoNombre;

			$fichero_subido = $dir_subida.basename($nuevoNombre);
			// Mover del temporal al directorio actual
			move_uploaded_file($ubicacionTemporal, $fichero_subido);


			$sql = "INSERT INTO tax_alert(titulo, resumen, contenido, archivo, imagen, creatorUser) VALUES('$tax_title', '$tax_resume', '$tax_contens', '$archivo', '$img', '$idUser')";
			$query = $db->Execute($sql);

			/*$dir_subida = '../modulo/taxAlert/file/';
			$fichero_subido = $dir_subida.basename($_FILES['tax_file']['name']);
			move_uploaded_file($_FILES['tax_file']['tmp_name'], $fichero_subido);

			$dir_subida = '../modulo/taxAlert/img/';
			$fichero_subido = $dir_subida.basename($_FILES['tax_img']['name']);
			move_uploaded_file($_FILES['tax_img']['tmp_name'], $fichero_subido);*/

			return $query;
		}

		public function Modificar($id, $tax_title, $tax_resume, $tax_contens, $name_file, $name_img, $idUser){
			global $db;

			$archivo = '';

			$ubicacionTemporal = $_FILES["tax_file"]["tmp_name"];
			$dir_subida = '../modulo/taxAlert/file/';
			$nombreArchivo = $_FILES["tax_file"]["name"];
			$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Renombrar archivo
			$nuevoNombre = sprintf("%s_%d.%s", uniqid(), 1, $extension);

			$archivo = $nuevoNombre;

			$fichero_subido = $dir_subida.basename($nuevoNombre);
			// Mover del temporal al directorio actual
			move_uploaded_file($ubicacionTemporal, $fichero_subido);

			$img = '';

			$ubicacionTemporal = $_FILES["tax_img"]["tmp_name"];
			$dir_subida = '../modulo/taxAlert/img/';
			$nombreArchivo = $_FILES["tax_img"]["name"];
			$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
			// Renombrar archivo
			$nuevoNombre = sprintf("%s_%d.%s", uniqid(), 1, $extension);

			$img = $nuevoNombre;

			$fichero_subido = $dir_subida.basename($nuevoNombre);
			// Mover del temporal al directorio actual
			move_uploaded_file($ubicacionTemporal, $fichero_subido);

			$sql = "UPDATE tax_alert set titulo = '$tax_title', resumen = '$tax_resume', contenido = '$tax_contens', archivo = '$archivo', imagen = '$img', creatorUser = '$idUser' WHERE id = $id";
			$query = $db->Execute($sql);

			return $query;
		}

		public function delet(){
			global $db;
			$id = $_POST["id"];
			$sql = "DELETE from tax_alert WHERE id = '$id'";
			$query = $db->Execute($sql);

			return $query;
		}

		public function list(){
			global $db;
			$sql = "SELECT * FROM tax_alert ORDER BY (id) DESC";
			$query = $db->Execute($sql);
			return $query;
		}

		public function edit( $id ){
			global $db;
			$sql = "SELECT * FROM tax_alert	WHERE id = '$id'";
			$sqlQuery = $db->Execute($sql);
			return $sqlQuery;
		}

		public function status($id, $val){
			global $db;
			$sql = "UPDATE tax_alert set status = '$val' WHERE id = $id";
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
