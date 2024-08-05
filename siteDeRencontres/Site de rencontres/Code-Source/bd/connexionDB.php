<?php
/*
 * Description de connexionDB
 * Connexion à la base de donnée avec des fonctions des requêtes;
 * @author Sitedudev
 */
 
class connexionDB {
    private $host = 'localhost';
    private $name = 'sitederencontres';
    private $user = 'root';
    private $pass = '';
    private $connexion;

    function __construct($host = null, $name = null, $user = null, $pass = null) {
        if ($host != null) {
            $this->host = $host;
            $this->name = $name;
            $this->user = $user;
            $this->pass = $pass;
        }
        
        try {
            $this->connexion = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->name,
                $this->user,
                $this->pass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
    
    public function connexion() {
        return $this->connexion;
    }
}

$BDD = new connexionDB();
$DB = $BDD->connexion();
?>
