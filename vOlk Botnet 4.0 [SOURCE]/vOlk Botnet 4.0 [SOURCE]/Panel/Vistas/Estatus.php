<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Language" content="es-pe">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>[vOlk-Botnet]v3.0</title>
<script type="text/javascript" src="../archivos/js/jquery.js"></script>
<script type="text/javascript" src="../archivos/js/funciones.js"></script>
<script type="text/javascript" src="../archivos/js/ajax.js"></script>
<body background="../archivos/images/sq.jpg">

<h2><font face="Tahoma" size="4" color="#666666"><b>Statistics bots</b>
</font></h2>
<div id="form_select_pais" name="form_select_pais" >
<?php require_once('SelectPais.php') ; ?>
</div>

<div id="table_estadisticas" name="table_estadisticas" >

<div id='mensajebot' name='mensajebot' align='center' style="color:#FF0000"></div>
<p align="center">&nbsp;</p>