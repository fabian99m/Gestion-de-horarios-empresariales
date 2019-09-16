<?php

session_start();
if (!isset($_SESSION['access_token'])) {
    header('Location: erorr.html');
    exit();
}

$con = new mysqli("localhost", "id9025586_proyecto", "fabian123", "id9025586_proyecto");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

  if(isset($_POST['data'])) {
        
   $Data = $_POST['data'];
   $nEvento = $Data[0];
   $iEvento = $Data[1];
   $fEvento = $Data[2];

    $query = "SELECT cod FROM reuniones where nombre='$nEvento' AND inicio='$iEvento' AND final = '$fEvento'";
   $re= mysqli_query($con, $query);
    foreach ($re as $aux) {
     $codi=$aux['cod'];
       $con3 = new mysqli("localhost", "id9025586_proyecto", "fabian123", "id9025586_proyecto");
       if ($con3->connect_error) {
         die("Connection failed: " . $con3->connect_error);
        }
        $query2 = "SELECT name,google_email FROM google_users where clint_id=$codi";
        $re2=mysqli_query($con3, $query2);
       foreach($re2 as $aux2) {
           $nombre=$aux2['name'];
        mail($aux2['google_email'],"Hola $nombre , Una reunión se ha cancelado!","* Nombre de reunión : $nEvento \n"."* Inicio de reunión : $iEvento \n"."* Fin de reunión : $fEvento \n","Desde Fabianjose99@gmail.com");   
       }

    }

  
   $con2 = new mysqli("localhost", "id9025586_proyecto", "fabian123", "id9025586_proyecto");
  if ($con2->connect_error) {
    die("Connection failed: " . $con2->connect_error);
   }
   $query = "DELETE From reuniones where nombre='$nEvento' AND inicio='$iEvento' AND final = '$fEvento'";
   mysqli_query($con2, $query);

 }

header('Location: asignar.php');
exit();
 

?>