<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - Confirmar Registro</title>

    <link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
    <link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
    <link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		include("header.html");
	?>
	<hr>
	<main>
		<?php
		echo "
		<article class='confirmar'>
			<h4>Confirma los datos de la petición</h4>
			<p><b>Nombre:</b>$_POST[nomUser]</p>
			<p><b>Contraseña:</b> $_POST[Contraseña]</p>
			<p><b>Correo electrónico:</b> $_POST[Correo]</p>
			<p><b>Sexo:</b> $_POST[sexo]</p>
			<p><b>Fecha de nacimiento:</b> $_POST[fecha]</p>
			<p><b>País:</b> $_POST[paisRegis]</p>
			<p><b>Foto de perfil</b> <img src='img/lacara.png'</p>
			<a href='index.php'>Confirmar</a>
			<a href='index.php'>Cancelar</a>
		</article>"?>
	</main>
	<?php
		include("footer.html");
	?>

</body>
</html>