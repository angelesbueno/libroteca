<?php

	require_once "libs/Database.php" ;
	require_once "libs/Usuario.php" ;
	require_once "libs/Sesion.php" ;

	// API KEY de Google Books
	const TOKEN = "AIzaSyA1rNwQeY82jsHyHxPheLnDl8frnbkaEtc" ;

	// Obtenemos una instancia de la sesión
	$ses = Sesion::iniciarSesion() ;

	// Conexión con la base de datos
	$lnk = new mysqli("sql111.epizy.com","epiz_23053888","JnGYBbA35hYECtp","epiz_23053888_libroteca") or	die("**Error de conexión: $lnk->connect_errno") ;

  // Seleccionamos el tipo de codificación de caracteres
	$lnk->set_charset("utf8") ;
	
	// Compruebo si la sesión está iniciada
	if ($ses->checkActiveSession()):

		// Realizamos la petición a la API para luego guardar los resultados en la base de datos.
		// Buscar 10 libros de la editorial planeta
		$book_url1 = "https://www.googleapis.com/books/v1/volumes?lr=lang_es&hl=es&tbo=p&tbm=bks&q=inpublisher:planeta&tbs=,bkt:b&num=10".TOKEN ;
		// LLamamos a la API y obtenemos una cadena de texto con el resultado.
		// Decodificamos la cadena de caracteres (en formato JSON) y obtenemos
		// un objeto -> array -> objetos
		$libros1 = json_decode(file_get_contents($book_url1)) ;

		// Buscar 10 libros de la editorial Penguin Random House
		$book_url2 = "https://www.googleapis.com/books/v1/volumes?hl=es&tbo=p&tbm=bks&q=inpublisher:penguin+inpublisher:random+inpublisher:house&tbs=,bkt:b&num=10&".TOKEN ;

		$libros2 = json_decode(file_get_contents($book_url2)) ;
			
		// Buscar 10 libros de la editorial Áltera
		$book_url3 = "https://www.googleapis.com/books/v1/volumes?hl=es&tbo=p&tbm=bks&q=inpublisher:altera&tbs=,bkt:b&num=10&".TOKEN ;

		$libros3 = json_decode(file_get_contents($book_url3)) ;

		// Buscar 10 libros de la editorial Espasa
		$book_url4 = "https://www.googleapis.com/books/v1/volumes?hl=es&tbo=p&tbm=bks&q=inpublisher:espasa&tbs=,bkt:b&num=10&".TOKEN ;

		$libros4 = json_decode(file_get_contents($book_url4)) ;
			
		// Buscar 10 libros de la editorial Malpaso
		$book_url5 = "https://www.googleapis.com/books/v1/volumes?lr=lang_es&hl=es&tbo=p&tbm=bks&q=inpublisher:malpaso&tbs=,bkt:b&num=10&".TOKEN ;

		$libros5 = json_decode(file_get_contents($book_url5)) ;
		

			
		// Extraemos la información que necesitamos y la almacenamos en variables
		$consulta = "";
		$idGB = "";
		$titulo = "";
		$isbn = "";
		$fecha = "";
		$sinopsis = "";
		$nota = "";
		$portada = "";
		$autor = "";
		$editorial = "";
		$genero = "";

		// Hago un foreach con cada consulta a la api para extraer los datos

		foreach ( $libros1->items as $dato ) {
			// Controlo el idioma de los libros para que salgan solo en español y con un solo autor
			if ((($dato->volumeInfo->language === 'es') || ($dato->volumeInfo->language === 'ES')) && (count($dato->volumeInfo->authors) <= 1)) {

				// Guardo el id de Google Books y el título del libro
				$idGB = $dato->id;
				$titulo = $dato->volumeInfo->title;

				// Si la api no proporciona editorial, la defino como "Otros"
				if (gettype($dato->volumeInfo->publisher) === 'NULL'):
					$editorial = "Otros";
				else:
					$editorial = $dato->volumeInfo->publisher;
				endif;
				
				// Si la api no proporciona autor, lo defino como "Desconocido"
				if (!empty($dato->volumeInfo->authors[0])):
					$autor = $dato->volumeInfo->authors[0];
				else:
					$autor = "Desconocido";
				endif;

				// Guardo el ISBN u otro sistema de identificación
				if ($dato->volumeInfo->industryIdentifiers[0]->type === 'ISBN_13') {
					$isbn = $dato->volumeInfo->industryIdentifiers[0]->identifier;
				} else if ($dato->volumeInfo->industryIdentifiers[0]->type === 'OTHER') {
					$isbn = $dato->volumeInfo->industryIdentifiers[0]->identifier;
				} else {
					$isbn = $dato->volumeInfo->industryIdentifiers[1]->identifier;
				}

				// Guardo la fecha de publicación y la sinopsis del libro
				$fecha = $dato->volumeInfo->publishedDate;
				$sinopsis = $dato->volumeInfo->description;

				// Controlo si la api proporciona imagen de portada o pongo una por defecto que he creado
				if (gettype($dato->volumeInfo->imageLinks) === 'NULL'):
					$portada = "css/img/portadano.png";
				else:
					$portada = $dato->volumeInfo->imageLinks->thumbnail;
				endif;
				
				// Guardo el género del libro. Si la api no proporciona género, establezco "Otros"
				$cat = $dato->volumeInfo->categories;

				if (gettype($cat) === 'array') {
					foreach ($cat as $datoCat) {
						$genero = $datoCat;
					}
				} else {
					$genero = "Otros";
				}

				/////////////// Comienzo la inserción en la base de datos ///////////////

				// Género en la tabla Género
				$resGenero = $lnk->query("SELECT * FROM genero WHERE genero = '$genero'");
				if ($resGenero->num_rows <= 0) {
					$sqlInGen = $lnk->query("INSERT INTO genero (genero) VALUES
						('$genero');") ;
				}

				// Editorial en la tabla Editorial
				$resEditorial = $lnk->query("SELECT * FROM editorial WHERE editorial = '$editorial'");
				if ($resEditorial->num_rows <= 0) {
					$sqlEditorial = $lnk->query("INSERT INTO editorial (editorial) VALUES
						('$editorial');") ;
				}

				// Una vez insertado, necesitamos el id de la Editorial para almacenarlo en la tabla libro
				$resIdEd = $lnk->query("SELECT * FROM editorial WHERE editorial = '$editorial'");
				foreach ($resIdEd as $dato) {
					$idEditorial = $dato["idEditorial"];
				}

				// Autor en la tabla Autor
				$resAutor = $lnk->query("SELECT * FROM autor WHERE nombre = '$autor'");
				if ($resAutor->num_rows <= 0) {
					$sqlAutor = $lnk->query("INSERT INTO autor (nombre) VALUES
						('$autor');") ;
				}

				// Una vez insertado, necesitamos el id del autor para almacenarlo en la tabla autor
				$resIdAu = $lnk->query("SELECT * FROM autor WHERE nombre = '$autor'");
				foreach ($resIdAu as $dato) {
					$idAutor = $dato["idAutor"];
				}

				// Libro en la tabla Libro
				$resTitulo = $lnk->query("SELECT * FROM libro WHERE titulo = '$titulo'");
				if ($resTitulo->num_rows <= 0) {
					$sqlTit = $lnk->query("INSERT INTO libro (idGB, titulo, isbn, fecha, idEditorial, idAutor, sinopsis, portada) VALUES
						('$idGB','$titulo','$isbn','$fecha','$idEditorial', '$idAutor', '$sinopsis', '$portada');") ;
				}

				// Una vez insertado el libro, necesitamos el id del libro para insertarlo en la tabla libro_autor
				$resIdLi = $lnk->query("SELECT * FROM libro WHERE titulo = '$titulo'");
				foreach ($resIdLi as $dato) {
					$idLibro = $dato["idLibro"];
				}

				// Libro+Autor en la tabla libro_autor
				$resLibAutor = $lnk->query("SELECT * FROM libro_autor WHERE idLibro = '$idLibro' AND idAutor = '$idAutor");
				if ($resLibAutor->num_rows <= 0) {
					$sqlLibAutor = $lnk->query("INSERT INTO libro_autor (idLibro, idAutor) VALUES
						('$idLibro','$idAutor');") ;
				}
			} // cierra if de idiomas
		} // cierra foreach de libros1

		foreach ( $libros2->items as $dato ) {
			// Controlo el idioma de los libros para que salgan solo en español y con un solo autor
			if ((($dato->volumeInfo->language === 'es') || ($dato->volumeInfo->language === 'ES')) && (count($dato->volumeInfo->authors) <= 1)) {

				// Guardo el id de Google Books y el título del libro
				$idGB = $dato->id;
				$titulo = $dato->volumeInfo->title;

				// Si la api no proporciona editorial, la defino como "Otros"
				if (gettype($dato->volumeInfo->publisher) === 'NULL'):
					$editorial = "Otros";
				else:
					$editorial = $dato->volumeInfo->publisher;
				endif;
				
				// Si la api no proporciona autor, lo defino como "Desconocido"
				if (!empty($dato->volumeInfo->authors[0])):
					$autor = $dato->volumeInfo->authors[0];
				else:
					$autor = "Desconocido";
				endif;

				// Guardo el ISBN u otro sistema de identificación
				if ($dato->volumeInfo->industryIdentifiers[0]->type === 'ISBN_13') {
					$isbn = $dato->volumeInfo->industryIdentifiers[0]->identifier;
				} else if ($dato->volumeInfo->industryIdentifiers[0]->type === 'OTHER') {
					$isbn = $dato->volumeInfo->industryIdentifiers[0]->identifier;
				} else {
					$isbn = $dato->volumeInfo->industryIdentifiers[1]->identifier;
				}

				// Guardo la fecha de publicación y la sinopsis del libro
				$fecha = $dato->volumeInfo->publishedDate;
				$sinopsis = $dato->volumeInfo->description;

				// Controlo si la api proporciona imagen de portada o pongo una por defecto que he creado
				if (gettype($dato->volumeInfo->imageLinks) === 'NULL'):
					$portada = "css/img/portadano.png";
				else:
					$portada = $dato->volumeInfo->imageLinks->thumbnail;
				endif;
				
				// Guardo el género del libro. Si la api no proporciona género, establezco "Otros"
				$cat = $dato->volumeInfo->categories;

				if (gettype($cat) === 'array') {
					foreach ($cat as $datoCat) {
						$genero = $datoCat;
					}
				} else {
					$genero = "Otros";
				}

				/////////////// Comienzo la inserción en la base de datos ///////////////

				// Género en la tabla Género
				$resGenero = $lnk->query("SELECT * FROM genero WHERE genero = '$genero'");
				if ($resGenero->num_rows <= 0) {
					$sqlInGen = $lnk->query("INSERT INTO genero (genero) VALUES
						('$genero');") ;
				}

				// Editorial en la tabla Editorial
				$resEditorial = $lnk->query("SELECT * FROM editorial WHERE editorial = '$editorial'");
				if ($resEditorial->num_rows <= 0) {
					$sqlEditorial = $lnk->query("INSERT INTO editorial (editorial) VALUES
						('$editorial');") ;
				}

				// Una vez insertado, necesitamos el id de la Editorial para almacenarlo en la tabla libro
				$resIdEd = $lnk->query("SELECT * FROM editorial WHERE editorial = '$editorial'");
				foreach ($resIdEd as $dato) {
					$idEditorial = $dato["idEditorial"];
				}

				// Autor en la tabla Autor
				$resAutor = $lnk->query("SELECT * FROM autor WHERE nombre = '$autor'");
				if ($resAutor->num_rows <= 0) {
					$sqlAutor = $lnk->query("INSERT INTO autor (nombre) VALUES
						('$autor');") ;
				}

				// Una vez insertado, necesitamos el id del autor para almacenarlo en la tabla autor
				$resIdAu = $lnk->query("SELECT * FROM autor WHERE nombre = '$autor'");
				foreach ($resIdAu as $dato) {
					$idAutor = $dato["idAutor"];
				}

				// Libro en la tabla Libro
				$resTitulo = $lnk->query("SELECT * FROM libro WHERE titulo = '$titulo'");
				if ($resTitulo->num_rows <= 0) {
					$sqlTit = $lnk->query("INSERT INTO libro (idGB, titulo, isbn, fecha, idEditorial, idAutor, sinopsis, portada) VALUES
						('$idGB','$titulo','$isbn','$fecha','$idEditorial', '$idAutor', '$sinopsis', '$portada');") ;
				}

				// Una vez insertado el libro, necesitamos el id del libro para insertarlo en la tabla libro_autor
				$resIdLi = $lnk->query("SELECT * FROM libro WHERE titulo = '$titulo'");
				foreach ($resIdLi as $dato) {
					$idLibro = $dato["idLibro"];
				}

				// Libro+Autor en la tabla libro_autor
				$resLibAutor = $lnk->query("SELECT * FROM libro_autor WHERE idLibro = '$idLibro' AND idAutor = '$idAutor");
				if ($resLibAutor->num_rows <= 0) {
					$sqlLibAutor = $lnk->query("INSERT INTO libro_autor (idLibro, idAutor) VALUES
						('$idLibro','$idAutor');") ;
				}
			} // cierra if de idiomas
		} // cierra foreach de libros2

		foreach ( $libros3->items as $dato ) {
			// Controlo el idioma de los libros para que salgan solo en español y con un solo autor
			if ((($dato->volumeInfo->language === 'es') || ($dato->volumeInfo->language === 'ES')) && (count($dato->volumeInfo->authors) <= 1)) {

				// Guardo el id de Google Books y el título del libro
				$idGB = $dato->id;
				$titulo = $dato->volumeInfo->title;

				// Si la api no proporciona editorial, la defino como "Otros"
				if (gettype($dato->volumeInfo->publisher) === 'NULL'):
					$editorial = "Otros";
				else:
					$editorial = $dato->volumeInfo->publisher;
				endif;
				
				// Si la api no proporciona autor, lo defino como "Desconocido"
				if (!empty($dato->volumeInfo->authors[0])):
					$autor = $dato->volumeInfo->authors[0];
				else:
					$autor = "Desconocido";
				endif;

				// Guardo el ISBN u otro sistema de identificación
				if ($dato->volumeInfo->industryIdentifiers[0]->type === 'ISBN_13') {
					$isbn = $dato->volumeInfo->industryIdentifiers[0]->identifier;
				} else if ($dato->volumeInfo->industryIdentifiers[0]->type === 'OTHER') {
					$isbn = $dato->volumeInfo->industryIdentifiers[0]->identifier;
				} else {
					$isbn = $dato->volumeInfo->industryIdentifiers[1]->identifier;
				}

				// Guardo la fecha de publicación y la sinopsis del libro
				$fecha = $dato->volumeInfo->publishedDate;
				$sinopsis = $dato->volumeInfo->description;

				// Controlo si la api proporciona imagen de portada o pongo una por defecto que he creado
				if (gettype($dato->volumeInfo->imageLinks) === 'NULL'):
					$portada = "css/img/portadano.png";
				else:
					$portada = $dato->volumeInfo->imageLinks->thumbnail;
				endif;
				
				// Guardo el género del libro. Si la api no proporciona género, establezco "Otros"
				$cat = $dato->volumeInfo->categories;

				if (gettype($cat) === 'array') {
					foreach ($cat as $datoCat) {
						$genero = $datoCat;
					}
				} else {
					$genero = "Otros";
				}

				/////////////// Comienzo la inserción en la base de datos ///////////////

				// Género en la tabla Género
				$resGenero = $lnk->query("SELECT * FROM genero WHERE genero = '$genero'");
				if ($resGenero->num_rows <= 0) {
					$sqlInGen = $lnk->query("INSERT INTO genero (genero) VALUES
						('$genero');") ;
				}

				// Editorial en la tabla Editorial
				$resEditorial = $lnk->query("SELECT * FROM editorial WHERE editorial = '$editorial'");
				if ($resEditorial->num_rows <= 0) {
					$sqlEditorial = $lnk->query("INSERT INTO editorial (editorial) VALUES
						('$editorial');") ;
				}

				// Una vez insertado, necesitamos el id de la Editorial para almacenarlo en la tabla libro
				$resIdEd = $lnk->query("SELECT * FROM editorial WHERE editorial = '$editorial'");
				foreach ($resIdEd as $dato) {
					$idEditorial = $dato["idEditorial"];
				}

				// Autor en la tabla Autor
				$resAutor = $lnk->query("SELECT * FROM autor WHERE nombre = '$autor'");
				if ($resAutor->num_rows <= 0) {
					$sqlAutor = $lnk->query("INSERT INTO autor (nombre) VALUES
						('$autor');") ;
				}

				// Una vez insertado, necesitamos el id del autor para almacenarlo en la tabla autor
				$resIdAu = $lnk->query("SELECT * FROM autor WHERE nombre = '$autor'");
				foreach ($resIdAu as $dato) {
					$idAutor = $dato["idAutor"];
				}

				// Libro en la tabla Libro
				$resTitulo = $lnk->query("SELECT * FROM libro WHERE titulo = '$titulo'");
				if ($resTitulo->num_rows <= 0) {
					$sqlTit = $lnk->query("INSERT INTO libro (idGB, titulo, isbn, fecha, idEditorial, idAutor, sinopsis, portada) VALUES
						('$idGB','$titulo','$isbn','$fecha','$idEditorial', '$idAutor', '$sinopsis', '$portada');") ;
				}

				// Una vez insertado el libro, necesitamos el id del libro para insertarlo en la tabla libro_autor
				$resIdLi = $lnk->query("SELECT * FROM libro WHERE titulo = '$titulo'");
				foreach ($resIdLi as $dato) {
					$idLibro = $dato["idLibro"];
				}

				// Libro+Autor en la tabla libro_autor
				$resLibAutor = $lnk->query("SELECT * FROM libro_autor WHERE idLibro = '$idLibro' AND idAutor = '$idAutor");
				if ($resLibAutor->num_rows <= 0) {
					$sqlLibAutor = $lnk->query("INSERT INTO libro_autor (idLibro, idAutor) VALUES
						('$idLibro','$idAutor');") ;
				}
			} // cierra if de idiomas
		} // cierra foreach de libros3

		foreach ( $libros4->items as $dato ) {
			// Controlo el idioma de los libros para que salgan solo en español y con un solo autor
			if ((($dato->volumeInfo->language === 'es') || ($dato->volumeInfo->language === 'ES')) && (count($dato->volumeInfo->authors) <= 1)) {

				// Guardo el id de Google Books y el título del libro
				$idGB = $dato->id;
				$titulo = $dato->volumeInfo->title;

				// Si la api no proporciona editorial, la defino como "Otros"
				if (gettype($dato->volumeInfo->publisher) === 'NULL'):
					$editorial = "Otros";
				else:
					$editorial = $dato->volumeInfo->publisher;
				endif;
				
				// Si la api no proporciona autor, lo defino como "Desconocido"
				if (!empty($dato->volumeInfo->authors[0])):
					$autor = $dato->volumeInfo->authors[0];
				else:
					$autor = "Desconocido";
				endif;

				// Guardo el ISBN u otro sistema de identificación
				if ($dato->volumeInfo->industryIdentifiers[0]->type === 'ISBN_13') {
					$isbn = $dato->volumeInfo->industryIdentifiers[0]->identifier;
				} else if ($dato->volumeInfo->industryIdentifiers[0]->type === 'OTHER') {
					$isbn = $dato->volumeInfo->industryIdentifiers[0]->identifier;
				} else {
					$isbn = $dato->volumeInfo->industryIdentifiers[1]->identifier;
				}

				// Guardo la fecha de publicación y la sinopsis del libro
				$fecha = $dato->volumeInfo->publishedDate;
				$sinopsis = $dato->volumeInfo->description;

				// Controlo si la api proporciona imagen de portada o pongo una por defecto que he creado
				if (gettype($dato->volumeInfo->imageLinks) === 'NULL'):
					$portada = "css/img/portadano.png";
				else:
					$portada = $dato->volumeInfo->imageLinks->thumbnail;
				endif;
				
				// Guardo el género del libro. Si la api no proporciona género, establezco "Otros"
				$cat = $dato->volumeInfo->categories;

				if (gettype($cat) === 'array') {
					foreach ($cat as $datoCat) {
						$genero = $datoCat;
					}
				} else {
					$genero = "Otros";
				}

				/////////////// Comienzo la inserción en la base de datos ///////////////

				// Género en la tabla Género
				$resGenero = $lnk->query("SELECT * FROM genero WHERE genero = '$genero'");
				if ($resGenero->num_rows <= 0) {
					$sqlInGen = $lnk->query("INSERT INTO genero (genero) VALUES
						('$genero');") ;
				}

				// Editorial en la tabla Editorial
				$resEditorial = $lnk->query("SELECT * FROM editorial WHERE editorial = '$editorial'");
				if ($resEditorial->num_rows <= 0) {
					$sqlEditorial = $lnk->query("INSERT INTO editorial (editorial) VALUES
						('$editorial');") ;
				}

				// Una vez insertado, necesitamos el id de la Editorial para almacenarlo en la tabla libro
				$resIdEd = $lnk->query("SELECT * FROM editorial WHERE editorial = '$editorial'");
				foreach ($resIdEd as $dato) {
					$idEditorial = $dato["idEditorial"];
				}

				// Autor en la tabla Autor
				$resAutor = $lnk->query("SELECT * FROM autor WHERE nombre = '$autor'");
				if ($resAutor->num_rows <= 0) {
					$sqlAutor = $lnk->query("INSERT INTO autor (nombre) VALUES
						('$autor');") ;
				}

				// Una vez insertado, necesitamos el id del autor para almacenarlo en la tabla autor
				$resIdAu = $lnk->query("SELECT * FROM autor WHERE nombre = '$autor'");
				foreach ($resIdAu as $dato) {
					$idAutor = $dato["idAutor"];
				}

				// Libro en la tabla Libro
				$resTitulo = $lnk->query("SELECT * FROM libro WHERE titulo = '$titulo'");
				if ($resTitulo->num_rows <= 0) {
					$sqlTit = $lnk->query("INSERT INTO libro (idGB, titulo, isbn, fecha, idEditorial, idAutor, sinopsis, portada) VALUES
						('$idGB','$titulo','$isbn','$fecha','$idEditorial', '$idAutor', '$sinopsis', '$portada');") ;
				}

				// Una vez insertado el libro, necesitamos el id del libro para insertarlo en la tabla libro_autor
				$resIdLi = $lnk->query("SELECT * FROM libro WHERE titulo = '$titulo'");
				foreach ($resIdLi as $dato) {
					$idLibro = $dato["idLibro"];
				}

				// Libro+Autor en la tabla libro_autor
				$resLibAutor = $lnk->query("SELECT * FROM libro_autor WHERE idLibro = '$idLibro' AND idAutor = '$idAutor");
				if ($resLibAutor->num_rows <= 0) {
					$sqlLibAutor = $lnk->query("INSERT INTO libro_autor (idLibro, idAutor) VALUES
						('$idLibro','$idAutor');") ;
				}
			} // cierra if de idiomas
		} // cierra foreach de libros4

		foreach ( $libros5->items as $dato ) {
			// Controlo el idioma de los libros para que salgan solo en español y con un solo autor
			if ((($dato->volumeInfo->language === 'es') || ($dato->volumeInfo->language === 'ES')) && (count($dato->volumeInfo->authors) <= 1)) {

				// Guardo el id de Google Books y el título del libro
				$idGB = $dato->id;
				$titulo = $dato->volumeInfo->title;

				// Si la api no proporciona editorial, la defino como "Otros"
				if (gettype($dato->volumeInfo->publisher) === 'NULL'):
					$editorial = "Otros";
				else:
					$editorial = $dato->volumeInfo->publisher;
				endif;
				
				// Si la api no proporciona autor, lo defino como "Desconocido"
				if (!empty($dato->volumeInfo->authors[0])):
					$autor = $dato->volumeInfo->authors[0];
				else:
					$autor = "Desconocido";
				endif;

				// Guardo el ISBN u otro sistema de identificación
				if ($dato->volumeInfo->industryIdentifiers[0]->type === 'ISBN_13') {
					$isbn = $dato->volumeInfo->industryIdentifiers[0]->identifier;
				} else if ($dato->volumeInfo->industryIdentifiers[0]->type === 'OTHER') {
					$isbn = $dato->volumeInfo->industryIdentifiers[0]->identifier;
				} else {
					$isbn = $dato->volumeInfo->industryIdentifiers[1]->identifier;
				}

				// Guardo la fecha de publicación y la sinopsis del libro
				$fecha = $dato->volumeInfo->publishedDate;
				$sinopsis = $dato->volumeInfo->description;

				// Controlo si la api proporciona imagen de portada o pongo una por defecto que he creado
				if (gettype($dato->volumeInfo->imageLinks) === 'NULL'):
					$portada = "css/img/portadano.png";
				else:
					$portada = $dato->volumeInfo->imageLinks->thumbnail;
				endif;
				
				// Guardo el género del libro. Si la api no proporciona género, establezco "Otros"
				$cat = $dato->volumeInfo->categories;

				if (gettype($cat) === 'array') {
					foreach ($cat as $datoCat) {
						$genero = $datoCat;
					}
				} else {
					$genero = "Otros";
				}

				/////////////// Comienzo la inserción en la base de datos ///////////////

				// Género en la tabla Género
				$resGenero = $lnk->query("SELECT * FROM genero WHERE genero = '$genero'");
				if ($resGenero->num_rows <= 0) {
					$sqlInGen = $lnk->query("INSERT INTO genero (genero) VALUES
						('$genero');") ;
				}

				// Editorial en la tabla Editorial
				$resEditorial = $lnk->query("SELECT * FROM editorial WHERE editorial = '$editorial'");
				if ($resEditorial->num_rows <= 0) {
					$sqlEditorial = $lnk->query("INSERT INTO editorial (editorial) VALUES
						('$editorial');") ;
				}

				// Una vez insertado, necesitamos el id de la Editorial para almacenarlo en la tabla libro
				$resIdEd = $lnk->query("SELECT * FROM editorial WHERE editorial = '$editorial'");
				foreach ($resIdEd as $dato) {
					$idEditorial = $dato["idEditorial"];
				}

				// Autor en la tabla Autor
				$resAutor = $lnk->query("SELECT * FROM autor WHERE nombre = '$autor'");
				if ($resAutor->num_rows <= 0) {
					$sqlAutor = $lnk->query("INSERT INTO autor (nombre) VALUES
						('$autor');") ;
				}

				// Una vez insertado, necesitamos el id del autor para almacenarlo en la tabla autor
				$resIdAu = $lnk->query("SELECT * FROM autor WHERE nombre = '$autor'");
				foreach ($resIdAu as $dato) {
					$idAutor = $dato["idAutor"];
				}

				// Libro en la tabla Libro
				$resTitulo = $lnk->query("SELECT * FROM libro WHERE titulo = '$titulo'");
				if ($resTitulo->num_rows <= 0) {
					$sqlTit = $lnk->query("INSERT INTO libro (idGB, titulo, isbn, fecha, idEditorial, idAutor, sinopsis, portada) VALUES
						('$idGB','$titulo','$isbn','$fecha','$idEditorial', '$idAutor', '$sinopsis', '$portada');") ;
				}

				// Una vez insertado el libro, necesitamos el id del libro para insertarlo en la tabla libro_autor
				$resIdLi = $lnk->query("SELECT * FROM libro WHERE titulo = '$titulo'");
				foreach ($resIdLi as $dato) {
					$idLibro = $dato["idLibro"];
				}

				// Libro+Autor en la tabla libro_autor
				$resLibAutor = $lnk->query("SELECT * FROM libro_autor WHERE idLibro = '$idLibro' AND idAutor = '$idAutor");
				if ($resLibAutor->num_rows <= 0) {
					$sqlLibAutor = $lnk->query("INSERT INTO libro_autor (idLibro, idAutor) VALUES
						('$idLibro','$idAutor');") ;
				}
			} // cierra if de idiomas
		} // cierra foreach de libros5

endif; // cierra if de comprobar sesión
$lnk->close(); // cierro la conexión con la base de datos 