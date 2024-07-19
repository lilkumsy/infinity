<?php
$serverName = "test-dbase1, 1433"; 
$connectionInfo = array( "Database"=>"Source", "UID"=>"", "PWD"=>"");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
    //echo "Connection established.<br />";
}
else{
    echo "<b>Connection could not be established.</b><br />";
    die( print_r( sqlsrv_errors(), true));
}
?>
