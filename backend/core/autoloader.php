<?php
/**
 * CONSTANTES APPLICATIVES
 */
define('WEBROOT',str_replace('index.php','',$_SERVER['SCRIPT_NAME']));
define('ROOT',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
define ('DS', DIRECTORY_SEPARATOR);
define ('SITE_PATH',realpath(dirname(__FILE__) . DS . '..' . DS) . DS);

/**
 * Inclusions librairies
 */

spl_autoload_register(function($class){

    if(file_exists(ROOT.'core/'.$class.'.php'))
    {
        require_once ROOT.'core/'.$class.'.php';
    }else{
        require_once ROOT.'libs/Slim/Slim.php';
    }
});


