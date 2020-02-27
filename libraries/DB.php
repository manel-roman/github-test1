<?php
class DB{
    // PROPIEDADES
    private static $conexion=null; // contendrá la conexión con BDD
    
    //METODOS
    //Método qye conecta/recupera la conexión con la BDD
    public static function get():mysqli{
        if(!self::$conexion){ // si no estábamos conectados...
            //conecta a la BDD
            self::$conexion=@new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            
            if(self::$conexion->connect_errno) // si se produce un error...
                throw new Exception('Error al conectar con la BDD');
            
            self::$conexion->set_charset(DB_CHARSET); // charset
        }
        return self::$conexion; // retorna la conexión
    }
    
    //Método para realizar consultas SELECT de una fila
    public static function select(string $consulta, string $class='stdClass'){
        $resultado = self::get()->query($consulta);
        $objeto = $resultado->fetch_object($class);
        
        $resultado->free();
        return $objeto;
    }
    
    //Método para realizar consultas SELECT de múltiples filas
    public static function selectAll(string $consulta, string $class='stdClass'):array{
        $resultados = self::get()->query($consulta);
        $objetos = [];
        
        while($r=$resultados->fetch_object($class))
            $objetos[]=$r;
        
        $resultados->free();
        return $objetos;
    }
    
    //Método para realizar consultas INSERT
    //retorna el valor del ID autonumérico o false en case de error
    public static function insert($consulta){
        return self::get()->query($consulta)? self::get()->insert_id : false;
    }
    
    //Método para realizar consultas UPDATE
    //retorna el número de filas afectadas o false en caso de error
    public static function update($consulta){
        return self::get()->query($consulta)? self::get()->affected_rows : false;
    }
    
    //Método para realizar consultas DELETE
    //retorna el nÃºmero de filas afectadas o false en caso de error
    public static function delete($consulta){
        return self::get()->query($consulta)? self::get()->affected_rows : false;
    }
    
    // Método para escapar caracteres especiales
    // evitará ataques mediante SQLInjections e inyección de scripts
    // si entities es true, se convertirán los caracteres especiales a entidades
    public static function escape(string $texto, bool $entities=true){
        $text=self::get()->real_escape_string($texto);
        return $entities? htmlspecialchars($texto):$texto;
    }
    
}

