
<?php 

session_start();
include('adm_verific_session.php');
/*echo $_SESSION['nome']."</br>";
echo $_SESSION['id_usuario']."</br>";
echo	$_SESSION['usuario'] ."</br>";
echo	$_SESSION['senha'] ."</br>";*/

include_once('classes/MySQL.php');
include_once('classes/Utils.php');


$ultils = new Utils();

$db = $ultils->getDatabaseConnection();
$db->connect();

$db->executeCommand("SELECT prod_cod , Imagens_img_cod , prod_titulo FROM produtos where prod_ativo = 'S' ORDER  BY prod_cod DESC ");

$prod = $db->resultset();



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
<title>Administração - Produtos</title>
</head>

<body>

<?php include("menu_adm.php");?>

<script type="text/javascript" >
 document.querySelector("#adm_produtos").classList.add("ident_pag");
</script>

<div class="adm_main_content">
 
 
 <div class="adm_menu">
  <h1>Informativo</h1>
  <p>Nessa pagina estão exibidos todos os produtos que se encontram cadastrados em nosso sistema </p>
  <p>Ao clicar na opção "Cadastrar novo" `sera aberto um formulario que possibilita-ra a inclusao de um novo produto no sistema </p>
  <p>Ao clicar em qualquer produto do lado direito da tela sera feito o refirecionamento para a pagina do produto</p>
  <h2>Açoes</h2>
  <a href="adm_produtos_cadastro.php"><div class="adm_menu_btn">Cadastrar Novo </div></a>
   
 </div><!--fechamento da class"adm_menu"-->
 <div class="adm_content">
   <h1>Produtos que ja se encontrao cadastrados no sistema </h1>
  
 <?php 

   foreach($prod as $produto){

	//  print_r($produto);
	  
      $db->executeCommand('SELECT  img_titulo, img_src FROM imagens where img_cod = '.$db->limparSqlInject($produto["Imagens_img_cod"]).' ');
	  
	  $img_url = $db->getFetchArray();
	 
	
 
	 echo '<a href="adm_produto_unit.php?dasdbfalçecnsordlepcbasjrfmasjdforysndlajeosdfasjdolidwlmdasdnsafaskldnasodldnasndfioweqwdlandoafaifnsdjflkafdsndi&cod='.$produto["prod_cod"].'&return=adm_produtos"><div class="adm_prod_model">
    <div class="adm_prod_img">
     <img src="'.$img_url[1].'"  />
    </div><!--fechamento da class"adm_prod_img"-->
    <div class="adm_prod_text">
      <div class="adm_prod_text_p1">
       <h1>'.$produto["prod_titulo"].'</h1>
      
      </div><!--fechamento da class"adm_prod_text_p1"-->
      <div class="adm_prod_text_p2">
       <div class="adm_prod_text_info">Codigo: <b>'.$produto["prod_cod"].'</b></div>
       
     
      </div><!--fehchamento da class"adm_prod_text_p2"-->
    </div><!--fechamento da classe "adm_prod_text"-->
   </div></a>';
     
	  }
 
 ?> 
   
   
   
  <!-- <a href="adm_produto_unit.php"><div class="adm_prod_model">
    <div class="adm_prod_img">
     <img src="Imagens/Produtos/16.jpg" />
    </div><!--fechamento da class"adm_prod_img"-
    <div class="adm_prod_text">
      <div class="adm_prod_text_p1">
       <h1>Titulo do produto</h1>
       <p>Breve descricao , essa deve conter no maximo 3 linhas (texto de texte apartir de agora dasdasdasd asdasdasd dasd f sdf df idfdsijfsdfsdgf jsgdf sdgf s asjd</p>
      </div><!--fechamento da class"adm_prod_text_p1"--
      <div class="adm_prod_text_p2">
       <div class="adm_prod_text_info">Codigo: <b>"codigo"</b></div>
       <div class="adm_prod_text_info">valor : <b>"valor"</b></div>
     
      </div><!--fehchamento da class"adm_prod_text_p2"--
    </div><!--fechamento da classe "adm_prod_text"--
   </div></a>-->
   
   
  <!-- <div id="abri_modal" class="adm_modal">
    <div class="adm_modal_int">
    <a href="#fechar" class="fechar" title="fechar">X</a>
     janela modal rsrs
   </div>
   </div>-->
   
 </div><!-- fechamento da class"adm_content"-->
</div><!--fechamento da class"adm_main_content"-->



</body>
</html>

<?php
$db->disconnect();
?>