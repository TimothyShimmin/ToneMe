<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "Registration failed, check input.";
 
if (isset($_POST['username'], $_POST['p'], $_POST['firstname'], $_POST['lastname'], $_POST['DOB'], $_POST['feet'])) {
    // Sanitize and validate the data passed in
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    $DateOfBirth = filter_input(INPUT_POST, 'DOB', FILTER_SANITIZE_STRING);
    $feet = filter_input(INPUT_POST, 'feet', FILTER_SANITIZE_NUMBER_INT);
    $inches = filter_input(INPUT_POST, 'inches', FILTER_SANITIZE_NUMBER_INT);
    $weight = filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_NUMBER_INT);
    $gender = filter_input(INPUT_POST), 'gender', FILTER__SANITIZE_STRING);

    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
 
    // check existing username
    $prep_stmt = "SELECT id FROM users WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 1) {
                        // A user with this username already exists
                        $error_msg .= '<p class="error">A user with this username already exists</p>';
                        $stmt->close();
                }
                $stmt->close();
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
        }
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if (empty($error_msg)) {
        
 
        // Create password 
        $password = 
        $height = ($feet*12 + $inches);
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO users (username, password, height, weight, DOB, firstname, surname, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssssssss', $username, $password, $height, $weight, $DateOfBirth, $firstname, $lastname, $gender);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ./register_success.php');
    }
}