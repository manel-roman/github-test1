<?php
// Fichero index.php
// por aquí pasan todas las peticiones

// si trabajamos con sesiones...
session_start(); // usaremos sesiones

// cargar recursos
include 'config/config.php';
include 'libraries/autoload.php';

// invocar al controlador frontal
FrontController::main();