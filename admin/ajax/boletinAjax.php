<?php
	session_start();
	
	include "../inc/boletines.php";

	$objboletin = new boletin();

	switch ($_GET["op"]) {

		case 'saveOrUpdate':
			$nroRef          = $_POST["nroRef"];
			$dateImpresion   = $_POST["dateImpresion"];
			//$imgBol          = $_POST["imgBol"];
			$pieImg          = $_POST["pieImg"];
			$indice          = $_POST["indice"];
			$datePubli       = $_POST['datePubli'];
			$dateBoletin     = $_POST['dateBoletin'];
			$asunto          = $_POST['asunto'];
			$intro           = $_POST['intro'];
			$cont            = $_POST['cont'];
			$info            = $_POST['info'];
			$nota            = $_POST['nota'];
			$tema 			 = $_POST['tema'];

			$nombre_img    = $_FILES['imgBol']['name'];
			$tipo_img      = $_FILES['imgBol']['type'];
			$tamano_img    = $_FILES['imgBol']['size'];

			$idUser = $_SESSION['idUser'];			
			
			if(empty($_POST["idBoletin"])){
				if($objboletin->Registrar($indice, $idUser, $nroRef, $dateImpresion, $datePubli, $dateBoletin, $asunto, $info, $intro, $cont, $nombre_img, $pieImg, $nota)){
					echo 0;
				}else{
					echo 1;
				}
			}else{
				$idBoletin = $_POST["idBoletin"];
				if($objboletin->Modificar($idBoletin, $indice, $idUser, $nroRef, $dateImpresion, $datePubli, $dateBoletin, $asunto, $info, $intro, $cont, $nombre_img, $pieImg, $nota)){
					echo 2;
				}else{
					echo 3;
				}
			}

		break;

		case "delete":			
			$result = $objboletin->deletBoletin();
			if ($result) {
				echo 0;
			} else {
				echo 1;
			}
			break;

		case "list":
			$query_Tipo = $objboletin->listaBoletin();
			$data = Array();
            $i = 1;
     		while ($reg = $query_Tipo->FetchRow()) {
				 $asunto = htmlentities(mb_substr($reg['asunto'], 0, 70, 'UTF-8').'...');
				if($reg['blocked'] == 0)
					$hab = '<a href="#" id="'.$reg["idBoletin"].'" onclick="block('.$reg["idBoletin"].', 0)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>';
				else
					$hab = '<a href="#" id="'.$reg["idBoletin"].'" onclick="block('.$reg["idBoletin"].', '.$reg["blocked"].')"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>';
     			$data[] = array(
     				"0"=>$i,
                    "1"=>$reg['idBoletin'],
                    "2"=>$asunto,                    
					"3"=>htmlentities($reg['indice']),
					"4"=>htmlentities($reg['tema']),
					"5"=>$reg['fecha_creacion'],
					"6"=>$reg['fecha_publicacion'],
					"7"=>$reg['visita'],
					"8"=>$hab,
                    "9"=>'<button class="btn btn-warning btn-sm mr-1 mb-1" data-toggle="tooltip" title="Editar" onclick="cargaDataBoletin('.$reg['idBoletin'].')"><i class="fas fa-pencil-alt"></i> </button>&nbsp;'.
					'<button class="btn btn-danger btn-sm mr-1 mb-1" data-toggle="tooltip" title="Eliminar" onclick="deletBoletin('.$reg['idBoletin'].')"><i class="fas fa-trash"></i> </button>');
                $i++;
			}			
            $results = array(
            "sEcho" => 1,
        	"iTotalRecords" => count($data),
        	"iTotalDisplayRecords" => count($data),
			"aaData"=>$data);			
			echo json_encode($results);

			break;

		case "block":
			$id = $_SESSION['idUser'];
			$idBol = $_POST['idBol'];
			$val = $_POST['val'];
			if($val == 0)
				$query = $objboletin->block($idBol, $id);
			else
				$query = $objboletin->block($idBol, 0);

			if($query)
				echo 1;
			else
				echo 0;

			break;
	

		case "editBoletin":
			$idBol = $_POST['idBoletin'];
			$query = $objboletin->editBoletin($idBol);

			$data = new stdClass();
			$c=0;
			//$data = json_encode($data);

			$reg = $query->FetchRow();				
			$data->circular    = htmlentities($reg['circular']);
			$data->datePubli   = $reg['fecha_publicacion'];
			$data->imagen      = htmlentities($reg['imagen']);
			$data->pie_imagen  = htmlentities($reg['pie_imagen']);
			$data->idIn        = ($reg['idIn']);
			$data->indice      = ($reg['indice']);
			$data->idTema[0]   = ($reg['idTema']);
			$data->tema[0]     = htmlentities('--->'.$reg['tema']);
			$data->dateCirc    = $reg['fecha_circular'];
			$data->dateCrea    = $reg['fecha_creacion'];
			$data->asunto      = ($reg['asunto']);
			$data->intro       = htmlentities($reg['introduccion']);
			$data->cont        = htmlentities($reg['contenido']);
			$data->info        = htmlentities($reg['info_adicional']);
			$data->nota        = htmlentities($reg['nota']);

			while ($reg = $query->FetchRow()) {				
				$c++;
				$data->idTema[$c] = ($reg['idTema']);				
				$data->tema[$c] = htmlentities($reg['tema']);				
			   }			
		
		   	echo json_encode($data);  
	        break;

		case "listEmpleado":
			
			$query_Tipo = $objboletin->listaEmpresa();
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

		case "listTypeIndice":

			$query_Tipo = $objboletin->listaTypeIndice();

			echo '<option value="">Seleccione</option>';
            
     		while ($reg = $query_Tipo->FetchRow()) {
				echo '<option value=' . $reg['id'] . '>' . ($reg['tipo']) . '</option>';
			}

			break;

		case "listTypeIndiceEdit":

			$idIn   = $_GET['idIn'];
			$indice = $_GET['indice'];

			$query_Tipo = $objboletin->listaTypeIndice();

			echo '<option value='.$idIn.'>'.$indice.'</option>';
			
				while ($reg = $query_Tipo->FetchRow()) {
				echo '<option value=' . $reg['id'] . '>' . ($reg['tipo']) . '</option>';
			}

			break;
		
		case "listTemas":

			$query_Tipo = $objboletin->listaTema();	
			//$c = 0;	

			$reg = $query_Tipo->FetchRow();
				echo '<div class="form-group row"><div class="col-sm-12"><div class="form-check">
					<input class="form-check-input" type="checkbox" value="'.$reg['id'].'" id="tema'.$reg['id'].'" name="tema[]" required minlength="1" data-msg-required="Elija por lo menos una opción">
					<label class="form-check-label" >
						'.($reg['tema']).'
					</label>
				</div>';
			
			while ($reg = $query_Tipo->FetchRow()) {
				$c++;
				echo '<div class="form-group row"><div class="col-sm-12"><div class="form-check">
					<input class="form-check-input" type="checkbox" value="'.$reg['id'].'" id="tema'.$reg['id'].'" name="tema[]" >
					<label class="form-check-label" >
						'.($reg['tema']).'
					</label>
				</div>';
				
			}

			break;
		
		case "listTemasCheck":

			$temas = Array();
			$temas = $_GET['temas'];

			$temas = explode(",", $temas);

			echo json_encode($temas);
						
			break;
		
		case "listCargaConcor":
			$c=0;
			$data = new stdClass();
			$query = $objboletin->listaConcor();	
			while ($reg = $query->FetchRow()) {								
				$data->idCon[] = $reg['id_concordancia'];
				$data->idCla[] = $reg['id_clase'];
				$c++;		
			}			
		
		   	echo json_encode($data);  
						
			break;
		
		case "search":			

			$query_Tipo = $objboletin->searchBol();		
			
			$idCon = $_POST['idCon'];
			$idNam = $_POST['idNam'];
			
			while ($reg = $query_Tipo->FetchRow()) {
				echo '<span id="'.$reg['idBoletin'].'" class="badge bg-warning"><a href="#" onclick="addIdBoletin('.$reg['idBoletin'].',&#39;'.$idNam.'&#39;,'.$idCon.')">'.utf8_encode($reg['idBoletin']).'</a></span>';
			}

			break;

	    case "ingresarSistema":

	    	$data = stripslashes($_POST['res']);

	    	$data = json_decode($data);

	    	$user = $data->userName;
			$pass = $data->password;

			$query = $objboletin->Ingresar_Sistema($user, md5($pass));
			$array = $query->FetchRow();

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

	        $query = $objboletin->verPerfil($_POST['id']);

	        $reg = $query->fetch_object();

	        echo $reg->mnu_perfil;

	        break;

		case "Salir":
			session_unset();
			session_destroy();
			header("Location:../");
			break;


	}
