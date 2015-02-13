<?php
include_once 'connect.php';
include_once 'functions.php';

start_session(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['username'] && $_POST['password'])) {
    $user = $_POST['username'];
    $password = $_POST['password']; 
 
    if (login($username, $password, $mysqli) == true) {
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

echo "we are hitting login.php";
?>