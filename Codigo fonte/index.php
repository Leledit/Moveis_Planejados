<?php


include_once('classes/MySQL.php');
include_once('classes/Utils.php');

$ultils = new Utils;
$bd = $ultils->getDatabaseConnection();
$bd->connect();

//bsucando todos os produtos cadastrados no bd

$bd->executeCommand("SELECT prod_cod , Imagens_img_cod , prod_titulo FROM produtos where prod_ativo = 'S' LIMIT 8");

$prod = $bd->resultset();

//buscando os ultios 4 produtos cadastrados

$bd->executeCommand("SELECT * FROM produtos where prod_ativo ='S' ORDER BY prod_cod DESC LIMIT 4 ");

$ultimos_produtos = $bd->resultset();

echo $bd->getError();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Macomp - Móveis artesanais </title>
<link rel="stylesheet" href="css/Reset.css" />
<link rel="stylesheet" href="css/Style.css" />
<link rel="stylesheet" href="css/Style_resp.css" />
<link rel="icon" href="Imagens/icones/macomp-logo-icon.png" />
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">
<script src="js/carosel.js"></script>

</head>

<body>
<header>
<!--primeiro menu-->
 
 <?php include("menu.php");?>
 <script type="text/javascript" >
 document.querySelector(".home").classList.add("ident_pag");
</script>
</header><!--fecamento do cabechalho do site -->


<div class="contant_produc">
 <div class="contant_produc_tilt"><h1>Produtos mais vendidos</h1></div>
 
 <?php
   foreach($prod as $produto){

	//  print_r($produto);
	  
      $bd->executeCommand('SELECT  img_titulo, img_src FROM imagens where img_cod = '.$bd->limparSqlInject($produto["Imagens_img_cod"]).' ');
	  
	  $img_url = $bd->getFetchArray();
	
	  
	
	 
   echo '
   <div class="contant_produc_unit">
    <h1><a href="orcamento.php?hrlamsndh49smg3o2nx78123jdsaij4ja8lnmybsielnsh2naynlaindhspdsnsiusnnksopdtsa&cod='.$produto["prod_cod"].'" >'.$produto["prod_titulo"].'</a></h1>
	<div class="contant_produc_img"><a href="orcamento.php?hrlamsndh49smg3o2nx78123jdsaij4ja8lnmybsielnsh2naynlaindhspdsnsiusnnksopdtsa&cod='.$produto["prod_cod"].'"><img src="'.$img_url[1].'" alt="'.$img_url[0].'" title="'.$produto["prod_titulo"].'"/></a></div>
    
  </div><!--fechamneto da class"contant_produc_unit"-->
  
   ';
   
   }
 
 
 ?>
 


<div class="contant_produc">
 <div class="contant_produc_tilt"><h1>Últimos lançamentos</h1></div>
 
 
  <?php
   foreach($ultimos_produtos as $produto){

	//  print_r($produto);
	  
      $bd->executeCommand('SELECT  img_titulo, img_src FROM imagens where img_cod = '.$bd->limparSqlInject($produto["Imagens_img_cod"]).' ');
	  
	  $img_url = $bd->getFetchArray();
	
	
   echo '
   <div class="contant_produc_unit">
     <h1><a href="orcamento.php?hrlamsndh49smg3o2nx78123jdsaij4ja8lnmybsielnsh2naynlaindhspdsnsiusnnksopdtsa&cod='.$produto["prod_cod"].'">'.$produto["prod_titulo"].'</a></h1>
	<div class="contant_produc_img"><a href="orcamento.php?hrlamsndh49smg3o2nx78123jdsaij4ja8lnmybsielnsh2naynlaindhspdsnsiusnnksopdtsa&cod='.$produto["prod_cod"].'"><img src="'.$img_url[1].'" alt="'.$img_url[0].'" title="'.$produto["prod_titulo"].'"/></a></div>

  </div><!--fechamneto da class"contant_produc_unit"-->
  
   ';
   
   }
 
 
 ?>
 
 


 



</div><!--fechamento da classe "contant_produc"-->

<div class="index_envio">
 <div class="index_envio-text">
  <h1>Não se preocupe, nós levamos até você! </h1>
  <p>A Macomp garante que seus produtos cheguem na sua residéncia de forma 	rápida e segura e sem nenhum custo adicional para você cliente.</p>
 </div>
 <div class="index_envio-img">
  <img src="Imagens/aaaaaaaaaaaaaaaaa.png" />
 </div>
</div>
<?php 
include("rodape.php");
?>

</body>
</html>