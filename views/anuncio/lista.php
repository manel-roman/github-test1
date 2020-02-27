<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Lista de anuncios</title>
	</head>
	<body>
		<?php 
    	   Template::header(); // pone el header
    	   Template::login($usuario); // pone el formulario de login/logout
    	   Template::menu(); // pone el menú
		?>
	
		<h2>Lista de Anuncios</h2>
		
		<table border="1">
			<tr>
				<th>Título</th>
				<th>Descripción</th>
				<th>Precio</th>
				<th>Operaciones</th>
			</tr>
			<?php 
			foreach($anuncios as $anuncio){
			echo "<tr>";
			echo "<td>$anuncio->titulo</td>";
            echo "<td>$anuncio->descripcion</td>";
            echo "<td>$anuncio->precio&euro;</td>";
            echo "<td>";
            echo "<a href='/ad/show/$anuncio->id'>Ver</a>";
            if(Login::isAdmin()){
            echo "- <a href='/ad/edit/$anuncio->id'>Actualizar</a>";
            echo "- <a href='/ad/delete/$anuncio->id'>Borrar</a>";
            }
            echo "</td>";
            echo "</tr>";
			}?>	
			</table>
		
		<form method="post" action="/ad/exportjson">
			<input type="submit" name="export" value="JSON">
			<input type="checkbox" name="descargar" value="1">
			<label>Descargar</label>
		</form>
		
		<?php if(Login::isAdmin()){ ?>
		<form method="post" enctype="multipart/form-data"
			action="/ad/importjson">
		<label>Fichero</label>
		<input type="file" name="json" accept="text/json">
		<input type="submit" name="import" value="Importar">	
		</form>
		<?php }?>
			
		<?php Template::footer();?>
		
	</body>
</html>