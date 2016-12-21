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
            $sentencia ='UPDATE usuarios SET Foto="img/lacara.png" WHERE usuarios.NomUsuario="'.$_SESSION['nombre'].'"';
            $resultado = mysqli_query($conexion,$sentencia);
            $error=false;
            if(!mysqli_query($conexion, $sentencia)){
                $error=true;
            }
            if($error){
                $desc_error=mysqli_error($conexion);
                echo '<div class="alert">
                        No se ha podido acceder a los datos de perfil, debes iniciar sesión.'.$desc_error.'
                </div>';
            }else{
                echo '<div class="divPerfil">';
                echo '<p class="tituloPerfil">Cambio realizado</p>';
                echo '<p>Su foto de perfil ha sido borrada.</p>';
                echo '<a href="perfil.php"><p class="botonJulian">Volver a perfil</p></a>';
            }
        }
        ?>
	</main>

	<?php include("footer.html");?>

</body>
</html>