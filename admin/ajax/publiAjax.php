<?php
	session_start();

	include "../inc/publicacion.php";

	$objPublicacion = new publicacion();

	switch ($_GET["op"]) {

		case 'saveOrUpdate':
			$publi_id		= $_POST['publi_id'];
			$publi_title  	= $_POST['publi_title'];
			$publi_resume   = $_POST['publi_resume'];
			$publi_contens  = $_POST['publi_contens'];
			$publi_autor	= $_POST['publi_autor'];

			$idUser = $_SESSION['idUser'];

			$character  = array("&#8216;","&#8217;","'");
			$change		= array("‘","’","&#39;");
			$publi_resume = str_replace($character, $change, $publi_resume);
			$publi_contens = str_replace($character, $change, $publi_contens);

			if(empty($_POST['publi_id'])){
				if($objPublicacion->Registrar($publi_title, $publi_resume, $publi_contens, $publi_autor, $idUser)){
					echo 0;
				}else{
					echo 1;
				}
			}else{
				if($objPublicacion->Modificar($publi_id, $publi_title, $publi_resume, $publi_contens, $publi_autor, $idUser)){
					echo 2;
				}else{
					echo 3;
				}
			}

		break;

		case "delete":
			$result = $objPublicacion->delet();
			if ($result) {
				echo 0;
			} else {
				echo 1;
			}
			break;

		case "list":
			$query_Tipo = $objPublicacion->list();
			$data = Array();
            $i = 1;
     		while ($reg = $query_Tipo->FetchRow()) {
				 $resumen = (mb_substr($reg['resumen'], 0, 70, 'UTF-8').'...');
				if($reg['status'] == 1)
					$status = '<a href="#" id="'.$reg["id"].'" onclick="status('.$reg["id"].', 0)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>';
				else
					$status = '<a href="#" id="'.$reg["id"].'" onclick="status('.$reg["id"].', 1)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>';

				$img = '<a href="img/'.$reg['imagen'].'" data-lightbox="image-'.$reg["id"].'" ><img class="img-fluid rounded" src="img/'.$reg['imagen'].'" alt="" width="100" /></a>';

     			$data[] = array(
     				"0"=>$i,
                    "1"=>$reg['titulo'],
                    "2"=>$resumen,
					"3"=>$reg['autor'],
					"4"=>$img,
					"5"=>$status,
                    "6"=>'<button class="btn btn-warning btn-sm mr-1 mb-1" data-toggle="tooltip" title="Editar" onclick="cargaData('.$reg['id'].')"><i class="fas fa-pencil-alt"></i> </button>&nbsp;'.
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

			$query = $objPublicacion->status($id, $val);

			if($query)
				echo 1;
			else
				echo 0;

			break;


		case "edit":
			$id		 = $_POST['id'];
			$query 	 = $objPublicacion->edit($id);

			$data = new stdClass();

			$reg = $query->FetchRow();
			$data->publi_title   = $reg['titulo'];
			$data->publi_resume  = $reg['resumen'];
			$data->publi_contens = $reg['contenido'];
			$data->publi_img	 = $reg['imagen'];
			$data->publi_file    = $reg['archivo'];
			$data->publi_autor   = $reg['autor'];

		   	echo json_encode($data);
	        break;

		case "Salir":
			session_unset();
			session_destroy();
			header("Location:../");
			break;


	}
