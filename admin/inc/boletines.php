<?php
	include "conexion.php";

	class boletin{

		public function __construct(){
		}

		public function Registrar($indice, $idUser, $nroRef, $dateImpresion, $datePubli, $dateBoletin, $asunto, $info, $intro, $cont, $nombre_img, $pieImg, $nota){
			global $db;

			date_default_timezone_set("America/La_Paz");
			$date = date( 'Y-m-d H:i', time());

			$strQuery = "SELECT max(idBoletin) FROM boletin";
			$query = $db->Execute($strQuery);
			$idLastBoletin = $query->FetchRow();

			$idLastBoletin[0]++;

			$sql = "INSERT INTO boletin(idBoletin , id_tipo, id_usuario, ficha, circular, fecha_circular, fecha_publicacion, fecha_creacion, fecha_impresion, asunto, info_adicional, introduccion, contenido, imagen, pie_imagen, nota)
						VALUES('$idLastBoletin[0]','$indice', '$idUser', 0, '$nroRef', '$dateImpresion', '$datePubli', '$dateBoletin', '$dateImpresion', '$asunto', '$info', '$intro', '$cont', '$nombre_img', '$pieImg', '$nota')";
			$query = $db->Execute($sql);

			$dir_subida = '../modulo/boletin/img/';
			$fichero_subido = $dir_subida.basename($_FILES['imgBol']['name']);
			move_uploaded_file($_FILES['imgBol']['tmp_name'], $fichero_subido);

			if(!empty($_POST['checkTema'])){
				// Bucle para almacenar y mostrar los valores de la casilla de verificación comprobación individual.
				foreach($_POST['checkTema'] as $selected){
					$sql = "INSERT INTO boletin_rel_tema(ficha, boletin, id_tema) VALUES(0, $idLastBoletin[0], $selected)";
					$queryT = $db->Execute($sql);
				}
			}

			/** INSERT CONCORDANCIAS */
			$sqlCon = "SELECT id FROM concordancia_clase";
			$resQuery = $db->Execute($sqlCon);

			while ($reg = $resQuery->FetchRow()) {
				if(!empty($_POST[$reg[0].'Check'])){
					// Bucle para almacenar y mostrar los valores de la casilla de verificación comprobación individual.
					foreach($_POST[$reg[0].'Check'] as $selected){
						$sql = "INSERT INTO concordancia(id_usuario, boletin, id_concordancia, id_clase, fecha) VALUES($idUser, $idLastBoletin[0], $selected, $reg[0], '$date')";
						$queryT = $db->Execute($sql);
					}
				}
			}
			return $query;
		}

		public function Modificar($idBoletin, $indice, $idUser, $nroRef, $dateImpresion, $datePubli, $dateBoletin, $asunto, $info, $intro, $cont, $nombre_img, $pieImg, $nota){
			global $db;

			date_default_timezone_set("America/La_Paz");
			$date = date( 'Y-m-d H:i', time());

			$sql = "UPDATE boletin set id_tipo = '$indice', id_usuario = '$idUser', ficha = '0', circular = '$nroRef', fecha_circular = '$dateImpresion', fecha_publicacion = '$datePubli', fecha_creacion = '$dateBoletin', fecha_impresion = '$dateImpresion', asunto = '$asunto', info_adicional = '$info', introduccion = '$intro', contenido = '$cont', imagen = '$nombre_img', pie_imagen = '$pieImg', nota = '$nota' WHERE idBoletin = $idBoletin";
			$query = $db->Execute($sql);

			$dir_subida = '../modulo/boletin/img/';
			$fichero_subido = $dir_subida.basename($_FILES['imgBol']['name']);
			move_uploaded_file($_FILES['imgBol']['tmp_name'], $fichero_subido);

			if(!empty($_POST['checkTema'])){
				$sql = "DELETE FROM boletin_rel_tema WHERE boletin = '$idBoletin'";
				$query = $db->Execute($sql);
				// Bucle para almacenar y mostrar los valores de la casilla de verificación comprobación individual.
				foreach($_POST['checkTema'] as $selected){
					$sql = "INSERT INTO boletin_rel_tema(ficha, boletin, id_tema) VALUES(0, $idBoletin, $selected)";
					$queryT = $db->Execute($sql);
				}
			}

			/** INSERT CONCORDANCIAS */
			$sqlCon = "SELECT id FROM concordancia_clase";
			$resQuery = $db->Execute($sqlCon);

			$sqlC = "DELETE FROM concordancia WHERE boletin = '$idBoletin'";
			$query = $db->Execute($sqlC);

			while ($reg = $resQuery->FetchRow()) {
				if(!empty($_POST[$reg[0].'Check'])){
					// Bucle para almacenar y mostrar los valores de la casilla de verificación comprobación individual.
					foreach($_POST[$reg[0].'Check'] as $selected){
						$sql = "INSERT INTO concordancia(id_usuario, boletin, id_concordancia, id_clase, fecha) VALUES($idUser, $idBoletin, $selected, $reg[0], '$date')";
						$queryT = $db->Execute($sql);
					}
				}
			}

			return $query;
		}

		public function deletBoletin(){
			global $db;
			$idBol = $_POST["idBol"];
			$sql = "DELETE from boletin WHERE idBoletin = '$idBol'";
			$query = $db->Execute($sql);

			$sql = "DELETE from boletin_rel_tema WHERE boletin = '$idBol'";
			$query = $db->Execute($sql);

			$sql = "DELETE from concordancia WHERE boletin = '$idBol'";
			$query = $db->Execute($sql);

			return $query;
		}

		public function listaBoletin(){
			global $db;
			$sql = "SELECT b.idBoletin, b.asunto, tp.tipo AS indice, GROUP_CONCAT(t.tema) AS tema, b.fecha_creacion, b.fecha_publicacion, b.visita, b.blocked
			FROM boletin AS b LEFT JOIN boletin_rel_tema AS rt ON b.idBoletin = rt.boletin LEFT JOIN tema AS t ON rt.id_tema = t.id
			LEFT JOIN tipo AS tp ON tp.id = b.id_tipo
			GROUP BY b.idBoletin
			ORDER BY b.idBoletin DESC ";
			$query = $db->Execute($sql);
			return $query;
		}

		public function editBoletin( $idBoletin ){
			global $db;
			$sql = "SELECT b.idBoletin, b.circular, b.imagen, b.pie_imagen, tp.id AS idIn, tp.tipo AS indice, t.id AS idTema, t.tema AS tema, b.fecha_circular, b.fecha_creacion, b.fecha_publicacion, b.asunto, b.introduccion, b.contenido, b.info_adicional, b.nota
			FROM boletin AS b LEFT JOIN boletin_rel_tema AS rt ON b.idBoletin = rt.boletin LEFT JOIN tema AS t ON rt.id_tema = t.id
			LEFT JOIN tipo AS tp ON tp.id = b.id_tipo
			WHERE idBoletin = '$idBoletin'";
			$sqlQuery = $db->Execute($sql);
			return $sqlQuery;
		}

		public function block($idBol, $val){
			global $db;
			$sql = "UPDATE boletin set blocked = $val WHERE idBoletin = $idBol";
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
