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
		
		<h2>Formulario modificar un usuario</h2>
		<form method="post" action="/user/update">
			<input type="hidden" name="id" value="<?=$u->id?>">
			<label>Usuario</label>
			<input type="text" name="user" value="<?=$u->user?>"><br>
			<label>Password</label>
			<input type="password" name="password"><br>
			<label>Nombre</label>
			<input type="text" name="nombre" value="<?=$u->nombre?>"><br>
			<label>Primer Apellido</label>
			<input type="text" name="apellido1" value="<?=$u->apellido1?>"><br>
			<label>Segundo Apellido</label>
			<input type="text" name="apellido2" value="<?=$u->apellido2?>"><br>
			<label>Admin</label>
			<input type="checkbox" name="admin" value="1"
				<?=$u->admin? 'checked':''?>><br>
			<label>Email</label>
			<input type="text" name="email" value="<?=$u->email?>"><br>
			<input type="submit" name="actualizar" value="Actualizar">
		</form>
		
		<a href="/user">Volver a la lista</a>
		
		<?php Template::footer();?>

	</body>
</html>