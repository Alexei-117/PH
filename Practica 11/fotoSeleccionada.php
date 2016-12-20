<?php 

    echo "<main><h1>Fotos seleccionadas de la semana</h1>";
    if(($fichero=file("fotosSeleccion.ini"))==false){
        echo "<div class='alert'> No se puede acceder al fichero de fotos seleccionadas</div>";
    }else{
        $numLineas = count($fichero);
        $linea=rand(0,$numLineas-1);
        $contenido=explode("#",$fichero[$linea]);
        
        include("conexion.php");
        $sentencia2="SELECT * from fotos,paises where idFoto='".$contenido[1]."' AND fotos.pais=paises.IdPais";  
        $resultado2= mysqli_query($conexion, $sentencia2);
        while($fila2=mysqli_fetch_assoc($resultado2)){
            echo "<article>
                    <figure>
                    <a href=";
                if(isset($_SESSION["nombre"])){
                    echo "detalle.php?id=".$fila2['idFoto'];                     
                }else{
                    echo "";
                }
            echo "		><img alt=".$fila2['fichero']." src='".$fila2['fichero']."'/></a>
                </figure>
				<p>
					<b>Título: ".$fila2['titulo']."</b>
				</p>
				<p>
					<b>País: ".$fila2['NomPais']."</b>
				</p>
				<p>
					<b>Fecha: ".$fila2['fecha']."</b>
				</p>
                <p>
                    <b>Por el usuario: ".$contenido[0]."</b>
                </p>
                <p>
                    <b>Comentario: ".$contenido[2]."</b>
                </p>
            </article>";
            echo "</main>";
        }
    }
    mysqli_free_result($resultado2);
?>