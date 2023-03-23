<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir 01</title>
</head>
<body>
    <h1>Excluir dados 01 - via linha de comando</h1>
    <?php
    require_once("conexao.php");
    $sql = "DELETE FROM cadastros WHERE id= 3";
    $conexao = novaConexao();
    $resultado = $conexao->query($sql);

    if($resultado){
        echo "Registro excluido com sucesso!";
    }else{
        echo ":( Erro:" .$conexao->error;
    }

    ?>
    
</body>
</html>
