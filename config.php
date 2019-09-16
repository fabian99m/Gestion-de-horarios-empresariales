<?php
	session_start();
	require_once "vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("585158244416-teav196iur5icf4hg9vv7vp2o5cta6jb.apps.googleusercontent.com");
	$gClient->setClientSecret("gaAEPVsZkBOIGUCZvtBE7RHW");
	$gClient->setApplicationName("login");
	$gClient->setRedirectUri("https://gestorempresarial.000webhostapp.com/g-callback.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
	$con = new mysqli("localhost", "id9025586_proyecto","fabian123" ,"id9025586_proyecto");
    if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}	
?>