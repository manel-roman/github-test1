<?php 
abstract class Anuncios{
    // PROPIEDADES
    protected $id; // id del libro a procesar
    
    // CONSTRUCTOR
    public function __construct($id){
        $this->id = $id;
    }
    
    // Métodos que deben implementar las clases hijas
    protected abstract function recuperar();
    // protected abstract function insertar();
    // protected abstract function actualizar();
    // protected abstract function borrar();
    
    // Analiza el método HTTP y llama al método adecuado
    public function dispatch(){
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET' : $this->recuperar(); break;
            // case 'POST' : $this->insertar(); break;
            // case 'PUT' : $this->actualizar(); break;
            // case 'DELETE' : $this->borrar(); break;
            default: throw new Exception('Método HTTP no válido');
        }
    }
}