<?php

class UsersController extends CoreController
{
    /**
     * @param $id
     */
    public function get($id)
    {
        $this->_setView(array(
            'view' => 'index',
            'content' => $this->_convertToJson(self::$_currentModel->get(intval($id)))
        ));
    }

    /**
     *
     */
    public function getAll()
    {
        $this->_setView(array(
            'view' => 'index',
            'content' => $this->_convertToJson(self::$_currentModel->getAll())
        ));
    }
    /**
     *
     */
    public function add()
    {
        self::$_currentModel->add($this->_getHttpData());
    }

    /**
     * @param $id
     */
    public function update($id)
    {

    }
    public function remove($id)
    {

    }
}