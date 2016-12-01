<?php
	session_start();
	include("conexion.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Universal Images - Insert de Subir Foto</title>
    <meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
	<link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
	<link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		if(isset($_SESSION["nombre"])){
			include ("header2.php");
		}
		else{
			include("header.php");
			echo '
			<div class="alert">
				Debe identificarse antes para poder acceder al detalle de los albumes
			</div>';
			include("ultimasFotos.php");
		}
	?>
	<hr>
	<main>
	<?php
		$titulo=$_POST["name_foto"];
		$fecha=$_POST["date_foto"];
		$pais=$_POST["pais_foto"];
		$foto=$_POST["foto_foto"];
		$album=$_POST["album_foto"];
		//$hoy = (new DateTime())->format('Y-m-d');
		$sentencia= "INSERT INTO fotos VALUES (null,'".$titulo."','Sin descripción','".$fecha."','".$pais."','".$album."','".$foto."','2016-12-01')";
		$error=false;
		if(!mysqli_query($conexion, $sentencia)){
			$error=true;
		}
		if($error){
			echo '<div class="alert">
					No se ha podido insertar dentro de la base de datos.
			</div>';
		}else{
					echo "<article class='detalle'>
							<h3>Inserción realizada, la nueva foto es</h3>
							<figure>
								<a href=''";
					echo "		><img alt=".$titulo." src='".$foto."'/></a>
							</figure>
							<p>
								<b>País: ".$pais."</b>
							</p>
							<p>
								<b>Fecha: ".$fecha."</b>
							</p>
							<p>
								<b>Álbum: ".$album."</b>
							</p>
						</article>";
		}
	?>
	</main>
	<?php
		include("footer.html");
		mysqli_close($conexion);
	?>
</body>
</html>