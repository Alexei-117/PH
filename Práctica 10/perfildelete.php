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
                Debe identificarse antes para poder acceder al detalle de perfil.
            </div>';
        }
	?>
	<hr>
	<main class="perfil">
        <?php
        if(isset($_SESSION["nombre"])){
            $nombre=$_SESSION['nombre'];
            setcookie("nombre","",time()-3700000);
            setcookie("contra","",time()-37000000);
            setcookie("fecha","",time()-37000000);
            setcookie("hora","",time()-3700000);
            session_destroy();
            $sentencia='DELETE FROM usuarios WHERE usuarios.NomUsuario="'.$nombre.'"';
            mysqli_query($conexion,$sentencia);
            echo '<div class="alert">
                    El perfil ha sido borrado de nuestra base de datos.
                </div>';
        }
        ?>
	</main>
	<?php 
		mysqli_close($conexion);
		include("footer.html");
	?>

</body>
</html>