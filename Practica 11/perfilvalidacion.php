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
        $error1=0;
        $error2=0;
        $error3=0;
        $error4=0;
        $cambio1=0;
        $cambio2=0;
        $cambio3=0;
        if(isset($_SESSION["nombre"])){
            $sentencia='SELECT * FROM Usuarios WHERE usuarios.NomUsuario="'.$_SESSION['nombre'].'"';
            $resultado = mysqli_query($conexion,$sentencia);
            $fila=mysqli_fetch_assoc($resultado);
            if(isset($_POST['email_control'])){
                $email=$_POST['email_control'];
                if(!filter_var($email, FILTER_SANITIZE_EMAIL)){
                    $error1=1;
                }
                else{
                    if(strcmp($email, $fila['Email'])!=0){
                        $cambio1=1;
                    }
                }
            }
            if(isset($_POST['ciudad_control'])){
                $ciudad=$_POST['ciudad_control'];
				filter_var($ciudad, FILTER_SANITIZE_STRING);
                if(strcmp($ciudad, $fila['Ciudad'])!=0){
                    $cambio2=1;
                }
            }
            if((isset($_POST['pass_control']) && isset($_POST['pass_control2'])) && $_POST['pass_control']!=null && $_POST['pass_control2']!=null) {
                if(strcmp($_POST['pass_control'], $_POST['pass_control2'])==0){
                    $pass=$_POST['pass_control'];
                    if(strcmp($pass, $fila['Clave'])!=0){
                        $cambio3=1;
                    }
                }
                else{
                    $error3=1;
                }
            }
            else{
                if((!isset($_POST['pass_control']) && isset($_POST['pass_control2'])) || (isset($_POST['pass_control']) && !isset($_POST['pass_control2']))){
                    $error4=1;
                }
            }
            if($error1+$error2+$error3+$error4==0){
                if($cambio1+$cambio2+$cambio3==0){
                    echo '<div class="alert">
                            No se ha modificado ningun valor.
                        </div>';
                }
                else{
                    echo '<form class="album-form">';
                    echo '<legend>Modificaciones:</legend>';
					$sentencia2='UPDATE usuarios SET';
                    if($cambio1==1){
                        echo '<p>Nuevo e-mail: '.$email.'</p>';
                        $sentencia2.=' Email="'.$email.'"';
                    }
                    if($cambio2==1){
                        echo '<p>Nueva ciudad: '.$ciudad.'</p>';
                        $sentencia2=' Ciudad="'.$ciudad.'"';
                    }
                    if($cambio3==1){
                        echo '<p>Nueva contraseña: '.$pass.'</p>';
                        $sentencia2=' Clave="'.$pass.'" ';
                    }
                    echo '<p><a class="botonJulian" href="perfil.php">Volver</a></p>';
                    echo '</form>';
					$sentencia2.=' WHERE usuarios.NomUsuario="'.$_SESSION['nombre'].'"';
					mysqli_query($conexion,$sentencia2);
                }
            }
            else{
                if($error1==1){
                    echo '
                    <div class="alert">
                        Estructura de e-mail incorrecto.
                    </div>';
                }
                if($error3==1){
                    echo '
                    <div class="alert">
                        Las contraseñas deben coincidir.
                    </div>';
                }
                if($error4==1){
                    echo '
                    <div class="alert">
                        Las contraseñas deben coincidir.
                    </div>';
                }
            }
        }
        ?>
	</main>

	<?php
		mysqli_close($conexion);
		include("footer.html");
	?>

</body>
</html>