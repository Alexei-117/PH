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
                Debe identificarse antes de poder editar sus datos de perfil.
            </div>';
            include("ultimasFotos.php");
        }
	?>
	<hr>
	<main class="perfil">
        <?php
        if(isset($_SESSION["nombre"])){
            $sentencia ='SELECT * FROM usuarios u WHERE u.NomUsuario="'.$_SESSION['nombre'].'"';
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
                echo '<form class="album-form" action="perfilvalidacion.php" method="POST">
                        <fieldset>
                        <legend>Modificar datos</legend>
                        <label class="labelForm" for="emailInput">E-mail:</label><input id="emailInput" class="formInput" type="text" name="email_control" value="'.$fila['Email'].'"pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required />
                        <br>
                        <label class="labelForm" for="ciudadInput">Ciudad:</label><input id="ciudadInput" class="formInput type="text" name="ciudad_control" value="'.$fila['Ciudad'].'" required/>
                        <br>
                        <label class="labelForm" for="passInput">Nueva contraseña:</label><input id="passInput" class="formInput type="text" name="pass_control" >
                        <br>
                        <label class="labelForm" for="passInput2">Repetir contraseña:</label><input id="passInput2" class="formInput type="text" name="pass_control2" >
                        <br>
                        <label for="subInput"></label><input id="subInput" class="formSubmit" type="submit" name="submit_control" value="Confirmar modificaciones">
                        </fieldset>
                        </form>';
                          
               
            }
        }
        ?>
	</main>

	<?php include("footer.html");?>

</body>
</html>