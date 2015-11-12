<?php

class CoreModel
{
    private $_db;
    protected $_table;

    public function __construct()
    {
        $this->_db = BDDConnexion::getDbh();
    }

    /**
     * Permet de récupérer un enregistrement par son identifiant ID dans la base de données
     * @param  int $id
     * @return mixed
     */
    protected function _getId($id)
    {
        $sql = "SELECT * FROM $this->_table WHERE id = '$id'";
        $res = $this->_db->query($sql);

        return $res->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Permet de récupérer les utilisateurs
     * @return mixed
     */
    protected function _getAll()
    {
        $sql = "SELECT * FROM $this->_table";
        $res = $this->_db->query($sql);

        return $res->fetchAll(PDO::FETCH_OBJ);
    }

}