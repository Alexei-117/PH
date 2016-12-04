<?php
	session_start();
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - Subir foto</title>
  
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
            Debe identificarse antes para poder acceder al detalle de los albumes
        </div>';
        include("ultimasFotos.php");
    }
    ?>
<body>
	
    <main>
        <?php
        if(isset($_SESSION["nombre"])){
            $sentencia ='SELECT * FROM albumes a, usuarios u WHERE a.Usuario=u.IdUsuario AND u.NomUsuario="'.$_SESSION['nombre'].'" ORDER BY a.IdAlbum';
            $resultado= mysqli_query($conexion,$sentencia);
            $contador = mysqli_num_rows($resultado);
            if($contador==0){
                echo '
                <form class="article-form">
                <fieldset>
                <legend class="legend-article">Aviso</legend>No se han encontrado albumes disponibles. Debes crear uno antes de subir una foto.
                </fieldset>
                </form>';
            }
            else{
                echo '
                <form class="album-form" action="subirfotoInsert.php" method="POST">
                    <fieldset>
                    <legend class="legend-form">Subir foto</legend>
                    <label class="labelForm" for="nameFoto">
					Titulo:</label><input id="nameFoto" class="formInput" type="text" name="name_foto" autofocus required />
                    <br>
                    <label class="labelForm" for="dateFoto">
					Fecha:</label><input id="dateFoto" class="formInput" type="date" name="date_foto" autofocus required />
                    <br>
					<label class="labelForm" for="descFoto">
					Descripción:</label><input id="descFoto" class="formInput" type="text" name="desc_foto" autofocus/>
                    <br>
                    <label class="labelForm" for="paisFoto">
					Pais:</label>
					 ';
					$sentencia ='SELECT * FROM paises';
					$resultado2= mysqli_query($conexion,$sentencia);
						
				echo '
					<select id="paisFoto" class="formInput" type="text" name="pais_foto" autofocus required />';
						while($fila2=mysqli_fetch_assoc($resultado2)){
                            echo '<option value="'.$fila2['IdPais'].'">'.$fila2['NomPais'].'</option>';
                        }
				echo'
					</select>
                    <br>
                    <label class="labelForm" for="fotoFoto">
					Foto:</label><input id="fotoFoto" class="formInput" type="text" name="foto_foto" autofocus required />
                    <br>
                    <label class="labelForm" for="albumFoto">
					Album:</label>';
                    echo '<select id="albumFoto" class="formInput" name="album_foto">';
					while($fila=mysqli_fetch_assoc($resultado)){
                        echo '<option value="'.$fila['IdAlbum'].'">'.$fila['Titulo'].'</option>';
                    }
                    echo '</select>
                    <br>
                    </fieldset>
                    <label for="subFoto"></label><input id="subFoto" class="formSubmit" type="submit" name="submit_Foto" value="Confirmar"/>
                </form>';
            }
           
        }
        ?>
	</main>
	<?php include("footer.html");
	mysqli_free_result($resultado);
	mysqli_free_result($resultado2);
    mysqli_close($conexion);
    ?>
</body>
</html>