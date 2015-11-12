<?php
class BDDConnexion
{
    /**
     * Instance de la classe connexion
     * @access private
     * @var connexion
     * @see getInstance
     */
    private static $_instance;

    /**
     * Type de la base de donnée.
     * @access private
     * @var string
     * @see __construct
     */
    private $_type = "mysql";

    /**
     * Adresse du serveur hôte.
     * @access private
     * @var string
     * @see __construct
     */
    private static $_host = "localhost";
    /**
     * Nom de la base de donnée.
     * @access private
     * @var string
     * @see __construct
     */
    private static $_dbname = "bddMusique";
    /**
     * Nom d'utilisateur pour la connexion à la base de données
     * @access private
     * @var string
     * @see __construct
     */
    private  static $_username = "root";
    /**
     * Mot de passe pour la connexion à la base de donnée
     * @access private
     * @var string
     * @see __construct
     */
    private static $_password = 'root';

    private static $_dbh;

    private static $_debug = false;
    /**
     * Lance la connexion à la base de donnée en le mettant
     * dans un objet PDO qui est stocké dans la variable $dbh
     * @access private
     */
    private  function __construct()
    {
        try{
                self::$_dbh = new PDO(
                    $this->_type.':host='.self::$_host.'; dbname='.self::$_dbname,
                    self::$_username,
                    self::$_password,
                    array(PDO::ATTR_PERSISTENT => true)
                );
            $req = "SET NAMES UTF8";
            $result = self::$_dbh->prepare($req);
            $result->execute();

        }
        catch(PDOException $e){
            if(self::$_debug)
            {
                echo "Erreur !: ".$e->getMessage();
            }
            die();
        }
    }
    /**
     * Regarde si un objet connexion a déjà été instancier,
     * si c'est le cas alors il retourne l'objet déjà existant
     * sinon il en créer un autre.
     * @return $instance
     */
    private static function getInstance()
    {
        if (!self::$_instance instanceof self)
        {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    /**
     * Permet de configuration la connexion à la base de données
     * @param array $conf
     */
    public static function config(array $conf)
    {
        self::_setDbname($conf);
        self::_setHost($conf);
        self::_setUsername($conf);
        self::_setPassword($conf);
        self::_setDebug($conf);

    }
    /**
     * @param array $conf
     */
    private static function _setHost(array $conf)
    {
        if(in_array('host', $conf))
        {
            self::$_host= $conf['host'];
        }
    }
    /**
     * @param array $conf
     */
    private static function _setDbname(array $conf)
    {
        if(in_array('dbname', $conf))
        {
            self::$_dbname = $conf['dbname'];
        }
    }

    /**
     * @param array $conf
     */
    private static function _setUsername( array $conf)
    {
        if(in_array('username', $conf))
        {
             self::$_username = $conf['username'];
        }
    }
    /**
     * @param array $conf
     */
    private static function _setPassword(array $conf)
    {
        if(in_array('password', $conf))
        {
            self::$_password = $conf['password'];
        }
    }
    /**
     * @param array $conf
     */
    private static function _setDebug(array $conf)
    {
        if(in_array('debug', $conf))
        {
            self::$_debug = $conf['debug'];
        }
    }
    /**
     * Permet de récuperer l'objet PDO permettant de manipuler la base de donnée
     * @return $dbh
     */
    public static function getDbh()
    {
        self::getInstance();
        return self::$_dbh;
    }
}
