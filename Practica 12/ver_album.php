<?php
	session_start();
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - Ver album</title>
  
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
            Debe identificarse antes para poder acceder al detalle de los álbumes.
        </div>';
        include("ultimasFotos.php");
    }
    ?>
<body>
	
    <main>
    <?php
        
        if(isset($_SESSION["nombre"]) && isset($_GET["album"])){
            $num=$_GET["album"];
            $sentencia ='SELECT * FROM fotos WHERE fotos.album='.$num;
            $resultado = mysqli_query($conexion,$sentencia);
            $contador = mysqli_num_rows($resultado);
            if($contador==0){
                echo '
                <form class="article-form">
                <fieldset>
                <legend class="legend-article">Aviso</legend>El album está actualmente vacio, debes insertar fotos mediante la opcion "Añadir foto a album".
                </fieldset>
                </form>';
            }
            else{
                mysqli_free_result($resultado);
				if(!isset($_GET["pag"])){
					$sentencia ='SELECT * FROM fotos WHERE fotos.album='.$num.' LIMIT 0,10';
				}else{
					if($contador>$_GET["pag"]*10){
						$sentencia ='SELECT * FROM fotos WHERE fotos.album='.$num.' LIMIT '.($_GET["pag"]*10).','.($_GET["pag"]*10+10).'';
					}else{
						    echo '
							<form class="article-form">
							<fieldset>
							<legend class="legend-article">Aviso</legend>No hay tantas fotos como para alcanzar esta página, retroceda.
							</fieldset>
							</form>';
					}
				}
				 $resultado = mysqli_query($conexion,$sentencia);
                include("miniAlbum.php");
                while($fila=mysqli_fetch_assoc($resultado)){
					$miniAlbum=creaMiniatura($fila['fichero']);
					echo '<a  href="';
						if(isset($_SESSION["nombre"])){
							echo "detalle.php?id=".$fila['idFoto'];
						}else{
							echo "";
						}
					echo '"><img style="box-shadow: 0 0 5px 5px #333, 0 5px 5px 0 rgba(0, 0, 0, 0.24);padding:5px;margin-left:6px;margin-right:6px;margin-top:6px;" class="miniAlbum" src='.$miniAlbum.' alt="Miniatura de álbum" ></a>';
                }
				if($contador>10){
					echo "<footer class='menuJulian'><ol class='menuBloque'>";
					for($i=0;$i<$contador;$i=$i+10){
						echo "<a class='menuEnlace' href='ver_album.php?album=".$num."&pag=".ceil($i/10)."'>".ceil(($i+1)/10)."</a>";
					}
					echo "</ol></footer>";
				}
				/*
                echo '<form class="album-form">';
                echo '<fieldset>';
                echo '<figure >';
				echo "<a href=";
					if(isset($_SESSION["nombre"])){
						echo "detalle.php?id=".$fila['idFoto'];
					}else{
						echo "";
					}
				echo "><img style='height:200px;width:300px;' alt=".$fila['titulo']." src='".$fila['fichero']."' /></a>";
                echo '</figure>';
                //echo '<legend class="legend-foto">Datos</legend>';
                    echo '<label class="labelForm">Título: </label>';
                echo '<p class="fotoin">'.$fila['titulo'].'</p>';
                    echo '<label class="labelForm">Fecha: </label>';
                echo '<p class="fotoin">'.$fila['fecha'].'</p>';
                    echo '<label class="labelForm">Fecha subida: </label>';
                echo '<p class="fotoin">'.$fila['fRegistro'].'</p>';
                    echo '<label class="labelForm">Descripcion: </label>';
                echo '<p class="fotodesc">'.$fila['descripcion'].'</p>';

                echo '</fieldset>';
                    echo '</form>';
                    */
            }

        }
        ?>
	</main>
	<?php 
		include("footer.html");
        mysqli_close($conexion);
    ?>
</body>
</html>