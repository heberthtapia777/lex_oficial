<?php
	include "../inc/users.php";

	$objusuario = new usuario();

	switch ($_GET["op"]) {

		case 'SaveOrUpdate':
			

			$idsucursal   = $_POST["cboSucursal"];
			$idempleado   = $_POST["txtIdEmpleado"];
			$tipo_usuario = $_POST["cboTipoUsuario"];
			$num_grupo    = $_POST["cboGrupo"];
			

				if(empty($_POST["txtIdUsuario"])){

					if($objusuario->Registrar($idsucursal, $idempleado, $tipo_usuario, $num_grupo, $alm, $comp, $vent, $mant, $seg, $cons_comp,
						$cons_vent, $admin, $perfil)){
						echo "Registrado Exitosamente";
					}else{
						echo "Usuario no ha podido ser registado.";
					}
				}else{

					$idusuario = $_POST["txtIdUsuario"];
					if($objusuario->Modificar($idusuario, $idsucursal, $idempleado, $tipo_usuario, $num_grupo, $alm, $comp, $vent, $mant, $seg, $cons_comp,
						$cons_vent, $admin, $perfil)){
						echo "Informacion del Usuario ha sido actualizada";
					}else{
						echo "Informacion del usuario no ha podido ser actualizada.";
					}
				}

			break;

		case "delete":

			$id = $_POST["id"];
			$result = $objusuario->Eliminar($id);
			if ($result) {
				echo "Eliminado Exitosamente";
			} else {
				echo "No fue Eliminado";
			}
			break;

		case "list":
			$query_Tipo = $objusuario->Listar();
			$data = Array();
            $i = 1;
     		while ($reg = $query_Tipo->FetchRow()) {
				if($reg['block'] == 0)					
					$status = '<a href="#" id="'.$reg["id"].'" onclick="status('.$reg["id"].', 0)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>';
				else
					$status = '<a href="#" id="'.$reg["id"].'" onclick="status('.$reg["id"].', 1)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>';
     			$data[] = array(
     				"0"=>$i,
                    "1"=>utf8_encode($reg['name']),
                    "2"=>utf8_encode($reg['username']),
                    "3"=>$status,
					"4"=>utf8_encode($reg['title']),
					"5"=>utf8_encode($reg['email']),
					"6"=>utf8_encode($reg['registerDate']),
					"7"=>utf8_encode($reg['lastVisitDate']),
                    "8"=>'<button class="btn btn-warning btn-sm mr-1 mb-1" data-toggle="tooltip" title="Editar" onclick="cargaData('.$reg['id'].')"><i class="fas fa-pencil-alt"></i> </button>&nbsp;'.
					'<button class="btn btn-danger btn-sm mr-1 mb-1" data-toggle="tooltip" title="Eliminar" onclick="delet('.$reg['id'].')"><i class="fas fa-trash"></i> </button>');
                $i++;
			}			
            $results = array(
            "sEcho" => 1,
        	"iTotalRecords" => count($data),
        	"iTotalDisplayRecords" => count($data),
			"aaData"=>$data);			
			echo json_encode($results);

			break;
		
		case "status":			
			$id = $_POST['id'];
			$val = $_POST['val'];
			
			$query = $objusuario->status($id, $val);
				
			if($query)
				echo 1;
			else
				echo 0;
	
			break;

		case "listEmpleado":
			
			$query_Tipo = $objusuario->listaEmpresa();
			$data = Array();
            $i = 1;
     		while ($reg = $query_Tipo->FetchRow()) {				
     			$data[] = array(
     				"0"=>'<input type="radio" name="optEmpleado" id="optEmpleado" data-empresa="'.utf8_encode($reg['empresa']).'" value="'.$reg['id'].'" />',
                    "1"=>$i,
                    "2"=>utf8_encode($reg['empresa']),
					"3"=>utf8_encode($reg['nit']),
					"4"=>utf8_encode($reg['email']),
					);
                $i++;
			}			
            $results = array(
            "sEcho" => 1,
        	"iTotalRecords" => count($data),
        	"iTotalDisplayRecords" => count($data),
			"aaData"=>$data);			
			echo json_encode($results);

			break;

		case "listTypeUser":

			$query_Tipo = $objusuario->listaTypeUser();

			echo '<option value="">Seleccione</option>';
            
     		while ($reg = $query_Tipo->FetchRow()) {
				echo '<option value=' . $reg['id'] . '>' . $reg['title'] . '</option>';
			}

			break;

	    case "ingresarSistema":

	    	$data = stripslashes($_POST['res']);

	    	$data = json_decode($data);

	    	$user = $data->userName;
			$pass = $data->password;

			$query = $objusuario->Ingresar_Sistema($user, md5($pass));
			$array = $query->FetchRow();

			if(isset($array)){
				$_SESSION["idUser"]   = $array['id'];
				$_SESSION["nameUser"]  = $array['name'];
			}

			echo json_encode($array);			

			/*if(isset($array)){
				$_SESSION["idUsuario"]            = $array['idUsuario'];
				$_SESSION["idEmpleado"]           = $array['idEmpleado'];
				$_SESSION["empleado"]             = $array['empleado'];
				$_SESSION["name"]     		      = $array['name'];
				$_SESSION["apPaterno"]            = $array['apPaterno'];
				$_SESSION["apMaterno"]            = $array['apMaterno'];
				$_SESSION["docType"]	     	  = $array['docType']	;
				$_SESSION["docNum"]   	      	  = $array['docNum']	;
				$_SESSION["userType"]         	  = $array['userType'];
				$_SESSION["address"]    	      = $array['address'];
				$_SESSION["number"] 	   	      = $array['number'];
				$_SESSION["phone"]   	          = $array['phone'];
				$_SESSION["celular"]   	          = $array['celular'];
				$_SESSION["photo"]                = $array['photo'];
				$_SESSION["logo"]                 = $array['logo'];
				$_SESSION["email"]                = $array['email'];
				$_SESSION["login"]                = $array['login'];
				$_SESSION["cx"] 	              = $array['coorX'];
				$_SESSION["cy"] 	              = $array['coorY'];
				$_SESSION["birthDate"] 	          = $array['birthDate'];
				$_SESSION["businessName"]         = $array['businessName'];
				$_SESSION["mnu_almacen"]          = $array['mnu_almacen'];
				$_SESSION["mnu_compras"]          = $array['mnu_compras'];
				$_SESSION["mnu_ventas"]           = $array['mnu_ventas'];
				$_SESSION["mnu_mantenimiento"]    = $array['mnu_mantenimiento'];
				$_SESSION["mnu_seguridad"]        = $array['mnu_seguridad'];
				$_SESSION["mnu_consulta_compras"] = $array['mnu_consulta_compras'];
				$_SESSION["mnu_consulta_ventas"]  = $array['mnu_consulta_ventas'];
				$_SESSION["mnu_admin"]            = $array['mnu_admin'];
				$_SESSION["superadmin"]           = $array['superadmin'];
			}*/
			break;

		case "IngresarPanel" :
				$_SESSION["idusuario"]            = $_POST["idusuario"];
				$_SESSION["idsucursal"]           = $_POST["idsucursal"];
				$_SESSION["idempleado"]           = $_POST["idempleado"];
				$_SESSION["superadmin"]           = "A";
				$_SESSION["empleado"]             = $_POST["empleado"];
				$_SESSION["tipo_documento"]       = $_POST["tipo_documento"];
				$_SESSION["userType"]         	  = $_POST["userType"];
				$_SESSION["num_documento"]        = $_POST["num_documento"];
				$_SESSION["direccion"]            = $_POST["direccion"];
				$_SESSION["telefono"]             = $_POST["telefono"];
				$_SESSION["foto"]                 = $_POST["foto"];
				$_SESSION["logo"]                 = $_POST["logo"];
				$_SESSION["email"]                = $_POST["email"];
				$_SESSION["login"]                = $_POST["login"];
				$_SESSION["sucursal"]             = $_POST["razon_social"];
				$_SESSION["mnu_almacen"]          = $_POST["mnu_almacen"];
				$_SESSION["mnu_compras"]          = $_POST["mnu_compras"];
				$_SESSION["mnu_ventas"]           = $_POST["mnu_ventas"];
				$_SESSION["mnu_mantenimiento"]    = $_POST["mnu_mantenimiento"];
				$_SESSION["mnu_seguridad"]        = $_POST["mnu_seguridad"];
				$_SESSION["mnu_consulta_compras"] = $_POST["mnu_consulta_compras"];
				$_SESSION["mnu_consulta_ventas"]  = $_POST["mnu_consulta_ventas"];
				$_SESSION["mnu_admin"]            = $_POST["mnu_admin"];
		break;

		case "IngresarPanelSuperAdmin" :
				$_SESSION["idusuario"]            = $_POST["idusuario"];
				$_SESSION["idsucursal"]           = $_POST["idsucursal"];
				$_SESSION["idempleado"]           = $_POST["idempleado"];
				$_SESSION["superadmin"]           = $_POST["estadoAdmin"];
				$_SESSION["empleado"]             = $_POST["empleado"];
				$_SESSION["tipo_documento"]       = $_POST["tipo_documento"];
				$_SESSION["userType"]        	  = $_POST["userType"];
				$_SESSION["num_documento"]        = $_POST["num_documento"];
				$_SESSION["direccion"]            = $_POST["direccion"];
				$_SESSION["telefono"]             = $_POST["telefono"];
				$_SESSION["foto"]                 = $_POST["foto"];
				$_SESSION["logo"]                 = $_POST["logo"];
				$_SESSION["email"]                = $_POST["email"];
				$_SESSION["login"]                = $_POST["login"];
				$_SESSION["sucursal"]             = $_POST["razon_social"];
				$_SESSION["mnu_almacen"]          = $_POST["mnu_almacen"];
				$_SESSION["mnu_compras"]          = $_POST["mnu_compras"];
				$_SESSION["mnu_ventas"]           = $_POST["mnu_ventas"];
				$_SESSION["mnu_mantenimiento"]    = $_POST["mnu_mantenimiento"];
				$_SESSION["mnu_seguridad"]        = $_POST["mnu_seguridad"];
				$_SESSION["mnu_consulta_compras"] = $_POST["mnu_consulta_compras"];
				$_SESSION["mnu_consulta_ventas"]  = $_POST["mnu_consulta_ventas"];
				$_SESSION["mnu_admin"]            = $_POST["mnu_admin"];
		break;

		case "verPerfil":
	        require_once "../model/usuario.php";

	        $objCategoria = new usuario();

	        $query = $objusuario->verPerfil($_POST['id']);

	        $reg = $query->fetch_object();

	        echo $reg->mnu_perfil;

	        break;

		case "Salir":
			session_unset();
			session_destroy();
			header("Location:../");
			break;


	}