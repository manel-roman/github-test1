<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Formulario Nuevo anuncio</title>
	</head>
	<body>
		<?php 
    	   Template::header(); // pone el header
    	   Template::login($usuario); // pone el formulario de login/logout
    	   Template::menu(); // pone el menú
		?>
		
		<h2>Formulario Nuevo anuncio</h2>
		<form method="post" action="/ad/store">
    		
    		<label>Título</label>
    		<input type="text" name="titulo" required="required"><br>
    		<label>Descripción</label>
    		<input type="text" name="descripcion"><br>
    		<label>Precio</label>
    		<input type="text" name="precio"><br>
    		<label>Imagen</label>
    		<input type="file" accept="image/*" name="imagen"><br>
    		
    		<input type="submit" name="guardar" value="Guardar"><br>
		
		</form>
		
		<a href="/ad">Volver al listado</a>
		
		<?php Template::footer();?>

	</body>
</html>