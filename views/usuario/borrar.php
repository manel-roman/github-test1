<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Borrar usuario</title>
	</head>
	<body>
		<?php 
    	   Template::header(); // pone el header
    	   Template::login($usuario); // pone el formulario de login/logout
    	   Template::menu(); // pone el menú
		?>
		
		<h2>Confirmar borrado de usuario</h2>
		<form method="post" action="/user/destroy">
			<p>Confirmar el borrado del usuario <?="$u->user ($u->email)"?>.</p>
			
			<input type="hidden" name="id" value="<?=$u->id?>">
			<input type="submit" name="confirmarborrado" value="Borrar">
		</form>			

		<a href="/user">Volver a la lista</a>
		
		<?php Template::footer();?>

	</body>
</html>
