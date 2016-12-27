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
            $sentencia ='SELECT * FROM albumes a, usuarios u WHERE a.Usuario='.$_SESSION['id'].' ORDER BY a.IdAlbum';
            $resultado= mysqli_query($conexion,$sentencia);
            $contador = mysqli_num_rows($resultado);
			
			while($fila=mysqli_fetch_assoc($resultado)){
				$albumes[''.$fila["IdAlbum"].''] = $fila["Titulo"];
			}
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
                <form class="album-form" action="subirfotoInsert.php" method="POST"  enctype="multipart/form-data">
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
					include("conexion.php");
					$sentencia ='SELECT * FROM paises';
					$resultado= mysqli_query($conexion,$sentencia);
						
				echo '
					<select id="paisFoto" class="formInput" type="text" name="pais_foto" autofocus required />';
						while($fila2=mysqli_fetch_assoc($resultado)){
                            echo '<option value="'.$fila2['IdPais'].'">'.$fila2['NomPais'].'</option>';
                        }
						echo '<option value="0">Ninguno</option>';
				echo'
					</select>
                    <br>
                    <label class="labelForm" for="fotoFoto">
					Foto:</label><div class="fileSubir" style="float:left;width: 157px;height:57px;background:url(img/upload.png);"><input id="fotoFoto" class="formFile" type="file" name="ruta" autofocus required /></div>
                    <br>
                    <label class="labelForm" for="albumFoto">
					Album:</label>';
                    echo '<select id="albumFoto" class="formInput" name="album_foto">';
					foreach($albumes as $x => $x_nom){
                        echo '<option value="'.$x.'">'.$x_nom.'</option>';
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
		mysqli_close($conexion);
    ?>
</body>
</html>