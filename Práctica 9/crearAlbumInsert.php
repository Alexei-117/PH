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
				$expreg="/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/";
				if(preg_match($expreg,'04-12-2014')){
					$error=true;
					$msgError.="<p>La fecha debe de ser del tipo dd/mm/aaaa o dd-mm-aaaa</p>";
				}
			}else{
				$error=true;
				$msgError.="<p>La fecha debe de ser del tipo dd/mm/aaaa o dd-mm-aaaa</p>";
			}
		
		}else{
			$error=true;
			$msgError.="<p>Debe de poner su fecha de nacimiento</p>";
		}
		
		$album=$_POST["nomAlbum"];
		$fecha=$_POST["fechaAlbum"];
		$pais=$_POST["paisAlbum"];
		$descripcion=$_POST["descAlbum"];
		
		if(!$error){
			$sentencia ='SELECT * FROM paises p WHERE p.IdPais='.$pais;
			$resultado= mysqli_query($conexion,$sentencia);
			while($fila=mysqli_fetch_assoc($resultado)){
				$paisNom=$fila["NomPais"];
			}
			mysqli_free_result($resultado);
			$sentencia= "INSERT INTO albumes VALUES (null,'".$album."','".$descripcion."','".$fecha."','".$pais."','1')";
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