<?php

  require_once "libs/Database.php" ;
  require_once "libs/Sesion.php" ;
  require_once "libs/Usuario.php" ;

  // Obtenemos una instancia de la sesión
  $ses = Sesion::iniciarSesion() ;

	// Se comprueba si la sesión ya estaba iniciada o si se accede desde el formulario de login
  if (($ses->checkActiveSession()) || (!empty($_POST))):
    
    // Se declaran las variables tanto si vienen del formualario de login como si no
		$usr = $_POST["usr"]??"" ;
    $pwd = ($_POST["pwd"])??"" ;
    
    // Intento hacer el login mandando usuario y contraseña
		$log = $ses->doLogin($usr, $pwd) ;

    // Si se han introducido los datos correctamente, continúa el script y, si no, redirijo a index.php para que muestre un mensaje de error
		if (!$log):
    header("location:http://libroteca.epizy.com/?fracaso") ;
    endif ;

    $usuario = $ses->getUser() ;

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
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

      <script>
        // Paginado de los libros con ajax y jquery
        $(document).ready(function() {
          
          function getLibros() {

            // Obtenemos el número de página en el que estamos
            var pag = $("#contenido").data("page") + 1 ;

            // Guardamos el número de la próxima página
            $("#contenido").data("page", pag) ;
            
            $.ajax({
              method  : "GET",
              url     : "libs/consulta.php",
              dataType: "json",
              data    : { "p" : pag },
              success : function(data) {
          
                // Si hay resultados, los mostramos en la etiqueta con el id #contenido
                if (!data.error) $("#contenido").append(data.html) ;
                
              }
            }) ;
            
          } 
          // Al hacer click en el botón con el id #mas, se vuelve a llamar a la función getLibros
          $("#mas").click(function() { getLibros() ; }) ;
          getLibros() ;
        }) ;

      </script>
      
      <title>L A · L I B R O T E C A</title>
      </head>
      <body class="">
        <header class="header">
          <nav class="nav-extended">
            <div class="nav-wrapper nav-propia">
              <a href="index.php" class="brand-logo"><img class="logo" src="css/img/logo.png" alt="logo"></a>
              <ul class="nav-pags">
                <li class="tab"><a href="perfil.php" style="margin-right: 100px">Perfil</a></li>
                <li class="tab"><a class="active" href="verFavoritos.php">Favoritos</a></li>
              </ul>
              <ul id="nav-mobile" class="right hide-on-med-and-down nav-2">
                <li class="hola-usr">Hola, <?= $usuario->usuario ?></li>
                <li><a
                href="http://libroteca.epizy.com/logout.php">Cerrar sesión</a></li>
              </ul>
            </div>
          </nav>
        </header>
        <main>
          <div class="container container1">
            <!-- Aquí metemos con AJAX todos los libros -->
            <div id="contenido" class="row" data-page="0"></div>
            <!-- Botón para cargar más libros -->
            <a id="mas" class="waves-effect waves-light btn">Más libros</a>
				  </div>
        </main>
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

  else:
  // Si se intenta acceder a la página sin estar la sesión iniciada
  require_once("disconnect.php") ;
  endif; // cierra el if de comprobar sesión
  $lnk->close(); // cierro la conexión con la base de datos 
  ?>
