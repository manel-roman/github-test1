    <?php
class Anuncio{
    // PROPIEDADES
    public $id=0, $titulo='', $descripcion='', $precio='', $created_at='',
           $updated_at='', $idusuario=0;
    
    // MÉTODOS DEL CRUD
    // recuperar todos los anuncios
    public static function get():array{
        $consulta="SELECT * FROM anuncios"; // prerarar la consulta
        return DB::selectAll($consulta, self::class);
    }
    
    // recuperar anuncios con un filtro avanzado
    public static function getFiltered(string $campo='titulo', string $valor='', 
        string $orden='id', string $sentido='ASC'):array{
            
            $consulta="SELECT *
                      FROM anuncios
                      WHERE $campo LIKE '%$valor%'
                      ORDER BY $orden $sentido";
            
            return DB::selectAll($consulta, self::class);                
    }
    
    // recuperar un anuncio concreto por id
    public static function getAnuncio(int $id):?Anuncio{
        $consulta="SELECT * FROM anuncios WHERE id=$id"; //preparar la consulta
        return DB::select($consulta, self::class); // ejecutar y retornar el resultado
    }
    
    // insertar un nuevo anuncio
    public function guardar(){
        $consulta = "INSERT INTO anuncios(titulo, descripcion, precio)
                    VALUES('$this->titulo','$this->descripcion', '$this->precio', '$this->idusuario')";
        return DB::insert($consulta);
            
    }
    
    // borrar un anuncio por id
    public static function borrar(int $id){
        // preparar la consulta
        $consulta="DELETE FROM anuncios WHERE id=$id";
        //ejecutar consulta
        return DB::delete($consulta);
    }
    
    // actualizar un anuncio
    public function actualizar(){
        // preparar consulta
        $consulta="UPDATE anuncios SET
                    titulo='$this->titulo',
                    descripcion='$this->descripcion',
                    precio='$this->precio',
                    idusuario='$this->idusuario',
                  WHERE id=$this->id";
        return DB::update($consulta);
    }
    
    // __toString
    public function __toString():string{
        return "$this->id $this->titulo, $this->descripcion";
    }
}