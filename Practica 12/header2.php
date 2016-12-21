<header>
    <!--<li style="float:right" class="li-logo">
			<div id="logo-U">
                
			</div>
            <img class="logo2" alt="logo" src="img/logo.png">
			-->
    
        <div class="logoJulian"><table class="logo"><tr><td>Universal Images</td><td><div id="logo-U"></div></td></tr></table></div>	
        
        <?php
			if(isset($_SESSION["nombre"])){
				echo "<p class='saludo'>Hola ". $_SESSION['nombre']." </p>";
			}
			?>
    <ul class="menuJulian">
            
        
  
		<li class="menuBloque">
			<a class="menuEnlace" href="index.php"  >Inicio</a>
		</li>
		<li class="menuBloque">
			<a class="menuEnlace" href="subirfoto.php" >Subir foto</a>
		</li>
		<li class="menuBloque">
			<a class="menuEnlace" href="misalbumes.php?user=<?php echo "'".$_SESSION["id"]."'"?>" >Mis Álbumes</a>
		</li >
		<li class="menuBloque">
			<a class="menuEnlace" href="crearAlbum.php" >Crear Álbum</a>
		</li>
		<li class="menuBloque">
			<a class="menuEnlace" href="solicitar_album.php" >Solicitar Álbum</a>
		</li>
		
		
			<li class="menuBloque">
				<a class="menuEnlace" href="perfil.php" >Ir a perfil</a>
			</li>
			<li class="menuBloque">
				<a class="menuEnlace" href="index.php?desactiva=1" >Cerrar sesión</a>
			</li>
		
	</ul>
</header>