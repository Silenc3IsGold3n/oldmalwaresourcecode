<?php

class BaseDeDatos {
	private $Datos ;

	/*
	* Esta funcion constructora genera la conexion ala base de datos ,
	* se le pasan los parametros en un array y una cadena seleccionando ,
	* el tipo de base de datos que es.
	* para MYSQL , los datos que se pasan son :
	$datos = array(
	'server' => 'localhost' ,
	'user' => 'usuario' ,
	'pass' => 'contraseña' ,
	'db' => 'base de datos'
	) ;
	* y tambien se pasa el tipo de base de datos , para MYSQL  es 'mysql' .
	* Para SQLITE , se pasa el nombre de la base de datos en un array  de la sig manera :
	$datos = array(
	'db' => 'base de datos'
	) ;
	* Ahora para decir que la base de datos es SQLITE ,  en el parametro de
	* seleccion de base de datos es 'sqlite' -
	*/
	public function __construct($Datos , $DbType='mysql'){
		$this->Resultado['msg'] = '' ;
		$this->Resultado['bandera'] = true ;
		$Msj = '' ;
		$this->DbType = $DbType ;

		if($this->DbType == 'mysql'){
			if( isset($Datos['server']) ){
				$this->Server = $Datos['server'] ;
			} else {
				$Msj .= 'Falta Server<br />' ;
				$this->Resultado['bandera'] = false ;
			}
			if( isset($Datos['user']) ){
				$this->User = $Datos['user'] ;
			} else {
				$Msj .= 'Falta Usuario<br />' ;
				$this->Resultado['bandera'] = false ;
			}
			if( isset($Datos['pass']) ){
				$this->Pass = $Datos['pass'] ;
			} else {
				$Msj .= 'Falta Password<br />' ;
				$this->Resultado['bandera'] = false ;
			}
			if( isset($Datos['db']) ){
				$this->Db = $Datos['db'] ;
			} else {
				$Msj .= 'Falta Base de datos<br />' ;
				$this->Resultado['bandera'] = false ;
			}
			if($this->Resultado['bandera']){
				@mysql_connect ($this->Server , $this->User , $this->Pass) or die ("No se puede conectar con la base de datos");
				@mysql_select_db($this->Db) or die ("No Existe la Base de datos " . $this->Db);
				@mysql_query("SET NAMES 'utf8'");
			}
		}

		if($this->DbType == 'sqlite'){
			if( isset($Datos['db']) ){
				$this->DbSqlite = $Datos['db'] ;
			} else {
				$Msj .= 'Falta Base de datos' ;
				$this->Resultado['bandera'] = false ;
			}
			if($this->Resultado['bandera']){
				$this->SqliteDB = sqlite_open($this->DbSqlite);
				if( ! $this->SqliteDB){
					$Msj .= 'Error al conectar base de datos sqlite' ;
					$this->Resultado['bandera'] = false ;
				}
			}
		}

		if($this->DbType != 'sqlite' && $this->DbType != 'mysql'){
			die('Escoje el tipo de base de datos a usar') ;
		}

		if( ! $this->Resultado['bandera']){
			die($Msj)  ;
		}
		$this->Resultado['msg'] = $Msj ;
		return $this->Resultado ;
	}




	/*
	* Metodo AntiHack , sirve para limpiar codigo malisioso , como asi ,
	* codigo html dentro de una cadena.
	*/
	public	function AntiHack($cadena=NULL){
		return htmlspecialchars(  strip_tags(  stripslashes(   $cadena   )   )   )  ;
	}


