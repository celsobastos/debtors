<?php

class Database {
    private $host = "127.0.0.1";
    private $database_name = "bd_debtors";
    private $username = "sage";
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

        //$this->conn->close();
        
    }
}  



(new Database())->getConnection();

/*

$mysqli = new mysqli("localhost", "sage", "@g1l3t3c", "test_php");

/* check connection * /
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

*/




?>