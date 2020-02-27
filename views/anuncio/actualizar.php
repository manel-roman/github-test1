<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Formulario update</title>
	</head>
	<body>
		<?php 
    	   Template::header(); // pone el header
    	   Template::login($usuario); // pone el formulario de login/logout
    	   Template::menu(); // pone el menú
		?>
		
		<h2>Formulario de edición</h2>
		
		<?=empty( $GLOBALS['mensaje'])? "" : "<p>". $GLOBALS['mensaje']."</p>"?>
		
		<form method="post" action="updateanuncio.php">
			<input type="hidden" name="id" value="<?=$anuncio->id?>">
			<label>Título</label>
			<input type="text" name="titulo" value="<?=$anuncio->titulo?>"><br>
			<label>Descripción</label>
			<input type="text" name="descripcion" value="<?=$anuncio->descripcion?>"><br>
			<label>Precio</label>
			<input type="number" min="0" name="precio" value="<?=$anuncio->precio?>"><br>
			<label>Imagen</label>
			<input type="file" accept="image/*" name="imagen" value="<?=$anuncio->imagen?>"><br>
		
		
			<input type="submit" name="actualizar" value="Actualizar">
		</form>
		
		
		
		<a href="/ad">Volver a la lista</a>
		
		<?php Template::footer();?>

	</body>
</html>