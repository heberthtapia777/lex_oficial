<?php
	session_start();
	
	include "../inc/comunicado.php";

	$objComunicado = new comunicado();

	switch ($_GET["op"]) {

		case 'saveOrUpdate':	
			$com_id			= $_POST['com_id'];		
			$com_title  	= $_POST['com_title'];
			$com_resume   	= $_POST['com_resume'];
			$com_contens  	= $_POST['com_contens'];
			$com_autor		= $_POST['com_autor'];			

			$idUser = $_SESSION['idUser'];

			$character  = array("&#8216;","&#8217;","'");
			$change		= array("‘","’","&#39;");
			$com_resume = str_replace($character, $change, $com_resume);
			$com_contens = str_replace($character, $change, $com_contens);			
			
			if(empty($_POST['com_id'])){
				if($objComunicado->Registrar($com_title, $com_resume, $com_contens, $com_autor, $idUser)){
					echo 0;
				}else{
					echo 1;
				}
			}else{				
				if($objComunicado->Modificar($com_id, $com_title, $com_resume, $com_contens, $com_autor, $idUser)){
					echo 2;
				}else{
					echo 3;
				}
			}

		break;

		case "delete":			
			$result = $objComunicado->delet();
			if ($result) {
				echo 0;
			} else {
				echo 1;
			}
			break;

		case "list":
			$query_Tipo = $objComunicado->list();
			$data = Array();
            $i = 1;
     		while ($reg = $query_Tipo->FetchRow()) {
				 $resumen = (mb_substr($reg['resumen'], 0, 70, 'UTF-8').'...');
				if($reg['status'] == 1)
					$status = '<a href="#" id="'.$reg["id"].'" onclick="status('.$reg["id"].', 1)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>';
				else
					$status = '<a href="#" id="'.$reg["id"].'" onclick="status('.$reg["id"].', 0)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>';

				$img = '<a href="img/'.$reg['imagen'].'" data-lightbox="image-'.$reg["id"].'" ><img class="img-fluid rounded" src="img/'.$reg['imagen'].'" alt="" width="100" /></a>';

     			$data[] = array(
     				"0"=>$i,
                    "1"=>$reg['titulo'],
                    "2"=>$resumen,
					"3"=>$img,					
					"4"=>$status,
                    "5"=>'<button class="btn btn-warning btn-sm mr-1 mb-1" data-toggle="tooltip" title="Editar" onclick="cargaData('.$reg['id'].')"><i class="fas fa-pencil-alt"></i> </button>&nbsp;'.
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
			
			$query = $objComunicado->status($id, $val);
			
			if($query)
				echo 1;
			else
				echo 0;

			break;
	

		case "edit":
			$id		 = $_POST['id'];
			$query 	 = $objComunicado->edit($id);

			$data = new stdClass();

			$reg = $query->FetchRow();				
			$data->com_title   = $reg['titulo'];
			$data->com_resume  = $reg['resumen'];
			$data->com_contens = $reg['contenido'];
			$data->com_img	   = $reg['imagen'];
			$data->com_file    = $reg['archivo'];
			$data->com_autor   = $reg['autor'];
		
		   	echo json_encode($data);  
	        break;		

		case "Salir":
			session_unset();
			session_destroy();
			header("Location:../");
			break;


	}
