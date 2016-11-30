<?php
	session_start();
	include("conexion.php");
?>
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
		$desactiva=0;
		if(isset($_GET["desactiva"])){
			setcookie("nombre","",time()-37000000);
			setcookie("contra","",time()-37000000);
			setcookie("fecha","",time()-37000000);
			setcookie("hora","",time()-37000000);
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$pag = 'index.php?popen=no';
			header("Location: http://$host$uri/$pag"); 
			session_destroy();
		}
		if(isset($_SESSION["nombre"])){
			include("header2.php");
		}else{
			include("header.php");
		}
		if(isset($_GET["popen"])){
			if($_GET["popen"]=="si"){
				echo '<div class="alert">
					Usuario y/o contraseña incorrectos
					</div>';
			}
		}
	?>
	<hr>
	<main>
		<?php
		if(null!=$_GET){
			if(isset($_SESSION["nombre"])){
			$sentencia= "SELECT * FROM fotos as f,paises,albumes as a, usuarios as u 
							WHERE f.pais=paises.IdPais 
							AND ".$_GET['id']."=f.idFoto
							AND f.album=a.IdAlbum
							AND a.IdAlbum=u.IdUsuario
							";
			$resultado = mysqli_query($conexion, $sentencia);
				while($fila=mysqli_fetch_assoc($resultado)){
					echo "<article class='detalle'>
							<h3>".$fila['titulo']."</h3>
							<figure>
								<a href=";
								if(isset($_SESSION["nombre"])){
									echo "detalle.php?id=".$fila['idFoto'];
								}else{
									echo "";
								}
					echo "		><img alt=".$fila['titulo']." src='".$fila['fichero']."'/></a>
							</figure>
							<p>
								<b>País: ".$fila['NomPais']."</b>
							</p>
							<p>
								<b>Fecha: ".$fila['fecha']."</b>
							</p>
							<p>
								<a href='ver_album.php?album=".$fila['IdAlbum'].
								"'>Album: ".$fila['IdAlbum']."</a>
							</p>
							<p>
								<a href='perfil.php?user=".$fila['IdUsuario'].
								"'>Usuario: ".$fila['NomUsuario']."</a>
							</p>
						</article>";
				}
			mysqli_free_result($resultado);
			}else{
				echo '<div class="alert">
						Tiene que identificarse para ver la página detalle de una foto.
						¡Regístrese en nuestra página principal!
					</div>';
			}
		}
		?>
	</main>

	<?php 
		include("footer.html");
		mysqli_close($conexion);
	?>

</body>
</html>