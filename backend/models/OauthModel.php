<?php
/**
 * Created by PhpStorm.
 * User: ozo
 * Date: 20/11/2015
 * Time: 17:42
 */

class OauthModel extends CoreModel
{
    protected $_table = 'admin';
    protected $_id = 'idAdmin';


    public function add( array $data)
    {
        return $this->_checking($data);

    }

    public function getAll()
    {
        return $this->_getAll();

    }

    private function _checking(array $account)
    {

        if($account["emailUser"]=="david@yahoo.fr" && $account ["passwordUser"]=="0000")
        {
            return true;
        } else
        {
            return false;
        }
    }

}


