<?php
    include '../admin/inc/conexion.php';
    $id = $_POST['id'];

    $sql = "SELECT * FROM tema WHERE id_padre = $id";
	$query = $db->Execute($sql);
    $html = "";
    while ($reg = $query->FetchNextObj()) {
		$html .= "<option value='".$reg->id."'>".htmlentities($reg->tema)."</option>";
    }

    echo $html;
?>
