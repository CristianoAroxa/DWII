<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VAlidação de Formulário</title>
</head>
<body>
    <h2>Formulário de Cadastro</h2>
<?php 
$erros =[];  


if(count($_POST)>0){
    if(!filter_input(INPUT_POST,"nome")){
        $erros['nome']="Nome Obrigatório!"
    }    
    if(!filter_input($_POST['nascimento'])){
        $data=DataTime::createFromFormat('d/m/y',$_POST['nascimento']);
        if(!$data){
            $erros['nascimento'] = "A data de nascimento deve estar no formato dd/mm/aaaa";
        }
    }

    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $erros['email']="Email inválido!";
    }
    if(!filter_var($_POST['site'],FILTER_VALIDATE_URL)){
        $erros['site']="Site Inválido!";
    }

    $filhosConfig = ['options'=>['min_range'=>0,'max_range'=>'20']];
    if(!filter_var($_POST['filhos'], FILTER_VALIDATE_INT,$filhosConfig)&& $_POST['filhos']!=0){
        $erros['filhos']="Quantidade inválida, informe de 0-20!";
    }
    $salarioConfig=['options'=>['decimal'=>',']];
    if(!filter_var($_POST['salario'],FILTER_VALIDATE_FLOAT,$salarioConfig)){
        $erros['salario']="valor de salário inválido! Utilize vírgula(,) para separar a casa decimal";
    }
}
   
?>    
</body>
</html>