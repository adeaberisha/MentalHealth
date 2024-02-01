<?php

class DatabaseConnection{
    private static $instance = null;
    private $server="localhost";
    private $username="root";
    private $password="";
    private $database="mentalhealth";


    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function startConnection(){

        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->database",$this->username,$this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e){
            echo "Database Connection Failed".$e->getMessage();
            return null;
        }
    }
}

?>