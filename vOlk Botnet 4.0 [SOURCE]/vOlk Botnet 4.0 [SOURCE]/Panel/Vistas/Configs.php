<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<?php 
require_once('../Class/class.base.de.datos.php');
require_once('../Configs/Configs.php');
require_once("../Configs/Pass.php");


?>

<h2>&nbsp;
<img border="0" src="archivos/imagen/4_12.jpg" width="264" height="46" style="border: 1px solid #FFFFFF"></h2>
<div id='mensajebot' name='mensajebot' align='center' face="Verdana" size="1" style="color:#FF0000"></div>
<form id='frm_findinfo'>

<div  align="center">

<table width="88%" height="98" background="archivos/bg.gif" style="border:1px solid #666666;">




<tr>
	<td width='30%' height="21" align='left' bgcolor="#333333">
	<font face="Verdana" size="1" color="#FFFFFF">User Administrator  :</font></td>
	<td align='left' width="70%" bgcolor="#333333"><div>
<span style="margin-left:0px" name="div_1_mensaje" id="div_1_mensaje">
<font size="1" face="Verdana">
<input type="text" style="border:1px solid #FFFFFF; width: 300px; font-family:Verdana; font-size:8pt; color:#666666; background-color:#000000" value="<?php echo ADMIN_USUARIO ; ?>" disabled="disabled" name="User" id="User" size="1" />
</font></span>
</div></td>
</tr>



<tr>
	<td width='30%' height="21" align='left' bgcolor="#333333"><font face="Verdana" size="1" color="#FFFFFF">Password Administrator :</font></td>
	<td align='left' width="70%" bgcolor="#333333">
<span style="margin-left:0px" name="div_segundos" id="div_segundos">
<font size="1" face="Verdana">
<input name="Pasw" id="Pasw" type="text" style="border:1px solid #FFFFFF; width: 300px; font-family:Verdana; font-size:8pt; color:#666666; background-color:#000000" value="<?php echo ADMIN_PASSWORD ; ?>" size="70" /></font></span></td>
</tr>

   

<tr>
	<td width='30%' align='left' height="46">&nbsp;</td>
	<td align='left' width="70%" height="46"><div>
<span style="margin-left:0px" name="div_segundos" id="div_segundos">
<font size="1" face="Verdana">
&nbsp;</font></span></div><font size="1" face="Verdana">
    <input type="button" value='Saved Settings' onclick="SaveUser();" style="font-family: Verdana; font-size: 8pt; color: #666666; border: 1px solid #FFFFFF; background-color: #000000" >
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font></td>
</tr>
</table>

</form>



<div id='mensajebot' name='mensajebot' align='center' style="color:#FF0000"></div>