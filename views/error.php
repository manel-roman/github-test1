<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Error</title>
	</head>
	<body>
		<?php 
    	   Template::header(); // pone el header
    	   Template::login($usuario); // pone el formulario de login/logout
    	   Template::menu(); // pone el menú
		?>
		
		<h2>Error en la operación solicitada</h2>
		<p class="error"><?=$mensaje?></p>
		
		<?php Template::footer();?>
		
	</body>
</html>