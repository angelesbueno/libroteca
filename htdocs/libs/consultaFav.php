<?php

  require_once "Sesion.php" ;
  require_once "Usuario.php" ;

	// Obtenemos una instancia de la sesión
	$ses = Sesion::iniciarSesion() ;
	
	$usuario = $ses->getUser() ;
  $idUsuario = $usuario->idUsuario;

  // Número de libros favoritos que quiero mostrar cada vez
	const MAX_REGISTROS = 3 ;

	// Conexión con la base de datos
	$lnk = new mysqli("sql111.epizy.com","epiz_23053888","JnGYBbA35hYECtp","epiz_23053888_libroteca")
			or	die("**Error de conexión: $lnk->connect_errno") ;

	// Seleccionamos el tipo de codificación de caracteres
	$lnk->set_charset("utf8") ;

	// Compruebo si la sesión está iniciada
  if ($ses->checkActiveSession()):

		// Obtenemos el parámetro necesario
		if (!isset($_GET["p"])) die("**Ha ocurrido un error en la consulta") ;
		
    $pag = $_GET["p"] ; 
		
		// Inicializamos la variable respuesta
    $respuesta = ["error" => false, "html" => ""] ;

    // Determinamos el punto de incio
    $ini = ($pag-1)*MAX_REGISTROS ;

    $sql2 = "SELECT * FROM favoritos WHERE idUsuario = '$idUsuario' LIMIT $ini, ".MAX_REGISTROS.";";
 
    $libFav = $lnk->query($sql2);

    if ($libFav->num_rows > 0) :
      
      while($item = $libFav->fetch_object()):
        
        $idLib = $item->idLibro;

        // Obtengo todos los datos del libro solicitado
        $datosFav = "SELECT * FROM libro WHERE idLibro = '$idLib'";

        $resFav = $lnk->query($datosFav);

        if (($resFav->num_rows) > 0):
          $data2 = "" ;

          foreach ($resFav as $datoDef) {
            
            $idLibro = $datoDef["idLibro"];
            $idAutor = $datoDef["idAutor"];
            $idEditorial = $datoDef["idEditorial"];
            $titulo = $datoDef["titulo"];
            $portada = $datoDef["portada"];
            $sinopsis = $datoDef["sinopsis"];
            $isbn = $datoDef["isbn"];
            $fecha = $datoDef["fecha"];

            // consulta para saber el nombre del autor
            $consultaAutor = "SELECT * from autor where idAutor = '$idAutor'";
            $resultado = $lnk->query($consultaAutor);

            foreach ($resultado as $dato) {
              $nombreAutor = $dato["nombre"];
            }

            // consulta para saber el nombre de la editorial
            $consultaEditorial = "SELECT * from editorial where idEditorial = '$idEditorial'";
            $resultado = $lnk->query($consultaEditorial);

            foreach ($resultado as $dato) {
              $nombreEditorial = $dato["editorial"];
            }

            // Guardo en la variable data todo el bloque HTML que quiero cargar con ajax y jquery (HEREDOC para guardar un bloque de HTML y PHP)
            $data.=
<<<EX

<div class="col s12 m7 tarjeta">
<h2 class="header" style="color:saddlebrown">{$titulo}</h2>
<div class="card horizontal">
  <div class="card-image">
    <img src="{$portada}">
  </div>
  <div class="card-stacked">
    <div class="card-content">
      <p>{$sinopsis}</p><br/>
      <p>Autor/a: <b>{$nombreAutor}</b></p>
      <p>Editorial: <b>{$nombreEditorial}</b></p>
      <p>ISBN: <b>{$isbn}</b></p>
      <p>Fecha de publicación: <b>{$fecha}</b></p>
    </div>
      <div class="card-action"><a href="borrarFavorito.php?libro=$idLibro" class="waves-effect waves-light btn btn-nofav" style="background-color: #f32929!important">Eliminar de favoritos</a></div>
  </div>
</div>
</div>
EX;
          
          } // cierra foreach para sacar los datos de los libros

          $respuesta["html"] = $data ;

        else:
  
        $respuesta["error"] = true ;
  
        endif ; // obtener los datos de la tabla libro
        
        

      endwhile; // while obtener libros a partir de la id de la tabla favoritos
    endif; // cierra el if de tabla favoritos

    // Convierto la variable $respuesta a json ya que es el tipo de dato que recibo en favoritos
    echo json_encode($respuesta) ;

  endif; // cierra el if de comprobar sesión
  $lnk->close(); // cierra la conexión con la base de datos

		