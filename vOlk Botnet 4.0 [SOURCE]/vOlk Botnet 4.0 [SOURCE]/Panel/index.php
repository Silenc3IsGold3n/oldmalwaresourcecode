<?php
@session_start();
if( file_exists("install.php") ){
	header("Location: install.php"); 
	exit();
}
if ( !isset($_SESSION['login']) ){
	require_once("login.php");
} else {
	require_once("bot.php");
}
?>
