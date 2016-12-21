<?php
	session_start();
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - Mis albumes</title>
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
            Debe identificarse antes para poder acceder a los álbumes, tanto suyos como de otros.
        </div>';
    }
    ?>
<body>
	
    <main>
    <?php
        if(isset($_GET["user"]) && isset($_SESSION["nombre"])){
            $sentencia ='SELECT a.IdAlbum, a.Titulo, a.Descripcion, a.Fecha, p.NomPais, f.fichero
						FROM albumes a, paises p, usuarios u, fotos f
						WHERE f.album=a.IdAlbum AND a.Pais=p.IdPais AND a.Usuario=u.IdUsuario AND 
						u.IdUsuario ='.$_GET['user'].' GROUP BY a.Titulo';
            $resultado= mysqli_query($conexion,$sentencia);
            $contador = mysqli_num_rows($resultado);
            if($contador==0){
                echo '
                <form class="article-form">
                <fieldset>
                <legend class="legend-article">Aviso</legend>No se han encontrado albumes, debes crear uno antes mediante la opcion "Crear album".
                </fieldset>
                </form>';
            }
            else{
				include("miniAlbum.php");
                echo '<table class="table-form"><tr>';
                echo '<th>Titulo</th><th>Descripcion</th><th>Fecha</th><th>Pais</th>';
                while($fila=mysqli_fetch_assoc($resultado)){
                    $almacen=$fila['IdAlbum'];
					
					$miniAlbum=creaMiniatura($fila['fichero']);
                    echo '<tr>';
                    echo '<td>';
                    echo '<a class="botonJulian2" href="ver_album.php?album='.$almacen.'">';
					echo '<img class="miniAlbum" src='.$miniAlbum.' alt="Miniatura de álbum" >';
                    echo $fila['Titulo'];
                    echo '</a></td>';
                    echo '<td>'.$fila['Descripcion'].'</td>';
                    echo '<td>'.$fila['Fecha'].'</td>';
                    echo '<td>'.$fila['NomPais'].'</td>';
                    echo '</tr>';
                }
            }
            echo '</table>';
           
            mysqli_free_result($resultado);
        }
        ?>
	</main>
	<?php include("footer.html");
        mysqli_close($conexion);
    ?>
</body>
</html>