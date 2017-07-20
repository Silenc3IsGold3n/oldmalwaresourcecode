<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<?php
require_once('../includes.php');

if( isset($_GET['https']) && !empty($_GET['https']) && isset($_GET['ExecuteHttp']) && !empty($_GET['ExecuteHttp']) ){

	$Datos = array ('http' => $_GET['https'], 'Execute' => $_GET['ExecuteHttp'] );
	$UpdateBuscar = array('id' => 1) ;
	$Result = $DB->Update('http' , false , $Datos , $UpdateBuscar) ;
	echo $Result['msg'] ;


}

?>