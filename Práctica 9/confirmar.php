<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - Confirmar álbum</title>

    <link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
    <link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
    <link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		include("header2.php");
	?>
	<hr>
	<main>
		<?php
		$multiplicador=0.08;
		$multiplicador= 0.08;
		$text ="";
		if(isset($_POST["color_control1"])){
			$text = $_POST["color_control1"];
		}
		if(isset($_POST["color_control2"])){
			$text = $_POST["color_control2"];
			$multiplicador=0.5;
		}		
		$price = 2 + $_POST["number_control"] * $multiplicador * $_POST["resolution_control"]/150*0.20;
		echo "
		<article class='confirmar'>
			<h4>Confirma los datos de la petición</h4>
			<p><b>Nombre:</b>$_POST[name_control]</p>
			<p><b>Título del álbum:</b> $_POST[title_control]</p>
			<p><b>Texto adicional:</b> $_POST[text_control]</p>
			<p><b>Correo electrónico:</b> $_POST[email_control]</p>
			<p><b>Dirección:</b> $_POST[direction_control]</p>
			<p><b>Teléfono:</b> $_POST[tel_control]</p>
			<p><b>Color de portada:</b> </p>
			<input type='color' name='color-confirmacion' value='$_POST[color_control]'/>
			<p><b>Número de copias:</b> $_POST[number_control]</p>
			<p><b>Resolución:</b> $_POST[resolution_control]</p>
			<p><b>Álbum de fotos:</b> $_POST[album_control]</p>
			<p><b>Impresión a:</b> $text
			</p>

			
			<p><b>Precio final:</b> $price €</p>
			<a href='index2.php'>Confirmar</a>
			<a href='index2.php'>Cancelar</a>
		</article>"?>
	</main>
	<?php
		include("footer.html");
	?>

</body>
</html>