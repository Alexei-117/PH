<?php
	session_start();
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Perfil</title>
   
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
	<main class="perfil">
        <?php
        if(isset($_SESSION["nombre"])){
                
                echo '<form class="album-form" action="confirmarFoto.php" method="POST" enctype="multipart/form-data">';
                echo '<p class="tituloPerfil">Cambiar foto de perfil</p>';
                echo '<label class="labelForm" for="fotoReg">Seleccionar</label>';
                echo '<div class="fileSubir" style="margin-left:40px;float:left;width: 157px;height:57px;background:url(img/upload.png);"><input class="formFile" type="file" name="fotoUsuario" id="elemFile"></div>';
                echo '<input class="formSubmit" type="submit" name="submitFile" id="subPerf" value="Modificar"/>';
                echo '</form>';
                       
            
        }
        ?>
	</main>

	<?php include("footer.html");?>

</body>
</html>