<?php
include_once('classes/MySQL.php');
include_once('classes/Utils.php');
include_once('classes/orcamento.php');
include_once('adm_pop_up.php');

$ultils = new Utils;
$bd = $ultils->getDatabaseConnection();
$bd->connect();
$orcamento = new Orcamento;

$cod_produto = $_GET["cod"];
 $_SESSION["prod_cod"] = $cod_produto;
//busca as informaçoes referentes ao produto solicitado

$bd->executeCommand("SELECT * FROM produtos where prod_ativo = 'S' and prod_cod = ".$bd->limparSqlInject($cod_produto));

$prod = $bd->getFetchArray();

 

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Macomp - orçamento </title>
<link rel="stylesheet" href="css/Reset.css" />
<link rel="stylesheet" href="css/Style.css" />
<link rel="stylesheet" href="css/Style_resp.css" />
<link rel="stylesheet" href="css/Style_adm.css" />
<link rel="stylesheet" href="css/Style_adm_resp.css" />
<link rel="icon" href="Imagens/icones/macomp-logo-icon.png" />
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">

<script src="js/carosel.js"></script>
<script src="js/jquery-1.9.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.min.js"></script>

</head>

<body>

<header>
<!--primeiro menu-->
 
 <?php include("menu.php");?>
 <script type="text/javascript" >
 document.querySelector(".produtos").classList.add("ident_pag");
</script>
</header><!--fecamento do cabechalho do site -->


<div class="orcamento_form">
 <h1>Solicitação de orçamento</h1>
 <fieldset>
  <form action="orcamento.php?hrlamsndh49smg3o2nx78123jdsaij4ja8lnmybsielnsh2naynlaindhspdsnsiusnnksopdtsa&cod=<?php  echo $_SESSION["prod_cod"];?>" method="post" name="enviar" id="formcontato">
   <h2>Informações do produto</h2> 
   <ul>
    <li>Produto: <?php echo $prod[2]  ?></li>
    <li>Quantidade:  <input type="number" autofocus="autofocus" name="orcament_qtd" required min="1" max="100" value="1" id="input_qtd" /></li  
   ></ul>
   <h2>Informações para contato</h2>
   <ul>
    <li>Nome Completo :<c>*</c>    <input type="text" name="orcament_nome" required/></li>
    <li>Celular:<c>*</c>  <input id="cont_celular" type="text" name="orcament_celular" placeholder="(00) 0 0000-0000" required/></li>
    <li>E-mail:  <input type="email" name="orcament_email"  /></li>
   </ul>
   <h3><b>Importante</b> os dados enviadas serão usadas para que possamos entrar em contato com você. Nenhuma informação pessoal será divulgada.</h3>
   <input type="submit" name="enviar_orcamento" value="Enviar"/>
  </form>
 </fieldset>

</div>

<?php 
include("rodape.php");
?>

<script type="text/javascript">

 $("#cont_celular").mask("(99) 9 9999 9999");

</script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>
<script src="js/utilities.js"></script>
<script src="js/validation.js"></script>

</body>
</html>

<?php

if(isset($_POST["enviar_orcamento"])){
	 
	$valor = $prod[4] * $_POST["orcament_qtd"];
	 
//inserindo valores na classe


$orcamento->SetCodProd($cod_produto);
$orcamento->SetStatus('Aberto');	

if(!$orcamento->SetNomeCliente($_POST["orcament_nome"])){

$mensagen = 'Erro ao realizar o Cadastro';
//$tipo = 'success';
$tipo = 'fall';
$erro = 'O campo Nome deve possuir mais que 5 caracteres e deve ter menos de 100 caracteres.';

PopUpMensagen($mensagen , $tipo , $erro);
die;	
}
if(!$orcamento->SetCelular($_POST["orcament_celular"])){

$mensagen = 'Erro ao realizar o Cadastro';
//$tipo = 'success';
$tipo = 'fall';
$erro = 'O campo Celuar deve ser formado apenas por numeros.';

PopUpMensagen($mensagen , $tipo , $erro);
die;	
}



if(!$orcamento->SetEmail($_POST["orcament_email"])){

$mensagen = 'Erro ao realizar o Cadastro';
//$tipo = 'success';
$tipo = 'fall';
$erro = 'O campo Email deve possuir mais que 5 caracteres e deve ter menos de 100 caracteres.';

PopUpMensagen($mensagen , $tipo , $erro);
die;	
}


//orc_cod, Produtos_prod_cod, orc_nome_clien, orc_celular_clien, orc_email_clien, orc_qtd_prod, orc_valor_total, orc_status
$bd->executeCommand("insert into orcamento(Produtos_prod_cod, orc_nome_clien, orc_celular_clien, orc_email_clien,orc_status)values('".$bd->limparSqlInject($orcamento->getCod())."','".$bd->limparSqlInject($orcamento->getNomeCliente())."','".$bd->limparSqlInject($orcamento->getCelular())."','".$bd->limparSqlInject($orcamento->getEmail())."','".$bd->limparSqlInject($orcamento->getStatus())."')");

$mensagen = 'Orçamento enviado com sucesso';
$tipo = 'success';
$erro = '';

PopUpMensagen($mensagen , $tipo , $erro);



}

?>