<?php
class BDDConnexion
{
    /**
     * Instance de la classe connexion
     * @access private
     * @var connexion
     * @see getInstance
     */
    private static $instance;

    /**
     * Type de la base de donnée.
     * @access private
     * @var string
     * @see __construct
     */
    private $type = "mysql";

    /**
     * Adresse du serveur hôte.
     * @access private
     * @var string
     * @see __construct
     */
    private $host = "localhost";

    /**
     * Nom de la base de donnée.
     * @access private
     * @var string
     * @see __construct
     */
    private $dbname = "bddMusique";

    /**
     * Nom d'utilisateur pour la connexion à la base de données
     * @access private
     * @var string
     * @see __construct
     */
    private $username = "root";

    /**
     * Mot de passe pour la connexion à la base de donnée
     * @access private
     * @var string
     * @see __construct
     */
    private $password = 'root';

    private $dbh;

    /**
     * Lance la connexion à la base de donnée en le mettant
     * dans un objet PDO qui est stocké dans la variable $dbh
     * @access private
     */
    private function __construct()
    {
        try{
            $this->dbh = new PDO(
                $this->type.':host='.$this->host.'; dbname='.$this->dbname,
                $this->username,
                $this->password,
                array(PDO::ATTR_PERSISTENT => true)
            );

            $req = "SET NAMES UTF8";
            $result = $this->dbh->prepare($req);
            $result->execute();
        }
        catch(PDOException $e){
            // echo "<div class="\"error\"">Erreur !: ".$e->getMessage()."</div>";
            die();
        }
    }

    /**
     * Regarde si un objet connexion a déjà été instancier,
     * si c'est le cas alors il retourne l'objet déjà existant
     * sinon il en créer un autre.
     * @return $instance
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof self)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Permet de récuprer l'objet PDO permettant de manipuler la base de donnée
     * @return $dbh
     */
    public function getDbh()
    {
        return $this->dbh;
    }
}



?>

