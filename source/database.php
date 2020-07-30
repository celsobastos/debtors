<?php

class Database {
    private $host = "fdb2.awardspace.net";
    private $database_name = "1037317_contatos";
    private $username = "1037317_contatos";
    private $password = "@g1l3t3c";

    public $conn;

    public function getConnection(){
        $this->conn = null;
        try{
            $mysqli = new mysqli($this->host, $this->username, $this->password, $this->database_name);
            if ($mysqli)
            {
                $this->conn = $mysqli;
            } else {
                throw new Exception('Unable to connect');
            }

        }catch (Exception $e) {
            echo 'ERROR:'.$e->getMessage();
        }

        return $this->conn;

    }
}  


?>