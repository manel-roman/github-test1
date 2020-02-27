<?php
// CONTROLADOR User para la gestión de usuarios
class User{
    // operación por defecto
    public function index(){
        $this->list(); // lista de usuarios
    }
    
    // lista los usuarios
    public function list(){
        //solo los administradores pueden listar usuarios
        if(!Login::isAdmin())
            throw new Exception('Debes ser administrador');
        
   
        $usuarios=Usuario::get(); // recuperar la vista de usuarios
         
        // recupera el usuario para pasárselo a la vista
        $usuario=Login::getUsuario();
             
        include 'views/usuario/lista.php'; // cargar la vista del listado
    }
    
    // muestra un usuario
    public function show($id=false){
        // comprobar que me llega el código
        if(!$id) throw new Exception("No se indicó el usuario.");
        
        // recuperar el usuario con dicho código
        $u=Usuario::getUsuario($id);
        
        // comprobar que el usuario existe
        if(!$u) throw new Exception("No existe el usuario $id.");
        
        // cargar la vista de detalles
        $usuario = Login::getUsuario(); // cargar user logeado
        include 'views/usuario/detalles.php';
    }
    
    // muestra el formulario de nuevo usuario
    public function create(){
        
        // recupera el usuario para pasárselo a la vista
        $usuario=Login::getUsuario();
        
        include 'views/usuario/nuevo.php';
    }
    
    // guarda el nuevo usuario
    public function store(){
        $u = new Usuario(); // crear el nuevo usuario con datos POST
        $u->user = $_POST['user'];
        $u->password = md5($_POST['password']); // se encripta
        $u->nombre = $_POST['nombre'];
        $u->apellido1 = $_POST['apellido1'];
        $u->apellido2 = $_POST['apellido2'];
        $u->privilegio = intval($_POST['privilegio']);
        $u->admin = empty($_POST['admin'])? 0 : 1;
        $u->email = $_POST['email'];
        
        if(!$u->guardar()) // guardar en la BDD
            throw new Exception("No se pudo guardar $u->user");
        
        $mensaje="Guardado del usuario $u->user correcto.";
        
        // recupera el usuario para pasárselo a la vista
        $usuario=Login::getUsuario();
        
        include 'views/exito.php'; // mostrar éxito
    }
    
    // muestra el formulario de edición de un usuario
    public function edit($id=false){
        // comprobar que m ellega el identificador
        if(!$id) throw new Exception("No se indicó el usuario.");
        
        // recuperar el usuario
        $u=Usuario::getUsuario($id);
        
        // comprobar que el usuario existe
        if(!$u) throw new Exception("No existe el usuario $id.");
        
        // cargar la vista del formulario
        $usuario = Login::getUsuario(); // cargar user logeado
        include 'views/usuario/actualizar.php';
    }
    
    // aplica los cambios de un usuario
    public function update(){
        $id=intval($_POST['id']); // recuperar el id vía POST
        $u=Usuario::getUsuario($id); // recuperar el usuario
        
        if(!$u) throw new Exception("No existe el usuario $id.");
        
        $u->user = $_POST['user'];
        $u->nombre = $_POST['nombre'];
        $u->apellido1 = $_POST['apellido1'];
        $u->apellido2 = $_POST['apellido2'];
        $u->privilegio = intval($_POST['privilegio']);
        $u->admin = empty($_POST['admin'])? 0 : 1;
        $u->email = $_POST['email'];
        
        // el password solamente se cambia si se indica uno nuevo
        if(!empty($_POST['password'])) $u->password=md5($_POST['password']);
        
        if($u->actualizar()===false) throw new Exception("No se pudo actualizar");
        
        $this->show($u->id); // detalles del usuario editado
    }
    
    // muestra el formulario de confirmación de eliminación
    public function delete($id){
        // comprobar que me llega el identificador
        if(!$id) throw new Exception("No se indicó el usuario.");
        
        // recuperar el usuario con dicho identificador
        $u=Usuario::getUsuario($id);
        
        // comprobar que el usuario existe
        if(!$u) throw new Exception("No existe el usuario $id.");
        
        // ir al formulario de confirmación
        $usuario = Login::getUsuario(); // cargar user logeado
        include 'views/usuario/borrar.php';
    }
    
    // elimina el usuario
    public function destroy(){
        // recuperar el identificador vía POST
        $id=intval($_POST['id']);
        
        if(!Usuario::borrar($id))
            throw new Exception('No se pudo borrar');
        
        // recuperar el usuario con dicho identificador
        $u=Usuario::getUsuario($id);
        
        // mostrar la vista de éxito
        $mensaje="Borrado correcto de $u.";
        
        // recupera el usuario para pasárselo a la vista
        $usuario=Login::getUsuario();
        
        include 'views/exito.php'; // mostrar éxito
    }
    
}