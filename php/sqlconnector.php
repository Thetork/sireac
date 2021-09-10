<?php


//$serverName = "LAPTOP-5707RJV3";
$serverName = "145.0.40.72"; 
$connectionInfo = array( "Database"=>"sedicop", "UID"=>"sedicop_db7", "PWD"=>"S3diposdHr", "ReturnDatesAsStrings" =>"true");
//$connectionInfo = array( "Database"=>"sedicop", "UID"=>"sa", "PWD"=>"12345", "ReturnDatesAsStrings" =>"true");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) {
     //echo "Conexión establecida<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}


?>
