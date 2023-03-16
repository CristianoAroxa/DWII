<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrutura de Decisão Switch</title>
</head>
<body>
    <p><h1>Estrutura de decisão switch</h1></p>
    <from name="fmrParImpar"  method="post">
        <label>Digite um Número:</label>
        <input type="text" name="número" placeholder="Digite um número">
        <input type="submit" name="btn_verificar" id="idVerificar" value="verificar">
   
    <?php
    $num;
    $resto;
    if(isset($_POST["numero"])){
        $num=$_POST["numero"];
        $resto = $num % 2;
        //comparação switch
        switch ($resto) {
            case 0:
                echo "<br> O número digitado $num é <b><i> par </b></i>";
                break;

                case 1:
                    echo "<br> O número digitado $num é <b><i> Ímpar </b></i>";
                    break;
        }
    }
    
    ?>
    </from>

    
</body>
</html>