<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Formulário Inserindo Dados Mysql</title>
</head>

<body>
    <h2>FORMULÁRIO</h2>
    <?php

    $erros = [];
    if (count($_POST) > 0) {
        //Vamos criar uma variavel que irá receber os dados vindos pelo $_POST e armazenar nela para que possamos utilizar nos outros pontos da aplicação utlizando somente os dados que estarão dentro de um requisição.
        $dados = $_POST;
        //Vamos verificar se a chave nome está com problemas, para isso iremos usar a função trim()para retirar os espaços embranco que contiverem no inicio e fim do conteudo da chave, e verificar se ela está vazia ou não.(01 = -> Atribuição de Valor a variável, 02 == -> Comparação de Valor se os valores são iguais independente do tipo de variavel, 03 === -> Comparação do valor da varial com relação a igualde de valor e tipo de dado.)
        if (trim($dados['nome'])==="") {
            $erros['nome'] = "Nome é obrigatório";
        }
//Devemos alterar todos os $_POST por $dados que estiverem dentro do bloco PhP, as funções filter_var devemos deixa-las como está.
        if (isset($dados['nascimento'])) {
            $data = DateTime::createFromFormat('d/m/Y', $dados['nascimento']);
            if (!$data) {
                $erros['nascimento'] = "A data de nascimento deverá estar no formato dd/mm/aaaa";
            }
        }

        if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $erros['email'] = "Email inválido";
        }

        if (!filter_var($dados['site'], FILTER_VALIDATE_URL)) {
            $erros['site'] = "URL Inválido!, deve ter o padrão http://www.dominio.com.br";
        }

        $filhoConfig = ['options' => ['min_range' => 0, 'max_range' => '20']];

        if (!filter_var($dados['filhos'], FILTER_VALIDATE_INT, $filhoConfig) && $dados['filhos'] != 0) {

            $erros['filhos'] = "Quantidade de filhos incorreta, valores 0-20";
        }

        $salarioConfig = ['options' => ['decimal' => ',']];
        if (!filter_var($dados['salario'], FILTER_VALIDATE_FLOAT, $salarioConfig)) {
            $erros['salario'] = "Valor de salário invalido! utilize a virgula (,)para separar a casa decimal";
        }

        //Agora podemos começar a trabalhar a inserção de dados no banco de dados, mas para isso temos que ainda verifica se temos algum tipo de problema de erra para exibir. Para isso iremos verificar se a variavel $erros está sem erros, caso tenha algum registro dentro dela não prosseguimos com a inserção dos dados.
        if(count($erros)==0){
           //Entrando aqui significa que não foram encontrados erros e assim possamos iniciar nosso processo de inserção de dados no banco de dados, porem temos que montar um estrutura de inseção para que possamos evitar um ataque de SQL Injection no momento de realizar a inserção de dados ao banco.
            require_once("conexao.php");
            //Vamos criar uma variavel $SQL, onde irá recebe a instrução de inserção de dados no banco de dados, e após informarmos os campos a serem preenchidos, devemos no VALUES representar cada atributo do banco de dados com um simbolo de interrogação e um espaço separados por virgula (? , ?, ...., ?, ?,)
            $sql="INSERT INTO cadastros (nome, nascimento, email, site, filhos, salario) values (?, ?, ?, ?, ?, ? )";

            $conexao = novaConexao();
            $insert = $conexao->prepare($sql);

            $params = [
                //Vamos dentro deste ARRAY criado receber todos os valores que colocamos dentro da variavel $dados, para possa ser utilizada para inserção dos dados no banco de dados.
                $dados['nome'],
                //Para a chave nascimento precisamos fazer um tratamento da data para ser inserida no banco de dados. Quando foi realizada o recebimento da data de nascimento no formulá nós criamos uma variavel $data que formatou o estilo da data de (Y-m-d) para (d-m-Y), porem para inserir no banco de dados temos que fazer uma operação contrária, ou seja, de (d-m-Y) para (Y-m-d, para isso iremos fazer uma operação ternária na variavel $data, e assim o seu resultado será inserido no ARRAY de inserção de dados no banco de dados)
                $data ? $data->format('Y-m-d'):null,
                $dados['email'],
                $dados['site'],
                $dados['filhos'],
                $dados['salario'] ? str_replace(",",".",$dados['salario']):null,
            ];

            //Agora devemos fazer um bind em nosso $insert, informando qual o tipo de dado inserido, onde teremos nome(string),data(string),email(string),site(string),filhos(inteiro),dados(decimal), sendo assim iremos colocar como parametro de tipo de dado no bind_param a seguinte sequencia de tipos de dados (ssssid)
            $insert->bind_param("ssssid", ...$params);

            
            //Agora executar e verificar se a inserção deu certo 
            if ($insert->execute()){
                unset($dados); //Limpando os dados enviados pelo $_POST
            }

        }
    }
    ?>
   
    <form method="POST">
        <div class="form-row">           
            <div class="form-group col-md-8">              
                <label for="nome">Nome:</label>               
                <input type="text" class="form-control <?php
                echo isset($erros['nome']) ? 'is-invalid' : '' ?>" id="id_nome" name="nome" placeholder="Nome"
                    value="<?php echo isset($dados['nome']) ? $dados['nome'] : '' ?>">                
                <div class="invalid-feedback">
                    <?php
                    echo $erros['nome'];
                    ?>
                </div>               
            </div>

            <div class="form-group col-md-4">
                <label for="nascimento">Nascimento:</label>
                <input type="text" class="form-control <?php echo isset($erros['nascimento']) ? 'is-invalid' : '' ?>"
                    id="id_nascimento" name="nascimento" placeholder="Nascimento"
                    value="<?php echo isset($dados['nascimento']) ? $dados['nascimento'] : '' ?>">
                <div class="invalid-feedback">
                    <?php echo $erros['nascimento']; ?>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" class="form-control <?php echo isset($erros['email']) ? 'is-invalid' : '' ?>"
                    id="id_email" name="email" placeholder="E-mail"
                    value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>">
                <div class="invalid-feedback">
                    <?php echo $erros['email'] ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="site">Site:</label>
                <input type="text" class="form-control <?php echo isset($erros['site']) ? 'is-invalid' : '' ?>"
                    id="id_site" name="site" placeholder="Site"
                    value="<?php echo isset($dados['site']) ? $dados['site'] : '' ?>">
                <div class="invalid-feedback">
                    <?php echo $erros['site']; ?>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="filhos">Qtd de Filhos:</label>
                <input type="number" class="form-control <?php echo isset($erros['filhos']) ? 'is-invalid' : '' ?>"
                    id="id_filhos" name="filhos" placeholder="Qtd de Filhos"
                    value="<?php echo isset($dados['filhos']) ? $dados['filhos'] : '' ?>">
                <div class="invalid-feedback">
                    <?php echo $erros['filhos'] ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="salario">Salário:</label>
                <input type="text" class="form-control <?php echo isset($erros['salario']) ? 'is-invalid' : '' ?>"
                    id="id_salario" name="salario" placeholder="Salário"
                    value="<?php echo isset($dados['salario']) ? $dados['salario'] : '' ?>">
                <div class="invalid-feedback">
                    <?php echo $erros['salario'] ?>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary btn-lg">Enviar</button>
        </div>
    </form>
</body>

</html>