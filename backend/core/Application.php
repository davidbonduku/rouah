<?php

class Application
{
    private static $_config = array(
        'mode' => 'development',
        'debug' => true
    );
    /**
     * Permet d'executer l'application ---i'm here
     */
    public static function run()
    {
        \Slim\Slim::registerAutoloader();

        $slim = new \Slim\Slim(
            self::$_config
        );
        new Dispatcher(new Router($slim));
    }
    /**
     * Permet de configurer le mode de fonctionnement de l'application
     * @param array $config
     */
    public static function config(array $config)
    {
        self::$_config['mode']= $config['mode'];
        self::$_config['debug']= $config['debug'];
    }
}