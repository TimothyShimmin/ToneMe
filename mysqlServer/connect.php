<?php
include_once 'config.php';
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
print_r($mysqli);
 or die("Unable to connect to server on $server");
?>