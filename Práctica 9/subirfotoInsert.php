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
				Debe identificarse antes para poder acceder al detalle de los álbumes
			</div>';
			include("ultimasFotos.php");
		}
	?>
	<hr>
	<main>
	<?php
		$error=false;
		if(isset($_POST["date_foto"])){
			$fecha=explode("-",$_POST["date_foto"]);
			if(sizeof($fecha)==3){
				$newFecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];
				$expreg="/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/";
				if(!preg_match($expreg,$newFecha)){
					$error=true;
					$msgError.="<p>La fecha debe de ser del tipo dd/mm/aaaa o dd-mm-aaaa</p>";
				}
			}else{
				$error=true;
				$msgError.="<p>La fecha debe de ser del tipo dd/mm/aaaa o dd-mm-aaaa</p>";
			}
		
		}else{
			$fecha=null;
		}
		
		$titulo=$_POST["name_foto"];
		filter_var($titulo, FILTER_SANITIZE_STRING);
		
		$fecha=$_POST["date_foto"];
		

		$pais=$_POST["pais_foto"];
		
		$foto=$_POST["foto_foto"];
		
		if(isset($_POST["album_foto"])){
			$album=$_POST["album_foto"];
			filter_var($album, FILTER_SANITIZE_STRING);
		}else{
			$album="No está en un álbum";
		}

		
		$descripcion=$_POST["desc_foto"];
		filter_var($descripcion, FILTER_SANITIZE_STRING);
		
		if(!$error){
			$sentencia ='SELECT * FROM albumes a, paises p WHERE a.IdAlbum='.$album.' AND p.IdPais='.$pais.' ORDER BY a.IdAlbum';
			$resultado= mysqli_query($conexion,$sentencia);
			$sentencia= "INSERT INTO fotos VALUES (null,'".$titulo."','".$descripcion."','".$newFecha."','".$pais."','".$album."','".$foto."','2016-12-01')";
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
						 ";
						while($fila=mysqli_fetch_assoc($resultado)){
							echo "
							<b>País: ".$fila["NomPais"]."</b>
						</p>
						<p>
							<b>Fecha: ".$fecha."</b>
						</p>
						<p>
							<b>Descripción: ".$descripcion."</b>
						</p>
						<p>
							<b>Álbum: ".$fila["Titulo"]."</b>
						</p>";
						}
				echo "
					</article>";
			}
		}else{
			echo "<div class='alert'>
					".$msgError."
					</div>";
		}

	?>
	</main>
	<?php
		include("footer.html");
		mysqli_close($conexion);
	?>
</body>
</html>