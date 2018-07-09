<?php
require 'conexao.php';
 
// pega o ID da URL
$Id = isset($_GET['Id']) ? (int) $_GET['Id'] : null;
 
// valida o ID
if (empty($Id))
{
    echo "ID para alteração não definido";
    exit;
}
 
// busca os dados du usuário a ser editado
$connection = db_connect();
$sql = "SELECT Nome, Endereco, Email, Data_Nascimento FROM contatos WHERE Id = :Id";
$stmt = $connection->prepare($sql);
$stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
 
$stmt->execute();
 
$contatos = $stmt->fetch(PDO::FETCH_ASSOC);
 
// se o método fetch() não retornar um array, significa que o ID não corresponde a um usuário válido
if (!is_array($contatos))
{
    echo "Nenhum usuário encontrado";
    exit;
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="latin1">
 
        <title>Edição de Contatos</title>
    </head>
 
    <body>
 
        <h1>Sistema de Cadastro de Contatos</h1>
 
        <h2>Edição de Contatos</h2>
         
        <form action="edit.php" method="post">
            <label for="Nome">Nome: </label>
            <br>
            <input type="text" name="Nome" id="Nome"value="<?php echo $contatos['Nome'] ?>">
            <br><br>
 
            <label for="Endereco">Endereço: </label>
            <br>
            <input type="text" name="Endereco" id="Endereco"value="<?php echo $contatos['Endereco'] ?>">
 
            <br><br>

            <label for="Email">Email: </label>
            <br>
            <input type="text" name="Email" id="Email"value="<?php echo $contatos['Email'] ?>">
 
            <br><br>
             
            <label for="Data_Nascimento">Data de Nascimento: </label>
            <br>
            <input type="text" name="Data_Nascimento" id="Data_Nascimento" placeholder="dd/mm/YYYY" value="<?php echo dateConvert($contatos['Data_Nascimento']) ?>">
 
            <input type="hidden" name="Id" value="<?php echo $Id ?>">
            <br><br>
            <input type="submit" value="Alterar">
        </form>
 
    </body>
</html>