	/*
	* Metodo Select , es para generar una consulta ala base de datos
	* los valores que se pasan , primero es la consulta
	* despues el metodo como los sacara , puede ser 'fetch_array' , 'fetch_row' , 'num_rows'
	* eso es para el metodo , despues sigue la variable antihack, el cual es un bolean,
	* si es true elimina todo el codigo maligno de la consulta
	*/
	public function Select($Sentencia , $Metodo='fetch_array' , $AntiHack=true ){
			$this->resultado = '' ;
		if($AntiHack){
			$this->Sentencia = $this->AntiHack($Sentencia) ;
		} else {
			$this->Sentencia = $Sentencia ;
		}

		if($this->DbType == 'mysql'){
			$this->resultado = mysql_query($this->Sentencia) or die('Sentencia Incorrecta : ' . mysql_error()) ;
			if($Metodo == 'fetch_array'){
				$this->resultado = $this->SelectFetchArrayMysql($this->resultado) ;
			}
			if($Metodo == 'fetch_row'){
				$this->resultado = $this->SelectFetchRowMysql($this->resultado) ;
			}
			if($Metodo == 'num_rows'){
				$this->resultado = $this->SelectNumRowsMysql($this->resultado) ;
			}
			@mysql_free_result($this->resultado);
			return $this->resultado ;
		}
		if($this->DbType == 'sqlite'){
			
			if($Metodo == 'fetch_array'){
				$this->resultado = $this->SelectFetchArraySqlite() ;
			}
			if($Metodo == 'fetch_row'){
				$this->resultado = $this->SelectFetchRowSqlite() ;
			}
			if($Metodo == 'num_rows'){
				$this->resultado = $this->SelectNumRowsSqlite() ;
			}
			return $this->resultado ;
		}



	}


	/*
	* Metodo SelectFetchArrayMysql , sirve para sacar la consulta ,
	* en una matriz , la cual es  el indice de la matriz el nombre de
	* la consulta.
	*/
	private function SelectFetchArrayMysql($resultado){
		 $this->result2 = array();
		while ( $this->result2[] = @mysql_fetch_array($resultado)  ) { }
		$this->total = count($this->result2) - 1;
		unset(   $this->result2[$this->total]       ) ;
		$total_arrays = count($this->result2);
		$total = count($this->result2[0]) / 2;
		for($a=0;  $a<$total_arrays; $a++){
			for($i=0;  $i<$total;  $i++){
				unset(   $this->result2[$a][$i]       ) ;
			}
		}
		return $this->result2 ;
	}

	/*
	* Metodo SelectFetchArraySqlite , sirve para sacar la consulta ,
	* en una matriz , la cual es  el indice de la matriz el nombre de
	* la consulta.
	*/
	private function SelectFetchArraySqlite(){
		$this->resultado = sqlite_query($this->SqliteDB , $this->Sentencia) ;
		while ( $this->result2[] = sqlite_fetch_array($this->resultado)  ) { }
		$this->total = count($this->result2) - 1;
		unset(   $this->result2[$this->total]       ) ;
		$total_arrays = count($this->result2);
		$total = count($this->result2[0]) / 2;
		for($a=0;  $a<$total_arrays; $a++){
			for($i=0;  $i<$total;  $i++){
				unset(   $this->result2[$a][$i]       ) ;
			}
		}
		return $this->result2 ;
	}
	
	
	/*
	* Metodo SelectFetchRowMysql , sirve para sacar la consulta ,
	* en una matriz , el indice de la matriz es el numero de la columna.
	*/
	private function SelectFetchRowMysql($resultado){
		$this->result1 = $resultado ;
		while ( $this->result2[] = mysql_fetch_row($this->result1)  ) { }
		$this->total = count($this->result2) - 1;
		unset(   $this->result2[$this->total]       ) ;
		return $this->result2 ;
	}

	/*
	* Metodo SelectFetchRowSqlite , sirve para sacar la consulta ,
	* en una matriz , el indice de la matriz es el numero de la columna.
	*/
	private function SelectFetchRowSqlite(){
		$this->resultado = sqlite_query($this->SqliteDB , $this->Sentencia) ;
		while ( $this->result2[] = sqlite_fetch_array($this->resultado)  ) { }
		$this->total = count($this->result2) - 1;
		unset(   $this->result2[$this->total]       ) ;
		$total_arrays = count($this->result2);
		$total = count($this->result2[0]) / 2;
		for($a=0;  $a<$total_arrays; $a++){
			for($i=0;  $i<$total;  $i++){
				unset(   $this->result2[$a][$i]       ) ;
			}
		}
		for($i=0; $i<count($this->result2) ; $i++){
			$x=0;
			foreach($this->result2[$i] as $Key => $Id){
				$this->result3[$i][$x] = $Id ;
				$x++;
			}
		}
		return $this->result3 ;
	}
	
	
	/*
	* Metodo SelectNumRowsMysql , sirve para sacar el numero de
	* registros que cumplan con la consulta que se mando.
	*/
	private function SelectNumRowsMysql($resultado){
		$this->result2 = mysql_num_rows($resultado) ;
		return $this->result2 ;
	}

