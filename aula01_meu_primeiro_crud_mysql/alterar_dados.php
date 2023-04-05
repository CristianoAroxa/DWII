<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Alterar Dados</title>
</head>

<body>
    <h1>Alternado Dados no Banco de Dados via formulário</h1>
    <!--Vamos utilizar como base para a codificação o código do Inserir_dados#02.php  e realizar alguns ajustes para o alterar.-->
    <?php
    //Inserir o require_once("conxeao") e o $conexao=novaConexao() logo no inicio de nosso bloco php.
    require_once("conexao.php");
    $conexao = novaConexao();

    //vamos criar um formulario antes de nosso formulário principal para que possamos passar a chave código que conterá o id do registro, para que possamos identificar o registro a ser alterado, que será passado por um método $_GET.
    if (isset($_GET['codigo'])) {

        //Vamos realizar o select de todos os dados utilizando um prepare()
        $sql = "SELECT * FROM cadastros WHERE id = ? ";

        //Criando o prepare() para a consulta
        $consulta = $conexao->prepare($sql);
        //Fazendo bind para a consulta, que será do tipo inteiro "i", vindo a informação do $_GET['codigo'].
        $consulta->bind_param("i", $_GET['codigo']);

        //Executar a $consulta e verificar se o resultado dela for verdadeiro, pegar o resultado do execute da $consulta.
        if ($consulta->execute()) {
            $resultado = $consulta->get_result(); //função get_result(), pega o resultado obtido pela execução da $consulta.
    
            //Verificar o resultado obtido através do num_rows se o resultado for maior que zero vamos gerar um ARRAY Associativo.
            if ($resultado->num_rows > 0) {

                $dados = $resultado->fetch_assoc();
                
                //Como vamos receber a data do banco de dados temos que tratar novamente a data, para apresentar no formulário.
                if ($dados['nascimento']) {
                    $dt = new DateTime($dados['nascimento']);
                    $dados['nascimento'] = $dt->format('d/m/Y');
                }

                 //Como vamos receber o salario do banco de dados temos que tratar novamente o salario, para apresentar no formulário.
                 if ($dados['salario']) {
                    $dados['salario']= str_replace(".",",",$dados['salario']); //O str_replace serve para substituir o ponto da casa decimal por virgula dentro da informação vinda da variavel $dados.
                    
                }
            }
        }
        //Proximo passo é criar um formulário HTML onde o usuario possa inserir qual usuario deseja alterar.
    }

    
    if (count($_POST) > 0) {

        $dados = $_POST;
        $erros = [];

        if (trim($dados['nome']) === "") {
            $erros['nome'] = "Nome é obrigatório";
        }

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
    


        if (count($erros) == 0) {

           //Vamos alterar a sintaxe de inserir para alterar agora
            $sql = "UPDATE cadastros SET nome = ?, nascimento = ?, email = ?, site = ?, filhos = ?, salario =? WHERE id = ?";

           
            $consultar = $conexao->prepare($sql);

            $params = [
                $dados['nome'],
                $data ? $data->format('Y-m-d') : null,
                $dados['email'],
                $dados['site'],
                $dados['filhos'],
                $dados['salario'] ? str_replace(",",".",$dados['salario']):null,
                //devemos colocar a chave id tambem
                $dados['id'],
            ];
        
            //Como foi inserido mais uma chave no $params, temos que colocar o tipo de dado da chave inserida no $param que em nosso caso trata-se de um inteiro, sendo assim devemos colocar i no final dos tipos de dados no bind_param
            $consultar->bind_param("ssssidi", ...$params);



            if ($consultar->execute()) {
                unset($dados);
            }
        }
    }
    ?>

    <!-- Formulario HTML para apontar o usuario a ser editado-->
    <form  method="GET">
        <div class="form-group row">
            <div class="col-sm-10">
                <input type="number" name="codigo" 
                class="form-control"  
                placeholder="Inserir o código que deseja altear" 
                value="<?php echo isset($_GET['codigo']) ? $_GET['codigo']:'' ?>">
            </div>            
            <div class="col-sm-2">
               <button class="btn btn-success">Buscar</button>
            </div>          
        </div>

    </form>



    <form method="POST">
        <!--ID escondido-->
        <input type="hidden" name="id" value="<?= $dados['id']  ?>">
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



