<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Detalles de los anuncios</title>
	</head>
	<body>
		<?php 
    	   Template::header(); // pone el header
    	   Template::login($usuario); // pone el formulario de login/logout
    	   Template::menu(); // pone el menú
		?>
		
		<h2>Detalles de los anuncios</h2>
		<h3><?=$anuncio->titulo?></h3>

		<p><b>Título:</b> <?=$anuncio->titulo?></p>
		<p><b>Descripción:</b> <?=$anuncio->descripcion?></p>
		<p><b>Precio:</b> <?=$anuncio->precio?></p>
		<p><b>Fecha:</b> <?=$anuncio->created_at?></p>
		
		<?php if(Login::isAdmin(1)){?>
		<a href="/ad/edit/<?=$anuncio->id?>">Editar libro</a>
		<a href="/ad/delete/<?=$anuncio->id?>">Borrar libro</a>
		<?php }?>
		<a href="/ad">Volver a la lista</a>
		
		<?php Template::footer();?>	
		
	</body>
</html>