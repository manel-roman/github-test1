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
		
		<form method="post" action="/anuncio/destroy">
			
			<p>Confirmar el borrado del anuncio <?=$anuncio->titulo?>.</p>
			
			<input type="hidden" name="id" value="<?=$id?>">
		
			<input type="submit" name="actualizar" value="Borrar">
		</form>
		
		
		
		<a href="/ad">Volver a la lista</a>
		
		<?php Template::footer();?>

	</body>
</html>