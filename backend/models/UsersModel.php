<?php

class UsersModel extends CoreModel
{
    protected $_table = "users";

    public function getAll()
    {
        return $this->_getAll();
    }
    public function get($id)
    {
        return $this->_getId(intval($id));
    }
    public function add(array $data)
    {

    }

    public function update(array $data)
    {

    }
    public function remove($id)
    {

    }

}