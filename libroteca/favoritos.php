<?php

  require_once "libs/Sesion.php" ;
  require_once "libs/Usuario.php" ;

  // Obtenemos una instancia de la sesi贸n
  $ses = Sesion::iniciarSesion() ;

  // Conexi髇 con la base de datos
	$lnk = new mysqli("sql111.epizy.com","epiz_23053888","JnGYBbA35hYECtp","epiz_23053888_libroteca")
  or	die("**Error de conexi贸n: $lnk->connect_errno") ;

  // Seleccionamos el tipo de codificaci贸n de caracteres
  $lnk->set_charset("utf8") ;
  
	// Compruebo si la sesi贸n est谩 iniciada
  if ($ses->checkActiveSession()):

    $usuario = $ses->getUser() ;

    // idUsuario
    $idUsuario = $usuario->idUsuario;
    
    // idLibro
    $idLibro = $_GET["libro"];;

    // Se hace la inserci贸n en la tabla favoritos y se redirige a inicio.php
    $insertFav = $lnk->query("INSERT INTO favoritos (idUsuario, idLibro) VALUES ('$idUsuario', '$idLibro');") ;
    $ses->redirect("http://libroteca.epizy.com/inicio.php") ;

  endif; // cierra el if de comprobar sesi贸n
  $lnk->close(); // cierra la sesi贸n con la base de datos