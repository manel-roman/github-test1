<?php
class DB{
    // PROPIEDADES
    private static $conexion=null; // contendr� la conexi�n con BDD
    
    //METODOS
    //M�todo qye conecta/recupera la conexi�n con la BDD
    public static function get():mysqli{
        if(!self::$conexion){ // si no est�bamos conectados...
            //conecta a la BDD
            self::$conexion=@new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            
            if(self::$conexion->connect_errno) // si se produce un error...
                throw new Exception('Error al conectar con la BDD');
            
            self::$conexion->set_charset(DB_CHARSET); // charset
        }
        return self::$conexion; // retorna la conexi�n
    }
    
    //M�todo para realizar consultas SELECT de una fila
    public static function select(string $consulta, string $class='stdClass'){
        $resultado = self::get()->query($consulta);
        $objeto = $resultado->fetch_object($class);
        
        $resultado->free();
        return $objeto;
    }
    
    //M�todo para realizar consultas SELECT de m�ltiples filas
    public static function selectAll(string $consulta, string $class='stdClass'):array{
        $resultados = self::get()->query($consulta);
        $objetos = [];
        
        while($r=$resultados->fetch_object($class))
            $objetos[]=$r;
        
        $resultados->free();
        return $objetos;
    }
    
    //M�todo para realizar consultas INSERT
    //retorna el valor del ID autonum�rico o false en case de error
    public static function insert($consulta){
        return self::get()->query($consulta)? self::get()->insert_id : false;
    }
    
    //M�todo para realizar consultas UPDATE
    //retorna el n�mero de filas afectadas o false en caso de error
    public static function update($consulta){
        return self::get()->query($consulta)? self::get()->affected_rows : false;
    }
    
    //M�todo para realizar consultas DELETE
    //retorna el número de filas afectadas o false en caso de error
    public static function delete($consulta){
        return self::get()->query($consulta)? self::get()->affected_rows : false;
    }
    
    // M�todo para escapar caracteres especiales
    // evitar� ataques mediante SQLInjections e inyecci�n de scripts
    // si entities es true, se convertir�n los caracteres especiales a entidades
    public static function escape(string $texto, bool $entities=true){
        $text=self::get()->real_escape_string($texto);
        return $entities? htmlspecialchars($texto):$texto;
    }
    
}

