<?php 
// PUNTO DE ENTRADA DE LAS APIS
// carga recursos, pone cabeceras CORS e instancia el FronApiController

// encabezados para CORS
header("Access-Control-Allow-origin: *");
header("Acces-Control-Allow-Methods: POST, GET, PUT, DELETE");

include 'config/config.php'; // cargar fichero de configuración
include 'libraries/autoload.php'; // cargar autload

// FrontApiController es una especie de FrontController para la API
$fac=new FrontApiController();
$fac->main();

