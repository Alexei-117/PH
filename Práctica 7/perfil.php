<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Pefil</title>
   
    <link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
    <link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
    <link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		include("header2.html");
	?>
	<hr>
	<main class="perfil">
        
        <legend>Datos personales:</legend>
        <img src="img/lacara.png">
        <p>
        <b>Editar foto de perfil:</b>
		</p>
		<form class="album-form">
			<input class="botonOcultable" name="imagen" type="file" />
			<input type="submit" value="subir">
		</form>
		<p>
        <b>Nombre:</b> Pepito Morales
		</p>
		<p>
        <b>Correo electrónico:</b> pepitom63@gmail.com
		</p>
		<p>
        <b>Edad:</b> 43
		</p>
		<p>
        <b>Pais:</b> España
		</p>
		<p>
        <b>Ciudad:</b> Alicante
		</p>
		<p>
        <b>Sexo:</b> Hombre
		</p>
		<p>
        <b>Nacimiento:</b> 22/01/73 
		</p>
		<p>
        <b>Edad:</b> 43
		</p>
        </form>
        <form class="album-form">
        <legend>Últimas fotos:</legend>
		<p>
        <b>Últimas fotos:</b>
		</p>
        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
        </form>    
        <form class="album-form">
        <legend>Álbumes:</legend>
		<p>
        <b>Álbumes:</b>
        </p>
        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
        </form>
	</main>

	<?php include("footer.html");?>

</body>
</html>