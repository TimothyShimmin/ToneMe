<?php
include_once 'config.php';
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE)
 or die("Unable to connect to server on $server");
?>