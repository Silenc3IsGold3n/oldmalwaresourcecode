<?php @session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }	?>
<?php

if( isset($_GET['User']) && !empty($_GET['User']) && isset($_GET['Pasw']) && !empty($_GET['Pasw']) ){
require_once('../includes.php');

	
                require_once("../Configs/Pass.php"); 
				$User = $_GET['User'] ;
                $Pasw = $_GET['Pasw'] ;
				if($User == $Pasw) {
				echo "The User Name can not be equal to the Password ";
				} else {
				$Pass = @file_get_contents("../Configs/Pass.php");
				$Pass = str_replace(ADMIN_USUARIO, $_GET['User'] , $Pass);
				$Pass = str_replace(ADMIN_PASSWORD, $_GET['Pasw'] , $Pass);
				$O = @fopen("../Configs/Pass.php" , "w+");
				@fwrite($O , $Pass);
				@fclose($O);
				$Result2 = "Data Updated Successfully!";
				echo $Result2 ;
}
}

?>