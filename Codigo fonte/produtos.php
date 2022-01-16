<?php
include_once('classes/MySQL.php');
include_once('classes/Utils.php');

$ultils = new Utils;
$bd = $ultils->getDatabaseConnection();
$bd->connect();

//bsucando todos os produtos cadastrados no bd

$bd->executeCommand("SELECT * FROM produtos where prod_ativo = 'S' ");

$prod = $bd->resultset();



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Macomp - Produtos </title>
<link rel="stylesheet" href="css/Reset.css" />
<link rel="stylesheet" href="css/Style.css" />
<link rel="stylesheet" href="css/Style_resp.css" />
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<link rel="icon" href="Imagens/icones/macomp-logo-icon.png" />
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">
<script src="js/carosel.js"></script>

</head>

<body>

<header>
<!--primeiro menu-->
 
 <?php include("menu.php");?>
 <script type="text/javascript" >
 document.querySelector(".produtos").classList.add("ident_pag");
</script>
</header><!--fecamento do cabechalho do site -->

<div class="Contant_indic">
 <div class="title_pag"><h1>Produtos</h1>
   <P>A Macomp móveis artesanais tem o orgulho de proporcionar produtos com altíssima qualidade que atendem aos diferentes gostos de nossos clientes, sempre visando a satisfação e conforto dos mesmos.</P>
   <p class="title_pag_alt2">Logo abaixo se encontra listado todos os produtos que são oferecidos pela nossa empresa.</p>
 </div>
</div><!--fechamento da class"Contant_indic"-->

 <div class="contant_produc">

<?php 
    foreach($prod as $produto){

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

 


<?php 
include("rodape.php");
?>


</body>
</html>