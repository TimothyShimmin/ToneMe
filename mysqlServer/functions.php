<?php
include_once 'config.php';

function start_session(){
	$session_name ='sec_id';
	
	$secure = SECURE;
	
	$HTTPonly = true;
	
	if(ini_set('session.use_only_cookies', 1)=== FALSE)
	{
		header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
		exit();
	}
	  
	$cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $HTTPonly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id(true);
}

function login($username, $password, $mysqli) {
	if($stmt = $mysqli->prepare("SELECT id FROM users WHERE username = "+$username+" AND password = "+$password))
	{ 
	$stmt->execute();
	$stmt->store_result();
	
	$stmt->bind_result($id, $user, $pass);
	$stmt->fetch();

	if($mysqli->num_rows== 1)
	{
		//correct password
		$_SESSION['username'] = $username;
		$_SESSION['user_id'] = $id;
		$_SESSION['login_string'] = $password;
		return true;
	} else {
		//incorrect password
		return false;
	}
	} else {
		//user does not exist
		return false;
	}
}

/*
	Login data used for accessing profile.html
	 in the toneme application layout format.
	 ia
*/

function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = $password;
 
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}

function returnListActivities($mysqli, $legs, $arms, $core, $cardio) {
	$sql = "SELECT activityName, Activity-ID FROM activities";

	if(!is_null($legs) || !is_null($arms) || !is_null($core) || !is_null($cardio)){
		$alreadyAddingStuff = false;
		$sql .=" where";
		if(!is_null($legs)){
			$sql .= " Legs = " . $legs;
		}
		if(!is_null($arms)){
			if($alreadyAddingStuff == true){
				$sql .= " OR ";
			} else {
				$alreadyAddingStuff = true;
			}
			$sql .= " Arms = " . $arms;
		}
		if(!is_null($core)){
			if($alreadyAddingStuff == true){
				$sql .= " OR ";
			} else {
				$alreadyAddingStuff = true;
			}
			$sql .= " Core = " . $core;
		}
		if(!is_null($legs)){
			if($alreadyAddingStuff == true){
				$sql .= " OR ";
			} else {
				$alreadyAddingStuff = true;
			}
			$sql .= " Cardio = " . $cardio;
		}
	}
	if($stmt = $mysqli->prepare($sql))
	{
		$stmt->execute();
		$stmt->store_result();
		$stmt->fetch();
	}
}
?>
