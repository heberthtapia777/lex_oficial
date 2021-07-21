<?php
	session_start();
	
	include "../inc/tema.php";

	$objTema = new tema();

	switch ($_GET["op"]) {

		case 'saveOrUpdate':	
			$tema_id			= $_POST['tema_id'];		
			$tema_title  		= $_POST['tema_title'];
			
			$idUser = $_SESSION['idUser'];
			
			
			if(empty($_POST["tema_id"])){
				if($objTema->Registrar($tema_title, $idUser)){
					echo 0;
				}else{
					echo 1;
				}
			}else{				
				if($objTema->Modificar($tema_id, $tema_title, $idUser)){
					echo 2;
				}else{
					echo 3;
				}
			}

		break;

		case "delete":			
			$result = $objTema->delet();
			if ($result) {
				echo 0;
			} else {
				echo 1;
			}
			break;

		case "list":
			$query_tema = $objTema->list();
			$data = Array();
            $i = 1;
     		while ($reg = $query_tema->FetchRow()) {			

     			$data[] = array(
     				"0"=>$i,
                    "1"=>($reg['tema']),
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
			
			$query = $objTema->status($id, $val);
			
			if($query)
				echo 1;
			else
				echo 0;

			break;
	

		case "edit":
			$id		 = $_POST['id'];
			$query 	 = $objTema->edit($id);

			$data = new stdClass();

			$reg = $query->FetchRow();				
			$data->tema_title   	= $reg['tema'];
		
		   	echo json_encode($data);  
	        break;		

		case "Salir":
			session_unset();
			session_destroy();
			header("Location:../");
			break;


	}
