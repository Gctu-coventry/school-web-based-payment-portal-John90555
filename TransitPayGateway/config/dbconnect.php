<?php
class Database{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "lifelinebank";
    private $con;

    public function connect(){
        $this->con = null;

        try{
            $this->con =new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->user,$this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
echo "Error: " .$e->getMessage();
        }
        return $this->con;
    }
}
?>