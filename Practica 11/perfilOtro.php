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
                Debe identificarse antes para poder acceder al perfil de otra persona.
            </div>';
            include("ultimasFotos.php");
        }
	?>
	<hr>
	<main class="perfil">
        <?php
        if(isset($_GET["user"])){
            
            $sentencia ='SELECT * FROM usuarios u, paises p WHERE u.IdUsuario="'.$_GET['user'].'" AND u.Pais=p.IdPais';
            $resultado = mysqli_query($conexion,$sentencia);
            $error=false;
            if(!mysqli_query($conexion, $sentencia)){
                $error=true;
            }
            if($error){
                $desc_error=mysqli_error($conexion);
                echo '<div class="alert">
                        No se ha podido acceder a los datos del perfil ajeno.'.$desc_error.'
                </div>';
            }else{
                $fila=mysqli_fetch_assoc($resultado);
                if($fila['Sexo']==1){
                    $sexo="Hombre";
                }
                else{
                    $sexo="Mujer";
                }
                echo '<div class="divPerfil">
                        
                        <p class="tituloPerfil">Datos del perfil</p>
                        <img class="ifoto-perfil" src="'.$fila['Foto'].'">
                        <p>
                        
                        <b>Nombre: </b>'.$fila['NomUsuario'].'
                        </p>
                        <p>
                        <b>Correo electrónico: </b>'.$fila['Email'].'
                        </p>
                        <p>
                        <b>País: </b> '.$fila['NomPais'].'
                        </p>
                        <p>
                        <b>Ciudad: </b> '.$fila['Ciudad'].'
                        </p>
                        <p>
                        <b>Sexo: </b> '.$sexo.'
                        </p>
                        <p>
                        <b>Nacimiento: </b> '.$fila['FNacimiento'].'
                        </p>
                        <a href="misalbumes.php?user='.$_GET["user"].'"><p class="botonJulian">Sus álbumes</p></a>
                        </div>';
                       
            }
        }
        ?>
	</main>

	<?php 
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		include("footer.html");
	?>

</body>
</html>