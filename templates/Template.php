<?php
class Template{
    
    public static function header(){?>
    	<header>
    		<hgroup>
    			<h1>La Botiga</h1>
    			<h2>Activitat</h2>
    		</hgroup>
    	</header>
    <?php }
    
    public static function footer(){?>
    	<footer>
    		<p>Aplicación Botiga, por 
    			<a href="https://google.com">Manel Roman</a>.</p>
    			<p>Ejemplo de clase para CIFO Vallès</p>
    	</footer>
   	<?php }
   	
   	// a este método, podemos pasarle el usuario o hacer Login::getUsuario()
   	public static function login($usuario=NULL){
   	    if(!$usuario){?>

  				<form method="post">
        			<label>user</label>
        			<input type="text" name="user">
        			<label>password</label>
        			<input type="password" name="password">
        			<input type="submit" name="login" value="Login">
        		</form>
        		<?php }else{?>
        		<form method="post">
        			<label>Bienvenido <?=$usuario->user?></label>
        			<input type="submit" name="logout" value="Logout">
        		</form>

		<?php }
   	}
   	
   	public static function menu(){?>
   		<ul>
			<li><a href="/">Inicio</a></li>
			<li><a href="/ad">Lista de Anuncios</a></li>
			<?php if(Login::isAdmin(1)){?>
			<li><a href="/ad/create">Nuevo anuncio</a></li>
			<?php }?>
		</ul>
		<?php if(Login::isAdmin(1)){?>
		<ul>
			<li><a href="/user">Lista de usuarios</a></li>
			<li><a href="/user/create">Nuevo usuario</a></li>
		</ul>
		<?php }
   	}
}