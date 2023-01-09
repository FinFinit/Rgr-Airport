<?php

error_reporting(0);
$host = "localhost";
$user = "root";
$password = "";
$database = "Airport";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch(mysqli_sql_exception $ex){
    echo 'Error';
}
?>