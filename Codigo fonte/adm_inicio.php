
<?php 
include_once("adm_pop_up.php");
session_start();
include('adm_verific_session.php');
/*echo $_SESSION['nome']."</br>";
echo $_SESSION['id_usuario']."</br>";
echo	$_SESSION['usuario'] ."</br>";
echo	$_SESSION['senha'] ."</br>";*/

include_once("classes/MySQL.php");
include_once("classes/Utils.php");
include_once("classes/orcamento.php");


$orcamento = new Orcamento;
$errorMsg = FALSE;

$utils = new Utils();



	
$db = $utils->getDatabaseConnection();
$db->connect();

$db->executeCommand("SELECT * FROM orcamento where orc_status = 'aberto' ");
$array_orcamento = $db->resultset();
$orcamento_ativo = $db->getAffectdRows();

if(isset($_POST["enviar"])){
 
$mensagen = 'Orçamento finalizado com sucesso';
//$tipo = 'success';
$tipo = 'success';
$erro = '';


PopUpMensagen($mensagen , $tipo , $erro);

  
  
}
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
<title>Administração - Pagina Inicial</title>
</head>

<body>

<?php include("menu_adm.php");?>

<script type="text/javascript" >
 document.querySelector("#adm_inicio").classList.add("ident_pag");
</script>

<div class="adm_main_content">
 
 
 <div class="adm_menu">
  <h1>Informativo</h1>
  <P>Bem vindo <b><?php echo $_SESSION['macomp_nome'];?></b>, Essa é a pagina adminsitrativa do site da macomp, aonde é possivel fazer alteraçoe referentes aos produtos que estao a venda pela empresa</P>
  
  
 </div><!--fechamento da class"adm_menu"-->
 <div class="adm_content">
  <h1>Lista de Orçamentos </h1>
  <?php
   if($orcamento_ativo <= 0){
	 echo '<h4>Ops Parece que nao ha nenhum orçamento  </h4>';  
   }else {
	   
	   
   foreach($array_orcamento as $orcamento){
	 //orc_cod, , , , , , , orc_status
	
	$db->executeCommand("SELECT prod_titulo FROM produtos where prod_cod = '".$db->limparSqlInject($orcamento["Produtos_prod_cod"])."'");
    $nome_produto = $db->getFetchArray(); 
	 
   echo '
   <div class="adm_orc_main">
    <h1 class="adm_orc_primer">Informaçoes do cliente</h1>
    <div class="adm_orc_info">
     <div class="adm_orc_infos">Nome: '.$orcamento["orc_nome_clien"].'</div>
     <div class="adm_orc_infos">Celular: '.$orcamento["orc_celular_clien"].'</div>
     <div class="adm_exc_infos adm_orc_infos  ">Email: '.$orcamento["orc_email_clien"].'</div>
    </div><!--fechmanento da class"adm_orc_info"-->
    <h1>Informaçoes do produto</h1>
    <div class="adm_orc_info">
     <div class="adm_orc_infos">Produto:'.$nome_produto[0].'('.$orcamento["Produtos_prod_cod"].')</div>
     <div class="adm_orc_infos">QTD:'.$orcamento["orc_qtd_prod"].'</div>
     <div class=" adm_orc_infos ">Valor:'.$orcamento["orc_valor_total"].'</div>
    </div><!--fechmanento da class"adm_orc_info"-->
    <div class="adm_orc_btns">
     <a href="ultilies.php?acao=desativar&orc_cod='.$orcamento["orc_cod"].'"><div class="adm_orc_btn">Encerrar</div></a>
     <a href="adm_produto_unit.php?dasdbfalçecnsordlepcbasjrfmasjdforysndlajeosdfasjdolidwlmdasdnsafaskldnasodldnasndfioweqwdlandoafaifnsdjflkafdsndi&cod='.$orcamento["Produtos_prod_cod"].'&return=adm_inicio"><div class="adm_orc_btn">Ver Produto</div></a>
    </div>
 </div><!--fechamento da class"adm_orc_main"-->
 
 ';
 
   } 
   }
 
 ?>
  
 
  
 </div><!-- fechamento da class"adm_content"-->
</div><!--fechamento da class"adm_main_content"-->
</body>
</html>