	/*
	* Metodo SelectNumRowsSqlite , sirve para sacar el numero de
	* registros que cumplan con la consulta que se mando.
	*/
	private function SelectNumRowsSqlite(){
		$this->resultado = sqlite_query($this->SqliteDB , $this->Sentencia) ;
		$this->resultado = sqlite_num_rows($this->resultado);
		return $this->resultado ;
	}
	
	/*
	* Metodo Insert , sirve para agregar nuevas filas ala base de datos
	* se pasan en una matriz los datos, el cual es id => valor ,
	* en el segundo campo lleva el nombre de la tabla ,
	* en el tercer campo lleva un boolean , si es true quita todo el
	* codigo malicioso como asi mismo html , si es false , no quita nada
	* por defecto tiene true.
	*/
	public function Insert($Datos , $tabla , $AntiHack=true ){
		$this->Datos = $Datos ;
		$this->Cadena1 = "INSERT INTO " . $tabla . " ( " ;
		$this->Cadena2 = " VALUES ( " ;
		$this->total_valores = count($this->Datos);
		$i = 0 ;

		foreach(  $this->Datos as $nombre  => $valor  ) {
			if( $i < $this -> total_valores - 1){
				$this -> Cadena1 .= "`".$nombre."` , " ;
				$this -> Cadena2 .= "'".$valor."' , " ;
			} else {
				$this -> Cadena1 .= "`".$nombre."` ) " ;
				$this -> Cadena2 .= "'".$valor."' ) " ;
			}
			$i++ ;
		}

		$this->Sentencia = $this->Cadena1 . $this->Cadena2 ;

		if($AntiHack){
			$this->Sentencia = $this->AntiHack($this->Sentencia) ;
		}

		if($this->DbType == 'mysql'){
			$this->resultado_insert = @mysql_query( $this->Sentencia ) ;
			if( $this -> resultado_insert  ){
				$this -> resultado6['msg'] = "Dato Insertado Correctamente" ;
				$this -> resultado6['bandera'] = true ;
				$this -> resultado6['affected_rows'] = mysql_affected_rows() ;
				$this -> resultado6['insert_id'] = mysql_insert_id() ;
			} else {
				$this -> resultado6['msg'] = "Dato Insertado Erroneamente : " . mysql_error() ;
				$this -> resultado6['bandera'] = false ;
			}
			@mysql_free_result($this->resultado_insert);
			return $this -> resultado6 ;
		}
		if($this->DbType == 'sqlite'){
			$this->resultado_insert = @sqlite_single_query($this->SqliteDB , $this->Sentencia);
			print_r($this->resultado_insert) ;
			if( $this -> resultado_insert  ){
				$this -> resultado['msg'] = "Dato Insertado Correctamente" ;
				$this -> resultado['bandera'] = true ;
				$this -> resultado['insert_id'] = @sqlite_last_insert_rowid($this->resultado_insert ) ;
			} else {
				$this -> resultado['msg'] = "Dato Insertado Erroneamente"  ;
				$this -> resultado['bandera'] = false ;
				$this -> resultado['insert_id'] = @sqlite_last_insert_rowid($this->resultado_insert ) ;
			}
			return $this -> resultado ;
		}

	}


