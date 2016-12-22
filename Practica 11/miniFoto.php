<?php
	function creaMiniatura($idAlbum){
		//include("conexion.php");
		
		$src="img/lacara.png";
		if($idAlbum!=""){
			$src = $idAlbum;
		}
		
		/*$sentencia2= 'SELECT * FROM albumes,fotos WHERE album.IdAlbum ='.$idAlbum.' AND album.IdAlbum = foto.album LIMIT 1';
		$resultado2 = mysqli_query($conexion, $sentencia2);
		while($fila2=mysqli_fetch_assoc($resultado2)){
			$src = $fila2['fichero'];
		}
		mysqli_free_result($resultado2);
		mysqli_close($conexion);*/
		
		//Array de valores
		// Definir imagen png, reduciendo el tamaño original
		list($width,$height) = getimagesize($src);
		
		$newWidth=$width*0.2;
		$newHeight=$height*0.2;
		$space=5;
		$spaceH=20;
		// Create image and define colors
		$image=imagecreatetruecolor($newWidth, $newHeight);
		
		//Creamos acorde al tipo que nos pasan
		
		if(exif_imagetype($src)==2){
			$fuente = imagecreatefromjpeg($src);
		}
		if(exif_imagetype($src)==3){
			$fuente = imagecreatefrompng($src);
		}
		if(exif_imagetype($src)==1){
			$fuente = imagecreatefromgif($src);
		}
		if(exif_imagetype($src)==6){
			$fuente = imagecreate($src);
		}
		
		imagecopyresized($image,$fuente,0,0,0,0,$newWidth,$newHeight,$width,$height);
		
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