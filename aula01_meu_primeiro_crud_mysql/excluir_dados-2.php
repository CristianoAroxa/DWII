<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir dados 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <h1>Excluindo dados via tabela</h1>
    <?php
        require_once("conexao.php");
        $conexao = novaConexao();

        if(isset($_GET['excluir'])){
            $escluirSQL = "DELETE FROM cadastros WHERE id=?";
            $excluir =$conexao->prepare($excluirSQL);
            $excluir->bind_param("i",$_GET['excluir']);
            $excluir->execute();
        }
        $sql = "SELECT * FROM cadastros";
        $resultado = $conexao->query($sql);
        
        if($resultado ->num_rows >0){
            while($row=$resultado->fetch_assoc()){
                $registros []= $row;
            }
        }elseif($conexao->$error){
            echo ";( Erro: ".$conexao->error;
        }
        $conexao->close();
    ?>

    <table class="table table-hover table-striped table-bordered">
    <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Nascimento</th>
            <th>Email</th>
            <th>Site</th>
            <th>Filhos</th>
            <th>Salario</th>
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
                <td><?php echo $registro['email']?></td>
                <td>
                    <a href="excluir_dados02.php?exclui=<?= $registro['id']?>" class="btn btn-danger">Excluir</a>
                </td>
                
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    
</body>
</html>