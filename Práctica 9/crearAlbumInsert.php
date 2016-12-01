		<?php
			session_start();
			include("conexion.php");

		?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Universal Images - Insert de Crear Album</title>
    <meta charset="UTF-8"/>
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
		$album=$_POST["nomAlbum"];
		$fecha=$_POST["fechaAlbum"];
		$pais=$_POST["paisAlbum"];
		$descripcion=$_POST["descAlbum"];
		
		$sentencia= "INSERT INTO albumes VALUES (null,'".$album."','".$descripcion."','".$fecha."','".$pais."','".$_SESSION['nombre']."')";
		$error=false;
		if(!mysqli_query($conexion, $sentencia)){
			$error=true;
		}
		if($error){
			$desc_error=mysqli_error();
			echo '<div class="alert">
					No se ha podido insertar dentro de la base de datos.
					Descripción del error:'.$desc_error.'
			</div>';
		}else{
			echo "<article class='detalle'>
					<h3>Inserción realizada, el nuevo album es</h3>
					<p>
						<b>Titulo: ".$album."</b>
					</p>
					<p>
						<b>Descripción: ".$descripcion."</b>
					</p>
					<p>
						<b>Fecha: ".$fecha."</b>
					</p>
					<p>
						<b>País: ".$pais."</b>
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