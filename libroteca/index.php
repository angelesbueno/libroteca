<?php

  require_once "libs/Database.php" ;
  require_once "libs/Sesion.php" ;

  // Obtenemos una instancia de la sesión
  $ses = Sesion::iniciarSesion() ;

  // Compruebo si ya hay una sesión activa. Si la hay, se redirige a inicio.
  // Si no hay una sesión iniciada, se muestra el formulario de login.
  if ($ses->checkActiveSession()):
    $ses->redirect("http://libroteca.epizy.com/inicio.php") ;
  endif;

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <!--Import css propio-->
  <link rel="stylesheet" href="css/style.css">
  <!--Favicon-->
  <link rel="shortcut icon" type="image/x-icon" href="css/img/favicon.ico">
  <title>L A · L I B R O T E C A</title>
</head>

<body class="body-index">

  <div class="wrapper">
    <!-- Formulario de login -->
    <div class="row">
      <form class="col s12" method="POST" action="inicio.php">
        <div class="row form-login">
          <div class="input-field col s6 form-login-div">
            <i class="material-icons prefix">account_circle</i>
            <input id="icon_prefix" type="text" class="validate" name="usr">
            <label for="icon_prefix">Nombre de usuario</label>
          </div>
          <br />
          <br />
          <br />
          <br />

          <div class="input-field col s6 form-login-div">
            <i class="material-icons prefix">vpn_key</i>
            <input id="icon_vpn_key" type="password" class="validate" name="pwd">
            <label for="icon_vpn_key">Contraseña</label>
          </div>
          <br />
          <br />
          <br />
          <div class="div-btn-submit">
					<button class="btn waves-effect waves-light btn-submit" type="submit" name="action">Entrar
						<i class="material-icons right">send</i>
					</button>
				</div>
          <!-- Enlace para registro -->
          <div class="form-login-div">¿Aún no eres miembro? Regístrate <a href="registro.php">aquí</a></div>
          <?php
            // Se muestra el mensaje si se ha registrado bien un usuario nuevo.
				    if (isset($_GET["exito"])):
					    echo "<p style=\"color: green\">El registro se ha producido correctamente</p>" ;
            endif ;
            // Se muestra el mensaje si, al intentar loguearnos, introducimos mal los datos.
            if (isset($_GET["fracaso"])):
					    echo "<p style=\"color: red\">Usuario y/o contraseña incorrecta</p>" ;
            endif ;
			    ?>
        </div>
      </form>
    </div>
  </div>
  <!--JavaScript at end of body for optimized loading-->
  <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>