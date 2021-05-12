<?php
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'boletin';

// Table's primary key
$primaryKey = 'idBoletin';

/*$sql = "SELECT b.boletin, b.asunto, tp.tipo AS indice, GROUP_CONCAT(t.tema) AS tema, b.fecha_creacion, b.fecha_publicacion, b.visita, b.blocked
			FROM boletin AS b LEFT JOIN boletin_rel_tema AS rt ON b.boletin = rt.boletin LEFT JOIN tema AS t ON rt.id_tema = t.id
			LEFT JOIN tipo AS tp ON tp.id = b.id_tipo
			GROUP BY b.boletin
			ORDER BY b.boletin DESC ";
*/
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
	array( 'db' => 'idBoletin',  'dt' => 0 ),
	array( 'db' => 'idBoletin',  'dt' => 1 ),
	array(
		'db' => 'asunto',
		'dt' => 2,
		'formatter' => function( $d, $row ) {
			$d = (mb_substr($d, 0, 70, 'UTF-8').'...');
			return htmlentities($d);
		}
	),
	array(
		'db' => 'tipo',
		'dt' => 3,
		'field' => 'tipo', 'as' => 'indice',
		'formatter' => function( $d, $row ) {
			return htmlentities($d);
		}
	),
	array( 'db' => 'GROUP_CONCAT(`tema`)',
		   'dt' => 4,
		   'field' => 'GROUP_CONCAT(`tema`)', 'as' => 'tema',
		   'formatter' => function( $d, $row ) {
			return htmlentities($d);
		}

	),
	array( 'db' => 'fecha_creacion',  'dt' => 5 ),
	array( 'db' => 'fecha_publicacion',  'dt' => 6 ),
	array( 'db' => 'visita',  'dt' => 7 ),
	array( 'db' => 'blocked',
		   'dt' => 8,
		   'formatter' => function( $d, $row ) {
				if($d == 0)
					$hab = '<a href="#" onclick="block(\''.$row[0].'\', 0)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>';
				else
					$hab = '<a href="#" onclick="block(\''.$row[0].'\', \''.$d.'\')"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>';
				return $hab;
			}
	),
	array( 'db' => 'idBoletin',
		   'dt' => 9,
		   'formatter' => function( $d, $row ) {
				$ac = '<button class="btn btn-warning btn-sm mr-1 mb-1" data-toggle="tooltip" title="Editar" onclick="cargaDataBoletin('.$d.')"><i class="fas fa-pencil-alt"></i> </button>&nbsp;'.
			'<button class="btn btn-danger btn-sm mr-1 mb-1" data-toggle="tooltip" title="Eliminar" onclick="deletBoletin('.$d.')"><i class="fas fa-trash"></i> </button>';
				return $ac;
			}
	)
	/*array(
		'db' => 'GROUP_CONCAT(tema) AS tema',
		'dt' => 3,
		//'field' => 'GROUP_CONCAT(tema)', 'as' => 'tema',
		/*'formatter' => function( $d, $row ) {
			$d = utf8_encode($d);
			return ($d.$d);
		}
	 )*/

	//array( 'db' => 'circular',     'dt' => 3 )
	/*array(
		'db'        => 'circular',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return utf8_encode($d);
		}
	)*/
	/*array(
		'db'        => 'direccion_provincia',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return '$'.number_format($d);
		}
	)*/
);

// SQL server connection information
/*$sql_details = array(
	'user' => 'root',
	'pass' => 'mysql',
	'db'   => 'bd_lex',
	'host' => 'localhost'
);*/

$sql_details = array(
	'user' => 'sstei207_lex',
	'pass' => 'Gzk^ubibP.ZZ',
	'db'   => 'sstei207_lex',
	'host' => 'gator4166.hostgator.com'
);

/*$sql_details = array(
	'user' => 'bd_lex',
	'pass' => '.#7)31Q_deI0',
	'db'   => 'bd_lex',
	'host' => 'localhost'
);*/


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

include ( 'ssp.class.php' );

/*$whereCustom = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $whereCustom )
);*/

// Validate the JSONP to make use it is an okay Javascript function to execute
$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
    $_GET['callback'] :
    false;

if ( $jsonp ) {
    echo $jsonp.'('.json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
    ).');';
}


