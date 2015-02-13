<?php
include_once 'connect.php';
include_once 'config.php';

if(login_check($mysql))
{
	if($_POST['arms']==1)
	{
		
	}
	if($_POST['legs']==1)
	{
	
	}
	if($_POST['abs']==1)
	{
	
	}
	if($_POST['cardio']==1)
	{
	
	}
}else{
	header('Location: ../index.php');
}
?>