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
		
		//Comprobación del nombre de usuario
		if(isset($_POST["nomUser"])){
			$expregNom="/^([0-9]|[a-z]|[A-Z]){3,15}$/";
			if(!preg_match($expregNom,$_POST["nomUser"])){
				$error=true;
				$msgError.="<p>El usuario debe de tener solamente letras mayúsculas, minúsculas y números. Además de ser entre 3 y 15 caracteres.</p>";
			}else{
				$nombre = $_POST["nomUser"];
			}
		}else{
			$error=true;
			$msgError.="<p>Debes de escribir un nombre de usuario.</p>";
		}
		
		//Comprobación de la contraseña
		if(isset($_POST["pass"])){
		$expregPass="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])([0-9]|[a-z]|[A-Z]|_){6,15}$/";
			if(!preg_match($expregPass,$_POST["pass"])){
				$error=true;
				$msgError.="<p>La contraseña debe de tener solamente letras mayúsculas, minúsculas y números. Además de ser entre 6 y 15 caracteres.
				Debe de contener al menos una letra minúscula, una mayúscula y un número.</p>";
			}else{
				$pass = $_POST["pass"];
			}
		}else{
			$error=true;
			$msgError.="<p>Debes de escribir una contraseña.</p>";
		}
		
		//Comprobación de repetir contraseña
		if(isset($_POST["repPass"])){
			if($_POST["pass"] == $_POST["repPass"]){
				$pass = $_POST["pass"];
			}else{
				$pass=null;
				$error=true;
				$msgError.="<p>La contraseña no se ha repetido correctamente</p>";
			}		
		}else{
			$error=true;
			$msgError.="<p>Debes repetir la contraseña y deben de ser iguales.</p>";
		}

		
		//Asignación de variables restantes
		if(isset($_POST["correo"])){
			$expregEmail="/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})$/";
			if(!preg_match($expregEmail,$_POST["correo"])){
				$error=true;
				$msgError.="<p>El correo debe de tener una arroba, y los dominios no pueden ser menores que 2 y mayores de 4 letras.</p>";
			}else{
				$correo = $_POST["correo"];
			}
		}else{
			$error=true;
			$msgError.="<p>Debes de escribir una cuenta de correo para que se te pueda identificar.</p>";
		}

		$email = $_POST["correo"];
		$sexo = $_POST["sexo"];
		$pais = $_POST["paisRegis"];
		
		//Sanear el tipo ciudad
		if(isset($_POST["ciudad"])){
			$ciudad = $_POST["ciudad"];
			filter_var($ciudad,FILTER_SANITIZE_STRING);		
		}else{
			$ciudad=null;
		}

		//Fecha de registro actual
		$fregistro= date("Y-m-d H:i:s");
		
		//Sentencias
		$sentencia="SELECT * from nothing";
		if(!$error){
			$sentencia= "INSERT INTO usuarios VALUES (null,'".$nombre."','".$pass."','".$email."','".$sexo."','".$fecha."','".$ciudad."','".$pais."','img/lacara.png','".$fregistro."')";
		}
		
		//Conexión con la base de datos
		if(!mysqli_query($conexion, $sentencia)){
			$error=true;
			$msgError.="<p>No se ha podido crear su cuenta de usuario en la base de datos. Puede que el usuario ya esté cogido.</p>";
		}
		mysqli_close($conexion);
		
		//Nueva conexión para el select de pais
		include("conexion.php");
		$sentencia="SELECT * from paises where ".$_POST["paisRegis"]."=paises.IdPais";
		$resultado = mysqli_query($conexion, $sentencia);
		
		//Emisión del error si hay
		if($error){
			echo '<div class="alert">
					'.$msgError.'
			</div>';
		}else{
			echo "
			<article class='confirmar'>
				<h4>Confirma los datos de la petición</h4>
				<p><b>Nombre: </b>$_POST[nomUser]</p>
				<p><b>Contraseña: </b> $_POST[pass]</p>
				<p><b>Correo electrónico: </b> $_POST[correo]</p>
				<p><b>Ciudad: </b> $_POST[ciudad]</p>
				";
				if($_POST['sexo']==1){
                    $sexo="Hombre";
                }
                else{
                    $sexo="Mujer";
                }
			echo "<p><b>Sexo:</b> ".$sexo."</p>
				<p><b>Fecha de nacimiento: </b> $_POST[fecha]</p>
				";
				while($fila=mysqli_fetch_assoc($resultado)){
					echo "<p><b>País: </b> ".$fila["NomPais"]."</p>";
				}
			echo "<p><b>Foto de perfil</b> <img src='img/lacara.png'</p>
				<a href='index.php'>Confirmar</a>
				<a href='index.php'>Cancelar</a>
			</article>";
		}
	</main>
	<?php
		include("footer.html");
	?>

</body>
</html>