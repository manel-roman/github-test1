<?php
// controlador por defecto
class Welcome{
    
    public function index(){
        // recupera el usuario para pasárselo a la vista
        $usuario=Login::getUsuario();
        
        // carga la vista de portada
        include 'views/portada.php';
    }
}