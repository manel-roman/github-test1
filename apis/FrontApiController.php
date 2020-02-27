<?php 
class FrontApiController{
    // Propiedades
    private $formato='', $entidad='', $clase='', $id=0;
    
    // METODOS
    public function main(){
        try {
            // MIRAR EL FORMATO SOLICITADO XML, JSON...)
            if(empty($_GET['tec'])) // si no se indica el formato
                throw new Exception('No se indicó el formato');
            
            $this->formato = strtolower(DB::escape($_GET['tec'])); // recupera el formato
            
            // MIRAR ENTIDAD A CONSULTAR
            if (empty($_GET['ent'])) // si no se indica la entidad
                throw new Exception('No se indicó la entidad');
            
            $this->entidad = ucfirst(DB::escape($_GET['ent'])); // recuperar entidad
                
            $this->clase = "$this->entidad$this->formato"; // nombre de la clase a cargar
            
            if (!is_readable("apis/$this->clase.php")) // comprueba si existe la clase
                throw new Exception("No existe la API para $this->formato y $this->entidad");
            
            $this->id = empty($_GET['id']) ? 0 : intval($_GET['id']); // recuperar id
            
            // CREAR LA INSTANCIA DE LA API
            // crea la instancia concreta para entidad y formato
            $api = new $this->clase($this->id);
            $api->dispatch(); // procesa la petición (GET/PUT/POST/DELETE)
            
            // si se produce algún error...
        }catch (Throwable $t){
            switch($this->formato){
                case 'xml': header('Content-type:text/xml; charset=utf-8');
                            echo "<respuesta>\n
                                        \t<status>ERROR</status>\n
                                        \t<mensaje>".$t->getMessage()."</mensaje>\n
                                 </respuesta>";
                            break;
                case 'json': header('Content-type:application/json; charset=utf-8');
                             $respuesta = new stdClass();
                             $respuesta->status="ERROR";
                             $respuesta->mensaje=$t->getMessage();
                             echo json_encode($respuesta);
                             break;
                
                default: header('Content-type:text/plain; charset=utf-8');
                         echo $t->getMessage();
            }
        }
    }
}