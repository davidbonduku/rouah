<?php

class UsersController extends CoreController
{

    public function get($id)
    {
        echo "je recup�re l'information � partir de l'ID ".$id;
    }

    public function getAll()
    {
        echo "je suis sur cette zone,je recup�re toutes les informations";
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