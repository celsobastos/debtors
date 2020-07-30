<?php
    /*
    CRUD Create Read Update Delete
    */
    class Debtors{

        // Connection
        private $conn;

        // Table
        private $db_table = "debtors";

        // Columns
        public $id_debtors = NULL;
        public $nome;
        public $cpf_cnpj;
        public $data_nascimento;
        public $endereco;
        public $descricao_titulo;
        public $valor;
        public $update;


        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // READ ALL
        public function getDebtors(){

            $stmt = $this->conn->prepare("SELECT * FROM " . $this->db_table);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            
            return  $result ;
        }

        // READ Single
        public function getDebtorsSingle(){

            $stmt = $this->conn->prepare("SELECT * FROM " . $this->db_table . " WHERE id_debtors = ?");
            $stmt->bind_param("i", $this->id_debtors);
            $stmt->execute();

            /* execute prepared statement */
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $row['data_nascimento'] = date('d-m-Y', strtotime($row['data_nascimento']));

   
            $stmt->close();

            return  $row;
        }

        // CREATE
        public function createDebtor(){

            $this->sefeData();
            $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->db_table . " VALUES (? , ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'ssssssds', 
                $this->id_debtors, 
                $this->nome, 
                $this->cpf_cnpj, 
                $this->data_nascimento, 
                $this->endereco , 
                $this->descricao_titulo, 
                $this->valor, 
                $this->update);

            /* execute prepared statement */
            mysqli_stmt_execute($stmt);
            $stmt->close();
        }

        //UPDATE
        public function updateDebtor(){

            $this->sefeData();
            
            $stmt = mysqli_prepare($this->conn, "UPDATE debtors SET nome = ?, 
                                                cpf_cnpj = ?,
                                                data_nascimento = ?,
                                                endereco = ?, 
                                                descricao_titulo = ?,
                                                valor = ?,
                                                dt_update = ? WHERE id_debtors = ?");
                                                 
            mysqli_stmt_bind_param($stmt, 'sssssdss', 
                $this->nome, 
                $this->cpf_cnpj,
                $this->data_nascimento, 
                $this->endereco,
                $this->descricao_titulo,
                $this->valor, 
                $this->update,
                $this->id_debtors);

            

            /* execute prepared statement */
            mysqli_stmt_execute($stmt);
            $stmt->close();

        }

      

        // DELETE
        public function deleteDebtor(){

            $stmt = mysqli_prepare($this->conn, "DELETE FROM " . $this->db_table . " WHERE id_debtors = ?");
            mysqli_stmt_bind_param($stmt, 'd', $this->id_debtors);

            $this->id_debtors = htmlspecialchars(strip_tags($this->id_debtors));

            /* execute prepared statement */
            mysqli_stmt_execute($stmt);
            $stmt->close();

        }

        //Safe
        private function sefeData(){

            $this->nome = htmlspecialchars(strip_tags($this->nome)); 
            $this->cpf_cnpj = htmlspecialchars(strip_tags($this->cpf_cnpj));
            $this->data_nascimento = date('Y-m-d', strtotime(htmlspecialchars(strip_tags($this->data_nascimento))));
            $this->endereco = htmlspecialchars(strip_tags($this->endereco));
            $this->descricao_titulo = htmlspecialchars(strip_tags($this->descricao_titulo));
            $this->valor = floatval(str_replace(",", ".", htmlspecialchars(strip_tags($this->valor))));
            $this->update = date("Y-m-d H:i:s");

        }

    }
?>