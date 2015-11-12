<?php
/**
 * ROUAH MUSIQUE APPLICATION
 */
 require_once 'core/autoloader.php';

Application::config(array(
    'mode' => 'production',
    'debug' => true
));
/**
 * Execution de l'application
 */
Application::run();
