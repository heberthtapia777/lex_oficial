<?php

    include(dirname(__FILE__).'/../adodb5/adodb.inc.php');

	/*$pwd   = urlencode('Gzk^ubibP.ZZ');
	//$flags =  MYSQL_CLIENT_COMPRESS;
	$dsn   = "mysqli://sstei207_lex:$pwd@gator4166.hostgator.com/sstei207_lex?persist";
	$db    = ADONewConnection($dsn);  # no need for PConnect()
	if (!$db) die("Conexion incorrecta");*/

	/*$pwd    = urlencode('=CnUf1sJ(LgW');
    //$flags =  MYSQL_CLIENT_COMPRESS;
	$dsn   = "mysqli://radiomo3_lex:$pwd@localhost/radiomo3_lex?persist";
	$db    = ADONewConnection($dsn);  # no need for PConnect()
	if (!$db) die("Conexion incorrecta");*/

	$pwd   = urlencode('mysql');
	//$flags =  MYSQL_CLIENT_COMPRESS;
	$dsn   = "mysqli://root:$pwd@localhost/bd_lex?persist";
	$db    = ADONewConnection($dsn);  # no need for PConnect()
	$db->setCharset('utf8');
	if (!$db) die("Conexion incorrecta");
?>
