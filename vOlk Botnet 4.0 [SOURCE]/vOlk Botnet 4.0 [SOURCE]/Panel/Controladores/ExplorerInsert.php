<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<?php
require_once('../includes.php');

if( isset($_GET['domin']) && !empty($_GET['domin']) ){

	$Datos = array ('Urls' => $_GET['domin'] );
	$UpdateBuscar = array('id' => 1) ;
	$Result = $DB->Update('urls' , false , $Datos , $UpdateBuscar) ;
	echo $Result['msg'] ;


}

?>