<?php
	session_start();
	include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - Confirmar Registro</title>

    <link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
    <link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
    <link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		include("header.php");
	?>
	<hr>
	<main>
		<?php
		$nombre = $_POST["nomUser"];
		$pass = $_POST["Contraseña"];
		$email = $_POST["Correo"];
		$sexo = $_POST["sexo"];
		$fecha = $_POST["fecha"];
		$pais = $_POST["paisRegis"];
		$sentencia= "INSERT INTO usuarios VALUES (null,'".$nombre."','".$pass."','".$email."','".$sexo."','".$fecha."','Alicante','".$pais."','img/lacara.png','2016-12-12')";
		$error=false;
		if(!mysqli_query($conexion, $sentencia)){
			$error=true;
		}
		if($error){
			echo '<div class="alert">
					No se ha podido crear su cuenta de usuario en la base de datos.
			</div>';
		}else{
			echo "
			<article class='confirmar'>
				<h4>Confirma los datos de la petición</h4>
				<p><b>Nombre:</b>$_POST[nomUser]</p>
				<p><b>Contraseña:</b> $_POST[Contraseña]</p>
				<p><b>Correo electrónico:</b> $_POST[Correo]</p>
				<p><b>Sexo:</b> $_POST[sexo]</p>
				<p><b>Fecha de nacimiento:</b> $_POST[fecha]</p>
				<p><b>País:</b> $_POST[paisRegis]</p>
				<p><b>Foto de perfil</b> <img src='img/lacara.png'</p>
				<a href='index.php'>Confirmar</a>
				<a href='index.php'>Cancelar</a>
			</article>";
		}
		?>
	</main>
	<?php
		include("footer.html");
	?>

</body>
</html>