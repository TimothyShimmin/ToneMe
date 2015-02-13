<?php
include_once 'connect.php';
include_once 'functions.php';

sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
include_once 'index.html';

?>