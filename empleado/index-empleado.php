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
$id = $_SESSION['id'];
$resultado = mysqli_query($con, "SELECT rol from google_users where clint_id =$id");
while ($aux = mysqli_fetch_array($resultado)) {
    $_SESSION['rol'] = $aux['rol'];
}
$resultado = mysqli_query($con, "SELECT name from google_users where clint_id =$id");
while ($aux = mysqli_fetch_array($resultado)) {
    $nombre = $aux['name'];
}

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestor de reuniones</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />

</head>

<body>
    <nav class="white " role="navigation">
        <div class="nav-wrapper container">
            <ul class="right hide-on-med-and-down">
                <li>
                    <a href="index-empleado.php">
                        <i class="large material-icons left">person</i><?php echo $nombre ?></a>
                </li>
                <li>
                    <a href="ver-reunion.php">
                        <i class="large material-icons left">group</i>Ver reuniones
                    </a>
                </li>
                <li>
                    <a href="ingresar-horas.php">
                        <i class="large material-icons left">view_agenda</i>Ingresar disponibilidad</a>
                </li>
            
                <li><a href="../logout.php"><i class="large material-icons left">exit_to_app</i>Salir</a></li>
            </ul>

            <ul id="nav-mobile" class="sidenav">
                <li>
                    <a href="index-empleado.php">
                        <i class="large material-icons left">person</i><?php echo $nombre ?></a>
                </li>
                <li>
                    <a href="ver-reunion.php">
                        <i class="large material-icons left">group</i>Ver reuniones
                    </a>
                </li>
                <li>
                    <a href="ingresar-horas.php"><i class="large material-icons left">view_agenda</i>Ingresar disponibilidad</a>
                </li>
               
                <li><a href="../logout.php"><i class="large material-icons left">exit_to_app</i>Salir</a></li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger">
                <i class="material-icons">menu</i>
            </a>
        </div>
    </nav>

    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/init.js"></script>

</body>

<body>
    <div class="nav-wrapper container" style="margin-top: 3%">
        <div class="row">
            <div class="col s4"><img width="200" height="200" class="circle responsive-img" src="<?php echo $_SESSION['picture'] ?>"></div>

            <div class="col s8">

                <table class="responsive table">
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td><?php echo $_SESSION['id'] ?></td>
                        </tr>
                        <tr>
                            <td>Nombre</td>
                            <td><?php echo $_SESSION['givenName'] ?></td>
                        </tr>
                        <tr>
                            <td>Apellido</td>
                            <td><?php echo $_SESSION['familyName'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $_SESSION['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Genero</td>
                            <td><?php echo $_SESSION['gender'] ?></td>
                        </tr>
                        <tr>
                            <td>Cargo</td>
                            <td><?php echo $_SESSION['rol'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html> 