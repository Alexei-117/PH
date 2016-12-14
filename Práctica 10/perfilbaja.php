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
            echo '<form class="album-form">';
            echo '<legend>Baja de usuario</legend>';
            echo '<p>¡CUIDADO! Estas a punto de borrar su cuenta ¿Está seguro?</p>';
            echo '<p><a class="botonJulian" href="perfildelete.php">Confirmar</a>
                    <a class="botonJulian" href="index.php">Cancelar</a></p>';
            echo '</form>';
        }
        ?>
	</main>

	<?php include("footer.html");?>

</body>
</html>