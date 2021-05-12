<?php

	require_once "model/resbusqueda.php";

	$objBusqueda = new resBusqueda();

	switch ($_GET["op"]) {

		case "listBusquedaNum":

               $data = stripslashes($_POST['res']);
	    	     $data = json_decode($data);
			$queryBus = $objBusqueda->listaBusquedaNum($data->text);
               $data = Array();
               $i = 1;

			while ($reg = $queryBus->FetchNextObj()) {
				$data[] = array(
                    "0"=>$i,
                    "1"=>$reg->idBoletin,
                    "2"=>htmlentities($reg->asunto),
                    "3"=>$reg->tipo,
                    "4"=>htmlentities($reg->tema),
                    "5"=>$reg->fecha_creacion,
                    "6"=>$reg->fecha_publicacion,
                    "7"=>'<button class="btn btn-default btn-sm" data-toggle="tooltip" title="Detalle" onclick="verDetalle('.$reg->idBoletin.')"><i class="fas fa-clipboard-check"></i> Detalle </button>'
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



	}

?>
