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
		$error=false;
		
		if(isset($_POST["fecha"])){
			$fecha=explode("-",$_POST["fecha"]);
			if(sizeof($fecha)==3){
				$newFecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];
				$expreg="/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/";
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
		
		$expregNom="/^([0-9]|[a-z]|[A-Z]){3,15}$/";
		if(preg_match($expregNom,$_POST["nomUser"])){
			$error=true;
			$msgError.="<p>El usuario debe de tener solamente letras mayúsculas, minúsculas y números. Además de ser entre 3 y 15 caracteres.</p>";
		}else{
			$nombre = $_POST["nomUser"];
		}
		
		$expregPass="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])([0-9]|[a-z]|[A-Z]|_){6,15}$/";
		if(preg_match($expregNom,$_POST["pass"])){
			$error=true;
			$msgError.="<p>La contraseña debe de tener solamente letras mayúsculas, minúsculas y números. Además de ser entre 6 y 15 caracteres.
			Debe de contener al menos una letra minúscula, una mayúscula y un número.</p>";
		}else{
			$pass = $_POST["pass"];
		}
		
		if($_POST["pass"] == $_POST["repPass"]){
			$pass = $_POST["pass"];
		}else{
			$error=true;
			$msgError.="<p>La contraseña no se ha repetido correctamente</p>";
		}
		
		$email = $_POST["Correo"];
		$sexo = $_POST["sexo"];
		$fecha = $_POST["fecha"];
		$pais = $_POST["paisRegis"];
		
		if(!$error){
			$sentencia= "INSERT INTO usuarios VALUES (null,'".$nombre."','".$pass."','".$email."','".$sexo."','".$newFecha."','Alicante','".$pais."','img/lacara.png','2016-12-12')";
		}
	
		if(!mysqli_query($conexion, $sentencia)){
			$error=true;
			$msgError.="<p>No se ha podido crear su cuenta de usuario en la base de datos.</p>"
		}
		if($error){
			echo '<div class="alert">
					'.$msgError.'
			</div>';
		}else{
			echo "
			<article class='confirmar'>
				<h4>Confirma los datos de la petición</h4>
				<p><b>Nombre:</b>$_POST[nomUser]</p>
				<p><b>Contraseña:</b> $_POST[pass]</p>
				<p><b>Correo electrónico:</b> $_POST[Correo]</p>
				";
				if($_POST['sexo']==1){
                    $sexo="Hombre";
                }
                else{
                    $sexo="Mujer";
                }
			echo"<p><b>Sexo:".$sexo."</b></p>
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