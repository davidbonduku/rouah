<?php

class CoreModel
{
    private $_db;
    protected $_table;
    protected $_id;

    public function __construct()
    {
        $this->_db = BDDConnexion::getInstance()->getDbh();
    }

    /**
     * Permet de r�cup�rer un enregistrement par son identifiant ID dans la base de donn�es
     * @param  int $id
     * @return mixed
     */
    protected function _getId($id)
    {
        $sql = "SELECT * FROM $this->_table WHERE $this->_id = '$id'";
        $res = $this->_db->query($sql);

        return $res->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Permet de r�cup�rer les utilisateurs
     * @return mixed
     */
    protected function _getAll()
    {
        $sql = "SELECT * FROM $this->_table";
        $res = $this->_db->query($sql);

        return $res->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Permet d'ajouter les données
     * @param array $data
     */
    protected function _add(array $data)
    {
       $sql = "INSERT INTO $this->_table  (";

        $sqlSuite= " VALUES (";

        foreach( $data as $key => $value )
        {
             $sql .= $key.',';
            $sqlSuite.= ':'.$key.',';
        }
        $partOneSql = substr($sql,0,-1).')';
        $partTwoSql = substr($sqlSuite,0,-1).')';

        echo $partOneSql.$partTwoSql;

    }

}
