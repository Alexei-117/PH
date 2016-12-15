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
		$msgError="";
		$errorSubida = array(0 => "No hay error, el fichero se subió con éxito",
		1 => "El tamaño del fichero supera la directiva upload_max_filesize el php.ini",
		2 => "El tamaño del fichero supera la directiva MAX_FILE_SIZE especificada en el formulario HTML",
		3 => "El fichero fue parcialmente subido", 
		4 => "No se ha subido un fichero",
		6 => "No existe un directorio temporal", 
		7 => "Fallo al escribir el fichero al disco",
		8 => "La subida del fichero fue detenida por la extensión");
		
		$ruta="img/lacara.png";
		if(isset($_FILES["ruta"]["name"])){
			if($_FILES["ruta"]["error"] == 0){
				$foto=$_FILES["ruta"]["tmp_name"];
				$uniq = strtotime(date("Y-m-d H:i:s"));
				$ruta="perfiles/".$_POST["nomUser"].$_FILES["ruta"]["name"];
				if(!move_uploaded_file($_FILES["ruta"]["tmp_name"],$ruta)){
					$error=true;
					$msgError.="<p>No se ha podido subir la foto</p>";
				}
				if($_FILES["ruta"]["type"] == ("image/jpeg")
					|| $_FILES["ruta"]["type"] ==("image/gif")
					|| $_FILES["ruta"]["type"] ==("image/png")
					|| $_FILES["ruta"]["type"] == ("image/bmp")
					|| $_FILES["ruta"]["type"] ==("image/vnd.microsoft.icon")
					|| $_FILES["ruta"]["type"] ==("image/tiff")
					|| $_FILES["ruta"]["type"] ==("image/svg+xml")
					){
				}else{
					$error=true;
					$msgError.="<p>La imagen no viene en un formato aceptado. Pruebe con una del tipo png, jpg-jpeg-jpe, bmp, gif, tiff o svg.</p>";
				}
				
				if(ceil($_FILES["ruta"]["size"]/(1024*1024))>50){
					$error=true;
					$msgError.="<p>Archivo demasiado grande, suba uno más pequeño.</p>";
				}
				
			}else{
				$msgError.=$errorSubida[$_FILES["ruta"]["error"]];
			}
		}
		
		
		if(isset($_POST["fecha"])){
			$fecha=explode("-",$_POST["fecha"]);
			if(sizeof($fecha)==3){
				$newFecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];
				$expreg="/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
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
		
		$expregNom="/^([0-9]|[a-z]|[A-Z]){3,15}$/";
		if(!preg_match($expregNom,$_POST["nomUser"])){
			$error=true;
			$msgError.="<p>El usuario debe de tener solamente letras mayúsculas, minúsculas y números. Además de ser entre 3 y 15 caracteres.</p>";
		}else{
			$nombre = $_POST["nomUser"];
		}
		
		$expregPass="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])([0-9]|[a-z]|[A-Z]|_){6,15}$/";
		if(!preg_match($expregNom,$_POST["pass"])){
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
		
		$email = $_POST["correo"];
		$sexo = $_POST["sexo"];
		$fecha = $_POST["fecha"];
		$pais = $_POST["paisRegis"];
		
		if(isset($_POST["ciudad"])){
			$ciudad = $_POST["ciudad"];
			filter_var($ciudad,FILTER_SANITIZE_STRING);		
		}else{
			$ciudad=null;
		}

		
		$fregistro= date("Y-m-d H:i:s");
		
		$sentencia="SELECT * from nothing";
		if(!$error){
			$sentencia= "INSERT INTO usuarios VALUES (null,'".$nombre."','".$pass."','".$email."','".$sexo."','".$newFecha."','".$ciudad."','".$pais."','".$ruta."','".$fregistro."')";
		}
	
		if(!mysqli_query($conexion, $sentencia)){
			$error=true;
			$msgError.="<p>No se ha podido crear su cuenta de usuario en la base de datos. Posiblemente exista ya el usuario o la base de datos esté caída. Pruebe con otro nombre más tarde.</p>";
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
				<p><b>Correo electrónico:</b> $_POST[correo]</p>
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
				<p><b>Foto de perfil</b> <img src='".$ruta."'</p>
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