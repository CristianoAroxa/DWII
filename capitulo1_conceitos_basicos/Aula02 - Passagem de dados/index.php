<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passagem de Dados</title>
</head>
<body>

    <h1> Formulário HTML </h1>
    <form name="FormTest" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" placeholder="Digite o seu Nome">
        <label>Ano Nascimento</label>
        <input type="text" name="anoNasc" placeholder="Digite o ano do seu nascimento">
        <input type="submit" name="btnEnviar" id="idEnviar" value="Enviar">     
    </form>
    <?php 
    $nome;
    $anoNAsc;
    $anoAtual=date("Y");
    $texto = "Olá seja bem vindo(a), ";

    //Receber informações do formulário
    if(isset($_POST["nome"])|| isset($_POST["anoNasc"])){
    
    $nome = $_POST["nome"];
    $anoNasc = $_POST["anoNasc"];
    $idade = $anoAtual-$anoNasc;

    echo "<br> $texto $nome,  vi que você nasceu em, $anoNasc então tem $idade anos";
    }else {
        echo"<br><b><i> Estão faltando informações!!<b><i>";
    }    

    ?>
    
</body>
</html>