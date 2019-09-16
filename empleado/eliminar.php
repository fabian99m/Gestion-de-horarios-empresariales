<?php


session_start();
if (!isset($_SESSION['access_token'])) {
    header('Location: ../error.html');
    exit();
}

$con = new mysqli("localhost", "id9025586_proyecto","fabian123" ,"id9025586_proyecto");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$idEvento=$_POST["ide"];

$query="DELETE From eventos where id=$idEvento";
mysqli_query($con,$query);


?>