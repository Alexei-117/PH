<?php
	session_start();
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - Confirmar álbum</title>

    <link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
    <link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
    <link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>
	<?php
		include("header2.php");
	?>
	<hr>
	<main>
        <?php
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
        $sentencia ='INSERT INTO solicitudes VALUES(null,"'.$_POST['album_control'].'","'
            .$_POST['name_control'].'","'.$_POST['title_control'].'","'.
            $_POST['text_control'].'","'.$_POST['email_control'].'","'.
            $_POST['direction_control'].'","'.$_POST['color_control'].
            '","'.$_POST['number_control'].'","'.$_POST['resolution_control'].
            '","'.$_POST['date_control'].'","'.$text.'",'.time().',"'.$price.'")';
        $resultado = mysqli_query($conexion,$sentencia);
        $error=false;
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
        ?>	
	</main>
	<?php
		include("footer.html");
	?>

</body>
</html>