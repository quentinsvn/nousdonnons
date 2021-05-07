<?php 
    try {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $database = new PDO('mysql:host=localhost;dbname=nousdonnons;charset=utf8', 'root', '');
    } catch (Exception $e) {
        echo $e;
    }

    session_start();
?>