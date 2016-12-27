<?php
	session_start();
	include("conexion.php");
?>
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

	<main>
		<?php include("buscador.html");?>
		<hr>
				<h4>Resultado de la búsqueda</h4>
		<?php 
		$errorFecha=false;
		
		$sentencia= 'SELECT * FROM fotos,paises WHERE fotos.pais=paises.IdPais';

		if(isset($_POST["buscar"]) && strcmp($_POST["buscar"],"")!=0){
            filter_var($_POST["buscar"],FILTER_SANITIZE_STRING);
            $sentencia.=" AND fotos.titulo LIKE '%".$_POST['buscar']."%'";
		}
		if(isset($_POST["Titulo"]) && strcmp($_POST["Titulo"],"")!=0){
			filter_var($_POST["Titulo"],FILTER_SANITIZE_STRING);
			$sentencia.=" AND fotos.titulo LIKE '%".$_POST['Titulo']."%' ";
			
		}
		
		$FechaInicio=false;
		if(isset($_POST["Fecha_inicio"]) && strcmp($_POST["Fecha_inicio"],"")!=0){
			if(($fecha= strtotime($_POST["Fecha_inicio"]))===false){
				$errorFecha=true;
			}else{
				$FechaInicio=true;
				$fecha=date("Y:m:d",strtotime($_POST["Fecha_inicio"]));
				$sentencia.=" AND (fotos.fecha BETWEEN '".$fecha."' AND ";
			}
		}
		
		if($FechaInicio){
			if(isset($_POST["Fecha_final"])){
				if(strcmp($_POST["Fecha_final"],"")!=0 && strtotime($_POST["Fecha_final"])>=strtotime($_POST["Fecha_inicio"])){
					if(($fecha2= strtotime($_POST["Fecha_final"]))===false){
						$errorFecha=true;
					}else{
						$fecha2=date("Y:m:d",strtotime($_POST["Fecha_final"]));
						$sentencia.=" '".$_POST["Fecha_final"]."')";
					}
				}else{
					$time=time();
					$sentencia.=" '".$time."')";
				}
			}
		}
		
		if(isset($_POST["Pais"]) && strcmp($_POST["Pais"],"")!=0){
			$sentencia.=" AND paises.IdPais=".$_POST['Pais'];
		}
		$puesto=false;
		$resultado = mysqli_query($conexion, $sentencia);
		while($fila=mysqli_fetch_assoc($resultado)){
			if(!$puesto){
				if(isset($_POST["Buscar"]) && strcmp($_POST["Buscar"],"")!=0){
					echo "<div class='alert2'>";
					echo "Has buscado: $_POST[buscar]";
					$puesto=true;
					
				}
				if(isset($_POST["Titulo"]) && strcmp($_POST["Titulo"],"")!=0){
					if(!$puesto){
						echo "<div class='alert2'>
							Has buscado el título: $_POST[Titulo]";
						$puesto=true;
					}else{
						echo "Has buscado el título: $_POST[Titulo]";
					}
				}
				if(isset($_POST["Pais"]) && strcmp($_POST["Pais"],"")!=0){
					if(!$puesto){
						echo "<div class='alert2'>
								En el país: ".$fila['NomPais'];
						$puesto=true;
					}else {
						echo "<br>En el país: ".$fila['NomPais'];
					}
				}
				if(isset($_POST["Fecha_inicio"]) && strcmp($_POST["Fecha_inicio"],"")!=0){
					if(!$puesto){
						echo "<div class='alert2'>
							Entre las fechas: $_POST[Fecha_inicio]";
						$puesto=true;
					}else{
						echo "<br>Entre las fechas: $_POST[Fecha_inicio]";
					}
				}
				if($FechaInicio){
					if(isset($_POST["Fecha_final"]) && strcmp($_POST["Fecha_final"],"")!=0){
						echo "<br> y : $_POST[Fecha_final]";
					}else{
						echo"<br> y ahora";
					}					
				}
				if($puesto){
					echo "</div>";
				}				
			}
			$puesto=true;
			echo "<article>
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
					<b>Título: ".$fila['titulo']."</b>
				</p>
				<p>
					<b>País: ".$fila['NomPais']."</b>
				</p>
				<p>
					<b>Fecha: ".$fila['fecha']."</b>
				</p>
			</article>";
			$pais=$fila['NomPais'];
		}
		if(!$puesto){
			echo "<div class='alert'>
				No se han encontrado resultados.";
				if($errorFecha){
					echo " Inserta la fecha en un formato correcto (dd/mm/yyyy).";
				}
			echo "</div>";
		}
		mysqli_free_result($resultado);
	?>
	</main>

<?php include("footer.html");?>

</body>
</html>