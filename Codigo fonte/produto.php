<?php
include_once('classes/MySQL.php');
include_once('classes/Utils.php');

$ultils = new Utils;
$bd = $ultils->getDatabaseConnection();
$bd->connect();

$cod_produto = $_GET["cod"];

//busca as informaçoes referentes ao produto solicitado

$bd->executeCommand("SELECT * FROM produtos where prod_ativo = 'S'and prod_cod = ".$bd->limparSqlInject($cod_produto)." ");

$prod = $bd->getFetchArray();

//buscando as informaçoes referente a imagen

$bd->executeCommand('SELECT  img_titulo, img_src FROM imagens where img_cod = '.$bd->limparSqlInject($prod[0]).' ');

$img_url = $bd->getFetchArray();
$valor_desconto = ($prod[4] * $prod[6]) /100;
$valor_desconto =  $prod[4]- $valor_desconto ;


//bsucando informaçoes relacionadas as caracteristicas 
$bd->executeCommand('SELECT * FROM caracteristica where Produtos_prod_cod = '.$bd->limparSqlInject($cod_produto).' ');

$caractrisct_prod = $bd->resultset();


//obtendo 3 produtos aleatorios do bd
//
$bd->executeCommand("SELECT max(prod_cod) FROM produtos");
$qtd_prod = $bd->getFetchArray();



if($prod[6] !=0){
		
	   $desconto_bd = 'ou R$<b>'.$valor_desconto.'</b>  a vista(<b>'.$prod[6].'</b>% de desconto)';
		   
	   }else{
		  
		$desconto_bd = '' ;
		}
	   if($prod[5] != 0){
		 
		$parcelamento = 'O produto pode ser parcelado em '.$prod[5].'X no cartao de credio '.$desconto_bd .'  '  ;
		  }else{
		 $parcelamento = '' ;	 
	    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Macomp - <?php echo $prod[2] ?> </title>
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

<div class="prod_main">
 <div class="prod_img">
  <img src="<?php echo $img_url[1] ?>" />
 </div>
 
 <div class="prdo_caract">
 
  <h1><?php echo $prod[2] ?></h1>
  <p><?php echo $prod[3] ?></p>
  <h2>Características </h2> 
  <ul>
   <?php
    foreach($caractrisct_prod as $caracte){
	 
	 $cod_tipo = $caracte["Tipos_tip_cod"];
	 
	 $bd->executeCommand('SELECT tip_nome FROM tipos where tip_cod = '.$bd->limparSqlInject($cod_tipo).'');

      $nome_tipo = $bd->getFetchArray();
	 
	 echo '<li>'.$nome_tipo[0].': '.$caracte["carc_valor"].'</li>';
	
	}
   ?>
   
  
  </ul>
  <h3><?php echo $parcelamento; ?></h3>
  <h4></h4>
  
  <a href="orcamento.php?hrlamsndh49smg3o2nx78123jdsaij4ja8lnmybsielnsh2naynlaindhspdsnsiusnnksopdtsa&cod=<?php echo $cod_produto  ?>"><div class="ver_detalhe revin">Solicitar orçamento</div></a>
 </div><!--fechamento da div"prdo_caract"-->
</div><!--fechamento da classe"prod_main"-->

<div class="prod_main">
 <div class="contant_produc_tilt prod-outor"><h1>Outros produtos</h1></div>
 
 <?php
   
   for($i=0 ; $i < 3; $i++){


 if($i == 0){
  do {
    $primeiro_n =  rand(1,$qtd_prod[0]);
  }while($primeiro_n == $cod_produto);
  
   $prod_id_rando[$i] = $primeiro_n;
 }else if($i == 1){
   
   
   do {  
	$segundo_n = rand(1,$qtd_prod[0]); 
	  
	}while(($prod_id_rando[0] == $segundo_n)or($segundo_n == $cod_produto));
  
 
    $prod_id_rando[$i] = $segundo_n ;
  }else if($i == 2){
 
     do {  
	$terceiro_n = rand(1,$qtd_prod[0]); 
	  
	}while(($prod_id_rando[0] == $terceiro_n)or($prod_id_rando[1] == $terceiro_n)or($terceiro_n == $cod_produto));
  
  
    $prod_id_rando[$i] = $terceiro_n ;
  
  
  }
	 
$bd->executeCommand("SELECT prod_cod , Imagens_img_cod , prod_titulo , prod_descricao ,prod_parcelamento ,prod_desconto, prod_valor  FROM produtos where prod_ativo = 'S' and prod_cod = ".$bd->limparSqlInject($prod_id_rando[$i])." ");

$array_prod_3 = $bd->getFetchArray();



 $bd->executeCommand('SELECT  img_titulo, img_src FROM imagens where img_cod = '.$bd->limparSqlInject($array_prod_3[1]).' ');
	  
	  $img_url = $bd->getFetchArray();
	
	  
	  $valor_desconto = ($array_prod_3[5] * $array_prod_3[6]) /100;
	  $valor_desconto = $array_prod_3[6]- $valor_desconto ;
	 
	  if($array_prod_3[6] !=0){
		
	   $desconto_bd = 'ou R$<b>'.$valor_desconto.'</b>  a vista(<b>'.$array_prod_3[6].'</b>% de desconto)';
		   
	   }else{
		  
		$desconto_bd = '' ;
		}
	   if($array_prod_3[5] != 0){
		 
		$parcelamento = 'O produto pode ser parcelado em '.$array_prod_3[5].'X no cartao de credio '.$desconto_bd .'  '  ;
		  }else{
		 $parcelamento = '' ;	 
	    }
	 
     echo '
   <div class="contant_produc_unit  prod_border_unit">
    <div class="contant_produc_img"><a href="#"><img src="'.$img_url[1].'" alt="'.$img_url[0].'" title="'.$array_prod_3[2].'"/></a></div>
    <div class="contant_prduc_text">
     <h1><a href="#">'.$array_prod_3[2].'</a></h1>
     <h2>'.$array_prod_3[3].'.</h2>
     <h2>R$: '.$array_prod_3[6].'</h2>
     <h3>'.$parcelamento.' </h3>

    <a href="produto.php?hrlamsndh49smg3o2nx78123jdsaij4ja8lnmybsielnsh2naynlaindhspdsnsiusnnksopdtsa&cod='.$array_prod_3[0].'"><div class="ver_detalhe">Ver detalhes</div></a>
   </div><!--fechamento da class"contant_prduc_text"-->
  </div><!--fechamneto da class"contant_produc_unit"-->
  
   ';  
		 
		  
		  
		 
 
 }
 






	
 
 
 ?>
 
 

</div>

<?php 
include("rodape.php");
?>


</body>
</html>