<?php
	session_start();

	include "../inc/indice.php";

	$objIndice = new indice();

	switch ($_GET["op"]) {

		case 'saveOrUpdate':
			$indice_id			= $_POST['indice_id'];
			$indice_title  		= $_POST['indice_title'];

			$idUser = $_SESSION['idUser'];

			if(empty($_POST["indice_id"])){
				if($objIndice->Registrar($indice_title, $idUser)){
					echo 0;
				}else{
					echo 1;
				}
			}else{
				if($objIndice->Modificar($indice_id, $indice_title, $idUser)){
					echo 2;
				}else{
					echo 3;
				}
			}

		break;

		case "delete":
			$result = $objIndice->delet();
			if ($result) {
				echo 0;
			} else {
				echo 1;
			}
			break;

		case "list":
			$query_Tipo = $objIndice->list();
			$data = Array();
            $i = 1;
     		while ($reg = $query_Tipo->FetchRow()) {

     			$data[] = array(
     				"0"=>$i,
                    "1"=>($reg['tipo']),
                    "2"=>'<button class="btn btn-warning btn-sm mr-1 mb-1" data-toggle="tooltip" title="Editar" onclick="cargaData('.$reg['id'].')"><i class="fas fa-pencil-alt"></i> </button>&nbsp;'.
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

			$query = $objIndice->status($id, $val);

			if($query)
				echo 1;
			else
				echo 0;

			break;


		case "edit":
			$id		 = $_POST['id'];
			$query 	 = $objIndice->edit($id);

			$data = new stdClass();

			$reg = $query->FetchRow();
			$data->indice_title   	= $reg['tipo'];

		   	echo json_encode($data);
	        break;

		case "Salir":
			session_unset();
			session_destroy();
			header("Location:../");
			break;


	}
