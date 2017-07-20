<?php
@session_start();
if( isset($_POST['ratero']) && !empty($_POST['ratero']) && isset($_POST['clave']) && !empty($_POST['clave']) ){
	require_once("Configs/Pass.php");
	if( ADMIN_USUARIO == $_POST['ratero'] ){
		if( ADMIN_PASSWORD == $_POST['clave'] ){
			$_SESSION['login'] = true ;
			header ("Location: ./");
			exit();
		}
	}
}
?>

<title>[vOlk-Botnet]v 4.0 Login</title>
<style>
body { background-color:#303030; }
#chau {
background-color:transparent;
border-width:0;
cursor:pointer;
display:block;
height:0px;
}
</style>
<body background="archivos/imagen/bg.gif">

<div align="center" style="margin-top:100px;">
<img src="archivos/imagen/logo.jpg" width="336" height="85" />
<br>
<table align="center"  width="138" border="0">
	<tr>
		<td  width="132" align="center">
		<form action="" method=post>
			<img src="archivos/imagen/user.png" style="margin-bottom:3px;"/><br />
			<input type="text" name="ratero" style="background-image:url(archivos/imagen/input.png); width:121px; height:23px; border:none; color:#FFF; text-align:center; font-family:verdana;"/><p>
			<img src="archivos/imagen/pass.png" style="margin-bottom:3px;"/><br />
			<input type="password" name="clave" style="background-image:url(archivos/imagen/input.png); width:121px; height:23px; border:none; color:#FFF; text-align:center;"/><br />
			<input type="submit" value="" name="boton" id="chau">
		</form></td>
	</tr>
</table>
</div>
<p><font color="#FFFFFF" size="1" face="Tahoma">vOlk-Botnet 4.0</font></p>
