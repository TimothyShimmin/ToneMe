<?php
print_r($_POST);
die();

include_once 'connect.php';
include_once 'functions.php';

start_session(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['username']$_POST['password'])) {
    $user = $_POST['username'];
    $password = $_POST['password']; 

    var x = login($username, $password, $mysqli);
 
    if (x == true) {
        // Login success 
        header('Location: ../profilepage.php');
    } else {
        // Login failed 
        header('Location: ../index.php');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}

echo "we are hitting login.php";
?>