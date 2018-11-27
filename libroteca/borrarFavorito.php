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

    // idUsuario
    $idUsuario = $usuario->idUsuario;
    
    // Recojo en una variable el idLibro enviado por el método GET desde verFavoritos.php
    $idLibro = $_GET["libro"];

    // Borro el libro de la lista de favoritos con el id proveniente de verFavoritos.php    
    $borrarFav = $lnk->query("DELETE FROM favoritos WHERE idUsuario = '$idUsuario' AND idLibro = '$idLibro'");
    $ses->redirect("verFavoritos.php?erased") ;

  endif; // cierra el if de comprobar sesión
  $lnk->close(); // cierra la sesión con la base de datos