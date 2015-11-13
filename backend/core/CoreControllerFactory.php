<?php

/**
 * Class CoreControllerFactory
 */
class CoreControllerFactory
{
    /**
     * @return CoreController
     */
    public static function create()
    {
        return new CoreController();
    }

}