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
            'content' => $this->_convertToJson(self::$_currentModel->get(array('idUser'=>intval($id))))
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
        $input = file_get_contents('php://input');
        parse_str($input, $params);
        print_r($input);
        echo "je suis dans put";
    }
    public function delete($id)
    {
        echo "je suis ici";
    }
}