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
    

    $items->id_debtors =  $_GET['id'];

    $items->deleteDebtor();

    header("Location: ../index.php#portfolio");
    exit;

?>