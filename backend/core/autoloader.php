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

require_once ROOT.'libs/Slim/Slim.php';
require_once ROOT.'core/CoreController.php';
require_once ROOT.'core/CoreModel.php';
require_once ROOT.'core/Router.php';
require_once ROOT.'core/Dispatcher.php';
require_once ROOT.'core/Application.php';




