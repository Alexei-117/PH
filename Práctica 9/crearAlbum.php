<?php
	session_start();
	include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Universal Images - Crear Álbum</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
	<link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
	<link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		if(isset($_SESSION["nombre"])){
			include ("header2.php");
		}
		else{
			include("header.php");
			echo '
			<div class="alert">
				Debe identificarse antes para poder acceder al detalle de los albumes
			</div>';
			include("ultimasFotos.php");
		}
    ?>
	?>
	<hr>
	<main>
		<form class="album-form" action="crearAlbumInsert.php" method='POST'>
                <fieldset>
                <legend>Crear Álbum</legend>
                <label class="labelForm" for="nomAlbum">Título</label>
				<input class="formInput" type="text" name="nomAlbum" id="nomAlbum" required>
                
                <br>
				<label class="labelForm" for="fechaAlbum">Fecha</label>
				<input class="formInput" type="date" name="fechaAlbum"  id="fechaAlbum" required>
				<label class="labelForm" for="paisAlbum">País</label>
                <select class="formInput" name="paisAlbum" id="paisAlbum">
					<?php
						$sentencia= 'SELECT * FROM paises';
						$resultado = mysqli_query($conexion, $sentencia);
						while($fila=mysqli_fetch_assoc($resultado)){
							echo "<option value=".$fila['IdPais'].">".$fila['NomPais']."</option>";
						}
						mysqli_free_result($resultado);
					?>
                </select>
				<br>
				<label class="labelForm" for="descAlbum">Descripción</label>
				<input class="formInputA" type="text" name="descAlbum" id="descAlbum">
                </fieldset>
			 	<label for="subReg"></label>
				<input class="formSubmit" type="submit" name="submit_reg" id="subReg" value="Crear" />
                
		</form>
	</main>
	<?php 
		include("footer.html");
		mysqli_close($conexion);
	?>
</body>
</html>