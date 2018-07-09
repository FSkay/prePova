<?php

require_once 'functions.php';

// resgata os valores do formulário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$data_nascimento = isset($_POST['data_nascimeto']) ? $_POST['data_nascimeto'] : null;
$id = isset($_POST['Id']) ? $_POST['Id'] : null;

// validação (bem simples, mais uma vez)
if (empty($nome) || empty($endereco) || empty($email) || empty($data_nascimeto)) {
    echo "Volte e preencha todos os campos";
    die();
}

// a data vem no formato dd/mm/YYYY
// então precisamos converter para YYYY-mm-dd
$isoDate = dateConvert($data_nascimento);

// atualiza o banco
$connection = db_connect();
$sql = "UPDATE contatos SET nome = :nome, endereco = endereco, email = :email, data_nascimeto = :data_nascimeto WHERE Id = :Id";
$stmt = $connection->prepare($sql);
$stmt->bindParam(':Nome', $nome);
$stmt->bindParam(':Endereco', $endereco);
$stmt->bindParam(':Email', $email);
$stmt->bindParam(':data_nascimeto', $isoDate);
$stmt->bindParam(':Id', $Id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: lista.php');
} else {
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}
