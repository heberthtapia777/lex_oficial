<?php
	include "../inc/users.php";

	$objusuario = new usuario();

	switch ($_GET["op"]) {

		case 'SaveOrUpdate':

			$usersId	= $_POST["txtIdUsuario"];
			$empresaId	= $_POST["txtIdEmpresa"];
			$empresa	= $_POST["txtEmpresa"];
			$usuario 	= $_POST["txtUsuario"];
			$typeUser	= $_POST["cboTypeUser"];
			$email		= $_POST['txtEmail'];
			$nameUsers	= $_POST['txtUser'];
			$password	= $_POST['txtPassword'];

				if(empty($_POST["txtIdUsuario"])){

					if($objusuario->Registrar($empresaId, $empresa, $usuario, $typeUser, $email, $nameUsers, $password)){
						echo 0;
					}else{
						echo 1;
					}
				}else{

					$idusuario = $_POST["txtIdUsuario"];
					if($objusuario->Modificar($usersId, $empresaId, $empresa, $usuario,	$typeUser, $email, $nameUsers, $password)){
						echo 2;
					}else{
						echo 3;
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
					$status = '<a href="#" id="'.$reg["id"].'" onclick="status('.$reg["id"].', 1)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>';
				else
					$status = '<a href="#" id="'.$reg["id"].'" onclick="status('.$reg["id"].', 0)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>';
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

		case "edit":
			$id		 = $_POST['id'];
			$query 	 = $objusuario->edit($id);

			$data = new stdClass();

			$reg = $query->FetchRow();

            $data->idEmp	= $reg['idEmp'];
            $data->empresa	= $reg['empresa'];
            $data->name		= $reg['name'];
            $data->title	= $reg['title'];
            $data->email	= $reg['email'];
            $data->username	= $reg['username'];

		   	echo json_encode($data);
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

		case "verPerfil":
	        require_once "../model/usuario.php";

	        $objCategoria = new usuario();

	        $query = $objusuario->verPerfil($_POST['id']);

	        $reg = $query->fetch_object();

	        echo $reg->mnu_perfil;

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

		case "Salir":
			session_unset();
			session_destroy();
			header("Location:../");
			break;


	}
