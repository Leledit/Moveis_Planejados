<?php

if(isset($_GET['acao']) and ($_GET['acao'] == 'desativar')){

include_once("classes/MySQL.php");
include_once("classes/Utils.php");

$utils = new Utils();

$db = $utils->getDatabaseConnection();
$db->connect();

$cod_orc = $_GET['orc_cod'];

$db->executeCommand("update orcamento set orc_status = 'Encerrado' where orc_cod = ".$db->limparSqlInject($cod_orc)." ");

echo'

<form action="adm_inicio.php" method="post">
<input type="submit" value="sucesso" hidden="hidden" id="enviar" name="enviar">


</form>
';
echo '<script>
window.onload = function(){
document.getElementById(\'enviar\').click();
}

</script>';


//header('location:adm_inicio.php');

}


?>

