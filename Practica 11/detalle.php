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
		if(null!=$_GET){
			if(isset($_SESSION["nombre"])){
			$sentencia= "SELECT * FROM fotos as f,paises,albumes as a, usuarios as u 
							WHERE f.pais=paises.IdPais 
							AND ".$_GET['id']."=f.idFoto
							AND f.album=a.IdAlbum
							AND a.Usuario=u.IdUsuario
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
								"'>Album: ".$fila['Titulo']."</a>
							</p>
							<p>";
					if($_GET["id"]==$_SESSION["id"]){
						echo	"<a href='perfil.php?user=".$fila['IdUsuario'];
					}else{
						echo	"<a href='perfilOtro.php?user=".$fila['IdUsuario'];
					}
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