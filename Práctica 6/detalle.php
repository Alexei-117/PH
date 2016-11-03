<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - detalle</title>
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
	<hr>
	<main>
		<?php
		if(null!=$_GET){
			if($_GET["id"]==1){
						echo "<article class='detalle'>
				<h3>My son's first draw</h3>
				<figure>
					<img alt='plano detalle' src='img/lacara.png'/>
				</figure>

				<p>
					<b>Pais: Spain</b>
				</p>
				<p>
					<b>Fecha: 1/2/2015</b>
				</p>
				<p>
					<a href=''>Album: My son</a>
				</p>
				<p>
					<a href=''>Usuario: Manuel Carrasco</a>
				</p>
			</article>";
			
			}
			if($_GET["id"]==2){
				echo "<article class='detalle'>
				<h3>Yo guapo</h3>
				<figure>
					<img alt='plano detalle' src='img/tio_maquina.jpg'/>
				</figure>
				<p>
					<b>Pais: New York</b>
				</p>
				<p>
					<b>Fecha: 3/4/2015</b>
				</p>
				<p>
					<a href=''>Album: My face</a>
				</p>
				<p>
					<a href=''>Usuario: Roberto Massterani</a>
				</p>
			</article>";
			
			}
		}
		?>
	</main>

	<?php include("footer.html");?>

</body>
</html>