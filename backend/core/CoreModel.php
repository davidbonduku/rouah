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
        $data_final = array();
       $sql = "INSERT INTO $this->_table  (";

        $sqlSuite= " VALUES (";

        foreach( $data as $key => $value )
        {
             $sql .= $key.',';
            $sqlSuite.= ':'.$key.',';
            $data_final[':'.$key] = $value;
        }
        $partOneSql = substr($sql,0,-1).')';
        $partTwoSql = substr($sqlSuite,0,-1).')';

        $res = $this->_db->prepare($partOneSql.$partTwoSql);
        $res->execute( $data_final );

    }


    /**
     * @param array $data
     */
    public function _update(array $data)
    {

        $sqlSuite = "";

        foreach( $data as $key => $value )
        {
            $sqlSuite.=" ".$key."=:".$key."," ;
        }
        $partOne = substr($sqlSuite,0,-1);
        $req = $this->_db->prepare("UPDATE $this->_table SET $partOne WHERE $this->_id =:".$this->_id);
        $req->execute($data);
    }


    public function _delete(array $data)
    {
        $sql="DELETE FROM $this->_table WHERE ";
        foreach ($data as $key=>$value)
        {
            $sql.=$key."='".$value."'";
        }
        $this->_db->exec($sql);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function _get($data = array())
    {
        $sql = "SELECT * FROM $this->_table WHERE ";

        foreach ($data as $key => $value)
        {
            $sql.= "".$key." = "."'". $value."'";
        }
        $res = $this->_db->query($sql);

        return $res->fetchAll(PDO::FETCH_OBJ);
    }

}
