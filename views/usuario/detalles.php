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
		
		<h2>Detalles del usuario</h2>
		<h3><?="$u->user"?></h3>
		
		<p><b>ID:</b> <?=$u->id?></p>
		<p><b>User:</b> <?=$u->user?></p>
		<p><b>Password:</b>********</p>
		<p><b>Nombre:</b> <?=$u->nombre?></p>
		<p><b>Apellido1:</b> <?=$u->apellido1?></p>
		<p><b>Apellido2:</b> <?=$u->apellido2?></p>
		<p><b>Admin:</b> <?=$u->admin?'SI':'NO'?></p>
		<p><b>Email:</b> <?=$u->email?></p>
		<p><b>Creado en:</b> <?=$u->created_at?></p>
		<p><b>Modificado en:</b> <?=$u->updated_at?></p>
		
		<a href="/user/edit/<?=$u->id?>">Editar usuario</a>
		<a href="/user/delete/<?=$u->id?>">Borrar usuario</a>
		<a href="/user">Volver al listado</a>
		
		<?php Template::footer();?>		
		
	</body>
</html>