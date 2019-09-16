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
    <SCRIPT LANGUAGE="JavaScript">
        function mi_alerta() {
            alert("Seleccione un evento para eliminar!");
        }
    </SCRIPT>
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
                    <a href="ingresar-horas.php"> <i class="large material-icons left">view_agenda</i>Ingresar disponibilidad</a>
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

    <?php

    $id = $_SESSION['id'];
    $con = new mysqli("localhost", "id9025586_proyecto", "fabian123", "id9025586_proyecto");
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    $resultado = mysqli_query($con, "SELECT * from eventos WHERE IDempleado =$id");

    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel='stylesheet' href='../css/fullcalendar.min.css' />
        <link rel='stylesheet' href='../css/fullcalendar.print.css' rel='stylesheet' media='print' />
        <link href="../css/style.css" rel="stylesheet" />
        <script src='../assets/js/jquery.min.js'></script>
        <script src='../assets/js/moment.min.js'></script>
        <script src='../assets/js/fullcalendar.js'></script>
        <script src='../assets/locale/es.js'></script>
        <style>
            h2 {
                font-size: 2rem;
                line-height: 110%;
                margin: 2.3733333333rem 0 1.424rem 0;
            }
        </style>

        <script>
            $(function() {

                $('#calendar').fullCalendar({

                    defaultView: 'agendaWeek',
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'agendaWeek,listMonth'
                    },

                    navLinks: false, // can click day/week names to navigate views
                    selectable: true,
                    selectHelper: true,
                    editable: false,
                    eventLimit: true,

                    events: [
                        <?php 
                        foreach ($resultado as $fila) {
                            ?> {
                            id: "<?php echo $fila['id']; ?>",
                            start: "<?php echo $fila['start']; ?>",
                            end: "<?php echo $fila['end']; ?>",
                            editable: "<?php echo $fila['editable']; ?>",
                            color: "<?php echo $fila['color']; ?>"
                        },
                        <?php

                    } // fin foreach
                    ?>
                    ], // fin events
                    select: function(date, end) {
                        var a = date.format('YYYY-MM-DD HH:mm')
                        var b = moment().format('YYYY-MM-DD HH:mm')
                        if (a < b) {
                            alert("Fecha incorrecta!");
                            $('#calendar').fullCalendar('unselect');
                        } else {
                            starttime = $.fullCalendar.moment(end).format('h:mm');
                            var Modalelem = document.querySelector('#a');
                            var instanceModal = M.Modal.init(Modalelem);
                            instanceModal.open();
                            $('#fecha').val(date.format('YYYY-MM-DD'));
                            $('#horainicial').val(date.format('HH:mm'));
                            $('#horafinal').val(end.format('HH:mm'));
                        }
                    },
                    eventClick: function(event, jsEvent, view) {
                        if (confirm("Esta seguro de eliminar el evento?")) {
                            var id = event.id;
                            var send = function() {
                                $.post("eliminar.php", {
                                    ide: id
                                }, function(response) {
                                    console.log(response);
                                });
                            }
                            send();
                            $('#calendar').fullCalendar('removeEvents', event.id);
                        }
                    },
                })
            });
        </script>
    </head>

    <body>

        <div class="container" style="margin-top:3%">
            <button class="waves-effect waves-light btn-small" type="button" name="action" onClick="mi_alerta()">eliminar
                <i class="material-icons right">delete</i>
            </button>
            <br><br>
            <div id="calendar"> </div>
            <br>
        </div>
        <div id="a" class="modal">
            <div class="modal-content">
                <h4>Seleccione las horas disponibles</h4>
                <p>
                    <form action="registrar.php" method="POST">
                        <label>Fecha</label>
                        <input type="text" id="fecha" name="fechap" />
                        <br><br>
                        <label>Hora inicial</label>
                        <input type="time" name="finicial" id="horainicial" />
                        <br><br>
                        <label>Hora final </label>
                        <input type="time" name="ffinal" id="horafinal" />
                        <br><br>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Guardar" class="btn btn-primary">
                </form>
                </p>
            </div>
        </div>
    </body>

    </html>
</body>

</html> 