<?php
	//Seleccionar número de fotos subidas
	mysqli_close($conexion);
	include("conexion.php");
	
	$sentencia= 'SELECT * FROM fotos';
	$resultado = mysqli_query($conexion, $sentencia);
	$graphValues=array();
	while($fila=mysqli_fetch_assoc($resultado)){
		if(array_key_exists(date("d",strtotime($fila["fRegistro"])), $graphValues)){
			$graphValues[date("d",strtotime($fila["fRegistro"]))]++;
		}else{
			$graphValues[date("d",strtotime($fila["fRegistro"]))]=1;
		}
	}
	mysqli_free_result($resultado);
	
	// Definir imagen png

	$imgWidth=800;
	$imgHeight=400;
	// Create image and define colors
	$image=imagecreate($imgWidth, $imgHeight);
	$colorWhite=imagecolorallocate($image, 255, 255, 255);
	$colorGrey=imagecolorallocate($image, 192, 192, 192);
	$colorDarkBlue=imagecolorallocate($image, 104, 157, 228);
	$colorLightBlue=imagecolorallocate($image, 184, 212, 250);
	// Create border around image
	imageline($image, 0, 0, 0, 250, $colorGrey);
	imageline($image, 0, 0, 250, 0, $colorGrey);
	imageline($image, 249, 0, 249, 249, $colorGrey);
	imageline($image, 0, 249, 249, 249, $colorGrey);
	// Create grid
	foreach($graphValues as $x => $i){
		imageline($image, $i*25, 0, $i*25, 255, $colorGrey);
		imageline($image, 0, $i*25, 255, $i*25, $colorGrey);
	}
	// Create bar charts
	foreach($graphValues as $x => $i){
		imagefilledrectangle($image, $i*25, (250-$graphValues[$x]), ($i+1)*25, 250, $colorDarkBlue);
		imagefilledrectangle($image, ($i*25)+1, (250-$graphValues[$x])+1, (($i+1)*25)-5, 248, $colorLightBlue);
	}
	
	//Activar almacenamiento en buffer
	//ob_start();
	imagepng($image);
	//Coger lo del buffer
	//$img_src="data:image/png;base64.".base64_encode(ob_get_contents());
	
	//ob_end_clean();
	imagedestroy($image);
?>
<p>
	<img src=<?php echo $img_src;?>/>
</p>