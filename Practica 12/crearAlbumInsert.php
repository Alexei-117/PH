<?php
	session_start();
	include("conexion.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Universal Images - Insert de Crear álbum</title>
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
				Debe identificarse antes para poder acceder al detalle de los álbumes.
			</div>';
			include("ultimasFotos.php");
		}
	?>
	<hr>
	<main>
	<?php
		$error=false;
		$msgError="";
		
		//Comprobación de fecha
		if(isset($_POST["fechaAlbum"])){
			if(($fecha= strtotime($_POST["fechaAlbum"]))===false){
				$error=true;
				$msgError.="<p>La fecha debe de ser del tipo dd/mm/aaaa o dd-mm-aaaa. Entre 1900 y 2038. </p>";
			}else{
                $fecha=date("Y:m:d",strtotime($_POST["fechaAlbum"]));
            }
		}else{
			$fecha=null;
		}
		
		$album=$_POST["nomAlbum"];
		filter_var($album,FILTER_SANITIZE_STRING);
		
		$pais=$_POST["paisAlbum"];
		if(isset($_POST["descAlbum"])){
			$descripcion=$_POST["descAlbum"];
			filter_var($descripcion,FILTER_SANITIZE_STRING);
		}else{
			$descripcion="Sin descripción";
		}
		
		if(!$error){
			$sentencia ='SELECT * FROM paises p WHERE p.IdPais='.$pais;
			$resultado= mysqli_query($conexion,$sentencia);
			while($fila=mysqli_fetch_assoc($resultado)){
				$paisNom=$fila["NomPais"];
			}
			mysqli_free_result($resultado);
			$sentencia= "INSERT INTO albumes VALUES (null,'".$album."','".$descripcion."','".$fecha."','".$pais."','".$_SESSION['id']."')";
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
						<h3>Inserción realizada, el nuevo álbum es</h3>
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
							<b>País: ".$paisNom."</b>
						</p>
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