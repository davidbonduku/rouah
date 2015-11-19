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

    protected function _add(array $data)
    {
        if(sizeof($data) == 0 )
        {
            AppException::show(array(
                'message'=> "Impossible d'ajouter données",
                'type'=> "DataModelException",
                'code'=> 209
            ));

        }else{
                 $sql = "INSERT INTO $this->_table (";

                 $sqlTemp = ""; $valuesTemp = "";

                foreach($data as $key=>$value){

                    $sqlTemp.=$key.",";

                    $valuesTemp.=":".$key.",";
                }

                $request = $this->_db->prepare( $sql.substr($sqlTemp,0,-1).")

                                               VALUES (".substr($valuesTemp,0,-1).")"
                );
                $request->execute($data);
        }
    }
}