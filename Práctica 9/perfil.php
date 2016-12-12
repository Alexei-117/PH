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
            
            $sentencia ='SELECT * FROM usuarios u, paises p WHERE u.NomUsuario="'.$_SESSION['nombre'].'" AND u.Pais=p.IdPais';
            $resultado = mysqli_query($conexion,$sentencia);
            $error=false;
            if(!mysqli_query($conexion, $sentencia)){
                $error=true;
            }
            if($error){
                $desc_error=mysqli_error($conexion);
                echo '<div class="alert">
                        No se ha podido acceder a los datos de perfil, debes iniciar sesion.'.$desc_error.'
                </div>';
            }else{
                $fila=mysqli_fetch_assoc($resultado);
                if($fila['Sexo']==1){
                    $sexo="Hombre";
                }
                else{
                    $sexo="Mujer";
                }
                echo '<form class="album-form">
                        <legend>Datos personales:</legend>
                        <img src="img/lacara.png">
                        <p>
                        <b>Editar foto de perfil:</b>
                        </p>

                            <input class="botonOcultable" name="imagen" type="file" />
                            <input type="submit" value="subir">
                        <p>
                        <b>Nombre:</b>'.$fila['NomUsuario'].'
                        </p>
                        <p>
                        <b>Correo electrónico:</b>'.$fila['Email'].'
                        </p>
                        <p>
                        <b>Edad:</b> '.$fila['NomUsuario'].'
                        </p>
                        <p>
                        <b>Pais:</b> '.$fila['NomPais'].'
                        </p>
                        <p>
                        <b>Ciudad:</b> '.$fila['Ciudad'].'
                        </p>
                        <p>
                        <b>Sexo:</b> '.$sexo.'
                        </p>
                        <p>
                        <b>Nacimiento:</b> '.$fila['FNacimiento'].'
                        </p>
                        <p>
                        <b>Edad:</b> '.$fila['NomUsuario'].'
                        </p>
                        </form>
                        <form class="album-form">
                        <legend>Últimas fotos:</legend>
                        <p>
                        <b>Últimas fotos:</b>
                        </p>
                        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
                        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
                        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
                        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
                        </form>    
                        <form class="album-form">
                        <legend>Álbumes:</legend>
                        <p>
                        <b>Álbumes:</b>
                        </p>
                        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
                        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
                        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
                        <img hspace="40" src="img/lacara.png" style="width:160px;height:90px;">
                        </form>';
            }
        }
        ?>
	</main>

	<?php include("footer.html");?>

</body>
</html>