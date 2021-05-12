<?php
	session_start();
	include "conexion.php";

	class usuario{


		public function __construct(){
		}

		public function Registrar($idsucursal, $idempleado, $tipo_usuario, $num_grupo, $mnu_almacen, $mnu_compras, $mnu_ventas, $mnu_mantenimiento, $mnu_seguridad, $mnu_consulta_compras, $mnu_consultas_ventas, $mnu_admin, $mnu_perfil){
			global $conexion;
			
			$sql = "INSERT INTO usuario(idsucursal, idempleado, tipo_usuario, num_grupo, fecha_registro, mnu_almacen, mnu_compras, mnu_ventas, mnu_mantenimiento, mnu_seguridad, mnu_consulta_compras, mnu_consulta_ventas, mnu_admin, mnu_perfil, estado)
						VALUES($idsucursal, $idempleado, '$tipo_usuario', $num_grupo, curdate(), $mnu_almacen, $mnu_compras, $mnu_ventas, $mnu_mantenimiento, $mnu_seguridad, $mnu_consulta_compras, $mnu_consultas_ventas, $mnu_admin, $mnu_perfil, 'A')";
			$query = $conexion->query($sql);
			return $query;
		}

		public function Modificar($idusuario, $idsucursal, $idempleado, $tipo_usuario, $num_grupo, $mnu_almacen, $mnu_compras, $mnu_ventas, $mnu_mantenimiento, $mnu_seguridad, $mnu_consulta_compras, $mnu_consultas_ventas, $mnu_admin, $mnu_perfil){
			global $conexion;
			$sql = "UPDATE usuario set idsucursal = $idsucursal, idempleado = $idempleado, tipo_usuario = '$tipo_usuario', num_grupo = '$num_grupo', mnu_almacen = $mnu_almacen, mnu_compras = $mnu_compras, mnu_ventas = $mnu_ventas, mnu_mantenimiento = $mnu_mantenimiento, mnu_seguridad = $mnu_seguridad, mnu_consulta_compras = $mnu_consulta_compras, mnu_consulta_ventas = $mnu_consultas_ventas, mnu_admin = $mnu_admin, mnu_perfil = $mnu_perfil WHERE idusuario = $idusuario";
			$query = $conexion->query($sql);
			return $query;
		}

		public function Eliminar($idusuario){
			global $conexion;
			$sql = "DELETE from usuario WHERE idusuario = $idusuario";
			$query = $conexion->query($sql);
			return $query;
		}

		public function Listar(){
			global $db;
			//$sql = "SELECT u.*, s.businessName, concat(e.name, ' ', e.apPaterno, ' ', e.apMaterno) as empleado from usuario u inner join sucursal s on u.idsucursal = s.idsucursal inner join empleado e on u.idempleado = e.idempleado where u.status <> 'C'";
			$sql = "SELECT u.id, u.name, u.username, u.block, g.title, u.email, u.registerDate, u.lastVisitDate FROM users u INNER JOIN user_usergroup_map m ON u.id = m.user_id INNER JOIN usergroups g ON m.group_id = g.id ORDER BY u.id DESc";
			$query = $db->Execute($sql);
			return $query;
		}

		public function listaEmpresa(){
			global $db;
			
			$sql = "SELECT * FROM cliente_empresa";
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

		public function status($id, $val){
			global $db;	
			$sql = "UPDATE users set block = '$val' WHERE id = $id";
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
