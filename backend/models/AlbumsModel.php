<?php

/**
 * Class AlbumsModel
 */
class AlbumsModel extends CoreModel
{
    protected $_table = 'album';
    protected $_id = 'idAlbum';
    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->_getAll();
    }
    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->_getId(intval($id));
    }

    /**
     * @param array $data
     */
    public function add(array $data)
    {
        if(sizeof($data) > 0)
        {
            $this->_add($data);
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
}