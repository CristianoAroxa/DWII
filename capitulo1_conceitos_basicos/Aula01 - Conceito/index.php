<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conceitos Básicos</title>
</head>
<body>
    Conceitos Básicos - texto em HTML
    <br>
    <?php

   echo "<br><b>Olá Mundo!!!</b> - texto em PHP";


   // -> Comentário de uma linha
   /* -> Comentário em Bloco*/

   //Declaração de variável:
    $texto = "Fatec Registro - F-299";
    echo"<br>";

    //Concatenação

    echo"O texto abaixo será concatenado";
    echo"<br>";
    $x = 5;
    $y = 3;

    echo $texto;
    echo"<br>";
    echo"<i> O valor de x é: " .$x. " e o valor de y é: $y</i>";
    echo"<br>";
    echo"<b> O valor de x é: $x e o valor de y é: $y</b>, a soma entre x e y é:" .($x+$y);




    ?>
    
</body>
</html>