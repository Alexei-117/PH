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
            Debe identificarse antes para poder acceder a la lista de las fotos de un usuario.
        </div>';
        include("ultimasFotos.php");
    }
    ?>
<body>
	
    <main>
    <?php
        
        if(isset($_SESSION["nombre"])){
            $num=$_GET["usuario"];
            $sentencia ='SELECT * FROM fotos WHERE fotos.album='.$num;
            $resultado = mysqli_query($conexion,$sentencia);
            $contador = mysqli_num_rows($resultado);
            if($contador==0){
                echo '
                <form class="article-form">
                <fieldset>
                <legend class="legend-article">Aviso</legend>Este usuario no tiene fotos.
                </fieldset>
                </form>';
            }
            else{
                echo '<form class="table-form">';

                
                while($fila=mysqli_fetch_assoc($resultado)){
                
                echo '<fieldset>';
                echo '<figure>';
                echo '<img src="'.$fila['fichero'].'" height=200px width=80%>';
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
                }

                echo '</form>';
            }

        }
        ?>
	</main>
	<?php include("footer.html");
        mysqli_close($conexion);
    ?>
</body>
</html>