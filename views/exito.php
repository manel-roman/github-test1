<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Éxito</title>
	</head>
	<body>
		<?php 
    	   Template::header(); // pone el header
    	   Template::login($usuario); // pone el formulario de login/logout
    	   Template::menu(); // pone el menÃº
		?>
		
		<h2>Éxito en la operación solicitada</h2>
		<p class="exito"><?=$mensaje?></p>
		
		<?php Template::footer();?>
		
	</body>
</html>