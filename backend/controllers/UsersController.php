<?php

class UsersController extends CoreController
{

    public function get($id)
    {
        echo "je recupére l'information à partir de l'ID ".$id;
    }

    public function getAll()
    {
        echo "je suis sur cette zone,je recupére toutes les informations";
    }

    public function add()
    {

    }

    public function update($id)
    {

    }
    public function remove($id)
    {

    }
}