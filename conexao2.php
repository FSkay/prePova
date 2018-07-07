<!DOCTYPE html>
<html >
   <head>
       <meta charset="UTF-8">
       <title></title>
   </head>
   <body>
       <?php
 
       class Cliente {
 
           public $id;
           public $nome;
           public $endereco;
           public $email;
           public $data_nascimento;
       }
 
       function criarBaseDados($host, $usuario, $senha, $dbNome) {
           try {
               $pdo = new PDO("mysql:host=$host", $usuario, $senha);
 
               $strCriarBase = "CREATE DATABASE $dbNome;";
 
               echo '$strCriarBase: ' . $strCriarBase . '<br>';
 
               $pdo->exec($strCriarBase) or die('1<pre>' . print_r($pdo, true) . '</pre>');
 
               $pdo->query("use $dbNome") or die('2<pre>' . print_r($pdo, true) . '</pre>');
 
 
               $strCriarTabela = "CREATE table Contatos(
                                  id INT AUTO_INCREMENT PRIMARY KEY,
                                  nome VARCHAR(50),
                                  endereco VARCHAR(50),
                                  email VARCHAR(50),
                                  data_nascimento datetime));";
 
               echo '$strCriarBase: ' . $strCriarTabela . '<br>';
 
               $pdo->exec($strCriarTabela);
 
               $strInserir = "INSERT INTO cliente(Nome, Endereco) VALUES('paulo', 'rua brasil');";
 
               $pdo->exec($strInserir) or die('4<pre>' . print_r($pdo->errorInfo(), true) . '</pre>');
 
               $strInserir = "INSERT INTO cliente(Nome, Endereco) VALUES('pedro', 'rua brasil');";
 
               $pdo->exec($strInserir) or die('5<pre>' . print_r($pdo, true) . '</pre>');
 
               $pdo = null;  // fecha conexão
           } catch (PDOException $e) {
               die("Erro no Banco: <pre> " . print_r($e, true) . '</pre>');
           }
       }
 
       $host = 'localhost';
       $usuario = 'root';
       $senha = '';
       $dbNome = 'prePovadb';
 
       try {
           $pdo = new PDO("mysql:host=$host;dbname=$dbNome;charset=latin1", $usuario, $senha);
       } catch (PDOException $e) {
 
           echo ('Error, base ainda não existe: ' . $e->getMessage() . '  <br>  ');
 
           criarBaseDados($host, $usuario, $senha, $dbNome);
 
           $pdo = new PDO("mysql:host=$host;dbname=$dbNome;charset=latin1", $usuario, $senha);
       }
 
 
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 
       $nome = 'joão';
       $endereco = 'rua principal';
 
       $strInserir = "INSERT INTO Contatos(Nome, Endereco) VALUES(:nome, :endereco);";
 
       $comando = $pdo->prepare($strInserir, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
 
       $comando->execute(array(':nome' => $nome, ':endereco' => $endereco));
 
 
 
       $consulta = 'SELECT * FROM Contatos';
 
       $consulta = $pdo->query('SELECT * FROM Contatos');
 
       echo '$consulta: <pre>' . print_r($consulta, true) . '</pre>';
 
       $pessoaArray = $consulta->fetchAll(PDO::FETCH_ASSOC);
       echo 'Resultado: <pre>' . print_r($pessoaArray, true) . '</pre><br>';
 
 
       echo '------------------------------------------------------------<br>';
 
 
       $consulta2 = $pdo->query("SELECT 'id', id.* FROM Contatos");
       $pessoaArray = $consulta2->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE);
       echo 'Resultado: <pre>' . print_r($pessoaArray, true) . '</pre><br>';
 
 
 
       echo '------------------------------------------------------------<br>';
       $consulta = $pdo->query('SELECT * FROM Contatos');
       while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
           echo '$linha: <pre>' . print_r($linha, true) . '</pre><br>';
       }
 
       echo '------------------------------------------------------------<br>';
       $consulta = $pdo->query('SELECT * FROM Contatos');
       while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {
           echo '$linha: <pre>' . print_r($linha, true) . '</pre><br>';
       }
 
       echo '------------------------------------------------------------<br> <br>';
       $cliente = new Cliente;
       $consulta = $pdo->query('SELECT * FROM Contatos');
       while ($cliente = $consulta->fetchObject('Contatos')) {
           echo '$cliente: <pre>' . print_r($cliente, true) . '<br>';
           echo 'id: ' . $cliente->id . '<br>';
           echo 'nome: ' . $cliente->nome . '<br>';
           echo 'endereco: ' . $cliente->endereco . '<br>';
       }
 
 
 
 
 
       echo 'mysqli----------------------------------------------------<br>';
 
       $mysqli = new \mysqli($host, $usuario, $senha, $dbNome);
       mysqli_set_charset($mysqli, "utf8");
 
       $query = "SELECT * FROM Contatos;";
 
 
 
       if ($resultado = $mysqli->query($query)) {
           while ($cliente = $resultado->fetch_object('Contatos')) {
               echo 'id: ' . $cliente->id . '<br>';
               echo 'nome: ' . $cliente->nome . '<br>';
               echo 'endereco: ' . $cliente->endereco . '<br>';
           }
       }
       $resultado->close();
       ?>
 
       <br>
       https://www.phpro.org/tutorials/Introduction-to-PHP-PDO.html#7.1
       http://www.w3resource.com/php/pdo/php-pdo.php
       http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/
 
   </body>
</html>


