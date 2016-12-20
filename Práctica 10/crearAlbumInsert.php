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
		$error=false;
		$msgError="";
		if(isset($_POST["fechaAlbum"])){
			$fecha=explode("-",$_POST["fechaAlbum"]);
			if(sizeof($fecha)==3){
				$newFecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];
				$expreg="/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/";
				if(preg_match($expreg,$newFecha)){
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
		
		$album=$_POST["nomAlbum"];
		filter_var($album,FILTER_SANITIZE_STRING);
		
		$fecha=$_POST["fechaAlbum"];
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
			$sentencia= "INSERT INTO albumes VALUES (null,'".$album."','".$descripcion."','".$newFecha."','".$pais."','".$_SESSION['id']."')";
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