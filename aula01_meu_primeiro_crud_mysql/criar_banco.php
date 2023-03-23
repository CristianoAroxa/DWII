<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Banco MySQLi</title>
</head>
<body>
    <h1>Criando banco de dados via PHP</h1>
    <?php
        require("conexao.php");
        $conexao = novaConexao(null);
        $sql = 'CREATE DATABASE IF NOT EXISTS crud_fatec';
        $resultado=$conexao->query($sql);

        if($resultado){
            echo "Banco de Dados Criado com Sucesso!";
        }else{
            echo":( Erro:".$conexao->error;
        }
    ?>
    
</body>
</html>