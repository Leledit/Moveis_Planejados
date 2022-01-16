<?php 

session_start();
include('adm_verific_session.php');
/*echo $_SESSION['nome']."</br>";
echo $_SESSION['id_usuario']."</br>";
echo	$_SESSION['usuario'] ."</br>";
echo	$_SESSION['senha'] ."</br>";*/

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
<title>Administração - Perfil do Administrador</title>
</head>

<body>

<?php include("menu_adm.php");?>

<script type="text/javascript" >
 document.querySelector("#adm_perfil").classList.add("ident_pag");
</script>

<div class="adm_main_content">
 
 
 <div class="adm_menu">
  <h1>Informativo</h1>
  <p>Nessa pagina é possivel visualizar as informaçoes do usuario que esta atualmente logado no sistema</p>
  <p>Ao clicar na opçao 'Editar informaçoes' sera aberto um formulario aonde sera possivel alterar as informaçoes de registro</p>
  <h2>Açoes</h2>
  <a href="adm_perfil_edit.php"><div class="adm_menu_btn">Editar perfil </div></a>
 </div><!--fechamento da class"adm_menu"-->
 <div class="adm_content">
 <h1>Perifl do Administrador</h1>
 
 
  <h2>Dados de acesso</h2>
  <div class="adm_perfil_dados">
    
    <div class="perfil_primer adm_perfi_dado ">
     <h3>Nome :</h3> <?php echo $_SESSION['macomp_nome']; ?>
    </div>
    <div class="adm_perfi_dado">
     <h3>Usuario :</h3> <?php echo $_SESSION['macomp_usuario'];  ?>
    </div>
    <div class="adm_perfi_dado">
     <h3>Senha :</h3> <b><?php echo  '*********' ?></b>
    </div>
  
  
  
  
  </div>
 
 </div>
 </div><!-- fechamento da class"adm_content"-->
</div><!--fechamento da class"adm_main_content"-->
</body>
</html>