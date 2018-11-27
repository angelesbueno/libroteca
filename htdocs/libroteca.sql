-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 22, 2018 at 12:07 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libroteca`
--

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--

CREATE TABLE `autor` (
  `idAutor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL DEFAULT 'Desconocido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`idAutor`, `nombre`) VALUES
(175, 'Accerto'),
(176, 'Rosa María Cifuentes Castañeda'),
(177, 'Gérard Bertolini'),
(178, 'Ale Velasco'),
(179, 'Adriana Esteva'),
(180, 'Ángela Posada Swafford'),
(181, 'Luis Spota'),
(182, 'Manuel Leguineche'),
(183, 'Lila Ochoa'),
(184, 'Miguel de Cervantes Saavedra'),
(185, 'Carlos Silveyra'),
(186, 'Sandro Romero Rey'),
(187, 'Germán Espinosa Villareal'),
(188, 'Patricio Jara'),
(189, 'autores Varios'),
(190, 'Confucio'),
(191, 'Federico Quevedo'),
(192, 'Javier Ruiz Portella'),
(193, 'Isabel Abad'),
(194, 'Andrés Ruiz Cubero'),
(195, 'Francisco Alarcón'),
(196, 'Adolfo Caballero'),
(197, 'Estefanía Cordero-Sánchez Lara'),
(198, 'Francisco Barreiro'),
(199, 'Sergio López Juncos'),
(200, 'María Betancor'),
(201, 'Desconocido'),
(202, 'Julio Sánchez Cristo'),
(203, 'Philippe Castellano'),
(204, 'Juan Cortada'),
(205, 'Luis de Lezama'),
(206, 'Martín Casariego'),
(207, 'Espasa Calpe'),
(208, 'Antonio Soler'),
(209, 'Malcolm Lowry'),
(210, 'Neil Gaiman'),
(211, 'Philip Norman'),
(212, 'Joshua Lund'),
(213, 'Manuel Vilas'),
(214, 'Martin Amis'),
(215, 'Kingsley Amis'),
(216, 'Gabriela Wiener'),
(217, 'Négar Djavadi'),
(218, 'Pablo Aranda');

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE `comentario` (
  `idComentario` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idLibro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `editorial`
--

CREATE TABLE `editorial` (
  `idEditorial` int(11) NOT NULL,
  `editorial` varchar(100) NOT NULL DEFAULT 'Otros'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `editorial`
--

INSERT INTO `editorial` (`idEditorial`, `editorial`) VALUES
(52, 'Grupo Planeta Spain'),
(53, 'Planeta Publishing Corporation'),
(54, 'Otros'),
(55, 'ALFAGUARA I.'),
(56, 'ALFAGUARA'),
(57, 'TAURUS'),
(58, 'ALTEA'),
(59, 'AGUILAR'),
(60, 'B DE BOOKS'),
(61, 'Altera'),
(62, 'Espasa Calpe Mexicana, S.A.'),
(63, 'Editorial Planeta Mexicana Sa De cv'),
(64, 'Malpaso Ediciones SL');

-- --------------------------------------------------------

--
-- Table structure for table `favoritos`
--

CREATE TABLE `favoritos` (
  `idUsuario` int(11) NOT NULL,
  `idLibro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favoritos`
--

INSERT INTO `favoritos` (`idUsuario`, `idLibro`) VALUES
(32, 184),
(34, 184),
(32, 185),
(34, 185),
(32, 186),
(32, 187),
(32, 188),
(34, 188),
(32, 189),
(33, 189);

-- --------------------------------------------------------

--
-- Table structure for table `genero`
--

CREATE TABLE `genero` (
  `idGenero` int(11) NOT NULL,
  `genero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genero`
--

INSERT INTO `genero` (`idGenero`, `genero`) VALUES
(93, 'Business & Economics'),
(94, 'Foreign Language Study'),
(95, 'Soccer'),
(96, 'Otros'),
(97, 'Self-Help'),
(98, 'Fiction'),
(99, 'Juvenile Nonfiction'),
(100, 'Biography & Autobiography'),
(101, 'Presidents'),
(102, 'Erotic poetry, Spanish American'),
(103, 'Poetry'),
(104, 'Biography'),
(105, 'Reference'),
(106, 'Bullfighters'),
(107, 'Language Arts & Disciplines'),
(108, 'Spanish fiction'),
(109, 'Literatura española - Novela - Siglo XX'),
(110, 'History'),
(111, 'Literary Collections'),
(112, 'Political Science'),
(113, 'Social Science'),
(114, 'Music'),
(115, 'Cooking'),
(116, 'Family & Relationships'),
(117, 'Crafts & Hobbies'),
(118, 'Religion'),
(119, 'Erotic poetry, Spanish');

-- --------------------------------------------------------

--
-- Table structure for table `genero_usuario`
--

CREATE TABLE `genero_usuario` (
  `idUsuario` int(11) NOT NULL,
  `idGenero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genero_usuario`
--

INSERT INTO `genero_usuario` (`idUsuario`, `idGenero`) VALUES
(34, 97),
(32, 98),
(34, 98),
(33, 99),
(32, 100),
(34, 102),
(33, 103),
(32, 104),
(32, 108),
(33, 108),
(34, 108),
(34, 109),
(33, 110),
(34, 110),
(34, 111),
(32, 114),
(34, 114),
(34, 117),
(34, 119);

-- --------------------------------------------------------

--
-- Table structure for table `libro`
--

CREATE TABLE `libro` (
  `idLibro` int(11) NOT NULL,
  `idGB` varchar(50) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `idEditorial` int(11) NOT NULL,
  `idAutor` int(11) NOT NULL,
  `sinopsis` text NOT NULL,
  `nota` tinyint(4) NOT NULL DEFAULT '0',
  `portada` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `libro`
--

INSERT INTO `libro` (`idLibro`, `idGB`, `titulo`, `isbn`, `fecha`, `idEditorial`, `idAutor`, `sinopsis`, `nota`, `portada`) VALUES
(184, 'MsjPAgAAQBAJ', 'Trabajo en equipo', '9788490630068', '2014-02-18', 52, 175, 'A diferencia de las máquinas, las personas pueden aumentar considerablemente el rendimiento de su trabajo al integrarse dentro de un equipo que funcione. En este curso se explica cómo se CREAN, se GESTIONAN y se INTEGRAN estos equipos en las organizaciones y empresas, a la vez que se analiza cómo las ventajas del trabajo en equipo supera con creces las dificultades asociadas a su gestión.', 0, 'http://books.google.com/books/content?id=MsjPAgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(185, 'e_GsCQAAQBAJ', 'Cómo aman ellos', '9786124650277', '2015-05-20', 52, 176, 'Las formas en que aman los hombres dependen de la relación que tienen o tuvieron con su madre, de sus conocimientos innatos, del modo de asumir sus lesiones emocionales, del peso que brindan al entorno social que los rodea, de su nivel cultural y de los valores que los motivan. ¿Acaso todos ellos tienen una forma de amar específica o la varían según la mujer que eligen? Cómo aman ellos es el espejo de lo que habita en el sentimiento interior de cada varón. Un espejo reflejado en la experiencia profesional e investigaciones de la autora. Una obra que debe ser leída por todos los hombres, porque nunca es tarde para encararse, reconocerse y aprender que el amor es un compromiso emocional, una decisión. Y por todas las mujeres, para que puedan identificar... Cómo aman ellos.', 0, 'http://books.google.com/books/content?id=e_GsCQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(186, 'fxpXAgAAQBAJ', 'El reciclaje a tu alcance', '9788497547246', '2013-11-07', 52, 177, 'Adoptar gestos sencillos y concretos en tu forma de vida diaria permitirá proteger el planeta. Es urgente actuar. ¡Juntos podemos hacerlo! ¿Sabías que un chicle necesita 5 años para degradarse? ¿Y que una lata de aluminio necesita de 200 a 500 años? ¿Quieres saber qué les sucede a los tetrabriks de leche, al pañuelo de papel, a las mondaduras de las frutas o a las bolsas de plástico después de usarlos? Tirar cosas es inevitable, pero no de cualquier manera, ya que puede perjudicar al medio ambiente y además se echan a perder materias primas. Si cambias de hábitos, te dedicas a seleccionar residuos y reflexionas sobre tu modo de consumir, descubrirás que tienes en tus manos el destino de nuestro planeta. ¡La Tierra se sentirá mejor! Este libro te propone descubrir el reciclaje.', 0, 'http://books.google.com/books/content?id=fxpXAgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(187, 'SpTgAgAAQBAJ', 'No mas bullying!', '9789584237903', '2014-02-17', 52, 178, '¡No más bullying! es un libro útil para prevenir y dar soluciones al problema del acoso escolar, también conocido como bullying, que se vive hoy en la sociedad y que preocupa a padres de familia, profesores y alumnos. En este libro, Ale Velasco hace propuestas de comunicación que darán herramientas no solo a los educadores para poner límites a los alumnos, sino a los padres de familia para establecer normas en el hogar con el fin de detener la violencia en las aulas y en el ámbito escolar. El bullying es un trastorno de conducta que impide a los niños distinguir entre el respeto ajeno y el propio. La sociedad en su conjunto debe comprender que si no frenamos a estos niños crueles ahora, ellos se convertirán en los adultos delincuentes del mañana o en los padres golpeadores del futuro. De ahí la importancia de difundir este tema, de saber cómo enfrentarlo y superarlo de manera definitiva.', 0, 'http://books.google.com/books/content?id=SpTgAgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(188, 'WknSCQAAQBAJ', 'En la comida como en la vida', '9786070729393', '2015-07-02', 52, 179, 'En este nuevo libro, la autora de Cuando la comida calla tus sentimientos nos presenta una visión profunda de por qué algunos de nosotros buscamos la satisfacción en la comida, cómo suplimos la emociones con alimentos que nos llenan el estómago pero no el corazón y, finalmente, cómo tomar el control de nuestra alimentación resulta un medio para la sanación física y espiritual. Adriana Esteva se basa en su propia experiencia y en las historias de éxito de sus alumnos y asistentes a sus talleres para demostrarnos que es posible ser compasivos y objetivos con nosotros mismos para entender que la comida no puede sustituir nuestra experiencia de vida.', 0, 'http://books.google.com/books/content?id=WknSCQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(189, '7m_DCAAAQBAJ', 'Detectives del ADN - Planeta lecto', '9789584241276', '2014-08-27', 52, 180, 'Aisha, el caballo más veloz del mundo, fue robado por un terrorista experto en genética, quien adelanta escabrosos experimentos de clonación no solo con animales, sino también con humanos. Su labor se escuda en una reconocida firma de investigación que compite en la carrera científica por descifrar la clave de la vida: el genoma humano, labor en la que también está empeñado Dan, un prestigioso genetista de la Universidad de Miami, amigo de la tía Abi y de los chicos aventureros. En compañía de Dan, este grupo conocerá los avances de la ingeniería genética, ciencia que permite revelar el ADN de cada persona, lo que será crucial para que ellos, que se han visto envueltos en esta peligrosa aventura, ayuden a rescatar a Aisha y a identificar al delincuente que quiere manipular la raza humana.', 0, 'http://books.google.com/books/content?id=7m_DCAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(190, 'eBbdAwAAQBAJ', 'La plaza', '9786070722394', '2014-08-01', 52, 181, 'La plaza apareció por primera vez en 1971, pocos años después del funesto 68. A pesar de la cercanía de los hechos, Luis Spota se atrevió a exponer sin censura, con imparcialidad y claridad crítica a los protagonistas de un movimiento que estremeció brutalmente a la conciencia nacional. Logró narrar con gran lucidez, utilizando materiales del conocimiento público, la convulsión de una sociedad enferma y el intenso drama de un hombre que es todos los hombres. La obra le valió injurias sin fundamento y la expulsión de un cerrado y exclusivo círculo literario mexicano. Sin embargo, su voz permaneció incólume a través de los años y se levantó sobre ese desastre de la historia mexicana para enseñarnos por qué el 2 de octubre no se olvida.', 0, 'http://books.google.com/books/content?id=eBbdAwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(191, 'MPsqAQAAMAAJ', 'Gibraltar', '9788408044703', '2002', 53, 182, '', 0, 'http://books.google.com/books/content?id=MPsqAQAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(192, 'a80fAQAAIAAJ', 'Colombia Es Moda', 'STANFORD:36105130588051', '2007', 54, 183, '', 0, 'http://books.google.com/books/content?id=a80fAQAAIAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(193, 'Z1LWswEACAAJ', 'Tres novelas ejemplares', 'OCLC:957758698', '2016', 54, 184, '', 0, 'css/img/portadano.png'),
(194, 'HlvjcnSlJ2kC', 'Adivinanzas', '9789870420538', '2011-12-16', 55, 185, 'Las mejores adivinanzas, según Carlos Silveyra.', 0, 'http://books.google.com/books/content?id=HlvjcnSlJ2kC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(195, 'm_nMFLDEQPsC', 'El miedo a la oscuridad', '9789587582048', '2012-03-09', 56, 186, 'Sandro Romero Rey.', 0, 'http://books.google.com/books/content?id=m_nMFLDEQPsC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(196, '7xFuJzw_c-QC', 'La verdad sea dicha', '9789587582079', '2012-07-27', 57, 187, 'Memorias.', 0, 'http://books.google.com/books/content?id=7xFuJzw_c-QC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(197, 'ayJpiblipmUC', 'Trabalenguas', '9789870419785', '2014-11-04', 58, 185, 'Trabalenguas para leer ligerito y sin equivocarse.', 0, 'http://books.google.com/books/content?id=ayJpiblipmUC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(198, 'xs-oThex1F8C', 'El sangrador', '9789563471748', '2012-03-17', 56, 188, 'Antofagasta, 1800. Apolonio Mancuso, uno de los sangradores más solicitados del pueblo de Elvira, será desplazado de sus actividades por dos jóvenes dentistas profesionales que llegarán desde Lima. En ese momento, Mancuso decidirá innovar en su labor inventando el primer taladro dental de la zona.', 0, 'http://books.google.com/books/content?id=xs-oThex1F8C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(199, 'Lcm8K5Wlg0IC', 'Bestiario del balón', '9789587582789', '2011-12-12', 59, 189, 'Un libro lleno de anécdotas de jugadores que, sin mucho talento, dejaron huella en la historia... y en las canillas de los rivales...', 0, 'http://books.google.com/books/content?id=Lcm8K5Wlg0IC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(200, 'G4M2DwAAQBAJ', 'Los cuatro libros clásicos', '9788490698310', '2017-09-25', 60, 190, 'Los cuatro libros clásicos del confucianismo. Confucio fue el creador de un sistema basado en la filosofía práctica orientada hacia el perfeccionamiento de uno mismo. En Los cuatro libros clásicos se recogen los textos de la literatura china seleccionados como fundamentos del confucianismo, un sistema filosófico aún vigente: Gran Saber, Doctrina de la medianía, Analectas de Confucio y Mencio.', 0, 'http://books.google.com/books/content?id=G4M2DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(201, 'fXXX-05VLmIC', 'Animalanzas', '9789870418009', '2011-08-31', 58, 185, 'Animalanzas incluye casi doscientos acertijos de Hispanoamérica, ideales para leer y reir en los ratos libres.', 0, 'http://books.google.com/books/content?id=fXXX-05VLmIC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(202, 'RawjAQAAIAAJ', 'Pasión Por la Libertad', 'STANFORD:36105131915584', '2006-01-01', 54, 191, '', 0, 'http://books.google.com/books/content?id=RawjAQAAIAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(203, 'tFobAQAAIAAJ', 'Deslizamientos Sigilosos Del Placer', 'STANFORD:36105123847324', '2005-01-01', 54, 192, '', 0, 'http://books.google.com/books/content?id=tFobAQAAIAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(204, 'hvRHAAAAYAAJ', 'El monte de las delicias', 'UTEXAS:059173016816099', '2004-01-01', 54, 193, '', 0, 'http://books.google.com/books/content?id=hvRHAAAAYAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(205, 'i4cvDgAAQBAJ', 'Hacia la hora décima', '9788416645077', '2016-01-18', 61, 194, 'Un monasterio benedictino en la provincia de Soria. Algunos seglares pasan unos días en la hospedería. Conviven entre ellos y con monjes y otros religiosos. Cada uno con sus experiencias vitales y sus propias perspectivas o esperanzas. La reunión de personas inteligentes siempre puede resultar atractiva y mostrar el signo de contradicción en el que cada una de ellas se debate. El hombre siempre es un descubrimiento, a pesar de que también siempre se acomoda a las mismas pautas...', 0, 'http://books.google.com/books/content?id=i4cvDgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(206, 'ZocvDgAAQBAJ', 'El barrio de los sueños rotos', '9788416645275', '2016-02-24', 61, 195, 'En un barrio de gente pobre llamado San Judas, en las afueras de la gran ciudad ha venido a instalarse una mafia extranjera para montar una red de drogas y prostitución. El párroco del barrio, harto de ser mudo testigo decide pedir ayuda a unos antiguos compañeros de clase. La mayoría hace años que no se ven y han cogido caminos muy distintos en la vida. Así el cura, un policía, un camello, una concejal y una puta se pondrán de acuerdo para acabar con la mafia. Mientras se enfrentan a la mafia saldrán a la luz viejas rencillas, antiguos amores, y en general, sueños rotos que volverán al presente. Gracias a ese reencuentro, historias inacabadas encontraran su fin.', 0, 'http://books.google.com/books/content?id=ZocvDgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(207, 'dhEvDgAAQBAJ', 'La llamada de la cima', '9788416645398', '2016-03-14', 61, 196, 'Es un periodo estrechamente complicado para España, Cuba se encuentra en plena rebelión. Situación totalmente ajena a dos adolescentes que se enzarzan en una fatídica reyerta, desencadenando un cúmulo de acontecimientos que involucrarán a tres generaciones de dos familias adversarias. Una reyerta en la que el muchacho damnificado engendra tal nivel de odio que se lanza a profesar una dura venganza. En su lucha sesga la vida de seres queridos del adversario suscitándole un sentimiento recíproco. Transcurren los años, se hacen hombres y el odio se mantiene vivo e inalterable en sus corazones. Sus descendientes, sin embargo, no solo ignoran la existencia de esa firme lucha de revancha, sino que entre ellos han forjado unos lazos de amistad inquebrantables. Finaliza la Guerra Civil y todo cambia para ambas familias, al igual que para los eternos rivales. La nueva situación los obliga a actuar de tal modo, que acabarán por determinar el imprevisible futuro que les aguarda.', 0, 'http://books.google.com/books/content?id=dhEvDgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(208, 'wF4wDgAAQBAJ', 'La memoria de los pasos', '9788416405718', '2015-11-02', 61, 197, 'Xoan Beltrán es un joven abocado a sobrevivir a duras penas en la Galicia de principios del siglo XX. Cuando la vida le sorprende con un nuevo varapalo, el destino le brindará una oportunidad para cambiar su fortuna. Xoan viajará al otro lado del océano para labrarse un futuro mejor. Pero las cosas no serán fáciles en su nueva vida. En Cuba le aguardan turbios secretos que le obligarán a tomar decisiones complicadas. La memoria de los pasos nos presenta una historia seductora, que aborda un tema olvidado en los últimos años dentro del imaginario colectivo de la emigración española, el de los indianos que se fueron a Cuba y volvieron con más o con menos fortuna a nuestro país. El amor, la ambición, la venganza y la nostalgia de la tierra perdida se entremezclan en esta novela de tintes históricos.', 0, 'http://books.google.com/books/content?id=wF4wDgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(209, 'G5s-DgAAQBAJ', 'En los valles de Harán', '9788416645718', '2016-03-31', 61, 198, 'Una novela que relata la aventura de un viaje a tierras de Siria en el año 2011 a pesar de las circunstancias tan especiales que empezaban a vivir sus gentes. El motivo principal era recorrer la ruta que Abraham había hecho hace casi cuatro mil años, partiendo de Harán (actual Harran) y atravesando el país de norte a sur y pasando por las ciudades de Alepo, Hamah y el mismo Damasco. Pero el turista aventurero se encuentra de lleno con el principio de una guerra civil la cual le hace vivir una fuerte experiencia, pero que a pesar de ello, o quizás gracias a ello, puede ser testigo casi de primera fila de los prolegómenos del nacimiento del pueblo de Israel.', 0, 'http://books.google.com/books/content?id=G5s-DgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(210, 'KRAvDgAAQBAJ', 'La otra cara de la moneda', '9788416405794', '2015-11-02', 61, 199, 'Después de haber sufrido un proceso de acoso, Max llega al punto de disparar a una chica en su instituto. A partir de ese momento tendrá que enfrentarse a la prisión y a todos los retos que le deparará el futuro, descubriendo un mundo que nunca había imaginado, explorando la cara de la moneda que no solemos ver.', 0, 'http://books.google.com/books/content?id=KRAvDgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(211, 'sTQwDgAAQBAJ', 'Susurros de trompeta', '9788416645176', '2016-02-24', 61, 200, 'Esta obra es la metamorfosis literaria de la autora, en una búsqueda diaria de nuevas formas de expresión escrita para su propio deleite y entretenimiento. Un ensayo literario continuo donde mezcla recursos sin límites, alternando poesía libre como con métrica. Inspirándose tanto en las cosas más cotidianas de la vida como en la actualidad política de su país. Este poemario es un canto a la libertad, la justicia y el amor por la naturaleza. En definitiva, tan simple y a la vez tan complicado como lo es ella.', 0, 'http://books.google.com/books/content?id=sTQwDgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(212, 'UJVetQEACAAJ', 'Floresta de leyendas heróicas españolas', 'OCLC:881061037', '1948', 54, 201, '', 0, 'css/img/portadano.png'),
(213, 'jm8MAAAAYAAJ', 'Mañanas FM', 'UTEXAS:059173006063948', '1997-01-01', 62, 202, '', 0, 'http://books.google.com/books/content?id=jm8MAAAAYAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(214, 'IAcTAQAAMAAJ', 'Enciclopedia Espasa', 'UOM:39015052666081', '2000', 54, 203, '', 0, 'http://books.google.com/books/content?id=IAcTAQAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(215, 'zU0P9ZlSY6QC', 'El Libro de la familia', 'BNC:1001156625', '1867', 54, 204, '', 0, 'http://books.google.com/books/content?id=zU0P9ZlSY6QC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(216, 'g6wqAQAAMAAJ', 'Traje de luces', 'NWU:35556034317966', '2001', 62, 205, '', 0, 'http://books.google.com/books/content?id=g6wqAQAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(217, 'gk1lAAAAMAAJ', 'Nieve al sol', 'UOM:39015059300601', '2004', 62, 206, '', 0, 'http://books.google.com/books/content?id=gk1lAAAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(218, 'Exe_OwAACAAJ', 'Diccionario de sinónimos y antónimos', '9788467021189', '2006', 63, 207, 'Esta obra pone la riqueza de la lengua española, con su inmensa variedad de matices, al alcance de todos los interesados en conocer y mejorar el uso del idioma. En un formato práctico y asequible, ofrece un completo repertorio de voces, procedentes de los principales campos y registros, con sus correspondientes sinónimos y antónimos presentados en forma de listas para facilitar al máximo su búsqueda.- Más de 15.000 entradas y más de 87.000 sinónimos y antónimos del español más actual.- Americanismos, extranjerismos y palabras recién incorporadas a nuestra lengua.', 0, 'http://books.google.com/books/content?id=Exe_OwAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(219, 'Ep1dAAAAMAAJ', 'Extranjeros en la noche', 'UOM:39015042551278', '1999', 62, 208, '', 0, 'http://books.google.com/books/content?id=Ep1dAAAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'),
(220, 'ppOzMyw0GKcC', 'Oscar y Amanda', 'BNC:1001116299', '1868', 54, 201, '', 0, 'http://books.google.com/books/content?id=ppOzMyw0GKcC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(221, 'OxI0DwAAQBAJ', 'Rumbo al Mar Blanco', '9788417081317', '2017-09-04', 64, 209, 'Un clásico rescatado de las llamas. En junio de 1944, Malcolm Lowry logró salvar las páginas de la que se convertiría en su más famosa novela, \"Bajo el volcán\". Se creía que \"Rumbo al Mar Blanco\", el manuscrito en el que trabajaba sin descanso, se había perdido en el mismo fuego, pero ahora ha sido descubierto. Lowry vivía en una cabaña de la costa del Pacífico de Canadá, cuando esta se incendió. En un telegrama, el autor explicaba que \"Bajo el volcán\" se había salvado, pero que se había perdido otro libro que iba a ser parte de una trilogía. Se refería a \"Rumbo al Mar Blanco\", una novela con tintes autobiográficos sobre un estudiante de Cambridge que quiere ser novelista pero que está convencido de que su libro y, en cierta manera, su propia vida, ya han sido escritos por un novelista noruego. \"Rumbo al Mar Blanco\" es un trabajo imponente en el que el escritor lucha contra sus demonios y sus propias incertidumbres ideológicas mientras ofrece una visión de la política en los años de entreguerras. Una novela introspectiva y épica a la vez, en la que la magistral prosa del autor se pone al servicio de una obra cautivadora que está llamada a ser un clásico y que, con retraso, llega a nosotros para quedarse. “Todo arde en este inédito extraordinario que, de algún modo, sortea la sucesión de naufragios que contiene.” Le Point', 0, 'http://books.google.com/books/content?id=OxI0DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(222, 'ijZ8DQAAQBAJ', 'Lou Reed era español', '9788416665556', '2016-11-21', 64, 213, 'Bienvenidos al maravilloso mundo de Manuel Vilas y bienvenidos también a los alucinantes viajes de Lou Reed por España. Porque este libro consta de dos historias montadas en una sola película: la del joven Vilas, que experimenta una revelación, una auténtica epifanía, cuando escucha la voz del músico estadounidense en su Barbastro natal durante los franquistas años 70, y la de Lou Reed, que entre concierto y concierto descubre un país oscuro y luminoso, amable y salvaje. Así, en ágil contrapunto, vemos cómo Vilas madura y se enamora, compra discos, acude a actuaciones y visita ciudades saltando de oca en oca. Reed, mientras tanto, habla de forma demencial con camareros, colegas, guardias civiles o amantes, come platos hispánicos, quema kilómetros y canta... sobre todo canta. ¡Vaya voz! A lo largo de estas páginas se recrean las alocadas aventuras y las entrañables desventuras de un poeta y una estrella del rock cuyos caminos nunca llegan a encontrarse: el primero admira al segundo; el segundo se deja admirar desde la altiva distancia del escenario. Lou Reed era español es poema en prosa y prosa musicada. Es recuerdo, drama y comedia. Es la carta de amor de un escritor que logra construir una mitología española donde conviven Machado o Buñuel con Jim Morrison o, por supuesto, Lou Reed. Su literatura es tradición y ruptura, vida y rock and roll. ¡Que empiece la fiesta con su tristeza abismal y su alegría dionisíaca! ¡Que empiece el viaje!', 0, 'http://books.google.com/books/content?id=ijZ8DQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(223, '_HXeCgAAQBAJ', 'La invasión de los marcianitos', '9788415996750', '2015-01-01', 64, 214, 'A principios de los años ochenta las ciudades de todo el mundo se vieron invadidas por un ejército de marcianitos dispuestos a librar combates en las pantallas de un sinfín de máquinas de videojuegos. Martin Amis, uno de los escritores británicos más celebrados de la actualidad, se convirtió en un auténtico adicto a esos combates virtuales y recorrió bares, salones recreativos y lugares de lo más variopinto en busca de la última novedad y de nuevos retos. En este libro de culto se relata la experiencia del autor y también se retrata la sociedad de principios de los años ochenta, una época en que la tecnología, la información constante y la fascinación por el espacio empezaron a formar parte de la vida cotidiana de las personas', 0, 'http://books.google.com/books/content?id=_HXeCgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(224, 'jIHeCgAAQBAJ', 'Sobrebeber', '9788415996163', '2014-01-07', 64, 215, 'Los jugos embriagadores irrumpieron en un mundo apenas estrenado con la castaña del virtuoso Noé y la argucia nefanda tramada por las hijas de Lot para multiplicarse. Ésas fueron las primeras copas y desde entonces han corrido ríos de alcohol por las llanuras literarias (al fin y al cabo, el líquido elemento mana sin pausa como inductor o bálsamo de casi todos las desdichas). Entre los efluvios del siglo XX destaca una cima del pensamiento etílico: Kingsley Amis. La bebida no fue para él una mera contingencia o un complemento de pasiones más hondas, sino una necesidad perentoria, una alegría autónoma y, a menudo, el único argumento de la obra. Amis fue además un maestro de ese humor taimado, lateral e hipotenuso que gastan los caballeros británicos cuando trinchan el pollo, de modo que este libro es el encuentro en la cumbre entre el divino arte de la ironía y una ciencia humana adquirida tras largos años de paciente exploración. Aquí se cruzan la guasa del filósofo y la sapiencia del crápula para impartir doctrina sobre materias de tanta envergadura como la naturaleza ontológica de la resaca, la dieta del beodo, los ardides del tacaño o las fórmulas (seguramente conjeturas) para eludir una borrachera. Aquí se sirve un delicioso cóctel de sosa cáustica y experiencia destilada. Pasen y beban.', 0, 'http://books.google.com/books/content?id=jIHeCgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(225, 'snXeCgAAQBAJ', 'Llamada perdida', '9788415996767', '2015-01-07', 64, 216, '¿Puede ser la ironía el mejor bisturí para abrir en canal la propia vida? ¿Quiénes son los auténticos herederos de Roberto Bolaño? ¿Cuáles son los límites del pudor? ¿En qué se parecen Corín Tellado e Isabel Allende? ¿Se puede vivir en vida la experiencia radical de la muerte? ¿Qué diablos será eso que llamamos «familia»? Son muchas y muy sorprendentes las preguntas que plantea la escritora Gabriela Wiener en este libro que no se parece a ningún otro. Un libro autobiográfico, político, sincero y radical donde se habla de tríos sexuales, de amigos lejanos, de literatura, de supersticiones numéricas, de una hija y un marido, de España y de Perú. Un libro que se adhiere a la piel del lector como un tatuaje, con ese eco insistente y abstracto de las llamadas perdidas.', 0, 'http://books.google.com/books/content?id=snXeCgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(226, 'HictDwAAQBAJ', 'Desoriental', '9788417081164', '2017-06-26', 64, 217, 'Tierna, lúcida y ambiciosa, \"Desoriental\" explora los conflictos culturales de las segundas generaciones de aquellos que emigraron a Europa. Por las noches, Kimiâ pincha rock alternativo. Durante el día, sigue un tratamiento de inseminación artificial para poder tener un hijo con su novia Anna. Kimiâ, nacida en Teherán en 1971, se exilió a Francia con su familia, y para poder disfrutar de su libertad, mantuvo las distancias con su cultura de origen. Sin embargo, mientras espera en el hospital, yendo de consulta en consulta, los recuerdos del pasado la invaden. A través de estos recuerdos dispersos, Kimiâ revela la historia de la familia Sadr; desde sus ancestros del norte de Persia, hasta sus propios padres, luchadores eternos contra los sucesivos regímenes políticos que les toca vivir; primero, el del Shah y después el de Jomeini, causante de su huida definitiva de Irán. Por desgracia, la Francia a la que huyen poco tiene que ver con la idealizada versión que se habían imaginado. En una Francia chauvinista y racista, parece que la única salida posible para Kimiâ es su propia «desorientalización». «Desoriental nos cautiva tanto por su fuerza narrativa como por la riqueza de sus temas y el rigor de su mirada crítica.» Christine Rousseau, Le Monde', 0, 'http://books.google.com/books/content?id=HictDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'),
(227, 'tILeCgAAQBAJ', 'El protegido', '9788415996972', '2015-04-01', 64, 218, 'Jaime es un tipo que se resigna a una vida relativamente anodina. Trabaja en una asesoría fiscal, acaba de separarse, practica una obstinada paternidad con el hijo de otro hombre y tiene una nueva relación condenada al fracaso. Pero ese mundo más o menos previsible se desmorona un día cuando lo turbio y salvaje irrumpe en su vida. Empujado por su sentido del deber, mata a dos individuos (o quizá no) para evitar que lo arrastre la corriente de los acontecimientos. Vivirá el pánico de sentirse perseguido y comprobará que cuenta con recursos hasta entonces impensables. También que la mujer de sus sueños puede ser el amor de su vida.', 0, 'http://books.google.com/books/content?id=tILeCgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api');

-- --------------------------------------------------------

--
-- Table structure for table `libro_autor`
--

CREATE TABLE `libro_autor` (
  `idLibro` int(11) NOT NULL,
  `idAutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `libro_autor`
--

INSERT INTO `libro_autor` (`idLibro`, `idAutor`) VALUES
(184, 175),
(185, 176),
(186, 177),
(187, 178),
(188, 179),
(189, 180),
(190, 181),
(191, 182),
(192, 183),
(193, 184),
(194, 185),
(197, 185),
(201, 185),
(195, 186),
(196, 187),
(198, 188),
(199, 189),
(200, 190),
(202, 191),
(203, 192),
(204, 193),
(205, 194),
(206, 195),
(207, 196),
(208, 197),
(209, 198),
(210, 199),
(211, 200),
(212, 201),
(220, 201),
(213, 202),
(214, 203),
(215, 204),
(216, 205),
(217, 206),
(218, 207),
(219, 208),
(221, 209),
(221, 210),
(221, 211),
(221, 212),
(222, 213),
(223, 214),
(224, 215),
(225, 216),
(226, 217),
(227, 218);

-- --------------------------------------------------------

--
-- Table structure for table `libro_lista`
--

CREATE TABLE `libro_lista` (
  `idLibro` int(11) NOT NULL,
  `idLista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lista`
--

CREATE TABLE `lista` (
  `idLista` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `password` varchar(33) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `usuario`, `password`, `nombre`, `apellidos`, `email`) VALUES
(32, 'angytambien', 'ecad7e4788f8b9ace0fa3e04bd3a37a9', 'Ángeles', 'Bueno Aguilar', 'angy@email.com'),
(33, 'sorayach82', 'ecad7e4788f8b9ace0fa3e04bd3a37a9', 'Soraya', 'Cubino Hernández', 'soretus@sorus.es'),
(34, 'severussnape', 'e08ee230cb476611225987aba4d101f9', 'Severus', 'Snape', 'severus@apple.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`idAutor`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `fk_comentario_libro` (`idLibro`),
  ADD KEY `fk_comentario_usuario` (`idusuario`);

--
-- Indexes for table `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`idEditorial`);

--
-- Indexes for table `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`idUsuario`,`idLibro`),
  ADD KEY `fk_favoritos_libro` (`idLibro`);

--
-- Indexes for table `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`idGenero`);

--
-- Indexes for table `genero_usuario`
--
ALTER TABLE `genero_usuario`
  ADD PRIMARY KEY (`idUsuario`,`idGenero`),
  ADD KEY `fk_genero_usuario_genero` (`idGenero`);

--
-- Indexes for table `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`idLibro`),
  ADD KEY `fk_libro_editorial` (`idEditorial`),
  ADD KEY `fk_libro_autor` (`idAutor`);

--
-- Indexes for table `libro_autor`
--
ALTER TABLE `libro_autor`
  ADD PRIMARY KEY (`idLibro`,`idAutor`),
  ADD KEY `fk_libro_autor_autor` (`idAutor`);

--
-- Indexes for table `libro_lista`
--
ALTER TABLE `libro_lista`
  ADD PRIMARY KEY (`idLibro`,`idLista`),
  ADD KEY `fk_libro_lista_lista` (`idLista`);

--
-- Indexes for table `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`idLista`),
  ADD KEY `fk_lista_usuario` (`idUsuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autor`
--
ALTER TABLE `autor`
  MODIFY `idAutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `editorial`
--
ALTER TABLE `editorial`
  MODIFY `idEditorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `libro`
--
ALTER TABLE `libro`
  MODIFY `idLibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `lista`
--
ALTER TABLE `lista`
  MODIFY `idLista` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_libro` FOREIGN KEY (`idLibro`) REFERENCES `libro` (`idLibro`),
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `fk_favoritos_libro` FOREIGN KEY (`idLibro`) REFERENCES `libro` (`idLibro`),
  ADD CONSTRAINT `fk_favoritos_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `genero_usuario`
--
ALTER TABLE `genero_usuario`
  ADD CONSTRAINT `fk_genero_usuario_genero` FOREIGN KEY (`idGenero`) REFERENCES `genero` (`idGenero`),
  ADD CONSTRAINT `fk_genero_usuario_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `fk_libro_autor` FOREIGN KEY (`idAutor`) REFERENCES `autor` (`idAutor`),
  ADD CONSTRAINT `fk_libro_editorial` FOREIGN KEY (`idEditorial`) REFERENCES `editorial` (`idEditorial`);

--
-- Constraints for table `libro_autor`
--
ALTER TABLE `libro_autor`
  ADD CONSTRAINT `fk_libro_autor_autor` FOREIGN KEY (`idAutor`) REFERENCES `autor` (`idAutor`),
  ADD CONSTRAINT `fk_libro_autor_libro` FOREIGN KEY (`idLibro`) REFERENCES `libro` (`idLibro`);

--
-- Constraints for table `libro_lista`
--
ALTER TABLE `libro_lista`
  ADD CONSTRAINT `fk_libro_lista_libro` FOREIGN KEY (`idLibro`) REFERENCES `libro` (`idLibro`),
  ADD CONSTRAINT `fk_libro_lista_lista` FOREIGN KEY (`idLista`) REFERENCES `lista` (`idLista`);

--
-- Constraints for table `lista`
--
ALTER TABLE `lista`
  ADD CONSTRAINT `fk_lista_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
