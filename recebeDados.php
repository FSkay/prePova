<?php
/*
$valor = '$nome';
if(is_string($valor)):
    echo 'É do tipo String.';
else:
    echo 'Não é do tipo String.';
endif;  

$valor = 'email';
if(filter_var($valor, FILTER_VALIDATE_EMAIL)):
    echo 'E-mail válido.';
else:
    echo 'E-mail inválido.';
endif; 

/*$valor = 'data';
$arraData = explode('/', $valor);
*/
/*if(checkdate($arraData[1], $arraData[0], $arraData[2])):
    echo 'Data válida.';
else:
    echo 'Data inválida.';
endif; 
*/
?>
<?php
require_once 'conexao.php';

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
    </body>
</html>

