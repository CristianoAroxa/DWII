<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Dados #01</title>
</head>
<body>
    <h1>Inserir Registro #01 via PhP</h1>

    <?php
    require_once("conexao.php");

    $sql="INSERT INTO cadastros (nome, nascimento, email, site, filhos, salario) 
    VALUES    
    ('Lucas Marcondes Guedes','1996-08-18', 'lucasmarcondesguedes@email.com.br','http:\\www.lucasgordon.com.br', 1, 15590.75),
    ('Gustavo Marcondes Toth','2006-09-14','gustavomtoth@email123.com.br', null, 0, 7899.99)";

    //vamos criar uma nova conexão
    $conexao = novaConexao();

    //Executando a inserção de dados no banco
    $resultado = $conexao->query($sql);

    if($resultado){
        echo "Dados INSERIDOS com SUCESSO :)";
    }else{
        echo ":( Erro: ".$conexao->error;
    }

    //Nosso proximo arquivo será o Consultar_dados.php;
    ?>
</body>
</html>