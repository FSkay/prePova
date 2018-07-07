<!--Conexão com banco de dados-->
<?php
$host = 'localhost';
$porta = 3306;
$usuario = 'root';
$senha = '';
$dbNome = 'prePovadb';
 
 
$pdo = new PDO("mysql:host=$host:$porta;
                   dbname=$dbNome;charset=latin1",
                   $usuario, $senha);
 
 
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$totalRegistrosInseridos = $pdo->exec(
   "INSERT INTO Contatos(Nome, Endereco, Email, Data_Nascimento)
             VALUES('?', '?', '?', '?');"
           );
 
echo 'Total registros inseridos: ' . $totalRegistrosInseridos;

