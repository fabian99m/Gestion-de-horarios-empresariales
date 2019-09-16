<?php
	require_once "config.php";
	unset($_SESSION['access_token']);
	$gClient->revokeToken();
	session_destroy();
	header('Location: https://gestorempresarial.000webhostapp.com/');
	exit();
?>