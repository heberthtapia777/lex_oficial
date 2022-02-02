<?php
	session_start();
	include "conexion.php";

	class usuario{

		public function __construct(){
		}

		public function Registrar($empresaId, $empresa, $usuario, $typeUser, $email, $nameUsers, $password){
			global $db;

			date_default_timezone_set("America/La_Paz");
			$date = date( 'Y-m-d H:i', time());

			$sql = "INSERT INTO users(name, email, username, password, block, registerDate) VALUES('$usuario', '$email', '$nameUsers', '$password', '0', '$date')";
			$query = $db->Execute($sql);

			$lastId = $db->insert_Id();

			$sql = "INSERT INTO user_usergroup_map(user_id, group_id) VALUES('$lastId', '$typeUser')";
			$query = $db->Execute($sql);

			$sql = "INSERT INTO cliente_usuario(id_usuario, id_empresa, nombre, cargo, email) VALUES('$lastId', '$empresaId', '$usuario', '', '$email')";
			$query = $db->Execute($sql);
			return $query;

		}

		public function Modificar($usersId, $empresaId, $empresa, $usuario,	$typeUser, $email, $nameUsers, $password){
			global $db;

			date_default_timezone_set("America/La_Paz");
			$date = date( 'Y-m-d H:i', time());

			$sql = "UPDATE users set name = '$usuario', email = '$email', username = '$nameUsers', password = '$password', lastvisitDate = '$date' WHERE id = $usersId";
			$query = $db->Execute($sql);

			$sql = "UPDATE user_usergroup_map set group_id = '$typeUser' WHERE user_id = '$usersId'";
			$query = $db->Execute($sql);

			$sql = "UPDATE cliente_usuario set id_empresa = '$empresaId', nombre = '$usuario', cargo = '', email = '$email' WHERE id_usuario = '$usersId' ";
			$query = $db->Execute($sql);
			return $query;
		}

		public function Eliminar($usersId){
			global $db;
			$sql = "DELETE from users WHERE id = $usersId";
			$query = $db->Execute($sql);
			return $query;
		}

		public function Listar(){
			global $db;
			//$sql = "SELECT u.*, s.businessName, concat(e.name, ' ', e.apPaterno, ' ', e.apMaterno) as empleado from usuario u inner join sucursal s on u.idsucursal = s.idsucursal inner join empleado e on u.idempleado = e.idempleado where u.status <> 'C'";
			$sql = "SELECT u.id, u.name, u.username, u.block, g.title, u.email, u.registerDate, u.lastVisitDate FROM users u INNER JOIN user_usergroup_map m ON u.id = m.user_id INNER JOIN usergroups g ON m.group_id = g.id ORDER BY u.id DESc";
			$query = $db->Execute($sql);
			return $query;
		}

		public function edit( $id ){
			global $db;
			$sql = "SELECT e.id AS idEmp, e.empresa, u.id, u.name, u.username, u.block, g.id AS title, u.email, u.registerDate, u.lastVisitDate FROM users u INNER JOIN user_usergroup_map m ON u.id = m.user_id INNER JOIN usergroups g ON m.group_id = g.id INNER JOIN cliente_usuario s ON s.id_usuario = u.id INNER JOIN cliente_empresa e ON s.id_empresa = e.id WHERE u.id = '$id' ORDER BY u.id DESC";
			$sqlQuery = $db->Execute($sql);
			return $sqlQuery;
		}

		public function listaEmpresa(){
			global $db;

			$sql = "SELECT * FROM cliente_empresa";
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


		public function listaTypeUser(){
			global $db;

			$sql = "SELECT * FROM usergroups";
			$query = $db->Execute($sql);
			return $query;
		}

		public function status($id, $val){
			global $db;
			$sql = "UPDATE users set block = $val WHERE id = $id";
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