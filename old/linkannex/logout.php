<?php
	session_start();
	
	define("LOGGED_IN", "f0c04d332c851f7d887981e3ed57fe54");
	
	$_SESSION["firstname"] = "";
	$_SESSION["lastname"] = "";
	$_SESSION["username"] = "";
	$_SESSION["password"] = "";
	$_SESSION[LOGGED_IN] = "";
	
	session_destroy();
	header("Location: linkannex.php");
?>