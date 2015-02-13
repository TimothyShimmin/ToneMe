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
	if($stmt = $mysqli->prepare("SELECT id, username, password FROM Users"))
	{
	$stmt->execute();
	$stmt->store_result();
	
	$stmt->bind_result($id, $user, $pass);
	$stmt->fetch();
	
	if($pass == $password)
	{
		//correct password
		return true;
	}else{
		//incorrect password
		return false;
	}
	}else{
		//user does not exist
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
				$sql .= " OR "
			} else {
				$alreadyAddingStuff = true;
			}
			$sql .= " Arms = " . $arms;
		}
		if(!is_null($core)){
			if($alreadyAddingStuff == true){
				$sql .= " OR "
			} else {
				$alreadyAddingStuff = true;
			}
			$sql .= " Core = " . $core;
		}
		if(!is_null($legs)){
			if($alreadyAddingStuff == true){
				$sql .= " OR "
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
