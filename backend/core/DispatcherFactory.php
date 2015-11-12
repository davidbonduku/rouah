<?php

/**
 * Class DispatcherFactory
 */
class DispatcherFactory
{
    public static function dispach(Router $router)
    {
        new Dispatcher( $router );
    }

}