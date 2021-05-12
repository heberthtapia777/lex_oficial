<?php
	require "../admin/inc/conexion.php";

	class resBusqueda{

		public function __construct(){

		}

		public function listaBusquedaNum($text){
			global $db;

			$db->setCharset('utf8');

			//echo "--->".$porNum;
			$sql = "SELECT idBoletin, asunto, tipo, GROUP_CONCAT(`tema`) AS tema, fecha_creacion, fecha_publicacion, visita
			FROM boletin AS b LEFT JOIN boletin_rel_tema AS rt ON b.idBoletin = rt.boletin LEFT JOIN tema AS t ON rt.id_tema = t.id LEFT JOIN tipo AS tp ON tp.id = b.id_tipo
			WHERE asunto LIKE '%$text%'
			OR introduccion LIKE '%$text%'
			GROUP BY idBoletin";

			$query = $db->Execute($sql);
			return $query;
		}




	}
