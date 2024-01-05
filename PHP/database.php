<?php
namespace App\Database;

use PDO;
use PDOException;

class database extends PDO {
    public function __construct()
    {
        try
        {
            // Utilisez le constructeur parent pour passer les paramètres de connexion
            parent::__construct('mysql:host=localhost;dbname=plld-acf2l;charset=utf8', 'root', '');
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }
    
    public static function getInstance():self
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
}
?>