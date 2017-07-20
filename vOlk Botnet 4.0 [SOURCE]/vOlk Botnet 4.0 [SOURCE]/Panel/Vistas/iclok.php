<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<table cellspacing="0" cellpadding="0" border="0" width="138" height="50px">
<tr>
	<td width="62"  title="Fecha del Servidor"><img border="0" src="archivos/b-time.png" width="62" height="58"></td>
	<td width="76"  id='time' title="Fecha del Servidor"></td>
</tr>
</table>

<script type="text/javascript" src="archivos/js/ajax.js"></script>

<script type="text/javascript">
function setTime (time) {
	year = time.substr(0, 4);
	month = time.substr(4, 2);
	day = time.substr(6, 2);
	hour = time.substr(8, 2);
	min = time.substr(10, 2);
	sec = time.substr(12, 2);
	am = time.substr(14, 2);
	
	el = document.getElementById('time');
	val = '<b><font color="#999999" style="font-size: 11px;">';
	val += '<center>';
	val += '<b>' + year +'/' + month + '/' + day + '<br>' + hour + ':' + min + ':' + sec + ' ' + am + '</b>';
	val += '</center>';
	val += '</font></b>';
	el.innerHTML = val;
}
function setTimeAjax () {
	ajax_load('Controladores/datetime.php', ':restofunc:', setTime);
<?php
		echo "	setTimeout(setTimeAjax, 1000);\n";

?>

}
setTimeAjax();
</script>