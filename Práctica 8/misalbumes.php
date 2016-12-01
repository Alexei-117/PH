<?php
	session_start();
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - Mis álbumes</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
    <link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
    <link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>

</head>
<?php
    if(isset($_SESSION["nombre"])){
        include ("header2.php");
    }
    else{
        include("header.php");
        echo '
        <div class="alert">
            Debe identificarse antes para poder acceder a sus álbumes
        </div>';
        include("ultimasFotos.php");
    }
    ?>
<body>
	
    <main>
    <?php
        if(isset($_SESSION["nombre"])){
            $sentencia ='SELECT a.IdAlbum, a.Titulo, a.Descripcion, a.Fecha, p.NomPais FROM albumes a, paises p, usuarios u WHERE a.Pais=p.IdPais AND a.Usuario=u.IdUsuario AND u.NomUsuario="'.$_SESSION['nombre'].'" ORDER BY a.IdAlbum';
            $resultado= mysqli_query($conexion,$sentencia);
            $contador = mysqli_num_rows($resultado);
            if($contador==0){
                echo '
                <form class="article-form">
                <fieldset>
                <legend class="legend-article">Aviso</legend>No se han encontrado álbumes, debes crear uno antes mediante la opción "Crear álbum".
                </fieldset>
                </form>';
            }
            else{
                echo '<form class="table-form">';
                echo '<table><tr>';
                echo '<th>Titulo</th><th>Descripcion</th><th>Fecha</th><th>Pais</th>';
                while($fila=mysqli_fetch_assoc($resultado)){
                    $almacen=$fila['IdAlbum'];
                    echo '<tr>';
                    echo '<td>';
                    echo '<a href="ver_album.php?album='.$almacen.'">';
                    echo $fila['Titulo'];
                    echo '</td>';
                    echo '<td>'.$fila['Descripcion'].'</td>';
                    echo '<td>'.$fila['Fecha'].'</td>';
                    echo '<td>'.$fila['NomPais'].'</td>';
                    echo '</tr>';
                }
            }
            echo '</table>';
            echo '</form>';
            mysqli_free_result($resultado);
            //mysqli_close($conexion);
        }
        ?>
	</main>
	<?php include("footer.html");
        mysqli_close($conexion);
    ?>
</body>
</html>