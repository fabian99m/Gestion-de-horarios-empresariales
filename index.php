<?php
    require_once "config.php";
	if (isset($_SESSION['access_token'])) {
  
      $rol= $_SESSION['rol'];
	   if ($rol == "Coordinador") {
	  	header('Location: coordinador/index-admin.php');
		 exit();
  	 }  else {
		 header('Location: empleado/index-empleado.php');
		  exit();
	   }
	}
  $loginURL = $gClient->createAuthUrl();
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="shortcut icon" type=”assets/calendar.png” href=”/favicon.png”/>
  <title>Gestor de reuniones</title>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
 
  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">Gestor de Reuniones</h1>
        <div class="row center">
          <h5 class="header col s12 teal-text text-darken-1 ">Cambia la forma de crear y organizar tus reuniones! </h5>
        </div>
        <div class="row center ">
       <!--   <a href="#" id="download-button" class="btn btn-large teal modal-trigger"> <i class="large material-icons left">account_circle</i> Iniciar sesión con google</a>  -->
          <input type="button" onclick="window.location = '<?php echo $loginURL ?>';"  name="google" value="Iniciar sesión con Google" class="btn btn-primary">
         <br><br>
          <a class="header center teal-text text-lighten-2"href="https://accounts.google.com/signup/v2/webcreateaccount?flowName=GlifWebSignIn&flowEntry=SignUp" target="_blank">¿No tienes cuenta? , Registrarse en Google</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="assets/img1.jpg" alt="Unsplashed background img 1"></div>
  </div>
  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Uso ràpido</h5>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">group</i></h2>
            <h5 class="center">Crea y organiza tus reuniones!</h5>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Fàcil de usar</h5>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!--  Scripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/index.js"></script>
  </body>
</html>
