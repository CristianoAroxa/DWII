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
    
  

<form method="POST">
	<div class="form group row">
		<div class="form-group col-md-8">
			<label for="nome">Nome: </label>
			<input type="text" class="form-control" <?php echo isset($erros['nome'])?'is-invalid':''?>"
			id="id_nome" name="nome" placeholder="Digite o nome..." value="<?php echo isset($_POST['nome'])? $_POST['nome']:''?>">
			<div class="invalid-feedback">
				<?php echo $erros['nome']; ?>
			</div>
		</div>
	</div>
	
	<div class="form-group col-md-4>
		<label for="nascimento">Nascimento:</label>
		<input type="text" class="form-control" <?php echo isset($erros['nascimento'])?'is-invalid':''?>"
		id="nascimento" name="nascimento" placeholder="Nascimento" value="<?php echo isset($_POST['nascimento'])? $_POST['nascimento']:''?>">
		<div class="invalid-feedback">
			<?php echo $erros['nacimento'];?>
		</div>
	</div>
	
	<div class="form group row">
		<div class="form-group col-md-8">
			<label for="email">E-mail: </label>
			<input type="text" class="form-control" <?php echo isset($erros['email'])?'is-invalid':''?>"
			id="id_email" name="email" placeholder="Digite o email..." value="<?php echo isset($_POST['email'])? $_POST['email']:''?>">
			<div class="invalid-feedback">
				<?php echo $erros['email']; ?>
			</div>
		</div>
	</div>
	
	<div class="form-group col-md-4>
		<label for="site">Site:</label>
		<input type="text" class="form-control" <?php echo isset($erros['site'])?'is-invalid':''?>"
		id="site" name="site" placeholder="site" value="<?php echo isset($_POST['site'])? $_POST['site']:''?>">
		<div class="invalid-feedback">
			<?php echo $erros['site'];?>
		</div>
	</div>
	
	<div class="form group row">
		<div class="form-group col-md-8">
			<label for="filhos">Filhos: </label>
			<input type="text" class="form-control" <?php echo isset($erros['filhos'])?'is-invalid':''?>"
			id="id_filhos" name="filhos" placeholder="Digite o numero de filhos..." value="<?php echo isset($_POST['filhos'])? $_POST['filhos']:''?>">
			<div class="invalid-feedback">
				<?php echo $erros['filhos']; ?>
			</div>
		</div>
	</div>
	
	<div class="form-group col-md-4>
		<label for="salario">Salário:</label>
		<input type="text" class="form-control" <?php echo isset($erros['salario'])?'is-invalid':''?>"
		id="salario" name="salario" placeholder="Digite o salário" value="<?php echo isset($_POST['salario'])? $_POST['salario']:''?>">
		<div class="invalid-feedback">
			<?php echo $erros['salario'];?>
		</div>
	</div>
	
	<div class="mb-3">
		<button class="btn btn-primary btn-leg">Enviar</button>
	</div>
	
</form>	
</body>
</html>
