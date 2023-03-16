<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrutura de Loops</title>
</head>
<body>
    <form name="frmLoop" method="POST" action="#">
        <label>Digite até quanto contar:</label>
        <input type="text" name="qtdNum" />
        <input type="submit" name="btn_enviar" id="idEnviar" value="ENVIAR"/>

        <?php 
            if(isset($_POST["qtdNum"])){
                echo"<br><B>Loop FOR</b><br>";
                for($cont=0; $cont <=$_POST["qtdNum"]; $cont++){
                    echo $cont .", ";
                }
                echo "<br><b> Loop While</b></br>";
                /*o loop while executa um bloco de comando a partir de uma 
                verificação de uma condicional enquanto ela for verdadeira*/
              
                /* Incremento pode ser realizado com os seguintes símbolos:
                -> $variavel++
                -> $variavel+=
                -> $variavel=variavel+x
                */   

                }
                echo "<b><br>Loop doWhile</b></br>";
                $cont = 0;
                do{
                    echo $cont .", ";
                    $cont++;
                }
                while($cont <= $_POST["qtdNum"]);
            }
        ?>
    </form>
</body>
</html>