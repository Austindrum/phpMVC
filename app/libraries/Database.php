<?php

class Database
{
    private $host   = DB_HOST;
    private $user   = DB_USER;
    private $pass   = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh;
    private $stmt;
    private $err;

    public function __construct(){
        $dsn = 'mysql:host='.$this->host.";dbname=".$this->dbname;
        $option = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $err) {
            $this->err = $err->getMessage();
            echo $this->err;
        }
    }
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_int($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    public function execute(){
        return $this->stmt->execute();
    }
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function singleResultSet(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getLastInsertId(){
        return $this->dbh->lastInsertId();
    }
    public function rowCount(){
        return $this->stmt->rowCount();
    }
    // public function lastInertId(){
    //     return mysqli_insert_id($this->dbh);
    // }
}