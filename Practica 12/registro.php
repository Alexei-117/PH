<?php
	include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registro</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
	<link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
	<link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		include("header.php");
		if(isset($_GET["popen"])){
			if($_GET["popen"]=="si"){
				echo '<div style="	width:auto;
							height:auto;
							margin:10px;
							border: 3px solid red;
							border-radius:10px;
							
							color:red;
							font-size:2em;">
							Usuario y/o contraseña incorrectos
					</div>';
			}
		}
		
	?>
	<hr>
	<main>
		<form class="album-form" action="registroConfirmar.php" method="POST" enctype="multipart/form-data">
			<fieldset>
			<legend>Formulario de registro</legend>
			<label class="labelForm" for="nomReg">Usuario</label>
			<input class="formInput" type="text" name="nomUser" id="nomReg" required>
			<br>
			<label class="labelForm" for="passReg">Contraseña</label>
			<input class="formInput" type="password" name="pass" id="passReg" required>
			<br>
			<label class="labelForm" for="passReg2">Repetir contraseña</label>
			<input class="formInput" type="password" name="repPass" id="passReg2" required>
			<br>
			<label class="labelForm" for="emailReg">Correo electrónico</label>
			<input class="formInput" type="email" name="correo" id="emailReg" required>
			<br>
			<label class="labelForm" for="sexReg">Sexo</label>
				<input type="radio" name="sexo" value="1" id="sexReg" checked> Hombre
				<br>
				<input type="radio" name="sexo" value="2"> Mujer
				<br>
			<br>
			<label class="labelForm" for="ciudadReg">Ciudad</label>
			<input class="formInput" type="text" name="ciudad" id="ciudadReg">
			<label class="labelForm" for="naciReg">Fecha de nacimiento</label>
			<input class="formInput" type="date" name="fecha"  id="naciReg" required>
			<label class="labelForm" for="paisReg">País</label>
			<select class="formInput" name="paisRegis" id="paisReg">
				<?php
					$sentencia= 'SELECT * FROM paises';
					$resultado = mysqli_query($conexion, $sentencia);
					while($fila=mysqli_fetch_assoc($resultado)){
						echo "<option value=".$fila['IdPais'].">".$fila['NomPais']."</option>";
					}
					mysqli_free_result($resultado);
				?>
			</select>
			<label class="labelForm" for="fotoReg">Foto de perfil</label>
                <div class="fileSubir" style="float:left;width: 157px;height:57px;background:url(img/upload.png);"><input class="formFile" type="file" name="ruta" id="fotoReg"></div>
			</fieldset>
			<label for="subReg"></label>
			<input class="formSubmit" type="submit" name="submit_reg" id="subReg" value="Registrarse" /> 
		</form>
	</main>

		<?php
			include("footer.html");
			mysqli_close($conexion);
		?>
</body>
</html>