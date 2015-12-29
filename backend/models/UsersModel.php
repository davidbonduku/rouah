<?php

class UsersModel extends CoreModel
{
    protected $_table = "user";
    protected $_id = 'idUser';

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->_getAll();
    }
    /**
     * @param $cond array
     * @return mixed
     */
    public function get($cond = array())
    {
        return $this->_get($cond);
    }

    /**
     * @param array $data
     */
    public function add(array $data)
    {
        if(sizeof($data) > 0)
        {
             $this->_add($data);
        }else{
            AppException::show(array(
                'message'=>'Impossible d\'ajouter les données, aucune donnée réçu, merci de réessayer!',
                'code' => 150,
                'type' => 'DataModelException'
            ));
        }
    }
    /**
     * @param array $data
     */
    public function update(array $data)
    {
        if(sizeof($data) > 0)
        {
            $this->_update($data);

        }else{
            AppException::show(array(
                'message'=>'Impossible de mettre à jour, merci de réessayer!',
                'code' => 150,
                'type' => 'DataModelException'
            ));
        }
    }
    /**
     * @param $id
     */
    public function remove($id)
    {
        if(!is_null($id))
        {
            $this->_delete($id);
        }
    }

    /**
     * @param $cond
     * @return bool
     */
    public function isExist($cond)
    {
       return $this->_isExist($cond);
    }

}