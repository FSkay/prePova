<?php
require_once 'conexao.php';

try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    

    // Prepare statement
    $stmt = $connection->prepare("UPDATE Contatos SET * WHERE=Id");

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
<html>
    <body>
    Dados alterado com sucesso!
    <br>
    
    </body>
</html>

