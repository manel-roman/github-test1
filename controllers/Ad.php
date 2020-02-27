<?php
// CONTROLADOR ANUNCIO
class Ad{
    // operación por defecto
    public function index(){
        $this->list(); // nos lleva a la lista de anuncios
    }
    
    // operación para listar todos los anuncios
    public function list(){
        // recuperar la lista de anuncios
        $anuncios=Anuncio::get();
        
        // recupera el usuario para pasárselo a la vista
        $identificado=Login::getUsuario();
        
        //if($identificado && $identificado->id==$anuncio->idusuario)
        
        // cargar la vista del listado
        include 'views/anuncio/lista.php';
    }
    
    // método para mostrar los detalles de un anuncio
    public function show(int $id=0){
        // comprobar que recibimos el id del anuncio por parámetro
        if(!$id)
            throw new Exception("No se indicó el anuncio.");
        
        // recuperar el anuncio con dicho identificador
        $anuncio=Anuncio::getAnuncio($id);
        
        // comprobar que el anuncio existe
        if(!$anuncio)
            throw new Exception("No existe el anuncio $id.");
        
        // cargar la vista de detalles
        $usuario=Login::getUsuario();
        include 'views/anuncio/detalles.php';
    }
    
    // GUARDAR SE HACE EN DOS PASOS
    // PASO 1: muestra el formulario del nuevo anuncio
    public function create(){
        
        // recupera el usuario para pasárselo a la vista
        $usuario=Login::getUsuario();
        
        include 'views/anuncio/nuevo.php';
    }
    // PASO 2: guarda el nuevo anuncio
    public function store(){
        // comprueba que llegue el formulario con los datos
        if(empty($_POST['guardar']))
            throw new Exception('No se recibieron datos');
        
        // crea un nuevo anuncio
        $anuncio = new Anuncio();
        
        // recupera los datos del formulario que llegan por POST
        $anuncio->titulo=DB::escape($_POST['titulo']);
        $anuncio->descripcion=DB::escape($_POST['descripcion']);
        $anuncio->precio=floatval($_POST['precio']);
        $anuncio->imagen=escape($_POST['imagen']);
        
        
        if(!$anuncio->validar())
            throw new Exception("Los datos no son válidos");
        
        // guarda el anuncio en la BDD
        if(!$anuncio->guardar()) 
            throw new Exception("No se pudo guardar $anuncio->titulo");
        
        // muestra la vista de éxito
        $mensaje="Guardado del anuncio $anuncio->titulo correcto.";
        include 'views/exito.php'; // mostrar éxito     
        
        // recupera el usuario para pasárselo a la vista
        $usuario=Login::getUsuario();
    }
    
    // ACTUALIZAR SE HACE EN DOS PASOS
    
    // PASO 1: muestra el formulario de edición de un anuncio
    public function edit(int $id=0){
        // comprueba que llega el id del anuncio a editar
        if(!$id)
            throw new Exception("No se indicó el anuncio.");
        
        // recuperar el anuncio con dicho identificador
        $anuncio=Anuncio::getAnuncio($id);
        
        // comprueba que el anuncio se pudo recuperar de la BDD
        if(!$anuncio)
            throw new Exception("No existe el anuncio $id.");
        
        // recupera el usuario para pasárselo a la vista
        $usuario=Login::getUsuario();
            
        // cargar la vista del formulario
        include 'views/anuncio/actualizar.php';
    }
    
    // PASO 2: aplica los cambios de un anuncio
    public function update(){
        
        // comprueba que llegue el formulario con los datos
        if(empty($_POST['actualizar']))
            throw new Exception('No se recibieron datos');
        
        // Creamos un nuevo anuncio y nos ahorramos la consulta a la BDD
        $anuncio = new Anuncio();
        
        // Recuperar el id vía POST
        $anuncio->id=intval($_POST['id']);
        
        // Recuperar el resto de campos
        $anuncio->titulo = $_POST['titulo'];
        $anuncio->descripcion = $_POST['descripcion'];
        $anuncio->precio = $_POST['precio'];
        $anuncio->imagen = $_POST['imagen'];
        
        if(!$anuncio->validar())
            throw new Exception("Los datos no son válidos");
        
        // intenta realizar la actualización de datos
        if($anuncio->actualizar()===false) 
            throw new Exception("No se pudo actualizar");
        
        // prepara un mensaje
        $GLOBALS['mensaje'] = "Actualización del anuncio $anuncio->anuncio correcto.";
        
        // repite la operación edit, así mantendrá al usuario en la vista de edición
        $this->edit($libro->id);
        
        // NOTA 1: pongo $mensaje global para no tener que pasarla al método edit
        // NOTA 2: debemos retocar la vista con el formulario para que se muestre el mensaje
        // NOTA 3: cuanda haga pruebas, prueba a cambiar el edit por el "show" o "list"...
        // Tras guardar el libro, podríamos optar por diversas opciones:
    }
    
    // ELIMINAR SE HACE EN DOS PASOS
    // (si queremos hacerlo con el formulario de confirmaci�n)
    
    // PASO 1: muestra el formulario de confirmaci�n de eliminaci�n
    public function delete(int $id=0){
        // comprobar que me llega el identificador
        if(!$id)
            throw new Exception("No se indicó el anuncio a borrar.");
            
            // recuperar el anuncio con dicho identificador
            $anuncio=Anuncio::getAnuncio($id);
        
            // comprueba que el anuncio existe
            if(!$anuncio)
                throw new Exception("No existe el anuncio $id.");
            
            // recupera el usuario para pasárselo a la vista
            $usuario=Login::getUsuario();
            
            // ir al formulario de confirmación
            include 'views/anuncio/borrar.php';
    }
    
    // PASO 2: elimina el anuncio
    public function destroy(){
        
        // comprueba que llegue el formulario de confirmación
        if(empty($_POST['borrar']))
            throw new Exception('No se recibió confirmación');
        
        // recuperar el identificador vía POST
        $id=intval($_POST['id']);
        
        // intenta borrar el anuncio de la BDD
        if(!Anuncio::borrar($id))
            throw new Exception('No se pudo borrar');
        
        // mostrar la vista éxito
        $mensaje="Borrado correcto.";
        include 'views/exito.php';   // mostrar éxito
        
        // recupera el usuario para pasárselo a la vista
        $usuario=Login::getUsuario();
    }
    
    // FILTRO
    // tomar los valores para el filtro
    public function filtered(){
        $campo=empty($_POST['campo'])? 'titulo' : DB::escape($_POST['campo']);
        $valor=empty($_POST['valor'])? '' : DB::escape($_POST['valor']);
        $orden=empty($_POST['orden'])? 'id' : DB::escape($_POST['orden']);
        $sentido=empty($_POST['sentido'])? 'ASC' : DB::escape($_POST['sentido']);
        
        // recuperar la lista de libros
        $libros=Libro::getFiltered($campo, $valor, $orden, $sentido);
        
        // recupera el usuario para pasárselo a la vista
        $usuario=Login::getUsuario();
        
        // carga la vista para mostrar la lista
        include 'views/anuncio/list.php';
    }
    
    // JSON
    // exporta todos los libros a JSON
    public function exportjson(){
        // comprobamos si nos piden descargar o no
        $descargar=!empty($_POST['descargar']);
        
        // pone las cabeceras
        header('Content-type:application/json; charset=utf-8');
        
        if($descargar)
            header('Content-Disposition:attachment; filename=anuncios.json');
        
        // imprimir el resultado
        echo json_encode(Anuncio::get());
    }
}