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
  <title>L A · L I B R O T E C A</title>
</head>
<body>
	<div class="wrapper-form-reg">
		<!-- Formulario de registro -->
		<div class="row">
			<form id="registro" method="POST" class="col s12">
				<div class="row">
					<input type="hidden" id="flag" name="flag" value="false" />
				<div class="input-field col s6 form-login-div">
            <i class="material-icons prefix">edit</i>
            <input type="text" name="nom" value="<?= $nom ?>" maxlength="100" class="validate" required />
            <label for="icon_edit">Nombre</label>
        </div>
				<br />
				<br />
				<div class="input-field col s6 form-login-div">
            <i class="material-icons prefix">edit</i>
            <input type="text" name="ape" value="<?= $ape ?>" maxlength="100" class="validate" required />
            <label for="icon_edit">Apellidos</label>
				</div>
				<br />
				<br />
				<div class="input-field col s6 form-login-div">
						<i class="material-icons prefix">account_circle</i>
            <input type="text" name="usr" value="<?= $usr ?>" maxlength="15" class="validate" required />
            <label for="icon_vpn_key">Nombre de usuario</label>
				</div>
				<br />
				<br />
				<div class="input-field col s6 form-login-div">
            <i class="material-icons prefix">vpn_key</i>
            <input type="password" name="pwd" required />
            <label for="icon_vpn_key">Contraseña</label>
				</div>
				<br />
				<br />
				<div class="input-field col s6 form-login-div">
            <i class="material-icons prefix">email</i>
            <input type="email" name="ema" value="<?= $ema ?>" />
            <label for="icon_email">Email</label>
				</div>
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<div class="input-field col s6 form-login-div">
            <i class="material-icons prefix">insert_emoticon</i>
            <label class="label-generos">Género/s favorito/s:</label>
				</div>
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				
				<?php

					// Buscamos en la base de datos la relación de géneros
					$res = $lnk->query("SELECT * FROM genero ; ") 
							or die("**Error consulta géneros: $lnk->errno : $lnk->error");

					// Con el bucle mostramos tantos campos de tipo checkbox como registros hayamos obtenido en la consulta anterior.
					while($row=$res->fetch_object()):

						// Para marcar un campo debemos tener en cuenta que el array $gen no puede ser null y que,
						// además, la función array_search no nos devuelva false (necesaria comprobación estricta).
						$checked = (!is_null($gen) && 
										(array_search($row->idGenero, $gen)!==false))?"checked":"" ;
						echo "<p class=\"generos-p\"><label><input type=\"checkbox\" class=\"filled-in\" name=\"gen[]\" value=\"$row->idGenero\" $checked /><span>$row->genero</span></label></p>" ;
					endwhile ;

				?>

				<br/>
				<div class="div-btn-submit">
					<button class="btn waves-effect waves-light btn-submit" type="submit" name="action">Registrar
						<i class="material-icons right">send</i>
					</button>
				</div>

				<p style="color:red; font-weight: bold">
					<?= isset($err)?$err:"" ?>
				</p>
				</div>
			</form>
		</div>
	 </div>
	 <!--JavaScript at end of body for optimized loading-->
	 <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>

