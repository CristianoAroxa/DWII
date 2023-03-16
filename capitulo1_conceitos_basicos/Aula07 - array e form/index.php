<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/styles.css"/>

    <title>Inserindo dados no ARRAY usando Formulário</title>
</head>
<body>
    <container class="container">
    <p>
        <h1>Inserindo dados no Array usando Fomulário</h1>
    </p>
    <br>
    <form method="Post">
        <label>Coloque as informações separadas por vírgula(,):</label>
        <input type="text" name="info" placeholder="Separe os itens com vírgula,">
        <input type="submit" id="idEnviar" name="btn_Enviar" value="Enviar">

        <?php
        if (isset($_POST['info'])){
            $infos = $_POST['info'];
            $lista = explode(",", $infos);
            $total_infos = count($lista);
            $cont=0;
            echo"<br><br><b><i> Usando while para ler o ARRAY</i></b><br>";
            while ($cont < $total_infos){
                echo"<br> A informação na posição $cont no ARRAY é o item: " .$lista
                [$cont];
                $cont++;
            }

            echo"<br><br><b><i> Usando FOR para ler o ARRAY</i></b><br>";
            for($cont=0;$cont <$total_infos;$cont++){
                echo"<br>A informação na posição $cont no ARRAY é o item: ".$lista
                [$cont];
                
            }
        }
        ?>
    </form>
    </container>
    
</body>
</html>