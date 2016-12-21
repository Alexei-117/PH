<?php
	//Seleccionar número de fotos subidas
	function creaImagen(){
		include("conexion.php");
		
		$sentencia= 'SELECT * FROM fotos';
		$resultado = mysqli_query($conexion, $sentencia);
		$graphValues=array(0,0,0,0,0,0,0,0);
		while($fila=mysqli_fetch_assoc($resultado)){
			/*if(array_key_exists(date("d",strtotime($fila["fRegistro"])), $graphValues)){
				$graphValues[date("d",strtotime($fila["fRegistro"]))]++;
			}else{
				$graphValues[date("d",strtotime($fila["fRegistro"]))]=1;
			}*/
			(int) $dia = intval(floor((time()-strtotime($fila["fRegistro"]))/(60*60*24)));
			if($dia<=7 && $dia>=0){
				$graphValues[$dia]=$graphValues[$dia]+1;
			}
		}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		
		//Array de valores
		$valores=array();
		$i=0;
		foreach($graphValues as $x => $valor){
			$valores[$i]=$valor;
			$i++;
		}
		
		
		// Definir imagen png
		$width=800;
		$height=400;
		$space=5;
		$spaceH=20;
		// Create image and define colors
		$image=imagecreate($width, $height);
		
		if(count($valores!=0)){
			$tamanyoColumna = $width/ count($valores);
		}else{
			$tamanyoColumna = $width/7;
		}
		//Colores que va a admitir
		$colorWhite=imagecolorallocate($image, 255, 255, 255);
		$colorGrey=imagecolorallocate($image, 192, 192, 192);
		$textColor = imagecolorallocate($image,0,0,0);
		
		// Create border around image
		imagefilledrectangle($image, 0,  $height-$spaceH, $width,  $height-$space, $colorGrey);
		imagefilledrectangle($image, $spaceH,  $height, $space, 0, $colorGrey);
		
		// Create grid
		$maxValor=0;
		for($i=0;$i <count($graphValues); $i++){
			$maxValor = max($maxValor, $valores[$i]);
		}
		
		//Algoritmo de pintado
		for($i=count($valores)-1;$i>=0;$i--){
			$alturaColumn = ($valores[$i]/$maxValor)*$height;
			$xi = (7-$i) * $tamanyoColumna+ $space*2;
			$yi = $height - $alturaColumn;
			$xf = (7-$i+1)*$tamanyoColumna -$space;
			$yf = $height - $spaceH;
			
			//Leyenda
			$colorAmarillo=imagecolorallocate($image, 255-$i*8, 255-$i*6, $i*20);
			$colorAmarilloLigero=imagecolorallocate($image, 200-$i*8, 215-$i*6, $i*20);

			//Valores
			imagestring($image,2,$xi + $space*2, $yf , "Hace ".$i." días", $textColor);
			imagestring($image, $space, $space*2 ,$yi, "".$valores[$i], $textColor);
			if($valores[$i]>0){
				//Rellenado de los cuadrados
				imagefilledrectangle($image,$xi,$yf,$xf,$yi,$colorAmarillo);
				
				//Lineas 3d
				/*imagefilledrectangle($image,$xi,$yf,$xi+5,$yi,$colorAmarilloLigero);
				imagefilledrectangle($image,$xi,$yi,$xf,$yi+5,$colorAmarilloLigero);
				imagefilledrectangle($image,$xf,$yi,$xf-5,$yf,$colorAmarilloLigero);*/
			}
		}
		
		//Activar almacenamiento en buffer
		//header("Content-type: image/png"); Solo lo necesitaremos si la página entera es png
		ob_start();
		imagepng($image);
		//Coger lo del buffer
		$img_src="data:image/png;base64,".base64_encode(ob_get_contents());
		
		ob_end_clean();
		imagedestroy($image);
		return $img_src;
	}
?>