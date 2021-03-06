<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <title>Universal Images - Solicitar album</title>
  
    <link rel="stylesheet" type="text/css" href="css/index.css" title="Versión normal">
    <link rel="alternate stylesheet" type="text/css" href="css/acc.css" title="Estilo accesible">
    <link rel="alternate stylesheet" type="text/css" href="css/imprimir.css" media="screen" title="Estilo de impresión"/>

</head>

<body>
	<?php
		include("header2.php");
	?>
    <main>
    <p >En esta página puedes solicitar un álbum para que te lo envíen a tu dirección. Solo has de rellenar este formulario</p>
    <form action="confirmar.php" method="POST" oninput="range_control_value.value = range_control.valueAsNumber" class="album-form">
        
        <fieldset>
        <legend>Formulario de solicitud</legend>
        <label class="labelForm" for="nameInput">Nombre:</label><input id="nameInput" class="formInput" type="text" name="name_control" autofocus required />
        <br>
        <label class="labelForm" for="titleInput">Título de album:</label><input id="titleInput" class="formInput" type="text" name="title_control" required />
        <br>
        <label class="labelForm" for="textInput">Texto adicional:</label><input id="textInput" class="formInput" type="text" name="text_control"/>
        <br>
        <label class="labelForm" for="emailInput"> E-mail:</label><input id="emailInput" class="formInput" type="text" name="email_control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required />
        <br>
        <label class="labelForm" for="directionInput">Dirección:</label><input id="directionInput" class="formInput" type="text" name="direction_control"/>
        <br>
        <label class="labelForm" for="telInput">Teléfono:</label><input id="telInput" class="formInput" type="tel" name="tel_control"/>
        <br>
        <label class="labelForm" for="colorInput">Color de portada:</label><input id="colorInput" class="formInputColor" type="color" name="color_control"/>
        <br>
        <label class="labelForm" for="numberInput">Nº de copias:</label><input id="numberInput" class="formInput" type="number" name="number_control" min="1" max="100000" value="1" required/>
        <br>
        <label class="labelForm" for="resInput">Resolución:</label><input id="resInput" class="formInput" type="number" name="resolution_control" min="150" max="900" step="150" value="150" required/>
        <br>
        <label class="labelForm" for="albumInput">Album:</label>
        <select id="albumInput" class="formInput" name="album_control">
            <option label="opt" value="blank"></option>
            <option label="opt" value="album1">album 1</option>
            <option label="opt" value="album2">album 2</option>
            <option label="opt" value="album3">album 3</option>
        </select>
        <br>
        <label class="labelForm" for="colorInput2">A color:</label>
            <input id="colorInput2" class="labelFormRadio" type="radio" name="color_control1" value="blanco y negro" checked/>
			<label class="radioLabel" id="modoLabel1" for="colorInput2">blanco y negro</label>
            <br>
            <input class="labelFormRadio" id="modoLabel2" type="radio" name="color_control2" value="A color"/>
			<label class="radioLabel"  for="modoLabel2">con color</label>
            <br>
        <br>
        </fieldset>
        <label for="subInput"></label><input id="subInput" class="formSubmit" type="submit" name="submit_control" value="Confirmar"/>
        
    </form>
	</main>
	<?php include("footer.html");?>
</body>
</html>