	/*
	* Metodo Update , sirve para actualizar registros de la base de datos ,
	* los datos que se pasan , primero son . tabla , un bolean para ver si
	* quieres limpiar la sentencia y no meter codigo malicioso
	* despues se pasan en un array $UpdateBuscar = los valores a modificar ,
	* el key el nombre de la comlumna a modificar, y en el valor el valor para modificar
	* en $UpdateTypo se pasa un array con el key de la comlumna y como valor 'text' o 'int'
	* esto sirve para poner comillas simples o dejar el valor sin comillas.
	* Despues sigue $UpdateBuscarSimbolo k es un array donde se usa para despues del where
	* es pára decir el simbolo k separa la columna y el valor ,
	* Despues sigue $UpdateBuscarTipo que es un array el cual lleva el metodo de AND , OR , O LOGICA
	* para la separacion de los valores despues del WHERE
	*/
	public function Update($tabla , $antihack , $UpdateModificar , $UpdateBuscar , $UpdateTypo=NULL , $UpdateBuscarSimbolo=NULL , $UpdateBuscarTipo=NULL){
		$this->Sentencia = "UPDATE " . $tabla . " SET " ;
		$total = count($UpdateModificar) ;
		$x = 0 ;

		foreach($UpdateModificar as $Key => $Id){
			if($x < $total-1){
				$this->Sentencia .= $Key . '=' . $this->TypeFormat($UpdateTypo , $Key , $Id) . ' , ' ;
			} else {
				$this->Sentencia .= $Key . '=' . $this->TypeFormat($UpdateTypo , $Key , $Id) ;
			}
			$x++ ;
		}

		$this->Sentencia .= $this->ConsultaWhere($UpdateBuscar , $UpdateTypo , $UpdateBuscarSimbolo , $UpdateBuscarTipo) ;

		if($antihack){
			$this->Sentencia = $this->AntiHack($this->Sentencia) ;
		} else {
			$this->Sentencia = $this->Sentencia ;
		}

			
		if($this->DbType == 'mysql'){
			$this->resultado = @mysql_query($this->Sentencia) ;
			@mysql_free_result($this->resultado);
			if($this->resultado){
				$this -> resultado3['msg'] = "Data Updated Successfully!" ;
				$this -> resultado3['bandera'] = true ;
				$this -> resultado3['affected_rows'] = mysql_affected_rows() ;
			} else {
				$this->resultado3['msg'] = 'Error : ' . mysql_error()  ;
				$this->resultado3['bandera'] = false  ;
			}
		}


		return $this->resultado3 ;
	}


	/*
	* Metodo Delete , sirve para eliminar registros de la base de datos ,
	* los datos que se pasan , primero son . tabla , un bolean para ver si
	* quieres limpiar la sentencia y no meter codigo malicioso
	* despues se pasa $UpdateTypo un array con el key de la comlumna y como valor 'text' o 'int'
	* esto sirve para poner comillas simples o dejar el valor sin comillas.
	* Despues sigue $UpdateBuscarSimbolo k es un array donde se usa para despues del where
	* es pára decir el simbolo k separa la columna y el valor ,
	* Despues sigue $UpdateBuscarTipo que es un array el cual lleva el metodo de AND , OR , O LOGICA
	* para la separacion de los valores despues del WHERE
	*/
	public function Delete($tabla , $antihack , $UpdateBuscar , $UpdateTypo=NULL , $UpdateBuscarSimbolo=NULL , $UpdateBuscarTipo=NULL){
		$this->Sentencia = "DELETE FROM " . $tabla  ;
		$this->Sentencia .= $this->ConsultaWhere($UpdateBuscar , $UpdateTypo , $UpdateBuscarSimbolo , $UpdateBuscarTipo) ;

		if($antihack){
			$this->Sentencia = $this->AntiHack($this->Sentencia) ;
		} else {
			$this->Sentencia = $this->Sentencia ;
		}

		if($this->DbType == 'mysql'){
			$this->resultado = @mysql_query($this->Sentencia) ;
			@mysql_free_result($this->resultado);
			if($this->resultado){
				$this -> resultado3['msg'] = "Datos Eliminados Correctamente" ;
				$this -> resultado3['bandera'] = true ;
				$this -> resultado3['affected_rows'] = mysql_affected_rows() ;
			} else {
				$this->resultado3['msg'] = 'Error : ' . mysql_error()  ;
				$this->resultado3['bandera'] = false  ;
			}
		}

		return $this->resultado3 ;

	}

	/*
	* El metodo ConsultaWhere es un metodo privado , el cual sirve para generar
	* el codigo despues de un WHERE
	*/
	private function ConsultaWhere($UpdateBuscar , $UpdateTypo , $UpdateBuscarSimbolo , $UpdateBuscarTipo){
		$this->Sentencia2 = " WHERE " ;
		$total = count($UpdateBuscar) ;
		$x = 0 ;

		foreach($UpdateBuscar as $Key => $Id){
			if($x < $total-1){
				$this->Sentencia2 .= $Key . $this->SymbolUpdate($UpdateBuscarSimbolo , $Key) . $this->TypeFormat($UpdateTypo , $Key , $Id) . ' ' . $this->TypeUpdate($UpdateBuscarTipo , $Key) ;
			} else {
				$this->Sentencia2 .= $Key . $this->SymbolUpdate($UpdateBuscarSimbolo , $Key) . $this->TypeFormat($UpdateTypo , $Key , $Id) ;
			}
			$x++ ;
		}

		return $this->Sentencia2 ;
	}

