<?php

/**
 * Created by PhpStorm.
 * User: davidbondukupieme
 * Date: 22/10/15
 * Time: 18:24
 */
class UsersController extends CoreController
{

    public function getAll()
    {
        $this->_setView(array(
            'view' => 'index',
            'content' => 'Tout les utilisateurs seront affichés ici'
        ));
    }
}