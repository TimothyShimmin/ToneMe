<?php
include_once 'mysqlServer/connect.php';
include_once 'mysqlServer/functions.php';
 
print_r("test");

sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
include_once 'index.html';

?>