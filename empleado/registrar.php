<?php
session_start();
if (!isset($_SESSION['access_token'])) {
    header('Location: ../error.html');
    exit();
}
$con = new mysqli("localhost", "id9025586_proyecto", "fabian123", "id9025586_proyecto");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$fecha = $_POST['fechap'];
$inicial = $_POST['fechap'] . " " . $_POST['finicial'];
$final = $_POST['fechap'] . " " . $_POST['ffinal'];
$id =  $_SESSION['id'];

$query = "SELECT COUNT(IDempleado) FROM eventos where IDempleado = $id";
$resultado =  mysqli_query($con, $query);

foreach ($resultado as $aux) {
    $cont = $aux['COUNT(IDempleado)'];
}

if ($cont == 0) {

    do {
        $color = substr(md5(time()), 0, 6);
        $c = '#' . $color;
        $cont1 = 0;

        $con2 = new mysqli("localhost", "id9025586_proyecto", "fabian123", "id9025586_proyecto");
        if ($con2->connect_error) {
            die("Connection failed: " . $con2->connect_error);
        }
        $query = "SELECT color FROM eventos ";
        $resultado =  mysqli_query($con2, $query);

        foreach ($resultado as $aux) {
            if ($c == $aux['color']) {
                $cont1++;
            }
        }
    } while ($cont1 > 0);
    mysqli_close($con2);


    $con3 = new mysqli("localhost", "id9025586_proyecto", "fabian123", "id9025586_proyecto");
    if ($con3->connect_error) {
        die("Connection failed: " . $con3->connect_error);
    }
    $query = "INSERT INTO eventos (start,end,IDempleado,color) VALUES ('$inicial' , '$final',$id,'$c') ";
    mysqli_query($con3, $query);
    mysqli_close($con3);
} else {
    $con4 = new mysqli("localhost", "id9025586_proyecto", "fabian123", "id9025586_proyecto");
    if ($con4->connect_error) {
        die("Connection failed: " . $con4->connect_error);
    }
    $query = "SELECT color FROM eventos where IDempleado = $id";
    $resultado =  mysqli_query($con4, $query);
    mysqli_close($con4);
    foreach ($resultado as $aux) {
        $cont = $aux['color'];
    }
    $con5 = new mysqli("localhost", "id9025586_proyecto", "fabian123", "id9025586_proyecto");
    if ($con5->connect_error) {
        die("Connection failed: " . $con5->connect_error);
    }
    $query = "INSERT INTO eventos (start,end,IDempleado,color) VALUES ('$inicial' , '$final',$id,'$cont') ";
    mysqli_query($con5, $query);
    mysqli_close($con5);
}


header('Location: ingresar-horas.php');
exit();
 