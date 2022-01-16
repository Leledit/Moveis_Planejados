

<?php

function PopUpMensagen($mensagen, $tipo, $error){

/*
Nota do programador:

$mensagen se refere a mensgame que sera enviada para a funçao
$tipo indica qual é o tipo da mensagem
*/
$height_erro = ' ';
$paragraf = '';
	if($tipo == 'success'){
	  $cor = 'adm_pop_erro_sucess';
	  $height_erro = 'adm_pop_erro_susse';
	  
	 }else if($tipo == 'fall'){
	  $cor = 'adm_pop_erro_fals';
	  $paragraf = '<p>'.$error.'</p>';
	  
	}
	
echo '

<div class="adm_pop_erro '.$height_erro.'" id="adm_popUp">
 <div class="adm_pop_erro_title '.$cor.'">'.$mensagen.'</div>

 '.$paragraf.'
 
 <div class="adm_pop_erro_ok" id="adm_pop_error">OK</div>
</div>

';	

echo '<script src="js/PopUp.js"></script>';
}


?>
