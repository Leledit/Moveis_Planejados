<?php
session_start();
unset($_SESSION['Msg']);



include_once("classes/MySQL.php");
include_once("classes/Utils.php");
include_once("classes/Usuario.php");

if(isset($_POST['subLog'])){
	
	

	$NewUser = new Usuario;
	$errorMsg = false;
	
	$utils = new Utils();
	
	$db = $utils->getDatabaseConnection();
	$db->connect();
	
	
	/*
	$name = PDO::quote( $_POST['code'] );
    $pdo->query( "SELECT id, name FROM products WHERE code = $code" );
	*/
	
	//connect
	$textnome = $db->limparSqlInject($_POST["username"]); 
	$textsenha = $db->limparSqlInject($_POST["senha"]); 
	
	$NewUser->setUsuario($textnome);
	$NewUser->setSenha($textsenha);
	/*if(!$NewUser->setUsuario()){
		$_SESSION['Msg'] = 'Usuario invalido';
	}\
	$NewUser->setSenha($_POST["senha"]);
	*/
	
	$db->executeCommand("SELECT * FROM usuarios where usu_usuario = '".$db->limparSqlInject($NewUser->getUsuario())."' and usu_senha = '".$db->limparSqlInject($NewUser->getSenha())."'");
	
	$dados_usuario = $db->getFetchArray();
	
	//, nome, usuario, senha
	
	$_SESSION['macomp_codigo_usuario_adm_macomp'] = $dados_usuario['usu_cod'];
	$_SESSION['macomp_nome'] = $dados_usuario['usu_nome'];
	$_SESSION['macomp_usuario'] = $dados_usuario['usu_usuario'];
	$_SESSION['macomp_senha'] = $dados_usuario['usu_senha'];
	
	
	$altentic = $db->getAffectdRows();
	
	if($altentic == 1)
	 
	 header("Location: adm_inicio.php"); 
	  
	else 
	  $_SESSION['Msg'] = 'login ou senha invalido'; 	
    
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<metacharset=utf-8" />
<title>Macomp - Login </title>
<link rel="stylesheet" href="css/Reset.css" />
<link rel="stylesheet" href="css/Style.css" />
<link rel="stylesheet" href="css/Style_resp.css" />
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<link rel="icon" href="Imagens/icones/macomp-logo-icon.png" />
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">
<script src="js/carosel.js"></script>
<script src="js/jquery-1.9.1.js"></script>

</head>

<body>

<div class="img_fundo">
<img src="Imagens/macomp-termoplasticos-fabrica.jpg" />
</div>
<div class="adm_log contat_form_pl">
 <a href="Index.php" title="voltar para a pagina inicial"><img src="Imagens/macomp-logo.png"  alt="voltar para a pagina inicial"/></a>
 <h1>Login</h1>
 <form action="#" method="post" enctype="multipart/form-data" name="enviar" >
 <div >
   <label class="required" for="username">Usuário</label>
   <input type="text"  name="username" id="log_username" required/>
 </div>
 <div>
   <label class="required" for="senha" >Senha</label>
   <input type="password"  name="senha" id="log_senha" required />
 </div>
 
 <div class="adm_log_Msg">
  <?php 
    if(isset($_SESSION['Msg'])){
	   echo $_SESSION['Msg'];	
	 }
  ?>
 </div>
 <div>
  <div class="adm_log_most_sen">
   <input type="button" value="Exibir senha"  id="log_ex_senha" >
  </div>
  <div>
   <input type="submit" value="Entrar" name="subLog"  />
  </div>
 </div>
 
 
 
 
 
 </form>
</div>


<script src="js/jquery-ui-1.10.3.custom.js"></script>
<script src="js/utilities.js"></script>
<script src="js/validation.js"></script>
</body>
</html>