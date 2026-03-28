<?php
error_reporting(E_ALL);
require_once("config.php");
class Db{

    private $dbhost = DBHOST;
    private $dbname = DBNAME;
    private $dbuser = DBUSER;
    private $dbpass = DBPASS;
    private $conn;

    

    public function connect(){
        try{
            //connection code goes here
            $dsn = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            $this->conn = new PDO($dsn, $this->dbuser, $this->dbpass,$options );
            return $this->conn;
        }catch(PDOException $e){
            $e->getMessage();
            return false;
            
        }
    }//end of connection method

 
}//end of db class
//  $connection1 = new Db;
// var_dump($connection1->connect());


?>