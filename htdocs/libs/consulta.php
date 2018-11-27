<?php

	require_once "Sesion.php" ;
	require_once "Usuario.php" ;

	// Obtenemos una instancia de la sesión
	$ses = Sesion::iniciarSesion() ;
	
	$usuario = $ses->getUser() ;
  $idUsuario = $usuario->idUsuario;

	// Número de libros que quiero mostrar cada vez
	const MAX_REGISTROS = 6 ;

	// Conexión con la base de datos
	$lnk = new mysqli("sql111.epizy.com","epiz_23053888","JnGYBbA35hYECtp","epiz_23053888_libroteca")
			or	die("**Error de conexión: $lnk->connect_errno") ;

	// Seleccionamos el tipo de codificación de caracteres
	$lnk->set_charset("utf8") ;

	// Compruebo si la sesión está iniciada
  if ($ses->checkActiveSession()):

		// Obtenemos el parámetro necesario y lo guardo en una variable
		if (!isset($_GET["p"])) die("**Ha ocurrido un error en la consulta") ;
		
		$pag = $_GET["p"] ; 
		
		// Inicializamos la variable respuesta
		$respuesta = ["error" => false, "html" => ""] ;

		// Determinamos el punto de incio
		$ini = ($pag-1)*MAX_REGISTROS ;

		// Construimos la consulta SQL para devolver los libros
		$sql = "SELECT * FROM libro LIMIT $ini, ".MAX_REGISTROS."; " ;

		$res = $lnk->query($sql);

		if (($res->num_rows) > 0):
		$data = "" ;
			while($item = $res->fetch_object()):

				$idLibro = $item->idLibro;

				// consulta para saber el nombre del autor
				$consultaAutor = "SELECT * from autor where idAutor = '$item->idAutor'";
				$resultado = $lnk->query($consultaAutor);
				foreach ($resultado as $dato) {
					$nombreAutor = $dato["nombre"];
					
				}
				// consulta para saber el nombre de la editorial
				$consultaEditorial = "SELECT * from editorial where idEditorial = '$item->idEditorial'";
				$resultado = $lnk->query($consultaEditorial);
				foreach ($resultado as $dato) {
					$nombreEditorial = $dato["editorial"];
				}

				// consulta para saber los libros que están añadidos a favoritos
				$sqlFav = $lnk->query("SELECT * FROM favoritos WHERE idUsuario = '$idUsuario' AND idLibro = '$idLibro'");

				// Si el libro no está en favoritos, el botón podrá dirigir a la inserción
				// Si no, el botón tendrá otro aspecto y no hará nada al pinchar
				if ($sqlFav->num_rows <= 0):
					$etiqueta = "<a href=\"favoritos.php?libro=$idLibro\" class=\"waves-effect waves-light btn btn-nofav\">Añadir a favoritos</a>";
				else:
					$etiqueta = "<a class=\"waves-effect waves-light btn btn-fav\">Ya está añadido a favoritos</a>";
				endif ;

				// Guardo en la variable data todo el bloque HTML que quiero cargar con ajax y jquery (HEREDOC para guardar un bloque de HTML y PHP)
				$data.=
<<<EX

<div class="col s12 m7 tarjeta">
<h2 class="header" style="color:saddlebrown">{$item->titulo}</h2>
<div class="card horizontal">
	<div class="card-image">
		<img src="{$item->portada}">
	</div>
	<div class="card-stacked">
		<div class="card-content">
			<p>{$item->sinopsis}</p><br/>
			<p>Autor/a: <b>{$nombreAutor}</b></p>
			<p>Editorial: <b>{$nombreEditorial}</b></p>
			<p>ISBN: <b>{$item->isbn}</b></p>
			<p>Fecha de publicación: <b>{$item->fecha}</b></p>
		</div>
		<div class="card-action">{$etiqueta}</div>
	</div>
</div>
</div>
EX;

			endwhile ;

			$respuesta["html"] = $data ;

		else:

		$respuesta["error"] = true ;

		endif ;
		
		// Convierto la variable $respuesta a json ya que es el tipo de dato que recibo en inicio
		echo json_encode($respuesta) ;
	
	endif; // cierra el if de comprobar sesión