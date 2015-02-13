<?php
include_once 'connect.php';
include_once 'functions.php';


//session_start();  //Our custom secure way of starting a PHP session.
echo("<br>");
print_r($_POST);
echo("<br>");
print_r($_GET);

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $_POST['username'];
    $password = $_POST['password'];
    if (login($username, $password, $mysqli)) {
        // Login success 
        header('Location: ../profile.html');
    } else {
        // Login failed 
        header('Location: ../profile.html');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}

//echo "we are hitting login.php";
?>