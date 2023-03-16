<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalhando com Array</title>
</head>
<body>
    <p><h1>Array</h1></p>
    <?php
        echo"<br>";
        echo"<b><i> Array de números inteiros </br></i></b>";
        //criando um array
        //posições IDX 0 1 2 3 4 5
        $numeros = array(1,2,3,4,5,6); 
        echo "Valor na posição 0 do array é: $numeros[0]<br>";
        echo "Valor na posição 1 do array é: $numeros[1]<br>";
        echo "Valor na posição 2 do array é: $numeros[2]<br>";
        echo "Valor na posição 3 do array é: $numeros[3]<br>";
        echo "Valor na posição 4 do array é: $numeros[4]<br>";
        echo "Valor na posição 5 do array é: $numeros[5]<br>";

        echo "<br>";
        echo "<br><b><i> Array de String</b></i></br>";
        $lista = array("Açucar","Leite","Sal","Macarrão","Molho de Tomate","Carne Moída");
        echo "Valor na posição 0 do array é: $lista[0]<br>";
        echo "Valor na posição 1 do array é: $lista[1]<br>";
        echo "Valor na posição 2 do array é: $lista[2]<br>";
        echo "Valor na posição 3 do array é: $lista[3]<br>";
        echo "Valor na posição 4 do array é: $lista[4]<br>";
        echo "Valor na posição 5 do array é: $lista[5]<br>";

        echo "<br>";
        echo "<br><b><i> Array com vários tipos de dados</b></i></br>";
        $misto = array(1,"Leite","Sal",3450,"Molho de Tomate",34.78);
        echo "Valor na posição 0 do array é: $misto[0]<br>";
        echo "Valor na posição 1 do array é: $misto[1]<br>";
        echo "Valor na posição 2 do array é: $misto[2]<br>";
        echo "Valor na posição 3 do array é: $misto[3]<br>";
        echo "Valor na posição 4 do array é: $misto[4]<br>";
        echo "Valor na posição 5 do array é: $misto[5]<br>";

    ?>
</body>
</html>