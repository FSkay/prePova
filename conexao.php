<!--Conexão com banco de dados-->
<?php

class Cliente {

    public $nome;
    public $endereco;
    public $email;
    public $data_nascimento;

}

$host = 'localhost';
$porta = 3306;
$usuario = 'root';
$senha = '';
$dbNome = 'prePovadb';


$pdo = new PDO("mysql:host=$host:$porta;
                   dbname=$dbNome;charset=latin1", $usuario, $senha);


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$totalRegistrosInseridos = $pdo->exec(
        "INSERT INTO Contatos(Nome, Endereco, Email, Data_Nascimento)
             VALUES(:nome, :endereco, :email, :data_nascimento);"
);

echo 'Total registros inseridos: ' . $totalRegistrosInseridos;

