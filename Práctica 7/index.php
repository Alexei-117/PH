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
		$desactiva=0;
		include("header.php");
		if(isset($_GET["popen"])){
			if($_GET["popen"]=="si"){
				echo '<div class="alert">
					Usuario y/o contraseña incorrectos
					</div>';
			}
		}
		if(isset($_GET["desactiva"])){
			setcookie("nombre","",time()-37000000);
			setcookie("contra","",time()-37000000);
			setcookie("fecha","",time()-37000000);
			setcookie("hora","",time()-37000000);
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$pag = 'index.php?popen=no';
			header("Location: http://$host$uri/$pag"); 
		}
		
	?>
	<main>
		<?php include("buscador.html");?>
        <?php include("ultimasFotos.html");?>
	</main>

	<?php include("footer.html");?>

</body>
</html>