<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

//Se definen las variables globales de php
error_reporting(E_ALL);//Se reporta a un log todo error que suceda JR
ini_set('display_errors', 1);
define('DS', DIRECTORY_SEPARATOR);//se define los separadores de directorios, estos variasn entre win y linux
define('ROOT', realpath(dirname(__FILE__)) . DS);// se indica el directorio real independientemente si viene de linux o win
define('APP_PATH', ROOT . 'application' . DS);// aca la constante sería app_path que se compone de ROOT(la ruta completa hasta la carpeta application)
define('CHARSET', 'ISO-8859-1'); //ISO-8859-1  //se define como es van a mostrar los String
session_name('0ri5tR4v3l');//
session_cache_limiter('nocache');
date_default_timezone_set('America/Santiago');// se define la zona horaria.
header('Content-Type: text/html; charset=' . CHARSET);// se aplica a todos las paginas como se van a mostrar los String

//ahora en la pagina index.php se traeran todos los componentes de la aplicacion
try
{
    require_once APP_PATH . 'Config.php';// se guardan todas las variables globales de la aplicacion.
    require_once APP_PATH . 'Request.php';// Obtiene, segun el formato de demostracion de la pagina: sistema/controlador/argumento1.... argumentoN
    require_once APP_PATH . 'Bootstrap.php';
    require_once APP_PATH . 'Controller.php';// controla todos los paramentros, además carga los modelos dto dao
    require_once APP_PATH . 'Model.php';
    require_once APP_PATH . 'View.php';// Distribuye todas las paginas con sus respectivos js, css, etc
    require_once APP_PATH . 'Registro.php'; //Trabajar con patron Singleton
    require_once APP_PATH . 'Database.php';//Conecta, consulta, trae y cierra la ddbb
    require_once APP_PATH . 'Session.php';// maneja sesiones
    require_once APP_PATH . 'Funciones.php';// cambia variables y obtiene los exploradores web que se ocupan.

    Session::init();

    Bootstrap::run(new Request);
}
catch (Exception $e)
{
    echo $e->getMessage();
}
?>