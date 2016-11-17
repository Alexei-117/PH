	
	
	
	
	<header>
		<ol>
			<li>
				<a href="index.php" class="boton-menu" >Inicio</a>
			</li>
			<li>
				<div id="logo-U">
				</div>
				<img class="logo" alt="logo" src="img/logo.png">
			</li>
			<li >
				<div class="boton-ini" >Entrar
					<?php
						if(isSet($_COOKIE["nombre"])){
						$text=$_COOKIE["nombre"];
						$text2=$_COOKIE["contra"];
						echo "
						<form action='login.php' method='POST' class='ini-form'>
						  <input type='hidden' name='name' value=$text/>
						  <input type='hidden' name='password' placeholder=$text2/>
						  <fieldset class='cookie-login'>
							Hola $text, su última visita fue el $_COOKIE[fecha], a las $_COOKIE[hora]
						  </fieldset>
						  <button name='submit' value='in'>Iniciar sesión</button>
						  <button name='submit2' value='out'>Salir</button>
						</form>";

					}else{
						echo "
						<form action='login.php' method='POST' class='ini-form'>
						  <input type='text' name='name' placeholder='Nombre'/>
						  <input type='password' name='password' placeholder='contraseña'/>
						  <fieldset id='field-login'>
							Recordarme
							<input type='checkbox' name='recordar' checked='checked'/>
						  </fieldset>
						  <button name='submit' >Iniciar sesión</button>
						  <p class='mensaje'>¿No está registrado? <a href='registro.php'>¡Regístrate!</a></p>
						</form>";
					}
					?>
				</div>
			</li>
		</ol>
	</header>
