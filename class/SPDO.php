<?php

class SPDO {
    
    /**
    * Instance de la classe PDO
    */ 
    private $PDOInstance = null;

    /**
    * Instance de la classe SPDO
    */ 
    private static $instance = null;

    /**
    * Constante: nom d'utilisateur de la bdd
    */
    const DEFAULT_SQL_USER = 'newstool';

    /**
    * Constante: hôte de la bdd
    */
    const DEFAULT_SQL_HOST = 'localhost';

    /**
    * Constante: hôte de la bdd
    */
    const DEFAULT_SQL_PASS = 'News Tool';

    /**
    * Constante: nom de la bdd
    */
    const DEFAULT_SQL_DTB = 'newstool';

    /**
    * Constructeur
    *
    * @param void
    * @return void
    * @see PDO::__construct()
    * @access private
    */
    private function __construct() {
        $this->PDOInstance = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS);        
    }

    /**
    * Crée et retourne l'objet SPDO
    */
    public static function getInstance() {    
        if(is_null(self::$instance)) {
                self::$instance = new SPDO();
        }
        return self::$instance;
    }

    public function query($query, $params = array()) {
        if(!empty($params)) {

            $sth = $this->PDOInstance->prepare($query);         
            foreach($params as $k => $v) {
                $sth->bindValue($k, $v);
            }
            
            return $sth->execute();
        } else {

            return $this->PDOInstance->query($query);
        }
    }

    public function fetch($query, $params = array()) {
        $sth = $this->PDOInstance->prepare($query);

        foreach($params as $k => $v) {
            $sth->bindValue($k, $v);
        }
        $sth->execute();
        return $sth->fetch(PDO::FETCH_OBJ);
    }

    public function lastInsertId() {
        return $this->PDOInstance->lastInsertId();
    }

    public function fetchAll($query, $params = array()) {
        $sth = $this->PDOInstance->prepare($query);

        foreach($params as $k => $v) {
            $sth->bindValue($k, $v);
        }

        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}