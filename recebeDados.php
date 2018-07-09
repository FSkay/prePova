<?php
require_once 'functions.php';

if (strlen($nome) > 50) {
    echo "Nome muito grande";
    die();
}

if (strlen($endereco) > 50) {
    echo "Endereço muito grande";
    die();
}
if (strlen($email) > 50) {
    echo "Endereço de e-mail muito grande";
    die();
}

if (isset($_POST['nome'])) {

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data'];

    $stmt = $connection->prepare("INSERT INTO Contatos(nome,endereco,email,data_nascimento) VALUES(:nome,:endereco,:email,:data_nascimento)");

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':data_nascimento', $data_nascimento);


    $stmt->execute();
}
?>
<html>
    <body>
        Dados enviado com sucesso!
        <br>

    </body>
</html>

