<?php
  if((isset($_POST['nome']))||(isset($_POST['email']))||(isset($_POST['celular']))||(isset($_POST['asunto']))||(isset($_POST['mensagen']))){
	  ini_set('display_errors', 1);

      error_reporting(E_ALL);
     
      $nome = $_POST['nome'];
	  
      $from = $_POST['email'];
      
	  $celular = $_POST['celular'];
	  
	  $assunto = $_POST['asunto'];
      
	  $destinatario = "email_de_teste@testzone.com.br"; //E-mail da empresa para onde vao as mensagem de contato
	  
	  
      $subject = "Assunto".$assunto." De:".$nome." E-mail:".$from."Celular".$celular;

      $message = $_POST['mensagen'];

     
        mail($destinatario, $subject, $message);
		
	 
      echo '<script language="javascript">';
	  echo 'alert(\'A mensagem de e-mail foi enviada\');';
	  echo '</script>';
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Macomp - Contato </title>
<link rel="stylesheet" href="css/Reset.css" />
<link rel="stylesheet" href="css/Style.css" />
<link rel="stylesheet" href="css/Style_resp.css" />
<link rel="icon" href="Imagens/icones/macomp-logo-icon.png" />
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">
<script src="js/carosel.js"></script>
<script src="js/jquery-1.9.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.min.js"></script>

</head>

<body>

<header>
<!--primeiro menu-->
 
 <?php include("menu.php");?>
 <script type="text/javascript" >
 document.querySelector(".contato").classList.add("ident_pag");
</script>
</header><!--fecamento do cabechalho do site -->

<div class="Contant_indic">
 <div class="title_pag"><h1>Aonde nos Encontrar?</h1>
   <P>Rodovia MG 449(Zona Rural) Arceburgo-MG</P>
 </div>
</div><!--fechamento da class"Contant_indic"-->

<div class="contat_main">
 <div class="contat_unit">
  <h1>Horário de funcionamento</h1>
  <ul>
   <li>Segunda a sexta feira das XX as  XX horas</li>
   <li>Ao sábados das XX as XX horas</li>
  </ul>
 </div>
 <div class="contat_unit">
  <h1>Canais de Comunicação</h1>
  <ul>
  <li>vendas@macomptermoplasticos.com.br</li>
  <li>auro@macomptermoplasticos.com.br</li>
  <li>macomp@macomptermoplasticos.com.br</li>
  <li>(19) 3656 - 7179</li>
  <li>(19) 3656 - 1415</li>
  <h1>WhatsApp </h1>
  <li>(19) 3656 - 1415</li>
  
  </ul>
 </div>
 <div class="contat_unit">
  <h1>Endereço</h1>
  <ul>
   <li>Rodovia MG 449(Zona Rural)</li>
   <li>Arceburgo/MG</li>
   <h1>CNPJ</h1>
  <li>17.611.465/0001-81</li>
  </ul>
 </div>

</div><!--Fechamento da class"contat_main"-->

<div class="contat_form">
 <div class="title_pag"><h1>Contate-nos</h1>

 <form method="post" action="contato.php" name="enviar" id="formcontato">
  <div class="contat_form_pl">
   <div>
    <label for="nome" class="required">Nome*</label>
    <input type="text"  name="nome" title="Entre com o nome" id="cont_nome" required/>
   </div>
   <div>
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email"/>
   </div>
   <div>
    <label for="celular" class="required">Celular*</label>
    <input type="text" id="cont_celular" name="celular" placeholder="(00) 0 0000-0000" required/>
   </div>
  </div>
  <div class="contat_form_pl">
   <div>
    <label for="asunto" class="required">Assunto*</label>
    <input type="text"  name="asunto" id="cont_assunto" required/>
   </div>
   <div>
    <label for="mensagen" class="required">Mensagem*</label>
    <textarea name="mensagen"  id="cont_mensagen" required></textarea>
   </div>
   <div class="enviar"><input type="submit" name="enviar" value="Enviar" /></div>
  </div>
  </form>

</div>
</div>


<?php 
include("rodape.php");
?>


<script src="js/jquery-ui-1.10.3.custom.js"></script>
<script src="js/utilities.js"></script>
<script src="js/validation.js"></script>
<script type="text/javascript">
   $("#cont_celular").mask("(99) 9 9999 9999");
</script>
</body>
</html>