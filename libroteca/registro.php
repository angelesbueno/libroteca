<?php

	require_once "libs/Database.php" ;

	// Guardo los datos del formulario de registro de usuario (si los hubiere)
	$nom = $_POST["nom"]??"" ;
	$ape = $_POST["ape"]??"" ;
	$usr = $_POST["usr"]??"" ;
	$ema = $_POST["ema"]??"" ;

	// Si no hay géneros literarios elegidos el array $gen NO EXISTIRÁ
	$gen = isset($_POST["gen"])?$_POST["gen"]:null ; 

	// Conexión con la base de datos
	$lnk = new mysqli("sql111.epizy.com","epiz_23053888","JnGYBbA35hYECtp","epiz_23053888_libroteca")
			or	die("**Error de conexión: $lnk->connect_errno") ;

	// Seleccionamos el tipo de codificación de caracteres
	$lnk->set_charset("utf8") ;

	// Comprobamos ahora el valor del flag: si es FALSE tendremos que insertar en la base de datos la información que se
	// nos proporciona a través del formulario. En otro caso, mostramos el formulario de registro.
	if (isset($_POST["flag"]) && ($_POST["flag"]==="false")):

		// Guardamos la contraseña con formato md5
		$pwd = md5($_POST["pwd"]) ;

		// Construimos la sentencia SQL para insertar al usuario en la bbdd
		$sql = "INSERT INTO usuario
			    (usuario,password,email,nombre,apellidos) VALUES
					('$usr','$pwd','$ema','$nom','$ape');" ;
					//echo $sql;

		if($lnk->query($sql)):
			
			// Almacenar los géneros favoritos del usuario
			// Construir la consulta INSERT
			$sql = "INSERT INTO genero_usuario VALUES " ;

			foreach($gen as $item):
				$sql .= "($lnk->insert_id, $item)," ;
			endforeach ;
				
			// Lanzamos la consulta sobre el motor de BD y le quitamos la coma del final
			$sql = rtrim($sql, ',');
			if ($lnk->query($sql)):
				// Enviar un mensaje a la página principal indicando que
				// el registro se ha realizado con éxito.
				header("location:http://libroteca.epizy.com/?exito") ;
			else:
				$err = "Se ha producido un error en el registro." ;
				require_once("libs/formulario_registro.php") ;
			endif ;
			
		else :
			$err = "Se ha producido un error en el registro." ;
			require_once("libs/formulario_registro.php") ;
		endif ;

	else:

		// Accedemos por primera vez al formulario
		require_once("libs/formulario_registro.php") ;

	endif ;

	// 
	// Cerramos la conexión con el motor de bases de datos
	$lnk->close() ;
