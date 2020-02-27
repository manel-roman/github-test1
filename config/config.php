<?php

// PARA EL AUTOLOAD
// lista de directorios donde buscar clases
$classmap=['controllers', 'models', 'libraries', 'templates', 'apis'];

// PARAMETROS DE CONFIGURACIÓN BDD
define('DB_HOST','localhost');  // host
define('DB_USER','alumne');  // usuario
define('DB_PASS','');  // password
define('DB_NAME','botiga');  // base de datos
define('DB_CHARSET','utf8');  // codificación

// conector que debe usar PDO. Solamente si se ha visto PDO además de mysqli
define('SGDB','mysql');

// CONTROLADOR Y METODO POR DEFECTO
define('DEFAULT_CONTROLLER','Welcome');
define('DEFAULT_METHOD','index');

// OTROS PARAMETROS
define('DEBUG',0); // para depuración