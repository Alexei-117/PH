<?php
	session_start();
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - Confirmar solicitud de álbum</title>

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
		
        $multiplicador=0.08;
		$text ="";	
        $time=time();
		$price = 2 + $_POST["number_control"] * $multiplicador * $_POST["resolution_control"]/150*0.20;
        if(isset($_POST["color_control1"])){
			$text = $_POST["color_control1"];
		}
		if(isset($_POST["color_control2"])){
			$text = $_POST["color_control2"];
			$multiplicador=0.5;
		}
		filter_var($_POST['name_control'],FILTER_SANITIZE_STRING);
		filter_var($_POST['title_control'],FILTER_SANITIZE_STRING);
		filter_var($_POST['text_control'],FILTER_SANITIZE_STRING);
		
		//Comprueba fecha
		$fecha="00-00-0000";
		if(isset($_POST["date_control"])){
			if(($fecha= strtotime($_POST["date_control"]))===false){
				$error=true;
				$msgError.="<p>La fecha debe de ser del tipo dd/mm/aaaa o dd-mm-aaaa. Entre 1900 y 2038.</p>";
			}else{
                $fecha=date("Y:m:d",strtotime($_POST["date_control"]));
            }
		}else{
			$error=true;
			$msgError="<p> Debe de colocar una fecha de envío correcta</p>";
		}
		
		//Comprueba correo
		$correo=null;
		if(isset($_POST["email_control"])){
			$expregEmail="/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})$/";
			if(!preg_match($expregEmail,$_POST["email_control"])){
				$error=true;
				$msgError.="<p>El correo debe de tener una arroba, y los dominios no pueden ser menores que 2 y mayores de 4 letras.</p>";
			}else{
				$correo = $_POST["email_control"];
			}
		}else{
			$error=true;
			$msgError.="<p>Debes de escribir una cuenta de correo correcta. </p>";
		}
		
		filter_var($_POST['direction_control'],FILTER_SANITIZE_STRING);
		
		if(!$error){
			$sentencia ='INSERT INTO solicitudes VALUES(null,"'.$_POST['album_control'].'","'
				.$_POST['name_control'].'","'.$_POST['title_control'].'","'.
				$_POST['text_control'].'","'.$correo.'","'.
				$_POST['direction_control'].'","'.$_POST['color_control'].
				'","'.$_POST['number_control'].'","'.$_POST['resolution_control'].
				'","'.$fecha.'","'.$text.'",'.time().',"'.$price.'")';
			$resultado = mysqli_query($conexion,$sentencia);
			if(!$identificador=mysqli_query($conexion, $sentencia)){
				$desc_error=mysqli_error($conexion);
				echo '<div class="alert">
						No se ha podido insertar dentro de la base de datos.
						Descripción del error:'.$desc_error.'
					 </div>';
			}
			else{
				echo "
					<form class='table-form'>
						<fieldset>
						<legend class='legend-form'>Datos de solicitud introducidos</legend>
						<label class='labelForm'>Nombre:</label><p class='fotoin'>".$_POST['name_control']."</p>
						<label class='labelForm'>Título del álbum:</label><p class='fotoin'>".$_POST['title_control']."</p>
						<label class='labelForm'>Texto adicional:</label><p class='fotoin'>".$_POST['text_control']."</p>
						<label class='labelForm'>Correo electrónico:</label><p class='fotoin'>".$_POST['email_control']."</p>
						<label class='labelForm'>Dirección:</label><p class='fotoin'>".$_POST['direction_control']."</p>
						<label class='labelForm'>Teléfono:</label><p class='fotoin'>".$_POST['tel_control']."</p>
						<label class='labelForm'>Color de portada:</label><p class='fotoin'>".$_POST['color_control']."</p>
						<label class='labelForm'>Número de copias:</label><p class='fotoin'>".$_POST['number_control']."</p>
						<label class='labelForm'>Resolución:</label><p class='fotoin'>".$_POST['resolution_control']."</p>
						<label class='labelForm'>Álbum de fotos:</label><p class='fotoin'>".$_POST['album_control']."</p>
						<label class='labelForm'>Impresión a:</label><p class='fotoin'>".$text."</p>


						<label class='labelForm'>Precio final::</label><p class='fotoin'>".$price."€</p>
						</fieldset>
					</form>";
			}
		}else{
			echo '<div class="alert">
					'.$msgError.'
			 </div>';
		}
        ?>	
	</main>
	<?php
		include("footer.html");
	?>

</body>
</html>