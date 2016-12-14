		<?php
			session_start();
			include("conexion.php");
			if(isset($_COOKIE["nombre"])){
				$nombre=$_COOKIE["nombre"];
			}else{
				if(isset($_POST["name"])){
					$nombre=$_POST["name"];
				}
			}
			$sentencia= 'SELECT * FROM usuarios where usuarios.NomUsuario="'.$nombre.'"';
			$resultado = mysqli_query($conexion, $sentencia);
			$existe=false;
			$nombre=null;
			$pass=null;
			$id=null;
			while($fila=mysqli_fetch_assoc($resultado)){
				if(isset($_COOKIE["nombre"])){
					if(strcmp($_COOKIE["nombre"],$fila["NomUsuario"])==0 && strcmp($_COOKIE["contra"],$fila["Clave"])==0){
						$existe=true;
						$nombre=$fila["NomUsuario"];
						$pass=$fila["Clave"];
						$id=$fila["IdUsuario"];
					}
				}
				if(strcmp($_POST["name"],$fila["NomUsuario"])==0 && strcmp($_POST["password"],$fila["Clave"])==0){
					$existe=true;
					$nombre=$fila["NomUsuario"];
					$pass=$fila["Clave"];
					$id=$fila["IdUsuario"];
				}
			}
			
			if($existe){
				if(isset($_POST["submit"])){
						if(isset($_POST["recordar"])){
							setcookie("nombre",$nombre,time()+3600*24*30);
							setcookie("contra",$pass,time()+3600*24*30);
							setcookie("id",$id,time()+3600*24*30);
							setcookie("fecha",date("d.m.y"),time()+3600*24*30);
							setcookie("hora",date("H:i:s"),time()+3600*24*30);
						}
						$_SESSION["id"]=$id;
						$_SESSION["nombre"]=$nombre;
						$host = $_SERVER['HTTP_HOST'];
						$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
						$pag = 'index.php';
						header("Location: http://$host$uri/$pag"); 
				}else{
						setcookie("nombre","",time()-3700000);
						setcookie("contra","",time()-37000000);
						setcookie("id","",time()-37000000);
						setcookie("fecha","",time()-37000000);
						setcookie("hora","",time()-3700000);
						$host = $_SERVER['HTTP_HOST'];
						$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
						session_destroy();
						if(isset($_POST["submit2"])){
							$pag = 'index.php?popen=no';
						}else{
							$pag = 'index.php?popen=si';
						}
						header("Location: http://$host$uri/$pag"); 
				}
			}else{
				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$pag = 'index.php?popen=si';
				session_destroy();
				header("Location: http://$host$uri/$pag");
			}
			mysqli_free_result($resultado);
		?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Universal Images - login</title>
    <meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
	<link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
	<link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>
</head>

<body>

		
</body>
</html>