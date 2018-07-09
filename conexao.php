<?php

$hostname = 'localhost';   // Servidor Mysql
$database = 'prePovadb';         // Nome do Schema (banco de dados)
$username = 'root';      // Nome de login de acesso ao banco
$password = '';         // Senha de login de acesso

try {
    // Criando a classe de conexão PDO com o servidor Mysql
    $connection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
} catch (Exception $e) {
    // Apresenta uma mensagem caso ocorra algum problema
    throw new Exception('Ocorreu um erro ao executar o comando no banco de dados! ERRO: ' . $e->getMessage());
}
require_once 'functions.php';
