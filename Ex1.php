<!DOCTYPE html>
<html>
    <head>
        <title>Pré Prova Exercicio 1</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Sistema de Contatos</h1>

        <h2>Cadastro de Contatos</h2>
        <!--O atributo action define o local (uma URL) em que os dados recolhidos do formulário devem ser enviados.-->
        <form action="/recebeDados.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" />
            <br><br>
            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="adress" />
            <br><br>
            <label for="mail">E-mail:</label>
            <input type="email" name="email" id="mail" />
            <br><br>

            <label for="nasData">Data de nascimento:</label>
            <input type="date" name="data" id="date" />
            <br><br>
            <div class="button">
                <input type="submit" value="Enviar" name="submit">
            </div>
        </form>
    </body>
</html>

