<?php

require_once "libs/Sesion.php" ;
require_once "libs/Usuario.php" ;

// Obtenemos una instancia de la sesión
$ses = Sesion::iniciarSesion() ;

// Método orientado a objetos
$lnk = new mysqli("sql111.epizy.com","epiz_23053888","JnGYBbA35hYECtp","epiz_23053888_libroteca")
or	die("**Error de conexión: $lnk->connect_errno") ;

// Seleccionamos el tipo de codificación de caracteres
$lnk->set_charset("utf8") ;

// Compruebo si la sesión está iniciada
if ($ses->checkActiveSession()):

  $usuario = $ses->getUser() ;

  $idUsuario = $usuario->idUsuario; 

  // Lanzo la consulta para meter en variables aquello que el usuario podrá modificar de su perfil
  $sql = $lnk->query("SELECT * FROM usuario WHERE idUsuario = '$idUsuario'");

  $usuarioArray = mysqli_fetch_assoc($sql);

  $userName = $usuarioArray["usuario"];
  $nombre = $usuarioArray["nombre"];
  $apellidos = $usuarioArray["apellidos"];
  $email = $usuarioArray["email"];

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
    <body class="">
        <header class="header">
          <nav class="nav-extended">
            <div class="nav-wrapper nav-propia">
              <a href="http://libroteca.epizy.com/" class="brand-logo"><img class="logo" src="css/img/logo.png" alt="logo"></a>
              <ul class="nav-pags">
                <li class="tab"><a href="perfil.php" style="margin-right: 100px">Perfil</a></li>
                <li class="tab"><a class="active" href="verFavoritos.php">Favoritos</a></li>
              </ul>
              <ul id="nav-mobile" class="right hide-on-med-and-down nav-2">
                <li class="hola-usr">Hola, <?= $userName ?></li>
                <li><a
                href="http://libroteca.epizy.com/logout.php">Cerrar sesión</a></li>
              </ul>
            </div>
          </nav>
        </header>
        <div class="container" style="flex: 1 0 auto">
          <div class="col s6 m7">
            <h2 class="header" style="text-align:center; color:saddlebrown">Datos personales</h2>
            <div class="card horizontal">
              <div class="card-image" style="width: 28.5%">
                <img src="css/img/editar.png" style="margin: 0 auto">
              </div>
              <div class="card-stacked">
                <div class="card-content">
                  <p>Usuario: <b><?= $userName ?></b></p>
                  <p>Nombre: <b><?= $nombre ?></b></p>
                  <p>Apellidos: <b><?= $apellidos ?></b></p>
                  <p>Email: <b><?= $email ?></b></p>
                </div>
                <div class="card-action">
                <a href="editarPerfil.php" class="waves-effect waves-light btn-small btn btn-fav" style="margin-right: 25px; cursor: pointer"><i class="material-icons right">edit</i>Editar</a>
                <a href="index.php" class="waves-effect waves-light btn-small btn btn-fav" style="margin-right: 25px; cursor: pointer"><i class="material-icons right">keyboard_arrow_left</i>Volver</a>
                <br/>
                <br/>
                <?php
                  // Se muestra un mensaje de éxito al modificar algún dato del usuario
                  if (isset($_GET["updated"])):
                    echo "<p style=\"color: green\">El registro se ha modificado correctamente</p>" ;
                  endif ;
                ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="page-footer footer-propio">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Ángeles Bueno Aguilar</h5>
                <p class="grey-text text-lighten-4">2º DAW IES Campanillas</p>
              </div>
            </div>
          </div>
        </footer>
      </body>
    </html>

<?php

else: // si la sesión no está activa
// Si se intenta acceder a la página sin estar la sesión iniciada
require_once("disconnect.php") ;

endif; // cierra el if de comprobar sesión
$lnk->close(); // cierro la conexión con la base de datos 
?>