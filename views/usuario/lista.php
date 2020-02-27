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
	
		<h2>Lista de usuarios</h2>		
		<table border="1">
			<tr>
				<th>Usuario</th>
				<th>Admin</th>
				<th>Email</th>
				<th>Operaciones</th>
			</tr>
			<?php 
			foreach($usuarios as $u){
			echo "<tr>";
			echo "<td>$u->user</td>";
            echo "<td>".($u->admin?'SI':'NO')."</td>";
            echo "<td>$u->email</td>";
            echo "<td>";
            echo "<a href='/user/show/$u->id'>Ver</a>";
            echo "- <a href='/user/edit/$u->id'>Actualizar</a>";
            echo "- <a href='/user/delete/$u->id'>Borrar</a>";
            echo "</td>";
            echo "</tr>";
			}?>	
			</table>
		
		<?php Template::footer();?>
		
	</body>
</html>