<?php 

session_start();

include('adm_verific_session.php');
/*echo $_SESSION['nome']."</br>";
echo $_SESSION['id_usuario']."</br>";
echo	$_SESSION['usuario'] ."</br>";
echo	$_SESSION['senha'] ."</br>";*/
include_once('classes/MySQL.php');
include_once('classes/Utils.php');
include_once('classes/Produtos.php');

$ultils = new Utils;
$db = $ultils->getDatabaseConnection();
$db->connect();

$Produtos = new produtos;

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
<title>Administração - Edição de Produtos</title>
</head>

<body>

<?php 

include_once("adm_pop_up.php");
include("menu_adm.php");

if(isset($_GET["cod"])){
	
	$cod_produto =  $_GET["cod"];	
	
	if(isset($_POST["Edit_perfil"])){

		//adicionando valores a classe
		$nome_temporario = $_FILES['new_img']['tmp_name'];
		
		
		//validaçoes dos campos 
		
		if(!$Produtos->settitulo($_POST['prod_nome'])){
	
		$mensagen = 'Erro ao realizar o Cadastro';
		//$tipo = 'success';
		$tipo = 'fall';
		$erro = 'O campo Titulo deve possuir mais que 5 caracteres e deve ter menos de 100 caracteres. caso Necessite de mais espaço, entre em contato com os desenvolvedores';
		
		
		PopUpMensagen($mensagen , $tipo , $erro);
		die;
			
			
		}
		
		
		if($nome_temporario != '')
		{
		
			//buscando a url da imagen e sua extenção
			$imagen = $_FILES['new_img']['tmp_name'];
			$pathinfo = pathinfo($_FILES['new_img']['name']);
			$nome_img = ($_FILES['new_img']['name']);
			$caminho = __DIR__.'/Imagens/Produtos/'.$cod_produto.'/'.$cod_produto.'.'.$pathinfo['extension'];
		
				//movendo a imagen 
			if(!move_uploaded_file($imagen, $caminho))
			{
				
				$mensagen = 'Falha ao tentar realizar a edição';
				//$tipo = 'success';
				$tipo = 'fall';
				$erro = 'Ocorreu um erro ao tentar upar a imagem para o servidor';
				PopUpMensagen($mensagen , $tipo , $erro);
				
			}
			
			$caminho = 'Imagens/Produtos/'.$cod_produto.'/'.$cod_produto.'.'.$pathinfo['extension']; 
			
				//Edição da imagen 
			$db->executeCommand("update imagens set img_titulo = '".$db->limparSqlInject($nome_img)."', img_src = '".$db->limparSqlInject($caminho)."' WHERE ");
			
	
		
		}
	
		//edição do produto
		$db->executeCommand("update produtos set prod_titulo = '".$db->limparSqlInject($Produtos->getTitulo())."' WHERE prod_cod = ".$cod_produto);
		
		
		$mensagen = 'Edição efetuado com suceeso';
		//$tipo = 'success';
		$tipo = 'success';
		$erro = '';
		
		PopUpMensagen($mensagen , $tipo , $erro);
		
		echo $db->getError();
		
		
		
	}
	
	$db->executeCommand("SELECT * FROM produtos where prod_cod = '".$db->limparSqlInject($cod_produto)."'");
	$arra_produto = $db->getFetchArray();
	
	
	$db->executeCommand("SELECT * FROM imagens where img_cod = '".$db->limparSqlInject($arra_produto[1])."'");
	$arra_img = $db->getFetchArray();
}

?>

<script type="text/javascript" >
 document.querySelector("#adm_produtos").classList.add("ident_pag");
</script>

<div class="adm_main_content">
 
 
 <div class="adm_menu">
  <h1>Informativo</h1>
  <p>Os campos deve estar todos prenchido para que a edição possa ocorrer(com uma exceção para o capo de "Nova Imagen" que pode estar vazio)</p>
  
  
  <h2>Açoes</h2>
  <a href="adm_produto_unit.php?eonrtoghd6j2lan84lmdfgpqwy73opmndbnk02nsy3lnf83pmd83j&cod=<?php echo $arra_produto[0]; ?>"><div class="adm_menu_btn">Voltar</div> </a>
 </div><!--fechamento da class"adm_menu"-->
 <div class="adm_content">
   <h1>Edição de produtos</h1>
   <div class="adm_form_content">
     <fieldset >
      <form method="post" action="adm_produtos_editar.php?eonrtoghd6j2lan84lmdfgpqwy73opmndbnk02nsy3lnf83pmd83j&cod=<?php echo $arra_produto[0]; ?>" enctype="multipart/form-data">
       <div class="adm_form_cap">
        <label>Nome :</label>
        <div class="adm_form_input">
        <input type="text"  name="prod_nome" value="<?php echo $arra_produto[2] ?>" / >
        </div><!--fechamento da class"adm_form_input"-->
       </div><!--fechamento da class"adm_form_cap"-->
       
       
       
        <div class="adm_form_cap">
        <label>Imagen Atual</label>
        <div class="adm_form_img">
        <img src="<?php echo $arra_img[2] ?>?<?php echo rand(1, 100); ?>" />
        </div><!--fechamento da class"adm_form_input"-->
        </div>
       
        <div class="adm_form_cap">
        <label>Nova Imagen:</label>
        <div class="adm_form_label_file">
        <label for="adm_form_file">Selecione uma imagem</label>
        <input type="file"  id="adm_form_file"  name="new_img"/>
        
        </div><!--fechamento da class"adm_form_input"-->
       </div><!--fechamento da class"adm_form_cap"-->
       
       <div class="adm_form_btn">
        <input type="submit" name="Edit_perfil"  value="Alterar"/>
       </div>
      </form>
     </fieldset>
   </div>
 </div><!-- fechamento da class"adm_content"-->
</div><!--fechamento da class"adm_main_content"-->
</body>
</html>