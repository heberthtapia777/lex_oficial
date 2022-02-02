<?php
	include "conexion.php";	

	class tema{

		public function __construct(){
		}

		public function Registrar($tema_title, $idUser){
			global $db;	

			$sql = "INSERT INTO tema(tema, id_usuario) VALUES('$tema_title', '$idUser')";
			$query = $db->Execute($sql);
			
			return $query;
		}

		public function Modificar($tema_id, $tema_title, $idUser){
			global $db;

			$sql = "UPDATE tema set tema = '$tema_title', id_usuario = '$idUser' WHERE id = $tema_id";
			$query = $db->Execute($sql);

			return $query;
		}

		public function delet(){
			global $db;
			$id = $_POST["id"];
			$sql = "DELETE from tema WHERE id = '$id'";
			$query = $db->Execute($sql);
			
			return $query;
		}

		public function list(){
			global $db;			
			$sql = "SELECT * FROM tema ORDER BY (id) ASC";
			$db -> setCharset ( 'utf8' ) ;
			$query = $db->Execute($sql);
			return $query;
		}

		public function edit( $id ){
			global $db;			
			$sql = "SELECT * FROM tema WHERE id = '$id'";
			$db -> setCharset ( 'utf8' ) ;
			$sqlQuery = $db->Execute($sql);
			return $sqlQuery;
		}

		public function status($id, $val){
			global $db;	
			$sql = "UPDATE tema set status = '$val' WHERE id = $id";
			$query = $db->Execute($sql);
			return $query;
		}

		
	}
?>