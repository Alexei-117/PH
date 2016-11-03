<!DOCTYPE html>
<html lang="es">

<head>
   <title>Universal Images - Inicio</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
	<link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
	<link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		include("header.html");
		if(isset($_GET["popen"])){
			if($_GET["popen"]=="si"){
				echo '<div >
					Usuario y/o contraseña incorrectos
					</div>';
			}
		}
		
	?>
	<main>
		<?php include("buscador.html");?>
        <?php include("ultimasFotos.html");?>
	</main>

	<?php include("footer.html");?>

</body>
</html>