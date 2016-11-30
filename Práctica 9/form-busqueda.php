<?php
	include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8"/>
	<title>Universal Images - búsqueda avanzada</title>
	
    <link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
    <link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
    <link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		include("header.php");
		if(isset($_GET["popen"])){
			if($_GET["popen"]=="si"){
				echo '<div >
					Usuario y/o contraseña incorrectos
					</div>';
			}
		}
		
	?>
	<main>
		<form action="result-busqueda.php" method="POST" class="album-form">
			<fieldset>
            <legend>Formulario de búsqueda avanzada</legend>
			<label class="labelForm" for="title">Título:</label>
			<input class="formInput" type="text" name="Titulo" id="title">
			
			
			<label class="labelForm" for="fecha_ini">Fecha inicial:</label>
			<input class="formInput" type="date" name="Fecha_inicio" id="fecha_ini" >
                
            <label class="labelForm" for="fecha_ini">Fecha final:</label>
            <input class="formInput" type="date" name="Fecha_final" id="fecha_fin">
			

			<label class="labelForm" for="country">País:</label>
			<select class="formInput" type="text" name="Pais" id="country">
				<?php
					$sentencia= 'SELECT * FROM paises';
					$resultado = mysqli_query($conexion, $sentencia);
					while($fila=mysqli_fetch_assoc($resultado)){
						echo "<option value=".$fila['IdPais'].">".$fila['NomPais']."</option>";
					}
					mysqli_free_result($resultado);
				?>
			</select>
			</fieldset>
			<button class="formSubmit" type="submit" value="Buscar">Buscar</button>
		</form>
	</main>
</body>
</html>