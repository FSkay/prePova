<?php
 
require_once 'conexao.php';
 
// resgata os valores do formulário
$Nome = isset($_POST['Nome']) ? $_POST['Nome'] : null;
$Endereco = isset($_POST['Endereco']) ? $_POST['Endereco'] : null;
$Email = isset($_POST['Email']) ? $_POST['Email'] : null;
$Data_Nascimeto = isset($_POST['Data_Nascimeto']) ? $_POST['Data_Nascimeto'] : null;
$id = isset($_POST['Id']) ? $_POST['Id'] : null;
 
// validação (bem simples, mais uma vez)
if (empty($Nome) || empty($Endereco) || empty($Email) || empty($Data_Nascimeto))
{
    echo "Volte e preencha todos os campos";
    exit;
}
 
// a data vem no formato dd/mm/YYYY
// então precisamos converter para YYYY-mm-dd
$isoDate = dateConvert($Data_Nascimeto);
 
// atualiza o banco
$connection = db_connect();
$sql = "UPDATE contatos SET name = :Nome, Endereco = Endereco, Email = :Email, Data_Nascimeto = :Data_Nascimeto WHERE Id = :Id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':Nome', $Nome);
$stmt->bindParam(':Endereco', $Endereco);
$stmt->bindParam(':Email', $Email);
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