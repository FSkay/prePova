<?php
 
require_once 'conexao.php';
 
// resgata os valores do formulário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$data_nascimeto = isset($_POST['data_nascimeto']) ? $_POST['data_nascimeto'] : null;
$id = isset($_POST['Id']) ? $_POST['Id'] : null;
 
// validação (bem simples, mais uma vez)
if (empty($nome) || empty($endereco) || empty($email) || empty($data_nascimeto))
{
    echo "Volte e preencha todos os campos";
    exit;
}
 
// a data vem no formato dd/mm/YYYY
// então precisamos converter para YYYY-mm-dd
$isoDate = dateConvert($data_nascimento);
 
// atualiza o banco
$connection = db_connect();
$sql = "UPDATE contatos SET name = :Nome, Endereco = Endereco, Email = :Email, Data_Nascimeto = :Data_Nascimeto WHERE Id = :Id";
$stmt = $connection->prepare($sql);
$stmt->bindParam(':Nome', $nome);
$stmt->bindParam(':Endereco', $endereco);
$stmt->bindParam(':Email', $email);
$stmt->bindParam(':Data_Nascimeto', $isoDate);
$stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
 
if ($stmt->execute())
{
    header('Location: listar.php');
}
else
{
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}