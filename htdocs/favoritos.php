<?php

  require_once "libs/Sesion.php" ;
  require_once "libs/Usuario.php" ;

  // Obtenemos una instancia de la sesión
  $ses = Sesion::iniciarSesion() ;

  // Conexi�n con la base de datos
	$lnk = new mysqli("sql111.epizy.com","epiz_23053888","JnGYBbA35hYECtp","epiz_23053888_libroteca")
  or	die("**Error de conexión: $lnk->connect_errno") ;

  // Seleccionamos el tipo de codificación de caracteres
  $lnk->set_charset("utf8") ;
  
	// Compruebo si la sesión está iniciada
  if ($ses->checkActiveSession()):

    $usuario = $ses->getUser() ;

    // idUsuario
    $idUsuario = $usuario->idUsuario;
    
    // idLibro
    $idLibro = $_GET["libro"];;

    // Se hace la inserción en la tabla favoritos y se redirige a inicio.php
    $insertFav = $lnk->query("INSERT INTO favoritos (idUsuario, idLibro) VALUES ('$idUsuario', '$idLibro');") ;
    $ses->redirect("http://libroteca.epizy.com/inicio.php") ;

  endif; // cierra el if de comprobar sesión
  $lnk->close(); // cierra la sesión con la base de datos