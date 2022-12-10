<?php

class Database {

    private $host = 'localhost';
    private $db_name = 'tblproduct';
    private $username = 'root';
    private $password = '';
    private $conn;


    public function Connect(){

           $this->conn = null;

           try{

            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
            $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           }
           catch(PDOException $ex)
           {
             echo 'Connection Error: ' . $ex->getMessage();
           }

           return $this->conn;

    }

    public function ConnectMySQLi(){

      $this->conn = null;

      try{
        $conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
      }
      catch(Exception $ex)
      {
        echo 'Connection Error: ' . $ex->getMessage();
      }
        

      return $conn;


      }
      
    }
