<?php
	include "../inc/client.php";

	$objclient = new cliente();

	switch ($_GET["op"]) {

		case 'saveOrUpdate':

			$id			= $_POST["client_id"];
			$empresa	= $_POST["client_emp"];
			$nit		= $_POST["client_nit"];
			$date		= $_POST["client_date"];
			$email		= $_POST['client_email'];
			$fono		= $_POST['client_fono'];
			$fax		= $_POST['client_fax'];
			$address	= $_POST['client_address'];
			$city		= $_POST['client_city'];
			$sus		= $_POST['client_sus'];
			$plan		= $_POST['client_plan'];
			$lic		= $_POST['client_lic'];
			$hab		= $_POST['client_hab'];

				if(empty($_POST["client_id"])){

					if($objclient->Registrar($empresa, $nit, $date, $email, $fono, $fax, $address, $city, $sus, $plan, $lic, $hab)){
						echo 0;
					}else{
						echo 1;
					}
				}else{

					$id = $_POST["client_id"];
					if($objclient->Modificar($id, $empresa, $nit, $date, $email, $fono, $fax, $address, $city, $sus, $plan, $lic, $hab)){
						echo 2;
					}else{
						echo 3;
					}
				}

			break;

		case "delete":

			$id = $_POST["id"];
			$result = $objclient->Eliminar($id);
			if ($result) {
				echo 0;
			} else {
				echo 1;
			}
			break;

		case "list":
			$query_Tipo = $objclient->Listar();
			$data = Array();
            $i = 1;
     		while ($reg = $query_Tipo->FetchRow()) {
				if($reg['block'] == 1)
					$status = '<a href="#" id="'.$reg["id"].'" onclick="status('.$reg["id"].', 0)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>';
				else
					$status = '<a href="#" id="'.$reg["id"].'" onclick="status('.$reg["id"].', 1)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>';
     			$data[] = array(
     				"0"=>$i,
                    "1"=>utf8_encode($reg['empresa']),
                    "2"=>utf8_encode($reg['nit']),
                    "3"=>utf8_encode($reg['suscripcion']),
					"4"=>utf8_encode($reg['plan']),
					"5"=>utf8_encode($reg['licencias']),
					"6"=>$status,
					"7"=>utf8_encode($reg['cf_created']),
					"8"=>utf8_encode($reg['cf_modified']),
                    "9"=>'<button class="btn btn-warning btn-sm mr-1 mb-1" data-toggle="tooltip" title="Editar" onclick="cargaData('.$reg['id'].')"><i class="fas fa-pencil-alt"></i> </button>&nbsp;'.
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

			$query = $objclient->status($id, $val);

			if($query)
				echo 1;
			else
				echo 0;

			break;

		case "listTypePlan":

			$query_Tipo = $objclient->listaTypePlan();

			echo '<option value="">Seleccione</option>';

     		while ($reg = $query_Tipo->FetchRow()) {
				echo '<option value=' . $reg['id'] . '>' . ($reg['licencia']) . '</option>';
			}

			break;

		case "edit":
			$id		 = $_POST['id'];
			$query 	 = $objclient->edit($id);

			$data = new stdClass();

			$reg = $query->FetchRow();

			$data->client_emp		=$reg['empresa'];
			$data->client_nit		=$reg['nit'];
			$data->client_email		=$reg['email'];
			$data->client_fono		=$reg['telefono'];
			$data->client_fax		=$reg['fax'];
			$data->client_address	=$reg['direccion'];
			$data->client_city		=$reg['ciudad'];
			$data->client_sus		=$reg['suscripcion'];
			$data->client_plan		=$reg['plan'];
			$data->client_lic		=$reg['licencias'];

		   	echo json_encode($data);
	        break;

		case "listTypeUser":

			$query_Tipo = $objclient->listaTypeUser();

			echo '<option value="">Seleccione</option>';

     		while ($reg = $query_Tipo->FetchRow()) {
				echo '<option value=' . $reg['id'] . '>' . $reg['title'] . '</option>';
			}

			break;

		case "Salir":
			session_unset();
			session_destroy();
			header("Location:../");
			break;


	}
