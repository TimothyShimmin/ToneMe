<?php
include_once 'connect.php';
include_once 'functions.php';

//session_start();  //Our custom secure way of starting a PHP session.
echo("<br>");
print_r($_POST);

if (isset($_POST['login-username']) && isset($_POST['login-password'])) {
    $user = $_POST['login-username'];
    $password = $_POST['login-password'];
    if (login($username, $password, $mysqli)) {
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

//echo "we are hitting login.php";
?>