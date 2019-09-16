<?php
$con = new mysqli("localhost", "id9025586_proyecto","fabian123" ,"id9025586_proyecto");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$resultado = mysqli_query($con, "SELECT clint_id from google_users where rol= 'Empleado' ");

$con=0;
$data=array();
$codigos=array();

foreach($resultado as $resultado) {

    if (isset($_POST[$resultado['clint_id']])) {
     array_push($data,$resultado['clint_id']);
    $con++;
    } 
    
}  
    if($con==0) {
        header('Location: asignar.php?modal=1');        
            exit();
    }  else {
            $fechat=$_POST['fecha'];
            $ffin=$fechat." ".$_POST['horafinal'];
            $fini=$fechat." ".$_POST['horainicial'];
            $nombre=$_POST['nombre'];
    
      foreach($data as $valor) { 
        $con2 = new mysqli("localhost", "id9025586_proyecto","fabian123" ,"id9025586_proyecto");
        if ($con2->connect_error) {
            die("Connection failed: " . $con2->connect_error);
        }
        $aux2=0;
        $aux3=0;
        $r = mysqli_query($con2 , "SELECT * from eventos where IDempleado=$valor");
         foreach($r as $res) {
         
            $fecha_inicio = strtotime($fini);
            $fecha_fin = strtotime($ffin);
            $fecha = strtotime($res['start']);

            $a=0;
            $a2=0;
            $a3=0;
       
            if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
                
                $a = 1;
            }          
            $fecha = strtotime($res['end']);
            if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
               
                $a2 = 1;
            } 
            
            $fecha = strtotime($res['start']);
            $fecha2 = strtotime($res['end']);
            if(($fecha < $fecha_inicio) && ($fecha2> $fecha_fin)) {
                
                $a3 = 1;
            } 

            $aux=0;
            if($a==1 && $a2==1){      
              $aux++;
              // echo "si hay reunion";
           } 
           else if($a==1 || $a2==1 || $a3==1) {   
               $aux++;
               //echo "si hay reunion";  
           }  
             
         if( $aux!=0){
   
            $aux2++;
   
         }else {
            $aux3++;
            }
         }
         if($aux2==0){
             /*
            echo'<script type="text/javascript">
            alert("No se pudo crear la reunión!");
            window.location.href="asignar.php";
            </script>';
            */
            header('Location: asignar.php?modal=1');        
            exit();
         } else {
            array_push($codigos,$valor);
         }
    }
    $con3 = new mysqli("localhost", "id9025586_proyecto","fabian123" ,"id9025586_proyecto");
    if ($con3->connect_error) {
        die("Connection failed: " . $con3->connect_error);     
    }

    foreach($codigos as $cd) {
        mysqli_query($con3 , "INSERT into reuniones (cod,inicio,final,nombre) VALUES ('$cd','$fini','$ffin','$nombre')"); 

    } 

    $con4= new mysqli("localhost", "id9025586_proyecto","fabian123" ,"id9025586_proyecto");
    if ($con4->connect_error) {
        die("Connection failed: " . $con4->connect_error);     
    }

    foreach ($codigos as $codi) {
        $aux5=mysqli_query($con4 , "SELECT name,last_name,google_email FROM google_users where clint_id =$codi");  
        foreach($aux5 as $na) {
        $n=$na['name'];
        mail($na['google_email'],"Hola $n , tienes una reunión pendiente!","* Nombre de reunión : $nombre \n"."* Inicio de reunión : $fini \n"."* Fin de reunión : $ffin \n","Desde Fabianjose99@gmail.com") ;
    }
  }

    header('Location: asignar.php');
    exit();
    }
   
?>