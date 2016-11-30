		<?php
			session_start();
			if(($_POST["name"]=="test" && $_POST["password"]=="test")
				|| ($_POST["name"]=="pepito" && $_POST["password"]=="pepito1234")
				|| ($_POST["name"]=="jaja" && $_POST["password"]=="no")){
				if(isset($_POST["submit"])){
					if(isset($_POST["recordar"])){
						setcookie("nombre",$_POST["name"],time()+3600*24*30);
						setcookie("contra",$_POST["password"],time()+3600*24*30);
						setcookie("fecha",date("d.m.y"),time()+3600*24*30);
						setcookie("hora",date("H:i:s"),time()+3600*24*30);
					}
					$_SESSION["nombre"]=$_POST["name"];
					$host = $_SERVER['HTTP_HOST'];
					$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
					$pag = 'index.php';
					header("Location: http://$host$uri/$pag"); 
				}
			}elseif(isset($_COOKIE["nombre"])){
				if(($_COOKIE["nombre"]=="test" && $_COOKIE["contra"]=="test")
				|| ($_COOKIE["nombre"]=="pepito" && $_COOKIE["contra"]=="pepito1234")
				|| ($_COOKIE["nombre"]=="jaja" && $_COOKIE["contra"]=="no")){
					if(isset($_POST["submit"])){
						if(isset($_POST["recordar"])){
							setcookie("nombre",$_POST["name"],time()+3600*24*30);
							setcookie("contra",$_POST["password"],time()+3600*24*30);
							setcookie("fecha",date("d.m.y"),time()+3600*24*30);
							setcookie("hora",date("H:i:s"),time()+3600*24*30);
						}
						$_SESSION["nombre"]=$_POST["name"];
						$host = $_SERVER['HTTP_HOST'];
						$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
						$pag = 'index.php';
						header("Location: http://$host$uri/$pag"); 
					}else{
						setcookie("nombre","",time()-3700000);
						setcookie("contra","",time()-37000000);
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
				}
			}else{
				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$pag = 'index.php?popen=no';
				header("Location: http://$host$uri/$pag"); 
			}
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