	/*
	* El metodo TypeUpdate es un metodo privado , el cual sirve para ver el operador
	* el cual separa dos datos despues de un WHERE
	*/
	private function TypeUpdate($UpdateTypo , $key){
		if($UpdateTypo==NULL){
			return "AND " ;
		} else {
			if( ! isset($UpdateTypo[$key]) ){
				return "AND " ;
			} else {
				return $UpdateTypo[$key] . ' ' ;
			}
		}
	}


	/*
	* El metodo TypeFormat es un metodo privado , el cual sirve para ver si el
	* valor es un string o numero
	*/
	private function TypeFormat($UpdateTypo , $key , $id){
		if($UpdateTypo==NULL){
			return "'" . $id . "'" ;
		} else {
			$type = $UpdateTypo[$key] ;
			if($type == 'text'){
				return "'" . $id . "'" ;
			} else if($type == 'int'){
				return  $id  ;
			} else {
				return "'" . $id . "'" ;
			}
		}
	}


	/*
	* El metodo SymbolUpdate es un metodo privado , el cual sirve para ver el operador
	* que lo une con la columna
	*/
	private function SymbolUpdate($UpdateTypo , $key){
		if($UpdateTypo==NULL){
			return "=" ;
		} else {
			if( ! isset($UpdateTypo[$key]) ){
				return "=" ;
			} else {
				return $UpdateTypo[$key] ;
			}
		}
	}


	/*
	* El metodo Query es un metodo publico , el cual sirve para hacer lo que gustes
	*/
	public function Query($consulta , $AntiHack=true){
		$this->Consulta = $consulta ;
		if($AntiHack){
			$this->Consulta = $this->AntiHack($this->Consulta) ;
		}

		if($this->DbType == 'mysql'){
			$this->resultado = @mysql_query($this->Consulta) ;
			@mysql_free_result($this->resultado);
			return $this->resultado ;
		}
		if($this->DbType == 'sqlite'){
			$this->resultado = @sqlite_query ( $this->SqliteDB , $this->Consulta ) ;
			return $this->resultado ;
		}

	}







/* 
 * Funcion para transformar un resultado de mysql en un archivo XML 
 **/ 

function mysql_XML($resultado, $nombreDoc='resultados', $nombreItem='item') { 
   $campo = array(); 
	$resultado = @mysql_query($resultado) ;
	
   for ($i=0; $i<@mysql_num_fields($resultado); $i++) 
      $campo[$i] = @mysql_field_name($resultado, $i); 
    
   $dom = new DOMDocument('1.0', 'UTF-8'); 
   $doc = $dom->appendChild($dom->createElement($nombreDoc)); 
    
   for ($i=0; $i<@mysql_num_rows($resultado); $i++) { 
       
      $nodo = $doc->appendChild($dom->createElement($nombreItem)); 
       
      for ($b=0; $b<count($campo); $b++) { 
         $campoTexto = $nodo->appendChild($dom->createElement($campo[$b])); 
         $campoTexto->appendChild($dom->createTextNode(@mysql_result($resultado, $i, $b))); 
      } 
   } 
    
   $dom->formatOutput = true;  
   return $dom->saveXML();     
} 






}

function nice_escape($unescapedString)
{
    if (get_magic_quotes_gpc())
    {
        $unescapedString = stripslashes($unescapedString);
    }
    $semiEscapedString = mysql_real_escape_string($unescapedString);
    $escapedString = addcslashes($semiEscapedString, "%_");

    return $escapedString;
} 

function nice_output($escapedString)
{
    $patterns = array();
    $patterns[0] = '/\\\%/';
    $patterns[1] = '/\\\_/';
    $replacements = array();
    $replacements[0] = '%';
    $replacements[1] = '_';
    $output = preg_replace($patterns, $replacements, $escapedString);
    
    return $output;
} 

function cleanstring($string)
{
	$done = nice_output(nice_escape($string));
	
	return $done;
}
?>