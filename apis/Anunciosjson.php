<?php
class Anunciosjson extends Anuncios{
    public function __construct($id=0){
        parent::__construct($id);
        header('Content-type:application/json; charset=utf-8');
    }
    
    // recuperar Anuncios
    protected function recuperar(){
        if(empty($this->id)){ // si no se indica la id...
            // comprueba si se solicita algun filtro
            $c=empty($_GET['campo'])? 'titulo' : DB::escape($_GET['campo']);
            $v=empty($_GET['valor'])? '%' : DB::escape($_GET['valor']);
            
            $anuncios = Anuncio::getFiltered($c, $v); // recupera los Anuncios con filtro
            
        }else{ // si se indica la id...
            $anuncios = [Anuncio::getAnuncio($this->id)]; // recupera ese Anuncio
        }
        // retorna el resultado pasado a JSON
        echo json_encode($anuncios);
    }
    
    // borrar un Anuncio
    protected function borrar(){
        if(empty($this->id)) // si no tenemos el ID
            throw new Exception('No se indicó el Anuncio a borrar');
        
        if(!Anuncio::borrar($this->id)) // intenta borrar el Anuncio
            throw new Exception("No se pudo borrar el Anuncio $this->id");
        
        $respuesta = new stdClass();
        $respuesta->status="OK";
        $respuesta->mensaje="Borrado del Anuncio $this->id OK";
        echo json_encode($respuesta);
    }
    
    // insertar un Anuncio
    protected function insertar(){
        if(empty($_POST['json']))
            throw new Exception('No se indicaron Anuncios a insertar');
        
        $anuncios=json_decode($_POST['json']);
        
        $r=new stdClass(); // respuesta
        $r->status="OK";
        $r->mensajes=[];
        
        foreach($anuncios as $a){ // para cada Anuncio recuperado...
            $anuncio=new Anuncio(); // mapear del objeto recuperado un Anuncio
            foreach($a as $campo=>$valor)
                $anuncio->$campo=$valor;
            
            // comprobar que el Anuncio es válido y se puede guardar
            if($anuncio->validar() && $anuncio->guardar())
                $r->mensajes[]="$anuncio->titulo OK";
            else
                $r->mensajes[]="$anuncio->titulo NO";
        }
        echo json_encode($r); // retorna la respuesta
    }
    // actualizar un Anuncio
    protected function actualizar(){
        // PHP no tiene una variable $_PUT, pero se puede solventar así
        parse_str(file_get_contents("php://input"), $_PUT);
            
        if(empty($_PUT['json'])) throw new Exception('No se indicaron Anuncios a actualizar');
            
        $anuncios=json_decode($_PUT['json']);
            
        $r=new stdClass(); // respuesta
        $r->status="OK";
        $r->mensajes=[];
            
        foreach($Anuncios as $a){ // para cada Anuncio recuperado...
            $anuncio=new Anuncio(); // mapear del objeto recuperado a un Anuncio
            foreach($a as $campo=>$valor)
                $anuncio->$campo=$valor;
                
            // comprobar que el Anuncio es válido y se puede actualizar
            if($anuncio->validar() && $anuncio->actualizar()) $r->mensajes[]="$anuncio->titulo OK";
            else $r->mensajes[]="$anuncio->titulo NO";
        }
        echo json_encode($r); // retorna la respuesta
    }
}  