<?php

  require_once "libs/Sesion.php" ;
	// Obtenemos una instancia de la sesión
	$ses = Sesion::iniciarSesion() ;

	// Cierro la sesión
	$ses->close() ;
	
	// Una vez cerrada, se redirige al usuario al index
	$ses->redirect("http://libroteca.epizy.com/") ;

	
	

	

