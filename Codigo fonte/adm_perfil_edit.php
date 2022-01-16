<?php 

session_start();
include('adm_verific_session.php');
/*echo $_SESSION['nome']."</br>";
echo $_SESSION['id_usuario']."</br>";
echo	$_SESSION['usuario'] ."</br>";
echo	$_SESSION['senha'] ."</br>";*/


include_once("classes/MySQL.php");
include_once("classes/Utils.php");
include_once("classes/Usuario.php");

$NewUser = new Usuario;
$utils = new Utils();
$db = $utils->getDatabaseConnection();
$db->connect();

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
<title>Administração - Edição de Usuario</title>
</head>

<body>

<?php 

include("menu_adm.php");

include_once("adm_pop_up.php");

?>

<script type="text/javascript" >
 document.querySelector("#adm_perfil").classList.add("ident_pag");
</script>

<?php

if(isset($_POST['Edit_perfi']))
{


	$textnome = $_POST['nome'];
	$textusuario = $_POST['usuario'];
	$textsenha = $_POST['nova_senha'];
	$textsenhaconfirma = $_POST['confirmar_senha'];
	$verificacao = TRUE;
		
	if(!$NewUser->setUsuario($textusuario)){
	
		$mensagen = 'Erro ao realizar a edição';
		//$tipo = 'success';
		$tipo = 'fall';
		$erro = 'O campo \'Usuário\' deve ter entre 5 e 100 caracteres.';
		
		
		PopUpMensagen($mensagen , $tipo , $erro);
		$verificacao = FALSE;
	
	}
	
	if(!$NewUser->setNome($textnome)){
	
		$mensagen = 'Erro ao realizar a edição';
		//$tipo = 'success';
		$tipo = 'fall';
		$erro = 'O campo \'Nome\' deve ter entre 5 e 100 caracteres.';
		
		
		PopUpMensagen($mensagen , $tipo , $erro);
		$verificacao = FALSE;;
	
	}
	
	$sql = "UPDATE usuarios SET  usu_nome = '".$db->limparSqlInject($NewUser->getNome())."', usu_usuario = '".$db->limparSqlInject($NewUser->getUsuario())."'";
	
	if( (mb_strlen($textsenha) != 0) or (mb_strlen($textsenhaconfirma) != 0) )
	{
		
		if($textsenha != $textsenhaconfirma){
	
		$mensagen = 'Erro ao realizar a edição';
		//$tipo = 'success';
		$tipo = 'fall';
		$erro = 'As senhas digitadas não correspondem!';
		
		
		PopUpMensagen($mensagen , $tipo , $erro);
		$verificacao = FALSE;;
	
		}	
			
		if(!$NewUser->setSenha($textsenha)){
	
		$mensagen = 'Erro ao realizar a edição';
		//$tipo = 'success';
		$tipo = 'fall';
		$erro = 'O campo \'Senha\' deve terentre 5 e 60 caracteres.';
		
		
		PopUpMensagen($mensagen , $tipo , $erro);
		$verificacao = FALSE;;
	
		}
		
		$sql .= ", usu_senha = '".$db->limparSqlInject($NewUser->getSenha())."'";

	}
	
	if($verificacao){
		
		$sql .= " WHERE usu_cod = ".$db->limparSqlInject($_SESSION['macomp_codigo_usuario_adm_macomp']);
	
		if($db->executeCommand($sql))
		{
			
			$mensagen = 'Edição bem sucedida!';
			//$tipo = 'success';
			$tipo = 'success';
			$erro = '';
			
			
			PopUpMensagen($mensagen , $tipo , $erro);
			
		}
		else
		{
			
			$mensagen = 'Erro ao realizar a edição';
			//$tipo = 'success';
			$tipo = 'fall';
			$erro = $db->getError();
			
			
			PopUpMensagen($mensagen , $tipo , $erro);
			die;
			
		}
		
	
		$_SESSION['macomp_nome'] = $NewUser->getNome();
		$_SESSION['macomp_usuario'] = $NewUser->getUsuario();

	}
		
}

?>

<div class="adm_main_content">
 
 
 <div class="adm_menu">
  <h1>Informativo</h1>
  <p>Os campos "nova senha" e "confirmar senha" devem coincidir-se</p>
  <p>Nenhum campo podera ficar em branco, caso isso aconteca a edição sera cancelada</p>
  <h2>Açoes</h2>
  <a href="adm_perfil.php"><div class="adm_menu_btn">Voltar</div> </a>
 </div><!--fechamento da class"adm_menu"-->
 <div class="adm_content">
   <h1>Edição de usuario</h1>
   
   
   <div class="adm_form_content">
     <fieldset >
      <form method="post" action="#">
       <div class="adm_form_cap">
        <label>Nome :</label>
        <div class="adm_form_input">
        <input name="nome" type="text" minlength="5"  maxlength="100" value="<?php echo $_SESSION['macomp_nome']; ?>"/>
        </div><!--fechamento da class"adm_form_input"-->
       </div><!--fechamento da class"adm_form_cap"-->
       
        <div class="adm_form_cap">
        <label>Usuário :</label>
        <div class="adm_form_input">
        <input name="usuario" type="text" minlength="5"  maxlength="100" value="<?php echo $_SESSION['macomp_usuario']; ?>" />
        </div><!--fechamento da class"adm_form_input"-->
       </div><!--fechamento da class"adm_form_cap"-->
       
        <div class="adm_form_cap">
        <label>Nova Senha :</label>
        <div class="adm_form_input">
        <input name="nova_senha" type="password" value="" minlength="5"  maxlength="60"/>
        </div><!--fechamento da class"adm_form_input"-->
       </div><!--fechamento da class"adm_form_cap"-->
       
        <div class="adm_form_cap">
        <label>Confirmar senha:</label>
        <div class="adm_form_input">
        <input name="confirmar_senha" type="password" value="" minlength="5"  maxlength="60"/>
        </div><!--fechamento da class"adm_form_input"-->
       </div><!--fechamento da class"adm_form_cap"-->
       
       <div class="adm_form_btn">
        <input type="submit" name="Edit_perfi"  value="Alterar"/>
       </div>
      </form>
     </fieldset>
   </div>
 </div><!-- fechamento da class"adm_content"-->
</div><!--fechamento da class"adm_main_content"-->
</body>
</html>