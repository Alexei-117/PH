<?php
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
		$error = false;
		$msgError="";
		
		if(isset($_POST["nomUser"])){
			$expreg="/^([0-9]|[a-z]|[A-Z]){3,15}$/";
			if(!preg_match($expreg, $_POST["nomUser"])){
				$error=true;
				$msgError.="<p>El nombre solo puede tener mayúsculas, minúsculas y números del alfabeto inglés, y debe tener entre 3 y 15 carácteres.</p>";
			}
		}else{
			$error=true;
			$msgError.="<p>Debe de añadir un nombre de usuario</p>";
		}
		
		if(isset($_POST["pass"])){
			$expreg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])([0-9]|[a-z]|[A-Z]|_){6,15}$/";
			if(!preg_match($expreg, $_POST["pass"])){
				$error=true;
				$msgError.="<p>La contraseña solo puede tener mayúsculas, minúsculas del alfabeto inglés, y números y el subrayado.
				Debe tener entre 6 y 15 carácteres. Y al menos debe de contener una minúscula, una mayúscula y un número.</p>";
			}
		}else{
			$error=true;
			$msgError.="<p>Debe de añadir una contraseña</p>";
		}
		
		if(isset($_POST["repPass"])){
			if(strcmp($_POST["pass"],$_POST["repPass"])!=0){
				$error=true;
				$msgError.="<p>El campo de repetir contraseña debe de coincidir con la contraseña</p>";
			}
		}else{
			$error=true;
			$msgError.="<p>Debe de repetir la contraseña y deben de coincidir</p>";
		}
		
		if(isset($_POST["correo"])){
			if(!filter_var($_POST["correo"],FILTER_VALIDATE_EMAIL)){
				$error=true;
				$msgError.="<p>El correo debe de ser del tipo: correo@xxx.com</p>";
			}
		}else{
			$error=true;
			$msgError.="<p>Debe de poner su correo</p>";
		}
		if(isset($_POST["fecha"])){
			$fecha=explode("-",$_POST["fecha"]);
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
	?>
	<hr>
	<main>
		<?php
		if(!$error){
			if(!isset($_POST["ciudad"])){
				$_POST["ciudad"]=null;
			}
			$sentencia= "INSERT INTO usuarios VALUES (null,'".$_POST["nomUser"]."','".$_POST["pass"]."','".$_POST["correo"]."','".$_POST["sexo"]."','".$_POST["fecha"]."','".$_POST["ciudad"]."','".$_POST["paisRegis"]."','img/lacara.png','2016-12-04')";
			$error=false;
			if(!mysqli_query($conexion, $sentencia)){
				$error=true;
				$msgError.="<p>No se ha podido hacer la inserción en la base de datos.</p>";
			}
		}
		if($error){
			echo "<div class='alert'>
					".$msgError."
					</div>";
		}else{

			echo "
			<article class='confirmar'>
				<h4>Confirma los datos de la petición</h4>
				<p><b>Nombre: </b>$_POST[nomUser]</p>
				<p><b>Contraseña: </b> $_POST[pass]</p>
				<p><b>Correo electrónico: </b> $_POST[correo]</p>
				<p><b>Sexo: </b> $_POST[sexo]</p>
				<p><b>Fecha de nacimiento: </b> $_POST[fecha]</p>
				<p><b>Ciudad: </b> $_POST[ciudad]</p>
				<p><b>País:</b> $_POST[paisRegis]</p>
				<p><b>Foto de perfil</b> <img src='img/lacara.png'</p>
				<a href='index.php'>Volver</a>
			</article>";
		}?>
	</main>
	<?php
		include("footer.html");
		mysqli_close($conexion);
	?>

</body>
</html>