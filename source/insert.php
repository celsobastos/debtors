<?php
   
    //Include DB and  crud class
    include_once 'database.php';
    include_once 'debtors.class.php';

    //Instace DB
    $database = new Database();

    //Create conection with DB
    $db = $database->getConnection();

    //Instace Debtors class
    $items = new Debtors($db);
    
    
    $items->nome =  $_POST['nome'];
    $items->cpf_cnpj =   $_POST['cpf-cnpj'];
    $items->data_nascimento =   $_POST['data-nascimento'];
    $items->endereco =   $_POST['endereco'];
    $items->descricao_titulo =   $_POST['descricao'];
    $items->valor =   $_POST['valor'];

    $items->createDebtor();

    header("Location: ../index.php#portfolio");
    exit;

?>