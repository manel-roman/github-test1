<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>�xito</title>
	</head>
	<body>
		<?php 
    	   Template::header(); // pone el header
    	   Template::login($usuario); // pone el formulario de login/logout
    	   Template::menu(); // pone el menú
		?>
		
		<h2>�xito en la operaci�n solicitada</h2>
		<p class="exito"><?=$mensaje?></p>
		
		<?php Template::footer();?>
		
	</body>
</html>