<?php

require_once "libs/Sesion.php" ;
require_once "libs/Usuario.php" ;

// Obtenemos una instancia de la sesión
$ses = Sesion::iniciarSesion() ;

// Conexión con la base de datos
$lnk = new mysqli("sql111.epizy.com","epiz_23053888","JnGYBbA35hYECtp","epiz_23053888_libroteca")
or	die("**Error de conexión: $lnk->connect_errno") ;

// Seleccionamos el tipo de codificación de caracteres
$lnk->set_charset("utf8") ;

// Compruebo si la sesión está iniciada
if ($ses->checkActiveSession()):
  
  $usuario = $ses->getUser() ;

  // Meto en variables los datos que necesito. Solo cojo idUsuario de la sesión porque siempre será el mismo, lo que puedo modificar lo cojo con un SELECT para que se vaya actualizando.
  // Si cogiera todos los datos de la sesión, no se me actualizarían en el formualrio hasta que no reabriera la sesión
  $idUsuario = $usuario->idUsuario;
  $nombre = $_POST["nombre"];
  $apellidos = $_POST["apellidos"];
  $email = $_POST["email"];

  $sql = "UPDATE usuario SET nombre = '$nombre', apellidos = '$apellidos', email = '$email' WHERE idUsuario = '$idUsuario'";

  $updateUser = $lnk->query($sql) ;

  // Redirijo al perfil si ha habido éxito, si no, devuelvo a editarPerfil
  if ($updateUser):
    $ses->redirect("http://libroteca.epizy.com/perfil.php?updated") ;
  else:
    $ses->redirect("http://libroteca.epizy.com/editarPerfil.php?error") ;
  endif;

endif; // cierra if de comprobar sesión
$lnk->close(); // cierro la conexión con la base de datos