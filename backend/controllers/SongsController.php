<?php

/**
 * Class SongsController
 *
 */

class SongsController extends CoreController
{
    public function get($id)
    {
        /*$this->_setView(array(
            'view' => 'index',
            'content' => 'Récupére la chanson dont le ID est '.$id
        ));*/
        print_r(self::$_currentModel->get($id));
    }

    public function getAll()
    {
        $this->_setView(array(
            'view' => 'index',
            'content' => 'Récupérons toutes les chansons'
        ));
        print_r(self::$_currentModel->getAll());

    }

    public function add()
    {
        $this->_setView(array(
            'view' => 'index',
            'content' => 'Ajoutons une chanson'
        ));

    }

    public function update($id)
    {

        $this->_setView(array(
            'view' => 'index',
            'content' => 'Mettons à jour la chanson dont le ID est '.$id
        ));


    }

    public function remove($id)
    {
        $this->_setView(array(
            'view' => 'index',
            'content' => 'Supprimons la chanson dont le ID est '.$id
        ));
    }

}