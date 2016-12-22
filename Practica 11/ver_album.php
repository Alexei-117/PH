<?php
	session_start();
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - Ver album</title>
  
    <link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
    <link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
    <link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>

</head>
<?php
    if(isset($_SESSION["nombre"])){
        include ("header2.php");
    }
    else{
        include("header.php");
        echo '
        <div class="alert">
            Debe identificarse antes para poder acceder al detalle de los álbumes.
        </div>';
        include("ultimasFotos.php");
    }
    ?>
<body>
	
    <main>
    <?php
        
        if(isset($_SESSION["nombre"]) && isset($_GET["album"])){
            $num=$_GET["album"];
            $sentencia ='SELECT * FROM fotos WHERE fotos.album="'.$num.'"';
            $resultado = mysqli_query($conexion,$sentencia);
            $contador = mysqli_num_rows($resultado);
            if($contador==0){
                echo '
                <form class="article-form">
                <fieldset>
                <legend class="legend-article">Aviso</legend>El album está actualmente vacio, debes insertar fotos mediante la opcion "Añadir foto a album".
                </fieldset>
                </form>';
            }
            else{
                while($fila=mysqli_fetch_assoc($resultado)){
                    $file=$fila['fichero'];
                    $pathToSave = 'img/4/';
                    $what = getimagesize($file);
                    $file_name = basename($file);
                    switch(strtolower($what['mime']))
                    {
                        case 'image/png':
                                $img = imagecreatefrompng($file);
                                $new = imagecreatetruecolor($what[0],$what[1]);
                                imagecopyresized( $new, $img, 0, 0, 0, 0, 300, 400, $what[0],$what[1] );
                                imagepng($new,$pathToSave.$file_name,9);
                                imagedestroy($new);
                            break;
                        case 'image/jpeg':
                                $img = imagecreatefromjpeg($file);
                                $new = imagecreatetruecolor($what[0],$what[1]);
                                imagecopyresized( $new, $img, 0, 0, 0, 0, 300, 400, $what[0],$what[1] );
                                imagejpeg($new,$pathToSave.$file_name);
                                imagedestroy($new);
                            break;
                        case 'image/gif':
                            $img = imagecreatefromgif($file);
                            break;
                        default: die();
                    }
                }
                $dir = opendir( "img/".$_GET["album"]);
                while (false !== ($fname = readdir( $dir ))){   
                    echo '<img src="img/'.$_GET["album"].'/'.$fname.'">';
                }
                closedir( $dir );
                /*
                 // open the directory
                $alo="img/";
                $ye="uploads/";
                  $dir = opendir( $alo );
*/
                  // loop through it, looking for any/all JPG files:
                  /*while (false !== ($fname = readdir( $dir ))) {
                    // parse path for the extension
                    $info = pathinfo("img/" . $fname);
                    // continue only if this is a JPEG image
                    if ( strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'png')
                    {
                        if ( strtolower($info['extension']) == 'jpg'){
                            // load image and get image size
                              $img = imagecreatefromjpeg( "{$alo}{$fname}" );
                              $width = imagesx( $img );
                              $height = imagesy( $img );

                              // calculate thumbnail size
                              $new_width = 300;
                              $new_height = floor( $height * ( 200 / $width ) );

                              // create a new temporary image
                              $tmp_img = imagecreatetruecolor( $new_width, $new_height );

                              // copy and resize old image into new image
                              imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

                              // save thumbnail into a file
                              $super=$_GET["album"].'/';
                              if(!is_dir($super)){
                                mkdir("img/".$super);
                              }
                              imagejpeg( $tmp_img, "{$alo}{$super}{$fname}" );
                        }
                      if ( strtolower($info['extension']) == 'png'){
                          // load image and get image size
                              $img = imagecreatefrompng( "{$alo}{$fname}" );
                              $width = imagesx( $img );
                              $height = imagesy( $img );

                              // calculate thumbnail size
                              $new_width = 300;
                              $new_height = floor( $height * ( 200 / $width ) );

                              // create a new temporary image
                              $tmp_img = imagecreatetruecolor( $new_width, $new_height );

                              // copy and resize old image into new image
                              imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

                              // save thumbnail into a file
                              $super=$_GET["album"].'/';
                            if(!is_dir($super)){
                                mkdir("img/". $super);
                            }
                              
                              imagepng( $tmp_img, "{$alo}{$super}{$fname}" );
                        }
                      }
                  }*/
                /*
                    // close the directory
                    closedir( $dir );
                    $ye="uploads/";
                    $dir = opendir( $_GET["album"] );
                    while (false !== ($fname = readdir( $dir ))){
                        
                        echo '<img src='.$fname.'>';
                    }*/
                }
            }
        ?>
	</main>
	<?php include("footer.html");
        mysqli_close($conexion);
    ?>
</body>
</html>