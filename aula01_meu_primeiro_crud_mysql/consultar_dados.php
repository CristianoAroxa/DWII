<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Dados via PhP</title>
</head>
<body>
    <h1>Consultando dados via PhP</h1>
    <?php
    require_once("conexao.php");
    $conexao=novaConexao();
    $sql="SELECT * FROM cadastros";
    $resultado=$conexao->query($sql);
    $registros = [];


    if($resultado->num_rows >0){
        while($row = $resultado->fetch_assoc()){
            $registros[]=$row;
        }
        
    } else if ($conexao->error) {
        echo ":( Erro: ". $conexao->error;
    }
    echo "<b>Valores do Array Associativo !!!! </b><br><br>";

    print_r($registros);   
    ?>

    <p><h1>Valores dentro da tabela</h1></p>
    <table border="1" width="40%">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Nascimento</th>
            <th>Email</th>
            <th>Ação</th>
        </thead>
        <tbody>
            <?php foreach($registros as $registro): ?>
            <tr>
                <td><?=$registro['id']?></td>
                <td><?=$registro['nome']?></td>
                <td>
                    <?=
                    date('d/m/y',strtotime($registro["nascimento"]));
                    ?>
                </td>
                <td><?=$registro['email']?></td>
                       
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <style>
        table >*{
            font-size: 1.0rem;

        }
    </style>

</body>
</html>