<?php
// this will avoid mysql_connect() deprecation error.
error_reporting( ~E_DEPRECATED & ~E_NOTICE );

$connect = new mysqli ('localhost','root','','cr13_valeria_nazarova_people');

if ($connect->connect_errno) {
   die("Failed to connect to MySQL: " . $connect->connect_error);
}
// else {echo "connected";}
?>


