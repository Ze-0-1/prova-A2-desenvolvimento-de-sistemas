<?php
$host = "127.0.0.1";
$user = "root";
$porta = "3306";
$password = "ceub123456";


$db = "tarefas"; 

$pdo = new PDO(
    'mysql:host='.$host.';port='.$porta.';dbname='.$db.';charset=utf8',
    $user,
    $password
);

// Linha extra recomendada para ajudar a detetar erros na base de dados
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>