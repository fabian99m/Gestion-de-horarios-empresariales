<?php  
session_start();
if (!isset($_SESSION['access_token'])) {
	header('Location: error.html.php');
        exit();
}
   $con = new mysqli("localhost", "id9025586_proyecto","fabian123" ,"id9025586_proyecto");
   if ($con->connect_error) {
   die("Connection failed: " . $con->connect_error);
   }
    $radio = $_POST['tipo'];
	$id =  $_SESSION['id'];
	
	$query = "UPDATE google_users SET rol = '$radio' where clint_id = $id";
	mysqli_query($con,$query); 

	if($radio == "Coordinador") {
		header('Location: coordinador/index-admin.php');
		exit();
	} else {
		header('Location: empleado/index-empleado.php');
		exit();
	}	
?>