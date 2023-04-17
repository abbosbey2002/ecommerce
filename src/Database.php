<?php

class Database{
    public $servername;
    public $dataname;
    public $username;
    public $password;

    public function __construct($servername, $dataname, $username, $password)
    {
        $this->servername=$servername;
        $this->dataname=$dataname;
        $this->username=$username;
        $this->password=$password;
        $this->connect();   
    }

    // connect with database
    public function connect(){
        // set new interfeys with database
        $connection=new PDO("mysql:host=$this->servername;dbname=$this->dataname", $this->username, $this->password);
        // set  pdo error mode to exeption
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // return resault
        return $connection;

    }
}