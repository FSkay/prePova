<?php
require_once 'conexao.php';
// abre a conexão
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
// Veja o Exemplo 2 deste link: http://php.net/manual/pt_BR/pdostatement.rowcount.php
$sql_count = "SELECT COUNT(*) AS total FROM contatos ORDER BY Id ASC";

// SQL para selecionar os registros
$sql = "SELECT Id, Nome, Endereco, Email, Data_Nascimento FROM contatos ORDER BY Id ASC";

// conta o total de registros
$stmt_count = $connection->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

// seleciona os registros
$stmt = $connection->prepare($sql);
$stmt->execute();
?>
<html>
    <head>
        <meta charset="utf-8">

        <title>Sistema de Cadastro Contatos</title>
    </head>
    <body>
        <h2>Lista de Usuários</h2>
        <table width="50%" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($contatos = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $contatos['Id'] ?></td>
                        <td><?php echo $contatos['Nome'] ?></td>
                        <td><?php echo $contatos['Endereco'] ?></td>
                        <td><?php echo $contatos['Email'] ?></td>
                        <td><?php echo dateConvert($contatos['Data_Nascimento']) ?></td>
                        <td>
                            <a href="editar.php?Id=<?php echo $contatos['Id'] ?>">Editar</a>
                            <a href="del.php?Id=<?php echo $contatos['Id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <p>Total de usuários: <?php echo $total ?></p>

        <?php if ($total > 0): ?>

        <?php else: ?>

            <p>Nenhum usuário registrado</p>

        <?php endif; ?>

    
        <br>
        <p><a href="index.php">Home</a></p>

    </body>
</html>
