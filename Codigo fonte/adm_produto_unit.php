
<?php 

session_start();
include_once("adm_pop_up.php");
include('adm_verific_session.php');
/*echo $_SESSION['nome']."</br>";
echo $_SESSION['id_usuario']."</br>";
echo	$_SESSION['usuario'] ."</br>";
echo	$_SESSION['senha'] ."</br>";*/


include_once('classes/MySQL.php');
include_once('classes/Utils.php');

$ultils = new Utils;
$bd = $ultils->getDatabaseConnection();
$bd->connect();


if(isset($_GET['cod'])){
	
	$prod_cod = $_GET['cod'];
	$_SESSION["prod_cod"] = $prod_cod;
	
	if( (is_numeric($prod_cod)) and ($bd->executeCommand('SELECT * FROM produtos where prod_cod = '.$bd->limparSqlInject($prod_cod).'') and ($bd->getAffectdRows() != 0)))
	{
			
		$array_prod = $bd->getFetchArray();
		$cod_img = $array_prod[1];
		
	}
	else
		die(header('location:adm_produtos.php'));

	if($bd->executeCommand('SELECT * FROM imagens where img_cod = '.$bd->limparSqlInject($cod_img).''))
		$array_img = $bd->getFetchArray();
	else
		$array_img = array('', '', '');

//cadastrando o tipo da caracteristica 

if(isset($_POST['Enviar_tipo'])){

	//Atualizando os tipos de caracteristicas cadastradas no bd
	$bd->executeCommand("SELECT * FROM tipos WHERE tip_nome = '".$bd->limparSqlInject($_POST["tipo_name"])."'");
	$verificacao = $bd->getAffectdRows();

	if($verificacao == 0)
	{

		if($bd->executeCommand("insert into tipos(tip_nome)values('".$bd->limparSqlInject($_POST["tipo_name"])."')"))
		{	
		
			$mensagen = 'Cadastro efetuado com sucesso';
			$tipo = 'success';
			$erro = '';
		
		}
		else
		{
			
			$mensagen = 'Erro ao tentar realizar o cadastro';
			$tipo = 'fall';
			$erro = $bd->getError();
			
		}
	
	}
	else
	{
		
		$mensagen = 'Erro ao tentar realizar o cadastro';
		$tipo = 'fall';
		$erro = 'Valor já cadastrado no banco de dados.';
		
	}
	
	PopUpMensagen($mensagen , $tipo , $erro);

}//fechamento do if 'Enviar_tipo'


//Cadastrando uma nova caracteristica 

if(isset($_POST['Enviar_caracter'])){
	
	//Atualizando os tipos de caracteristicas cadastradas no bd
	if($bd->executeCommand("SELECT * FROM tipos WHERE not (tip_cod in (SELECT Tipos_tip_cod FROM caracteristica  WHERE Produtos_prod_cod = '".$bd->limparSqlInject($prod_cod)."'))"))
	{
		
		$array_prod_tipo_qtd = $bd->getAffectdRows();

		if($array_prod_tipo_qtd != 0)
		{
		
			$cod_tipo = $_POST["op_tipo"];
			$caractere_valor = $_POST["valor_caracter"];
			
			
			if($bd->executeCommand("insert into caracteristica(Tipos_tip_cod, Produtos_prod_cod, carc_valor ,carc_ativo) values('".$bd->limparSqlInject($cod_tipo)."','".$bd->limparSqlInject($prod_cod)."','".$bd->limparSqlInject($caractere_valor)."', 'S')"))
			{	
		
				$mensagen = 'Cadastro efetuado com sucesso.';
				$tipo = 'success';
				$erro = '';
			
			}
			else
			{
				
				$mensagen = 'Erro ao realizar o cadastro.';
				$tipo = 'fall';
				$erro = $bd->getError();
				
			}
			
		}
	
	}
	else
	{
		
		$mensagen = 'Erro ao realizar o cadastro.';
		$tipo = 'fall';
		$erro = $bd->getError();
		
	}
	
	PopUpMensagen($mensagen , $tipo , $erro);

}

//desantivado uma caractreistica do produto 

if(isset($_GET['desativar'])){

	$produto_cod_desativ = $_GET['desativar'];
	
	if($bd->executeCommand("update caracteristica set carc_ativo = 'N' where carc_cod = ".$bd->limparSqlInject($produto_cod_desativ).""))
	{	
		
		$mensagen = 'Característica desativada com sucesso.';
		$tipo = 'success';
		$erro = '';
	
	}
	else
	{
		
		$mensagen = 'Erro ao realizar a desativação.';
		$tipo = 'fall';
		$erro = $bd->getError();
		
	}
	
	PopUpMensagen($mensagen , $tipo , $erro);

}//fechamento do 'desativar';
	
	//ativando uma caracteristica do produto
if(isset($_GET['ativar'])){
	
	$produto_cod_desativ = $_GET['ativar'];
	
	if($bd->executeCommand("update caracteristica set carc_ativo = 'S' where carc_cod = ".$bd->limparSqlInject($produto_cod_desativ).""))
	{	
		
		$mensagen = 'Característica ativada com suceeso.';
		$tipo = 'success';
		$erro = '';
	
	}
	else
	{
		
		$mensagen = 'Erro ao realizar a ativação.';
		$tipo = 'fall';
		$erro = $bd->getError();
		
	}	
	
}//fechamento do if 
  
}

