<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<?php
require_once('../includes.php');

if( isset($_GET['ExecuteHttp2']) && !empty($_GET['ExecuteHttp2']) ){

	$Datos = array ('Urls2' => $_GET['ExecuteHttp2'] );
	$UpdateBuscar = array('id' => 1) ;
	$Result = $DB->Update('urls' , false , $Datos , $UpdateBuscar) ;
	echo $Result['msg'] ;


}

?>