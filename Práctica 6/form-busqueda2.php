<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8"/>
	<title>Universal Images - búsqueda avanzada identificado</title>
	
    <link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
    <link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
    <link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		include("header2.html");
	?>
	<main>
		<form action="result-busqueda2.php" method="POST" class="album-form">
			<fieldset>
            <legend>Formulario de búsqueda avanzada</legend>
			<label class="labelForm" for="title">Título:</label>
			<input class="formInput" type="text" name="Titulo" id="title">
			
			
			<label class="labelForm" for="fecha_ini">Fecha inicial:</label>
			<input class="formInput" type="date" name="Fecha_inicio" id="fecha_ini" >
                
            <label class="labelForm" for="fecha_ini">Fecha final:</label>
            <input class="formInput" type="date" name="Fecha_final" id="fecha_fin">
			
			<label class="labelForm" for="country">País:</label>
			<input class="formInput" type="text" name="Pais" id="country">
			</fieldset>
			<button class="formSubmit" type="submit" value="Buscar">Buscar</button>
		</form>
	</main>
</body>

	<?php include("footer.html");?>
</html>