<?php

/**
 * Class OauthModel
 */

class OauthModel extends CoreModel
{
    protected $_table = 'session';
    protected $_id = 'id';

    /*
     * ajout des données dans la table Session
     * */

    public function add( array $data)
    {
         if(sizeof($data) > 0)
         {
             $this->_add($data);
         }
    }

    /*
     * Récupération du token
     * */

    public function getToken($token)
    {
        return $this->_get(array('token' => $token));
    }

    /*
     * Suppression d'un token
     * */

    public function delete($token)
    {
        if(!is_null($token))
        {
            $this->_delete(array('token'=>$token));
        }
    }


    /*
     * Mise à jour des données  dans la table user
     * */

    public function update(array $data)
    {
      if(sizeof($data)>0)
      {
          $this->_update($data);
      }
    }
}


