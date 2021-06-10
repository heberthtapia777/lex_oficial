<?php
	include "conexion.php";	

	class indice{

		public function __construct(){
		}

		public function Registrar($indice_title, $idUser){
			global $db;	

			$sql = "INSERT INTO tipo(tipo, id_usuario) VALUES('$indice_title', '$idUser')";
			$query = $db->Execute($sql);
			
			return $query;
		}

		public function Modificar($indice_id, $indice_title, $idUser){
			global $db;

			$sql = "UPDATE tipo set tipo = '$indice_title', id_usuario = '$idUser' WHERE id = $indice_id";
			$query = $db->Execute($sql);

			return $query;
		}

		public function delet(){
			global $db;
			$id = $_POST["id"];
			$sql = "DELETE from tipo WHERE id = '$id'";
			$query = $db->Execute($sql);
			
			return $query;
		}

		public function list(){
			global $db;			
			$sql = "SELECT * FROM tipo ORDER BY (id) ASC";
			$db -> setCharset ( 'utf8' ) ;
			$query = $db->Execute($sql);
			return $query;
		}

		public function edit( $id ){
			global $db;			
			$sql = "SELECT * FROM tipo WHERE id = '$id'";
			$db -> setCharset ( 'utf8' ) ;
			$sqlQuery = $db->Execute($sql);
			return $sqlQuery;
		}

		public function status($id, $val){
			global $db;	
			$sql = "UPDATE tipo set status = '$val' WHERE id = $id";
			$query = $db->Execute($sql);
			return $query;
		}

		
	}
