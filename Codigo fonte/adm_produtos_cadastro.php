<?php

include_once("adm_pop_up.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/Reset.css" />
<link rel="stylesheet" href="css/Style.css" />
<link rel="stylesheet" href="css/Style_adm.css" />
<link rel="stylesheet" href="css/Style_resp.css" />
<link rel="stylesheet" href="css/Style_adm_resp.css" />
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<link rel="icon" href="Imagens/icones/macomp-logo-icon.png" />
<script src="js/jquery-1.9.1.js"></script>
<title>Administração - Cadastro de Produtos</title>
</head>

<body>

<?php include("menu_adm.php");?>

<script type="text/javascript" >
 document.querySelector("#adm_produtos").classList.add("ident_pag");
</script>

<div class="adm_main_content">
 
 
 <div class="adm_menu">
  <h1>Informativo</h1>
  <p>O campo <b>'Valor'</b> deve ser prenchido apenas por numeros e/ou ' . ' </p>
  <p>o campo <b>'Imagen'</b>  deve ser prechido com uma imagen que representa o seguinte produto cadastrado. so é possivel cadastrar uma imagen por produto</p>
  <h2>Açoes</h2>
  <a href="adm_produtos.php"><div class="adm_menu_btn">Voltar</div> </a>
 </div><!--fechamento da class"adm_menu"-->
 <div class="adm_content">
   <h1>Cadastro de produtos</h1>
   <div class="adm_form_content">
     <fieldset >
      <form method="post" action="adm_produtos_cadastro.php" name="enviar" enctype="multipart/form-data">
       <div class="adm_form_cap">
        <label class="required">Nome :</label>
        <div class="adm_form_input">
        <input type="text"  name="prod_nome" required  / >
        </div><!--fechamento da class"adm_form_input"-->
       </div><!--fechamento da class"adm_form_cap"-->
       
        <div class="adm_form_cap">
        <label class="required">Imagen:</label>
        <div class="adm_form_label_file">
        <label for="adm_form_file" >Selecione uma imagen</label>
        <input type="file"  id="adm_form_file"  name="prod_imagen" required/>
        
        </div><!--fechamento da class"adm_form_input"-->
       </div><!--fechamento da class"adm_form_cap"-->
       
       <div class="adm_form_btn">
        <input type="submit" name="Cadastrar_prod"  value="Cadastrar "/>
       </div>
      </form>
     </fieldset>
   </div>
 </div><!-- fechamento da class"adm_content"-->
</div><!--fechamento da class"adm_main_content"-->
<script src="js/jquery-ui-1.10.3.custom.js"></script>
<script src="js/utilities.js"></script>
<script src="js/validation.js"></script>
</body>
</html>

<?php 

include('adm_verific_session.php');
/*echo $_SESSION['nome']."</br>";
echo $_SESSION['id_usuario']."</br>";
echo	$_SESSION['usuario'] ."</br>";
echo	$_SESSION['senha'] ."</br>";*/

include_once("classes/MySQL.php");
include_once("classes/Utils.php");
include_once("classes/Produtos.php");

if(isset($_POST['Cadastrar_prod'])){

$prod = new produtos();
$errorMsg = FALSE;

$utils = new Utils();



	
$db = $utils->getDatabaseConnection();
$db->connect();


$prod->setativo('S');

if(!$prod->settitulo($_POST['prod_nome'])){

$mensagen = 'Erro ao realizar o Cadastro';
//$tipo = 'success';
$tipo = 'fall';
$erro = 'O campo Titulo deve possuir mais que 5 caracteres e deve ter menos de 100 caracteres. caso Necessite de mais espaço, entre em contato com os desenvolvedores';


PopUpMensagen($mensagen , $tipo , $erro);
die;
	
	
}








/*Procurando pelo ultimo Produto cadastrado*/
$db->executeCommand('SELECT max(prod_cod) as codigo FROM produtos');

$maxIdProd = $db->getFetchArray();

$maxIdProd[0] = $maxIdProd[0] + 1;

//buscando a url da imagen e sua extenção
$imagen = $_FILES['prod_imagen']['tmp_name'];
$pathinfo = pathinfo($_FILES['prod_imagen']['name']);
$nome_img = ($_FILES['prod_imagen']['name']);
$caminho = __DIR__.'/Imagens/Produtos/'.$maxIdProd[0];

//criando pasta para armazenar a imagen
 mkdir($caminho, 0777);

$caminho .= '/'.$maxIdProd[0].'.'.$pathinfo['extension'];

//copiando a imagen para a sua respectiva pasta 
if(!copy($imagen , $caminho)){


}

//Cadastro da imagen 
$caminho = 'Imagens/Produtos/'.$maxIdProd[0].'/'.$maxIdProd[0].'.'.$pathinfo['extension']; 
$db->executeCommand("insert into imagens(img_titulo, img_src) value('".$db->limparSqlInject($nome_img)."' ,'".$db->limparSqlInject($caminho)."')");

//buscando a ultima imagens cadastrada
$db->executeCommand("select max(img_cod) as codigo from imagens");

$UlmtimoId_Img = $db->getFetchArray();
$UlmtimoId_Img = $UlmtimoId_Img[0];
//cadastrando o produto



$db->executeCommand("insert into produtos(Imagens_img_cod, prod_titulo,prod_ativo)values('".$db->limparSqlInject($UlmtimoId_Img)."','".$db->limparSqlInject($prod->getTitulo())."','".$db->limparSqlInject($prod->getativo())."')");


$mensagen = 'Cadastro efetuado com suceeso';
//$tipo = 'success';
$tipo = 'success';
$erro = '';

PopUpMensagen($mensagen , $tipo , $erro);




$db->disconnect();
}



?>
