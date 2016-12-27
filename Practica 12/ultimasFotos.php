<?php
	$sentencia= 'SELECT * FROM fotos,paises WHERE fotos.pais=paises.IdPais ORDER BY FRegistro DESC limit 5';
	$resultado = mysqli_query($conexion, $sentencia);
	while($fila=mysqli_fetch_assoc($resultado)){
		echo "<article>
				<figure>
					<a href=";
					if(isset($_SESSION["nombre"])){
						echo "detalle.php?id=".$fila['idFoto'];
					}else{
						echo "";
					}
		echo "		><img alt=".$fila['titulo']." src='".$fila['fichero']."'/></a>
				</figure>
				<p>
					<b>Título: ".$fila['titulo']."</b>
				</p>
				<p>
					<b>País: ".$fila['NomPais']."</b>
				</p>
				<p>
					<b>Fecha: ".$fila['fecha']."</b>
				</p>
			</article>";
	}
	mysqli_free_result($resultado);
?>