//Consultando  se o produto possui algumas caracteristica vinculada a ele 

$bd->executeCommand("SELECT * FROM caracteristica  where Produtos_prod_cod = '".$bd->limparSqlInject($_SESSION["prod_cod"])."' order by carc_ativo = 'N' ");
$array_prod_caracte = $bd->resultset();
$existin_caracter = $bd->getAffectdRows();

//Consultando os tipos de caracteristicas cadastradas no bd

$bd->executeCommand("SELECT * FROM tipos WHERE not (tip_cod in (SELECT Tipos_tip_cod FROM caracteristica  WHERE Produtos_prod_cod = '".$bd->limparSqlInject($_SESSION["prod_cod"])."'))");
$array_prod_tipo_qtd = $bd->getAffectdRows();
$array_prod_tipo = $bd->resultset();

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



<div class="adm_main_content">
 
 
 <div class="adm_menu">
  <h1>Informativo</h1>
  <p>Nessa pagina é possivel visualizar  todas as informaçoes relacionadas ao produto que foi selecionado. alem de porder alteras as informaçoes do mesmo</p>
  <p>é possivel cadastrar novas carateristicas ao produto ou excluir alguma caracteristica especifica</p>
  <p>Em caracteristica é posivel fazer com que uma caracteristica do produto seja excluida clicando no "X" ao lado da mesma </p>
  
  
  <h2>Açoes</h2>
  <a href="adm_produtos.php"><div class="adm_menu_btn">Voltar </div></a>
  <a href="adm_produtos_editar.php?eonrtoghd6j2lan84lmdfgpqwy73opmndbnk02nsy3lnf83pmd83j&cod=<?php echo $_SESSION["prod_cod"] ?>"><div class="adm_menu_btn">Editar</div></a>
   
 </div><!--fechamento da class"adm_menu"-->
 <div class="adm_content">
   <h1><?php echo $array_prod[2]; ?></h1>
   
   <div class="adm_prod_unit">
     <div class="adm_prod_unit_img">
      <img  src="<?php echo $array_img[2]?>"/>
     </div><!--fechamento da classe "adm_prod_unit_img"-->
  
     
   </div><!--fechamento da class"adm_prod_unit"-->
   
  
    
    
   
    
   

  
   
   
 </div><!-- fechamento da class"adm_content"-->
</div><!--fechamento da class"adm_main_content"-->


    
</body>
</html>

<?php
$bd->disconnect();
?>