<?php
//CONTROLADOR FRONTAL
class FrontController{
    
    // método principal del controlador frontal
    public static function main(){
        try{
            // control de login-logout
            Login::comprobar();
            
            // GESTIÓN DE PETICIONES (dispatcher)
            
            // recuperar el controlador de la petición
            $c = empty($_GET['c'])? DEFAULT_CONTROLLER: ucfirst($_GET['c']);
            
            // recuperar el método de la petición
            $m = empty($_GET['m'])? DEFAULT_METHOD: $_GET['m'];
            
            // recuperar el parámetro de la petición
            $p = empty($_GET['p'])? '': $_GET['p'];
            
            // cargar el controlador correspondiente
            $controlador = new $c();
            
            // comprobar si existe el método
            if(!is_callable([$controlador, $m]))
                throw new Exception("No existe la operación $m");
            
            // llama al método del controlador, pasando el parámetro
            $controlador->$m($p);
            
        // si se produce algún error...
        }catch(Throwable $e){
            $mensaje=$e->getMessage(); // recupera el mensaje del error
            $usuario = Login::getUsuario();
            include 'views/error.php'; //carga la vista de error
        }
    }
}