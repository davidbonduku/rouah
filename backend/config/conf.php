<?php

class Conf
{
    private $con; //variable de connexion

    public function __construct()
    {
        $db = connexion::getInstance();
        $this->con = $db->getDbh();
    }
}
