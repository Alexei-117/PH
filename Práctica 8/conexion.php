<?php
        $servidor="localhost";
        $usuario="usuarioprueba";
        $contrasenya="prueba";
        $BD="pibd";
        $conexion=mysqli_connect($servidor,$usuario,$contrasenya,$BD);
        if(!mysqli_ping($conexion)){
            die('<strong>No pudo conectarse:</strong>'.mysqli_connect_error());
        }
	?>