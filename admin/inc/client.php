<?php
	session_start();
	include "conexion.php";

	class cliente{

		public function __construct(){
		}

		public function Registrar($empresa, $nit, $date, $email, $fono, $fax, $address, $city, $sus, $plan, $lic, $hab){
			global $db;

			$sql = "INSERT INTO cliente_empresa(empresa, nit, cf_created, email, telefono, fax, direccion, ciudad, suscripcion, plan, licencias, block)
						VALUES('$empresa', '$nit', '$date', '$email', '$fono', '$fax', '$address', '$city', '$sus', '$plan', '$lic', '$hab')";
			$query = $db->Execute($sql);
			return $query;
		}

		public function Modificar($id, $empresa, $nit, $date, $email, $fono, $fax, $address, $city, $sus, $plan, $lic, $hab){
			global $db;
			$sql = "UPDATE cliente_empresa set empresa = '$empresa', nit = '$nit', cf_modified = '$date', email = '$email', telefono = '$fono', fax = '$fax', direccion = '$address', ciudad = '$city', suscripcion = '$sus', plan = '$plan', licencias = '$lic', block = '$hab' WHERE id = $id";
			$query = $db->Execute($sql);
			return $query;
		}

		public function Eliminar($idcliente){
			global $db;
			$sql = "DELETE from cliente_empresa WHERE id = $idcliente";
			$query = $db->Execute($sql);
			return $query;
		}

		public function Listar(){
			global $db;
			//$sql = "SELECT u.*, s.businessName, concat(e.name, ' ', e.apPaterno, ' ', e.apMaterno) as empleado from usuario u inner join sucursal s on u.idsucursal = s.idsucursal inner join empleado e on u.idempleado = e.idempleado where u.status <> 'C'";
			$sql = "SELECT * FROM cliente_empresa ORDER BY id DESC";
			$query = $db->Execute($sql);
			return $query;
		}

		public function edit( $id ){
			global $db;
			$sql = "SELECT * FROM cliente_empresa WHERE id = '$id'";
			$sqlQuery = $db->Execute($sql);
			return $sqlQuery;
		}

		public function listaTypePlan(){
			global $db;

			$sql = "SELECT * FROM cliente_licencias";
			$query = $db->Execute($sql);
			return $query;
		}

		public function listaTypeUser(){
			global $db;

			$sql = "SELECT * FROM usergroups";
			$query = $db->Execute($sql);
			return $query;
		}

		public function status($id, $val){
			global $db;
			$sql = "UPDATE cliente_empresa set block = $val WHERE id = $id";
			$query = $db->Execute($sql);
			return $query;
		}

	}
?>