<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Lista de usuarios</title>
	</head>
	<body>
		<?php 
    	   Template::header(); // pone el header
    	   Template::login($usuario); // pone el formulario de login/logout
    	   Template::menu(); // pone el menú
		?>
		
		<h2>Formulario para registrar un usuario</h2>		
		<form method="post" action="/user/store">
			<label>Usuario</label>
			<input type="text" name="user"><br>
			<label>Password</label>
			<input type="password" name="password"><br>
			<label>Nombre</label>
			<input type="text" name="nombre"><br>
			<label>Primer apellido</label>
			<input type="text" name="apellido1"><br>
			<label>Segundo apellido</label>
			<input type="text" name="apellido2"><br>
			<label>Admin</label>
			<input type="checkbox" name="admin" value="1"><br>
			<label>Email</label>
			<input type="text" name="email"><br>
			
			<input type="submit" name="guardar" value="guardar"><br>
			
		</form>	
		
		<?php Template::footer();?>
		
	</body>
</html>