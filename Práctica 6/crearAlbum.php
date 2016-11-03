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
		include("header2.html");
	?>
	<hr>
	<main>
		<form class="album-form" action="index2.html">
                <fieldset>
                <legend>Crear Álbum</legend>
                <label class="labelForm" for="nomAlbum">Título</label>
				<input class="formInput" type="text" name="nom-album" id="nomAlbum" required>
                
                <br>
				<label class="labelForm" for="fechaAlbum">Fecha</label>
				<input class="formInput" type="date" name="fecha-album"  id="fechaAlbum" required>
				<label class="labelForm" for="paisAlbum">País</label>
                <select class="formInput" name="pais-album" id="paisAlbum">
				    <option value="spain">España</option>
				    <option value="spain">Inglaterra</option>
				    <option value="spain">Francia</option>
                    <option value="spain">Argentina</option>
				    <option value="spain">Chile</option>
				    <option value="spain">Portugal</option>
                    <option value="spain">Andorra</option>
				    <option value="spain">Otro</option>
                </select>
				<br>
				<label class="labelForm" for="descAlbum">Descripción</label>
				<input class="formInputA" type="text" name="desc-album" id="descAlbum">
                </fieldset>
			 	<label for="subReg"></label>
				<input class="formSubmit" type="submit" name="submit_reg" id="subReg" value="Crear" />
                
		</form>
	</main>
	<?php include("footer.html");?>
</body>
</html>