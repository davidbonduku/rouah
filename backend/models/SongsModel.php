<?php

class SongsModel extends CoreModel
{
    private $_data = array('Jean','Mark','Matthieu','TOTO','RENNES1','BI');

    public function getAll()
    {
        return $this->_data;
    }
    public function get($id)
    {
        return $this->_data[intval($id)];
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