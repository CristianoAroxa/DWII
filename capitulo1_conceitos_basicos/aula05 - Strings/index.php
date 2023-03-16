<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalhando com Strings</title>
</head>
<body>
    <p><h1>Trabalhando com Strings</h1></p>
    <?php 
    $nome="Cristiano";
    $sobrenome="Aroxa";

    echo "O nome digitado foi: <i> $nome</i><br>";
    echo "O sobrenonome digitado foi: <i> $sobrenome</i><br>";
    echo "O nome completo é:  $nome $sobrenome";

    echo "<br><i><b>Contando Caracteres das Palavras</b></i></br>";
    echo "O total de caracteres do nome é: " .strlen($nome). "<br>";
    echo "O total de caracteres do sobrenome é: " .strlen($sobrenome). "<br>";

    $nomeCompleto = $nome.$sobrenome;
    echo "O total de caracteres do nome completo é: " .strlen($nomeCompleto). "<br>";
    echo "<br>";
    echo "<b><i>Removendo espaços em branco no inicio e fim das palavras</br></b></i><br>";

    echo "O total de caracteres do nome retirando todos os espaços é: " .strlen(trim($nome))."<br>"; 
    echo "O total de caracteres do sobrenome retirando todos os espaços é: " .strlen(trim($sobrenome))."<br>"; 
    echo "O total de caracteres do nome completo retirando todos os espaços é: " .strlen(trim($nomeCompleto)); 



    ?>
</body>
</html>