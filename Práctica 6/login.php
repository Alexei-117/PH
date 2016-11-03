<!DOCTYPE html>
<html lang="es">
<head>
    <title>Universal Images - login</title>
    <meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
	<link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
	<link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
		<?php
			if(($_POST["name"]=="test" && $_POST["password"]=="test")
				|| ($_POST["name"]=="pepito" && $_POST["password"]=="pepito1234")
				|| ($_POST["name"]=="jaja" && $_POST["password"]=="no")){
				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$pag = 'index2.php';
				header("Location: http://$host$uri/$pag"); 
			}else{
				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$pag = 'index.php?popen=si';
				header("Location: http://$host$uri/$pag"); 
			}
		?>
		
</body>
</html>