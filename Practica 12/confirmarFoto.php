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
            $msgError=array(0 => "No hay error, el fichero se subió con éxito", 1 => "El tamaño del fichero supera la directiva upload_max_filesize el php.ini", 2 => "El tamaño del fichero supera la directiva MAX_FILE_SIZE especificada en el formulario HTML", 3 => "El fichero fue parcialmente subido", 4 => "No se ha subido un fichero", 6 => "No existe un directorio temporal", 7 => "Fallo al escribir el fichero al disco", 8 => "La subida del fichero fue detenida por la extensión");
            if($_FILES['fotoUsuario']['error']>0){
                echo '<div class="alert">No se ha podido cargar la imagen. '.$msgError[$_FILES['fotoUsuario']['error']];
            }
            else{
                $dir_subida='perfiles/';
                $foto=$_FILES['fotoUsuario']["tmp_name"];
                $uniq = strtotime(date("Y-m-d H:i:s"));
                $ruta=$dir_subida.$uniq.$_FILES['fotoUsuario']["name"];
                if($_FILES['fotoUsuario']["type"] == ("image/jpeg")
                    || $_FILES['fotoUsuario']["type"] ==("image/gif")
                    || $_FILES['fotoUsuario']["type"] ==("image/png")
                    || $_FILES['fotoUsuario']["type"] == ("image/bmp")
                    || $_FILES['fotoUsuario']["type"] ==("image/vnd.microsoft.icon")
                    || $_FILES['fotoUsuario']["type"] ==("image/tiff")
                    || $_FILES['fotoUsuario']["type"] ==("image/svg+xml")
                    ){
                    $sentencia ='UPDATE usuarios SET Foto="'.$dir_subida.$_SESSION['nombre'].$_FILES['fotoUsuario']['name'].'" WHERE usuarios.NomUsuario="'.$_SESSION['nombre'].'"';
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
                        if(file_exists($dir_subida.$_SESSION['nombre'].$_FILES['fotoUsuario']['name'])){
                        unlink($dir_subida.$_SESSION['nombre'].$_FILES['fotoUsuario']['name']);
                    }
                    move_uploaded_file($_FILES['fotoUsuario']['tmp_name'], $dir_subida.$_SESSION['nombre'].$_FILES['fotoUsuario']['name']);
                    echo '<div class="divPerfil">';
                    echo '<p class="tituloPerfil">Cambio realizado</p>';
                    echo '<p>Su foto de perfil ha sido actualizada</p>';
                    echo '<a href="perfil.php"><p class="botonJulian">Volver a perfil</p></a>';
                    }
                }
                else{
                    echo '<div class="alert">
                        Error al subir la foto.
                    </div>';
                }
            }
        }
        ?>
	</main>

	<?php include("footer.html");?>

</body>
</html>