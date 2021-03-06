<?php

/**
 * Class Application
 */
class Application
{
    private static $_config = array(
        'mode' => 'development',
        'debug' => true
    );
    /**
     * Permet d'executer l'application
     */
    public static function run()
    {
        \Slim\Slim::registerAutoloader();

        $slim = new \Slim\Slim(
            self::$_config
        );
        DispatcherFactory::dispach(new Router($slim));
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
