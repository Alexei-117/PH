<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>

    <title>Universal Images - Resultados de búsqueda</title>
   
    <link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
    <link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
    <link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		include("header.php");
		if(isset($_GET["popen"])){
			if($_GET["popen"]=="si"){
				echo '<div style="	width:auto;
							height:auto;
							margin:10px;
							border: 3px solid red;
							border-radius:10px;
							
							color:red;
							font-size:2em;">
							Usuario y/o contraseña incorrectos
					</div>';
			}
		}
		
	?>
	<hr>
	<main>
		<?php include("buscador.html");?>
				<h4>Resultado de la búsqueda</h4>
		<?php 
		echo "<div class='alert2'>";
			if(isset($_POST["buscar"])){
				echo "Has buscado: $_POST[buscar]";
			}
			if(isset($_POST["Titulo"])){
				echo "Has buscado el título: $_POST[Titulo]";
			}
			if(isset($_POST["Fecha_inicio"])){
				echo "<br>Entre las fechas: $_POST[Fecha_inicio]";
			}
			if(isset($_POST["Fecha_final"])){
				echo "<br> y : $_POST[Fecha_final]";
			}
			if(isset($_POST["Pais"])){
				echo "<br>En el país: $_POST[Pais]";
			}
		echo "</div>";
		?>

        <article>
            <figure>
                <a href="detalle.php?id=1"><img alt="Última-foto-1" src="img/te_fo.jpg"/></a>
            </figure>
			<p>
				<b>Titulo: Selfie</b>
			</p>
			<p>
				<b>Pais: India</b>
			</p>
			<p>
				<b>Fecha: 14/3/2015</b>
			</p>
			<p>
				<a href="">Album: Last selfies</a>
			</p>
			<p>
				<a href="">Usuario: Ashram Uktah</a>
			</p>
        </article>
        <article>
            <figure>
                <a href="detalle.php?id=2"><img alt="Última-foto-2" src="img/si_o_que.jpg"/></a>
            </figure>
			<p>
				<b>Titulo: Party with my work mates!</b>
			</p>
			<p>
				<b>Pais: New Delhi</b>
			</p>
			<p>
				<b>Fecha: 2/5/2015</b>
			</p>
			<p>
				<a href="">Album: Party!</a>
			</p>
			<p>
				<a href="">Usuario: Marenna Arem</a>
			</p>
        </article>
        <article>
            <figure>
                <a href="detalle.php?id=1"><img alt="Última-foto-3" src="img/tio_maquina.jpg"/></a>
            </figure>
			<p>
				<b>Titulo: Yo guapo</b>
			</p>
			<p>
				<b>Pais: New York</b>
			</p>
			<p>
				<b>Fecha: 3/4/2015</b>
			</p>
			<p>
				<a href="">Album: My face</a>
			</p>
			<p>
				<a href="">Usuario: Roberto Massterani</a>
			</p>
        </article>
        <article>
            <figure>
                <a href="detalle.php?id=2"><img alt="Última-foto-4" src="img/lacara.png"/></a>
            </figure>
			<p>
				<b>Titulo: My son's first draw</b>
			</p>
			<p>
				<b>Pais: Spain</b>
			</p>
			<p>
				<b>Fecha: 1/2/2015</b>
			</p>
			<p>
				<a href="">Album: My son</a>
			</p>
			<p>
				<a href="">Usuario: Manuel Carrasco</a>
			</p>
        </article>
        <article>
            <figure>
                <a href="detalle.php?id=2"><img alt="Última-foto-5" src="img/soy_guapa.jpeg"/></a>
            </figure>
			<p>
				<b>Titulo: I'm pretty!</b>
			</p>
			<p>
				<b>Pais: England</b>
			</p>
			<p>
				<b>Fecha: 11/10/2014</b>
			</p>
			<p>
				<a href="">Album: My and myself</a>
			</p>
			<p>
				<a href="">Usuario: Ruperta Dolores</a>
			</p>
        </article>
	</main>

<?php include("footer.html");?>

</body>
</html>