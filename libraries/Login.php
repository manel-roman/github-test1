<?php
class Login{
    // propiedad que contendrá el usuario identificado
    private static $usuario = NULL;
    
    // método que retorna el usuario identificado
    public static function getUsuario(){
        return self::$usuario;
    }
    
    // método que retorna si el usuario identificado es admin
    public static function isAdmin(){
        return self::$usuario && self::$usuario->admin;
    }
    
    // método que realiza la operación de login
    public static function log_in($u, $p){
        // trata de identificar el usuario
        $user=Usuario::identificar($u, $p);
        
               
        // si no se pudo recuperar el usuario a partir de los datos...
        if(!$user) throw new Exception('Error en la identificacion');
        
        // almacena el usuario identificado en la variable de sesión
        $_SESSION['user']=serialize($user);
    }
    
    // método que realiza la operación de logout
    public static function log_out(){
        session_unset(); // vacía el array de sesión
        
        header("Refresh:0; url=/");
        die('Redirigiendo a la portada...');
    }
    
    // método que gestiona las operaciones de login-logout a partir
    // de las solicitudes del usuario (envio de los formularios)
    public static function comprobar(){
        // si piden hacer login
        if(!empty($_POST['login']))
            self::log_in($_POST['user'],md5($_POST['password']));
        
        // si piden hacer logout
        if(!empty($_POST['logout']))
            self::log_out();
        
        // hagan o no hagan login, recuperamos la info de la var de sesi�n
        // para guardarla en la propiedad $usuario.
        self::$usuario = empty($_SESSION['user'])?
            NULL : unserialize($_SESSION['user']);
    }
}