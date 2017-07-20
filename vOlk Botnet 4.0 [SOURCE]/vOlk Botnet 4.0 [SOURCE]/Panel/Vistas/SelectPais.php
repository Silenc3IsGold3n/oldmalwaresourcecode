<?php
@session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	
require_once('../Class/class.base.de.datos.php');
require_once('../Configs/Configs.php');
$Pais = $DB->Select("SELECT DISTINCT pais FROM zombis WHERE pais!=''");

for($i=0; $i<count($Pais); $i++){
	$Paises .= '<option value="'.$Pais[$i]['pais'].'">'.$Pais[$i]['pais'].'</option>' ;
}


$Vacio = $DB->Select("SELECT * FROM zombis WHERE pais IS NULL");
if( count($Vacio) > 0 ){
	$Paises .= '<option value="Unknown">Unknown</option>' ;
}




?>

<form method="POST" action="" style="margin-top:10px;">
<select name="pais" id="pais" face="Fixedsys" style="font-family: Tahoma; font-size: 8pt; color: #666666; border: 1px solid #000000; background-color: #000000" size="1">
  <option selected="selected" value="cero">Seleccione un Pais</option>
  <?php echo $Paises ; ?>
  <option value="alls">Todos los Paises</option>
</select>
&nbsp;&nbsp;
<input type="button" value="Whoi's Bots" name="md5" style="font-family: Tahoma; font-size: 8pt; border: 1px solid #333333; ; color:#666666; background-color:#000000" onClick="Paises();">
</form>


